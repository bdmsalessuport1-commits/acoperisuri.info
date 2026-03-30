<?php

namespace App\Helpers;

class View
{
    private static string $viewsPath = __DIR__ . '/../views/';

    /**
     * Randeaza un view cu layout
     */
    public static function render(string $view, array $data = [], string $layout = 'main'): void
    {
        // Extrage variabilele pentru a fi disponibile in view
        extract($data);

        // Capteaza continutul view-ului
        ob_start();
        $viewFile = self::$viewsPath . $view . '.php';
        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            echo '<p>View not found: ' . htmlspecialchars($view) . '</p>';
        }
        $content = ob_get_clean();

        // Randeaza layout-ul cu continutul
        $layoutFile = self::$viewsPath . 'layouts/' . $layout . '.php';
        if (file_exists($layoutFile)) {
            require $layoutFile;
        } else {
            echo $content;
        }
    }

    /**
     * Randeaza un partial (fragment de view)
     */
    public static function partial(string $partial, array $data = []): void
    {
        extract($data);
        $file = self::$viewsPath . 'partials/' . $partial . '.php';
        if (file_exists($file)) {
            require $file;
        }
    }

    /**
     * Randeaza pagina 404
     */
    public static function render404(): void
    {
        http_response_code(404);
        self::render('pages/404', [
            'pageTitle' => 'Pagina nu a fost gasita - BDM Systems',
            'pageDescription' => 'Pagina cautata nu exista pe acoperisuri.info',
        ]);
    }
}
