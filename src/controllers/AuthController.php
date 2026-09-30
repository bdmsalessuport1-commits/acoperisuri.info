<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\View;

class AuthController
{
    public function login(array $params, array $route): void
    {
        // Daca e deja logat, redirect la dashboard
        if (Auth::check()) {
            header('Location: /admin');
            exit;
        }

        // GET — afiseaza formularul
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            View::render('admin/login', [
                'pageTitle' => 'Admin Login - BDM Systems',
                'error'     => '',
            ], 'login');
            return;
        }

        // POST — proceseaza autentificarea

        // Verifica CSRF
        if (!Auth::verifyCsrf()) {
            View::render('admin/login', [
                'pageTitle' => 'Admin Login - BDM Systems',
                'error'     => 'Sesiunea a expirat. Reincarcati pagina.',
            ], 'login');
            return;
        }

        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            View::render('admin/login', [
                'pageTitle' => 'Admin Login - BDM Systems',
                'error'     => 'Completati email-ul si parola.',
                'email'     => $email,
            ], 'login');
            return;
        }

        $result = Auth::login($email, $password);

        if ($result['success']) {
            header('Location: /admin');
            exit;
        }

        View::render('admin/login', [
            'pageTitle' => 'Admin Login - BDM Systems',
            'error'     => $result['error'],
            'email'     => $email,
        ], 'login');
    }

    public function logout(array $params, array $route): void
    {
        Auth::logout();
        header('Location: /admin/login');
        exit;
    }
}
