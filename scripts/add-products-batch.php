<?php
/**
 * Batch add: Rufster tigla metalica, tabla cutata profiles (Metigla, Wetterbest, Blachotrapez, Rufster),
 * and fence systems (Rufster, Wetterbest, Budmat, BDM)
 */

$root = dirname(__DIR__);
$now = date('Y-m-d H:i:s');

// Load existing data
$subcats = json_decode(file_get_contents("$root/data/subcategories.json"), true);
$products = json_decode(file_get_contents("$root/data/products.json"), true);

$nextSubcatId = max(array_column($subcats, 'id')) + 1;
$nextProductId = max(array_column($products, 'id')) + 1;

function addSubcat(&$subcats, &$id, $catId, $name, $slug, $count, $sortOrder, $icon = '&#9649;') {
    global $now;
    $subcats[] = [
        'id' => $id,
        'category_id' => $catId,
        'name' => $name,
        'slug' => $slug,
        'description' => '',
        'image' => '',
        'icon' => $icon,
        'count' => $count,
        'seo_title' => '',
        'seo_description' => '',
        'seo_text' => '',
        'sort_order' => $sortOrder,
        'is_active' => true,
        'created_at' => $now,
        'updated_at' => $now,
    ];
    $currentId = $id;
    $id++;
    return $currentId;
}

function addProduct(&$products, &$id, $catId, $subcatId, $name, $subtitle, $slug, $manufacturer, $specs, $materials, $descHtml, $warranty = '', $relatedProducts = []) {
    global $now;
    $products[] = [
        'id' => $id,
        'name' => $name,
        'subtitle' => $subtitle,
        'slug' => $slug,
        'category_id' => $catId,
        'subcategory_id' => $subcatId,
        'manufacturer' => $manufacturer,
        'status' => 'activ',
        'image_main' => '',
        'image_schema' => '',
        'gallery' => [],
        'specs' => $specs,
        'materials' => $materials,
        'warranty_text' => $warranty,
        'description_html' => $descHtml,
        'seo_title' => '',
        'seo_description' => '',
        'related_products' => $relatedProducts,
        'sort_order' => $id,
        'is_active' => true,
        'created_at' => $now,
        'updated_at' => $now,
    ];
    $id++;
}

function makeSpecs($arr) {
    $specs = [];
    $i = 1;
    foreach ($arr as $key => $val) {
        $specs[] = ['key' => $key, 'value' => $val, 'sort_order' => $i++];
    }
    return $specs;
}

function makeColors($colors) {
    $result = [];
    $i = 1;
    foreach ($colors as $name => $data) {
        $result[] = [
            'name' => $name,
            'code' => $data[0] ?? '',
            'hex' => $data[1] ?? '#cccccc',
            'swatch' => '',
            'sort_order' => $i++,
        ];
    }
    return $result;
}

// Common color palettes
$rufsterLucios = makeColors([
    'Rosu-brun' => ['RAL 3011', '#781f19'],
    'Visiniu' => ['RAL 3005', '#5e2129'],
    'Maro-cupru' => ['RAL 8004', '#8e402a'],
    'Maro-ciocolatiu' => ['RAL 8017', '#45322e'],
    'Alb-gri' => ['RAL 9002', '#e7ebda'],
    'Argintiu' => ['RAL 9006', '#a5a5a5'],
    'Albastru' => ['RAL 5010', '#0e518d'],
    'Maro-grafit' => ['RAL 8019', '#403a3a'],
    'Gri-grafit' => ['RAL 7024', '#474a51'],
    'Gri-antracit' => ['RAL 7016', '#293133'],
    'Negru' => ['RAL 9005', '#0a0a0a'],
]);

$rufsterMS = makeColors([
    'Rosu-brun MS' => ['RAL 3011', '#781f19'],
    'Caramiziu MS' => ['RAL 3009', '#6d342d'],
    'Visiniu MS' => ['RAL 3005', '#5e2129'],
    'Maro-ciocolatiu MS' => ['RAL 8017', '#45322e'],
    'Verde-muschi MS' => ['RAL 6005', '#2f4538'],
    'Verde-crom MS' => ['RAL 6020', '#2e3a23'],
    'Maro-cupru MS' => ['RAL 8004', '#8e402a'],
    'Maro-grafit MS' => ['RAL 8019', '#403a3a'],
    'Albastru MS' => ['RAL 5010', '#0e518d'],
    'Gri-grafit MS' => ['RAL 7024', '#474a51'],
    'Gri-antracit MS' => ['RAL 7016', '#293133'],
    'Negru MS' => ['RAL 9005', '#0a0a0a'],
]);

$rufsterMPR = makeColors([
    'Maro-cupru MPR' => ['RAL 8004', '#8e402a'],
    'Verde-crom MPR' => ['RAL 6020', '#2e3a23'],
    'Visiniu MPR' => ['RAL 3005', '#5e2129'],
    'Maro-ciocolatiu MPR' => ['RAL 8017', '#45322e'],
    'Maro-grafit MPR' => ['RAL 8019', '#403a3a'],
    'Gri-antracit MPR' => ['RAL 7016', '#293133'],
    'Negru MPR' => ['RAL 9005', '#0a0a0a'],
]);

$rufsterMaterials = [
    ['name' => 'Poliester lucios (25 um)', 'sort_order' => 1, 'colors' => $rufsterLucios],
    ['name' => 'Poliester mat structurat MS (35 um)', 'sort_order' => 2, 'colors' => $rufsterMS],
    ['name' => 'Super-Poliester MPR (45-60 um)', 'sort_order' => 3, 'colors' => $rufsterMPR],
];

$metiglaLucios = makeColors([
    'Crem' => ['RAL 1014', '#dfcea1'],
    'Galben' => ['RAL 1021', '#f5d033'],
    'Rosu' => ['RAL 3000', '#af2b1e'],
    'Rosu Visiniu' => ['RAL 3011', '#781f19'],
    'Albastru' => ['RAL 5010', '#0e518d'],
    'Verde Inchis' => ['RAL 6009', '#274028'],
    'Verde Deschis' => ['RAL 6011', '#587246'],
    'Gri Antracit' => ['RAL 7016', '#293133'],
    'Gri Deschis' => ['RAL 7035', '#d7d7d7'],
    'Maro' => ['RAL 8017', '#45322e'],
    'Alb' => ['RAL 9002', '#e7ebda'],
    'Negru' => ['RAL 9005', '#0a0a0a'],
    'Argintiu' => ['RAL 9006', '#a5a5a5'],
    'Gri Aluminiu' => ['RAL 9007', '#8f8f8f'],
    'Alb Pur' => ['RAL 9010', '#f5f5f0'],
]);

