<?php
/**
 * Batch script: Add Riwega membrane products
 * Restructures Folii anticondens category with proper Riwega subcategories
 */

$basePath = dirname(__DIR__);
$subsFile = $basePath . '/data/subcategories.json';
$prodsFile = $basePath . '/data/products.json';

$subcategories = json_decode(file_get_contents($subsFile), true);
$products = json_decode(file_get_contents($prodsFile), true);

$maxSubId = max(array_column($subcategories, 'id'));
$maxProdId = max(array_column($products, 'id'));

// Remove old "Folii Riwega" subcat (id=17) - we'll replace with proper subcategories
// Keep "Folii BDM Systems" (id=16)
// Update existing product 44 (Riwega USB Reflex 200) to new subcategory

// ============================================================
// NEW SUBCATEGORIES under category_id 6 (Folii anticondens)
// ============================================================
$newSubcategories = [
    [
        'id' => ++$maxSubId, // 44
        'category_id' => 6,
        'name' => 'Membrane difuzie acoperis',
        'slug' => 'membrane-difuzie-acoperis',
        'description' => 'Membrane de difuzie pentru acoperis Riwega - protectie impotriva apei si vantului',
        'image' => '',
        'icon' => '&#9650;',
        'count' => 8,
        'sort_order' => 3,
        'is_active' => true,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ],
    [
        'id' => ++$maxSubId, // 45
        'category_id' => 6,
        'name' => 'Membrane control vapori',
        'slug' => 'membrane-control-vapori',
        'description' => 'Membrane de control vapori Riwega - regleaza migrarea vaporilor pentru evitarea condensului',
        'image' => '',
        'icon' => '&#128167;',
        'count' => 4,
        'sort_order' => 4,
        'is_active' => true,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ],
    [
        'id' => ++$maxSubId, // 46
        'category_id' => 6,
        'name' => 'Bariere de vapori',
        'slug' => 'bariere-vapori',
        'description' => 'Bariere de vapori Riwega - opresc complet trecerea vaporilor de apa',
        'image' => '',
        'icon' => '&#128683;',
        'count' => 3,
        'sort_order' => 5,
        'is_active' => true,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ],
    [
        'id' => ++$maxSubId, // 47
        'category_id' => 6,
        'name' => 'Membrane fatada',
        'slug' => 'membrane-fatada',
        'description' => 'Membrane de difuzie pentru fatade ventilate Riwega - protectie UV si rezistenta la vant',
        'image' => '',
        'icon' => '&#127970;',
        'count' => 2,
        'sort_order' => 6,
        'is_active' => true,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ],
    [
        'id' => ++$maxSubId, // 48
        'category_id' => 6,
        'name' => 'Covoare tabla faltuita',
        'slug' => 'covoare-tabla-faltuita',
        'description' => 'Covoare separator si ventilatie Riwega pentru tabla faltuita',
        'image' => '',
        'icon' => '&#9638;',
        'count' => 2,
        'sort_order' => 7,
        'is_active' => true,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ],
    [
        'id' => ++$maxSubId, // 49
        'category_id' => 6,
        'name' => 'Membrane autoadezive',
        'slug' => 'membrane-autoadezive',
        'description' => 'Membrane autoadezive Riwega - etanseizare rapida fara adeziv suplimentar',
        'image' => '',
        'icon' => '&#128204;',
        'count' => 3,
        'sort_order' => 8,
        'is_active' => true,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ],
];

// Subcategory IDs for reference
$subMembraneAcoperis = $maxSubId - 5; // 44
$subControlVapori    = $maxSubId - 4; // 45
$subBariereVapori    = $maxSubId - 3; // 46
$subFatada           = $maxSubId - 2; // 47
$subCovoare          = $maxSubId - 1; // 48
$subAutoadezive      = $maxSubId;     // 49

// Update old subcat 17 (Folii Riwega) - rename it and keep for the existing product
foreach ($subcategories as &$sub) {
    if ($sub['id'] === 17) {
        $sub['name'] = 'Folii Riwega';
        $sub['count'] = 0; // will be removed, product moved
        $sub['is_active'] = false;
    }
}
unset($sub);

// Move existing product 44 (Riwega USB Reflex 200) to new subcategory
foreach ($products as &$prod) {
    if ($prod['id'] === 44) {
        $prod['subcategory_id'] = $subMembraneAcoperis;
        $prod['name'] = 'Riwega USB Reflex Plus';
        $prod['slug'] = 'riwega-usb-reflex-plus';
    }
}
unset($prod);

// ============================================================
// NEW PRODUCTS
// ============================================================
$now = date('Y-m-d H:i:s');

$newProducts = [];

// --- MEMBRANE DIFUZIE ACOPERIS (subcat 44) ---

// 1. USB Protector GOLD 330
$newProducts[] = [
    'id' => ++$maxProdId,
    'name' => 'Riwega USB Protector GOLD 330',
    'subtitle' => 'Membrana premium de difuzie 340 g/m², Sd=0.1m, garantie 30 ani. Cea mai performanta din gama Protector.',
    'slug' => 'riwega-usb-protector-gold-330',
    'category_id' => 6,
    'subcategory_id' => $subMembraneAcoperis,
    'manufacturer' => 'Riwega',
    'status' => 'activ',
    'image_main' => '', 'image_schema' => '', 'gallery' => [],
    'specs' => [
        ['key' => 'Greutate', 'value' => '340 g/m²', 'sort_order' => 1],
        ['key' => 'Material', 'value' => 'PET compozit', 'sort_order' => 2],
        ['key' => 'Microfilm', 'value' => 'UV 50 PUR monolitic', 'sort_order' => 3],
        ['key' => 'Sd', 'value' => '0,1 m', 'sort_order' => 4],
        ['key' => 'Grosime', 'value' => '0,85 mm', 'sort_order' => 5],
        ['key' => 'Stabilitate UV', 'value' => '12 luni', 'sort_order' => 6],
        ['key' => 'Temperatura', 'value' => '-40°C / +120°C', 'sort_order' => 7],
        ['key' => 'Dimensiuni rola', 'value' => '1,5 m x 40 m', 'sort_order' => 8],
        ['key' => 'Garantie', 'value' => '30 ani', 'sort_order' => 9],
    ],
    'materials' => [],
    'warranty_text' => 'Garantie producator Riwega 30 ani. Membrana premium cu microfilm PUR monolitic.',
    'description_html' => '<h2>Riwega USB Protector GOLD 330</h2><p>Cea mai performanta membrana de difuzie din gama Protector. Cu un microfilm monolitic elastic din poliuretan si greutate de 340 g/m², ofera protectie de durata impotriva apei si vantului, permitand in acelasi timp trecerea vaporilor.</p><ul><li>Microfilm monolitic PUR - fara micropori, impermeabilitate absoluta</li><li>Stabilitate UV 12 luni - permite montaj fara graba</li><li>Doua benzi adezive integrate</li><li>Compatibil cu panouri fotovoltaice</li><li>Garantie 30 ani</li></ul>',
    'seo_title' => '', 'seo_description' => '',
    'related_products' => ['riwega-usb-protector-silver-230', 'riwega-usb-reflex-plus'],
    'sort_order' => 1, 'is_active' => true,
    'created_at' => $now, 'updated_at' => $now
];

