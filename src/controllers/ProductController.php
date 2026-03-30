<?php

namespace App\Controllers;

use App\Helpers\View;

class ProductController
{
    private array $productData = [

        // ==========================================
        // TIGLA METALICA - BUDMAT
        // ==========================================
        'budmat-venecja' => [
            'name' => 'Budmat Venecja',
            'tagline' => 'Profil clasic mediteranean cu 8 valuri si performanta superioara. Cel mai vandut profil Budmat.',
            'brand' => 'Budmat',
            'category' => ['slug' => 'tigla-metalica', 'name' => 'Tigla metalica'],
            'subcategory' => ['slug' => 'budmat', 'name' => 'Budmat'],
            'specs' => [
                'Grosime tabla' => '0.50 mm',
                'Latime utila' => '1150 mm',
                'Inaltime val' => '25 mm',
                'Pas tigla' => '700 mm',
                'Panta minima' => '9 grade',
                'Greutate' => '~4.65 kg/mp',
                'Numar valuri' => '8',
                'Otel' => 'S280GD SSAB',
                'Acoperire zinc' => '275 g/m²',
                'Lungime' => 'la comanda',
            ],
            'materials' => [
                'D-Matt' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Gri grafit', 'code' => 'RAL 7024', 'color' => '#474a51'],
                    ['name' => 'Maro cupru', 'code' => 'RAL 8004', 'color' => '#6c3b2a'],
                ],
                'X-Matt Premium' => [
                    ['name' => 'Negru premium', 'code' => 'X-015H', 'color' => '#111111'],
                    ['name' => 'Maro caramiziu', 'code' => 'X-742', 'color' => '#6b3a2a'],
                    ['name' => 'Grafite premium', 'code' => 'X-455H', 'color' => '#3a3d42'],
                    ['name' => 'Visiniu', 'code' => 'X-757', 'color' => '#5a1f25'],
                    ['name' => 'Maro pamant', 'code' => 'X-384H', 'color' => '#4a2e1e'],
                ],
            ],
            'warranty' => 'Garantie 50 de ani de la producator Budmat (Polonia). Otel SSAB - unic in Europa.',
            'description' => '<h2>Tigla metalica Budmat Venecja</h2>
                <p>Budmat Venecja este profilul emblematic al producatorului polonez Budmat, cu un aspect clasic mediteranean care reproduce fidel aspectul tiglei ceramice. Profilul cu 8 valuri ofera un look elegant si rafinat acoperisului dumneavoastra.</p>
                <h3>De ce sa alegi Budmat Venecja?</h3>
                <ul>
                    <li>Otel SSAB Swedish Steel - cel mai bun otel pentru acoperisuri din Europa</li>
                    <li>Garantie 50 de ani - cea mai lunga garantie din categorie</li>
                    <li>Panta minima 9 grade - mai versatila decat competitia</li>
                    <li>Finisaj D-Matt si X-Matt cu rezistenta UV exceptionala</li>
                    <li>Producator cu traditie de peste 30 de ani in Polonia</li>
                </ul>
                <h3>Specificatii tehnice</h3>
                <p>Tabla este fabricata din otel S280GD SSAB cu acoperire de zinc 275 g/m², grosime 0.5mm. Finisajul D-Matt ofera un aspect mat premium cu rezistenta excelenta la intemperii si UV.</p>',
            'related' => [
                ['slug' => 'budmat-bella-sara', 'name' => 'Bella Sara', 'brand' => 'Budmat'],
                ['slug' => 'budmat-como', 'name' => 'Como', 'brand' => 'Budmat'],
                ['slug' => 'metigla-elit', 'name' => 'Elit', 'brand' => 'Metigla'],
                ['slug' => 'wetterbest-clasic', 'name' => 'Clasic', 'brand' => 'Wetterbest'],
            ],
        ],

