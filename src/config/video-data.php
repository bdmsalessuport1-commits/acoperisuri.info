<?php

/**
 * Video data — categorii + videouri TikTok
 *
 * Structura pregatita pentru migrare catre baza de date in Etapa 18.
 * Schema viitoare:
 *   videos (id, title, tiktok_url, tiktok_embed_code, description,
 *           category_id, subcategory_id, thumbnail, published_at,
 *           is_active, sort_order, created_at)
 *   video_categories (id, name, slug, parent_id, sort_order, is_active)
 */

return [

    // ─── CATEGORII (parent_id = null → categorie principala) ──────────
    'categories' => [
        [
            'slug' => 'montaj-acoperis',
            'name' => 'Montaj acoperis',
            'icon' => '&#128295;',
            'subcategories' => [
                ['slug' => 'tigla-metalica',  'name' => 'Tigla metalica'],
                ['slug' => 'tabla-faltuita',  'name' => 'Tabla faltuita'],
                ['slug' => 'tabla-click',     'name' => 'Tabla click'],
            ],
        ],
        [
            'slug' => 'sisteme-pluviale',
            'name' => 'Sisteme pluviale',
            'icon' => '&#127783;',
            'subcategories' => [
                ['slug' => 'montaj-jgheaburi', 'name' => 'Montaj jgheaburi'],
                ['slug' => 'montaj-burlane',   'name' => 'Montaj burlane'],
            ],
        ],
        [
            'slug' => 'sfaturi-tehnice',
            'name' => 'Sfaturi tehnice',
            'icon' => '&#128161;',
            'subcategories' => [
                ['slug' => 'alegere-materiale', 'name' => 'Alegere materiale'],
                ['slug' => 'izolatie',          'name' => 'Izolatie'],
                ['slug' => 'ventilatie-pod',    'name' => 'Ventilatie pod'],
            ],
        ],
        [
            'slug' => 'studii-de-caz',
            'name' => 'Studii de caz',
            'icon' => '&#127968;',
            'subcategories' => [
                ['slug' => 'proiecte-finalizate',     'name' => 'Proiecte finalizate'],
                ['slug' => 'transformari-before-after','name' => 'Transformari before/after'],
            ],
        ],
    ],

    // ─── VIDEOURI ─────────────────────────────────────────────────────
    // tiktok_id = ID-ul videoclipului din URL-ul TikTok
    // tiktok_url = URL-ul complet TikTok
    // Embed-ul se genereaza automat din tiktok_id
    'videos' => [

        // ── Montaj acoperis / Tigla metalica ──
        [
            'slug'             => 'montaj-tigla-metalica-pas-cu-pas',
            'title'            => 'Montaj tigla metalica - pas cu pas',
            'description'      => 'Cum se monteaza tigla metalica corect, de la sipci si contrasipc pana la fixarea cu suruburi speciale. Ghid vizual complet.',
            'category_slug'    => 'montaj-acoperis',
            'subcategory_slug' => 'tigla-metalica',
            'tiktok_id'        => '7380000000000000001',
            'tiktok_url'       => 'https://www.tiktok.com/@bdmsystems/video/7380000000000000001',
            'published_at'     => '2025-03-20',
            'date_display'     => '20 martie 2025',
            'is_active'        => true,
            'sort_order'       => 1,
        ],
        [
            'slug'             => 'coama-si-dolie-montaj-corect',
            'title'            => 'Coama si dolie - montaj corect pe tigla metalica',
            'description'      => 'Cum se monteaza corect elementele de coama si dolie pe acoperisul cu tigla metalica. Detalii tehnice importante.',
            'category_slug'    => 'montaj-acoperis',
            'subcategory_slug' => 'tigla-metalica',
            'tiktok_id'        => '7380000000000000002',
            'tiktok_url'       => 'https://www.tiktok.com/@bdmsystems/video/7380000000000000002',
            'published_at'     => '2025-03-15',
            'date_display'     => '15 martie 2025',
            'is_active'        => true,
            'sort_order'       => 2,
        ],

        // ── Montaj acoperis / Tabla faltuita ──
        [
            'slug'             => 'tabla-faltuita-click-montaj',
            'title'            => 'Tabla faltuita cu falt click - demonstratie montaj',
            'description'      => 'Montajul tablei faltuita cu sistem click fara suruburi vizibile. Rezultatul: un acoperis neted, modern si impermeabil.',
            'category_slug'    => 'montaj-acoperis',
            'subcategory_slug' => 'tabla-faltuita',
            'tiktok_id'        => '7380000000000000003',
            'tiktok_url'       => 'https://www.tiktok.com/@bdmsystems/video/7380000000000000003',
            'published_at'     => '2025-03-10',
            'date_display'     => '10 martie 2025',
            'is_active'        => true,
            'sort_order'       => 3,
        ],

        // ── Montaj acoperis / Tabla click ──
        [
            'slug'             => 'tabla-click-metigla-clic',
            'title'            => 'Metigla CLIC - montaj tabla click pe acoperis',
            'description'      => 'Montajul tablei click Metigla CLIC cu latimea utila de 515mm. Falt de 25mm si panta minima de 8 grade.',
            'category_slug'    => 'montaj-acoperis',
            'subcategory_slug' => 'tabla-click',
            'tiktok_id'        => '7380000000000000004',
            'tiktok_url'       => 'https://www.tiktok.com/@bdmsystems/video/7380000000000000004',
            'published_at'     => '2025-03-05',
            'date_display'     => '5 martie 2025',
            'is_active'        => true,
            'sort_order'       => 4,
        ],

        // ── Sisteme pluviale / Montaj jgheaburi ──
        [
            'slug'             => 'montaj-jgheab-metalic-125',
            'title'            => 'Montaj jgheab metalic 125mm - panta si fixare corecta',
            'description'      => 'Cum montezi jgheabul metalic cu panta corecta de 3mm/ml, fixare carlige la 60cm distanta si imbinare etansa.',
            'category_slug'    => 'sisteme-pluviale',
            'subcategory_slug' => 'montaj-jgheaburi',
            'tiktok_id'        => '7380000000000000005',
            'tiktok_url'       => 'https://www.tiktok.com/@bdmsystems/video/7380000000000000005',
            'published_at'     => '2025-02-28',
            'date_display'     => '28 februarie 2025',
            'is_active'        => true,
            'sort_order'       => 5,
        ],

        // ── Sisteme pluviale / Montaj burlane ──
        [
            'slug'             => 'montaj-burlan-rectangular-flamingo',
            'title'            => 'Montaj burlan rectangular Flamingo iQ Budmat',
            'description'      => 'Montajul burlanului rectangular din sistemul Flamingo iQ Budmat. Cot 72 grade, bratara fixare si racord la canalizare.',
            'category_slug'    => 'sisteme-pluviale',
            'subcategory_slug' => 'montaj-burlane',
            'tiktok_id'        => '7380000000000000006',
            'tiktok_url'       => 'https://www.tiktok.com/@bdmsystems/video/7380000000000000006',
            'published_at'     => '2025-02-20',
            'date_display'     => '20 februarie 2025',
            'is_active'        => true,
            'sort_order'       => 6,
        ],

        // ── Sfaturi tehnice / Alegere materiale ──
        [
            'slug'             => 'cum-alegi-finisajul-tiglei-metalice',
            'title'            => 'Cum alegi finisajul tiglei metalice - lucios vs mat vs neomat',
            'description'      => 'Diferentele dintre finisajele lucios (25um), mat (35um) si neomat (60um). Garantie, rezistenta UV si pret comparat.',
            'category_slug'    => 'sfaturi-tehnice',
            'subcategory_slug' => 'alegere-materiale',
            'tiktok_id'        => '7380000000000000007',
            'tiktok_url'       => 'https://www.tiktok.com/@bdmsystems/video/7380000000000000007',
            'published_at'     => '2025-02-15',
            'date_display'     => '15 februarie 2025',
            'is_active'        => true,
            'sort_order'       => 7,
        ],
        [
            'slug'             => 'ral-7016-vs-ral-9005-culori-acoperis',
            'title'            => 'RAL 7016 vs RAL 9005 - care culoare e mai buna pentru acoperis?',
            'description'      => 'Antracit sau negru mat? Comparam cele doua culori preferate pentru acoperisuri in 2025. Aspect vizual si performanta.',
            'category_slug'    => 'sfaturi-tehnice',
            'subcategory_slug' => 'alegere-materiale',
            'tiktok_id'        => '7380000000000000008',
            'tiktok_url'       => 'https://www.tiktok.com/@bdmsystems/video/7380000000000000008',
            'published_at'     => '2025-02-10',
            'date_display'     => '10 februarie 2025',
            'is_active'        => true,
            'sort_order'       => 8,
        ],

        // ── Sfaturi tehnice / Izolatie ──
        [
            'slug'             => 'steico-zell-suflare-mansarda',
            'title'            => 'STEICO Zell - suflare izolatie mansarda in actiune',
            'description'      => 'Cum se sufla izolatia STEICO Zell intre capriori la mansarda. Densitate 55-60 kg/mc, lambda 0.038 W/mK.',
            'category_slug'    => 'sfaturi-tehnice',
            'subcategory_slug' => 'izolatie',
            'tiktok_id'        => '7380000000000000009',
            'tiktok_url'       => 'https://www.tiktok.com/@bdmsystems/video/7380000000000000009',
            'published_at'     => '2025-02-05',
            'date_display'     => '5 februarie 2025',
            'is_active'        => true,
            'sort_order'       => 9,
        ],

        // ── Sfaturi tehnice / Ventilatie pod ──
        [
            'slug'             => 'ventilatie-pod-de-ce-e-importanta',
            'title'            => 'Ventilatia podului - de ce e esentiala pentru acoperis',
            'description'      => 'Fara ventilatie corecta, condensul distruge structura. Cum functioneaza ventilatia naturala a podului si ce accesorii ai nevoie.',
            'category_slug'    => 'sfaturi-tehnice',
            'subcategory_slug' => 'ventilatie-pod',
            'tiktok_id'        => '7380000000000000010',
            'tiktok_url'       => 'https://www.tiktok.com/@bdmsystems/video/7380000000000000010',
            'published_at'     => '2025-01-28',
            'date_display'     => '28 ianuarie 2025',
            'is_active'        => true,
            'sort_order'       => 10,
        ],

        // ── Studii de caz / Proiecte finalizate ──
        [
            'slug'             => 'acoperis-nou-wetterbest-colosseum-brasov',
            'title'            => 'Acoperis nou cu Wetterbest Colosseum - Brasov 2024',
            'description'      => 'Proiect finalizat: renovare completa acoperis 280mp cu tigla Wetterbest Colosseum RAL 7016 antracit. Inainte si dupa.',
            'category_slug'    => 'studii-de-caz',
            'subcategory_slug' => 'proiecte-finalizate',
            'tiktok_id'        => '7380000000000000011',
            'tiktok_url'       => 'https://www.tiktok.com/@bdmsystems/video/7380000000000000011',
            'published_at'     => '2025-01-20',
            'date_display'     => '20 ianuarie 2025',
            'is_active'        => true,
            'sort_order'       => 11,
        ],

        // ── Studii de caz / Transformari before/after ──
        [
            'slug'             => 'before-after-acoperis-vechi-la-nou',
            'title'            => 'Before/After - de la acoperis vechi la acoperis nou in 14 zile',
            'description'      => 'Transformarea completa a unui acoperis din anii 80. Demontare tigla veche, reparatie sarpanta, montaj Wetterbest + izolatie STEICO.',
            'category_slug'    => 'studii-de-caz',
            'subcategory_slug' => 'transformari-before-after',
            'tiktok_id'        => '7380000000000000012',
            'tiktok_url'       => 'https://www.tiktok.com/@bdmsystems/video/7380000000000000012',
            'published_at'     => '2025-01-15',
            'date_display'     => '15 ianuarie 2025',
            'is_active'        => true,
            'sort_order'       => 12,
        ],

    ], // end videos
];