// 2. USB Protector SILVER 230
$newProducts[] = [
    'id' => ++$maxProdId,
    'name' => 'Riwega USB Protector SILVER 230',
    'subtitle' => 'Membrana premium de difuzie 230 g/m², Sd=0.1m, garantie 30 ani. Aceeasi excelenta, greutate mai mica.',
    'slug' => 'riwega-usb-protector-silver-230',
    'category_id' => 6,
    'subcategory_id' => $subMembraneAcoperis,
    'manufacturer' => 'Riwega',
    'status' => 'activ',
    'image_main' => '', 'image_schema' => '', 'gallery' => [],
    'specs' => [
        ['key' => 'Greutate', 'value' => '230 g/m²', 'sort_order' => 1],
        ['key' => 'Material', 'value' => 'PET compozit', 'sort_order' => 2],
        ['key' => 'Microfilm', 'value' => 'UV 50 PUR monolitic', 'sort_order' => 3],
        ['key' => 'Sd', 'value' => '0,1 m', 'sort_order' => 4],
        ['key' => 'Grosime', 'value' => '0,7 mm', 'sort_order' => 5],
        ['key' => 'Stabilitate UV', 'value' => '12 luni', 'sort_order' => 6],
        ['key' => 'Temperatura', 'value' => '-40°C / +120°C', 'sort_order' => 7],
        ['key' => 'Dimensiuni rola', 'value' => '1,5 m x 40 m', 'sort_order' => 8],
        ['key' => 'Garantie', 'value' => '30 ani', 'sort_order' => 9],
    ],
    'materials' => [],
    'warranty_text' => 'Garantie producator Riwega 30 ani.',
    'description_html' => '<h2>Riwega USB Protector SILVER 230</h2><p>Aceeasi excelenta ca GOLD 330, cu o greutate mai mica. Membrana de difuzie premium cu microfilm monolitic PUR, ideala pentru acoperisuri rezidentiale si comerciale.</p><ul><li>Cea mai usoara din gama Protector</li><li>Microfilm monolitic PUR - impermeabilitate absoluta</li><li>Stabilitate UV 12 luni</li><li>Doua benzi adezive integrate</li><li>Compatibil cu panouri fotovoltaice</li></ul>',
    'seo_title' => '', 'seo_description' => '',
    'related_products' => ['riwega-usb-protector-gold-330', 'riwega-usb-classic'],
    'sort_order' => 2, 'is_active' => true,
    'created_at' => $now, 'updated_at' => $now
];

// 3. USB Weld AS
$newProducts[] = [
    'id' => ++$maxProdId,
    'name' => 'Riwega USB Weld AS',
    'subtitle' => 'Membrana sudabila 345 g/m², Sd=0.3m. Etansare perfecta la suprapuneri si imbinari transversale.',
    'slug' => 'riwega-usb-weld-as',
    'category_id' => 6,
    'subcategory_id' => $subMembraneAcoperis,
    'manufacturer' => 'Riwega',
    'status' => 'activ',
    'image_main' => '', 'image_schema' => '', 'gallery' => [],
    'specs' => [
        ['key' => 'Greutate', 'value' => '345 g/m²', 'sort_order' => 1],
        ['key' => 'Material', 'value' => 'PU.PET.PU', 'sort_order' => 2],
        ['key' => 'Sd', 'value' => '0,3 m', 'sort_order' => 3],
        ['key' => 'Grosime', 'value' => '0,9 mm', 'sort_order' => 4],
        ['key' => 'Stabilitate UV', 'value' => '3 luni', 'sort_order' => 5],
        ['key' => 'Temperatura', 'value' => '-40°C / +90°C', 'sort_order' => 6],
        ['key' => 'Dimensiuni rola', 'value' => '1,5 m / 3 m x 30 m', 'sort_order' => 7],
        ['key' => 'Panta minima', 'value' => '5°', 'sort_order' => 8],
    ],
    'materials' => [],
    'warranty_text' => 'Garantie producator Riwega. Membrana sudabila la cald sau la rece.',
    'description_html' => '<h2>Riwega USB Weld AS</h2><p>Membrana speciala care se sudeaza la cald sau la rece, asigurand etansare perfecta la suprapuneri si imbinari transversale. Suprafata anti-alunecare pentru siguranta la montaj.</p><ul><li>Sudabila la cald sau la rece</li><li>Suprafata anti-alunecare</li><li>Folie dubla PU</li><li>Panta minima 5°</li></ul>',
    'seo_title' => '', 'seo_description' => '',
    'related_products' => ['riwega-usb-protector-gold-330'],
    'sort_order' => 3, 'is_active' => true,
    'created_at' => $now, 'updated_at' => $now
];

