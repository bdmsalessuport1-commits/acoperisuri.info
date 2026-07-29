<?php

/**
 * Configurare generala aplicatie
 */

use App\Helpers\Env;

return [
    'name' => 'BDM Systems - acoperisuri.info',
    'url' => Env::get('APP_URL', 'http://localhost'),
    'env' => Env::get('APP_ENV', 'development'),
    'debug' => Env::get('APP_DEBUG', 'true') === 'true',
    'timezone' => 'Europe/Bucharest',
    'charset' => 'UTF-8',
];
