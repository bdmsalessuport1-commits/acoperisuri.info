<?php

namespace App\Helpers;

class Auth
{
    private const RATE_LIMIT_MAX = 5;
    private const RATE_LIMIT_WINDOW = 900; // 15 minute

    /**
     * Porneste sesiunea securizata
     */
    public static function startSession(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            return;
        }

        $isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
                    || ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https';

        session_set_cookie_params([
            'lifetime' => 7200, // 2 ore
            'path'     => '/',
            'domain'   => '',
            'secure'   => $isSecure,
            'httponly'  => true,
            'samesite' => 'Strict',
        ]);

        session_name('bdm_admin_sess');
        session_start();

        // Regenerare session ID periodic (la fiecare 30 min)
        if (!isset($_SESSION['_last_regen'])) {
            $_SESSION['_last_regen'] = time();
        } elseif (time() - $_SESSION['_last_regen'] > 1800) {
            session_regenerate_id(true);
            $_SESSION['_last_regen'] = time();
        }
    }

    /**
     * Autentifica utilizatorul
     */
    public static function login(string $email, string $password): array
    {
        // Verifica rate limiting
        if (self::isRateLimited()) {
            return [
                'success' => false,
                'error'   => 'Prea multe incercari. Reincercati in 15 minute.',
            ];
        }

        $users = require ROOT_PATH . '/src/config/admin-users.php';
        $user = null;

        foreach ($users as $u) {
            if ($u['email'] === $email && $u['active']) {
                $user = $u;
                break;
            }
        }

        if (!$user || !password_verify($password, $user['password'])) {
            self::recordFailedAttempt();
            return [
                'success' => false,
                'error'   => 'Email sau parola incorecta.',
            ];
        }

        // Regenerare session ID la login (prevenire session fixation)
        session_regenerate_id(true);

        $_SESSION['admin_user'] = [
            'id'    => $user['id'],
            'name'  => $user['name'],
            'email' => $user['email'],
            'role'  => $user['role'],
        ];
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_login_time'] = time();
        $_SESSION['_last_regen'] = time();

        // Resetare rate limiting la login reusit
        unset($_SESSION['_login_attempts']);

        return ['success' => true];
    }

    /**
     * Delogheaza utilizatorul
     */
    public static function logout(): void
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }

        session_destroy();
    }

    /**
     * Verifica daca utilizatorul este autentificat
     */
    public static function check(): bool
    {
        return !empty($_SESSION['admin_logged_in'])
            && !empty($_SESSION['admin_user']);
    }

    /**
     * Returneaza utilizatorul curent
     */
    public static function user(): ?array
    {
        return $_SESSION['admin_user'] ?? null;
    }

    /**
     * Verifica daca utilizatorul are un anumit rol
     */
    public static function hasRole(string $role): bool
    {
        $user = self::user();
        if (!$user) {
            return false;
        }

        $hierarchy = [
            'administrator' => 3,
            'editor'        => 2,
            'operator'      => 1,
        ];

        $userLevel = $hierarchy[$user['role']] ?? 0;
        $requiredLevel = $hierarchy[$role] ?? 99;

        return $userLevel >= $requiredLevel;
    }

    /**
     * Forteaza autentificarea — redirect la login daca nu e logat
     */
    public static function requireAuth(): void
    {
        if (!self::check()) {
            header('Location: /admin/login');
            exit;
        }
    }

    /**
     * Forteaza un anumit rol minim
     */
    public static function requireRole(string $role): void
    {
        self::requireAuth();

        if (!self::hasRole($role)) {
            http_response_code(403);
            echo '<h1>403 - Acces interzis</h1><p>Nu aveti permisiuni suficiente.</p>';
            exit;
        }
    }

    // ─── CSRF ───────────────────────────────────────────────

    /**
     * Genereaza sau returneaza token CSRF
     */
    public static function csrfToken(): string
    {
        if (empty($_SESSION['_csrf_token'])) {
            $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['_csrf_token'];
    }

    /**
     * Returneaza camp hidden HTML cu token CSRF
     */
    public static function csrfField(): string
    {
        return '<input type="hidden" name="_csrf_token" value="' . self::csrfToken() . '">';
    }

    /**
     * Valideaza token CSRF din POST
     */
    public static function verifyCsrf(): bool
    {
        $token = $_POST['_csrf_token'] ?? '';
        return !empty($token)
            && !empty($_SESSION['_csrf_token'])
            && hash_equals($_SESSION['_csrf_token'], $token);
    }

    /**
     * Valideaza CSRF si aborteaza daca invalid
     */
    public static function requireCsrf(): void
    {
        if (!self::verifyCsrf()) {
            http_response_code(403);
            echo '<h1>403 - Token CSRF invalid</h1><p>Sesiunea a expirat. Reincarcati pagina.</p>';
            exit;
        }
    }

    // ─── RATE LIMITING ──────────────────────────────────────

    /**
     * Verifica daca IP-ul/sesiunea e rate limited
     */
    private static function isRateLimited(): bool
    {
        $attempts = $_SESSION['_login_attempts'] ?? [];
        $now = time();

        // Curata incercarile vechi
        $attempts = array_filter($attempts, fn($t) => ($now - $t) < self::RATE_LIMIT_WINDOW);
        $_SESSION['_login_attempts'] = $attempts;

        return count($attempts) >= self::RATE_LIMIT_MAX;
    }

    /**
     * Inregistreaza o incercare esuata
     */
    private static function recordFailedAttempt(): void
    {
        if (!isset($_SESSION['_login_attempts'])) {
            $_SESSION['_login_attempts'] = [];
        }
        $_SESSION['_login_attempts'][] = time();
    }
}