// 4. USB Classic
$newProducts[] = [
    'id' => ++$maxProdId,
    'name' => 'Riwega USB Classic',
    'subtitle' => 'Etalonul membranelor europene - 185 g/m², Sd=0.07m, garantie 20 ani.',
    'slug' => 'riwega-usb-classic',
    'category_id' => 6,
    'subcategory_id' => $subMembraneAcoperis,
    'manufacturer' => 'Riwega',
    'status' => 'activ',
    'image_main' => '', 'image_schema' => '', 'gallery' => [],
    'specs' => [
        ['key' => 'Greutate', 'value' => '185 g/m²', 'sort_order' => 1],
        ['key' => 'Material', 'value' => 'PP compozit', 'sort_order' => 2],
        ['key' => 'Microfilm', 'value' => 'UV 10 Bikom', 'sort_order' => 3],
        ['key' => 'Sd', 'value' => '0,07 m', 'sort_order' => 4],
        ['key' => 'Grosime', 'value' => '0,89 mm', 'sort_order' => 5],
        ['key' => 'Stabilitate UV', 'value' => '6 luni', 'sort_order' => 6],
        ['key' => 'Temperatura', 'value' => '-40°C / +100°C', 'sort_order' => 7],
        ['key' => 'Dimensiuni rola', 'value' => '1,5 m / 3 m x 50 m', 'sort_order' => 8],
        ['key' => 'Garantie', 'value' => '20 ani', 'sort_order' => 9],
    ],
    'materials' => [],
    'warranty_text' => 'Garantie producator Riwega 20 ani.',
    'description_html' => '<h2>Riwega USB Classic</h2><p>Etalonul membranelor de difuzie europene. Cu peste 20 de ani pe piata, USB Classic este alegerea de incredere pentru acoperisuri de calitate.</p><ul><li>Standard de referinta in industrie</li><li>Doua benzi adezive integrate</li><li>Stabilitate UV 6 luni</li><li>Disponibila in latime 1,5 m si 3 m</li></ul>',
    'seo_title' => '', 'seo_description' => '',
    'related_products' => ['riwega-usb-elefant', 'riwega-usb-reflex-plus'],
    'sort_order' => 4, 'is_active' => true,
    'created_at' => $now, 'updated_at' => $now
];

// 5. USB Elefant
$newProducts[] = [
    'id' => ++$maxProdId,
    'name' => 'Riwega USB Elefant',
    'subtitle' => 'Membrana groasa si rezistenta 250 g/m², Sd=0.07m, garantie 20 ani. Robustete maxima.',
    'slug' => 'riwega-usb-elefant',
    'category_id' => 6,
    'subcategory_id' => $subMembraneAcoperis,
    'manufacturer' => 'Riwega',
    'status' => 'activ',
    'image_main' => '', 'image_schema' => '', 'gallery' => [],
    'specs' => [
        ['key' => 'Greutate', 'value' => '250 g/m²', 'sort_order' => 1],
        ['key' => 'Material', 'value' => 'PP compozit', 'sort_order' => 2],
        ['key' => 'Microfilm', 'value' => 'UV 10 Bikom', 'sort_order' => 3],
        ['key' => 'Sd', 'value' => '0,07 m', 'sort_order' => 4],
        ['key' => 'Grosime', 'value' => '1,05 mm', 'sort_order' => 5],
        ['key' => 'Stabilitate UV', 'value' => '6 luni', 'sort_order' => 6],
        ['key' => 'Temperatura', 'value' => '-40°C / +100°C', 'sort_order' => 7],
        ['key' => 'Dimensiuni rola', 'value' => '1,5 m / 3 m x 30-40 m', 'sort_order' => 8],
        ['key' => 'Garantie', 'value' => '20 ani', 'sort_order' => 9],
    ],
    'materials' => [],
    'warranty_text' => 'Garantie producator Riwega 20 ani.',
    'description_html' => '<h2>Riwega USB Elefant</h2><p>Groasa, aspra si rezistenta. USB Elefant este membrana ideala pentru conditii dificile de montaj si solicitari mecanice ridicate.</p><ul><li>Grosime 1,05 mm - cea mai groasa din gama</li><li>Rezistenta mecanica superioara</li><li>Doua benzi adezive integrate</li><li>Garantie 20 ani</li></ul>',
    'seo_title' => '', 'seo_description' => '',
    'related_products' => ['riwega-usb-classic', 'riwega-usb-protector-gold-330'],
    'sort_order' => 5, 'is_active' => true,
    'created_at' => $now, 'updated_at' => $now
];

// 6. DO 155
$newProducts[] = [
    'id' => ++$maxProdId,
    'name' => 'Riwega DO 155',
    'subtitle' => 'Membrana economica PP 100%, 155 g/m², Sd=0.02m. Solutie accesibila cu performante solide.',
    'slug' => 'riwega-do-155',
    'category_id' => 6,
    'subcategory_id' => $subMembraneAcoperis,
    'manufacturer' => 'Riwega',
    'status' => 'activ',
    'image_main' => '', 'image_schema' => '', 'gallery' => [],
    'specs' => [
        ['key' => 'Greutate', 'value' => '155 g/m²', 'sort_order' => 1],
        ['key' => 'Material', 'value' => 'PP.PP.PP (100% reciclabil)', 'sort_order' => 2],
        ['key' => 'Sd', 'value' => '0,02 m', 'sort_order' => 3],
        ['key' => 'Grosime', 'value' => '0,60 mm', 'sort_order' => 4],
        ['key' => 'Stabilitate UV', 'value' => '2 luni', 'sort_order' => 5],
        ['key' => 'Temperatura', 'value' => '-40°C / +90°C', 'sort_order' => 6],
        ['key' => 'Dimensiuni rola', 'value' => '1,5 m x 50 m', 'sort_order' => 7],
    ],
    'materials' => [],
    'warranty_text' => 'Garantie producator Riwega.',
    'description_html' => '<h2>Riwega DO 155</h2><p>Solutia din polipropilena 100% reciclabila cu greutate redusa. Suprafata antiderapanta si doua benzi adezive integrate.</p><ul><li>PP 100% reciclabil</li><li>Suprafata antiderapanta</li><li>Doua benzi adezive integrate</li><li>Raport excelent calitate-pret</li></ul>',
    'seo_title' => '', 'seo_description' => '',
    'related_products' => ['riwega-do-135', 'riwega-usb-classic'],
    'sort_order' => 6, 'is_active' => true,
    'created_at' => $now, 'updated_at' => $now
];

