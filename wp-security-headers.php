<?php
/**
 * Plugin Name: WP Security Headers
 * Description: Mejora la seguridad de tu sitio de WordPress estableciendo encabezados HTTP de seguridad recomendados.
 * Version: 1.0
 * Author: Tu Nombre
 */

// Salir si se accede directamente
if (!defined('ABSPATH')) exit;

function wpsh_security_headers() {
    // Remover el encabezado de la versión de WordPress
    remove_action('wp_head', 'wp_generator');

    // Encabezados de seguridad recomendados
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Content-Security-Policy: default-src \'self\';');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: no-referrer-when-downgrade');
    header('Permissions-Policy: geolocation=(self), microphone=()');
    // Agrega más encabezados según sea necesario
}

add_action('send_headers', 'wpsh_security_headers');
