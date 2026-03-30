<?php

/**
 * Date centralizate pentru toate categoriile
 * Aceasta structura va fi inlocuita cu date din baza de date
 * cand panoul admin va fi functional.
 */

return [
    'tigla-metalica' => [
        'name' => 'Tigla metalica',
        'description' => 'Cele mai performante profile de tigla metalica de la producatori de top: Budmat, Metigla, Wetterbest si Blachotrapez. Garantie extinsa si gama variata de culori.',
        'icon' => '&#9650;',
        'subcategories' => [
            ['slug' => 'budmat', 'name' => 'Budmat', 'count' => 3, 'icon' => '&#9650;'],
            ['slug' => 'metigla', 'name' => 'Metigla', 'count' => 4, 'icon' => '&#9650;'],
            ['slug' => 'blachotrapez', 'name' => 'Blachotrapez', 'count' => 4, 'icon' => '&#9650;'],
            ['slug' => 'wetterbest', 'name' => 'Wetterbest', 'count' => 5, 'icon' => '&#9650;'],
        ],
        'popular' => [
            ['slug' => 'budmat-venecja', 'name' => 'Venecja', 'brand' => 'Budmat'],
            ['slug' => 'metigla-elit', 'name' => 'Elit', 'brand' => 'Metigla'],
            ['slug' => 'wetterbest-clasic', 'name' => 'Clasic', 'brand' => 'Wetterbest'],
            ['slug' => 'blachotrapez-enigma', 'name' => 'Enigma', 'brand' => 'Blachotrapez'],
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
        'description' => 'Sisteme de invelitoare cu falt vertical si orizontal. Design modern, etanseitate superioara si durabilitate exceptionala de la Metigla, Vestalpin si Wetterbest.',
        'icon' => '&#9645;',
        'subcategories' => [
            ['slug' => 'metigla', 'name' => 'Metigla', 'count' => 2, 'icon' => '&#9645;'],
            ['slug' => 'vestalpin', 'name' => 'Vestalpin', 'count' => 1, 'icon' => '&#9645;'],
            ['slug' => 'wetterbest', 'name' => 'Wetterbest', 'count' => 1, 'icon' => '&#9645;'],
        ],
        'popular' => [
            ['slug' => 'metigla-falt', 'name' => 'Falt Metigla', 'brand' => 'Metigla'],
            ['slug' => 'metigla-clic', 'name' => 'Clic Metigla', 'brand' => 'Metigla'],
            ['slug' => 'vestalpin-click', 'name' => 'Click Vestalpin', 'brand' => 'Vestalpin'],
            ['slug' => 'wetterbest-click', 'name' => 'Click Wetterbest', 'brand' => 'Wetterbest'],
        ],
        'seo_title' => 'Tabla Faltuita - Sisteme de Invelitoare Premium',
        'seo_text' => '<h2>Tabla faltuita - eleganta si performanta</h2>
            <p>Tabla faltuita reprezinta solutia premium pentru invelitori, oferind un aspect modern si o etanseitate superioara fata de alte tipuri de invelitoare metalice.</p>
            <h3>De ce sa alegi tabla faltuita?</h3>
            <ul>
                <li>Etanseitate maxima - faltul elimina riscul de infiltratii</li>
                <li>Aspect arhitectural modern si elegant</li>
                <li>Potrivita pentru acoperisuri cu pante mici (de la 3 grade)</li>
                <li>Disponibila in variante cu falt vertical sau orizontal</li>
                <li>Durabilitate exceptionala - garantie pana la 50 de ani</li>
            </ul>',
        'related' => [
            ['slug' => '/tigla-metalica', 'name' => 'Tigla metalica'],
            ['slug' => '/tabla-click', 'name' => 'Tabla click'],
            ['slug' => '/accesorii-acoperis', 'name' => 'Accesorii acoperis'],
        ],
    ],

    'tabla-click' => [
        'name' => 'Tabla click',
        'description' => 'Sistem de invelitoare cu imbinare click - montaj rapid fara suruburi vizibile. Aspect curat si modern de la Metigla si Wetterbest.',
        'icon' => '&#9646;',
        'subcategories' => [
            ['slug' => 'metigla', 'name' => 'Metigla', 'count' => 2, 'icon' => '&#9646;'],
            ['slug' => 'wetterbest', 'name' => 'Wetterbest', 'count' => 2, 'icon' => '&#9646;'],
        ],
        'popular' => [
            ['slug' => 'tabla-click-metigla', 'name' => 'Click Metigla', 'brand' => 'Metigla'],
            ['slug' => 'tabla-click-wetterbest', 'name' => 'Click Wetterbest', 'brand' => 'Wetterbest'],
        ],
        'seo_title' => 'Tabla Click - Montaj Rapid fara Suruburi Vizibile',
        'seo_text' => '<h2>Tabla click - montaj rapid si aspect modern</h2>
            <p>Tabla click este solutia ideala pentru cei care doresc un montaj rapid, fara suruburi vizibile pe suprafata invelitorii. Sistemul de imbinare click asigura o fixare sigura si un aspect curat.</p>
            <h3>Avantaje tabla click</h3>
            <ul>
                <li>Montaj rapid - sistemul click reduce timpul de instalare</li>
                <li>Fara suruburi vizibile - aspect estetic superior</li>
                <li>Dilatare termica libera - fara tensiuni in material</li>
                <li>Rezistenta excelenta la vant</li>
            </ul>',
        'related' => [
            ['slug' => '/tigla-metalica', 'name' => 'Tigla metalica'],
            ['slug' => '/tabla-faltuita', 'name' => 'Tabla faltuita'],
        ],
    ],

    'tabla-cutata' => [
        'name' => 'Tabla cutata',
        'description' => 'Tabla cutata (trapezoidala) pentru acoperisuri industriale, hale, garaje si anexe. Profile de la Metigla, Wetterbest si Blachotrapez.',
        'icon' => '&#9649;',
        'subcategories' => [
            ['slug' => 'blachotrapez', 'name' => 'Blachotrapez', 'count' => 3, 'icon' => '&#9649;'],
            ['slug' => 'metigla', 'name' => 'Metigla', 'count' => 0, 'icon' => '&#9649;'],
            ['slug' => 'wetterbest', 'name' => 'Wetterbest', 'count' => 0, 'icon' => '&#9649;'],
        ],
        'popular' => [
            ['slug' => 'blachotrapez-t18', 'name' => 'T18', 'brand' => 'Blachotrapez'],
            ['slug' => 'blachotrapez-t35', 'name' => 'T35', 'brand' => 'Blachotrapez'],
            ['slug' => 'blachotrapez-t55', 'name' => 'T55', 'brand' => 'Blachotrapez'],
        ],
        'seo_title' => 'Tabla Cutata Trapezoidala - Profile Industriale',
        'seo_text' => '<h2>Tabla cutata - solutii pentru acoperisuri industriale</h2>
            <p>Tabla cutata (trapezoidala) este solutia economica si rezistenta pentru acoperisuri de hale industriale, garaje, depozite si constructii agricole.</p>
            <h3>Profile disponibile</h3>
            <ul>
                <li>T18 - profil mic, ideal pentru pereti si acoperisuri usoare</li>
                <li>T35 - profil mediu, cel mai popular pentru acoperisuri</li>
                <li>T45 - profil inalt, pentru deschideri mari</li>
            </ul>',
        'related' => [
            ['slug' => '/tigla-metalica', 'name' => 'Tigla metalica'],
            ['slug' => '/tabla-faltuita', 'name' => 'Tabla faltuita'],
        ],
    ],

    'sisteme-pluviale' => [
        'name' => 'Sisteme pluviale',
        'description' => 'Jgheaburi si burlane pentru colectarea si evacuarea apei pluviale. Sisteme complete de la Metigla, Wetterbest si Flamingo iQ Budmat.',
        'icon' => '&#128167;',
        'subcategories' => [
            ['slug' => 'metigla', 'name' => 'Sistem scurgere Metigla', 'count' => 1, 'icon' => '&#128167;'],
            ['slug' => 'wetterbest', 'name' => 'Sistem scurgere Wetterbest', 'count' => 1, 'icon' => '&#128167;'],
            ['slug' => 'flamingo-iq-budmat', 'name' => 'Flamingo iQ Budmat', 'count' => 1, 'icon' => '&#128167;'],
        ],
        'popular' => [
            ['slug' => 'metigla-sistem-pluvial', 'name' => 'Sistem Pluvial Metigla', 'brand' => 'Metigla'],
            ['slug' => 'wetterbest-sistem-pluvial', 'name' => 'Sistem Pluvial Wetterbest', 'brand' => 'Wetterbest'],
            ['slug' => 'budmat-flamingo-iq', 'name' => 'Flamingo iQ Rectangular', 'brand' => 'Budmat'],
        ],
        'seo_title' => 'Sisteme Pluviale - Jgheaburi si Burlane',
        'seo_text' => '<h2>Sisteme pluviale - protectie completa pentru cladirea dumneavoastra</h2>
            <p>Un sistem pluvial performant este esential pentru protejarea fundatiei si a fatadei cladirii. Oferim sisteme complete de jgheaburi si burlane din tabla vopsita sau aluminiu.</p>
            <h3>Componente sistem pluvial</h3>
            <ul>
                <li>Jgheaburi semicirculare si rectangulare in diverse dimensiuni</li>
                <li>Burlane circulare si rectangulare</li>
                <li>Colturi interioare si exterioare</li>
                <li>Racorduri, coturi si reductii</li>
                <li>Carlige si suporti de prindere</li>
                <li>Palnie colectoare si iesire burlan</li>
            </ul>',
        'related' => [
            ['slug' => '/tigla-metalica', 'name' => 'Tigla metalica'],
            ['slug' => '/accesorii-acoperis', 'name' => 'Accesorii acoperis'],
        ],
    ],

    'folii-anticondens' => [
        'name' => 'Folii anticondens',
        'description' => 'Folii anticondens si membrane pentru protectia structurii acoperisului impotriva condensului si umiditatii.',
        'icon' => '&#128203;',
        'subcategories' => [
            ['slug' => 'folii-bdm', 'name' => 'Folii BDM Systems', 'count' => 2, 'icon' => '&#128203;'],
            ['slug' => 'folii-riwega', 'name' => 'Folii Riwega', 'count' => 1, 'icon' => '&#128203;'],
        ],
        'popular' => [
            ['slug' => 'bdm-125-standard-plus', 'name' => 'BDM 125 Standard Plus', 'brand' => 'BDM Systems'],
            ['slug' => 'bdm-140-maxi-sk2', 'name' => 'BDM 140 MAXI Sk2', 'brand' => 'BDM Systems'],
            ['slug' => 'riwega-usb-reflex', 'name' => 'Riwega USB Reflex 200', 'brand' => 'Riwega'],
        ],
        'seo_title' => 'Folii Anticondens pentru Acoperis - Protectie Completa',
        'seo_text' => '<h2>Folii anticondens - protectie esentiala pentru acoperis</h2>
            <p>Folia anticondens este un element esential in structura acoperisului, protejand impotriva condensului care se poate forma pe fata interioara a invelitorii metalice.</p>
            <h3>De ce ai nevoie de folie anticondens?</h3>
            <ul>
                <li>Previne formarea condensului pe invelitoare</li>
                <li>Protejeaza structura din lemn impotriva umiditatii</li>
                <li>Prelungeste durata de viata a acoperisului</li>
                <li>Obligatorie conform normativelor de constructii</li>
            </ul>',
        'related' => [
            ['slug' => '/tigla-metalica', 'name' => 'Tigla metalica'],
            ['slug' => '/accesorii-acoperis', 'name' => 'Accesorii acoperis'],
            ['slug' => '/izolatie', 'name' => 'Izolatie STEICO'],
        ],
    ],

    'accesorii-acoperis' => [
        'name' => 'Accesorii acoperis',
        'description' => 'Accesorii complete pentru montajul si finisarea acoperisului: coame, suruburi, etansari, parazapezi, treceri de ventilatie.',
        'icon' => '&#128295;',
        'subcategories' => [
            ['slug' => 'coame-si-sortimente', 'name' => 'Coame si sortimente', 'count' => 5, 'icon' => '&#128295;'],
            ['slug' => 'suruburi-autoforante', 'name' => 'Suruburi autoforante', 'count' => 4, 'icon' => '&#128295;'],
            ['slug' => 'parazapezi', 'name' => 'Parazapezi', 'count' => 3, 'icon' => '&#128295;'],
            ['slug' => 'treceri-ventilatie', 'name' => 'Treceri de ventilatie', 'count' => 3, 'icon' => '&#128295;'],
            ['slug' => 'etansari', 'name' => 'Etansari si benzi', 'count' => 4, 'icon' => '&#128295;'],
        ],
        'popular' => [
            ['slug' => 'coama-universala', 'name' => 'Coama universala', 'brand' => 'Metigla'],
            ['slug' => 'parazapada-bara', 'name' => 'Parazapada tip bara', 'brand' => 'BDM Systems'],
        ],
        'seo_title' => 'Accesorii Acoperis - Sortimente Complete',
        'seo_text' => '<h2>Accesorii acoperis - totul pentru montajul perfect</h2>
            <p>O invelitoare de calitate necesita accesorii pe masura. Oferim gama completa de accesorii necesare pentru montajul si finisarea acoperisului.</p>',
        'related' => [
            ['slug' => '/tigla-metalica', 'name' => 'Tigla metalica'],
            ['slug' => '/sipci-metalice', 'name' => 'Sipci metalice'],
            ['slug' => '/folii-anticondens', 'name' => 'Folii anticondens'],
        ],
    ],

    'sipci-metalice' => [
        'name' => 'Sipci metalice',
        'description' => 'Sipci metalice (sindrila metalica) pentru sustinerea invelitorii. Alternativa moderna la sipcile din lemn, cu durabilitate superioara.',
        'icon' => '&#9644;',
        'subcategories' => [
            ['slug' => 'sipci-acoperis', 'name' => 'Sipci pentru acoperis', 'count' => 3, 'icon' => '&#9644;'],
            ['slug' => 'profile-sustinere', 'name' => 'Profile de sustinere', 'count' => 2, 'icon' => '&#9644;'],
        ],
        'popular' => [],
        'seo_title' => 'Sipci Metalice pentru Acoperis - Alternativa Moderna',
        'seo_text' => '<h2>Sipci metalice - durabilitate maxima</h2>
            <p>Sipcile metalice reprezinta alternativa moderna si durabila la sipcile traditionale din lemn. Nu putrezesc, nu se deformeaza si nu sunt atacate de insecte.</p>',
        'related' => [
            ['slug' => '/tigla-metalica', 'name' => 'Tigla metalica'],
            ['slug' => '/accesorii-acoperis', 'name' => 'Accesorii acoperis'],
        ],
    ],

    'tamplarie-pvc-aluminiu' => [
        'name' => 'Tamplarie PVC si Aluminiu',
        'description' => 'Ferestre si usi din PVC si aluminiu de inalta calitate. Eficienta energetica, izolare fonica si design modern.',
        'icon' => '&#128311;',
        'subcategories' => [
            ['slug' => 'ferestre-pvc', 'name' => 'Ferestre PVC', 'count' => 4, 'icon' => '&#128311;'],
            ['slug' => 'ferestre-aluminiu', 'name' => 'Ferestre Aluminiu', 'count' => 3, 'icon' => '&#128311;'],
            ['slug' => 'usi-pvc', 'name' => 'Usi PVC', 'count' => 2, 'icon' => '&#128311;'],
            ['slug' => 'usi-aluminiu', 'name' => 'Usi Aluminiu', 'count' => 2, 'icon' => '&#128311;'],
        ],
        'popular' => [],
        'seo_title' => 'Tamplarie PVC si Aluminiu - Ferestre si Usi',
        'seo_text' => '<h2>Tamplarie PVC si Aluminiu de calitate</h2>
            <p>Oferim solutii complete de tamplarie PVC si aluminiu pentru proiecte rezidentiale si comerciale. Toate produsele noastre indeplinesc cele mai inalte standarde de eficienta energetica.</p>
            <h3>Avantaje tamplarie PVC</h3>
            <ul>
                <li>Izolare termica excelenta - profile cu 5-7 camere</li>
                <li>Izolare fonica superioara</li>
                <li>Intretinere minima</li>
                <li>Gama variata de culori si finisaje</li>
            </ul>',
        'related' => [
            ['slug' => '/ferestre-mansarda-fakro', 'name' => 'Ferestre mansarda FAKRO'],
            ['slug' => '/izolatie', 'name' => 'Izolatie STEICO'],
        ],
    ],

    'ferestre-mansarda-fakro' => [
        'name' => 'Ferestre mansarda FAKRO',
        'description' => 'Ferestre de mansarda FAKRO - iluminare naturala, ventilatie si acces pe acoperis. Modele cu deschidere superioara, laterala sau electrica.',
        'icon' => '&#127968;',
        'subcategories' => [
            ['slug' => 'fakro', 'name' => 'FAKRO', 'count' => 7, 'icon' => '&#127968;'],
        ],
        'popular' => [
            ['slug' => 'fakro-ftp-v-u3', 'name' => 'FTP-V U3', 'brand' => 'FAKRO'],
            ['slug' => 'fakro-ftp-v-u5', 'name' => 'FTP-V U5', 'brand' => 'FAKRO'],
            ['slug' => 'fakro-fts-v-u2', 'name' => 'FTS-V U2', 'brand' => 'FAKRO'],
            ['slug' => 'fakro-fdy-v-u3', 'name' => 'FDY-V U3 Duet proSky', 'brand' => 'FAKRO'],
        ],
        'seo_title' => 'Ferestre Mansarda FAKRO - Modele si Preturi',
        'seo_text' => '<h2>Ferestre de mansarda FAKRO</h2>
            <p>FAKRO este unul dintre cei mai importanti producatori de ferestre de mansarda din Europa. Oferim gama completa de ferestre FAKRO cu diverse tipuri de deschidere si geam termoizolant.</p>
            <h3>Tipuri de ferestre mansarda</h3>
            <ul>
                <li>Cu deschidere superioara (basculanta) - cele mai populare</li>
                <li>Cu deschidere laterala - acces facil pe acoperis</li>
                <li>Cu deschidere electrica - confort maxim</li>
                <li>Ferestre de acces pe acoperis</li>
            </ul>',
        'related' => [
            ['slug' => '/scari-pod-fakro', 'name' => 'Scari de pod FAKRO'],
            ['slug' => '/tamplarie-pvc-aluminiu', 'name' => 'Tamplarie PVC'],
            ['slug' => '/izolatie', 'name' => 'Izolatie STEICO'],
        ],
    ],

    'scari-pod-fakro' => [
        'name' => 'Scari de pod FAKRO',
        'description' => 'Scari escamotabile FAKRO pentru acces la pod. Modele din lemn si metal, izolate termic, cu diverse dimensiuni.',
        'icon' => '&#128682;',
        'subcategories' => [
            ['slug' => 'fakro', 'name' => 'FAKRO', 'count' => 6, 'icon' => '&#128682;'],
        ],
        'popular' => [
            ['slug' => 'fakro-lwk-komfort', 'name' => 'LWK Komfort', 'brand' => 'FAKRO'],
            ['slug' => 'fakro-lwt-thermo', 'name' => 'LWT Thermo', 'brand' => 'FAKRO'],
            ['slug' => 'fakro-lst', 'name' => 'LST Foarfeca', 'brand' => 'FAKRO'],
            ['slug' => 'fakro-lmf', 'name' => 'LMF Antifoc', 'brand' => 'FAKRO'],
        ],
        'seo_title' => 'Scari de Pod FAKRO - Escamotabile si Izolate',
        'seo_text' => '<h2>Scari de pod FAKRO - acces sigur si confortabil</h2>
            <p>Scarile de pod FAKRO ofera acces sigur si confortabil la podul casei. Disponibile in variante din lemn de pin si metalice, cu izolatie termica in capac.</p>
            <h3>Modele disponibile</h3>
            <ul>
                <li>LWK Komfort - din lemn, model standard popular</li>
                <li>LWT Thermo - din lemn, cu izolatie termica superioara</li>
                <li>LST - metalica, design scissor, economie de spatiu</li>
                <li>LML Lux - metalica cu balustrada</li>
            </ul>',
        'related' => [
            ['slug' => '/ferestre-mansarda-fakro', 'name' => 'Ferestre mansarda FAKRO'],
        ],
    ],

    'izolatie' => [
        'name' => 'Izolatie fibre lemn STEICO',
        'description' => 'Izolatie ecologica din fibre de lemn STEICO Zell. Performanta termica superioara, reglare naturala a umiditatii si protectie fonica excelenta.',
        'icon' => '&#127777;',
        'subcategories' => [
            ['slug' => 'steico', 'name' => 'STEICO', 'count' => 2, 'icon' => '&#127777;'],
        ],
        'popular' => [
            ['slug' => 'steico-zell', 'name' => 'STEICOzell', 'brand' => 'STEICO'],
            ['slug' => 'steico-universal', 'name' => 'STEICOuniversal', 'brand' => 'STEICO'],
        ],
        'seo_title' => 'Izolatie Fibre Lemn STEICO Zell - Ecologica si Eficienta',
        'seo_text' => '<h2>Izolatie STEICO - solutia ecologica premium</h2>
            <p>STEICO este liderul european in productia de materiale izolatoare din fibre de lemn. Izolatia STEICO Zell se aplica prin suflare si umple perfect toate spatiile, eliminand puntile termice.</p>
            <h3>Avantaje izolatie STEICO</h3>
            <ul>
                <li>Material 100% natural si ecologic</li>
                <li>Conductivitate termica excelenta (lambda 0.038)</li>
                <li>Protectie termica atat vara cat si iarna</li>
                <li>Reglare naturala a umiditatii</li>
                <li>Izolare fonica superioara</li>
                <li>Certificata pentru constructii Passive House</li>
            </ul>',
        'related' => [
            ['slug' => '/hidroizolatii-terase', 'name' => 'Hidroizolatii terase'],
            ['slug' => '/folii-anticondens', 'name' => 'Folii anticondens'],
        ],
    ],

    'hidroizolatii-terase' => [
        'name' => 'Hidroizolatii terase',
        'description' => 'Sisteme profesionale de hidroizolatie pentru terase, balcoane si acoperisuri plane. Membrane bituminoase si solutii lichide.',
        'icon' => '&#128166;',
        'subcategories' => [
            ['slug' => 'membrane-bituminoase', 'name' => 'Membrane bituminoase', 'count' => 4, 'icon' => '&#128166;'],
            ['slug' => 'hidroizolatii-lichide', 'name' => 'Hidroizolatii lichide', 'count' => 3, 'icon' => '&#128166;'],
            ['slug' => 'accesorii-hidroizolatie', 'name' => 'Accesorii hidroizolatie', 'count' => 3, 'icon' => '&#128295;'],
        ],
        'popular' => [
            ['slug' => 'membrana-bituminoasa-4mm', 'name' => 'Membrana bituminoasa 4mm', 'brand' => 'BDM Systems'],
        ],
        'seo_title' => 'Hidroizolatii Terase - Membrane si Solutii Lichide',
        'seo_text' => '<h2>Hidroizolatii terase - protectie impermeabila</h2>
            <p>Hidroizolatia corecta a terasei este esentiala pentru prevenirea infiltratiilor si protejarea structurii cladirii. Oferim sisteme complete de hidroizolatie pentru terase circulabile si necirculabile.</p>',
        'related' => [
            ['slug' => '/izolatie', 'name' => 'Izolatie STEICO'],
            ['slug' => '/folii-anticondens', 'name' => 'Folii anticondens'],
        ],
    ],

    'garduri' => [
        'name' => 'Garduri',
        'description' => 'Sisteme complete de garduri metalice: panouri, stalpi, porti auto si pietonale. Design modern si rezistenta in timp.',
        'icon' => '&#127981;',
        'subcategories' => [
            ['slug' => 'panouri-gard', 'name' => 'Panouri gard', 'count' => 4, 'icon' => '&#127981;'],
            ['slug' => 'stalpi-gard', 'name' => 'Stalpi gard', 'count' => 3, 'icon' => '&#127981;'],
            ['slug' => 'porti', 'name' => 'Porti auto si pietonale', 'count' => 3, 'icon' => '&#127981;'],
        ],
        'popular' => [],
        'seo_title' => 'Garduri Metalice - Panouri, Stalpi si Porti',
        'seo_text' => '<h2>Garduri metalice - siguranta si estetica</h2>
            <p>Oferim sisteme complete de garduri metalice cu design modern, rezistente la intemperii si cu intretinere minima.</p>',
        'related' => [
            ['slug' => '/accesorii-acoperis', 'name' => 'Accesorii acoperis'],
        ],
    ],
];
