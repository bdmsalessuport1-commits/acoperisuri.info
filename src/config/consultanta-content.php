<?php
/**
 * ═══════════════════════════════════════════════════════════════════════
 *  CONȚINUT PAGINĂ CONSULTANȚĂ PASSIVE HOUSE
 * ═══════════════════════════════════════════════════════════════════════
 *
 *  Un singur fișier pentru TOT textul din pagina de consultanță.
 *  Editează aici pentru a modifica orice text din pagină.
 *
 *  Secțiuni:
 *    1.  SEO / meta
 *    2.  Expert (Mircea Barticel)
 *    3.  Hero
 *    4.  Autoritate (certificări PHI)
 *    5.  Problema
 *    6.  Costul real
 *    7.  Casa se construiește de 3 ori
 *    8.  Ce analizăm (anvelopa)
 *    9.  Ce primești concret
 *   10.  Procesul de lucru
 *   11.  Pachete
 *   12.  Despre Mircea
 *   13.  Studii de caz (visible: false)
 *   14.  Testimoniale (visible: false)
 *   15.  FAQ
 *   16.  CTA final
 *   17.  Formular (opțiuni pe pași)
 *   18.  Analytics events (pentru activare finală GA4)
 *
 * ═══════════════════════════════════════════════════════════════════════
 */

