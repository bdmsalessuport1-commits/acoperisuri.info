<?php
/**
 * Batch script: Add Accesorii acoperis products
 * - Rename subcategory 21 from "Treceri de ventilatie" to "Ventilare acoperis"
 * - Add products to Etansari si benzi (subcat 22)
 * - Add products to Ventilare acoperis (subcat 21)
 * - Add products to Parazapezi (subcat 20)
 *
 * Run: php scripts/add-accesorii-products.php
 */

$basePath = dirname(__DIR__);
$productsFile = $basePath . '/data/products.json';
$subcatsFile = $basePath . '/data/subcategories.json';

$products = json_decode(file_get_contents($productsFile), true);
$subcats = json_decode(file_get_contents($subcatsFile), true);

$maxId = max(array_column($products, 'id'));
$now = date('Y-m-d H:i:s');

// ============================================================
// 1. Rename subcategory 21: "Treceri de ventilatie" → "Ventilare acoperis"
// ============================================================
foreach ($subcats as &$s) {
    if ($s['id'] === 21) {
        $s['name'] = 'Ventilare acoperis';
        $s['slug'] = 'ventilare-acoperis';
        $s['updated_at'] = $now;
        echo "✓ Renamed subcategory 21 to 'Ventilare acoperis'\n";
        break;
    }
}
unset($s);