// 7. DO 135
$newProducts[] = [
    'id' => ++$maxProdId,
    'name' => 'Riwega DO 135',
    'subtitle' => 'Membrana economica PP 100%, 143 g/m², Sd=0.02m. Cea mai usoara din gama Eurostandard.',
    'slug' => 'riwega-do-135',
    'category_id' => 6,
    'subcategory_id' => $subMembraneAcoperis,
    'manufacturer' => 'Riwega',
    'status' => 'activ',
    'image_main' => '', 'image_schema' => '', 'gallery' => [],
    'specs' => [
        ['key' => 'Greutate', 'value' => '143 g/m²', 'sort_order' => 1],
        ['key' => 'Material', 'value' => 'PP.PP.PP (100% reciclabil)', 'sort_order' => 2],
        ['key' => 'Sd', 'value' => '0,02 m', 'sort_order' => 3],
        ['key' => 'Grosime', 'value' => '0,50 mm', 'sort_order' => 4],
        ['key' => 'Stabilitate UV', 'value' => '2 luni', 'sort_order' => 5],
        ['key' => 'Temperatura', 'value' => '-40°C / +90°C', 'sort_order' => 6],
        ['key' => 'Dimensiuni rola', 'value' => '1,5 m x 50 m', 'sort_order' => 7],
    ],
    'materials' => [],
    'warranty_text' => 'Garantie producator Riwega.',
    'description_html' => '<h2>Riwega DO 135</h2><p>Cea mai usoara membrana din gama Eurostandard. Potrivita pentru acoperisuri, pereti si etansare la vant a fatadelor ventilate.</p><ul><li>PP 100% reciclabil</li><li>Greutate foarte redusa</li><li>Suprafata antiderapanta</li></ul>',
    'seo_title' => '', 'seo_description' => '',
    'related_products' => ['riwega-do-155', 'riwega-usb-classic'],
    'sort_order' => 7, 'is_active' => true,
    'created_at' => $now, 'updated_at' => $now
];

// --- MEMBRANE CONTROL VAPORI (subcat 45) ---

// 8. USB Micro Strong
$newProducts[] = [
    'id' => ++$maxProdId,
    'name' => 'Riwega USB Micro Strong',
    'subtitle' => 'Membrana control vapori 230 g/m², Sd>2m. Rezistenta mecanica de varf.',
    'slug' => 'riwega-usb-micro-strong',
    'category_id' => 6,
    'subcategory_id' => $subControlVapori,
    'manufacturer' => 'Riwega',
    'status' => 'activ',
    'image_main' => '', 'image_schema' => '', 'gallery' => [],
    'specs' => [
        ['key' => 'Greutate', 'value' => '230 g/m²', 'sort_order' => 1],
        ['key' => 'Material', 'value' => 'PP.PP.PP', 'sort_order' => 2],
        ['key' => 'Sd', 'value' => '> 2 m', 'sort_order' => 3],
        ['key' => 'Grosime', 'value' => '1,06 mm', 'sort_order' => 4],
        ['key' => 'Stabilitate UV', 'value' => '4 luni', 'sort_order' => 5],
        ['key' => 'Temperatura', 'value' => '-40°C / +100°C', 'sort_order' => 6],
        ['key' => 'Dimensiuni rola', 'value' => '1,5 m x 50 m', 'sort_order' => 7],
    ],
    'materials' => [],
    'warranty_text' => 'Garantie producator Riwega.',
    'description_html' => '<h2>Riwega USB Micro Strong</h2><p>Rezistenta mecanica de varf. Poate fi folosita ca hidroizolatie temporara pe santier datorita rezistentei extreme la smulgere si abraziune.</p><ul><li>Cea mai rezistenta din gama Micro</li><li>Grosime 1,06 mm</li><li>Rezistenta optima la abraziune</li><li>Hidroizolatie temporara pe santier</li></ul>',
    'seo_title' => '', 'seo_description' => '',
    'related_products' => ['riwega-usb-micro', 'riwega-usb-micro-light'],
    'sort_order' => 1, 'is_active' => true,
    'created_at' => $now, 'updated_at' => $now
];

// 9. USB Micro
$newProducts[] = [
    'id' => ++$maxProdId,
    'name' => 'Riwega USB Micro',
    'subtitle' => 'Membrana control vapori 155 g/m², Sd>2m. Prima membrana din gama, raport calitate-pret optim.',
    'slug' => 'riwega-usb-micro',
    'category_id' => 6,
    'subcategory_id' => $subControlVapori,
    'manufacturer' => 'Riwega',
    'status' => 'activ',
    'image_main' => '', 'image_schema' => '', 'gallery' => [],
    'specs' => [
        ['key' => 'Greutate', 'value' => '155 g/m²', 'sort_order' => 1],
        ['key' => 'Material', 'value' => 'PP.PP.PP', 'sort_order' => 2],
        ['key' => 'Sd', 'value' => '> 2 m', 'sort_order' => 3],
        ['key' => 'Grosime', 'value' => '0,78 mm', 'sort_order' => 4],
        ['key' => 'Stabilitate UV', 'value' => '4 luni', 'sort_order' => 5],
        ['key' => 'Temperatura', 'value' => '-40°C / +100°C', 'sort_order' => 6],
        ['key' => 'Dimensiuni rola', 'value' => '1,5 m / 3 m x 50 m', 'sort_order' => 7],
    ],
    'materials' => [],
    'warranty_text' => 'Garantie producator Riwega.',
    'description_html' => '<h2>Riwega USB Micro</h2><p>Prima membrana de control vapori din gama Riwega, cu peste 20 de ani de experienta pe piata. Raport optim calitate-pret si rezistenta mecanica ridicata.</p><ul><li>Peste 20 ani pe piata</li><li>Raport excelent calitate-pret</li><li>Disponibila in latime 1,5 m si 3 m</li></ul>',
    'seo_title' => '', 'seo_description' => '',
    'related_products' => ['riwega-usb-micro-strong', 'riwega-usb-micro-light'],
    'sort_order' => 2, 'is_active' => true,
    'created_at' => $now, 'updated_at' => $now
];

