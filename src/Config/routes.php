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
        'title' => 'Blog - BDM Systems',
        'description' => 'Articole si sfaturi despre acoperisuri, montaj, intretinere si materiale de constructii.',
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
        'title' => 'Video - BDM Systems',
        'description' => 'Tutoriale video si prezentari de produse pentru acoperisuri.',
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
