<?php

/**
 * Configurare generala aplicatie
 */

return [
    'name' => 'BDM Systems - acoperisuri.info',
    'url' => getenv('APP_URL') ?: 'http://localhost:8000',
    'env' => getenv('APP_ENV') ?: 'development',
    'debug' => getenv('APP_DEBUG') ?: true,
    'timezone' => 'Europe/Bucharest',
    'charset' => 'UTF-8',
];
