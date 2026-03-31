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
        'title' => 'Despre BDM Systems - 14+ ani experienta in acoperisuri',
        'description' => 'BDM Systems - din 2010, peste 4000 acoperisuri realizate. Tigla metalica, tabla faltuita, ferestre FAKRO, izolatie STEICO.',
    ],
    '/contact' => [
        'controller' => 'PageController',
        'action' => 'contact',
        'name' => 'contact',
        'title' => 'Contact - BDM Systems | Solicita oferta gratuita',
        'description' => 'Contacteaza BDM Systems pentru oferte personalizate, consultanta gratuita si informatii despre acoperisuri.',
    ],
    '/servicii' => [
        'controller' => 'PageController',
        'action' => 'services',
        'name' => 'services',
        'title' => 'Servicii acoperisuri - Montaj, renovare, consultanta | BDM Systems',
        'description' => 'Servicii profesionale: montaj acoperis, renovare, sisteme pluviale, ferestre FAKRO, izolatie STEICO. Consultanta gratuita.',
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

    // Evenimente
    '/evenimente' => [
        'controller' => 'EventController',
        'action' => 'index',
        'name' => 'events',
        'title' => 'Evenimente - BDM Systems',
        'description' => 'Evenimentele la care participam si organizam in domeniul constructiilor si acoperisurilor.',
    ],
    '/evenimente/{slug}' => [
        'controller' => 'EventController',
        'action' => 'show',
        'name' => 'events.show',
    ],

    // Cariere
    '/cariere' => [
        'controller' => 'CareerController',
        'action' => 'index',
        'name' => 'careers',
        'title' => 'Cariere - Lucreaza la BDM Systems',
        'description' => 'Joburi disponibile la BDM Systems. Alatura-te echipei noastre de profesionisti.',
    ],
    '/cariere/{slug}' => [
        'controller' => 'CareerController',
        'action' => 'show',
        'name' => 'careers.show',
    ],

    // SEO
    '/sitemap.xml' => [
        'controller' => 'SeoController',
        'action' => 'sitemap',
        'name' => 'sitemap',
    ],
    '/robots.txt' => [
        'controller' => 'SeoController',
        'action' => 'robots',
        'name' => 'robots',
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

    // Auth
    '/admin/login' => [
        'controller' => 'AuthController',
        'action' => 'login',
        'name' => 'admin.login',
    ],
    '/admin/logout' => [
        'controller' => 'AuthController',
        'action' => 'logout',
        'name' => 'admin.logout',
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
    '/admin/produse/adauga' => [
        'controller' => 'AdminController',
        'action' => 'productAdd',
        'name' => 'admin.products.add',
        'layout' => 'admin',
        'title' => 'Admin - Adauga produs',
    ],
    '/admin/produse/editeaza/{id}' => [
        'controller' => 'AdminController',
        'action' => 'productEdit',
        'name' => 'admin.products.edit',
        'layout' => 'admin',
    ],
    '/admin/produse/sterge/{id}' => [
        'controller' => 'AdminController',
        'action' => 'productDelete',
        'name' => 'admin.products.delete',
    ],
    '/admin/produse/duplica/{id}' => [
        'controller' => 'AdminController',
        'action' => 'productDuplicate',
        'name' => 'admin.products.duplicate',
    ],
    '/admin/categorii' => [
        'controller' => 'AdminController',
        'action' => 'categories',
        'name' => 'admin.categories',
        'layout' => 'admin',
        'title' => 'Admin - Categorii',
    ],
    '/admin/categorii/adauga' => [
        'controller' => 'AdminController',
        'action' => 'categoryAdd',
        'name' => 'admin.categories.add',
        'layout' => 'admin',
        'title' => 'Admin - Adauga categorie',
    ],
    '/admin/categorii/editeaza/{id}' => [
        'controller' => 'AdminController',
        'action' => 'categoryEdit',
        'name' => 'admin.categories.edit',
        'layout' => 'admin',
    ],
    '/admin/categorii/sterge/{id}' => [
        'controller' => 'AdminController',
        'action' => 'categoryDelete',
        'name' => 'admin.categories.delete',
    ],
    '/admin/categorii/reordoneaza' => [
        'controller' => 'AdminController',
        'action' => 'categoryReorder',
        'name' => 'admin.categories.reorder',
    ],
    '/admin/subcategorii' => [
        'controller' => 'AdminController',
        'action' => 'subcategories',
        'name' => 'admin.subcategories',
        'layout' => 'admin',
        'title' => 'Admin - Subcategorii',
    ],
    '/admin/subcategorii/adauga' => [
        'controller' => 'AdminController',
        'action' => 'subcategoryAdd',
        'name' => 'admin.subcategories.add',
        'layout' => 'admin',
        'title' => 'Admin - Adauga subcategorie',
    ],
    '/admin/subcategorii/editeaza/{id}' => [
        'controller' => 'AdminController',
        'action' => 'subcategoryEdit',
        'name' => 'admin.subcategories.edit',
        'layout' => 'admin',
    ],
    '/admin/subcategorii/sterge/{id}' => [
        'controller' => 'AdminController',
        'action' => 'subcategoryDelete',
        'name' => 'admin.subcategories.delete',
    ],
    '/admin/subcategorii/reordoneaza' => [
        'controller' => 'AdminController',
        'action' => 'subcategoryReorder',
        'name' => 'admin.subcategories.reorder',
    ],
    '/admin/blog' => [
        'controller' => 'AdminController',
        'action' => 'blog',
        'name' => 'admin.blog',
        'layout' => 'admin',
        'title' => 'Admin - Blog',
    ],
    '/admin/blog/adauga' => [
        'controller' => 'AdminController',
        'action' => 'blogAdd',
        'name' => 'admin.blog.add',
        'layout' => 'admin',
        'title' => 'Admin - Adauga articol',
    ],
    '/admin/blog/editeaza/{id}' => [
        'controller' => 'AdminController',
        'action' => 'blogEdit',
        'name' => 'admin.blog.edit',
        'layout' => 'admin',
        'title' => 'Admin - Editeaza articol',
    ],
    '/admin/blog/sterge/{id}' => [
        'controller' => 'AdminController',
        'action' => 'blogDelete',
        'name' => 'admin.blog.delete',
    ],
    '/admin/blog/categorii' => [
        'controller' => 'AdminController',
        'action' => 'blogCategories',
        'name' => 'admin.blog.categories',
        'layout' => 'admin',
        'title' => 'Admin - Categorii Blog',
    ],
    '/admin/blog/categorii/adauga' => [
        'controller' => 'AdminController',
        'action' => 'blogCategoryAdd',
        'name' => 'admin.blog.category.add',
        'layout' => 'admin',
        'title' => 'Admin - Adauga categorie blog',
    ],
    '/admin/blog/categorii/editeaza/{id}' => [
        'controller' => 'AdminController',
        'action' => 'blogCategoryEdit',
        'name' => 'admin.blog.category.edit',
        'layout' => 'admin',
        'title' => 'Admin - Editeaza categorie blog',
    ],
    '/admin/blog/categorii/sterge/{id}' => [
        'controller' => 'AdminController',
        'action' => 'blogCategoryDelete',
        'name' => 'admin.blog.category.delete',
    ],
    '/admin/videouri' => [
        'controller' => 'AdminController',
        'action' => 'videos',
        'name' => 'admin.videos',
        'layout' => 'admin',
        'title' => 'Admin - Videouri',
    ],
    '/admin/videouri/adauga' => [
        'controller' => 'AdminController',
        'action' => 'videoAdd',
        'name' => 'admin.videos.add',
        'layout' => 'admin',
        'title' => 'Admin - Adauga video',
    ],
    '/admin/videouri/editeaza/{id}' => [
        'controller' => 'AdminController',
        'action' => 'videoEdit',
        'name' => 'admin.videos.edit',
        'layout' => 'admin',
        'title' => 'Admin - Editeaza video',
    ],
    '/admin/videouri/sterge/{id}' => [
        'controller' => 'AdminController',
        'action' => 'videoDelete',
        'name' => 'admin.videos.delete',
    ],
    '/admin/videouri/categorii' => [
        'controller' => 'AdminController',
        'action' => 'videoCategories',
        'name' => 'admin.videos.categories',
        'layout' => 'admin',
        'title' => 'Admin - Categorii Video',
    ],
    '/admin/videouri/categorii/adauga' => [
        'controller' => 'AdminController',
        'action' => 'videoCategoryAdd',
        'name' => 'admin.videos.category.add',
        'layout' => 'admin',
        'title' => 'Admin - Adauga categorie video',
    ],
    '/admin/videouri/categorii/editeaza/{id}' => [
        'controller' => 'AdminController',
        'action' => 'videoCategoryEdit',
        'name' => 'admin.videos.category.edit',
        'layout' => 'admin',
        'title' => 'Admin - Editeaza categorie video',
    ],
    '/admin/videouri/categorii/sterge/{id}' => [
        'controller' => 'AdminController',
        'action' => 'videoCategoryDelete',
        'name' => 'admin.videos.category.delete',
    ],
    // Admin Evenimente
    '/admin/evenimente' => [
        'controller' => 'AdminController',
        'action' => 'events',
        'name' => 'admin.events',
        'layout' => 'admin',
        'title' => 'Admin - Evenimente',
    ],
    '/admin/evenimente/adauga' => [
        'controller' => 'AdminController',
        'action' => 'eventAdd',
        'name' => 'admin.events.add',
        'layout' => 'admin',
        'title' => 'Admin - Adauga eveniment',
    ],
    '/admin/evenimente/editeaza/{id}' => [
        'controller' => 'AdminController',
        'action' => 'eventEdit',
        'name' => 'admin.events.edit',
        'layout' => 'admin',
        'title' => 'Admin - Editeaza eveniment',
    ],
    '/admin/evenimente/sterge/{id}' => [
        'controller' => 'AdminController',
        'action' => 'eventDelete',
        'name' => 'admin.events.delete',
    ],

    // Admin Cariere
    '/admin/cariere' => [
        'controller' => 'AdminController',
        'action' => 'jobs',
        'name' => 'admin.jobs',
        'layout' => 'admin',
        'title' => 'Admin - Cariere',
    ],
    '/admin/cariere/adauga' => [
        'controller' => 'AdminController',
        'action' => 'jobAdd',
        'name' => 'admin.jobs.add',
        'layout' => 'admin',
        'title' => 'Admin - Adauga job',
    ],
    '/admin/cariere/editeaza/{id}' => [
        'controller' => 'AdminController',
        'action' => 'jobEdit',
        'name' => 'admin.jobs.edit',
        'layout' => 'admin',
        'title' => 'Admin - Editeaza job',
    ],
    '/admin/cariere/sterge/{id}' => [
        'controller' => 'AdminController',
        'action' => 'jobDelete',
        'name' => 'admin.jobs.delete',
    ],

    '/admin/media' => [
        'controller' => 'AdminController',
        'action' => 'media',
        'name' => 'admin.media',
        'layout' => 'admin',
        'title' => 'Admin - Media',
    ],
    '/admin/media/upload' => [
        'controller' => 'AdminController',
        'action' => 'mediaUpload',
        'name' => 'admin.media.upload',
    ],
    '/admin/media/sterge/{id}' => [
        'controller' => 'AdminController',
        'action' => 'mediaDelete',
        'name' => 'admin.media.delete',
    ],
    '/admin/seo' => [
        'controller' => 'AdminController',
        'action' => 'seo',
        'name' => 'admin.seo',
        'layout' => 'admin',
        'title' => 'Admin - SEO',
    ],
    '/admin/homepage' => [
        'controller' => 'AdminController',
        'action' => 'homepage',
        'name' => 'admin.homepage',
        'layout' => 'admin',
        'title' => 'Admin - Homepage',
    ],
    '/admin/homepage/salveaza/{section}' => [
        'controller' => 'AdminController',
        'action' => 'homepageSave',
        'method' => 'POST',
        'name' => 'admin.homepage.save',
        'layout' => 'admin',
        'title' => 'Admin - Homepage Save',
    ],
    '/admin/mesaje' => [
        'controller' => 'AdminController',
        'action' => 'messages',
        'name' => 'admin.messages',
        'layout' => 'admin',
        'title' => 'Admin - Mesaje',
    ],
    '/admin/utilizatori' => [
        'controller' => 'AdminController',
        'action' => 'users',
        'name' => 'admin.users',
        'layout' => 'admin',
        'title' => 'Admin - Utilizatori',
    ],
    '/admin/setari' => [
        'controller' => 'AdminController',
        'action' => 'settings',
        'name' => 'admin.settings',
        'layout' => 'admin',
        'title' => 'Admin - Setari',
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
