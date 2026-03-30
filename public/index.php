<?php

/**
 * Front Controller - acoperisuri.info
 * Toate cererile trec prin acest fisier
 */

// Defineste root-ul proiectului
define('ROOT_PATH', dirname(__DIR__));

// Autoloader simplu PSR-4
spl_autoload_register(function (string $class) {
    $prefix = 'App\\';
    $baseDir = ROOT_PATH . '/src/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
        return;
    }

    // Fallback: lowercase directory, keep filename (for Linux case-sensitivity)
    $parts = explode('\\', $relativeClass);
    $className = array_pop($parts);
    $dirs = array_map('strtolower', $parts);
    $file = $baseDir . implode('/', $dirs) . '/' . $className . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Incarca variabilele de mediu
\App\Helpers\Env::load(ROOT_PATH);

// Incarca configurarea aplicatiei
$appConfig = require ROOT_PATH . '/src/config/app.php';

// Seteaza timezone
date_default_timezone_set($appConfig['timezone']);

// Error reporting
if ($appConfig['debug']) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
}

// Porneste sesiunea securizata (necesara pentru admin auth + CSRF)
\App\Helpers\Auth::startSession();

// Initializeaza router-ul
$router = new \App\Helpers\Router();
$uri = $_SERVER['REQUEST_URI'] ?? '/';

// Rezolva ruta
$route = $router->resolve($uri);

if ($route === null) {
    // 404 - pagina nu a fost gasita
    \App\Helpers\View::render404();
    exit;
}

// Determina controller-ul si actiunea
$controllerName = 'App\\Controllers\\' . $route['controller'];
$action = $route['action'];
$params = $router->getParams();

// Verifica ca controller-ul exista
if (!class_exists($controllerName)) {
    \App\Helpers\View::render404();
    exit;
}

// Instantiaza controller-ul si executa actiunea
$controller = new $controllerName();

if (!method_exists($controller, $action)) {
    \App\Helpers\View::render404();
    exit;
}

// Executa actiunea
$controller->$action($params, $route);
