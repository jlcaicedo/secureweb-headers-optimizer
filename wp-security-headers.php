<?php
/**
 *  Plugin Name: WP Security Headers
 *  Plugin URI: http://josecaicedo.co
 *  Description: Mejora la seguridad de tu sitio de WordPress estableciendo encabezados HTTP de seguridad recomendados.
 *  Author: Jose Caicedo
 *  Version: 1.0
 *  Author URI: http://josecaicedo.co
 *  Text Domain: cf7-ciuu-list
 *  License: GPL v2 or later
 *  License URI: https://www.gnu.org/licenses/gpl-2.0.html
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