$metiglaSuperMat = makeColors([
    'Visiniu' => ['RAL 3005', '#5e2129'],
    'Rosu Rubiniu' => ['RAL 3009', '#6d342d'],
    'Verde' => ['RAL 6020', '#2e3a23'],
    'Gri Antracit' => ['RAL 7016', '#293133'],
    'Caramiziu' => ['RAL 8004', '#8e402a'],
    'Maro' => ['RAL 8017', '#45322e'],
    'Maro Inchis' => ['RAL 8019', '#403a3a'],
    'Negru' => ['RAL 9005', '#0a0a0a'],
]);

$metiglaMaterials = [
    ['name' => 'Lucios (25 um)', 'sort_order' => 1, 'colors' => $metiglaLucios],
    ['name' => 'Super Mat (35 um)', 'sort_order' => 2, 'colors' => $metiglaSuperMat],
    ['name' => 'PUR NOVA (55 um)', 'sort_order' => 3, 'colors' => makeColors([
        'Gri Antracit' => ['RAL 7016', '#293133'],
        'Maro' => ['RAL 8017', '#45322e'],
        'Maro Inchis' => ['RAL 8019', '#403a3a'],
        'Negru' => ['RAL 9005', '#0a0a0a'],
    ])],
];

$wetterbest = makeColors([
    'Visiniu' => ['RAL 3005', '#5e2129'],
    'Rosu Rubiniu' => ['RAL 3009', '#6d342d'],
    'Rosu-brun' => ['RAL 3011', '#781f19'],
    'Albastru' => ['RAL 5010', '#0e518d'],
    'Verde Inchis' => ['RAL 6005', '#2f4538'],
    'Verde deschis' => ['RAL 6033', '#4e8b80'],
    'Gri Antracit' => ['RAL 7016', '#293133'],
    'Gri Grafit' => ['RAL 7024', '#474a51'],
    'Caramiziu' => ['RAL 8004', '#8e402a'],
    'Maro' => ['RAL 8017', '#45322e'],
    'Alb' => ['RAL 9002', '#e7ebda'],
    'Argintiu' => ['RAL 9006', '#a5a5a5'],
    'Verde Crom' => ['RAL 6020', '#2e3a23'],
    'Maro Inchis' => ['RAL 8019', '#403a3a'],
    'Negru' => ['RAL 9005', '#0a0a0a'],
]);

$wetterberstMaterials = [
    ['name' => 'Lucios', 'sort_order' => 1, 'colors' => $wetterbest],
    ['name' => 'Mat', 'sort_order' => 2, 'colors' => $wetterbest],
    ['name' => 'Neomat 30', 'sort_order' => 3, 'colors' => $wetterbest],
    ['name' => 'Suprem 50', 'sort_order' => 4, 'colors' => $wetterbest],
];

$blachoColors = makeColors([
    'Gri Antracit' => ['RAL 7016', '#293133'],
    'Negru' => ['RAL 9005', '#0a0a0a'],
    'Argintiu' => ['RAL 9007', '#8f8f8f'],
    'Gri Grafit' => ['RAL 7024', '#474a51'],
    'Caramiziu' => ['RAL 8004', '#8e402a'],
    'Maro' => ['RAL 8017', '#45322e'],
    'Maro Inchis' => ['RAL 8019', '#403a3a'],
    'Visiniu' => ['RAL 3005', '#5e2129'],
    'Rosu Rubiniu' => ['RAL 3009', '#6d342d'],
    'Rosu-brun' => ['RAL 3011', '#781f19'],
    'Albastru' => ['RAL 5010', '#0e518d'],
    'Verde' => ['RAL 6020', '#2e3a23'],
    'Verde 6029' => ['RAL 6029', '#20603d'],
    'Alb' => ['RAL 9002', '#e7ebda'],
    'Alb Pur' => ['RAL 9010', '#f5f5f0'],
]);

$blachoMaterials = [
    ['name' => 'Super Poliester R-MAT (25 ani)', 'sort_order' => 1, 'colors' => $blachoColors],
    ['name' => 'Crystal AM (40-50 ani)', 'sort_order' => 2, 'colors' => $blachoColors],
    ['name' => 'Poliester Standard Mat (35 ani)', 'sort_order' => 3, 'colors' => $blachoColors],
    ['name' => 'Poliester Standard RAL (10 ani)', 'sort_order' => 4, 'colors' => $blachoColors],
];

// ========================================================================
// 1. RUFSTER - TIGLA METALICA (Category 1, new subcategory)
// ========================================================================
echo "Adding Rufster tigla metalica...\n";
$rufsterTiglaSubId = addSubcat($subcats, $nextSubcatId, 1, 'Rufster', 'rufster', 4, 5, '&#9650;');

addProduct($products, $nextProductId, 1, $rufsterTiglaSubId, 'Rufster Aqua 3D', 'Tigla metalica cu decupaj 3D', 'rufster-aqua-3d', 'Rufster',
    makeSpecs(['Latime totala' => '1200 mm', 'Latime utila' => '1125 mm', 'Inaltime profil' => '23 mm', 'Lungime profil' => '350 / 400 mm', 'Inaltime prag' => '20 mm', 'Lungime coala' => '0.45 - 6.05 m', 'Panta minima' => '14 grade', 'Grosime tabla' => '0.45 / 0.50 / 0.55 mm', 'Strat zinc' => '140 - 275 g/m2']),
    $rufsterMaterials,
    '<h2>Tigla metalica Rufster Aqua 3D</h2><p>Nota distinctiva a profilului AQUA 3D este data de decupajul pe contur a muchiei primului si ultimului pas. Rezultatul este un aspect aparte al acoperisului, o fluiditate si trecere cursiva a colilor de tigla metalica spre streasina.</p><h3>Avantaje</h3><ul><li>Aspect bogat si masiv pe acoperis</li><li>Trecere cursiva a colilor de tigla metalica spre streasina</li><li>Montaj mai usor si eficienta sporita</li><li>Ondulele create scot mai bine in evidenta forma placuta a modelului</li></ul>',
    'Garantie pana la 30 ani finisaj MPR');

addProduct($products, $nextProductId, 1, $rufsterTiglaSubId, 'Rufster Celesta', 'Tigla metalica cu aspect ceramic', 'rufster-celesta', 'Rufster',
    makeSpecs(['Latime totala' => '1175 mm', 'Latime utila' => '1095 mm', 'Inaltime profil' => '24 mm', 'Lungime profil' => '350 / 400 mm', 'Inaltime prag' => '30 mm', 'Lungime coala' => '0.38 - 5.98 m', 'Panta minima' => '14 grade', 'Grosime tabla' => '0.45 / 0.50 / 0.55 mm', 'Strat zinc' => '140 - 275 g/m2']),
    array_merge($rufsterMaterials, [['name' => 'PURAL PUR (35 um ambele parti)', 'sort_order' => 4, 'colors' => $rufsterLucios]]),
    '<h2>Tigla metalica Rufster Celesta</h2><p>Tigla metalica CELESTA are un aspect mai masiv datorita geometriei optimizate, apropiindu-se foarte mult de aspectul tiglei ceramice. CELESTA este proiectata cu un canal capilar pronuntat care ii confera putere sporita si eleganta deosebita.</p><h3>Avantaje</h3><ul><li>Aspect bogat si masiv pe acoperis</li><li>Lungimea ultimului pas de minim 10 mm</li><li>Montaj mai usor datorita simetriei</li><li>Imbinari invizibile datorita decupajelor 3D</li><li>Pana la 5,5% economie la suprafata</li></ul>',
    'Garantie pana la 30 ani finisaj MPR');