// 10. USB Micro Light
$newProducts[] = [
    'id' => ++$maxProdId,
    'name' => 'Riwega USB Micro Light',
    'subtitle' => 'Membrana control vapori interior 120 g/m², Sd=10m. Usoara, flexibila, semi-transparenta.',
    'slug' => 'riwega-usb-micro-light',
    'category_id' => 6,
    'subcategory_id' => $subControlVapori,
    'manufacturer' => 'Riwega',
    'status' => 'activ',
    'image_main' => '', 'image_schema' => '', 'gallery' => [],
    'specs' => [
        ['key' => 'Greutate', 'value' => '120 g/m²', 'sort_order' => 1],
        ['key' => 'Material', 'value' => 'PP.PE.PP', 'sort_order' => 2],
        ['key' => 'Sd', 'value' => '10 m', 'sort_order' => 3],
        ['key' => 'Grosime', 'value' => '0,57 mm', 'sort_order' => 4],
        ['key' => 'Stabilitate UV', 'value' => '4 luni', 'sort_order' => 5],
        ['key' => 'Temperatura', 'value' => '-40°C / +100°C', 'sort_order' => 6],
        ['key' => 'Dimensiuni rola', 'value' => '1,5 m / 3 m x 50 m', 'sort_order' => 7],
    ],
    'materials' => [],
    'warranty_text' => 'Garantie producator Riwega.',
    'description_html' => '<h2>Riwega USB Micro Light</h2><p>Solutia usoara si flexibila pentru interior. Semi-transparenta, regleaza transferul vaporilor si asigura etanseitate perfecta la aer.</p><ul><li>Aplicatie interior (pereti si tavane din lemn)</li><li>Semi-transparenta</li><li>Usoara si flexibila</li><li>Disponibila in latime 1,5 m si 3 m</li></ul>',
    'seo_title' => '', 'seo_description' => '',
    'related_products' => ['riwega-usb-micro', 'riwega-micro-200-vario'],
    'sort_order' => 3, 'is_active' => true,
    'created_at' => $now, 'updated_at' => $now
];

// 11. Micro 200 Vario V7
$newProducts[] = [
    'id' => ++$maxProdId,
    'name' => 'Riwega Micro 200 Vario V7',
    'subtitle' => 'Membrana higrometrie variabila 200 g/m², Sd=0.2-7m. Se adapteaza sezonier la umiditate.',
    'slug' => 'riwega-micro-200-vario',
    'category_id' => 6,
    'subcategory_id' => $subControlVapori,
    'manufacturer' => 'Riwega',
    'status' => 'activ',
    'image_main' => '', 'image_schema' => '', 'gallery' => [],
    'specs' => [
        ['key' => 'Greutate', 'value' => '200 g/m²', 'sort_order' => 1],
        ['key' => 'Material', 'value' => 'PP.PA.PP (poliamida)', 'sort_order' => 2],
        ['key' => 'Sd', 'value' => '0,2 - 7 m (variabil)', 'sort_order' => 3],
        ['key' => 'Grosime', 'value' => '0,90 mm', 'sort_order' => 4],
        ['key' => 'Stabilitate UV', 'value' => '3 luni', 'sort_order' => 5],
        ['key' => 'Temperatura', 'value' => '-40°C / +80°C', 'sort_order' => 6],
        ['key' => 'Dimensiuni rola', 'value' => '1,5 m x 50 m', 'sort_order' => 7],
    ],
    'materials' => [],
    'warranty_text' => 'Garantie producator Riwega.',
    'description_html' => '<h2>Riwega Micro 200 Vario V7</h2><p>Prima membrana cu greutate ridicata si proprietati higrometrice variabile. Valoarea Sd se adapteaza sezonier, permitand uscarea catre interior vara.</p><ul><li>Higrometrie variabila (Sd 0,2 - 7 m)</li><li>Permite uscarea constructiei vara</li><li>Microfilm din poliamida (PA)</li><li>Compatibila cu suprafete din beton</li></ul>',
    'seo_title' => '', 'seo_description' => '',
    'related_products' => ['riwega-usb-micro-strong', 'riwega-usb-micro'],
    'sort_order' => 4, 'is_active' => true,
    'created_at' => $now, 'updated_at' => $now
];

// --- BARIERE DE VAPORI (subcat 46) ---

// 12. DS 188 ALU
$newProducts[] = [
    'id' => ++$maxProdId,
    'name' => 'Riwega DS 188 ALU',
    'subtitle' => 'Bariera vapori reflexiva cu aluminiu, Sd=200m, garantie 10 ani. Cea mai performanta bariera.',
    'slug' => 'riwega-ds-188-alu',
    'category_id' => 6,
    'subcategory_id' => $subBariereVapori,
    'manufacturer' => 'Riwega',
    'status' => 'activ',
    'image_main' => '', 'image_schema' => '', 'gallery' => [],
    'specs' => [
        ['key' => 'Greutate', 'value' => '170 g/m²', 'sort_order' => 1],
        ['key' => 'Material', 'value' => 'PE cu Aluminiu + plasa armare', 'sort_order' => 2],
        ['key' => 'Sd', 'value' => '200 m', 'sort_order' => 3],
        ['key' => 'Grosime', 'value' => '0,30 mm', 'sort_order' => 4],
        ['key' => 'Temperatura', 'value' => '-40°C / +80°C', 'sort_order' => 5],
        ['key' => 'Dimensiuni rola', 'value' => '1,5 m x 50 m', 'sort_order' => 6],
        ['key' => 'Garantie', 'value' => '10 ani', 'sort_order' => 7],
    ],
    'materials' => [],
    'warranty_text' => 'Garantie producator Riwega 10 ani.',
    'description_html' => '<h2>Riwega DS 188 ALU</h2><p>Cea mai performanta bariera de vapori cu efect termoreflexiv din gama Riwega. Suprafata din aluminiu reflecta caldura, minimizand transferul vaporilor.</p><ul><li>Suprafata reflectiva din aluminiu</li><li>Plasa centrala de armare</li><li>Sd = 200 m - oprire aproape completa vapori</li><li>Ideal pentru izolatie termica mansarde</li><li>Garantie 10 ani</li></ul>',
    'seo_title' => '', 'seo_description' => '',
    'related_products' => ['riwega-ds-1500-syn', 'riwega-ds-65-pe'],
    'sort_order' => 1, 'is_active' => true,
    'created_at' => $now, 'updated_at' => $now
];

