<?php
/**
 * Funciones del tema hijo Organify
 * 
 * @package Organify Child
 * @since 1.0.0
 */

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Cargar estilos del tema padre
add_action('wp_enqueue_scripts', 'organify_child_enqueue_styles');
function organify_child_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

/**
 * Función de respaldo para pxl_register_shortcode si Case Addons no está activado
 * 
 * Esta función evita errores fatales cuando el plugin Case Addons no está disponible
 * y el tema padre intenta usar pxl_register_shortcode()
 * 
 * @param string $tag Nombre del shortcode
 * @param callable $callback Función callback del shortcode
 * @since 1.0.0
 */
if (!function_exists('pxl_register_shortcode')) {
    function pxl_register_shortcode($tag, $callback) {
        add_shortcode($tag, $callback);
    }
}