        'budmat-bella-sara' => [
            'name' => 'Budmat Bella Sara',
            'tagline' => 'Profil sofisticat cu aspect de tigla dubla, adancime 24mm si panta minima 9 grade.',
            'brand' => 'Budmat',
            'category' => ['slug' => 'tigla-metalica', 'name' => 'Tigla metalica'],
            'subcategory' => ['slug' => 'budmat', 'name' => 'Budmat'],
            'specs' => [
                'Grosime tabla' => '0.50 mm',
                'Latime utila' => '1150 mm',
                'Inaltime val' => '24 mm',
                'Pas tigla' => '700 mm',
                'Panta minima' => '9 grade',
                'Otel' => 'S280GD SSAB',
                'Acoperire zinc' => '275 g/m²',
                'Lungime' => 'la comanda',
            ],
            'materials' => [
                'D-Matt' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Gri grafit', 'code' => 'RAL 7024', 'color' => '#474a51'],
                    ['name' => 'Maro cupru', 'code' => 'RAL 8004', 'color' => '#6c3b2a'],
                ],
                'X-Matt Premium' => [
                    ['name' => 'Negru premium', 'code' => 'X-015H', 'color' => '#111111'],
                    ['name' => 'Maro caramiziu', 'code' => 'X-742', 'color' => '#6b3a2a'],
                    ['name' => 'Grafite premium', 'code' => 'X-455H', 'color' => '#3a3d42'],
                    ['name' => 'Visiniu', 'code' => 'X-757', 'color' => '#5a1f25'],
                ],
            ],
            'warranty' => 'Garantie 50 de ani de la producator Budmat (Polonia). Otel SSAB garantat.',
            'description' => '<h2>Tigla metalica Budmat Bella Sara</h2>
                <p>Bella Sara este unul dintre cele mai sofisticate profile din gama Budmat, cu un design distinctiv ce combina eleganta clasica cu performantele tehnice moderne. Profilul se remarca prin aspectul sau deosebit, imitand tigla ceramica de calitate superioara.</p>
                <h3>Caracteristici Bella Sara</h3>
                <ul>
                    <li>Design elegant cu aspect de tigla dubla</li>
                    <li>Adancime val 24mm pentru un aspect tridimensional pronuntat</li>
                    <li>Otel SSAB S280GD cu garantie de 50 de ani</li>
                    <li>Disponibil in finisaj D-Matt si X-Matt Premium</li>
                </ul>',
            'related' => [
                ['slug' => 'budmat-venecja', 'name' => 'Venecja', 'brand' => 'Budmat'],
                ['slug' => 'budmat-como', 'name' => 'Como', 'brand' => 'Budmat'],
                ['slug' => 'metigla-mira', 'name' => 'Mira', 'brand' => 'Metigla'],
            ],
        ],

        'budmat-como' => [
            'name' => 'Budmat Como',
            'tagline' => 'Latime utila maxima 1182mm, profil modern cu aspect premium si garantie 50 ani.',
            'brand' => 'Budmat',
            'category' => ['slug' => 'tigla-metalica', 'name' => 'Tigla metalica'],
            'subcategory' => ['slug' => 'budmat', 'name' => 'Budmat'],
            'specs' => [
                'Grosime tabla' => '0.50 mm',
                'Latime utila' => '1182 mm',
                'Pas tigla' => '700 mm',
                'Panta minima' => '9 grade',
                'Otel' => 'S280GD SSAB',
                'Acoperire zinc' => '275 g/m²',
                'Lungime' => 'la comanda',
            ],
            'materials' => [
                'D-Matt' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Gri grafit', 'code' => 'RAL 7024', 'color' => '#474a51'],
                    ['name' => 'Maro cupru', 'code' => 'RAL 8004', 'color' => '#6c3b2a'],
                ],
                'X-Matt Premium' => [
                    ['name' => 'Negru premium', 'code' => 'X-015H', 'color' => '#111111'],
                    ['name' => 'Maro caramiziu', 'code' => 'X-742', 'color' => '#6b3a2a'],
                    ['name' => 'Grafite premium', 'code' => 'X-455H', 'color' => '#3a3d42'],
                    ['name' => 'Visiniu', 'code' => 'X-757', 'color' => '#5a1f25'],
                ],
            ],
            'warranty' => 'Garantie 50 de ani de la producator Budmat (Polonia).',
            'description' => '<h2>Tigla metalica Budmat Como</h2>
                <p>Como este profilul cu cea mai mare latime utila din gama Budmat - 1182mm, ceea ce inseamna mai putine imbinari si un montaj mai rapid. Designul modern il face potrivit atat pentru case clasice cat si pentru arhitectura contemporana.</p>
                <h3>Avantajele Como</h3>
                <ul>
                    <li>Latimea utila maxima din gama Budmat - 1182mm</li>
                    <li>Montaj mai rapid - mai putine foi necesare pe aceeasi suprafata</li>
                    <li>Design modern potrivit pentru orice stil arhitectural</li>
                    <li>Otel SSAB cu garantie 50 ani</li>
                </ul>',
            'related' => [
                ['slug' => 'budmat-venecja', 'name' => 'Venecja', 'brand' => 'Budmat'],
                ['slug' => 'budmat-bella-sara', 'name' => 'Bella Sara', 'brand' => 'Budmat'],
                ['slug' => 'metigla-star', 'name' => 'Star', 'brand' => 'Metigla'],
            ],
        ],

        // ==========================================
        // TIGLA METALICA - METIGLA
        // ==========================================
        'metigla-elit' => [
            'name' => 'Metigla Elit',
            'tagline' => 'Profil elegant cu inaltime val 14mm, latimea utila 1110mm. Fabricat in Romania.',
            'brand' => 'Metigla',
            'category' => ['slug' => 'tigla-metalica', 'name' => 'Tigla metalica'],
            'subcategory' => ['slug' => 'metigla', 'name' => 'Metigla'],
            'specs' => [
                'Grosime tabla' => '0.50 mm',
                'Latime utila' => '1110 mm',
                'Inaltime val' => '14 mm',
                'Pas tigla' => '350 mm',
                'Panta minima' => '14 grade',
                'Greutate' => '~4.4 kg/mp',
                'Otel' => 'S250GD',
                'Acoperire zinc' => '275 g/m²',
                'Lungime' => '410 - 4960 mm',
            ],
            'materials' => [
                'SuperMat' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Rosu oxid', 'code' => 'RAL 3009', 'color' => '#6d332b'],
                    ['name' => 'Verde crom', 'code' => 'RAL 6020', 'color' => '#2e3a23'],
                    ['name' => 'Gri-maro', 'code' => 'RAL 8019', 'color' => '#4a4039'],
                ],
                'PUR NOVA' => [
                    ['name' => 'Negru PUR', 'code' => 'RAL 9005', 'color' => '#0d0d0d'],
                    ['name' => 'Maro PUR', 'code' => 'RAL 8017', 'color' => '#48352f'],
                    ['name' => 'Gri antracit PUR', 'code' => 'RAL 7016', 'color' => '#2d3436'],
                    ['name' => 'Gri-maro PUR', 'code' => 'RAL 8019', 'color' => '#4e4442'],
                ],
                'Lucios' => [
                    ['name' => 'Maro lucios', 'code' => 'RAL 8017', 'color' => '#503830'],
                    ['name' => 'Rosu lucios', 'code' => 'RAL 3011', 'color' => '#792b2b'],
                    ['name' => 'Verde lucios', 'code' => 'RAL 6005', 'color' => '#1a3a1a'],
                    ['name' => 'Alb lucios', 'code' => 'RAL 9002', 'color' => '#e8e4d5'],
                ],
            ],
            'warranty' => 'Garantie 30 de ani impotriva perforarii (finisaj PUR NOVA). Garantie 20 ani SuperMat. Fabricat in Romania.',
            'description' => '<h2>Tigla metalica Metigla Elit</h2>
                <p>Metigla Elit este profilul de baza al producatorului roman Metigla, cu un design clasic si specificatii tehnice solide. Profilul cu inaltime val 14mm ofera un aspect elegant, potrivit pentru case rezidentiale clasice.</p>
                <h3>Avantaje Metigla Elit</h3>
                <ul>
                    <li>Fabricata in Romania - termene scurte de livrare</li>
                    <li>Profil elegant cu inaltime val 14mm</li>
                    <li>Disponibil cu finisaj PUR NOVA (30 ani garantie culoare)</li>
                    <li>Lungimi la comanda 410-4960mm</li>
                    <li>Gama completa de accesorii disponibila</li>
                </ul>',
            'related' => [
                ['slug' => 'metigla-star', 'name' => 'Star', 'brand' => 'Metigla'],
                ['slug' => 'metigla-mira', 'name' => 'Mira', 'brand' => 'Metigla'],
                ['slug' => 'budmat-venecja', 'name' => 'Venecja', 'brand' => 'Budmat'],
                ['slug' => 'wetterbest-clasic', 'name' => 'Clasic', 'brand' => 'Wetterbest'],
            ],
        ],

        'metigla-star' => [
            'name' => 'Metigla Star',
            'tagline' => 'Profil cu inaltime val 27mm pentru un aspect tridimensional pronuntat. Panta min 14 grade.',
            'brand' => 'Metigla',
            'category' => ['slug' => 'tigla-metalica', 'name' => 'Tigla metalica'],
            'subcategory' => ['slug' => 'metigla', 'name' => 'Metigla'],
            'specs' => [
                'Grosime tabla' => '0.50 mm',
                'Latime utila' => '1100 mm',
                'Inaltime val' => '27 mm',
                'Pas tigla' => '350 mm',
                'Panta minima' => '14 grade',
                'Greutate' => '~4.4 kg/mp',
                'Otel' => 'S250GD',
                'Acoperire zinc' => '275 g/m²',
                'Lungime' => '410 - 4960 mm',
            ],
            'materials' => [
                'SuperMat' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Rosu oxid', 'code' => 'RAL 3009', 'color' => '#6d332b'],
                    ['name' => 'Verde crom', 'code' => 'RAL 6020', 'color' => '#2e3a23'],
                    ['name' => 'Gri-maro', 'code' => 'RAL 8019', 'color' => '#4a4039'],
                ],
                'PUR NOVA' => [
                    ['name' => 'Negru PUR', 'code' => 'RAL 9005', 'color' => '#0d0d0d'],
                    ['name' => 'Maro PUR', 'code' => 'RAL 8017', 'color' => '#48352f'],
                    ['name' => 'Gri antracit PUR', 'code' => 'RAL 7016', 'color' => '#2d3436'],
                    ['name' => 'Gri-maro PUR', 'code' => 'RAL 8019', 'color' => '#4e4442'],
                ],
            ],
            'warranty' => 'Garantie 30 de ani impotriva perforarii (finisaj PUR NOVA). Garantie 20 ani SuperMat.',
            'description' => '<h2>Tigla metalica Metigla Star</h2>
                <p>Metigla Star se remarca prin inaltimea val de 27mm, care ofera un aspect tridimensional mult mai pronuntat comparativ cu profilurile clasice. Acest design conferit acoperisului o aparenta moderna si robusta.</p>
                <h3>Caracteristici Star</h3>
                <ul>
                    <li>Inaltime val 27mm - aspect tridimensional pronuntat</li>
                    <li>Latime utila 1100mm</li>
                    <li>Disponibil cu finisaj SuperMat si PUR NOVA</li>
                    <li>Fabricat in Romania - livrare rapida</li>
                </ul>',
            'related' => [
                ['slug' => 'metigla-elit', 'name' => 'Elit', 'brand' => 'Metigla'],
                ['slug' => 'metigla-mira', 'name' => 'Mira', 'brand' => 'Metigla'],
                ['slug' => 'wetterbest-gladiator', 'name' => 'Gladiator', 'brand' => 'Wetterbest'],
            ],
        ],

        'metigla-mira' => [
            'name' => 'Metigla Mira',
            'tagline' => 'Cel mai inalt profil Metigla - inaltime val 32mm pentru un look mediteranean autentic.',
            'brand' => 'Metigla',
            'category' => ['slug' => 'tigla-metalica', 'name' => 'Tigla metalica'],
            'subcategory' => ['slug' => 'metigla', 'name' => 'Metigla'],
            'specs' => [
                'Grosime tabla' => '0.50 mm',
                'Latime utila' => '1100 mm',
                'Inaltime val' => '32 mm',
                'Pas tigla' => '350 mm',
                'Panta minima' => '14 grade',
                'Greutate' => '~4.4 kg/mp',
                'Otel' => 'S250GD',
                'Acoperire zinc' => '275 g/m²',
                'Lungime' => '410 - 4960 mm',
            ],
            'materials' => [
                'SuperMat' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Rosu oxid', 'code' => 'RAL 3009', 'color' => '#6d332b'],
                    ['name' => 'Verde crom', 'code' => 'RAL 6020', 'color' => '#2e3a23'],
                    ['name' => 'Maro cupru', 'code' => 'RAL 8004', 'color' => '#6c3b2a'],
                ],
                'PUR NOVA' => [
                    ['name' => 'Negru PUR', 'code' => 'RAL 9005', 'color' => '#0d0d0d'],
                    ['name' => 'Maro PUR', 'code' => 'RAL 8017', 'color' => '#48352f'],
                    ['name' => 'Gri antracit PUR', 'code' => 'RAL 7016', 'color' => '#2d3436'],
                ],
            ],
            'warranty' => 'Garantie 30 de ani impotriva perforarii (finisaj PUR NOVA).',
            'description' => '<h2>Tigla metalica Metigla Mira</h2>
                <p>Metigla Mira este profilul premium al gamei Metigla, cu inaltimea val maxima de 32mm. Aceasta adancime pronuntata a profilului creeaza un aspect mediteranean autentic, similar tiglei ceramice clasice.</p>
                <h3>De ce Mira?</h3>
                <ul>
                    <li>Inaltime val 32mm - cel mai pronuntat profil Metigla</li>
                    <li>Aspect mediteranean autentic</li>
                    <li>Finisaj PUR NOVA cu garantie 30 ani culoare</li>
                    <li>Fabricat in Romania din otel S250GD</li>
                </ul>',
            'related' => [
                ['slug' => 'metigla-star', 'name' => 'Star', 'brand' => 'Metigla'],
                ['slug' => 'metigla-elit', 'name' => 'Elit', 'brand' => 'Metigla'],
                ['slug' => 'budmat-venecja', 'name' => 'Venecja', 'brand' => 'Budmat'],
                ['slug' => 'blachotrapez-enigma', 'name' => 'Enigma', 'brand' => 'Blachotrapez'],
            ],
        ],

        'metigla-mistral' => [
            'name' => 'Metigla Mistral',
            'tagline' => 'Profil asimetric cu design modern, potrivit pentru acoperisuri contemporane.',
            'brand' => 'Metigla',
            'category' => ['slug' => 'tigla-metalica', 'name' => 'Tigla metalica'],
            'subcategory' => ['slug' => 'metigla', 'name' => 'Metigla'],
            'specs' => [
                'Grosime tabla' => '0.50 mm',
                'Latime utila' => '1100 mm',
                'Panta minima' => '14 grade',
                'Otel' => 'S250GD',
                'Acoperire zinc' => '275 g/m²',
                'Lungime' => 'la comanda',
            ],
            'materials' => [
                'SuperMat' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Rosu oxid', 'code' => 'RAL 3009', 'color' => '#6d332b'],
                    ['name' => 'Verde crom', 'code' => 'RAL 6020', 'color' => '#2e3a23'],
                ],
                'PUR NOVA' => [
                    ['name' => 'Negru PUR', 'code' => 'RAL 9005', 'color' => '#0d0d0d'],
                    ['name' => 'Maro PUR', 'code' => 'RAL 8017', 'color' => '#48352f'],
                    ['name' => 'Gri antracit PUR', 'code' => 'RAL 7016', 'color' => '#2d3436'],
                ],
            ],
            'warranty' => 'Garantie 30 de ani impotriva perforarii (finisaj PUR NOVA). Fabricat in Romania.',
            'description' => '<h2>Tigla metalica Metigla Mistral</h2>
                <p>Metigla Mistral este un profil modern din gama Metigla, cu un design contemporan potrivit pentru arhitectura actuala. Fabricat in Romania cu aceeasi calitate recunoscuta a brandului Metigla.</p>
                <h3>Caracteristici Mistral</h3>
                <ul>
                    <li>Design modern pentru arhitectura contemporana</li>
                    <li>Fabricat in Romania - livrare rapida</li>
                    <li>Disponibil cu finisaj SuperMat si PUR NOVA</li>
                    <li>Otel S250GD cu acoperire zinc 275 g/m²</li>
                </ul>',
            'related' => [
                ['slug' => 'metigla-mira', 'name' => 'Mira', 'brand' => 'Metigla'],
                ['slug' => 'metigla-star', 'name' => 'Star', 'brand' => 'Metigla'],
                ['slug' => 'wetterbest-cardinal', 'name' => 'Cardinal', 'brand' => 'Wetterbest'],
            ],
        ],

        // ==========================================
        // TIGLA METALICA - BLACHOTRAPEZ
        // ==========================================
        'blachotrapez-enigma' => [
            'name' => 'Blachotrapez Enigma',
            'tagline' => 'Profil premium polonez cu design unic ondulat, aspect natural si performante superioare.',
            'brand' => 'Blachotrapez',
            'category' => ['slug' => 'tigla-metalica', 'name' => 'Tigla metalica'],
            'subcategory' => ['slug' => 'blachotrapez', 'name' => 'Blachotrapez'],
            'specs' => [
                'Grosime tabla' => '0.50 mm',
                'Otel' => 'S250GD',
                'Acoperire zinc' => '275 g/m²',
                'Panta minima' => '14 grade',
                'Lungime' => 'la comanda',
                'Tara productie' => 'Polonia',
            ],
            'materials' => [
                'Mat' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Rosu mat', 'code' => 'RAL 3009', 'color' => '#6d332b'],
                    ['name' => 'Verde mat', 'code' => 'RAL 6020', 'color' => '#2e3a23'],
                    ['name' => 'Vin rosu', 'code' => 'RAL 3005', 'color' => '#5e2028'],
                    ['name' => 'Gri-maro', 'code' => 'RAL 8019', 'color' => '#4a4039'],
                ],
                'Lucios' => [
                    ['name' => 'Maro lucios', 'code' => 'RAL 8017', 'color' => '#503830'],
                    ['name' => 'Rosu lucios', 'code' => 'RAL 3011', 'color' => '#792b2b'],
                    ['name' => 'Verde lucios', 'code' => 'RAL 6005', 'color' => '#1a3a1a'],
                ],
            ],
            'warranty' => 'Garantie 30 de ani impotriva coroziunii. Producator polonez cu peste 30 ani experienta.',
            'description' => '<h2>Tigla metalica Blachotrapez Enigma</h2>
                <p>Enigma este profilul de top al producatorului polonez Blachotrapez, cu un design unic ce combina un aspect natural al tiglei ceramice cu performantele superioare ale otelului. Profilul se remarca prin forma sa distinctiva si finisajele premium disponibile.</p>
                <h3>Ce face Enigma speciala?</h3>
                <ul>
                    <li>Design unic - profilul cel mai distinct din gama Blachotrapez</li>
                    <li>Fabricat in Polonia cu standarde europene inalte</li>
                    <li>Disponibil in gama completa de culori RAL</li>
                    <li>Garantie 30 ani impotriva coroziunii</li>
                    <li>Compatibil cu accesoriile complete Blachotrapez</li>
                </ul>',
            'related' => [
                ['slug' => 'blachotrapez-germania-simetric', 'name' => 'Germania Simetric', 'brand' => 'Blachotrapez'],
                ['slug' => 'blachotrapez-kingas', 'name' => 'Kingas', 'brand' => 'Blachotrapez'],
                ['slug' => 'budmat-venecja', 'name' => 'Venecja', 'brand' => 'Budmat'],
            ],
        ],

        'blachotrapez-germania-simetric' => [
            'name' => 'Blachotrapez Germania Simetric',
            'tagline' => 'Profil simetric clasic cu aspect de tigla traditionala germana si panta minima 14 grade.',
            'brand' => 'Blachotrapez',
            'category' => ['slug' => 'tigla-metalica', 'name' => 'Tigla metalica'],
            'subcategory' => ['slug' => 'blachotrapez', 'name' => 'Blachotrapez'],
            'specs' => [
                'Grosime tabla' => '0.50 mm',
                'Otel' => 'S250GD',
                'Acoperire zinc' => '275 g/m²',
                'Panta minima' => '14 grade',
                'Lungime' => 'la comanda',
                'Tara productie' => 'Polonia',
            ],
            'materials' => [
                'Mat' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Rosu mat', 'code' => 'RAL 3009', 'color' => '#6d332b'],
                    ['name' => 'Verde mat', 'code' => 'RAL 6020', 'color' => '#2e3a23'],
                    ['name' => 'Gri-maro', 'code' => 'RAL 8019', 'color' => '#4a4039'],
                ],
            ],
            'warranty' => 'Garantie 30 de ani impotriva coroziunii. Producator polonez cu certificare europeana.',
            'description' => '<h2>Tigla metalica Blachotrapez Germania Simetric</h2>
                <p>Germania Simetric este un profil clasic cu un design simetric elegant, inspirat din arhitectura traditionala germana. Profilul se remarcat prin regularitatea valurilor sale si aspectul uniform al suprafetei.</p>
                <h3>Caracteristici Germania Simetric</h3>
                <ul>
                    <li>Profil simetric cu aspect uniform si elegant</li>
                    <li>Potrivit pentru case cu arhitectura clasica sau traditionala</li>
                    <li>Fabricat in Polonia din otel de calitate superioara</li>
                    <li>Gama variata de culori mat</li>
                </ul>',
            'related' => [
                ['slug' => 'blachotrapez-enigma', 'name' => 'Enigma', 'brand' => 'Blachotrapez'],
                ['slug' => 'blachotrapez-kingas', 'name' => 'Kingas', 'brand' => 'Blachotrapez'],
                ['slug' => 'metigla-star', 'name' => 'Star', 'brand' => 'Metigla'],
            ],
        ],

        'blachotrapez-kingas' => [
            'name' => 'Blachotrapez Kingas',
            'tagline' => 'Profil Kingas cu aspect ondulat natural, ideal pentru case cu arhitectura rustica sau clasica.',
            'brand' => 'Blachotrapez',
            'category' => ['slug' => 'tigla-metalica', 'name' => 'Tigla metalica'],
            'subcategory' => ['slug' => 'blachotrapez', 'name' => 'Blachotrapez'],
            'specs' => [
                'Grosime tabla' => '0.50 mm',
                'Otel' => 'S250GD',
                'Acoperire zinc' => '275 g/m²',
                'Panta minima' => '14 grade',
                'Lungime' => 'la comanda',
                'Tara productie' => 'Polonia',
            ],
            'materials' => [
                'Mat' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Rosu mat', 'code' => 'RAL 3009', 'color' => '#6d332b'],
                    ['name' => 'Verde mat', 'code' => 'RAL 6020', 'color' => '#2e3a23'],
                    ['name' => 'Vin rosu', 'code' => 'RAL 3005', 'color' => '#5e2028'],
                    ['name' => 'Gri-maro', 'code' => 'RAL 8019', 'color' => '#4a4039'],
                ],
            ],
            'warranty' => 'Garantie 30 de ani impotriva coroziunii.',
            'description' => '<h2>Tigla metalica Blachotrapez Kingas</h2>
                <p>Kingas este un profil de tigla metalica cu un aspect ondulat natural care da acoperisului un caracter rustic si autentic. Profilul este deosebit de potrivit pentru case cu arhitectura traditionala sau rurala.</p>
                <h3>Avantaje Kingas</h3>
                <ul>
                    <li>Aspect ondulat natural - similar tiglei ceramice rurale</li>
                    <li>Potrivit pentru case cu arhitectura traditionala</li>
                    <li>Disponibil in gama completa de culori mat</li>
                    <li>Producator polonez cu garantie europeana</li>
                </ul>',
            'related' => [
                ['slug' => 'blachotrapez-diament', 'name' => 'Diament', 'brand' => 'Blachotrapez'],
                ['slug' => 'blachotrapez-enigma', 'name' => 'Enigma', 'brand' => 'Blachotrapez'],
                ['slug' => 'metigla-mira', 'name' => 'Mira', 'brand' => 'Metigla'],
            ],
        ],

        'blachotrapez-diament' => [
            'name' => 'Blachotrapez Diament',
            'tagline' => 'Profil Diament - design modern rombic, pentru acoperisuri cu aspect contemporan premium.',
            'brand' => 'Blachotrapez',
            'category' => ['slug' => 'tigla-metalica', 'name' => 'Tigla metalica'],
            'subcategory' => ['slug' => 'blachotrapez', 'name' => 'Blachotrapez'],
            'specs' => [
                'Grosime tabla' => '0.50 mm',
                'Otel' => 'S250GD',
                'Acoperire zinc' => '275 g/m²',
                'Panta minima' => '14 grade',
                'Lungime' => 'la comanda',
                'Tara productie' => 'Polonia',
            ],
            'materials' => [
                'Mat' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Rosu mat', 'code' => 'RAL 3009', 'color' => '#6d332b'],
                    ['name' => 'Verde mat', 'code' => 'RAL 6020', 'color' => '#2e3a23'],
                    ['name' => 'Gri-maro', 'code' => 'RAL 8019', 'color' => '#4a4039'],
                ],
                'Lucios' => [
                    ['name' => 'Maro lucios', 'code' => 'RAL 8017', 'color' => '#503830'],
                    ['name' => 'Rosu lucios', 'code' => 'RAL 3011', 'color' => '#792b2b'],
                ],
            ],
            'warranty' => 'Garantie 30 de ani impotriva coroziunii. Finisaj mat premium.',
            'description' => '<h2>Tigla metalica Blachotrapez Diament</h2>
                <p>Diament este profilul cu aspectul cel mai modern din gama Blachotrapez, cu un design geometric inspirat din forma unui diamant. Profilul se distinge prin liniile sale curate si aspectul contemporan.</p>
                <h3>Design Diament</h3>
                <ul>
                    <li>Design geometric modern - aspect premium</li>
                    <li>Potrivit pentru case contemporane si vile moderne</li>
                    <li>Fabricat in Polonia cu standarde de calitate superioare</li>
                    <li>Compatibil cu gama completa de accesorii Blachotrapez</li>
                </ul>',
            'related' => [
                ['slug' => 'blachotrapez-enigma', 'name' => 'Enigma', 'brand' => 'Blachotrapez'],
                ['slug' => 'blachotrapez-kingas', 'name' => 'Kingas', 'brand' => 'Blachotrapez'],
                ['slug' => 'wetterbest-colosseum', 'name' => 'Colosseum', 'brand' => 'Wetterbest'],
            ],
        ],

        // ==========================================
        // TIGLA METALICA - WETTERBEST
        // ==========================================
        'wetterbest-clasic' => [
            'name' => 'Wetterbest Clasic',
            'tagline' => 'Profilul entry-level Wetterbest cu inaltime val 23mm. Raport calitate-pret excelent.',
            'brand' => 'Wetterbest',
            'category' => ['slug' => 'tigla-metalica', 'name' => 'Tigla metalica'],
            'subcategory' => ['slug' => 'wetterbest', 'name' => 'Wetterbest'],
            'specs' => [
                'Grosime tabla' => '0.35 - 0.50 mm',
                'Latime utila' => '1120 mm',
                'Inaltime val' => '23 mm',
                'Panta minima' => '14 grade',
                'Lungime' => 'la comanda',
                'Tara productie' => 'Romania',
            ],
            'materials' => [
                'Mat (35um)' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Rosu mat', 'code' => 'RAL 3009', 'color' => '#6d332b'],
                    ['name' => 'Verde mat', 'code' => 'RAL 6005', 'color' => '#1a3a1a'],
                    ['name' => 'Gri grafit', 'code' => 'RAL 7024', 'color' => '#474a51'],
                ],
                'Lucios (25um)' => [
                    ['name' => 'Rosu lucios', 'code' => 'RAL 3000', 'color' => '#aa2e19'],
                    ['name' => 'Maro lucios', 'code' => 'RAL 8004', 'color' => '#6c3b2a'],
                    ['name' => 'Alb', 'code' => 'RAL 9002', 'color' => '#e8e4d5'],
                    ['name' => 'Albastru', 'code' => 'RAL 5010', 'color' => '#0e4a8a'],
                ],
                'Neomat 30' => [
                    ['name' => 'Negru Neomat', 'code' => 'RAL 9005', 'color' => '#111111'],
                    ['name' => 'Maro Neomat', 'code' => 'RAL 8017', 'color' => '#4a3530'],
                    ['name' => 'Gri antracit Neomat', 'code' => 'RAL 7016', 'color' => '#2e3335'],
                ],
            ],
            'warranty' => 'Garantie 15 ani culoare (finisaj Mat). Garantie 30 ani coroziune (Neomat 30). Fabricat in Romania.',
            'description' => '<h2>Tigla metalica Wetterbest Clasic</h2>
                <p>Wetterbest Clasic este profilul de baza al producatorului roman Wetterbest, cu un raport excelent calitate-pret. Cu o latime utila de 1120mm si inaltime val de 23mm, Clasic este o alegere populara pentru constructii rezidentiale.</p>
                <h3>Avantaje Wetterbest Clasic</h3>
                <ul>
                    <li>Fabricat in Romania - livrare rapida</li>
                    <li>Pret competitiv cu garantie buna</li>
                    <li>Disponibil in 3 finisaje (Lucios, Mat, Neomat 30)</li>
                    <li>Gama larga de culori RAL</li>
                </ul>',
            'related' => [
                ['slug' => 'wetterbest-cardinal', 'name' => 'Cardinal', 'brand' => 'Wetterbest'],
                ['slug' => 'wetterbest-gladiator', 'name' => 'Gladiator', 'brand' => 'Wetterbest'],
                ['slug' => 'metigla-elit', 'name' => 'Elit', 'brand' => 'Metigla'],
            ],
        ],

        'wetterbest-cardinal' => [
            'name' => 'Wetterbest Cardinal',
            'tagline' => 'Profil cu latime utila maxima 1150mm si inaltime val 25mm. Echilibru perfect design-performanta.',
            'brand' => 'Wetterbest',
            'category' => ['slug' => 'tigla-metalica', 'name' => 'Tigla metalica'],
            'subcategory' => ['slug' => 'wetterbest', 'name' => 'Wetterbest'],
            'specs' => [
                'Grosime tabla' => '0.45 - 0.50 mm',
                'Latime utila' => '1150 mm',
                'Inaltime val' => '25 mm',
                'Panta minima' => '14 grade',
                'Lungime' => 'la comanda',
                'Tara productie' => 'Romania',
            ],
            'materials' => [
                'Mat (35um)' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Rosu mat', 'code' => 'RAL 3009', 'color' => '#6d332b'],
                    ['name' => 'Verde mat', 'code' => 'RAL 6005', 'color' => '#1a3a1a'],
                    ['name' => 'Maro-gri', 'code' => 'RAL 8019', 'color' => '#4a4039'],
                ],
                'Neomat 30' => [
                    ['name' => 'Negru Neomat', 'code' => 'RAL 9005', 'color' => '#111111'],
                    ['name' => 'Maro Neomat', 'code' => 'RAL 8017', 'color' => '#4a3530'],
                    ['name' => 'Gri antracit Neomat', 'code' => 'RAL 7016', 'color' => '#2e3335'],
                    ['name' => 'Maro-gri Neomat', 'code' => 'RAL 8019', 'color' => '#4e4442'],
                ],
            ],
            'warranty' => 'Garantie 30 ani coroziune (Neomat 30). Fabricat in Romania.',
            'description' => '<h2>Tigla metalica Wetterbest Cardinal</h2>
                <p>Cardinal este unul dintre cele mai populare profile Wetterbest, cu o latime utila generoasa de 1150mm si un design echilibrat. Profilul combina aspectul traditional al tiglei cu performantele moderne ale otelului zincat.</p>
                <h3>Cardinal - alegerea echilibrata</h3>
                <ul>
                    <li>Latime utila 1150mm - montaj eficient</li>
                    <li>Inaltime val 25mm - aspect tridimensional</li>
                    <li>Finisaj Neomat 30 cu garantie 30 ani</li>
                    <li>Fabricat in Romania din otel de calitate</li>
                </ul>',
            'related' => [
                ['slug' => 'wetterbest-clasic', 'name' => 'Clasic', 'brand' => 'Wetterbest'],
                ['slug' => 'wetterbest-gladiator', 'name' => 'Gladiator', 'brand' => 'Wetterbest'],
                ['slug' => 'metigla-star', 'name' => 'Star', 'brand' => 'Metigla'],
            ],
        ],

        'wetterbest-gladiator' => [
            'name' => 'Wetterbest Gladiator',
            'tagline' => 'Profil robust cu inaltime val 30mm pentru un aspect puternic si modern al acoperisului.',
            'brand' => 'Wetterbest',
            'category' => ['slug' => 'tigla-metalica', 'name' => 'Tigla metalica'],
            'subcategory' => ['slug' => 'wetterbest', 'name' => 'Wetterbest'],
            'specs' => [
                'Grosime tabla' => '0.45 - 0.50 mm',
                'Latime utila' => '1120 mm',
                'Inaltime val' => '30 mm',
                'Panta minima' => '14 grade',
                'Lungime' => 'la comanda',
                'Tara productie' => 'Romania',
            ],
            'materials' => [
                'Mat (35um)' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Rosu mat', 'code' => 'RAL 3009', 'color' => '#6d332b'],
                    ['name' => 'Verde mat', 'code' => 'RAL 6005', 'color' => '#1a3a1a'],
                    ['name' => 'Gri grafit', 'code' => 'RAL 7024', 'color' => '#474a51'],
                ],
                'Neomat 30' => [
                    ['name' => 'Negru Neomat', 'code' => 'RAL 9005', 'color' => '#111111'],
                    ['name' => 'Maro Neomat', 'code' => 'RAL 8017', 'color' => '#4a3530'],
                    ['name' => 'Gri antracit Neomat', 'code' => 'RAL 7016', 'color' => '#2e3335'],
                ],
            ],
            'warranty' => 'Garantie 30 ani coroziune (Neomat 30). Garantie 15 ani culoare (Mat).',
            'description' => '<h2>Tigla metalica Wetterbest Gladiator</h2>
                <p>Gladiator este profilul mediu-inalt din gama Wetterbest, cu o inaltime val de 30mm care creeaza un aspect puternic si tridimensional. Numele sau evoca robustetea si rezistenta acestui profil.</p>
                <h3>Forta lui Gladiator</h3>
                <ul>
                    <li>Inaltime val 30mm - aspect robust si modern</li>
                    <li>Rezistenta excelenta la vant si intemperii</li>
                    <li>Disponibil in finisaj Mat si Neomat 30</li>
                    <li>Fabricat in Romania, livrare rapida</li>
                </ul>',
            'related' => [
                ['slug' => 'wetterbest-colosseum', 'name' => 'Colosseum', 'brand' => 'Wetterbest'],
                ['slug' => 'wetterbest-cardinal', 'name' => 'Cardinal', 'brand' => 'Wetterbest'],
                ['slug' => 'metigla-mira', 'name' => 'Mira', 'brand' => 'Metigla'],
            ],
        ],

        'wetterbest-colosseum' => [
            'name' => 'Wetterbest Colosseum',
            'tagline' => 'Profilul cu cea mai mare inaltime val - 46mm. Aspect mediteranean impunator, panta min 14 grade.',
            'brand' => 'Wetterbest',
            'category' => ['slug' => 'tigla-metalica', 'name' => 'Tigla metalica'],
            'subcategory' => ['slug' => 'wetterbest', 'name' => 'Wetterbest'],
            'specs' => [
                'Grosime tabla' => '0.45 - 0.50 mm',
                'Latime utila' => '1045 mm',
                'Inaltime val' => '46 mm',
                'Panta minima' => '14 grade',
                'Lungime' => 'la comanda',
                'Tara productie' => 'Romania',
            ],
            'materials' => [
                'Mat (35um)' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Rosu mat', 'code' => 'RAL 3009', 'color' => '#6d332b'],
                    ['name' => 'Verde mat', 'code' => 'RAL 6005', 'color' => '#1a3a1a'],
                    ['name' => 'Gri grafit', 'code' => 'RAL 7024', 'color' => '#474a51'],
                    ['name' => 'Maro-gri', 'code' => 'RAL 8019', 'color' => '#4a4039'],
                ],
                'Neomat 30' => [
                    ['name' => 'Negru Neomat', 'code' => 'RAL 9005', 'color' => '#111111'],
                    ['name' => 'Maro Neomat', 'code' => 'RAL 8017', 'color' => '#4a3530'],
                    ['name' => 'Gri antracit Neomat', 'code' => 'RAL 7016', 'color' => '#2e3335'],
                    ['name' => 'Gri grafit Neomat', 'code' => 'RAL 7024', 'color' => '#4a4d54'],
                ],
            ],
            'warranty' => 'Garantie 30 ani coroziune (Neomat 30). Cel mai inalt profil din gama Wetterbest.',
            'description' => '<h2>Tigla metalica Wetterbest Colosseum</h2>
                <p>Colosseum este profilul cu cea mai mare inaltime val din intreaga gama Wetterbest - 46mm. Acest profil impunator ofera un aspect mediteranean autentic, imitand fidel tigla ceramica clasica cu profilul sau pronuntat.</p>
                <h3>De ce Colosseum?</h3>
                <ul>
                    <li>Inaltime val 46mm - cea mai mare din gama Wetterbest</li>
                    <li>Aspect mediteranean impunator si autentic</li>
                    <li>Potrivit pentru vile si case cu caracter mediteranean</li>
                    <li>Finisaj Neomat 30 cu garantie 30 ani</li>
                </ul>',
            'related' => [
                ['slug' => 'wetterbest-imperator', 'name' => 'Imperator', 'brand' => 'Wetterbest'],
                ['slug' => 'wetterbest-gladiator', 'name' => 'Gladiator', 'brand' => 'Wetterbest'],
                ['slug' => 'budmat-venecja', 'name' => 'Venecja', 'brand' => 'Budmat'],
            ],
        ],

        'wetterbest-imperator' => [
            'name' => 'Wetterbest Imperator',
            'tagline' => 'Profil cu aspect dublu val si latime utila 1020mm. Designul cel mai distinctiv din gama Wetterbest.',
            'brand' => 'Wetterbest',
            'category' => ['slug' => 'tigla-metalica', 'name' => 'Tigla metalica'],
            'subcategory' => ['slug' => 'wetterbest', 'name' => 'Wetterbest'],
            'specs' => [
                'Grosime tabla' => '0.45 - 0.50 mm',
                'Latime utila' => '1020 mm',
                'Inaltime val' => '38 mm',
                'Panta minima' => '14 grade',
                'Lungime' => 'la comanda',
                'Tara productie' => 'Romania',
            ],
            'materials' => [
                'Mat (35um)' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Rosu mat', 'code' => 'RAL 3009', 'color' => '#6d332b'],
                    ['name' => 'Verde mat', 'code' => 'RAL 6005', 'color' => '#1a3a1a'],
                    ['name' => 'Vin rosu', 'code' => 'RAL 3005', 'color' => '#5e2028'],
                ],
                'Neomat 30' => [
                    ['name' => 'Negru Neomat', 'code' => 'RAL 9005', 'color' => '#111111'],
                    ['name' => 'Maro Neomat', 'code' => 'RAL 8017', 'color' => '#4a3530'],
                    ['name' => 'Gri antracit Neomat', 'code' => 'RAL 7016', 'color' => '#2e3335'],
                ],
            ],
            'warranty' => 'Garantie 30 ani coroziune (Neomat 30). Fabricat in Romania.',
            'description' => '<h2>Tigla metalica Wetterbest Imperator</h2>
                <p>Imperator este profilul cu designul cel mai distinctiv din gama Wetterbest, cu un aspect inedit care ii confera personalitatii unice acoperisului. Profilul cu inaltime val de 38mm si latime utila de 1020mm este ideal pentru proiecte cu pretentii estetice ridicate.</p>
                <h3>Distinctia Imperator</h3>
                <ul>
                    <li>Design distinctiv si unic in gama Wetterbest</li>
                    <li>Inaltime val 38mm pentru un aspect pronuntat</li>
                    <li>Potrivit pentru case cu arhitectura premium</li>
                    <li>Disponibil in finisaj Mat si Neomat 30</li>
                </ul>',
            'related' => [
                ['slug' => 'wetterbest-colosseum', 'name' => 'Colosseum', 'brand' => 'Wetterbest'],
                ['slug' => 'wetterbest-cardinal', 'name' => 'Cardinal', 'brand' => 'Wetterbest'],
                ['slug' => 'blachotrapez-enigma', 'name' => 'Enigma', 'brand' => 'Blachotrapez'],
            ],
        ],

        // ==========================================
        // TABLA FALTUITA
        // ==========================================
        'metigla-clic' => [
            'name' => 'Metigla Clic',
            'tagline' => 'Sistem tabla faltuita cu imbinare click, latime utila 515mm, panta minima 8 grade.',
            'brand' => 'Metigla',
            'category' => ['slug' => 'tabla-faltuita', 'name' => 'Tabla faltuita'],
            'subcategory' => ['slug' => 'metigla', 'name' => 'Metigla'],
            'specs' => [
                'Grosime tabla' => '0.50 mm',
                'Latime utila' => '515 mm',
                'Inaltime falt' => '25 mm',
                'Panta minima' => '8 grade',
                'Otel' => 'S250GD',
                'Acoperire zinc' => '275 g/m²',
                'Lungime' => '500 - 6000 mm',
                'Varianta FONO' => 'disponibila',
            ],
            'materials' => [
                'SuperMat' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Gri-maro', 'code' => 'RAL 8019', 'color' => '#4a4039'],
                ],
                'PUR NOVA' => [
                    ['name' => 'Negru PUR', 'code' => 'RAL 9005', 'color' => '#0d0d0d'],
                    ['name' => 'Maro PUR', 'code' => 'RAL 8017', 'color' => '#48352f'],
                    ['name' => 'Gri antracit PUR', 'code' => 'RAL 7016', 'color' => '#2d3436'],
                ],
            ],
            'warranty' => 'Garantie 30 ani impotriva perforarii (PUR NOVA). Fabricat in Romania.',
            'description' => '<h2>Tabla faltuita Metigla Clic</h2>
                <p>Metigla Clic este sistemul de tabla faltuita cu imbinare click al producatorului roman Metigla. Sistemul asigura o fixare simpla si rapida a panourilor, fara suruburi vizibile, rezultand o suprafata curata si eleganta.</p>
                <h3>Avantaje Clic</h3>
                <ul>
                    <li>Sistem click - montaj rapid si simplu</li>
                    <li>Latime utila 515mm - aspect modern cu imbinari discrete</li>
                    <li>Panta minima 8 grade - versatil</li>
                    <li>Disponibil cu varianta FONO (fonoabsorbtie + anticondens)</li>
                    <li>Fabricat in Romania - livrare rapida</li>
                </ul>',
            'related' => [
                ['slug' => 'metigla-falt', 'name' => 'Falt Metigla', 'brand' => 'Metigla'],
                ['slug' => 'vestalpin-click', 'name' => 'Click Vestalpin', 'brand' => 'Vestalpin'],
                ['slug' => 'wetterbest-click', 'name' => 'Click Wetterbest', 'brand' => 'Wetterbest'],
            ],
        ],

        'metigla-falt' => [
            'name' => 'Metigla Falt',
            'tagline' => 'Sistem tabla faltuita cu falt vertical dublu, panta minima 4 grade - cea mai mica panta disponibila.',
            'brand' => 'Metigla',
            'category' => ['slug' => 'tabla-faltuita', 'name' => 'Tabla faltuita'],
            'subcategory' => ['slug' => 'metigla', 'name' => 'Metigla'],
            'specs' => [
                'Grosime tabla' => '0.50 mm',
                'Latime utila' => '550 mm',
                'Inaltime falt' => '27 mm',
                'Panta minima' => '4 grade',
                'Otel' => 'S250GD',
                'Acoperire zinc' => '275 g/m²',
                'Lungime' => '500 - 6000 mm',
                'Varianta FONO' => 'disponibila',
            ],
            'materials' => [
                'SuperMat' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Gri-maro', 'code' => 'RAL 8019', 'color' => '#4a4039'],
                    ['name' => 'Maro cupru', 'code' => 'RAL 8004', 'color' => '#6c3b2a'],
                ],
                'PUR NOVA' => [
                    ['name' => 'Negru PUR', 'code' => 'RAL 9005', 'color' => '#0d0d0d'],
                    ['name' => 'Maro PUR', 'code' => 'RAL 8017', 'color' => '#48352f'],
                    ['name' => 'Gri antracit PUR', 'code' => 'RAL 7016', 'color' => '#2d3436'],
                    ['name' => 'Gri-maro PUR', 'code' => 'RAL 8019', 'color' => '#4e4442'],
                ],
            ],
            'warranty' => 'Garantie 30 ani impotriva perforarii (PUR NOVA). Panta minima 4 grade - unic in piata.',
            'description' => '<h2>Tabla faltuita Metigla Falt</h2>
                <p>Metigla Falt este sistemul de tabla faltuita premium al producatorului roman Metigla, cu falt vertical dublu care permite utilizarea pe acoperisuri cu pante extrem de mici - de la doar 4 grade. Aceasta caracteristica unica il face potrivit pentru un spectru larg de aplicatii arhitecturale.</p>
                <h3>De ce Metigla Falt?</h3>
                <ul>
                    <li>Panta minima 4 grade - potrivit pentru acoperisuri plate sau cu panta redusa</li>
                    <li>Sistem falt vertical dublu - etanseitate maxima</li>
                    <li>Latime utila 550mm - imbinari discrete</li>
                    <li>Varianta FONO cu membrana anticondens si fonoabsorbanta</li>
                    <li>Fabricat in Romania din otel S250GD</li>
                </ul>',
            'related' => [
                ['slug' => 'metigla-clic', 'name' => 'Clic Metigla', 'brand' => 'Metigla'],
                ['slug' => 'vestalpin-click', 'name' => 'Click Vestalpin', 'brand' => 'Vestalpin'],
                ['slug' => 'wetterbest-click', 'name' => 'Click Wetterbest', 'brand' => 'Wetterbest'],
            ],
        ],

        'vestalpin-click' => [
            'name' => 'Vestalpin Tabla Click',
            'tagline' => 'Tabla faltuita click Vestalpin (Austria) - 0.50mm, culori RAL premium, aspect arhitectural modern.',
            'brand' => 'Vestalpin',
            'category' => ['slug' => 'tabla-faltuita', 'name' => 'Tabla faltuita'],
            'subcategory' => ['slug' => 'vestalpin', 'name' => 'Vestalpin'],
            'specs' => [
                'Grosime tabla' => '0.50 mm',
                'Tip sistem' => 'Click (falt ascuns)',
                'Tara productie' => 'Austria',
                'Standard' => 'EN 10169',
            ],
            'materials' => [
                'Mat Premium' => [
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri-maro', 'code' => 'RAL 8019', 'color' => '#4a4039'],
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Rosu oxid', 'code' => 'RAL 3009', 'color' => '#6d332b'],
                    ['name' => 'Verde inchis', 'code' => 'RAL 6005', 'color' => '#1a3a1a'],
                ],
            ],
            'warranty' => 'Garantie producator Vestalpin Austria. Tabla premium cu calitate austriaca.',
            'description' => '<h2>Tabla faltuita click Vestalpin</h2>
                <p>Vestalpin este un producator austriac de renume pentru tabla faltuita de calitate superioara. Sistemul click Vestalpin se remarca prin simplitatea montajului si aspectul arhitectural curat, fara elemente de fixare vizibile.</p>
                <h3>Calitatea austriaca Vestalpin</h3>
                <ul>
                    <li>Producator austriac cu traditie in tabla pentru acoperisuri</li>
                    <li>Grosime 0.50mm - rigiditate si durabilitate superioare</li>
                    <li>Sistem click cu fixare ascunsa - aspect curat</li>
                    <li>Culori RAL premium cu rezistenta UV exceptionala</li>
                    <li>Potrivit pentru acoperisuri rezidentiale si comerciale</li>
                </ul>',
            'related' => [
                ['slug' => 'metigla-clic', 'name' => 'Clic Metigla', 'brand' => 'Metigla'],
                ['slug' => 'metigla-falt', 'name' => 'Falt Metigla', 'brand' => 'Metigla'],
                ['slug' => 'wetterbest-click', 'name' => 'Click Wetterbest', 'brand' => 'Wetterbest'],
            ],
        ],

        'wetterbest-click' => [
            'name' => 'Wetterbest Click',
            'tagline' => 'Tabla faltuita click Wetterbest - latime utila 500mm, falt 29mm, panta min 8 grade.',
            'brand' => 'Wetterbest',
            'category' => ['slug' => 'tabla-faltuita', 'name' => 'Tabla faltuita'],
            'subcategory' => ['slug' => 'wetterbest', 'name' => 'Wetterbest'],
            'specs' => [
                'Grosime tabla' => '0.45 - 0.50 mm',
                'Latime utila' => '500 mm',
                'Inaltime falt' => '29 mm',
                'Panta minima' => '8 grade',
                'Tara productie' => 'Romania',
                'Lungime' => 'la comanda',
            ],
            'materials' => [
                'Mat (35um)' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Gri grafit', 'code' => 'RAL 7024', 'color' => '#474a51'],
                    ['name' => 'Maro-gri', 'code' => 'RAL 8019', 'color' => '#4a4039'],
                ],
                'Neomat 30' => [
                    ['name' => 'Negru Neomat', 'code' => 'RAL 9005', 'color' => '#111111'],
                    ['name' => 'Maro Neomat', 'code' => 'RAL 8017', 'color' => '#4a3530'],
                    ['name' => 'Gri antracit Neomat', 'code' => 'RAL 7016', 'color' => '#2e3335'],
                ],
            ],
            'warranty' => 'Garantie 30 ani (Neomat 30). Fabricat in Romania.',
            'description' => '<h2>Tabla faltuita Wetterbest Click</h2>
                <p>Wetterbest Click este sistemul de tabla faltuita cu imbinare click al producatorului roman Wetterbest. Cu o latime utila de 500mm si un falt de 29mm, sistemul asigura etanseitate superioara si un aspect modern.</p>
                <h3>Avantaje Wetterbest Click</h3>
                <ul>
                    <li>Fabricat in Romania - livrare rapida</li>
                    <li>Sistem click cu fixare ascunsa</li>
                    <li>Finisaj Neomat 30 cu garantie 30 ani</li>
                    <li>Compatibil cu gama completa de accesorii Wetterbest</li>
                </ul>',
            'related' => [
                ['slug' => 'metigla-clic', 'name' => 'Clic Metigla', 'brand' => 'Metigla'],
                ['slug' => 'metigla-falt', 'name' => 'Falt Metigla', 'brand' => 'Metigla'],
                ['slug' => 'vestalpin-click', 'name' => 'Click Vestalpin', 'brand' => 'Vestalpin'],
            ],
        ],

        // ==========================================
        // TABLA CUTATA - BLACHOTRAPEZ
        // ==========================================
        'blachotrapez-t18' => [
            'name' => 'Blachotrapez T18',
            'tagline' => 'Tabla cutata trapezoidala T18 - profil mic 18mm pentru pereti, sarpante si constructii usoare.',
            'brand' => 'Blachotrapez',
            'category' => ['slug' => 'tabla-cutata', 'name' => 'Tabla cutata'],
            'subcategory' => ['slug' => 'blachotrapez', 'name' => 'Blachotrapez'],
            'specs' => [
                'Profil' => 'T18 (inaltime 18mm)',
                'Grosime' => '0.45 - 0.75 mm',
                'Latime utila' => '1100 mm',
                'Panta minima' => '8 grade',
                'Aplicatii' => 'Pereti, sarpante usoare',
                'Tara productie' => 'Polonia',
            ],
            'materials' => [
                'Zincat' => [
                    ['name' => 'Zincat natural', 'code' => 'Z275', 'color' => '#c0c0c0'],
                ],
                'Vopsit' => [
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Rosu mat', 'code' => 'RAL 3009', 'color' => '#6d332b'],
                ],
            ],
            'warranty' => 'Garantie 10 ani. Producator polonez Blachotrapez.',
            'description' => '<h2>Tabla cutata Blachotrapez T18</h2>
                <p>Blachotrapez T18 este profilul de tabla cutata cu inaltime minima de 18mm, ideal pentru aplicatii usoare: pereti de gard, sarpante de garaje, constructii agricole si acoperisuri cu pante mari.</p>
                <h3>Aplicatii T18</h3>
                <ul>
                    <li>Acoperisuri de garaje si anexe</li>
                    <li>Pereti de constructii metalice usoare</li>
                    <li>Sarpante de hale mici</li>
                    <li>Garduri metalice</li>
                </ul>',
            'related' => [
                ['slug' => 'blachotrapez-t35', 'name' => 'T35', 'brand' => 'Blachotrapez'],
                ['slug' => 'blachotrapez-t55', 'name' => 'T55', 'brand' => 'Blachotrapez'],
            ],
        ],

        'blachotrapez-t35' => [
            'name' => 'Blachotrapez T35',
            'tagline' => 'Cel mai popular profil industrial - T35 cu inaltime 35mm pentru hale, depozite si constructii industriale.',
            'brand' => 'Blachotrapez',
            'category' => ['slug' => 'tabla-cutata', 'name' => 'Tabla cutata'],
            'subcategory' => ['slug' => 'blachotrapez', 'name' => 'Blachotrapez'],
            'specs' => [
                'Profil' => 'T35 (inaltime 35mm)',
                'Grosime' => '0.45 - 0.75 mm',
                'Latime utila' => '1030 mm',
                'Panta minima' => '5 grade',
                'Lungime maxima' => '12500 mm',
                'Aplicatii' => 'Hale, depozite, acoperisuri industriale',
            ],
            'materials' => [
                'Zincat' => [
                    ['name' => 'Zincat natural', 'code' => 'Z275', 'color' => '#c0c0c0'],
                ],
                'Vopsit' => [
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Rosu mat', 'code' => 'RAL 3009', 'color' => '#6d332b'],
                    ['name' => 'Verde inchis', 'code' => 'RAL 6005', 'color' => '#1a3a1a'],
                    ['name' => 'Albastru', 'code' => 'RAL 5010', 'color' => '#0e4a8a'],
                ],
            ],
            'warranty' => 'Garantie 10-15 ani. Cel mai vandut profil industrial.',
            'description' => '<h2>Tabla cutata Blachotrapez T35</h2>
                <p>Blachotrapez T35 este cel mai popular profil de tabla cutata pentru aplicatii industriale si semi-industriale. Cu o inaltime de 35mm si o panta minima de 5 grade, T35 este potrivit pentru o gama larga de constructii: hale, depozite, garaje, constructii agricole.</p>
                <h3>De ce T35 este cel mai vandut?</h3>
                <ul>
                    <li>Echilibrul perfect intre rigiditate si cost</li>
                    <li>Panta minima 5 grade - versatil</li>
                    <li>Lungime pana la 12500mm fara imbinari</li>
                    <li>Disponibil zincat sau vopsit in culori RAL</li>
                    <li>Compatibil cu structuri metalice standard</li>
                </ul>',
            'related' => [
                ['slug' => 'blachotrapez-t18', 'name' => 'T18', 'brand' => 'Blachotrapez'],
                ['slug' => 'blachotrapez-t55', 'name' => 'T55', 'brand' => 'Blachotrapez'],
            ],
        ],

        'blachotrapez-t55' => [
            'name' => 'Blachotrapez T55',
            'tagline' => 'Profil industrial T55 cu inaltime 55mm pentru deschideri mari si sarcini ridicate.',
            'brand' => 'Blachotrapez',
            'category' => ['slug' => 'tabla-cutata', 'name' => 'Tabla cutata'],
            'subcategory' => ['slug' => 'blachotrapez', 'name' => 'Blachotrapez'],
            'specs' => [
                'Profil' => 'T55 (inaltime 55mm)',
                'Grosime' => '0.50 - 0.75 mm',
                'Latime utila' => '960 mm',
                'Panta minima' => '5 grade',
                'Lungime maxima' => '12500 mm',
                'Aplicatii' => 'Hale mari, deschideri mari',
            ],
            'materials' => [
                'Zincat' => [
                    ['name' => 'Zincat natural', 'code' => 'Z275', 'color' => '#c0c0c0'],
                ],
                'Vopsit' => [
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Rosu mat', 'code' => 'RAL 3009', 'color' => '#6d332b'],
                    ['name' => 'Albastru', 'code' => 'RAL 5010', 'color' => '#0e4a8a'],
                ],
            ],
            'warranty' => 'Garantie 10-15 ani pentru aplicatii industriale.',
            'description' => '<h2>Tabla cutata Blachotrapez T55</h2>
                <p>Blachotrapez T55 este profilul industrial de mare inaltime, conceput pentru structuri cu deschideri mari si sarcini ridicate. Cu inaltime de 55mm, T55 ofera rigiditate structurala superioara, reducand necesarul de structura de sustinere.</p>
                <h3>Aplicatii T55</h3>
                <ul>
                    <li>Hale industriale cu deschideri mari (15m+)</li>
                    <li>Depozite si centre logistice</li>
                    <li>Constructii cu sarcini ridicate de zapada</li>
                    <li>Proiecte industriale si comerciale</li>
                </ul>',
            'related' => [
                ['slug' => 'blachotrapez-t35', 'name' => 'T35', 'brand' => 'Blachotrapez'],
                ['slug' => 'blachotrapez-t18', 'name' => 'T18', 'brand' => 'Blachotrapez'],
            ],
        ],

        // ==========================================
        // SISTEME PLUVIALE
        // ==========================================
        'metigla-sistem-pluvial' => [
            'name' => 'Sistem Pluvial Metigla',
            'tagline' => 'Sistem complet jgheaburi si burlane din otel vopsit. Dimensiuni 125/88mm si 165/100mm. Garantie 15 ani.',
            'brand' => 'Metigla',
            'category' => ['slug' => 'sisteme-pluviale', 'name' => 'Sisteme pluviale'],
            'subcategory' => ['slug' => 'metigla', 'name' => 'Metigla'],
            'specs' => [
                'Dimensiuni' => '125/88mm si 165/100mm',
                'Material' => 'Otel DX52/DX53',
                'Grosime' => '0.60 - 0.65 mm',
                'Acoperire zinc' => '275 g/m²',
                'Vopsea' => 'PU 35 um/fata',
                'Garantie' => '15 ani',
                'Durata estimata' => '50 ani',
                'Componente' => '20+ tipuri',
            ],
            'materials' => [
                'Lucios (13 culori)' => [
                    ['name' => 'Negru lucios', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro lucios', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit lucios', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Rosu inchis', 'code' => 'RAL 3005', 'color' => '#5e2028'],
                    ['name' => 'Rosu oxid', 'code' => 'RAL 3009', 'color' => '#6d332b'],
                    ['name' => 'Maro-rosu', 'code' => 'RAL 3011', 'color' => '#792b2b'],
                    ['name' => 'Verde crom', 'code' => 'RAL 6020', 'color' => '#2e3a23'],
                    ['name' => 'Alb', 'code' => 'RAL 9002', 'color' => '#e8e4d5'],
                    ['name' => 'Aluminiu alb', 'code' => 'RAL 9006', 'color' => '#a5a5a5'],
                ],
                'Mat (3 culori)' => [
                    ['name' => 'Negru mat', 'code' => 'RAL 9005', 'color' => '#111111'],
                    ['name' => 'Maro mat', 'code' => 'RAL 8017', 'color' => '#4a3530'],
                    ['name' => 'Gri antracit mat', 'code' => 'RAL 7016', 'color' => '#2e3335'],
                ],
            ],
            'warranty' => 'Garantie 15 ani. Durata estimata de viata 50 ani. Otel DX52 cu zinc 275g/m².',
            'description' => '<h2>Sistem pluvial Metigla</h2>
                <p>Sistemul pluvial Metigla este fabricat in Romania din otel DX52/DX53 de calitate superioara, cu acoperire de zinc 275 g/m² si vopsea poliuretanica de 35 microni. Sistemul include peste 20 de componente pentru o instalare completa si etansa.</p>
                <h3>Componente sistem pluvial Metigla</h3>
                <ul>
                    <li>Jgheab semicircular (125mm sau 165mm)</li>
                    <li>Burlan circular (88mm sau 100mm)</li>
                    <li>Carlige caprior, carlige pana, carlige rasucite</li>
                    <li>Colturi interioare si exterioare</li>
                    <li>Palnie colectoare, capace, imbinari jgheab</li>
                    <li>Coturi si coti burlan, bratari</li>
                    <li>Filtru frunze si accesorii de montaj</li>
                </ul>
                <h3>De ce sa alegi sistemul Metigla?</h3>
                <p>Sistemul pluvial Metigla se potriveste perfect cu tigla metalica si tabla faltuita Metigla, asigurand un look unitar si culori perfect coordonate pentru intregul acoperis.</p>',
            'related' => [
                ['slug' => 'wetterbest-sistem-pluvial', 'name' => 'Sistem Pluvial Wetterbest', 'brand' => 'Wetterbest'],
                ['slug' => 'budmat-flamingo-iq', 'name' => 'Flamingo iQ', 'brand' => 'Budmat'],
            ],
        ],

        'wetterbest-sistem-pluvial' => [
            'name' => 'Sistem Pluvial Wetterbest',
            'tagline' => 'Sisteme complete 125/88mm si 150/97mm din otel vopsit. Garantie 18 ani. Fabricat in Romania.',
            'brand' => 'Wetterbest',
            'category' => ['slug' => 'sisteme-pluviale', 'name' => 'Sisteme pluviale'],
            'subcategory' => ['slug' => 'wetterbest', 'name' => 'Wetterbest'],
            'specs' => [
                'Dimensiuni' => '125/88mm si 150/97mm',
                'Material' => 'Otel vopsit',
                'Grosime' => '0.50 - 0.60 mm',
                'Garantie' => '18 ani',
                'Profil jgheab' => 'Semicircular',
                'Fabricatie' => 'Romania',
            ],
            'materials' => [
                'Culori disponibile' => [
                    ['name' => 'Negru', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro', 'code' => 'RAL 8017', 'color' => '#45322e'],
                    ['name' => 'Gri antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Gri grafit', 'code' => 'RAL 7024', 'color' => '#474a51'],
                    ['name' => 'Rosu', 'code' => 'RAL 3009', 'color' => '#6d332b'],
                    ['name' => 'Verde', 'code' => 'RAL 6005', 'color' => '#1a3a1a'],
                    ['name' => 'Maro-gri', 'code' => 'RAL 8019', 'color' => '#4a4039'],
                    ['name' => 'Alb', 'code' => 'RAL 9002', 'color' => '#e8e4d5'],
                ],
            ],
            'warranty' => 'Garantie 18 ani. Fabricat in Romania de Wetterbest.',
            'description' => '<h2>Sistem pluvial Wetterbest</h2>
                <p>Sistemul pluvial Wetterbest este fabricat in Romania din otel vopsit de calitate, oferind o garantie de 18 ani si un aspect estetic in acord cu tigla Wetterbest. Disponibil in doua dimensiuni: 125/88mm si 150/97mm.</p>
                <h3>Avantaje sistem Wetterbest</h3>
                <ul>
                    <li>Fabricat in Romania - compatibil cu toata gama Wetterbest</li>
                    <li>Garantie 18 ani</li>
                    <li>Doua dimensiuni: 125/88 si 150/97mm</li>
                    <li>Gama completa de componente si accesorii</li>
                    <li>Culori coordonate cu tigla Wetterbest</li>
                </ul>',
            'related' => [
                ['slug' => 'metigla-sistem-pluvial', 'name' => 'Sistem Pluvial Metigla', 'brand' => 'Metigla'],
                ['slug' => 'budmat-flamingo-iq', 'name' => 'Flamingo iQ', 'brand' => 'Budmat'],
            ],
        ],

        'budmat-flamingo-iq' => [
            'name' => 'Budmat Flamingo iQ Rectangular',
            'tagline' => 'Sistem pluvial dreptunghiular premium Flamingo iQ din otel SSAB GreenCoat RWS. Garantie 50 ani.',
            'brand' => 'Budmat',
            'category' => ['slug' => 'sisteme-pluviale', 'name' => 'Sisteme pluviale'],
            'subcategory' => ['slug' => 'flamingo-iq-budmat', 'name' => 'Flamingo iQ Budmat'],
            'specs' => [
                'Tip profil' => 'Dreptunghiular (rectangular)',
                'Material' => 'Otel SSAB GreenCoat RWS',
                'Fixare' => 'Ascunsa (hidden)',
                'Componente' => '15 tipuri',
                'Acoperire per scurgere' => 'max 180 m² acoperis',
                'Jgheab lungimi' => '3m sau 4m',
                'Burlan lungimi' => '1m sau 3m',
                'Garantie' => '50 ani',
            ],
            'materials' => [
                'Culori Flamingo iQ' => [
                    ['name' => 'Antracit', 'code' => 'RAL 7016', 'color' => '#293133'],
                    ['name' => 'Negru', 'code' => 'RAL 9005', 'color' => '#0a0a0a'],
                    ['name' => 'Maro', 'code' => 'RAL 8017', 'color' => '#45322e'],
                ],
            ],
            'warranty' => 'Garantie 50 ani - cea mai lunga garantie din categorie. Otel SSAB GreenCoat RWS.',
            'description' => '<h2>Sistem pluvial Flamingo iQ Rectangular - Budmat</h2>
                <p>Flamingo iQ Rectangular este sistemul pluvial premium al producatorului polonez Budmat, realizat din otelul special SSAB GreenCoat RWS - un otel verde cu amprenta de carbon redusa. Sistemul dreptunghiular (rectangular) ofera un aspect modern si o etanseitate superioara.</p>
                <h3>De ce Flamingo iQ Rectangular?</h3>
                <ul>
                    <li>Garantie 50 ani - unica in piata sistemelor pluviale</li>
                    <li>Otel SSAB GreenCoat RWS - produs sustenabil, eco-friendly</li>
                    <li>Profil dreptunghiular cu aspect modern si premium</li>
                    <li>Fixare ascunsa - aspect curat, fara elemente vizibile</li>
                    <li>Capacitate 180 m² acoperis per scurgere</li>
                    <li>Sistem complet cu 15 tipuri de componente</li>
                </ul>
                <h3>Compatibilitate</h3>
                <p>Flamingo iQ se potriveste perfect cu tigla metalica Budmat (Venecja, Bella Sara, Como), asigurand culori coordonate si garantii compatibile.</p>',
            'related' => [
                ['slug' => 'budmat-venecja', 'name' => 'Venecja', 'brand' => 'Budmat'],
                ['slug' => 'metigla-sistem-pluvial', 'name' => 'Sistem Pluvial Metigla', 'brand' => 'Metigla'],
                ['slug' => 'wetterbest-sistem-pluvial', 'name' => 'Sistem Pluvial Wetterbest', 'brand' => 'Wetterbest'],
            ],
        ],

        // ==========================================
        // IZOLATIE STEICO
        // ==========================================
        'steico-zell' => [
            'name' => 'STEICOzell',
            'tagline' => 'Izolatie din fibre de lemn in vrac (suflata). Lambda 0.038 W/mK. Saci 15kg. Ecologica 100%.',
            'brand' => 'STEICO',
            'category' => ['slug' => 'izolatie', 'name' => 'Izolatie'],
            'subcategory' => ['slug' => 'steico', 'name' => 'STEICO'],
            'specs' => [
                'Tip' => 'Izolatie celulozica din fibre de lemn (in vrac)',
                'Conductivitate termica' => 'lambda 0.038 W/(m·K)',
                'Aplicare' => 'Suflata cu masina (blow-in)',
                'Ambalaj' => 'Saci 15 kg',
                'Densitate' => '50-70 kg/m³ (dupa suflare)',
                'Materie prima' => 'Fibre de lemn 100%',
                'Certificare' => 'ETA / CE',
            ],
            'materials' => [
                'Disponibil' => [
                    ['name' => 'Natural (fibre lemn)', 'code' => 'Ecologic', 'color' => '#c4a96a'],
                ],
            ],
            'warranty' => 'Garantie produs STEICO. Material natural, fara formaldehida, ecologic 100%.',
            'description' => '<h2>STEICOzell - izolatie din fibre de lemn in vrac</h2>
                <p>STEICOzell este izolatia din fibre de lemn in vrac a producatorului german STEICO, aplicata prin suflare cu masina speciala. Aceasta metoda permite umplerea perfecta a oricarui spatiu, inclusiv a zonelor greu accesibile, fara punti termice.</p>
                <h3>Avantaje STEICOzell</h3>
                <ul>
                    <li>Conductivitate termica lambda 0.038 W/mK - performante superioare</li>
                    <li>Aplicare prin suflare - umple perfect orice cavitate</li>
                    <li>Material natural, 100% ecologic, fara produse chimice</li>
                    <li>Capacitate de acumulare termica superioara lana minerala</li>
                    <li>Reglare naturala a umiditatii (sorbtie-desorbtie)</li>
                    <li>Rezistenta la foc B clasa europeana</li>
                </ul>
                <h3>Aplicatii</h3>
                <p>Ideal pentru izolarea planseelor mansardei, peretilor cu structura lemn, spatiilor inaccesibile si renovarea cladirilor existente.</p>',
            'related' => [
                ['slug' => 'steico-universal', 'name' => 'STEICOuniversal', 'brand' => 'STEICO'],
            ],
        ],

        'steico-universal' => [
            'name' => 'STEICOuniversal',
            'tagline' => 'Placa rigida flexibila din fibre de lemn. Lambda 0.038 W/mK. Izolatie termica si fonica.',
            'brand' => 'STEICO',
            'category' => ['slug' => 'izolatie', 'name' => 'Izolatie'],
            'subcategory' => ['slug' => 'steico', 'name' => 'STEICO'],
            'specs' => [
                'Tip' => 'Placa semirigida din fibre de lemn',
                'Conductivitate termica' => 'lambda 0.038 W/(m·K)',
                'Grosimi disponibile' => '40, 60, 80, 100, 120, 140, 160, 200 mm',
                'Dimensiuni placa' => '1220 x 575 mm',
                'Densitate' => '~50 kg/m³',
                'Materie prima' => 'Fibre de lemn 100%',
                'Clasa foc' => 'E (EN 13501-1)',
                'Certificare' => 'ETA / CE',
            ],
            'materials' => [
                'Disponibil' => [
                    ['name' => 'Natural (fibre lemn)', 'code' => 'Ecologic', 'color' => '#c4a96a'],
                ],
            ],
            'warranty' => 'Garantie produs STEICO. Material natural, respirabil, ecologic.',
            'description' => '<h2>STEICOuniversal - placa semirigida din fibre de lemn</h2>
                <p>STEICOuniversal este placa semirigida de izolatie din fibre de lemn, conceputa pentru aplicatii intre capriori sau in peretii cu structura de lemn. Materialul combina excelenta izolatie termica cu proprietati fonoabsorbante remarcabile.</p>
                <h3>De ce STEICOuniversal?</h3>
                <ul>
                    <li>Lambda 0.038 W/mK - performante termice superioare</li>
                    <li>Izolare fonica excelenta - reduce zgomotul de impact si aerian</li>
                    <li>Material natural, respirabil - regleaza umiditatea</li>
                    <li>Usor de taiat si montat - fara echipament special</li>
                    <li>Grosimi de la 40mm la 200mm</li>
                    <li>Compatibil cu structuri din lemn si metal</li>
                </ul>
                <h3>Aplicatii recomandate</h3>
                <p>Ideal pentru acoperisuri mansardate, peretii exteriori cu structura lemn, plansee inter-etaje si renovarea termica a cladirilor existente.</p>',
            'related' => [
                ['slug' => 'steico-zell', 'name' => 'STEICOzell', 'brand' => 'STEICO'],
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

    /**
     * Returneaza produsele filtrate dupa categorie si subcategorie
     */
    public function getBySubcategory(string $catSlug, string $subSlug): array
    {
        return array_filter($this->productData, function ($p) use ($catSlug, $subSlug) {
            return ($p['category']['slug'] ?? '') === $catSlug
                && ($p['subcategory']['slug'] ?? '') === $subSlug;
        });
    }

    /**
     * Returneaza produsele filtrate dupa categorie
     */
    public function getByCategory(string $catSlug): array
    {
        return array_filter($this->productData, function ($p) use ($catSlug) {
            return ($p['category']['slug'] ?? '') === $catSlug;
        });
    }
}