return [

    // ═══════════════════════════════════════════════════════════════════
    // 1. SEO
    // ═══════════════════════════════════════════════════════════════════
    'seo' => [
        'title'       => 'Consultanță Passive House și nZEB — Mircea Barticel, Consultant Certificat PHI | BDM Systems',
        'description' => 'Consultanță tehnică pentru case nZEB și Passive House: analiză proiect, modelare energetică PHPP, optimizare anvelopă, verificare implementare în șantier. Mircea Barticel, Consultant Certificat PHI, 20 ani experiență practică.',
        'og_image'    => '/uploads/consultanta/og-consultanta.jpg',
        'canonical'   => 'https://acoperisuri.info/consultanta-passive-house',
    ],

    // ═══════════════════════════════════════════════════════════════════
    // 2. EXPERT
    // ═══════════════════════════════════════════════════════════════════
    'expert' => [
        'name'      => 'Mircea Barticel',
        'title'     => 'Fondator și CEO BDM Systems',
        'subtitle'  => 'Consultant Certificat Case Pasive (PHI)',
        'experience_years' => 20,
        'company'   => 'BDM Systems',
        'company_url' => 'https://acoperisuri.info',
        'company_address' => 'București, Prelungirea Ghencea Nr. 95C',
        'certifications' => [
            [
                'code'    => 'CPHC',
                'name'    => 'Certified Passive House Consultant',
                'issuer'  => 'Passive House Institute (PHI), Darmstadt',
                'pdf'     => '/uploads/certificates/certified-passive-house-consultant-mircea-barticel.pdf',
                'badge'   => '/uploads/consultanta/badge-consultant-phi.png',
            ],
            [
                'code'    => 'CPHT',
                'name'    => 'Certified Passive House Tradesperson',
                'issuer'  => 'Passive House Institute (PHI), Darmstadt',
                'pdf'     => '/uploads/certificates/certified-passive-house-tradesperson-mircea-barticel.pdf',
                'badge'   => '/uploads/consultanta/badge-tradesperson-phi.png',
            ],
        ],
        'divisions' => [
            ['name' => 'Acoperiș Sănătos',   'note' => 'sisteme complete pentru acoperișuri'],
            ['name' => 'Tâmplărie Sănătoasă', 'note' => 'PVC, aluminiu și soluții de montaj performant'],
            ['name' => 'Izolații Sănătoase',  'note' => 'termoizolații, inclusiv fibre de lemn suflate'],
        ],
        'contact' => [
            'email'    => 'mircea@bdmsystems.ro',
            'phone'    => '+40756034734',
            'whatsapp' => '+40756034734',
            'application_email' => 'mircea@bdmsystems.ro',
        ],
    ],

    // ═══════════════════════════════════════════════════════════════════
    // 3. HERO
    // ═══════════════════════════════════════════════════════════════════
    'hero' => [
        'headline'    => 'Nu te întreba doar cât costă să construiești casa. Află cât te va costa să locuiești în ea.',
        'subheadline' => 'Consultanță tehnică pentru casa ta nZEB sau Passive House. Analizăm proiectul, modelăm performanța energetică în PHPP și stabilim soluțiile necesare — înainte ca greșelile să devină costuri de șantier.',
        'trust_badges' => [
            'Consultant Certificat Case Pasive (PHI)',
            '20 ani experiență practică în construcții',
            'Proiectare + montaj + verificare în șantier',
        ],
        'cta_primary'   => ['label' => 'Aplică pentru consultanță', 'url' => '#formular'],
        'cta_secondary' => ['label' => 'Vezi pachetele',            'url' => '#pachete'],
        'cta_note'      => 'Completezi formularul în câteva minute. Analizăm stadiul proiectului și revenim cu varianta potrivită.',
        'image'         => '/uploads/consultanta/mircea-hero.jpg',
        'image_alt'     => 'Mircea Barticel, Consultant Certificat Passive House, CEO BDM Systems',
    ],

    // ═══════════════════════════════════════════════════════════════════
    // 4. AUTORITATE
    // ═══════════════════════════════════════════════════════════════════
    'authority' => [
        'headline' => 'Certificat de Passive House Institute (PHI), Darmstadt',
        'lead'     => 'Două certificări internaționale care combină cunoștințele teoretice de proiectare cu experiența practică de execuție.',
        'body'     => 'În România sunt puțini specialiști care dețin ambele certificări PHI. Combinația dintre <strong>Certified Passive House Consultant</strong> (proiectare energetică) și <strong>Certified Passive House Tradesperson</strong> (execuție corectă) permite să văd casa atât din biroul de proiectare cât și din șantier.',
    ],

    // ═══════════════════════════════════════════════════════════════════
    // 5. PROBLEMA
    // ═══════════════════════════════════════════════════════════════════
    'problem' => [
        'headline' => 'O casă poate arăta bine și, totuși, să te coste prea mult în fiecare lună.',
        'body' => [
            'În România, foarte multe case sunt construite fără o analiză energetică integrată. Beneficiarii aleg soluțiile după recomandarea constructorului, după prețul individual al fiecărui produs sau după cum a făcut ruda sau prietenul.',
            'Rezultatul este ceea ce eu numesc o <strong>casă parșivă</strong> — o casă care arată bine și pare performantă, dar ascunde detalii greșite, punți termice, infiltrații de aer, risc de condens și costuri ridicate de utilizare.',
            'Problema nu vine, în majoritatea cazurilor, de la arhitecți, constructori sau furnizori luați individual. Vine din lipsa coordonării între specialități și din decizii luate prea târziu — atunci când mai poate fi făcut doar un compromis.',
        ],
        'callout' => 'Diferența dintre o casă bine făcută și una parșivă se joacă pe hârtie, înainte să înceapă șantierul.',
    ],

    // ═══════════════════════════════════════════════════════════════════
    // 6. COSTUL REAL
    // ═══════════════════════════════════════════════════════════════════
    'total_cost' => [
        'headline' => 'Costul real al casei este suma a trei costuri.',
        'lead' => 'Oamenii se întreabă prea mult cât îi costă să construiască o casă și prea puțin cât îi va costa să locuiască în ea. Consultanța nu ieftinește construcția cu orice preț — reduce costul <em>total</em>.',
        'formula' => [
            'label' => 'Costul TOTAL al casei =',
            'parts' => [
                ['label' => 'Costul construcției',              'note' => 'plătit o dată'],
                ['label' => 'Costul utilizării',                'note' => 'plătit 30+ ani'],
                ['label' => 'Costul greșelilor și reparațiilor', 'note' => 'plătit când nu îl mai poți evita'],
            ],
        ],
        'reduces' => [
            'cheltuieli inutile din timpul construcției',
            'modificări realizate târziu în șantier',
            'incompatibilități între sisteme',
            'costuri lunare de încălzire și răcire',
            'risc de condens și mucegai',
            'disconfort termic vara și iarna',
            'costuri viitoare de reparație',
        ],
        'disclaimer' => 'O casă pasivă nu este întotdeauna cea mai ieftină la construcție. O proiectare atentă însă optimizează investiția totală și previne cheltuielile suplimentare provocate de improvizații și refaceri.',
    ],

    // ═══════════════════════════════════════════════════════════════════
    // 7. CASA SE CONSTRUIEȘTE DE 3 ORI
    // ═══════════════════════════════════════════════════════════════════
    'three_times' => [
        'headline' => 'O casă se construiește de trei ori.',
        'lead'     => 'Prima dată în mintea ta. A doua oară pe hârtie. A treia oară în șantier. Cele mai ieftine modificări sunt cele făcute în etapa a doua.',
        'stages' => [
            [
                'number'    => '1',
                'icon'      => 'brain',
                'title'     => 'În mintea ta',
                'subtitle'  => 'Dorințele și obiectivele',
                'body'      => 'Aici visezi casa: câte camere, cum vrei să te simți în ea, ce fel de confort, ce buget. Această etapă e a ta.',
            ],
            [
                'number'    => '2',
                'icon'      => 'plans',
                'title'     => 'Pe hârtie',
                'subtitle'  => 'Proiectarea, calculele și detaliile',
                'body'      => 'Aici trebuie să apară toate deciziile tehnice: grosimile termoizolației, poziția tâmplăriei, punțile termice, ventilația, instalațiile. Modificările costă puțin.',
                'highlight' => true,
            ],
            [
                'number'    => '3',
                'icon'      => 'site',
                'title'     => 'În șantier',
                'subtitle'  => 'Execuția propriu-zisă',
                'body'      => 'Aici se vede tot ce nu a fost decis pe hârtie. Modificările costă mult, iar unele nu mai pot fi făcute deloc.',
            ],
        ],
        'callout' => 'Dacă etapa a doua e tratată superficial, ajungi în șantier și descoperi: termoizolația trebuie mărită, structura nu permite grosimea necesară, ferestrele nu pot fi montate în poziția energetică potrivită, instalațiile străpung necontrolat stratul de etanșeitate, ventilația nu a fost prevăzută. Bugetul crește, iar compromisurile devin permanente.',
        'conclusion' => 'Cele mai ieftine modificări sunt cele făcute în proiect, înainte să înceapă șantierul.',
    ],

    // ═══════════════════════════════════════════════════════════════════
    // 8. CE ANALIZĂM (anvelopa casei)
    // ═══════════════════════════════════════════════════════════════════
    'envelope' => [
        'headline' => 'Analizăm casa ca pe un sistem întreg — nu ca pe o listă de produse.',
        'lead'     => 'Fiecare element al anvelopei influențează performanța celorlalte. Când sunt coordonate corect, casa consumă puțin. Când sunt luate separat, apar punțile termice și pierderile de energie.',
        'items' => [
            ['id' => 'fundatie',      'title' => 'Fundație și soclu',        'desc' => 'Continuitatea termoizolației la nivelul soclului, tratarea punții termice fundație-perete, izolare orizontală și verticală adecvată.'],
            ['id' => 'pereti',        'title' => 'Pereți exteriori',         'desc' => 'Structură, grosimea și tipul termoizolației, controlul vaporilor, stratul de etanșeitate la aer, coerența cu ferestrele.'],
            ['id' => 'acoperis',      'title' => 'Acoperiș',                 'desc' => 'Termoizolație între și peste căpriori, folie anticondens, ventilația, continuitatea cu peretele exterior, detalii la coșuri și lucarne.'],
            ['id' => 'izolatie',      'title' => 'Termoizolație',            'desc' => 'Grosimile și tipurile necesare, coerența pe toată anvelopa, evitarea întreruperilor, poziționarea corectă a straturilor.'],
            ['id' => 'ferestre',      'title' => 'Ferestre și uși',          'desc' => 'Ug, Uf, Uw, poziția în zid, banda perimetrală de etanșare, poziționarea față de termoizolație, controlul câștigurilor solare.'],
            ['id' => 'etanseitate',   'title' => 'Etanșeitate la aer',       'desc' => 'Stratul continuu de etanșeitate, tratarea străpungerilor pentru instalații, blower door test, prevenirea infiltrațiilor.'],
            ['id' => 'punti-termice', 'title' => 'Punți termice',            'desc' => 'Identificarea și reducerea punților la soclu, colțuri, planșee, balcoane, tâmplărie — acolo unde se pierde cel mai mult.'],
            ['id' => 'ventilatie',    'title' => 'Ventilație',               'desc' => 'Sistem cu recuperare de căldură, dimensionarea, traseele, filtrele, integrarea în anvelopa etanșă.'],
            ['id' => 'incalzire',     'title' => 'Încălzire și răcire',      'desc' => 'Necesarul real după optimizarea anvelopei, dimensionarea sistemului, sursa de energie, apa caldă menajeră.'],
            ['id' => 'umbrire',       'title' => 'Umbrire și confort de vară','desc' => 'Prevenirea supraîncălzirii, umbrire pe fațadele expuse, geam adaptat orientării, strategia de răcire.'],
        ],
        'note' => 'Pe fiecare zonă analizăm materialele, dimensionarea, poziționarea și racordurile. Rezultatul este un plan coerent — nu o listă de produse cumpărate separat.',
    ],

    // ═══════════════════════════════════════════════════════════════════
    // 9. CE PRIMEȘTI CONCRET
    // ═══════════════════════════════════════════════════════════════════
    'deliverables' => [
        'headline' => 'Nu primești o listă de produse. Primești o strategie coerentă pentru întreaga casă.',
        'items' => [
            ['icon' => 'chart',    'title' => 'Analiza proiectului',   'desc' => 'Verificarea documentației și identificarea deciziilor critice.'],
            ['icon' => 'model',    'title' => 'Modelare PHPP',         'desc' => 'Modelare energetică profesională (când e inclusă în pachet).'],
            ['icon' => 'scenarios','title' => 'Scenarii tehnice',      'desc' => 'Două sau trei variante comparate pe performanță și cost.'],
            ['icon' => 'roadmap',  'title' => 'Recomandări prioritizate','desc' => 'Ce decizi acum, ce poți amâna, ce nu se poate schimba mai târziu.'],
            ['icon' => 'details',  'title' => 'Detalii orientative',   'desc' => 'Pentru fundație, soclu, planșee, tâmplărie, alte racorduri critice.'],
            ['icon' => 'report',   'title' => 'Raport final scris',    'desc' => 'Documentul pe care îl păstrezi și îl folosești în șantier.'],
            ['icon' => 'meetings', 'title' => 'Întâlniri de lucru',    'desc' => 'Online sau la sediu, cu tine și, dacă vrei, cu arhitectul.'],
            ['icon' => 'site',     'title' => 'Verificări în șantier', 'desc' => 'Doar în Pachetul 3: prezent în etapele critice pentru validare.'],
        ],
    ],

    // ═══════════════════════════════════════════════════════════════════
    // 10. PROCESUL
    // ═══════════════════════════════════════════════════════════════════
    'process' => [
        'headline' => 'Cinci pași simpli. Fără mister, fără vânzare forțată.',
        'steps' => [
            ['n' => '1', 'title' => 'Aplici',           'desc' => 'Completezi formularul de mai jos. Îmi spui stadiul proiectului, obiectivul și ce documente ai.'],
            ['n' => '2', 'title' => 'Evaluăm împreună', 'desc' => 'Ne auzim scurt (telefon sau online) ca să înțelegem exact ce ai și ce vrei să obții.'],
            ['n' => '3', 'title' => 'Alegem pachetul',  'desc' => 'Îți recomand pachetul potrivit stadiului și obiectivului tău. Nu te forțez la ceva ce nu-ți trebuie.'],
            ['n' => '4', 'title' => 'Analizăm proiectul','desc' => 'Analiză, modelare, scenarii, recomandări. Ne întâlnim de câte ori e nevoie pentru claritate.'],
            ['n' => '5', 'title' => 'Livrăm strategia', 'desc' => 'Primești raportul final. Dacă ai ales Pachetul 3, verificăm împreună implementarea în șantier.'],
        ],
    ],

    // ═══════════════════════════════════════════════════════════════════
    // 11. PACHETE
    // ═══════════════════════════════════════════════════════════════════
    'packages' => [
        [
            'id'       => 'analiza',
            'name'     => 'Analiză de proiect',
            'tagline'  => 'Potrivit pentru o primă evaluare a direcției proiectului',
            'ideal_for' => 'Pentru beneficiarii care au un proiect și vor să afle dacă direcția este corectă înainte de a începe execuția.',
            'features' => [
                'Analiza documentației disponibile (arhitectură, plan, secțiuni, fațade)',
                '1 întâlnire online de calibrare',
                'Identificarea principalelor riscuri: termoizolație, tâmplărie, etanșeitate, punți termice',
                'Analiza generală a anvelopei termice',
                'Raport scris cu priorități și recomandări',
                '1 întâlnire online de prezentare a concluziilor',
            ],
            'price_note' => 'Preț stabilit după evaluarea proiectului',
            'cta_label'  => 'Aplică pentru analiza proiectului',
            'highlight'  => false,
        ],
        [
            'id'       => 'optimizare',
            'name'     => 'Optimizare nZEB / Passive House',
            'tagline'  => 'Recomandat pentru proiecte aflate înainte de execuție',
            'ideal_for' => 'Pentru beneficiarii care vor o casă cu performanțe clar definite și compararea mai multor scenarii tehnice.',
            'features' => [
                'Tot ce include Pachetul Analiză',
                'Modelare energetică completă în PHPP',
                'Analiza necesarului de încălzire și răcire',
                'Verificarea riscului de supraîncălzire',
                'Analiza pierderilor și câștigurilor solare',
                '2-3 scenarii tehnice comparate (materiale, sisteme, grosimi)',
                'Recomandări pentru anvelopă și instalații',
                'Actualizarea modelului după alegerea variantei',
                'Raport final și prezentarea rezultatelor',
            ],
            'price_note' => 'Preț stabilit după evaluarea proiectului',
            'cta_label'  => 'Aplică pentru optimizarea proiectului',
            'highlight'  => true,
            'note'       => 'Consultanța și modelarea nu reprezintă automat certificarea oficială a clădirii Passive House. Certificarea presupune implicarea unui certificator PHI acreditat.',
        ],
        [
            'id'       => 'completa',
            'name'     => 'Consultanță completă: proiect și șantier',
            'tagline'  => 'Recomandat pentru control complet până la finalizare',
            'ideal_for' => 'Pentru beneficiarii care doresc sprijin până la implementarea corectă a soluțiilor în șantier.',
            'features' => [
                'Tot ce include Pachetul Optimizare',
                'Plan de verificare pentru etapele critice',
                'Consultanță tehnică pe parcursul execuției',
                'Vizite în șantier în raza 100 km București (incluse; peste rază — deplasare cu acord separat)',
                'Verificarea detaliilor înainte de acoperirea cu finisaje',
                'Liste cu observații și neconformități',
                'Întâlniri cu echipele implicate',
                'Suport pentru clarificarea detaliilor',
                'Verificare finală conform scope-ului contractat',
            ],
            'price_note' => 'Preț stabilit după evaluarea proiectului',
            'cta_label'  => 'Aplică pentru consultanță completă',
            'highlight'  => false,
            'note'       => 'Numărul vizitelor și distanțele exacte se stabilesc prin contract, adaptat proiectului.',
        ],
    ],

    // ═══════════════════════════════════════════════════════════════════
    // 12. DESPRE MIRCEA
    // ═══════════════════════════════════════════════════════════════════
    'about' => [
        'headline' => 'Cine sunt și de ce fac asta',
        'lead'     => 'Am lucrat 20 de ani în construcții. Am făcut ofertare și consultanță, am vândut și distribuit sisteme pentru construcții, am coordonat implementări și am fost în șantier. Am văzut diferența dintre performanța declarată a unui produs și performanța reală obținută după montaj.',
        'body' => [
            'Această combinație — cunoștințele tehnice, experiența comercială și practica din șantier — mă ajută să văd casa nu doar din biroul de proiectare, ci și din perspectiva echipelor care o construiesc.',
            'Fondez și conduc <strong>BDM Systems</strong>, care oferă soluții pentru trei componente esențiale ale anvelopei: <strong>Acoperiș Sănătos</strong>, <strong>Tâmplărie Sănătoasă</strong> și <strong>Izolații Sănătoase</strong> (inclusiv izolații suflate cu fibre de lemn). Această activitate zilnică cu materialele mă ajută să înțeleg cum funcționează sistemele integrate.',
            '<strong>Nu mă interesează doar ce scrie în fișa tehnică. Mă interesează performanța obținută după ce produsul a fost integrat și montat în casa ta.</strong>',
            'În consultanța pe care o ofer, poți alege orice furnizori compatibili — nu ești obligat să cumperi de la BDM Systems. Recomandările le fac pe baza criteriilor de performanță, compatibilitate și execuție corectă.',
        ],
        'quote' => [
            'text'   => 'Atunci când construim, să ne gândim că o facem pentru totdeauna.',
            'author' => 'John Ruskin',
        ],
        'image'     => '/uploads/consultanta/mircea-santier-expo.jpg',
        'image_alt' => 'Mircea Barticel la eveniment BDM Systems, prezentând structura anvelopei termice',
    ],

    // ═══════════════════════════════════════════════════════════════════
    // 13. STUDII DE CAZ (visible: false — apar când sunt populate)
    // ═══════════════════════════════════════════════════════════════════
    'case_studies' => [
        'visible'  => false,
        'headline' => 'Studii de caz',
        'lead'     => 'Proiecte pe care le-am analizat și am contribuit la implementarea lor corectă.',
        'items'    => [
            // Structură de referință (nu se afișează până visible=true):
            // [
            //     'title'    => 'Casă individuală, București',
            //     'type'     => 'Construcție nouă, standard nZEB',
            //     'location' => 'Ilfov',
            //     'status'   => 'Finalizat 2025',
            //     'problem'  => 'Text...',
            //     'solution' => 'Text...',
            //     'results'  => ['rezultat 1', 'rezultat 2'],
            //     'images'   => ['/uploads/consultanta/case-1-a.jpg'],
            //     'client_approved' => true,
            // ],
        ],
    ],

    // ═══════════════════════════════════════════════════════════════════
    // 14. TESTIMONIALE (visible: false — apar când sunt populate)
    // ═══════════════════════════════════════════════════════════════════
    'testimonials' => [
        'visible' => false,
        'headline' => 'Ce spun clienții',
        'items'    => [
            // [
            //     'name'    => 'Nume Client',
            //     'role'    => 'Beneficiar, casă unifamilială București',
            //     'text'    => 'Textul aprobat de client...',
            //     'photo'   => '/uploads/consultanta/testimonial-1.jpg',
            //     'consent' => true,
            //     'date'    => '2026-01-15',
            // ],
        ],
    ],

    // ═══════════════════════════════════════════════════════════════════
    // 15. FAQ
    // ═══════════════════════════════════════════════════════════════════
    'faq' => [
        'headline' => 'Întrebări frecvente',
        'items' => [
            [
                'q' => 'Când este cel mai bun moment să apelez la consultanță?',
                'a' => 'Ideal: imediat după ce ai un proiect de arhitectură conturat, dar ÎNAINTE de emiterea proiectului tehnic și de începerea execuției. Atunci deciziile costă cel mai puțin să fie ajustate.',
            ],
            [
                'q' => 'Pot solicita consultanță dacă șantierul a început deja?',
                'a' => 'Da. Analizăm ce mai poate fi optimizat fără demolări majore, ce trebuie tratat cu prioritate și ce compromisuri se pot evita. Rezultatul depinde de stadiul concret al execuției.',
            ],
            [
                'q' => 'Care este diferența dintre nZEB și Passive House?',
                'a' => '<strong>nZEB</strong> (nearly Zero-Energy Building) este cerința legală minimă europeană pentru clădirile noi — consum energetic aproape de zero. <strong>Passive House</strong> este un standard voluntar internațional, cu cerințe stricte de performanță energetică, confort și etanșeitate. Passive House este substanțial mai performant decât nZEB, dar necesită proiectare atentă și investiție corect direcționată.',
            ],
            [
                'q' => 'Consultanța înseamnă automat certificarea casei?',
                'a' => 'Nu. Consultanța și modelarea PHPP te ajută să atingi performanța dorită. Certificarea oficială Passive House presupune un proces separat, cu implicarea unui certificator PHI acreditat. Dacă vrei să mergi și pe certificare, te pot orienta și pot pregăti proiectul pentru acest proces.',
            ],
            [
                'q' => 'Ce documente trebuie să trimit?',
                'a' => 'Ideal: planurile arhitecturale (parter, etaje, secțiuni, fațade), memoriul de arhitectură și, dacă există, memoriul de rezistență și de instalații. În formular poți încărca PDF-uri sau imagini. Dacă ești doar la nivel de idee, ne descurcăm și cu descrierea proiectului.',
            ],
            [
                'q' => 'Poate fi analizată și o renovare?',
                'a' => 'Da. Renovările energetice au particularități — constrângeri structurale, umidități existente, imposibilitatea unor detalii — și necesită o analiză diferită de o casă nouă. Le tratăm ca proiecte distincte.',
            ],
            [
                'q' => 'Primesc recomandări de materiale și produse?',
                'a' => 'Da. Îți recomand criterii de performanță și, unde e util, produse concrete care satisfac acele criterii. Îți dau alternative în funcție de buget și de disponibilitate.',
            ],
            [
                'q' => 'Sunt obligat să cumpăr produsele de la BDM Systems?',
                'a' => 'Nu. BDM Systems distribuie o parte din sistemele recomandate, dar poți alege orice furnizori compatibili. Recomandările le fac pe baza performanței și a compatibilității tehnice, nu a interesului comercial.',
            ],
            [
                'q' => 'Se pot compara mai multe variante de construcție?',
                'a' => 'Da — asta e chiar valoarea principală a Pachetului Optimizare nZEB/Passive House. Modelăm 2-3 scenarii (materiale, grosimi, sisteme) și comparăm impactul lor asupra performanței energetice și confortului.',
            ],
            [
                'q' => 'PHPP îmi spune exact cât voi plăti lunar?',
                'a' => 'Nu. PHPP estimează necesarul energetic al clădirii (kWh/m²·an) și permite scenarii orientative de cost. Facturile efective depind de tarife, climă, temperaturile interioare pe care le alegi și modul de utilizare. Nu putem garanta o valoare exactă a facturii lunare.',
            ],
            [
                'q' => 'În ce zone sunt disponibile vizitele în șantier?',
                'a' => 'Sediul BDM Systems este în București, Prelungirea Ghencea 95C. Vizitele în șantier sunt incluse în raza <strong>100 km București</strong> (județele București, Ilfov, Giurgiu, Dâmbovița, Prahova, Ialomița, Călărași, parțial Argeș/Teleorman). Pentru distanțe mai mari, deplasările se stabilesc prin acord separat.',
            ],
            [
                'q' => 'Cât durează analiza?',
                'a' => 'Depinde de amploarea proiectului și de pachetul ales. Analiza unui proiect complet durează câteva săptămâni. Îți dau un termen concret după ce văd documentația și înțelegem obiectivul.',
            ],
        ],
    ],

    // ═══════════════════════════════════════════════════════════════════
    // 16. STATISTICĂ PASSIVE HOUSE
    // ═══════════════════════════════════════════════════════════════════
    'stat' => [
        'text'   => 'O casă proiectată la standard Passive House poate necesita cu până la aproximativ 90% mai puțină energie pentru încălzire decât clădirile existente convenționale și cu aproximativ 75% mai puțin decât o construcție nouă obișnuită.',
        'source' => 'Passive House Institute',
        'disclaimer' => 'Rezultatul depinde de climă, tarife, temperaturile interioare alese și de calitatea execuției. Estimarea nu reprezintă o garanție contractuală privind factura lunară.',
    ],

    // ═══════════════════════════════════════════════════════════════════
    // 17. CTA FINAL
    // ═══════════════════════════════════════════════════════════════════
    'cta_final' => [
        'headline' => 'Proiectează acum costurile pe care nu vrei să le plătești mai târziu.',
        'body'     => 'Trimite-mi proiectul și spune-mi ce îți dorești de la viitoarea casă. Analizez stadiul în care te afli și îți voi recomanda pachetul potrivit.',
        'button'   => 'Aplică pentru consultanță',
    ],

    // ═══════════════════════════════════════════════════════════════════
    // 18. FORMULAR — opțiuni pe pași
    // ═══════════════════════════════════════════════════════════════════
    'form' => [
        'step1_project_types' => [
            'constructie-noua'  => 'Construcție nouă',
            'renovare'          => 'Renovare',
            'extindere'         => 'Extindere / mansardare',
            'alt'               => 'Alt tip de proiect',
        ],
        'step1_building_types' => [
            'casa-individuala'  => 'Casă individuală',
            'duplex'            => 'Duplex / casă cuplată',
            'clădire-multifam'  => 'Clădire cu mai multe apartamente',
            'birou-comercial'   => 'Clădire de birouri / spațiu comercial',
            'alt'               => 'Alt tip de clădire',
        ],
        'step2_stages' => [
            'idee'          => 'Sunt la nivel de idee',
            'arhitectura'   => 'Am proiect de arhitectură',
            'tehnic'        => 'Am proiect tehnic complet',
            'inainte-santier' => 'Urmează să încep șantierul',
            'fundatie'      => 'Fundația este executată',
            'structura'     => 'Structura este executată',
            'inchisa'       => 'Casa este închisă (structură + acoperiș)',
            'instalatii'    => 'Sunt în faza de instalații sau finisaje',
            'renovare'      => 'Este o renovare',
            'alt'           => 'Alt stadiu',
        ],
        'step3_objectives' => [
            'nzeb'                    => 'Casă conformă nZEB',
            'foarte-eficienta'        => 'Casă foarte eficientă energetic',
            'passive-house'           => 'Casă Passive House',
            'certificare'             => 'Pregătire pentru certificare Passive House',
            'reducere-costuri'        => 'Reducerea costurilor de utilizare',
            'confort'                 => 'Confort mai bun (termic, aer, umiditate)',
            'evitare-condens'         => 'Evitarea condensului și a punților termice',
            'nu-sunt-sigur'           => 'Nu sunt sigur — am nevoie de recomandare',
        ],
        'step4_packages' => [
            'analiza'    => 'Analiză de proiect',
            'optimizare' => 'Optimizare nZEB / Passive House',
            'completa'   => 'Consultanță completă: proiect și șantier',
            'nu-stiu'    => 'Nu știu încă — recomandă-mi tu',
        ],
        'step6_contact_preferences' => [
            'telefon'  => 'Telefon',
            'email'    => 'Email',
            'whatsapp' => 'WhatsApp',
        ],
        'step6_contact_times' => [
            'dimineata'  => 'Dimineața (09:00 - 12:00)',
            'pranz'      => 'La prânz (12:00 - 14:00)',
            'dupa-amiaza'=> 'După-amiaza (14:00 - 18:00)',
            'seara'      => 'Seara (18:00 - 20:00)',
            'oricand'    => 'Oricând în timpul zilei',
        ],
        'upload_max_size_mb' => 15,
        'upload_max_files'   => 8,
        'upload_allowed'     => ['pdf', 'jpg', 'jpeg', 'png', 'webp', 'dwg', 'dxf'],
        'success_message'    => 'Am primit informațiile despre proiectul tău. Le voi analiza și voi reveni pentru a stabili următorul pas.',
    ],

    // ═══════════════════════════════════════════════════════════════════
    // 19. ANALYTICS EVENTS (activare GA4 la final)
    // ═══════════════════════════════════════════════════════════════════
    'analytics_events' => [
        'hero_cta_primary_click'    => 'consulting_hero_cta_primary',
        'hero_cta_secondary_click'  => 'consulting_hero_cta_secondary',
        'package_view'              => 'consulting_package_view',
        'package_cta_click'         => 'consulting_package_cta_click',
        'form_start'                => 'consulting_form_start',
        'form_step_complete'        => 'consulting_form_step_complete',
        'form_step_abandon'         => 'consulting_form_step_abandon',
        'form_upload'               => 'consulting_form_upload',
        'form_submit_success'       => 'consulting_form_submit_success',
        'form_submit_error'         => 'consulting_form_submit_error',
        'phone_click'               => 'consulting_phone_click',
        'email_click'               => 'consulting_email_click',
        'whatsapp_click'            => 'consulting_whatsapp_click',
        'faq_open'                  => 'consulting_faq_open',
        'section_pachete_view'      => 'consulting_pachete_view',
        'certificate_pdf_click'     => 'consulting_certificate_pdf_click',
    ],
];
