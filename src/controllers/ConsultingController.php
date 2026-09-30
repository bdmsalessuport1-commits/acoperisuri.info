<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Helpers\DataStore;
use App\Helpers\SchemaMarkup;

/**
 * Consulting (Passive House) controller
 *
 * Handles:
 *   - GET  /consultanta-passive-house           → landing page
 *   - POST /consultanta-passive-house/aplica    → application submission (multi-step form)
 *   - GET  /consultanta-passive-house/multumim  → success confirmation page
 */
class ConsultingController
{
    private array $content;

    public function __construct()
    {
        $this->content = require ROOT_PATH . '/src/config/consultanta-content.php';
    }

    /**
     * Landing page
     */
    public function index(array $params, array $route): void
    {
        $c = $this->content;

        // Pre-select package from ?pachet=analiza|optimizare|completa
        $preselectedPackage = $_GET['pachet'] ?? '';
        $validPackages = array_keys($c['form']['step4_packages']);
        if (!in_array($preselectedPackage, $validPackages, true)) {
            $preselectedPackage = '';
        }

        View::render('pages/consultanta-passive-house', [
            'pageTitle'       => $c['seo']['title'],
            'pageDescription' => $c['seo']['description'],
            'pageImage'       => $c['seo']['og_image'],
            'pageType'        => 'website',
            'content'         => $c,
            'preselectedPackage' => $preselectedPackage,
            'formData'        => [],
            'formErrors'      => [],
            'breadcrumbs'     => [['label' => 'Consultanță Passive House']],
            'schemaMarkup'    => $this->buildSchemaMarkup(),
        ]);
    }

