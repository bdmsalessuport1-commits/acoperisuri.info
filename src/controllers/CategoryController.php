<?php

namespace App\Controllers;

use App\Helpers\View;

class CategoryController
{
    /**
     * Date placeholder pentru categorii (vor veni din DB ulterior)
     */
    private array $categoryData = [
        'tigla-metalica' => [
            'name' => 'Tigla metalica',
            'description' => 'Cele mai performante profile de tigla metalica de la producatori de top: Budmat, Metigla, Wetterbest si Blachotrapez. Garantie extinsa si gama variata de culori.',
            'icon' => '&#9650;',
            'subcategories' => [
                ['slug' => 'budmat', 'name' => 'Budmat', 'count' => 5, 'icon' => '&#9650;'],
                ['slug' => 'metigla', 'name' => 'Metigla', 'count' => 4, 'icon' => '&#9650;'],
                ['slug' => 'blachotrapez', 'name' => 'Blachotrapez', 'count' => 3, 'icon' => '&#9650;'],
                ['slug' => 'wetterbest', 'name' => 'Wetterbest', 'count' => 3, 'icon' => '&#9650;'],
            ],
            'popular' => [
                ['slug' => 'budmat-venecja', 'name' => 'Venecja', 'brand' => 'Budmat'],
                ['slug' => 'budmat-bella-sara', 'name' => 'Bella Sara', 'brand' => 'Budmat'],
                ['slug' => 'metigla-elit', 'name' => 'Elit', 'brand' => 'Metigla'],
                ['slug' => 'metigla-star', 'name' => 'Star', 'brand' => 'Metigla'],
            ],
            'seo_title' => 'Tigla Metalica - Preturi si Modele',
            'seo_text' => '<h2>Tigla metalica - ghid complet</h2>
                <p>Tigla metalica este una dintre cele mai populare solutii de invelitoare in Romania, datorita raportului excelent calitate-pret, durabilitatii si aspectului estetic.</p>
                <h3>Avantajele tiglei metalice</h3>
                <ul>
                    <li>Greutate redusa - nu solicita excesiv structura acoperisului</li>
                    <li>Montaj rapid si eficient</li>
                    <li>Rezistenta la intemperii si coroziune</li>
                    <li>Gama variata de culori si profile</li>
                    <li>Garantie de pana la 50 de ani</li>
                </ul>
                <h3>Producatori disponibili</h3>
                <p>Oferim tigla metalica de la cei mai importanti producatori europeni: Budmat (Polonia), Metigla (Romania), Wetterbest (Romania) si Blachotrapez (Polonia).</p>',
            'related' => [
                ['slug' => '/tabla-faltuita', 'name' => 'Tabla faltuita'],
                ['slug' => '/tabla-click', 'name' => 'Tabla click'],
                ['slug' => '/accesorii-acoperis', 'name' => 'Accesorii acoperis'],
                ['slug' => '/folii-anticondens', 'name' => 'Folii anticondens'],
            ],
        ],
        'tabla-faltuita' => [
            'name' => 'Tabla faltuita',
            'description' => 'Sisteme de invelitoare cu falt vertical si orizontal. Design modern, etanseitate superioara si durabilitate exceptionala.',
            'icon' => '&#9645;',
            'subcategories' => [
                ['slug' => 'metigla', 'name' => 'Metigla', 'count' => 3, 'icon' => '&#9645;'],
                ['slug' => 'vestalpin', 'name' => 'Vestalpin', 'count' => 2, 'icon' => '&#9645;'],
                ['slug' => 'wetterbest', 'name' => 'Wetterbest', 'count' => 2, 'icon' => '&#9645;'],
                ['slug' => 'fals-solar-metigla', 'name' => 'Fals solar Metigla', 'count' => 1, 'icon' => '&#9645;'],
            ],
            'popular' => [
                ['slug' => 'tabla-faltuita-metigla-click', 'name' => 'Falt vertical Metigla', 'brand' => 'Metigla'],
                ['slug' => 'tabla-faltuita-vestalpin', 'name' => 'Falt Vestalpin', 'brand' => 'Vestalpin'],
            ],
            'seo_title' => 'Tabla Faltuita - Sisteme de Invelitoare Premium',
            'seo_text' => '<h2>Tabla faltuita - eleganta si performanta</h2>
                <p>Tabla faltuita reprezinta solutia premium pentru invelitori, oferind un aspect modern si o etanseitate superioara. Sistemul de falt asigura o imbinare perfecta intre panouri.</p>
                <h3>De ce sa alegi tabla faltuita?</h3>
                <ul>
                    <li>Etanseitate maxima - faltul elimina riscul de infiltratii</li>
                    <li>Aspect arhitectural modern si elegant</li>
                    <li>Potrivita pentru acoperisuri cu pante mici</li>
                    <li>Disponibila in variante cu falt vertical sau orizontal</li>
                </ul>',
            'related' => [
                ['slug' => '/tigla-metalica', 'name' => 'Tigla metalica'],
                ['slug' => '/tabla-click', 'name' => 'Tabla click'],
                ['slug' => '/accesorii-acoperis', 'name' => 'Accesorii acoperis'],
            ],
        ],
        'sisteme-pluviale' => [
            'name' => 'Sisteme pluviale',
            'description' => 'Jgheaburi si burlane pentru colectarea si evacuarea apei pluviale. Sisteme complete de la Metigla, Wetterbest si Flamingo iQ Budmat.',
            'icon' => '&#128167;',
            'subcategories' => [
                ['slug' => 'metigla', 'name' => 'Sistem scurgere Metigla', 'count' => 4, 'icon' => '&#128167;'],
                ['slug' => 'wetterbest', 'name' => 'Sistem scurgere Wetterbest', 'count' => 3, 'icon' => '&#128167;'],
                ['slug' => 'flamingo-iq-budmat', 'name' => 'Flamingo iQ Budmat', 'count' => 3, 'icon' => '&#128167;'],
            ],
            'popular' => [
                ['slug' => 'jgheab-metigla-150', 'name' => 'Jgheab 150mm', 'brand' => 'Metigla'],
                ['slug' => 'burlan-metigla-100', 'name' => 'Burlan 100mm', 'brand' => 'Metigla'],
                ['slug' => 'flamingo-iq-jgheab', 'name' => 'Jgheab Flamingo iQ', 'brand' => 'Budmat'],
            ],
            'seo_title' => 'Sisteme Pluviale - Jgheaburi si Burlane',
            'seo_text' => '<h2>Sisteme pluviale - protectie completa</h2>
                <p>Un sistem pluvial performant este esential pentru protejarea fundatiei si a fatadei cladirii. Oferim sisteme complete de jgheaburi si burlane din tabla vopsita sau aluminiu.</p>
                <h3>Componente sistem pluvial</h3>
                <ul>
                    <li>Jgheaburi semicirculare si rectangulare</li>
                    <li>Burlane in diverse diametre</li>
                    <li>Colturi, racorduri si accesorii de montaj</li>
                    <li>Sisteme de prindere si suporti</li>
                </ul>',
            'related' => [
                ['slug' => '/tigla-metalica', 'name' => 'Tigla metalica'],
                ['slug' => '/accesorii-acoperis', 'name' => 'Accesorii acoperis'],
            ],
        ],
    ];