addProduct($products, $nextProductId, 1, $rufsterTiglaSubId, 'Rufster Nova', 'Tigla metalica stil mediteranean', 'rufster-nova', 'Rufster',
    makeSpecs(['Latime totala' => '1180 mm', 'Latime utila' => '1067 mm', 'Inaltime profil' => '27 mm', 'Lungime profil' => '350 / 400 mm', 'Inaltime prag' => '30 mm', 'Lungime coala' => '0.38 - 5.98 m', 'Panta minima' => '14 grade', 'Grosime tabla' => '0.45 / 0.50 / 0.55 mm', 'Strat zinc' => '140 - 275 g/m2']),
    $rufsterMaterials,
    '<h2>Tigla metalica Rufster Nova</h2><p>NOVA este un profil deosebit prin geometria bogata, imitand aspectul tiglei Mediteraneene, plin de rotunjimi simetrice alternante. Echilibrul perfect intre practic si estetic.</p><h3>Avantaje</h3><ul><li>Aspect bogat si masiv pe acoperis</li><li>Inaltime prag de 30 mm pentru rigiditate sporita</li><li>Montaj usor datorita simetriei, de la stanga la dreapta sau invers</li><li>Suprapuneri mai sigure datorita capacului larg</li><li>Imbinari invizibile datorita decupajelor 3D</li></ul>',
    'Garantie pana la 30 ani finisaj MPR');

addProduct($products, $nextProductId, 1, $rufsterTiglaSubId, 'Rufster Terra', 'Tigla metalica stil gotic', 'rufster-terra', 'Rufster',
    makeSpecs(['Latime totala' => '1180 mm', 'Latime utila' => '1085 mm', 'Inaltime profil' => '33 mm', 'Lungime profil' => '350 / 400 mm', 'Inaltime prag' => '20 mm', 'Lungime coala' => '0.47 - 6.07 m', 'Panta minima' => '14 grade', 'Grosime tabla' => '0.45 / 0.50 / 0.55 mm', 'Strat zinc' => '140 - 275 g/m2']),
    $rufsterMaterials,
    '<h2>Tigla metalica Rufster Terra</h2><p>TERRA este un profil relevant pe piata tiglei metalice, foarte apreciat. Rotunjirile inalte si simetria modelului confera o eleganta robusta, amintind de stilurile arhitecturale Gotice.</p><h3>Avantaje</h3><ul><li>Aspect bogat si masiv pe acoperis</li><li>Trecere cursiva a colilor spre streasina</li><li>Montaj usor si eficienta sporita</li><li>Ondulele create scot mai bine in evidenta forma placuta a modelului</li></ul>',
    'Garantie pana la 30 ani finisaj MPR');

// ========================================================================
// 2. METIGLA - TABLA CUTATA (Category 4, existing subcat 11)
// ========================================================================
echo "Adding Metigla tabla cutata products...\n";

// Update existing subcat count
foreach ($subcats as &$sc) {
    if ($sc['id'] === 11) { $sc['count'] = 6; $sc['updated_at'] = $now; }
}
unset($sc);

$metiglaCutataProducts = [
    ['Metigla TR8', 'Profil economic inaltime 8 mm', 'metigla-tr8', ['Inaltime cuta' => '8 mm', 'Latime utila' => '1170 mm', 'Latime totala' => '1200 mm', 'Grosime tabla' => '0.50 / 0.60 mm', 'Greutate' => '3.8 - 6.5 kg/m2', 'Lungime' => '1500 - 5800 mm', 'Panta minima' => '20 grade', 'Protectie zinc' => 'min. 275 g/m2', 'Otel' => 'min. S250GD'],
        '<h2>Tabla cutata Metigla TR8</h2><p>Profil economic, solutie rapida si economica pentru cladiri industriale, comerciale sau rezidentiale. Recomandata pentru fatade, plafoane, garduri sau acoperisuri.</p><p>Disponibil in variante: TR8R (acoperis) si TR8F (fatada).</p>'],
    ['Metigla TR30', 'Profil industrial inaltime 26 mm', 'metigla-tr30', ['Inaltime cuta' => '26 mm', 'Latime utila' => '1100 mm', 'Latime totala' => '1160 mm', 'Grosime tabla' => '0.45 / 0.50 / 0.60 / 0.75 mm', 'Greutate' => '4.0 - 7.0 kg/m2', 'Lungime' => '1500 - 12500 mm', 'Panta minima' => '7 grade', 'Protectie zinc' => 'min. 275 g/m2', 'Otel' => 'min. S250GD'],
        '<h2>Tabla cutata Metigla TR30</h2><p>Solutie rapida si eficienta pentru cladiri industriale sau comerciale. Recomandata pentru acoperisuri structurale si finisarea fatadelor.</p><p>Disponibil in variante: TR30R (acoperis) si TR30F (fatada). Optiune FONO cu membrana fonoabsorbanta.</p>'],
    ['Metigla TR35', 'Profil industrial inaltime 33 mm', 'metigla-tr35', ['Inaltime cuta' => '33 mm', 'Latime utila' => '1035 mm', 'Latime totala' => '1090 mm', 'Grosime tabla' => '0.45 / 0.50 / 0.60 / 0.75 mm', 'Greutate' => '4.2 - 7.3 kg/m2', 'Lungime' => '1500 - 12500 mm', 'Panta minima' => '7 grade', 'Protectie zinc' => 'min. 275 g/m2', 'Otel' => 'min. S250GD'],
        '<h2>Tabla cutata Metigla TR35</h2><p>Solutie rapida pentru cladiri industriale sau comerciale. Recomandata pentru acoperisuri structurale si fatade.</p><p>Disponibil in variante: TR35R (acoperis) si TR35F (fatada). Optiune FONO cu membrana fonoabsorbanta.</p>'],
    ['Metigla TR45', 'Profil industrial inaltime 45 mm', 'metigla-tr45', ['Inaltime cuta' => '45 mm', 'Latime utila' => '1000 mm', 'Latime totala' => '1045 mm', 'Grosime tabla' => '0.45 / 0.50 / 0.60 / 0.75 mm', 'Greutate' => '4.4 - 7.5 kg/m2', 'Lungime' => '1500 - 12500 mm', 'Panta minima' => '7 grade', 'Protectie zinc' => 'min. 275 g/m2', 'Otel' => 'min. S250GD'],
        '<h2>Tabla cutata Metigla TR45</h2><p>Solutie economica si cunoscuta in realizarea inchiderii constructiilor metalice.</p><p>Disponibil in variante: TR45R (acoperis) si TR45F (fatada). Optiune FONO cu membrana fonoabsorbanta.</p>'],
    ['Metigla ONDU18', 'Profil ondulat inaltime 18 mm', 'metigla-ondu18', ['Inaltime cuta' => '18 mm', 'Latime utila' => '988 mm', 'Latime totala' => '1050 mm', 'Grosime tabla' => '0.45 / 0.50 / 0.60 / 0.75 mm', 'Greutate' => '5.0 - 7.5 kg/m2', 'Lungime' => '1500 - 12500 mm', 'Panta minima' => '7 grade', 'Protectie zinc' => 'min. 275 g/m2', 'Otel' => 'min. S250GD'],
        '<h2>Tabla cutata Metigla ONDU18</h2><p>Solutie rapida pentru cladiri industriale sau comerciale. Recomandata pentru acoperisuri structurale si fatade.</p><p>Disponibil in variante: ONDU18R (acoperis) si ONDU18F (fatada). Optiune FONO cu membrana fonoabsorbanta.</p>'],
    ['Metigla ONDU18 CURB', 'Profil ondulat curbat', 'metigla-ondu18-curb', ['Inaltime cuta' => '18 mm', 'Latime utila' => '912 mm', 'Latime totala' => '1050 mm', 'Grosime tabla' => '0.60 / 0.75 mm', 'Greutate' => '5.0 - 7.5 kg/m2', 'Lungime' => '1500 - 3500 mm', 'Panta minima' => '7 grade', 'Protectie zinc' => 'min. 275 g/m2', 'Otel' => 'min. S250GD'],
        '<h2>Tabla cutata Metigla ONDU18 CURB</h2><p>Solutie rapida pentru acoperirea cladirilor cu diverse destinatii (industriala, comerciala, sportiva). Profil curbat, recomandat pentru acoperisuri structurale si fatade.</p><p>Disponibil in variante: ONDU18R CURB (acoperis) si ONDU18F CURB (fatada).</p>'],
];

