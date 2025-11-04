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
 * SOLUCIÓN DEFINITIVA: Cargar textdomain del tema padre Organify
 * 
 * El tema padre Organify no está cargando correctamente su textdomain 'organify',
 * causando el error "_load_textdomain_just_in_time". Aunque hay un comentario en
 * theme-actions.php línea 12 que dice "load_theme_textdomain moved to init hook",
 * nunca se implementó correctamente.
 * 
 * Esta función soluciona el problema cargando el textdomain del tema padre
 * en el momento correcto (hook 'after_setup_theme') con prioridad alta (1)
 * para asegurar que se cargue antes que otros plugins y evitar los warnings.
 * 
 * @since 1.0.0
 */
add_action('after_setup_theme', 'organify_child_load_parent_textdomain', 1);
function organify_child_load_parent_textdomain() {
    // Verificar que el textdomain del tema padre no esté ya cargado
    if (!is_textdomain_loaded('organify')) {
        // Cargar el textdomain del tema padre desde su directorio de idiomas
        load_theme_textdomain('organify', get_template_directory() . '/languages');
        
        // Log para debugging (solo si WP_DEBUG está activo)
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('Organify Child: Textdomain del tema padre "organify" cargado correctamente en hook init');
        }
    }
}

// Configurar textdomain del tema hijo (WordPress 6.7.0+)
add_action('after_setup_theme', 'organify_child_setup');
function organify_child_setup() {
    load_child_theme_textdomain('organify-child', get_stylesheet_directory() . '/languages');
}

// Cargar configuración personalizada de logs centralizados
require_once get_stylesheet_directory() . '/wp-config-custom.php';

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
