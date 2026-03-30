<?php

/**
 * Definitia rutelor aplicatiei
 *
 * Format: 'pattern' => ['controller' => 'ClassName', 'action' => 'method', 'name' => 'route.name']
 * Parametrii dinamici: {param} - captureaza segmentul URL
 */

return [
    // Homepage
    '/' => [
        'controller' => 'HomeController',
        'action' => 'index',
        'name' => 'home',
        'title' => 'Acoperisuri de calitate - BDM Systems',
        'description' => 'BDM Systems - solutii complete pentru acoperisuri, tigla metalica, sisteme pluviale, accesorii montaj. Calitate si garantie.',
    ],

    // Pagini statice
    '/despre-noi' => [
        'controller' => 'PageController',
        'action' => 'about',
        'name' => 'about',
        'title' => 'Despre noi - BDM Systems',
        'description' => 'Aflati mai multe despre BDM Systems, experienta noastra si echipa de profesionisti.',
    ],
    '/contact' => [
        'controller' => 'PageController',
        'action' => 'contact',
        'name' => 'contact',
        'title' => 'Contact - BDM Systems',
        'description' => 'Contacteaza-ne pentru oferte personalizate si consultanta gratuita pentru acoperisuri.',
    ],

    // Blog
    '/blog' => [
        'controller' => 'BlogController',
        'action' => 'index',
        'name' => 'blog',
        'title' => 'Blog - Ghiduri si articole utile | BDM Systems',
        'description' => 'Articole si ghiduri practice despre acoperisuri, montaj, intretinere, materiale si eficienta energetica.',
    ],
    '/sitemap-blog.xml' => [
        'controller' => 'BlogController',
        'action' => 'sitemap',
        'name' => 'blog.sitemap',
    ],
    '/blog/categorie/{slug}' => [
        'controller' => 'BlogController',
        'action' => 'category',
        'name' => 'blog.category',
    ],
    '/blog/{slug}' => [
        'controller' => 'BlogController',
        'action' => 'show',
        'name' => 'blog.show',
    ],

    // Video
    '/video' => [
        'controller' => 'VideoController',
        'action' => 'index',
        'name' => 'video',
        'title' => 'Videouri acoperisuri - Sfaturi si demonstratii | BDM Systems',
        'description' => 'Videouri TikTok cu montaj acoperis, sfaturi tehnice, sisteme pluviale si studii de caz.',
    ],
    '/video/categorie/{slug}' => [
        'controller' => 'VideoController',
        'action' => 'category',
        'name' => 'video.category',
    ],

    // Categorii de sine statatoare (cu titluri SEO)
    '/folii-anticondens' => [
        'controller' => 'CategoryController',
        'action' => 'show',
        'name' => 'folii-anticondens',
        'title' => 'Folii anticondens pentru acoperis - BDM Systems',
        'description' => 'Folii anticondens de calitate pentru protectia acoperisului. Montaj profesional si livrare in toata tara.',
    ],
    '/tamplarie-pvc-aluminiu' => [
        'controller' => 'CategoryController',
        'action' => 'show',
        'name' => 'tamplarie',
        'title' => 'Tamplarie PVC si Aluminiu - BDM Systems',
        'description' => 'Ferestre si usi din PVC si aluminiu de inalta calitate. Eficienta energetica si design modern.',
    ],
    '/ferestre-mansarda-fakro' => [
        'controller' => 'CategoryController',
        'action' => 'show',
        'name' => 'ferestre-mansarda',
        'title' => 'Ferestre mansarda FAKRO - BDM Systems',
        'description' => 'Ferestre de mansarda FAKRO - iluminare naturala si ventilatie pentru mansarda dumneavoastra.',
    ],
    '/scari-pod-fakro' => [
        'controller' => 'CategoryController',
        'action' => 'show',
        'name' => 'scari-pod',
        'title' => 'Scari de pod FAKRO - BDM Systems',
        'description' => 'Scari de pod FAKRO - acces sigur si confortabil la podul casei. Modele escamotabile si izolate termic.',
    ],
    '/izolatie' => [
        'controller' => 'CategoryController',
        'action' => 'show',
        'name' => 'izolatie',
        'title' => 'Izolatie fibre lemn STEICO Zell - BDM Systems',
        'description' => 'Izolatie ecologica din fibre de lemn STEICO Zell. Performanta termica superioara si confort.',
    ],
    '/hidroizolatii-terase' => [
        'controller' => 'CategoryController',
        'action' => 'show',
        'name' => 'hidroizolatii',
        'title' => 'Hidroizolatii terase - BDM Systems',
        'description' => 'Sisteme de hidroizolatie pentru terase. Protectie impermeabila de durata.',
    ],

    // Produs individual (INAINTE de categorii dinamice!)
    '/produs/{slug}' => [
        'controller' => 'ProductController',
        'action' => 'show',
        'name' => 'product',
    ],

    // Admin (INAINTE de categorii dinamice!)
    '/admin' => [
        'controller' => 'AdminController',
        'action' => 'dashboard',
        'name' => 'admin.dashboard',
        'layout' => 'admin',
        'title' => 'Admin - Dashboard',
    ],
    '/admin/produse' => [
        'controller' => 'AdminController',
        'action' => 'products',
        'name' => 'admin.products',
        'layout' => 'admin',
        'title' => 'Admin - Produse',
    ],
    '/admin/categorii' => [
        'controller' => 'AdminController',
        'action' => 'categories',
        'name' => 'admin.categories',
        'layout' => 'admin',
        'title' => 'Admin - Categorii',
    ],

    // Categorii si subcategorii (ULTIMELE - wildcard catch-all)
    '/{categorie}' => [
        'controller' => 'CategoryController',
        'action' => 'show',
        'name' => 'category',
    ],
    '/{categorie}/{subcategorie}' => [
        'controller' => 'CategoryController',
        'action' => 'subcategory',
        'name' => 'subcategory',
    ],
];