foreach ($metiglaCutataProducts as $p) {
    addProduct($products, $nextProductId, 4, 11, $p[0], $p[1], $p[2], 'Metigla',
        makeSpecs($p[3]), $metiglaMaterials, $p[4], 'Durata de viata peste 50 ani');
}

// ========================================================================
// 3. WETTERBEST - TABLA CUTATA (Category 4, existing subcat 12)
// ========================================================================
echo "Adding Wetterbest tabla cutata products...\n";

foreach ($subcats as &$sc) {
    if ($sc['id'] === 12) { $sc['count'] = 8; $sc['updated_at'] = $now; }
}
unset($sc);

$wbCutataProducts = [
    ['Wetterbest W8', 'Tabla cutata inaltime 8 mm', 'wetterbest-w8', ['Inaltime ondula' => '8 mm', 'Latime utila' => '830 - 1160 mm', 'Latime totala' => '865 - 1195 mm', 'Grosime tabla' => '0.25 - 0.60 mm', 'Lungime' => '400 - 9000 mm', 'Panta minima' => '8 grade'],
        '<h2>Tabla cutata Wetterbest W8</h2><p>Material versatil si durabil pentru imbunatatirea calitatilor estetice si functionale ale interiorului si exteriorului unei cladiri. Recomandata pentru placari interioare si exterioare, compartimentari.</p>'],
    ['Wetterbest W10', 'Tabla cutata inaltime 10 mm', 'wetterbest-w10', ['Inaltime ondula' => '10 mm', 'Latime utila' => '828 - 1105 mm', 'Latime totala' => '870 - 1150 mm', 'Grosime tabla' => '0.25 - 0.60 mm', 'Lungime' => '400 - 9000 mm'],
        '<h2>Tabla cutata Wetterbest W10</h2><p>Tabla cutata cu inaltime cuta de 10 mm. Disponibila in trei latimi distincte. Versatilitate si rezistenta pentru o gama larga de aplicatii.</p>'],
    ['Wetterbest W18', 'Tabla cutata inaltime 18 mm', 'wetterbest-w18', ['Inaltime ondula' => '18 mm', 'Latime utila' => '1100 mm', 'Latime totala' => '1150 mm', 'Grosime tabla' => '0.40 - 0.60 mm', 'Lungime' => '400 - 12500 mm', 'Panta minima' => '9 grade'],
        '<h2>Tabla cutata Wetterbest W18</h2><p>Ideala pentru lucrari de placare a peretilor industriali, acoperisuri constructii rezidentiale, cladiri cu destinatie agricola sau depozitare.</p>'],
    ['Wetterbest W35', 'Tabla cutata inaltime 35 mm', 'wetterbest-w35', ['Inaltime ondula' => '35 mm', 'Latime utila' => '1080 mm', 'Latime totala' => '1125 mm', 'Grosime tabla' => '0.45 - 1.00 mm', 'Lungime' => '400 - 12500 mm', 'Panta minima' => '7 grade'],
        '<h2>Tabla cutata Wetterbest W35</h2><p>Folosita pentru lucrari de placare a peretilor halelor industriale si acoperisuri mici/medii, acoperisuri constructii rezidentiale si comerciale.</p>'],
    ['Wetterbest W60', 'Tabla cutata inaltime 60 mm', 'wetterbest-w60', ['Inaltime ondula' => '60 mm', 'Latime utila' => '846 mm', 'Latime totala' => '905 mm', 'Grosime tabla' => '0.50 - 1.00 mm', 'Lungime' => '400 - 12500 mm', 'Panta minima' => '4 grade'],
        '<h2>Tabla cutata Wetterbest W60</h2><p>Tabla cutata cu cuta inalta de 60 mm, profilata cu grosimi intre 0.50 mm si 1 mm, cu straturi de protectie si vopsea pe ambele parti.</p>'],
    ['Wetterbest JI 45', 'Tabla profilata inaltime 45 mm', 'wetterbest-ji45', ['Inaltime ondula' => '45 mm', 'Latime utila' => '1000 mm', 'Latime totala' => '1055 mm', 'Grosime tabla' => '0.45 - 1.00 mm', 'Lungime' => '400 - 12500 mm', 'Panta minima' => '5 grade'],
        '<h2>Tabla profilata Wetterbest JI 45</h2><p>Tabla profilata cu inaltimea cutei de 45 mm, profilata cu straturi de protectie si vopsea pe ambele parti. Garantie pana la 10 ani.</p>'],
    ['Wetterbest JIS 16,5', 'Tabla profilata inaltime 16.5 mm', 'wetterbest-jis-16-5', ['Inaltime ondula' => '16.5 mm', 'Latime utila' => '1100 mm', 'Latime totala' => '1155 mm', 'Grosime tabla' => '0.40 - 0.60 mm', 'Lungime' => '500 - 12000 mm', 'Panta minima' => '5 grade'],
        '<h2>Tabla profilata Wetterbest JIS 16,5</h2><p>Tabla profilata cu inaltimea cutei de 16.5 mm, profilata cu straturi de protectie si vopsea pe ambele parti. Garantie pana la 10 ani.</p>'],
    ['Wetterbest JIS 35', 'Tabla profilata inaltime 35 mm', 'wetterbest-jis-35', ['Inaltime ondula' => '35 mm', 'Latime utila' => '1035 mm', 'Latime totala' => '1075 mm', 'Grosime tabla' => '0.45 - 1.00 mm', 'Lungime' => '500 - 13000 mm', 'Panta minima' => '5 grade'],
        '<h2>Tabla profilata Wetterbest JIS 35</h2><p>Tabla profilata cu inaltimea cutei de 35 mm, profilata cu straturi de protectie si vopsea pe ambele parti. Garantie pana la 10 ani.</p>'],
];