// 13. DS 1500 SYN
$newProducts[] = [
    'id' => ++$maxProdId,
    'name' => 'Riwega DS 1500 SYN',
    'subtitle' => 'Bariera vapori si radon, Sd>1500m. Certificata anti-radon, 5 straturi cu aluminiu central.',
    'slug' => 'riwega-ds-1500-syn',
    'category_id' => 6,
    'subcategory_id' => $subBariereVapori,
    'manufacturer' => 'Riwega',
    'status' => 'activ',
    'image_main' => '', 'image_schema' => '', 'gallery' => [],
    'specs' => [
        ['key' => 'Greutate', 'value' => '130 g/m²', 'sort_order' => 1],
        ['key' => 'Material', 'value' => 'PP.PE.Alu.PE.PP (5 straturi)', 'sort_order' => 2],
        ['key' => 'Sd', 'value' => '> 1500 m', 'sort_order' => 3],
        ['key' => 'Grosime', 'value' => '0,45 mm', 'sort_order' => 4],
        ['key' => 'Temperatura', 'value' => '-40°C / +100°C', 'sort_order' => 5],
        ['key' => 'Dimensiuni rola', 'value' => '1,5 m x 50 m', 'sort_order' => 6],
    ],
    'materials' => [],
    'warranty_text' => 'Garantie producator Riwega. Certificata bariera anti-radon.',
    'description_html' => '<h2>Riwega DS 1500 SYN</h2><p>Scutul impotriva vaporilor si gazului radon. Bariera certificata cu 5 straturi si aluminiu central, potrivita si pentru montaj sub sape.</p><ul><li>Sd > 1500 m - bariera totala</li><li>Certificata anti-radon</li><li>5 straturi cu aluminiu central</li><li>Potrivita sub sape</li><li>Proprietati reflective</li></ul>',
    'seo_title' => '', 'seo_description' => '',
    'related_products' => ['riwega-ds-188-alu', 'riwega-ds-65-pe'],
    'sort_order' => 2, 'is_active' => true,
    'created_at' => $now, 'updated_at' => $now
];

// 14. DS 65 PE
$newProducts[] = [
    'id' => ++$maxProdId,
    'name' => 'Riwega DS 65 PE',
    'subtitle' => 'Bariera vapori PE 100%, Sd=140m. Multifunctionala, latime 3m, ideala sub sapa.',
    'slug' => 'riwega-ds-65-pe',
    'category_id' => 6,
    'subcategory_id' => $subBariereVapori,
    'manufacturer' => 'Riwega',
    'status' => 'activ',
    'image_main' => '', 'image_schema' => '', 'gallery' => [],
    'specs' => [
        ['key' => 'Greutate', 'value' => '188 g/m²', 'sort_order' => 1],
        ['key' => 'Material', 'value' => 'PE 100% (polietilena)', 'sort_order' => 2],
        ['key' => 'Sd', 'value' => '140 m', 'sort_order' => 3],
        ['key' => 'Grosime', 'value' => '0,20 mm', 'sort_order' => 4],
        ['key' => 'Temperatura', 'value' => '-20°C / +80°C', 'sort_order' => 5],
        ['key' => 'Dimensiuni rola', 'value' => '3 m x 33 m', 'sort_order' => 6],
    ],
    'materials' => [],
    'warranty_text' => 'Garantie producator Riwega.',
    'description_html' => '<h2>Riwega DS 65 PE</h2><p>Bariera multifunctionala si versatila din polietilena 100%. Latimea unica de 3 m faciliteaza instalarea, ideala ca strat separator sub sapa.</p><ul><li>PE 100%</li><li>Latime 3 m - montaj rapid</li><li>Ideala sub sapa ca strat separator</li><li>Etanseitate perfecta la aer</li></ul>',
    'seo_title' => '', 'seo_description' => '',
    'related_products' => ['riwega-ds-188-alu', 'riwega-ds-1500-syn'],
    'sort_order' => 3, 'is_active' => true,
    'created_at' => $now, 'updated_at' => $now
];

// --- MEMBRANE FATADA (subcat 47) ---

// 15. USB Windtop UV 30/160
$newProducts[] = [
    'id' => ++$maxProdId,
    'name' => 'Riwega USB Windtop UV 30/160',
    'subtitle' => 'Membrana fatada UV-rezistenta 160 g/m², Sd=0.14m, garantie 10 ani. Stabila permanent la UV.',
    'slug' => 'riwega-usb-windtop-uv',
    'category_id' => 6,
    'subcategory_id' => $subFatada,
    'manufacturer' => 'Riwega',
    'status' => 'activ',
    'image_main' => '', 'image_schema' => '', 'gallery' => [],
    'specs' => [
        ['key' => 'Greutate', 'value' => '160 g/m²', 'sort_order' => 1],
        ['key' => 'Material', 'value' => 'PUR.PET', 'sort_order' => 2],
        ['key' => 'Microfilm', 'value' => 'UV 50 PUR', 'sort_order' => 3],
        ['key' => 'Sd', 'value' => '0,14 m', 'sort_order' => 4],
        ['key' => 'Grosime', 'value' => '0,50 mm', 'sort_order' => 5],
        ['key' => 'Stabilitate UV', 'value' => 'Permanenta', 'sort_order' => 6],
        ['key' => 'Temperatura', 'value' => '-40°C / +100°C', 'sort_order' => 7],
        ['key' => 'Dimensiuni rola', 'value' => '1,5 m x 50 m', 'sort_order' => 8],
        ['key' => 'Garantie', 'value' => '10 ani', 'sort_order' => 9],
    ],
    'materials' => [],
    'warranty_text' => 'Garantie producator Riwega 10 ani.',
    'description_html' => '<h2>Riwega USB Windtop UV 30/160</h2><p>Protectia care nu se teme de razele UV. Membrana cu stabilitate UV permanenta, ideala pentru fatade ventilate cu rosturi deschise.</p><ul><li>Stabilitate UV permanenta</li><li>Microfilm monolitic PUR</li><li>Culoare neagra</li><li>Garantie 10 ani</li></ul>',
    'seo_title' => '', 'seo_description' => '',
    'related_products' => ['riwega-usb-wall-120'],
    'sort_order' => 1, 'is_active' => true,
    'created_at' => $now, 'updated_at' => $now
];

