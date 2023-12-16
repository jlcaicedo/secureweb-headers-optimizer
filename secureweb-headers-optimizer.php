<?php
/*
Plugin Name: SecureWeb Headers Optimizer
Plugin URI: http://josecaicedo.co/plugins/secureweb-headers-optimizer
Description: Improve the security of your WordPress site by setting recommended security HTTP headers and enable iframe and flash rendering in Webkit for post previews.
Version: 1.2.2
Author: Jose Luis Caicedo
Author URI: https://josecaicedo.co
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: secureweb-headers-optimizer
*/

if (!defined('ABSPATH')) exit;

function wpsh_security_headers() {
    remove_action('wp_head', 'wp_generator');

    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Content-Security-Policy: default-src \'self\';');
    header('Referrer-Policy: no-referrer-when-downgrade');
    header('Permissions-Policy: geolocation=(self), microphone=()');

    global $wp_query;
    if (
        ! empty($wp_query->query_vars['preview']) && wp_get_referer() && strpos(wp_get_referer(),
            sprintf(admin_url('post.php?post=%d&action=edit'), $wp_query->query_vars['p'])) !== false
    ) {
        header('X-XSS-Protection: 0');
    } else {
        header('X-XSS-Protection: 1; mode=block');
    }
}

add_action('send_headers', 'wpsh_security_headers');