foreach ($wbCutataProducts as $p) {
    addProduct($products, $nextProductId, 4, 12, $p[0], $p[1], $p[2], 'Wetterbest',
        makeSpecs($p[3]), $wetterberstMaterials, $p[4], 'Garantie pana la 10 ani');
}

// ========================================================================
// 4. BLACHOTRAPEZ - TABLA CUTATA (Category 4, update existing subcat 10)
// ========================================================================
echo "Adding Blachotrapez tabla cutata products...\n";

// Blachotrapez already has 3 products, add 1 more (T-50) — check existing
// Actually the existing 3 are already there, let's add the missing T-50 and update T-8 as new if not there
// First check what existing blachotrapez tabla cutata products we have

$existingBlachoCutata = array_filter($products, fn($p) => $p['category_id'] === 4 && $p['subcategory_id'] === 10);
echo "  Existing Blachotrapez tabla cutata: " . count($existingBlachoCutata) . "\n";

// Add T-50 (the 4th product)
foreach ($subcats as &$sc) {
    if ($sc['id'] === 10) { $sc['count'] = 4; $sc['updated_at'] = $now; }
}
unset($sc);

addProduct($products, $nextProductId, 4, 10, 'Blachotrapez T-50', 'Tabla trapezoidala inaltime 49 mm', 'blachotrapez-t-50', 'Blachotrapez',
    makeSpecs(['Inaltime profil' => '49 mm', 'Latime utila' => '1047 mm', 'Latime totala' => '1098 mm', 'Grosime tabla' => '0.50 - 1.00 mm', 'Lungime maxima' => '12 m']),
    $blachoMaterials,
    '<h2>Tabla trapezoidala Blachotrapez T-50</h2><p>Profil cu rigiditate ridicata, destinat cladirilor de servicii de mari dimensiuni, de exemplu hale de productie. Acoperire cu Super Poliester R-MAT pentru rezistenta ridicata la zgarieturi si stabilitate UV.</p>',
    'Garantie pana la 50 ani (Crystal AM)');

// ========================================================================
// 5. RUFSTER - TABLA CUTATA (Category 4, new subcategory)
// ========================================================================
echo "Adding Rufster tabla cutata...\n";
$rufsterCutataSubId = addSubcat($subcats, $nextSubcatId, 4, 'Rufster', 'rufster', 8, 4, '&#9649;');

$rufsterCutataProducts = [
    ['Rufster R8 A', 'Tabla cutata acoperis 8 mm', 'rufster-r8a', ['Inaltime profil' => '8 mm', 'Latime utila' => '1160 mm', 'Latime totala' => '1191 mm', 'Grosime tabla' => '0.45 - 0.60 mm', 'Lungime' => '1 - 6 m', 'Strat zinc' => '140 - 275 g/m2']],
    ['Rufster R8 F', 'Tabla cutata fatada 8 mm', 'rufster-r8f', ['Inaltime profil' => '8 mm', 'Latime utila' => '1160 mm', 'Latime totala' => '1191 mm', 'Grosime tabla' => '0.45 - 0.60 mm', 'Lungime' => '1 - 6 m', 'Strat zinc' => '140 - 275 g/m2']],
    ['Rufster R12 A', 'Tabla cutata acoperis 12 mm', 'rufster-r12a', ['Inaltime profil' => '12 mm', 'Latime utila' => '1175 mm', 'Latime totala' => '1200 mm', 'Grosime tabla' => '0.45 - 0.60 mm', 'Lungime' => '1 - 5 m', 'Panta minima' => '10 - 90 grade', 'Strat zinc' => '140 - 275 g/m2']],
    ['Rufster R12 F', 'Tabla cutata fatada 12 mm', 'rufster-r12f', ['Inaltime profil' => '12 mm', 'Latime utila' => '1175 mm', 'Latime totala' => '1200 mm', 'Grosime tabla' => '0.45 - 0.60 mm', 'Lungime' => '1 - 5 m', 'Panta minima' => '10 - 90 grade', 'Strat zinc' => '140 - 275 g/m2']],
    ['Rufster R18 A', 'Tabla cutata acoperis 18 mm', 'rufster-r18a', ['Inaltime profil' => '18 mm', 'Latime utila' => '1135 mm', 'Latime totala' => '1170 mm', 'Grosime tabla' => '0.45 - 0.60 mm', 'Lungime' => '1 - 5 m', 'Panta minima' => '10 - 90 grade', 'Strat zinc' => '140 - 275 g/m2']],
    ['Rufster R18 F', 'Tabla cutata fatada 18 mm', 'rufster-r18f', ['Inaltime profil' => '18 mm', 'Latime utila' => '1135 mm', 'Latime totala' => '1170 mm', 'Grosime tabla' => '0.45 - 0.60 mm', 'Lungime' => '1 - 5 m', 'Panta minima' => '10 - 90 grade', 'Strat zinc' => '140 - 275 g/m2']],
    ['Rufster R35 A', 'Tabla cutata acoperis 35 mm', 'rufster-r35a', ['Inaltime profil' => '35 mm', 'Latime utila' => '1030 mm', 'Latime totala' => '1080 mm', 'Grosime tabla' => '0.45 - 1.00 mm', 'Lungime' => '1 - 6 m', 'Panta minima' => '14 - 90 grade', 'Strat zinc' => '140 - 275 g/m2']],
    ['Rufster R35 F', 'Tabla cutata fatada 35 mm', 'rufster-r35f', ['Inaltime profil' => '35 mm', 'Latime utila' => '1030 mm', 'Latime totala' => '1095 mm', 'Grosime tabla' => '0.45 - 1.00 mm', 'Lungime' => '1 - 6 m', 'Strat zinc' => '140 - 275 g/m2']],
];