// 16. USB Wall 120
$newProducts[] = [
    'id' => ++$maxProdId,
    'name' => 'Riwega USB Wall 120',
    'subtitle' => 'Membrana fatada impermeabila respirabila 120 g/m², Sd=0.02m. Etansare vant si apa.',
    'slug' => 'riwega-usb-wall-120',
    'category_id' => 6,
    'subcategory_id' => $subFatada,
    'manufacturer' => 'Riwega',
    'status' => 'activ',
    'image_main' => '', 'image_schema' => '', 'gallery' => [],
    'specs' => [
        ['key' => 'Greutate', 'value' => '120 g/m²', 'sort_order' => 1],
        ['key' => 'Material', 'value' => 'PP.PP.PP', 'sort_order' => 2],
        ['key' => 'Sd', 'value' => '0,02 m', 'sort_order' => 3],
        ['key' => 'Grosime', 'value' => '0,65 mm', 'sort_order' => 4],
        ['key' => 'Stabilitate UV', 'value' => '3 luni', 'sort_order' => 5],
        ['key' => 'Temperatura', 'value' => '-40°C / +100°C', 'sort_order' => 6],
        ['key' => 'Dimensiuni rola', 'value' => '1,5 m / 3 m x 50 m', 'sort_order' => 7],
    ],
    'materials' => [],
    'warranty_text' => 'Garantie producator Riwega.',
    'description_html' => '<h2>Riwega USB Wall 120</h2><p>Membrana impermeabila puternic respirabila pentru fatade ventilate. Etanseizare la vant si apa cu permeabilitate excelenta la vapori.</p><ul><li>Puternic respirabila (Sd=0,02m)</li><li>Impermeabila la apa</li><li>Disponibila in latime 1,5 m si 3 m</li></ul>',
    'seo_title' => '', 'seo_description' => '',
    'related_products' => ['riwega-usb-windtop-uv'],
    'sort_order' => 2, 'is_active' => true,
    'created_at' => $now, 'updated_at' => $now
];

// --- COVOARE TABLA FALTUITA (subcat 48) ---

// 17. USB Drenlam Bluetech
$newProducts[] = [
    'id' => ++$maxProdId,
    'name' => 'Riwega USB Drenlam Bluetech',
    'subtitle' => 'Covor separator premium 450 g/m², grosime 14mm. Drenare perfecta a condensului sub tabla faltuita.',
    'slug' => 'riwega-usb-drenlam-bluetech',
    'category_id' => 6,
    'subcategory_id' => $subCovoare,
    'manufacturer' => 'Riwega',
    'status' => 'activ',
    'image_main' => '', 'image_schema' => '', 'gallery' => [],
    'specs' => [
        ['key' => 'Greutate', 'value' => '450 g/m²', 'sort_order' => 1],
        ['key' => 'Material', 'value' => 'PP virgin 100%', 'sort_order' => 2],
        ['key' => 'Grosime', 'value' => '14 mm', 'sort_order' => 3],
        ['key' => 'Raport de vid', 'value' => 'min. 95%', 'sort_order' => 4],
        ['key' => 'Temperatura', 'value' => '-30°C / +90°C', 'sort_order' => 5],
        ['key' => 'Dimensiuni rola', 'value' => '1,25 m x 20 m', 'sort_order' => 6],
        ['key' => 'Stabilitate UV', 'value' => '3 luni', 'sort_order' => 7],
    ],
    'materials' => [],
    'warranty_text' => 'Garantie producator Riwega.',
    'description_html' => '<h2>Riwega USB Drenlam Bluetech</h2><p>Covorul separator tridimensional care garanteaza o drenare perfecta a condensului sub tabla faltuita. Structura cu blistere asigura ventilatie si drenaj eficient.</p><ul><li>Structura tridimensionala cu blistere</li><li>Drenaj condensat eficient</li><li>PP virgin 100%</li><li>Rezistent la zapada si panouri fotovoltaice</li></ul>',
    'seo_title' => '', 'seo_description' => '',
    'related_products' => ['riwega-usb-drenlam-light'],
    'sort_order' => 1, 'is_active' => true,
    'created_at' => $now, 'updated_at' => $now
];

// 18. USB Drenlam Light
$newProducts[] = [
    'id' => ++$maxProdId,
    'name' => 'Riwega USB Drenlam Light',
    'subtitle' => 'Covor ventilatie universal 350 g/m², grosime 8mm. PP 100%, montaj rapid.',
    'slug' => 'riwega-usb-drenlam-light',
    'category_id' => 6,
    'subcategory_id' => $subCovoare,
    'manufacturer' => 'Riwega',
    'status' => 'activ',
    'image_main' => '', 'image_schema' => '', 'gallery' => [],
    'specs' => [
        ['key' => 'Greutate', 'value' => '350 g/m²', 'sort_order' => 1],
        ['key' => 'Material', 'value' => 'PP virgin 100% cu carbon negru', 'sort_order' => 2],
        ['key' => 'Grosime', 'value' => '8 mm', 'sort_order' => 3],
        ['key' => 'Raport de vid', 'value' => 'min. 95%', 'sort_order' => 4],
        ['key' => 'Temperatura', 'value' => '-40°C / +90°C', 'sort_order' => 5],
        ['key' => 'Dimensiuni rola', 'value' => '1,25 m x 28 m', 'sort_order' => 6],
        ['key' => 'Stabilitate UV', 'value' => '3 luni', 'sort_order' => 7],
    ],
    'materials' => [],
    'warranty_text' => 'Garantie producator Riwega.',
    'description_html' => '<h2>Riwega USB Drenlam Light</h2><p>Covor de ventilatie universal din polipropilena 100%. Varianta mai usoara si mai compacta pentru tabla faltuita.</p><ul><li>PP virgin 100%</li><li>Grosime 8 mm</li><li>Universal - potrivit pentru orice tip de tabla faltuita</li></ul>',
    'seo_title' => '', 'seo_description' => '',
    'related_products' => ['riwega-usb-drenlam-bluetech'],
    'sort_order' => 2, 'is_active' => true,
    'created_at' => $now, 'updated_at' => $now
];

// --- MEMBRANE AUTOADEZIVE (subcat 49) ---

