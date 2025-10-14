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

// Configurar textdomain (WordPress 6.7.0+)
add_action('after_setup_theme', 'organify_child_setup');
function organify_child_setup() {
    load_child_theme_textdomain('organify-child', get_stylesheet_directory() . '/languages');
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

/**
 * Agregar soporte para biblioteca de medios en el admin
 * 
 * @since 1.0.0
 */
add_action('admin_enqueue_scripts', 'organify_child_admin_scripts');
function organify_child_admin_scripts() {
    // Cargar scripts de medios de WordPress
    wp_enqueue_media();
    
    // Asegurar que los scripts del admin se carguen correctamente
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');
}

/**
 * Agregar soporte adicional para subida de archivos
 * 
 * @since 1.0.0
 */
add_action('after_setup_theme', 'organify_child_media_support');
function organify_child_media_support() {
    // Agregar soporte para imágenes destacadas
    add_theme_support('post-thumbnails');
    
    // Agregar soporte para formatos de imagen adicionales
    add_theme_support('html5', array('gallery', 'caption'));
}