foreach ($rufsterCutataProducts as $p) {
    addProduct($products, $nextProductId, 4, $rufsterCutataSubId, $p[0], $p[1], $p[2], 'Rufster',
        makeSpecs($p[3]), $rufsterMaterials,
        '<h2>' . $p[0] . '</h2><p>Profil trapezoidal din otel galvanizat la cald cu protectie multistrat pe ambele fete. ' . $p[1] . '.</p><p>Otel galvanizat la cald, protectie zinc 140-275 g/m2, conform SR EN 14782:2006.</p>',
        'Garantie pana la 30 ani finisaj MPR');
}

// ========================================================================
// 6. GARDURI - New subcategories by manufacturer (Category 14)
// ========================================================================
echo "Adding fence systems...\n";

// Add new subcategories for fence manufacturers
$gardRufsterSubId = addSubcat($subcats, $nextSubcatId, 14, 'Sistem Gard Rufster', 'rufster', 5, 4, '&#127981;');
$gardWetterbest = addSubcat($subcats, $nextSubcatId, 14, 'Sistem Gard Wetterbest', 'wetterbest', 5, 5, '&#127981;');
$gardBudmatSubId = addSubcat($subcats, $nextSubcatId, 14, 'Sistem Gard Budmat', 'budmat', 2, 6, '&#127981;');
$gardBDMSubId = addSubcat($subcats, $nextSubcatId, 14, 'Sistem Gard BDM', 'bdm', 2, 7, '&#127981;');

// --- RUFSTER GARDURI ---
$rufsterGardMS5 = makeColors([
    'Visiniu MS' => ['RAL 3005', '#5e2129'],
    'Maro-ciocolatiu MS' => ['RAL 8017', '#45322e'],
    'Maro-grafit MS' => ['RAL 8019', '#403a3a'],
    'Gri-antracit MS' => ['RAL 7016', '#293133'],
    'Negru MS' => ['RAL 9005', '#0a0a0a'],
]);
$rufsterGardMPR5 = makeColors([
    'Visiniu MPR' => ['RAL 3005', '#5e2129'],
    'Maro-ciocolatiu MPR' => ['RAL 8017', '#45322e'],
    'Maro-grafit MPR' => ['RAL 8019', '#403a3a'],
    'Gri-antracit MPR' => ['RAL 7016', '#293133'],
    'Negru MPR' => ['RAL 9005', '#0a0a0a'],
]);
$rufsterGardMat = [
    ['name' => 'Mat Structurat MS (35 um)', 'sort_order' => 1, 'colors' => $rufsterGardMS5],
    ['name' => 'Super-Poliester MPR (60 um)', 'sort_order' => 2, 'colors' => $rufsterGardMPR5],
];

$rufsterGardProducts = [
    ['Rufster Stacheti Metalici', 'Stachet gard metalic elegant', 'rufster-stacheti-metalici',
        ['Latime' => '105 mm', 'Inaltime' => '18 mm', 'Lungimi standard' => '1.2 m / 1.5 m', 'Grosime' => '0.45 - 0.60 mm', 'Strat zinc' => '140 - 275 g/m2'],
        $rufsterMaterials,
        '<h2>Stacheti Metalici Rufster</h2><p>Stacheti de gard metalic eleganti care imita stachetii traditionali de lemn. Productie automatizata cu profil estetic, rigid, cu canale de rigidizare.</p>'],
    ['Rufster Jaluzele Gard Z95', 'Jaluzea gard moderna 95 mm', 'rufster-jaluzele-gard-z95',
        ['Latime' => '40 mm', 'Inaltime' => '94 mm', 'Lungimi standard' => '1.25 m / 2 m', 'Grosime' => '0.45 - 0.60 mm', 'Strat zinc' => '140 - 275 g/m2'],
        $rufsterGardMat,
        '<h2>Jaluzele Gard Rufster Z95</h2><p>Gard modern cu lamele tip jaluzea, profil simplu si eficient. Utilizeaza profil U pentru finisarea marginilor. Nu necesita cadru.</p>'],
    ['Rufster Sipca Gard V1', 'Sipca gard 140 mm', 'rufster-sipca-gard-v1',
        ['Latime' => '140 mm', 'Inaltime' => '15 mm', 'Lungimi standard' => '1.2 m / 1.5 m', 'Grosime' => '0.45 - 0.60 mm', 'Strat zinc' => '140 - 275 g/m2'],
        $rufsterGardMat,
        '<h2>Sipca Gard Rufster V1</h2><p>Combina practicitatea cu designul, ideala pentru imprejmuirea oricarei case. Se instaleaza pe suporturi de tub rectangular cu suruburi autoforante sau pop-nituri.</p>'],
    ['Rufster Gard Rectangular 80x20', 'Gard rectangular modern', 'rufster-gard-rectangular-80x20',
        ['Latime' => '20 mm', 'Inaltime' => '80 mm', 'Grosime' => '0.45 - 0.55 mm', 'Strat zinc' => '140 - 275 g/m2'],
        $rufsterGardMat,
        '<h2>Gard Rectangular Rufster 80x20</h2><p>Gard perimetral modern, economic, imitand gardul din tub rectangular (80x20 mm) din tabla de otel prevopsita. Fata ascunsa pe spate. Nu necesita intarire suplimentara.</p>'],
    ['Rufster Element Gard Combi', 'Element gard modular cu imbinare', 'rufster-element-gard-combi',
        ['Latime' => '20 mm', 'Inaltime' => '110 mm', 'Grosime' => '0.50 mm', 'Strat zinc' => '140 - 275 g/m2'],
        [['name' => 'Mat Structurat MS (35 um)', 'sort_order' => 1, 'colors' => $rufsterGardMS5],
         ['name' => 'Imitatie lemn Stejar auriu', 'sort_order' => 2, 'colors' => makeColors(['Stejar auriu' => ['Stejar', '#c8a45e']])]],
        '<h2>Element Gard Combi Rufster</h2><p>Doua elemente care se imbina alunecand unul in celalalt, creand un ansamblu cu estetica unica. Designul rectangular ofera rigiditate excelenta fara intariri pe lungime.</p>'],
];

foreach ($rufsterGardProducts as $p) {
    addProduct($products, $nextProductId, 14, $gardRufsterSubId, $p[0], $p[1], $p[2], 'Rufster',
        makeSpecs($p[3]), $p[4], $p[5], 'Garantie pana la 30 ani finisaj MPR');
}

