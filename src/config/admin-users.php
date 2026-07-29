<?php

/**
 * Utilizatori admin — va migra in baza de date (Etapa 18)
 *
 * Roluri disponibile:
 *   administrator — acces complet la toate sectiunile
 *   editor        — produse, blog, media, videouri
 *   operator      — doar vizualizare + lead-uri
 *
 * Parola default admin: BDMadmin2024!
 * IMPORTANT: Schimbati parola dupa primul login!
 */

return [
    [
        'id'       => 1,
        'name'     => 'Admin BDM',
        'email'    => 'admin@acoperisuri.info',
        'password' => '$2y$10$B42Krb9WMQ11oD9Pl/U5geWWnPWRCU.d00zC9zBIVNzf9iAXhkm/G',
        'role'     => 'administrator',
        'active'   => true,
    ],
    [
        'id'       => 2,
        'name'     => 'Editor BDM',
        'email'    => 'editor@acoperisuri.info',
        'password' => '$2y$10$B42Krb9WMQ11oD9Pl/U5geWWnPWRCU.d00zC9zBIVNzf9iAXhkm/G',
        'role'     => 'editor',
        'active'   => true,
    ],
    [
        'id'       => 3,
        'name'     => 'Operator BDM',
        'email'    => 'operator@acoperisuri.info',
        'password' => '$2y$10$B42Krb9WMQ11oD9Pl/U5geWWnPWRCU.d00zC9zBIVNzf9iAXhkm/G',
        'role'     => 'operator',
        'active'   => true,
    ],
];