// 19. VSK Bitum Reflex 1200
$newProducts[] = [
    'id' => ++$maxProdId,
    'name' => 'Riwega VSK Bitum Reflex 1200',
    'subtitle' => 'Bariera vapori autoadeziva bituminoasa, Sd>1500m. Reflexiva, pentru acoperisuri plane.',
    'slug' => 'riwega-vsk-bitum-reflex-1200',
    'category_id' => 6,
    'subcategory_id' => $subAutoadezive,
    'manufacturer' => 'Riwega',
    'status' => 'activ',
    'image_main' => '', 'image_schema' => '', 'gallery' => [],
    'specs' => [
        ['key' => 'Greutate', 'value' => '~1200 g/m²', 'sort_order' => 1],
        ['key' => 'Material', 'value' => 'Compus bituminos autoadeziv + Aluminiu', 'sort_order' => 2],
        ['key' => 'Sd', 'value' => '> 1500 m', 'sort_order' => 3],
        ['key' => 'Dimensiuni rola', 'value' => '1 m x 20 m', 'sort_order' => 4],
        ['key' => 'Flexibilitate temp. joasa', 'value' => '-25°C', 'sort_order' => 5],
        ['key' => 'Temp. aplicare', 'value' => '>= +10°C', 'sort_order' => 6],
    ],
    'materials' => [],
    'warranty_text' => 'Garantie producator Riwega.',
    'description_html' => '<h2>Riwega VSK Bitum Reflex 1200</h2><p>Bariera de vapori autoadeziva cu efect termoreflexiv. Ideala pentru poduri si acoperisuri plane, se aplica direct fara adeziv suplimentar.</p><ul><li>Autoadeziva - montaj rapid fara adeziv</li><li>Strat reflectiv din aluminiu</li><li>Sd > 1500 m</li><li>Compus bituminos de inalta calitate</li></ul>',
    'seo_title' => '', 'seo_description' => '',
    'related_products' => ['riwega-vsk-clear-280', 'riwega-vsk-ds-1500-syn'],
    'sort_order' => 1, 'is_active' => true,
    'created_at' => $now, 'updated_at' => $now
];

// 20. VSK Clear 280
$newProducts[] = [
    'id' => ++$maxProdId,
    'name' => 'Riwega VSK Clear 280',
    'subtitle' => 'Bariera vapori autoadeziva transparenta 290 g/m², Sd>3m. Antiderapanta, montaj rapid.',
    'slug' => 'riwega-vsk-clear-280',
    'category_id' => 6,
    'subcategory_id' => $subAutoadezive,
    'manufacturer' => 'Riwega',
    'status' => 'activ',
    'image_main' => '', 'image_schema' => '', 'gallery' => [],
    'specs' => [
        ['key' => 'Greutate', 'value' => '290 g/m²', 'sort_order' => 1],
        ['key' => 'Material', 'value' => 'EVA, PP', 'sort_order' => 2],
        ['key' => 'Sd', 'value' => '> 3 m', 'sort_order' => 3],
        ['key' => 'Temperatura', 'value' => '-40°C / +100°C', 'sort_order' => 4],
        ['key' => 'Dimensiuni rola', 'value' => '1,5 m x 30 m', 'sort_order' => 5],
        ['key' => 'Stabilitate UV', 'value' => '3 luni', 'sort_order' => 6],
    ],
    'materials' => [],
    'warranty_text' => 'Garantie producator Riwega.',
    'description_html' => '<h2>Riwega VSK Clear 280</h2><p>Bariera de vapori autoadeziva transparenta si antiderapanta. Liner pre-taiat pentru montaj usor si rapid.</p><ul><li>Autoadeziva transparenta</li><li>Antiderapanta</li><li>Liner pre-taiat (Pre-cut)</li><li>Disponibila in latimi 1,5 m / 75 cm / 37,5 cm</li></ul>',
    'seo_title' => '', 'seo_description' => '',
    'related_products' => ['riwega-vsk-bitum-reflex-1200', 'riwega-vsk-ds-1500-syn'],
    'sort_order' => 2, 'is_active' => true,
    'created_at' => $now, 'updated_at' => $now
];

// 21. VSK DS 1500 SYN
$newProducts[] = [
    'id' => ++$maxProdId,
    'name' => 'Riwega VSK DS 1500 SYN',
    'subtitle' => 'Bariera autoadeziva anti-radon, Sd>1500m. Certificata radon, montaj sub sape.',
    'slug' => 'riwega-vsk-ds-1500-syn',
    'category_id' => 6,
    'subcategory_id' => $subAutoadezive,
    'manufacturer' => 'Riwega',
    'status' => 'activ',
    'image_main' => '', 'image_schema' => '', 'gallery' => [],
    'specs' => [
        ['key' => 'Greutate', 'value' => '235 g/m²', 'sort_order' => 1],
        ['key' => 'Material', 'value' => 'PP.PE.Alu.PE.PP (5 straturi)', 'sort_order' => 2],
        ['key' => 'Sd', 'value' => '> 1500 m', 'sort_order' => 3],
        ['key' => 'Temperatura', 'value' => '-40°C / +100°C', 'sort_order' => 4],
        ['key' => 'Dimensiuni rola', 'value' => '1,5 m x 30 m', 'sort_order' => 5],
        ['key' => 'Stabilitate UV', 'value' => '3 luni', 'sort_order' => 6],
        ['key' => 'Adeziv', 'value' => 'Dispersie acrilica', 'sort_order' => 7],
    ],
    'materials' => [],
    'warranty_text' => 'Garantie producator Riwega. Certificata bariera anti-radon.',
    'description_html' => '<h2>Riwega VSK DS 1500 SYN</h2><p>Versiunea autoadeziva a barierei DS 1500 SYN. Certificata anti-radon, cu 5 straturi si aluminiu central, montaj rapid prin autoadezivitate.</p><ul><li>Autoadeziva - montaj rapid</li><li>Certificata anti-radon</li><li>Sd > 1500 m</li><li>Liner pre-taiat</li><li>Potrivita sub sape</li></ul>',
    'seo_title' => '', 'seo_description' => '',
    'related_products' => ['riwega-ds-1500-syn', 'riwega-vsk-bitum-reflex-1200'],
    'sort_order' => 3, 'is_active' => true,
    'created_at' => $now, 'updated_at' => $now
];

// ============================================================
// SAVE
// ============================================================

// Add new subcategories
foreach ($newSubcategories as $sub) {
    $subcategories[] = $sub;
}

// Add new products
foreach ($newProducts as $prod) {
    $products[] = $prod;
}

// Update Folii BDM count
foreach ($subcategories as &$sub) {
    if ($sub['id'] === 16) {
        $sub['sort_order'] = 2;
    }
}
unset($sub);

echo "Adding Riwega products...\n";
echo "New subcategories: " . count($newSubcategories) . "\n";
echo "New products: " . count($newProducts) . "\n";

file_put_contents($subsFile, json_encode($subcategories, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
file_put_contents($prodsFile, json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "\n=== DONE ===\n";
echo "Total subcategories: " . count($subcategories) . "\n";
echo "Total products: " . count($products) . "\n";