// --- WETTERBEST GARDURI ---
$wbGardColors = makeColors([
    'Visiniu' => ['RAL 3005', '#5e2129'],
    'Rosu Rubiniu' => ['RAL 3009', '#6d342d'],
    'Rosu-brun' => ['RAL 3011', '#781f19'],
    'Albastru' => ['RAL 5010', '#0e518d'],
    'Verde Inchis' => ['RAL 6005', '#2f4538'],
    'Verde Crom' => ['RAL 6020', '#2e3a23'],
    'Verde deschis' => ['RAL 6033', '#4e8b80'],
    'Gri Antracit' => ['RAL 7016', '#293133'],
    'Gri Grafit' => ['RAL 7024', '#474a51'],
    'Caramiziu' => ['RAL 8004', '#8e402a'],
    'Maro' => ['RAL 8017', '#45322e'],
    'Maro Inchis' => ['RAL 8019', '#403a3a'],
    'Alb' => ['RAL 9002', '#e7ebda'],
    'Negru' => ['RAL 9005', '#0a0a0a'],
    'Argintiu' => ['RAL 9006', '#a5a5a5'],
]);
$wbGardMaterials = [
    ['name' => 'Lucios', 'sort_order' => 1, 'colors' => $wbGardColors],
    ['name' => 'Mat', 'sort_order' => 2, 'colors' => $wbGardColors],
    ['name' => 'Imitatie lemn', 'sort_order' => 3, 'colors' => makeColors(['Wood Walnut' => ['Wood', '#6b4226']])],
];

$wbGardProducts = [
    ['Wetterbest Lamela Gard Jaluzea L', 'Panou gard tip jaluzea L', 'wetterbest-lamela-gard-jaluzea-l',
        ['Lungime' => '400 - 3000 mm', 'Grosime' => '0.50 / 0.60 mm', 'Material' => 'Otel prevopsit galvanizat la cald', 'Standard' => 'SR-EN 10346'],
        '<h2>Lamela Gard Tip Jaluzea L - Wetterbest</h2><p>Panourile gard din tabla metalica Wetterbest reprezinta o solutie moderna pentru imprejmuirea si delimitarea spatiului exterior. Design minimalist si elegant, se monteaza cu usurinta pe stalpi de beton sau otel.</p>'],
    ['Wetterbest Lamela Gard Jaluzea D', 'Panou gard lamela dreapta', 'wetterbest-lamela-gard-jaluzea-d',
        ['Lungime' => '400 - 3000 mm', 'Latime totala' => '178 mm', 'Material' => 'Otel prevopsit galvanizat la cald', 'Standard' => 'SR-EN 10346'],
        '<h2>Lamela Gard Tip Jaluzea D - Wetterbest</h2><p>Elementul component principal al panoului de gard tip jaluzea. Se monteaza in pozitie orizontala intre profilele verticale. Geometrie care confera rezistenta profilului.</p>'],
    ['Wetterbest Lamela Gard Jaluzea A', 'Panou gard lamela A', 'wetterbest-lamela-gard-jaluzea-a',
        ['Lungime' => '400 - 3000 mm', 'Grosime' => '0.50 / 0.60 mm', 'Material' => 'Otel prevopsit galvanizat la cald'],
        '<h2>Lamela Gard Tip Jaluzea A - Wetterbest</h2><p>Element component principal al panoului de gard tip jaluzea A. Se monteaza in pozitie orizontala intre profilele cadru. Geometrie care confera rezistenta profilului.</p>'],
    ['Wetterbest Sipca Metalica Semirotunda', 'Sipca gard semirotunda', 'wetterbest-sipca-metalica-semirotunda',
        ['Lungime' => '250 - 3000 mm', 'Densitate' => '7-9 sipci pe metru liniar', 'Montare' => 'Verticala', 'Suruburi prindere' => '4.8 x 19 mm', 'Material' => 'Otel galvanizat prevopsit electrostatic'],
        '<h2>Sipca Metalica Semirotunda - Wetterbest</h2><p>Sipci metalice de gard semirotunde, realizate din otel galvanizat si prevopsite in camp electrostatic. Marginile faltzuite pentru durabilitate sporita la deformarea mecanica. Rezistente la intemperii si raze UV.</p>'],
    ['Wetterbest Sipca Metalica Dreapta', 'Sipca gard dreapta nervurata', 'wetterbest-sipca-metalica-dreapta',
        ['Lungime' => '250 - 3000 mm', 'Montare' => 'Verticala', 'Suruburi prindere' => '4.8 x 19 mm', 'Material' => 'Otel galvanizat prevopsit electrostatic', 'Caracteristici' => 'Doua gofre trapezoidale pe fata frontala'],
        '<h2>Sipca Metalica Dreapta - Wetterbest</h2><p>Sipca metalica de gard cu geometrie nervurata, avand pe fata frontala doua gofre trapezoidale. Folosita la constructia gardurilor cu arhitectura ferma, zvelta, cu linii drepte.</p>'],
];

foreach ($wbGardProducts as $p) {
    addProduct($products, $nextProductId, 14, $gardWetterbest, $p[0], $p[1], $p[2], 'Wetterbest',
        makeSpecs($p[3]), $wbGardMaterials, $p[4], 'Garantie pana la 10 ani');
}

// --- BUDMAT GARDURI ---
$budmatGardColors = makeColors([
    'Negru Ultramat' => ['RAL 9005', '#0a0a0a'],
    'Antracit Ultramat' => ['RAL 7016', '#293133'],
    'Maro Ultramat' => ['RAL 8017', '#45322e'],
    'Nuc' => ['Woodlike', '#6b4226'],
    'Stejar Decolorat' => ['Woodlike', '#c8a45e'],
]);
$budmatGardMaterials = [
    ['name' => 'Ultramat', 'sort_order' => 1, 'colors' => makeColors([
        'Negru' => ['RAL 9005', '#0a0a0a'],
        'Antracit' => ['RAL 7016', '#293133'],
        'Maro' => ['RAL 8017', '#45322e'],
    ])],
    ['name' => 'Woodlike (imitatie lemn)', 'sort_order' => 2, 'colors' => makeColors([
        'Nuc (Walnut)' => ['Woodlike', '#6b4226'],
        'Stejar Decolorat (Bleached Oak)' => ['Woodlike', '#c8a45e'],
    ])],
];

addProduct($products, $nextProductId, 14, $gardBudmatSubId, 'Budmat Variante', 'Sistem gard modular palisada', 'budmat-variante', 'Budmat',
    makeSpecs(['Tip' => 'Gard palisada modular', 'Variante inaltime panou' => '100 mm / 150 mm / 200 mm', 'Material' => 'Otel de calitate superioara', 'Montaj' => 'DIY, fara profesionist, suruburi incluse', 'Livrare' => 'Pachete Parcel gata de montaj']),
    $budmatGardMaterials,
    '<h2>Sistem Gard Budmat Variante</h2><p>Posibilitati nelimitate. Sistem de gard palisada modular care permite combinarea libera a dimensiunilor si culorilor. Fara intretinere, cu aspect estetic deosebit.</p><h3>Avantaje</h3><ul><li>Constructie palisada - intimitate maxima</li><li>Pachete Parcel pentru transport usor si montaj DIY</li><li>Orificii de montaj pregatite, fara suruburi vizibile</li><li>Se poate asorta cu acoperisul, jgheaburile si sofitul Budmat</li><li>30 ani experienta in productia de acoperisuri din otel</li></ul>',
    '30 ani experienta Budmat');

