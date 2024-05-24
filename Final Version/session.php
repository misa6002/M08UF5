<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start([
        'cookie_secure' => true, // solo se enviarán cookies sobre HTTPS
        'cookie_httponly' => true, // solo accesibles a través del protocolo HTTP
        'use_strict_mode' => true, // fuerza el uso de identificadores de sesión seguros
        'use_only_cookies' => true, // solo cookies para el almacenamiento de sesiones
    ]);
}
?>