    /**
     * Process application submission
     */
    public function apply(array $params, array $route): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /consultanta-passive-house');
            exit;
        }

        $c = $this->content;

        $data = [
            // Step 1 — project
            'project_type'     => $this->clean($_POST['project_type']   ?? ''),
            'building_type'    => $this->clean($_POST['building_type']  ?? ''),
            'location_city'    => $this->clean($_POST['location_city']  ?? ''),
            'location_county'  => $this->clean($_POST['location_county']?? ''),
            'area_sqm'         => $this->clean($_POST['area_sqm']       ?? ''),
            'structure_type'   => $this->clean($_POST['structure_type'] ?? ''),

            // Step 2 — stage
            'stage'            => $this->clean($_POST['stage']          ?? ''),

            // Step 3 — objectives (multiple)
            'objectives'       => is_array($_POST['objectives'] ?? null)
                                    ? array_values(array_filter(array_map([$this, 'clean'], $_POST['objectives'])))
                                    : [],

            // Step 4 — package
            'package'          => $this->clean($_POST['package']        ?? ''),

            // Step 5 — documents (uploaded files)
            'documents'        => [],

            // Step 6 — contact
            'name'             => $this->clean($_POST['name']              ?? ''),
            'phone'            => $this->clean($_POST['phone']             ?? ''),
            'email'            => $this->clean($_POST['email']             ?? ''),
            'contact_pref'     => $this->clean($_POST['contact_pref']      ?? ''),
            'contact_time'     => $this->clean($_POST['contact_time']      ?? ''),
            'message'          => $this->clean($_POST['message']           ?? ''),

            // Consent
            'consent_gdpr'     => !empty($_POST['consent_gdpr']),
            'consent_marketing'=> !empty($_POST['consent_marketing']),

            // Meta
            'submitted_at'     => date('Y-m-d H:i:s'),
            'ip'               => $_SERVER['REMOTE_ADDR'] ?? '',
            'user_agent'       => substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 300),
            'referrer'         => substr($_SERVER['HTTP_REFERER']    ?? '', 0, 300),
        ];

        // Honeypot anti-spam
        if (!empty($_POST['website']) || !empty($_POST['company_extra'])) {
            header('Location: /consultanta-passive-house/multumim');
            exit;
        }

        $errors = $this->validate($data, $c);

        // Handle file uploads if valid so far
        if (empty($errors)) {
            $data['documents'] = $this->handleUploads($errors, $c);
        }

        if (!empty($errors)) {
            View::render('pages/consultanta-passive-house', [
                'pageTitle'       => $c['seo']['title'],
                'pageDescription' => $c['seo']['description'],
                'pageImage'       => $c['seo']['og_image'],
                'content'         => $c,
                'preselectedPackage' => $data['package'],
                'formData'        => $data,
                'formErrors'      => $errors,
                'breadcrumbs'     => [['label' => 'Consultanță Passive House']],
                'schemaMarkup'    => $this->buildSchemaMarkup(),
            ]);
            return;
        }

        // Save + notify
        $this->saveApplication($data);
        $this->sendEmailNotification($data, $c);

        // Redirect to success page (PRG pattern)
        header('Location: /consultanta-passive-house/multumim');
        exit;
    }

    /**
     * Success confirmation page
     */
    public function thanks(array $params, array $route): void
    {
        $c = $this->content;

        View::render('pages/consultanta-multumim', [
            'pageTitle'       => 'Aplicația a fost primită | Consultanță Passive House',
            'pageDescription' => $c['form']['success_message'],
            'content'         => $c,
            'breadcrumbs'     => [
                ['label' => 'Consultanță Passive House', 'url' => '/consultanta-passive-house'],
                ['label' => 'Aplicație primită'],
            ],
        ]);
    }

    // ═══════════════════════════════════════════════════════════════════
    // Private helpers
    // ═══════════════════════════════════════════════════════════════════

    private function clean(string $v): string
    {
        return trim(preg_replace('/[\x00-\x1F\x7F]/u', '', $v));
    }

    private function validate(array $d, array $c): array
    {
        $errors = [];

        // Step 1
        if (!array_key_exists($d['project_type'], $c['form']['step1_project_types'])) {
            $errors['project_type'] = 'Alege tipul de proiect.';
        }
        if (!array_key_exists($d['building_type'], $c['form']['step1_building_types'])) {
            $errors['building_type'] = 'Alege tipul de clădire.';
        }
        if (mb_strlen($d['location_city']) < 2) {
            $errors['location_city'] = 'Localitatea este obligatorie.';
        }

        // Step 2
        if (!array_key_exists($d['stage'], $c['form']['step2_stages'])) {
            $errors['stage'] = 'Alege stadiul proiectului.';
        }

        // Step 3
        if (empty($d['objectives'])) {
            $errors['objectives'] = 'Alege cel puțin un obiectiv.';
        }

        // Step 4
        if (!array_key_exists($d['package'], $c['form']['step4_packages'])) {
            $errors['package'] = 'Alege un pachet sau "Nu știu încă".';
        }

        // Step 6 — contact
        if (mb_strlen($d['name']) < 2) {
            $errors['name'] = 'Numele este obligatoriu.';
        }
        if (!filter_var($d['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Adresa de email nu este validă.';
        }
        if (strlen(preg_replace('/\D/', '', $d['phone'])) < 9) {
            $errors['phone'] = 'Numărul de telefon nu este valid (minimum 9 cifre).';
        }
        if (!array_key_exists($d['contact_pref'], $c['form']['step6_contact_preferences'])) {
            $errors['contact_pref'] = 'Alege modalitatea preferată de contact.';
        }

        // Consent
        if (!$d['consent_gdpr']) {
            $errors['consent_gdpr'] = 'Trebuie să accepți politica de confidențialitate pentru a trimite aplicația.';
        }

        return $errors;
    }

    private function handleUploads(array &$errors, array $c): array
    {
        if (empty($_FILES['documents']['name']) || !is_array($_FILES['documents']['name'])) {
            return [];
        }

        $allowed = $c['form']['upload_allowed'];
        $maxBytes = (int)$c['form']['upload_max_size_mb'] * 1024 * 1024;
        $maxCount = (int)$c['form']['upload_max_files'];
        $saved = [];

        $baseDir = ROOT_PATH . '/storage/consulting-uploads/';
        if (!is_dir($baseDir)) {
            @mkdir($baseDir, 0755, true);
        }

        $timestamp = date('Ymd-His');
        $randomToken = bin2hex(random_bytes(6));
        $subDir = $baseDir . $timestamp . '-' . $randomToken . '/';
        @mkdir($subDir, 0755, true);

        $count = 0;
        foreach ($_FILES['documents']['name'] as $i => $originalName) {
            if (empty($originalName)) continue;
            if ($count >= $maxCount) {
                $errors['documents'] = 'Maximum ' . $maxCount . ' fișiere.';
                break;
            }
            $count++;

            $err = $_FILES['documents']['error'][$i];
            if ($err !== UPLOAD_ERR_OK) {
                $errors['documents'] = 'Eroare la încărcarea unuia dintre fișiere. Te rog reîncearcă.';
                continue;
            }

            $size = (int)$_FILES['documents']['size'][$i];
            if ($size > $maxBytes) {
                $errors['documents'] = 'Un fișier depășește dimensiunea maximă (' . $c['form']['upload_max_size_mb'] . ' MB).';
                continue;
            }

            $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
            if (!in_array($ext, $allowed, true)) {
                $errors['documents'] = 'Tipul fișierului nu este permis. Acceptate: ' . implode(', ', $allowed);
                continue;
            }

            $safeName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $originalName);
            $destPath = $subDir . $safeName;
            if (!move_uploaded_file($_FILES['documents']['tmp_name'][$i], $destPath)) {
                $errors['documents'] = 'Nu am putut salva un fișier. Te rog reîncearcă.';
                continue;
            }

            $saved[] = [
                'original_name' => $originalName,
                'stored_path'   => 'storage/consulting-uploads/' . $timestamp . '-' . $randomToken . '/' . $safeName,
                'size_bytes'    => $size,
                'mime_ext'      => $ext,
            ];
        }

        return $saved;
    }

    private function saveApplication(array $data): int
    {
        $store = new DataStore('consulting-applications');
        $data['status'] = 'nou';
        $saved = $store->create($data);
        return $saved['id'] ?? 0;
    }

    private function sendEmailNotification(array $data, array $c): void
    {
        $to = $c['expert']['contact']['application_email'];
        $subject = 'Aplicație consultanță Passive House — ' . $data['name'];

        $lines = [];
        $lines[] = "Aplicație nouă pentru consultanță Passive House / nZEB.";
        $lines[] = "";
        $lines[] = "═══════════════════════════════════════════════";
        $lines[] = "PROIECT";
        $lines[] = "═══════════════════════════════════════════════";
        $lines[] = "Tip proiect:    " . ($c['form']['step1_project_types'][$data['project_type']] ?? $data['project_type']);
        $lines[] = "Tip clădire:    " . ($c['form']['step1_building_types'][$data['building_type']] ?? $data['building_type']);
        $lines[] = "Localitate:     " . $data['location_city'] . ($data['location_county'] ? ', ' . $data['location_county'] : '');
        $lines[] = "Suprafață:      " . ($data['area_sqm'] ?: 'necompletat');
        $lines[] = "Structură:      " . ($data['structure_type'] ?: 'necompletat');
        $lines[] = "Stadiu:         " . ($c['form']['step2_stages'][$data['stage']] ?? $data['stage']);
        $lines[] = "";
        $lines[] = "═══════════════════════════════════════════════";
        $lines[] = "OBIECTIV";
        $lines[] = "═══════════════════════════════════════════════";
        foreach ($data['objectives'] as $obj) {
            $lines[] = "  • " . ($c['form']['step3_objectives'][$obj] ?? $obj);
        }
        $lines[] = "Pachet ales:    " . ($c['form']['step4_packages'][$data['package']] ?? $data['package']);
        $lines[] = "";
        $lines[] = "═══════════════════════════════════════════════";
        $lines[] = "DOCUMENTE ÎNCĂRCATE";
        $lines[] = "═══════════════════════════════════════════════";
        if (empty($data['documents'])) {
            $lines[] = "(niciun document încărcat)";
        } else {
            foreach ($data['documents'] as $doc) {
                $lines[] = "  • " . $doc['original_name'] . ' (' . round($doc['size_bytes'] / 1024) . ' KB) — ' . $doc['stored_path'];
            }
        }
        $lines[] = "";
        $lines[] = "═══════════════════════════════════════════════";
        $lines[] = "CONTACT";
        $lines[] = "═══════════════════════════════════════════════";
        $lines[] = "Nume:           " . $data['name'];
        $lines[] = "Telefon:        " . $data['phone'];
        $lines[] = "Email:          " . $data['email'];
        $lines[] = "Preferă:        " . ($c['form']['step6_contact_preferences'][$data['contact_pref']] ?? $data['contact_pref']);
        $lines[] = "Interval:       " . ($c['form']['step6_contact_times'][$data['contact_time']] ?? '(nespecificat)');
        if (!empty($data['message'])) {
            $lines[] = "";
            $lines[] = "Mesaj suplimentar:";
            $lines[] = $data['message'];
        }
        $lines[] = "";
        $lines[] = "═══════════════════════════════════════════════";
        $lines[] = "META";
        $lines[] = "═══════════════════════════════════════════════";
        $lines[] = "Trimis la:      " . $data['submitted_at'];
        $lines[] = "IP:             " . $data['ip'];
        $lines[] = "Referrer:       " . $data['referrer'];
        $lines[] = "GDPR:           " . ($data['consent_gdpr'] ? 'ACORD' : 'lipsă');
        $lines[] = "Marketing:      " . ($data['consent_marketing'] ? 'acord' : 'refuz');
        $body = implode("\n", $lines);

        $headers = [
            'From: consultanta@acoperisuri.info',
            'Reply-To: ' . $data['email'],
            'Content-Type: text/plain; charset=UTF-8',
            'X-Mailer: BDM-Systems-Consulting',
        ];

        // Silent send — if the mail server is unavailable in dev, don't break the flow
        @mail($to, '=?UTF-8?B?' . base64_encode($subject) . '?=', $body, implode("\r\n", $headers));
    }

    private function buildSchemaMarkup(): string
    {
        $c = $this->content;

        // Person schema (Mircea Barticel)
        $person = [
            '@context' => 'https://schema.org',
            '@type'    => 'Person',
            'name'     => $c['expert']['name'],
            'jobTitle' => $c['expert']['title'],
            'description' => 'Consultant Certificat Case Pasive (PHI). Fondator BDM Systems. ' . $c['expert']['experience_years'] . ' ani experiență practică în construcții.',
            'url'      => 'https://acoperisuri.info/consultanta-passive-house',
            'image'    => 'https://acoperisuri.info' . $c['hero']['image'],
            'email'    => $c['expert']['contact']['email'],
            'worksFor' => [
                '@type' => 'Organization',
                'name'  => $c['expert']['company'],
                'url'   => $c['expert']['company_url'],
            ],
            'hasCredential' => array_map(fn($cert) => [
                '@type' => 'EducationalOccupationalCredential',
                'name'  => $cert['name'],
                'credentialCategory' => 'Professional Certification',
                'recognizedBy' => [
                    '@type' => 'Organization',
                    'name'  => $cert['issuer'],
                ],
            ], $c['expert']['certifications']),
        ];

        // ProfessionalService schema
        $service = [
            '@context' => 'https://schema.org',
            '@type'    => 'ProfessionalService',
            'name'     => 'Consultanță Passive House și nZEB — Mircea Barticel',
            'description' => $c['seo']['description'],
            'url'      => 'https://acoperisuri.info/consultanta-passive-house',
            'provider' => [
                '@type' => 'Person',
                'name'  => $c['expert']['name'],
            ],
            'areaServed' => [
                '@type' => 'Country',
                'name'  => 'România',
            ],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress'   => 'Prelungirea Ghencea 95C',
                'addressLocality' => 'București',
                'addressCountry'  => 'RO',
            ],
        ];

        // FAQ schema
        $faqItems = array_map(fn($f) => [
            'question' => $f['q'],
            'answer'   => strip_tags($f['a']),
        ], $c['faq']['items']);

        return
            '<script type="application/ld+json">' . json_encode($person,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' .
            '<script type="application/ld+json">' . json_encode($service, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' .
            SchemaMarkup::faq($faqItems);
    }
}