addProduct($products, $nextProductId, 14, $gardBudmatSubId, 'Budmat Colectii Gard', 'Sisteme gard Sicuro, Forte, Spazio, Unico', 'budmat-colectii-gard', 'Budmat',
    makeSpecs(['Colectii disponibile' => 'Sicuro, Forte, Spazio, Unico', 'Material' => 'Otel de calitate superioara', 'Montaj' => 'Vertical sau orizontal', 'Accesorii' => 'Sipci, stalpi, ancore MS-40, MZ-V, MZ-H']),
    [['name' => 'Ultramat', 'sort_order' => 1, 'colors' => makeColors([
        'Negru' => ['RAL 9005', '#0a0a0a'],
        'Antracit' => ['RAL 7016', '#293133'],
        'Maro' => ['RAL 8017', '#45322e'],
        'Grafit' => ['RAL 7024', '#474a51'],
    ])],
     ['name' => 'Woodlike (imitatie lemn)', 'sort_order' => 2, 'colors' => makeColors([
        'Nuc (Walnut)' => ['Woodlike', '#6b4226'],
        'Stejar Auriu (Golden Oak)' => ['Woodlike', '#c8a45e'],
    ])],
     ['name' => 'Polyester Gloss', 'sort_order' => 3, 'colors' => makeColors([
        'Antracit' => ['RAL 7016', '#293133'],
        'Maro' => ['RAL 8017', '#45322e'],
        'Grafit' => ['RAL 7024', '#474a51'],
    ])]],
    '<h2>Colectii Sisteme Gard Budmat</h2><p>Sisteme de garduri din otel de inalta calitate, fara intretinere. Se pot asorta cu acoperisul, jgheaburile, ramele ferestrelor si imprejurimile.</p><h3>Colectii</h3><ul><li><strong>Sicuro</strong> - Design orizontal modern cu lamele, pentru intimitate</li><li><strong>Forte</strong> - Design vertical traditional, aspect de lemn</li><li><strong>Spazio</strong> - Design orizontal cu spatii, semi-transparent</li><li><strong>Unico</strong> - Design vertical/mixt, stil unic</li></ul><p>Include versiuni de panouri, porticane si porti (pietonale, batante, culisante).</p>',
    '30 ani experienta Budmat');

// --- BDM GARDURI ---
$bdmGardColors = makeColors([
    'Gri Antracit' => ['RAL 7016', '#293133'],
    'Gri Grafit' => ['RAL 7024', '#474a51'],
    'Maro Inchis (Wenge)' => ['RAL 8019', '#403a3a'],
    'Negru' => ['RAL 9005', '#0a0a0a'],
    'Visiniu' => ['RAL 3005', '#5e2129'],
    'Maro Ciocolatiu' => ['RAL 8017', '#45322e'],
]);
$bdmGardMaterials = [
    ['name' => 'Extramat', 'sort_order' => 1, 'colors' => $bdmGardColors],
    ['name' => 'Mat dublu', 'sort_order' => 2, 'colors' => $bdmGardColors],
    ['name' => 'Imitatie lemn', 'sort_order' => 3, 'colors' => makeColors([
        'Stejar auriu' => ['Imitatie lemn', '#c8a45e'],
        'Mahon' => ['Imitatie lemn', '#4e1609'],
    ])],
];

addProduct($products, $nextProductId, 14, $gardBDMSubId, 'BDM Sipca Gard', 'Sipca gard metalic - cel mai bun pret', 'bdm-sipca-gard', 'BDM Systems',
    makeSpecs(['Latime' => '115 mm', 'Sipci pe metru liniar' => '8 buc', 'Material' => 'Tabla din otel galvanizat ambele fete, cu strat de primer', 'Pret estimativ' => '9.9 Lei/buc', 'Garantie coroziune' => '20 ani', 'Durata de viata' => 'pana la 60 ani', 'Lungime' => 'La comanda']),
    $bdmGardMaterials,
    '<h2>Sipca Gard BDM - Cel mai bun pret</h2><p>Sipci de gard metalice din tabla de otel galvanizata pe ambele fete, cu strat de primer pentru protectie suplimentara. Productie automatizata, la comanda, fara cantitate minima.</p><h3>Avantaje</h3><ul><li>Cel mai bun pret de pe piata</li><li>Livrare gratuita in toata Romania</li><li>Garantie 20 ani impotriva coroziunii</li><li>Durata de viata pana la 60 ani</li><li>Zero costuri de intretinere</li><li>Rezistenta excelenta la raze UV</li></ul>',
    'Garantie 20 ani impotriva coroziunii');

addProduct($products, $nextProductId, 14, $gardBDMSubId, 'BDM Panou Gard Tip Jaluzea', 'Panou gard jaluzea - cel mai bun pret', 'bdm-panou-gard-jaluzea', 'BDM Systems',
    makeSpecs(['Dimensiune standard' => '2000 x 1550 mm', 'Latimi disponibile' => '0.30 - 2.60 m', 'Material' => 'Constructie metalica cu lamele tip jaluzea', 'Pret estimativ' => '~193 Lei/m2', 'Garantie coroziune' => '30 ani', 'Durata de viata' => 'pana la 60 ani', 'Kit contine' => 'Profile jaluzea, profile U (stanga/dreapta/orizontal), intaritura, elemente de fixare']),
    $bdmGardMaterials,
    '<h2>Panou Gard Tip Jaluzea BDM - Cel mai bun pret</h2><p>Panouri de gard tip jaluzea din metal, cu lamele orizontale care asigura intimitate si un aspect modern. Kit complet cu toate elementele necesare montajului.</p><h3>Avantaje</h3><ul><li>Cel mai bun pret de pe piata</li><li>Livrare gratuita in toata Romania</li><li>Garantie 30 ani impotriva coroziunii</li><li>Durata de viata pana la 60 ani</li><li>Kit complet gata de montaj</li><li>Dimensiuni personalizabile</li></ul>',
    'Garantie 30 ani impotriva coroziunii');

// ========================================================================
// 7. Add Metigla tabla faltuita subcat (fals solar) link if missing
// ========================================================================

// Save everything
file_put_contents("$root/data/subcategories.json", json_encode(array_values($subcats), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
file_put_contents("$root/data/products.json", json_encode(array_values($products), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

echo "\n=== DONE ===\n";
echo "Total subcategories: " . count($subcats) . "\n";
echo "Total products: " . count($products) . "\n";
echo "New subcategories added: " . ($nextSubcatId - 38) . "\n";
echo "New products added: " . ($nextProductId - 45) . "\n";