// ============================================================
// Helper function
// ============================================================
function makeProduct(int &$id, string $name, string $subtitle, string $slug, int $subcatId, string $manufacturer, array $specs, string $descHtml, string $warranty = '', array $related = [], int $sortOrder = 0): array {
    $id++;
    $specsFull = [];
    $i = 1;
    foreach ($specs as $k => $v) {
        $specsFull[] = ['key' => $k, 'value' => $v, 'sort_order' => $i++];
    }
    return [
        'id' => $id,
        'name' => $name,
        'subtitle' => $subtitle,
        'slug' => $slug,
        'category_id' => 7,
        'subcategory_id' => $subcatId,
        'manufacturer' => $manufacturer,
        'status' => 'activ',
        'image_main' => '',
        'image_schema' => '',
        'gallery' => [],
        'specs' => $specsFull,
        'materials' => [],
        'warranty_text' => $warranty,
        'description_html' => $descHtml,
        'seo_title' => '',
        'seo_description' => '',
        'related_products' => $related,
        'sort_order' => $sortOrder,
        'is_active' => true,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
}

$newProducts = [];

// ============================================================
// 2. ETANSARI SI BENZI (subcategory 22) — 24 products
// ============================================================

// --- Etansari (7 produse de pe acoperis-magazin.ro) ---

$newProducts[] = makeProduct($maxId, 'Riwega USB Coll 150 X', 'Banda etansare universala autoadeziva, 150mm x 25m, pentru racorduri si suprapuneri membrane', 'riwega-usb-coll-150-x', 22, 'Riwega', [
    'Latime' => '150 mm',
    'Lungime rola' => '25 m',
    'Material' => 'Fleece PP cu adeziv butilic',
    'Utilizare' => 'Etansare racorduri membrane, strapungeri, suprapuneri',
    'Temperatura aplicare' => '+5°C / +35°C',
    'Aderenta' => 'Pe membrane, lemn, metal, beton',
], '<h2>Riwega USB Coll 150 X</h2><p>Banda etansare universala autoadeziva cu suport fleece PP si adeziv butilic de inalta performanta. Ideala pentru racorduri, suprapuneri si strapungeri la membrane de difuzie.</p><ul><li>Autoadeziva cu butilic</li><li>Fleece PP flexibil</li><li>Aderenta excelenta pe multiple suprafete</li><li>Rezistenta UV si la intemperii</li></ul>', 'Garantie producator Riwega.', [], 1);

$newProducts[] = makeProduct($maxId, 'Riwega USB Coll Flexi', 'Banda etansare flexibila pentru racorduri curbe si neregulate, autoadeziva butilic', 'riwega-usb-coll-flexi', 22, 'Riwega', [
    'Latime' => '100 mm',
    'Lungime rola' => '25 m',
    'Material' => 'Cauciuc butilic cu fleece extensibil',
    'Utilizare' => 'Racorduri curbe, colturi, strapungeri rotunde',
    'Extensibilitate' => 'Pana la 100%',
    'Temperatura aplicare' => '+5°C / +35°C',
], '<h2>Riwega USB Coll Flexi</h2><p>Banda etansare extrem de flexibila, cu extensibilitate pana la 100%, perfecta pentru racorduri curbe, colturi si strapungeri de forma neregulata.</p><ul><li>Extensibila pana la 100%</li><li>Se adapteaza formelor curbe</li><li>Adeziv butilic permanent</li><li>Ideala pentru cosuri si tuburi</li></ul>', 'Garantie producator Riwega.', [], 2);

$newProducts[] = makeProduct($maxId, 'Riwega Roll Flex Top Alu', 'Banda etansare cu insertie de aluminiu, pentru racorduri perete-acoperis, 300mm x 5m', 'riwega-roll-flex-top-alu', 22, 'Riwega', [
    'Latime' => '300 mm',
    'Lungime rola' => '5 m',
    'Material' => 'Aluminiu lacuit cu adeziv butilic',
    'Utilizare' => 'Racorduri perete-acoperis, cosuri, lucarne',
    'Culori disponibile' => 'Maro, gri, rosu, negru',
    'Rezistenta temperatura' => '-30°C / +80°C',
], '<h2>Riwega Roll Flex Top Alu</h2><p>Banda de racord din aluminiu lacuit cu adeziv butilic, pentru etansarea jonctiunilor perete-acoperis, cosuri de fum si alte strapungeri. Se modeleaza usor pe suprafete neregulate.</p><ul><li>Aluminiu lacuit - aspect estetic</li><li>Adeziv butilic de lunga durata</li><li>Se modeleaza pe suprafete neregulate</li><li>Disponibila in mai multe culori</li></ul>', 'Garantie producator Riwega.', [], 3);

$newProducts[] = makeProduct($maxId, 'Evotek Banda 3D', 'Banda etansare tridimensionala pentru racorduri complexe, autoadeziva pe ambele fete', 'evotek-banda-3d', 22, 'Evotek', [
    'Latime' => '60 mm',
    'Lungime rola' => '25 m',
    'Material' => 'EPDM cu adeziv acrilic pe ambele fete',
    'Utilizare' => 'Racorduri 3D complexe, colturi, intersectii',
    'Grosime' => '1.2 mm',
    'Temperatura aplicare' => '+5°C / +40°C',
], '<h2>Evotek Banda 3D</h2><p>Banda de etansare tridimensionala cu adeziv pe ambele fete, pentru racorduri complexe la intersectii de membrane, colturi si zone cu geometrie dificila.</p><ul><li>Adeziv pe ambele fete</li><li>EPDM flexibil si durabil</li><li>Pentru geometrii complexe</li><li>Rezistenta la UV si intemperii</li></ul>', 'Garantie producator Evotek.', [], 4);

$newProducts[] = makeProduct($maxId, 'Evotek Banda Sipca', 'Banda etansare pentru sipci si contrasipcii, autoadeziva butilic, 60mm x 30m', 'evotek-banda-sipca', 22, 'Evotek', [
    'Latime' => '60 mm',
    'Lungime rola' => '30 m',
    'Material' => 'EPDM expandat cu adeziv butilic',
    'Utilizare' => 'Etansare sub sipci si contrasipcii',
    'Grosime' => '3 mm',
    'Compresie' => 'Se comprima la fixarea sipcii',
], '<h2>Evotek Banda Sipca</h2><p>Banda de etansare din EPDM expandat cu adeziv butilic, special conceputa pentru montaj sub sipci si contrasipcii. Se comprima la fixare, etansand perforatiile cuielor/suruburilor.</p><ul><li>EPDM expandat - se comprima la fixare</li><li>Etanseaza perforatiile de fixare</li><li>Adeziv butilic pe o fata</li><li>Previne infiltratiile la sipci</li></ul>', 'Garantie producator Evotek.', [], 5);

$newProducts[] = makeProduct($maxId, 'Riwega TIP Kont', 'Adeziv de contact pentru membrane, aplicare cu pensula, 1L', 'riwega-tip-kont', 22, 'Riwega', [
    'Volum' => '1 litru',
    'Tip' => 'Adeziv de contact',
    'Aplicare' => 'Cu pensula pe ambele suprafete',
    'Utilizare' => 'Lipire membrane pe suprafete dificile',
    'Timp deschis' => '10-30 minute',
    'Consum' => 'Aprox. 200-300 g/m²',
], '<h2>Riwega TIP Kont</h2><p>Adeziv de contact profesional pentru lipirea membranelor pe suprafete unde benzile autoadezive nu au aderenta suficienta: beton, tencuiala, caramida.</p><ul><li>Adeziv de contact puternic</li><li>Aplicare cu pensula</li><li>Pentru suprafete poroase si dificile</li><li>Compatibil cu toate membranele Riwega</li></ul>', 'Garantie producator Riwega.', [], 6);

$newProducts[] = makeProduct($maxId, 'Riwega Tape 2 CO', 'Banda dublu-adeziva pentru suprapuneri membrane, 60mm x 25m', 'riwega-tape-2-co', 22, 'Riwega', [
    'Latime' => '60 mm',
    'Lungime rola' => '25 m',
    'Material' => 'Suport PE cu adeziv acrilic dublu',
    'Utilizare' => 'Suprapuneri si jonctiuni membrane',
    'Temperatura aplicare' => '+5°C / +35°C',
    'Tip adeziv' => 'Acrilic modificat',
], '<h2>Riwega Tape 2 CO</h2><p>Banda dublu-adeziva profesionala pentru suprapunerile membranelor de difuzie si barierelor de vapori. Adeziv acrilic de inalta performanta pe ambele fete.</p><ul><li>Dublu-adeziva</li><li>Adeziv acrilic de inalta performanta</li><li>Pentru suprapuneri membrane</li><li>Aderenta permanenta</li></ul>', 'Garantie producator Riwega.', [], 7);

// --- Benzi adezive (10 produse de pe acoperis-magazin.ro) ---

$newProducts[] = makeProduct($maxId, 'Evotek Banda Acrilica Dublu-Adeziva', 'Banda dublu-adeziva acrilica universala, 20mm x 25m, pentru suprapuneri membrane', 'evotek-banda-acrilica-dublu-adeziva', 22, 'Evotek', [
    'Latime' => '20 mm',
    'Lungime rola' => '25 m',
    'Tip adeziv' => 'Acrilic',
    'Utilizare' => 'Suprapuneri membrane, bariere vapori',
    'Temperatura aplicare' => '+5°C / +35°C',
], '<h2>Evotek Banda Acrilica Dublu-Adeziva</h2><p>Banda dublu-adeziva universala cu adeziv acrilic, pentru lipirea suprapunerilor la membrane de difuzie si bariere de vapori.</p><ul><li>Adeziv acrilic puternic</li><li>Dublu-adeziva</li><li>Universala - compatibila cu diverse membrane</li></ul>', 'Garantie producator Evotek.', [], 8);

$newProducts[] = makeProduct($maxId, 'Riwega Tape 1 PAP', 'Banda adeziva pentru membrane, suport hartie, 60mm x 25m', 'riwega-tape-1-pap', 22, 'Riwega', [
    'Latime' => '60 mm',
    'Lungime rola' => '25 m',
    'Material suport' => 'Hartie kraft',
    'Tip adeziv' => 'Acrilic',
    'Utilizare' => 'Suprapuneri membrane difuzie',
    'Temperatura aplicare' => '+5°C / +35°C',
], '<h2>Riwega Tape 1 PAP</h2><p>Banda adeziva cu suport din hartie kraft si adeziv acrilic, pentru suprapunerile membranelor de difuzie. Liner usor de indepartat, aplicare rapida.</p><ul><li>Suport hartie kraft</li><li>Adeziv acrilic de lunga durata</li><li>Liner cu pre-taiere</li><li>Aplicare rapida si curata</li></ul>', 'Garantie producator Riwega.', [], 9);

$newProducts[] = makeProduct($maxId, 'Riwega Tape 1 PE', 'Banda adeziva cu suport PE pentru membrane, 60mm x 25m', 'riwega-tape-1-pe', 22, 'Riwega', [
    'Latime' => '60 mm',
    'Lungime rola' => '25 m',
    'Material suport' => 'Polietilena (PE)',
    'Tip adeziv' => 'Acrilic',
    'Utilizare' => 'Suprapuneri membrane si bariere vapori',
    'Rezistenta la rupere' => 'Ridicata',
], '<h2>Riwega Tape 1 PE</h2><p>Banda adeziva cu suport din polietilena si adeziv acrilic, pentru suprapunerile membranelor si barierelor de vapori. Mai rezistenta la rupere decat versiunea PAP.</p><ul><li>Suport PE rezistent</li><li>Adeziv acrilic puternic</li><li>Nu se rupe la aplicare</li><li>Compatibila cu membrane si bariere</li></ul>', 'Garantie producator Riwega.', [], 10);

$newProducts[] = makeProduct($maxId, 'Riwega Tape Corner', 'Banda adeziva pentru colturi si racorduri la 90°, preformata', 'riwega-tape-corner', 22, 'Riwega', [
    'Dimensiuni' => 'Preformata 90°',
    'Material' => 'PE cu adeziv acrilic',
    'Utilizare' => 'Colturi interioare si exterioare la membrane',
    'Pachet' => '2 bucati/set',
    'Compatibilitate' => 'Toate membranele Riwega',
], '<h2>Riwega Tape Corner</h2><p>Piese de colt preformate la 90° cu adeziv acrilic, pentru etansarea perfecta a colturilor interioare si exterioare la membrane de difuzie si bariere de vapori.</p><ul><li>Preformata la 90°</li><li>Montaj rapid si precis</li><li>Elimina riscul de fisurare la colturi</li><li>Adeziv acrilic permanent</li></ul>', 'Garantie producator Riwega.', [], 11);

$newProducts[] = makeProduct($maxId, 'Riwega Tape Green', 'Banda adeziva ecologica pentru membrane, fara solventi, 60mm x 25m', 'riwega-tape-green', 22, 'Riwega', [
    'Latime' => '60 mm',
    'Lungime rola' => '25 m',
    'Tip adeziv' => 'Acrilic fara solventi',
    'Utilizare' => 'Suprapuneri membrane - varianta eco',
    'Certificari' => 'Ecologica, fara solventi',
    'Temperatura aplicare' => '+5°C / +35°C',
], '<h2>Riwega Tape Green</h2><p>Banda adeziva ecologica cu adeziv acrilic fara solventi, pentru suprapunerile membranelor. Varianta sustenabila din gama Riwega.</p><ul><li>Fara solventi - ecologica</li><li>Adeziv acrilic de inalta calitate</li><li>Aceeasi performanta ca benzile standard</li><li>Certificata ecologic</li></ul>', 'Garantie producator Riwega.', [], 12);

$newProducts[] = makeProduct($maxId, 'Riwega Tape Reflex', 'Banda adeziva aluminizata reflectiva, 75mm x 25m, pentru bariere de vapori', 'riwega-tape-reflex', 22, 'Riwega', [
    'Latime' => '75 mm',
    'Lungime rola' => '25 m',
    'Material' => 'Aluminiu cu adeziv acrilic',
    'Utilizare' => 'Suprapuneri bariere de vapori aluminizate',
    'Reflexivitate' => 'Suprafata aluminiu reflectiv',
    'Temperatura aplicare' => '+5°C / +35°C',
], '<h2>Riwega Tape Reflex</h2><p>Banda adeziva cu suprafata aluminizata reflectiva, special conceputa pentru suprapunerile barierelor de vapori cu strat de aluminiu. Mentine continuitatea stratului reflectiv.</p><ul><li>Suprafata aluminiu reflectiv</li><li>Mentine continuitatea barierei</li><li>Adeziv acrilic permanent</li><li>Pentru bariere aluminizate</li></ul>', 'Garantie producator Riwega.', [], 13);

$newProducts[] = makeProduct($maxId, 'Riwega Tape UV', 'Banda adeziva rezistenta UV pentru expuneri prelungite, 60mm x 25m', 'riwega-tape-uv', 22, 'Riwega', [
    'Latime' => '60 mm',
    'Lungime rola' => '25 m',
    'Tip adeziv' => 'Acrilic stabilizat UV',
    'Rezistenta UV' => 'Pana la 12 luni',
    'Utilizare' => 'Membrane expuse temporar la UV',
    'Culoare' => 'Neagra',
], '<h2>Riwega Tape UV</h2><p>Banda adeziva cu stabilizare UV avansata, pentru utilizare pe membrane expuse temporar razelor ultraviolete. Rezista pana la 12 luni la expunere directa.</p><ul><li>Stabilizata UV - 12 luni</li><li>Adeziv acrilic rezistent</li><li>Pentru zone expuse temporar</li><li>Culoare neagra - discreta</li></ul>', 'Garantie producator Riwega.', [], 14);

$newProducts[] = makeProduct($maxId, 'Riwega Tape 2 BU', 'Banda dublu-adeziva butilic, 20mm x 25m, pentru suprapuneri membrane', 'riwega-tape-2-bu', 22, 'Riwega', [
    'Latime' => '20 mm',
    'Lungime rola' => '25 m',
    'Tip adeziv' => 'Butilic',
    'Utilizare' => 'Suprapuneri membrane, lipiri permanente',
    'Aderenta' => 'Excelenta pe PE, PP, metal',
    'Temperatura aplicare' => '0°C / +40°C',
], '<h2>Riwega Tape 2 BU</h2><p>Banda dublu-adeziva cu adeziv butilic, pentru suprapuneri permanente la membrane. Adezivul butilic ofera aderenta superioara si flexibilitate la temperaturi scazute.</p><ul><li>Adeziv butilic - aderenta superioara</li><li>Flexibila la frig (de la 0°C)</li><li>Dublu-adeziva</li><li>Lipire permanenta</li></ul>', 'Garantie producator Riwega.', [], 15);

$newProducts[] = makeProduct($maxId, 'Evotek Banda Butilica', 'Banda butilic dublu-adeziva, 15mm x 25m, pentru membrane si folii', 'evotek-banda-butilica', 22, 'Evotek', [
    'Latime' => '15 mm',
    'Lungime rola' => '25 m',
    'Tip adeziv' => 'Butilic',
    'Utilizare' => 'Suprapuneri membrane, folii, bariere vapori',
    'Temperatura aplicare' => '0°C / +40°C',
], '<h2>Evotek Banda Butilica</h2><p>Banda dublu-adeziva butilic pentru lipirea suprapunerilor la membrane de difuzie, folii anticondens si bariere de vapori. Alternativa economica la benzile Riwega.</p><ul><li>Adeziv butilic puternic</li><li>Pret competitiv</li><li>Compatibila cu diverse membrane</li><li>Aplicare de la 0°C</li></ul>', 'Garantie producator Evotek.', [], 16);

$newProducts[] = makeProduct($maxId, 'Riwega Tape 2 AC', 'Banda dublu-adeziva acrilica, 20mm x 25m, universala', 'riwega-tape-2-ac', 22, 'Riwega', [
    'Latime' => '20 mm',
    'Lungime rola' => '25 m',
    'Tip adeziv' => 'Acrilic',
    'Utilizare' => 'Suprapuneri membrane, jonctiuni universale',
    'Temperatura aplicare' => '+5°C / +35°C',
    'Aderenta' => 'Pe PE, PP, fleece, hartie',
], '<h2>Riwega Tape 2 AC</h2><p>Banda dublu-adeziva universala cu adeziv acrilic, pentru suprapuneri la membrane de difuzie si bariere de vapori. Cea mai utilizata banda din gama Riwega.</p><ul><li>Adeziv acrilic universal</li><li>Cea mai populara din gama</li><li>Dublu-adeziva</li><li>Compatibila cu toate membranele</li></ul>', 'Garantie producator Riwega.', [], 17);

// --- Eurovent (7 produse) ---

$newProducts[] = makeProduct($maxId, 'Eurovent Unisan', 'Banda adeziva universala pentru membrane, 60mm x 25m', 'eurovent-unisan', 22, 'Eurovent', [
    'Latime' => '60 mm',
    'Lungime rola' => '25 m',
    'Material' => 'PP fleece cu adeziv acrilic',
    'Utilizare' => 'Suprapuneri membrane difuzie si bariere vapori',
    'Temperatura aplicare' => '+5°C / +40°C',
    'Aderenta' => 'PE, PP, fleece, lemn',
], '<h2>Eurovent Unisan</h2><p>Banda adeziva universala Eurovent pentru lipirea suprapunerilor la membrane de difuzie si bariere de vapori. Adeziv acrilic de inalta performanta.</p><ul><li>Universala - pentru toate tipurile de membrane</li><li>Adeziv acrilic puternic</li><li>Suport PP fleece flexibil</li><li>Aplicare usoara</li></ul>', 'Garantie producator Eurovent.', [], 18);

$newProducts[] = makeProduct($maxId, 'Eurovent Multi', 'Banda adeziva multi-suprafete, 60mm x 25m, pentru racorduri complexe', 'eurovent-multi', 22, 'Eurovent', [
    'Latime' => '60 mm',
    'Lungime rola' => '25 m',
    'Material' => 'PE cu adeziv acrilic modificat',
    'Utilizare' => 'Racorduri membrane pe lemn, beton, metal, plastic',
    'Temperatura aplicare' => '+5°C / +40°C',
    'Aderenta' => 'Multi-suprafete inclusiv poroase',
], '<h2>Eurovent Multi</h2><p>Banda adeziva multi-suprafete Eurovent, cu aderenta superioara pe lemn, beton, metal si plastic. Ideala pentru racorduri la pereti, cosuri si strapungeri.</p><ul><li>Aderenta pe suprafete multiple</li><li>Inclusiv suprafete poroase</li><li>Adeziv acrilic modificat</li><li>Pentru racorduri complexe</li></ul>', 'Garantie producator Eurovent.', [], 19);

$newProducts[] = makeProduct($maxId, 'Eurovent Seal', 'Banda etansare autoadeziva butilic, pentru strapungeri si racorduri, 50mm x 10m', 'eurovent-seal', 22, 'Eurovent', [
    'Latime' => '50 mm',
    'Lungime rola' => '10 m',
    'Material' => 'Cauciuc butilic cu suport aluminiu',
    'Utilizare' => 'Etansare strapungeri, racorduri, reparatii',
    'Temperatura aplicare' => '-10°C / +40°C',
    'Rezistenta temperatura' => '-40°C / +90°C',
], '<h2>Eurovent Seal</h2><p>Banda de etansare butilic cu suport din aluminiu, pentru etansarea strapungerilor, racordurilor si reparatiilor la membrane si invelitori. Aplicabila si la temperaturi scazute.</p><ul><li>Adeziv butilic - aplicare de la -10°C</li><li>Suport aluminiu modelabil</li><li>Etansare permanenta</li><li>Pentru reparatii si strapungeri</li></ul>', 'Garantie producator Eurovent.', [], 20);

$newProducts[] = makeProduct($maxId, 'Eurovent Mini Seal', 'Banda etansare subtire butilic, 20mm x 10m, pentru detalii fine', 'eurovent-mini-seal', 22, 'Eurovent', [
    'Latime' => '20 mm',
    'Lungime rola' => '10 m',
    'Material' => 'Cauciuc butilic',
    'Utilizare' => 'Detalii fine, etansare capete sipci, cuie',
    'Temperatura aplicare' => '-10°C / +40°C',
    'Grosime' => '1 mm',
], '<h2>Eurovent Mini Seal</h2><p>Banda de etansare butilic subtire pentru detalii fine: etansare capete de sipci, zone de fixare cu cuie/suruburi, jonctiuni mici.</p><ul><li>Subtire si flexibila</li><li>Pentru detalii fine</li><li>Butilic - aderenta la frig</li><li>Ideala pentru perforatii cuie/suruburi</li></ul>', 'Garantie producator Eurovent.', [], 21);

$newProducts[] = makeProduct($maxId, 'Eurovent Topband', 'Banda de coama ventilata, 240mm x 5m, pentru ventilatie la coama', 'eurovent-topband', 22, 'Eurovent', [
    'Latime' => '240 mm',
    'Lungime rola' => '5 m',
    'Material' => 'Aluminiu cu plasa PP si adeziv butilic',
    'Utilizare' => 'Etansare si ventilatie la coama acoperisului',
    'Ventilatie' => 'Plasa PP permite circulatia aerului',
    'Compatibilitate' => 'Tigla metalica, tabla cutata, tigla ceramica',
], '<h2>Eurovent Topband</h2><p>Banda de coama ventilata Eurovent pentru etansarea si ventilarea zonei de coama la acoperisuri. Combina etansarea la apa cu ventilatie pasiva prin plasa PP.</p><ul><li>Ventilatie la coama</li><li>Etansare la apa si zapada</li><li>Aluminiu flexibil cu plasa PP</li><li>Compatibila cu diverse invelitori</li></ul>', 'Garantie producator Eurovent.', [], 22);

$newProducts[] = makeProduct($maxId, 'Eurovent PUR', 'Spuma poliuretanica pentru etansari la acoperis, 750ml', 'eurovent-pur', 22, 'Eurovent', [
    'Volum' => '750 ml',
    'Tip' => 'Spuma poliuretanica monocomponenta',
    'Expandare' => 'Aprox. 40-45 litri',
    'Utilizare' => 'Etansare goluri, strapungeri, spatii la acoperis',
    'Timp uscare' => '30-60 minute (suprafata)',
    'Temperatura aplicare' => '+5°C / +30°C',
], '<h2>Eurovent PUR</h2><p>Spuma poliuretanica monocomponenta pentru etansarea golurilor, strapungerilor si spatiilor la nivelul acoperisului. Expandare controlata si aderenta pe lemn, beton, metal.</p><ul><li>Expandare controlata</li><li>Aderenta pe multiple suprafete</li><li>Uscare rapida</li><li>Pentru goluri si strapungeri</li></ul>', 'Garantie producator Eurovent.', [], 23);

$newProducts[] = makeProduct($maxId, 'Eurovent Compre X', 'Banda compriband precomprimata pentru etansare la ferestre si strapungeri, 20/8mm x 6m', 'eurovent-compre-x', 22, 'Eurovent', [
    'Dimensiuni' => '20/8 mm (expandat/comprimat)',
    'Lungime rola' => '6 m',
    'Material' => 'Spuma PU impregnata',
    'Utilizare' => 'Etansare ferestre mansarda, strapungeri acoperis',
    'Expandare' => 'De la 8mm la 20mm',
    'Rezistenta vant' => 'Clasa E (>600 Pa)',
], '<h2>Eurovent Compre X</h2><p>Banda compriband precomprimata din spuma PU impregnata, pentru etansarea perimeterelor ferestrelor de mansarda si strapungerilor de acoperis. Se expandeaza dupa montaj umplind golul uniform.</p><ul><li>Precomprimata - se expandeaza dupa montaj</li><li>Umple goluri neregulate</li><li>Rezistenta la vant clasa E</li><li>Ideala pentru ferestre mansarda</li></ul>', 'Garantie producator Eurovent.', [], 24);

// ============================================================
// 3. VENTILARE ACOPERIS (subcategory 21) — 5 products
// ============================================================

$newProducts[] = makeProduct($maxId, 'Evotek Banda Coama', 'Banda ventilata pentru coama acoperisului, 150mm x 5m, aluminiu cu plasa PP', 'evotek-banda-coama', 21, 'Evotek', [
    'Latime' => '150 mm',
    'Lungime rola' => '5 m',
    'Material' => 'Aluminiu + plasa PP + banda butilic laterala',
    'Utilizare' => 'Ventilatie si etansare la coama',
    'Ventilatie' => 'Plasa PP centrala permite circulatia aerului',
    'Compatibilitate' => 'Tigla metalica, tabla cutata',
], '<h2>Evotek Banda Coama</h2><p>Banda ventilata pentru coama acoperisului din aluminiu cu plasa PP centrala si benzi butilic laterale. Asigura ventilatie continua la coama si protectie impotriva infiltratiilor.</p><ul><li>Ventilatie pasiva la coama</li><li>Aluminiu flexibil</li><li>Benzi butilic laterale pentru etansare</li><li>Previne condensul in pod</li></ul>', 'Garantie producator Evotek.', [], 1);

$newProducts[] = makeProduct($maxId, 'Evotek Coloana Aerisire Sanitara N', 'Coloana de aerisire pentru canalizare, trecere prin acoperis, DN 100-150mm', 'evotek-coloana-aerisire-sanitara-n', 21, 'Evotek', [
    'Diametru evacuare' => '170 mm',
    'Diametru admisie' => '150 mm',
    'Material' => 'Polipropilena (PP)',
    'Utilizare' => 'Aerisire canalizare prin acoperis',
    'Panta acoperis' => '5° - 45°',
    'Culori' => 'Maro RAL 8017, Negru RAL 9005',
    'Include' => 'Guler EPDM, capac, flansa',
], '<h2>Evotek Coloana Aerisire Sanitara N</h2><p>Coloana de aerisire pentru canalizarea sanitara cu trecere etansa prin acoperis. Include guler EPDM pentru etansare pe invelitoare si capac de protectie.</p><ul><li>Trecere etansa prin acoperis</li><li>Guler EPDM inclus</li><li>Compatibila cu pante 5°-45°</li><li>PP rezistent UV</li></ul>', 'Garantie producator Evotek.', [], 2);

$newProducts[] = makeProduct($maxId, 'Evotek Ventilatie Acoperis N', 'Cos ventilatie plat pentru acoperis, evacuare aer din pod, panta 5-45°', 'evotek-ventilatie-acoperis-n', 21, 'Evotek', [
    'Tip' => 'Cos ventilatie plat',
    'Material' => 'Polipropilena (PP)',
    'Panta acoperis' => '5° - 45°',
    'Debit aer' => 'Pana la 200 m³/h',
    'Culori' => 'Maro RAL 8017, Negru RAL 9005, Gri RAL 7024',
    'Include' => 'Guler EPDM, grila anti-insecte, flansa',
], '<h2>Evotek Ventilatie Acoperis N</h2><p>Cos de ventilatie plat pentru evacuarea aerului din podul acoperisului. Design aerodinamic, cu guler EPDM pentru etansare si grila anti-insecte.</p><ul><li>Design aerodinamic plat</li><li>Debit pana la 200 m³/h</li><li>Guler EPDM inclus</li><li>Grila anti-insecte</li></ul>', 'Garantie producator Evotek.', [], 3);

$newProducts[] = makeProduct($maxId, 'Eurovent Ventos X Roto B26', 'Palarie rotativa pentru cosuri, diametru 150mm, aluminiu', 'eurovent-ventos-x-roto-b26', 21, 'Eurovent', [
    'Diametru' => '150 mm',
    'Material' => 'Aluminiu',
    'Tip' => 'Rotativ (eolian)',
    'Utilizare' => 'Ventilatie cosuri de fum inactive, canalizare, pod',
    'Debit' => 'Variabil, in functie de vant',
    'Montaj' => 'Pe cosuri existente sau tevi ventilatie',
], '<h2>Eurovent Ventos X Roto B26</h2><p>Palarie rotativa eoliana Eurovent pentru cosuri de fum inactive sau tevi de ventilatie. Se roteste cu forta vantului, creand un efect de aspiratie care imbunatateste ventilarea.</p><ul><li>Rotativa eoliana - fara consum electric</li><li>Aluminiu rezistent la coroziune</li><li>Efect de aspiratie la vant</li><li>Pentru cosuri si tevi ventilatie</li></ul>', 'Garantie producator Eurovent.', [], 4);

$newProducts[] = makeProduct($maxId, 'Eurovent Sattos X N25', 'Adaptor trecere antena prin acoperis, pentru catarge 15-90mm', 'eurovent-sattos-x-n25', 21, 'Eurovent', [
    'Diametru catarg' => '15 - 90 mm',
    'Material baza' => 'Polipropilena (PP)',
    'Material guler' => 'EPDM flexibil',
    'Panta acoperis' => '5° - 45°',
    'Utilizare' => 'Trecere antena, catarg, cablu prin acoperis',
    'Culori' => 'Maro, negru, gri',
], '<h2>Eurovent Sattos X N25</h2><p>Adaptor de trecere prin acoperis pentru antene, catarge si cabluri cu diametrul intre 15 si 90mm. Guler EPDM flexibil asigura etansarea pe catarg.</p><ul><li>Compatibil catarge 15-90mm</li><li>Guler EPDM flexibil</li><li>Baza PP rezistenta UV</li><li>Panta acoperis 5°-45°</li></ul>', 'Garantie producator Eurovent.', [], 5);

// ============================================================
// 4. PARAZAPEZI (subcategory 20) — 4 products
// ============================================================

$newProducts[] = makeProduct($maxId, 'Grilaje Parazapada Tigla Metalica', 'Grilaj parazapada pentru tigla metalica, 3m, otel galvanizat vopsit', 'grilaje-parazapada-tigla-metalica', 20, 'Generic', [
    'Lungime' => '3 m',
    'Material' => 'Otel galvanizat vopsit',
    'Inaltime grilaj' => '200 mm',
    'Utilizare' => 'Tigla metalica (toate profilurile)',
    'Culori RAL' => '3011, 3005, 6020, 7024, 8004, 8017, 8019, 9005',
    'Include' => 'Grilaj + suporti + suruburi fixare',
    'Nr. suporti/grilaj' => '4 bucati',
], '<h2>Grilaje Parazapada Tigla Metalica</h2><p>Sistem grilaj parazapada pentru tigla metalica, din otel galvanizat si vopsit in culoarea acoperisului. Include grilajul, suportii si suruburile de fixare.</p><ul><li>3 metri lungime</li><li>8 culori RAL disponibile</li><li>Include suporti si suruburi</li><li>Compatibil cu toate profilurile tigla metalica</li></ul>', '10 ani garantie anticoroziune.', [], 1);

$newProducts[] = makeProduct($maxId, 'Bara Simpla Parazapada Tabla Faltuita', 'Bara parazapada simpla pentru tabla faltuita, 3m, otel/cupru/aluminiu', 'bara-simpla-parazapada-tabla-faltuita', 20, 'Figo', [
    'Lungime' => '3 m',
    'Material bara' => 'Otel galvanizat / Cupru / Aluminiu',
    'Diametru bara' => '32 mm',
    'Utilizare' => 'Tabla faltuita (falt drept si falt dublu)',
    'Producator' => 'Figo Austria',
    'Montaj' => 'Pe faltul tablei, fara perforarea invelitorii',
    'Include' => 'Bara + cleme falt + capace',
], '<h2>Bara Simpla Parazapada Tabla Faltuita</h2><p>Bara parazapada simpla de la Figo Austria pentru acoperisuri cu tabla faltuita. Se monteaza pe falt fara a perfora invelitoarea, mentinand etanseitatea.</p><ul><li>Montaj pe falt - fara perforare</li><li>Disponibila in otel, cupru si aluminiu</li><li>Producator Figo Austria</li><li>Include cleme si capace</li></ul>', 'Garantie producator Figo Austria.', [], 2);

$newProducts[] = makeProduct($maxId, 'Bare Duble Parazapada Tabla Faltuita', 'Sistem parazapada cu 2 bare pentru tabla faltuita, 3m, protectie sporita', 'bare-duble-parazapada-tabla-faltuita', 20, 'Figo', [
    'Lungime' => '3 m',
    'Nr. bare' => '2',
    'Material bare' => 'Otel galvanizat / Cupru / Aluminiu',
    'Diametru bare' => '32 mm',
    'Utilizare' => 'Tabla faltuita - pante mari sau zone cu zapada abundenta',
    'Producator' => 'Figo Austria',
    'Montaj' => 'Pe faltul tablei, fara perforarea invelitorii',
    'Include' => '2 bare + cleme falt + capace',
], '<h2>Bare Duble Parazapada Tabla Faltuita</h2><p>Sistem parazapada cu doua bare de la Figo Austria, pentru acoperisuri cu tabla faltuita in zone cu pante mari sau zapada abundenta. Retentie sporita fata de bara simpla.</p><ul><li>2 bare - retentie sporita</li><li>Montaj pe falt - fara perforare</li><li>Ideal pentru pante mari</li><li>Disponibil in otel, cupru, aluminiu</li></ul>', 'Garantie producator Figo Austria.', [], 3);

$newProducts[] = makeProduct($maxId, 'Eurovent Snowstopper Set Metal Panel', 'Grilaj parazapada Eurovent pentru panouri metalice, 370/35mm, 1-3m', 'eurovent-snowstopper-set-metal-panel', 20, 'Eurovent', [
    'Inaltime grilaj' => '370 mm (grilaj) / 35 mm (profil)',
    'Lungimi disponibile' => '1 m / 2 m / 3 m',
    'Material' => 'Otel galvanizat vopsit',
    'Utilizare' => 'Panouri metalice (tabla cutata, tigla metalica)',
    'Include' => 'Grilaj + suporti universali + fixari',
    'Culori' => 'RAL 3011, 7024, 8017, 9005 si altele',
], '<h2>Eurovent Snowstopper Set Metal Panel</h2><p>Set complet grilaj parazapada Eurovent pentru panouri metalice (tabla cutata si tigla metalica). Grilaj inalt de 370mm pentru retentie maxima, cu suporti universali.</p><ul><li>Grilaj inalt 370mm - retentie maxima</li><li>Suporti universali</li><li>Disponibil in 1m, 2m si 3m</li><li>Mai multe culori RAL</li></ul>', 'Garantie producator Eurovent.', [], 4);

// ============================================================
// 5. Add products and update subcategory counts
// ============================================================

// Count per subcategory
$countPerSubcat = [20 => 0, 21 => 0, 22 => 0];
foreach ($newProducts as $p) {
    $countPerSubcat[$p['subcategory_id']]++;
}

// Update subcategory counts
foreach ($subcats as &$s) {
    if (isset($countPerSubcat[$s['id']])) {
        $s['count'] = ($s['count'] ?? 0) + $countPerSubcat[$s['id']];
        $s['updated_at'] = $now;
    }
}
unset($s);

// Merge products
$products = array_merge($products, $newProducts);

// ============================================================
// 6. Save
// ============================================================
file_put_contents($productsFile, json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
file_put_contents($subcatsFile, json_encode($subcats, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

echo "\n✓ Added " . count($newProducts) . " products total:\n";
echo "  - Etansari si benzi (subcat 22): " . $countPerSubcat[22] . " products\n";
echo "  - Ventilare acoperis (subcat 21): " . $countPerSubcat[21] . " products\n";
echo "  - Parazapezi (subcat 20): " . $countPerSubcat[20] . " products\n";
echo "  - Product IDs: 107 to " . $maxId . "\n";
echo "\n✓ Updated subcategory counts:\n";
foreach ($subcats as $s) {
    if (in_array($s['id'], [20, 21, 22])) {
        echo "  - {$s['name']} (ID {$s['id']}): count = {$s['count']}\n";
    }
}
echo "\nDone!\n";