    public function show(array $params, array $route): void
    {
        $slug = $params['categorie'] ?? basename(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH));
        $data = $this->categoryData[$slug] ?? null;
        $name = $data['name'] ?? $this->slugToName($slug);

        View::render('pages/category', [
            'pageTitle' => $route['title'] ?? ($name . ' - BDM Systems | acoperisuri.info'),
            'pageDescription' => $route['description'] ?? ($data['description'] ?? 'Produse din categoria ' . $name),
            'categorySlug' => $slug,
            'categoryName' => $name,
            'categoryData' => $data,
            'breadcrumbs' => [
                ['label' => $name],
            ],
        ]);
    }

    public function subcategory(array $params, array $route): void
    {
        $catSlug = $params['categorie'] ?? 'categorie';
        $subSlug = $params['subcategorie'] ?? 'subcategorie';
        $catData = $this->categoryData[$catSlug] ?? null;
        $catName = $catData['name'] ?? $this->slugToName($catSlug);
        $subName = $this->slugToName($subSlug);

        View::render('pages/subcategory', [
            'pageTitle' => $subName . ' - ' . $catName . ' - BDM Systems',
            'pageDescription' => 'Produse ' . $subName . ' din categoria ' . $catName,
            'categorySlug' => $catSlug,
            'categoryName' => $catName,
            'subcategorySlug' => $subSlug,
            'subcategoryName' => $subName,
            'breadcrumbs' => [
                ['label' => $catName, 'url' => '/' . $catSlug],
                ['label' => $subName],
            ],
        ]);
    }

    private function slugToName(string $slug): string
    {
        return ucwords(str_replace('-', ' ', $slug));
    }
}
