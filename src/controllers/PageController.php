<?php

namespace App\Controllers;

use App\Helpers\View;

class PageController
{
    public function about(array $params, array $route): void
    {
        View::render('pages/about', [
            'pageTitle'       => 'Despre BDM Systems - 14+ ani experienta in acoperisuri',
            'pageDescription' => 'BDM Systems - din 2010, peste 4000 acoperisuri realizate. Tigla metalica, tabla faltuita, ferestre FAKRO, izolatie STEICO.',
            'breadcrumbs'     => [['label' => 'Despre noi']],
        ]);
    }

    public function contact(array $params, array $route): void
    {
        $formData   = [];
        $formErrors = [];
        $formSent   = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = [
                'name'    => trim($_POST['name']    ?? ''),
                'email'   => trim($_POST['email']   ?? ''),
                'phone'   => trim($_POST['phone']   ?? ''),
                'subject' => trim($_POST['subject'] ?? ''),
                'product' => trim($_POST['product'] ?? ''),
                'message' => trim($_POST['message'] ?? ''),
                'consent' => !empty($_POST['consent']),
            ];

            // Validate
            if (empty($formData['name'])) {
                $formErrors[] = 'Numele este obligatoriu.';
            }
            if (empty($formData['email']) || !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
                $formErrors[] = 'Introduceti o adresa de email valida.';
            }
            if (empty($formData['phone']) || strlen(preg_replace('/\D/', '', $formData['phone'])) < 9) {
                $formErrors[] = 'Introduceti un numar de telefon valid (minimum 9 cifre).';
            }
            $validSubjects = ['Cerere oferta', 'Informatii produs', 'Consultanta', 'Reclamatie', 'Altele'];
            if (empty($formData['subject']) || !in_array($formData['subject'], $validSubjects, true)) {
                $formErrors[] = 'Selectati un subiect valid.';
            }
            if (empty($formData['message']) || mb_strlen($formData['message']) < 10) {
                $formErrors[] = 'Mesajul trebuie sa contina minimum 10 caractere.';
            }
            if (!$formData['consent']) {
                $formErrors[] = 'Trebuie sa fiti de acord cu prelucrarea datelor personale.';
            }

            if (empty($formErrors)) {
                // TODO: Save to DB or send email (Etapa 18)
                $formSent = true;
                $formData = []; // clear form
            }
        }

        View::render('pages/contact', [
            'pageTitle'       => 'Contact - BDM Systems | Solicita oferta gratuita',
            'pageDescription' => 'Contacteaza BDM Systems pentru oferte personalizate, consultanta gratuita si informatii despre acoperisuri.',
            'formData'        => $formData,
            'formErrors'      => $formErrors,
            'formSent'        => $formSent,
            'breadcrumbs'     => [['label' => 'Contact']],
        ]);
    }

    public function services(array $params, array $route): void
    {
        View::render('pages/servicii', [
            'pageTitle'       => 'Servicii acoperisuri - Montaj, renovare, consultanta | BDM Systems',
            'pageDescription' => 'Servicii profesionale: montaj acoperis, renovare, sisteme pluviale, ferestre FAKRO, izolatie STEICO. Consultanta gratuita.',
            'breadcrumbs'     => [['label' => 'Servicii']],
        ]);
    }

    public function calculator(array $params, array $route): void
    {
        View::render('pages/calculator', [
            'pageTitle'       => 'Calculator cost acoperis - Estimeaza pretul | BDM Systems',
            'pageDescription' => 'Calculeaza rapid costul acoperisului tau. Estimare pret pentru tigla metalica, tabla faltuita, tabla click si accesorii.',
            'breadcrumbs'     => [['label' => 'Calculator cost acoperis']],
        ]);
    }
}
