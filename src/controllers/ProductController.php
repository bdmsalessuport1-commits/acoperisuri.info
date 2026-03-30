<?php

namespace App\Controllers;

use App\Helpers\View;

class ProductController
{
    private array $productData = [
        'budmat-venecja' => [
            'name' => 'Budmat Venecja',
            'tagline' => 'Profil de tigla metalica cu aspect clasic mediteranean si performanta superioara.',
            'brand' => 'Budmat',
            'category' => ['slug' => 'tigla-metalica', 'name' => 'Tigla metalica'],
            'subcategory' => ['slug' => 'budmat', 'name' => 'Budmat'],
            'specs' => [
                'Grosime tabla' => '0.50 mm',
                'Latime utila' => '1170 mm',
                'Latime totala' => '1190 mm',
                'Inaltime val' => '30 mm',
                'Lungime' => 'la comanda (0.5 - 8.0 m)',
                'Acoperire utila' => '1.17 mp/ml',
                'Greutate' => '4.65 kg/mp',
                'Numar valuri' => '8',
                'Pasul tiglei' => '350 mm',
            ],
            'materials' => [
                'Mat' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Verde mat', 'code' => 'RAL 6020', 'color' => '#2e3a23'],
                    ['name' => 'Rosu mat', 'code' => 'RAL 3009', 'color' => '#6d332b'],
                    ['name' => 'Gri grafit', 'code' => 'RAL 7024', 'color' => '#474a51'],
                ],
                'Structurat' => [
                    ['name' => 'Negru structurat', 'code' => 'RAL 9005', 'color' => '#111111'],
                    ['name' => 'Maro structurat', 'code' => 'RAL 8017', 'color' => '#4a3732'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#313638'],
                    ['name' => 'Rosu structurat', 'code' => 'RAL 3005', 'color' => '#5e2028'],
                ],
                'Lucios' => [
                    ['name' => 'Alb lucios', 'code' => 'RAL 9003', 'color' => '#f4f4f4'],
                    ['name' => 'Maro lucios', 'code' => 'RAL 8017', 'color' => '#503830'],
                    ['name' => 'Rosu lucios', 'code' => 'RAL 3011', 'color' => '#792b2b'],
                    ['name' => 'Verde lucios', 'code' => 'RAL 6005', 'color' => '#1a3a1a'],
                    ['name' => 'Albastru lucios', 'code' => 'RAL 5010', 'color' => '#0e4a8a'],
                ],
            ],
            'warranty' => 'Garantie 30 de ani impotriva perforarii prin coroziune. Garantie 10 ani stabilitate culoare.',
            'description' => '<h2>Tigla metalica Budmat Venecja</h2>
                <p>Budmat Venecja este un profil de tigla metalica cu aspect clasic mediteranean, ce confera acoperisului un look elegant si rafinat. Profilul reproduce fidel aspectul tiglei ceramice traditionale.</p>
                <h3>Caracteristici principale</h3>
                <ul>
                    <li>Profil cu 8 valuri pentru aspect clasic</li>
                    <li>Tabla de otel zincat cu strat de protectie polimerica</li>
                    <li>Disponibila in finisaj mat, structurat si lucios</li>
                    <li>Montaj rapid si economic</li>
                    <li>Rezistenta excelenta la coroziune si UV</li>
                </ul>
                <h3>Aplicatii recomandate</h3>
                <p>Ideala pentru case rezidentiale, vile si cladiri cu acoperis in panta intre 14 si 90 de grade. Se recomanda montajul pe sipci metalice sau din lemn.</p>',
            'related' => [
                ['slug' => 'budmat-bella-sara', 'name' => 'Bella Sara', 'brand' => 'Budmat'],
                ['slug' => 'budmat-como', 'name' => 'Como', 'brand' => 'Budmat'],
                ['slug' => 'metigla-elit', 'name' => 'Elit', 'brand' => 'Metigla'],
                ['slug' => 'metigla-star', 'name' => 'Star', 'brand' => 'Metigla'],
            ],
        ],
        'metigla-elit' => [
            'name' => 'Metigla Elit',
            'tagline' => 'Tigla metalica cu profil elegant si design modern, fabricata in Romania.',
            'brand' => 'Metigla',
            'category' => ['slug' => 'tigla-metalica', 'name' => 'Tigla metalica'],
            'subcategory' => ['slug' => 'metigla', 'name' => 'Metigla'],
            'specs' => [
                'Grosime tabla' => '0.50 mm',
                'Latime utila' => '1150 mm',
                'Latime totala' => '1180 mm',
                'Inaltime val' => '35 mm',
                'Lungime' => 'la comanda (0.5 - 7.5 m)',
                'Acoperire utila' => '1.15 mp/ml',
                'Greutate' => '4.80 kg/mp',
                'Numar valuri' => '7',
                'Pasul tiglei' => '400 mm',
            ],
            'materials' => [
                'Mat' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Rosu mat', 'code' => 'RAL 3009', 'color' => '#6d332b'],
                    ['name' => 'Gri grafit', 'code' => 'RAL 7024', 'color' => '#474a51'],
                ],
                'PVDF' => [
                    ['name' => 'Negru PVDF', 'code' => 'RAL 9005', 'color' => '#0d0d0d'],
                    ['name' => 'Maro PVDF', 'code' => 'RAL 8017', 'color' => '#48352f'],
                    ['name' => 'Gri PVDF', 'code' => 'RAL 7016', 'color' => '#2d3436'],
                ],
                'Lucios' => [
                    ['name' => 'Maro lucios', 'code' => 'RAL 8017', 'color' => '#503830'],
                    ['name' => 'Rosu lucios', 'code' => 'RAL 3011', 'color' => '#792b2b'],
                    ['name' => 'Verde lucios', 'code' => 'RAL 6005', 'color' => '#1a3a1a'],
                ],
            ],
            'warranty' => 'Garantie 30 de ani impotriva perforarii. Garantie 15 ani stabilitate culoare pe finisaj PVDF.',
            'description' => '<h2>Tigla metalica Metigla Elit</h2>
                <p>Metigla Elit este un profil premium de tigla metalica fabricat in Romania, cu un design modern si performante tehnice de top.</p>
                <h3>Avantaje Metigla Elit</h3>
                <ul>
                    <li>Fabricata in Romania - termene scurte de livrare</li>
                    <li>Profil elegant cu 7 valuri</li>
                    <li>Disponibila cu finisaj PVDF pentru durabilitate maxima</li>
                    <li>Rezistenta superioara la UV si intemperii</li>
                </ul>',
            'related' => [
                ['slug' => 'metigla-star', 'name' => 'Star', 'brand' => 'Metigla'],
                ['slug' => 'metigla-mira', 'name' => 'Mira', 'brand' => 'Metigla'],
                ['slug' => 'budmat-venecja', 'name' => 'Venecja', 'brand' => 'Budmat'],
                ['slug' => 'budmat-bella-sara', 'name' => 'Bella Sara', 'brand' => 'Budmat'],
            ],
        ],
    ];

    public function show(array $params, array $route): void
    {
        $slug = $params['slug'] ?? 'produs';
        $data = $this->productData[$slug] ?? null;
        $name = $data['name'] ?? ucwords(str_replace('-', ' ', $slug));

        View::render('pages/product', [
            'pageTitle' => ($data ? $data['name'] . ' - ' . $data['brand'] : $name) . ' | BDM Systems',
            'pageDescription' => $data['tagline'] ?? 'Detalii produs ' . $name,
            'productSlug' => $slug,
            'productName' => $name,
            'product' => $data,
            'breadcrumbs' => $data ? [
                ['label' => $data['category']['name'], 'url' => '/' . $data['category']['slug']],
                ['label' => $data['subcategory']['name'], 'url' => '/' . $data['category']['slug'] . '/' . $data['subcategory']['slug']],
                ['label' => $data['name']],
            ] : [
                ['label' => $name],
            ],
        ]);
    }
}
