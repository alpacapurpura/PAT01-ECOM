<?php
/**
 * Configuración personalizada de logs centralizados para WordPress
 * Proyecto: PAT01-ECOM - E-commerce WordPress con tema Organify
 * 
 * Este archivo centraliza todas las configuraciones de logging del proyecto
 * siguiendo las mejores prácticas de WordPress y Docker.
 * 
 * @package Organify Child
 * @since 1.0.0
 */

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// ===========================================
// CONFIGURACIÓN DE LOGS CENTRALIZADOS
// ===========================================

// Directorio base para todos los logs
define('WP_LOGS_BASE_DIR', WP_CONTENT_DIR . '/logs');

// Configuración de debug de WordPress
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', WP_LOGS_BASE_DIR . '/wordpress/debug.log');
define('WP_DEBUG_DISPLAY', false);
define('SCRIPT_DEBUG', true);

// Configuración de logs de errores PHP
ini_set('log_errors', 1);
ini_set('error_log', WP_LOGS_BASE_DIR . '/wordpress/php-errors.log');

// Configuración de logs de WooCommerce
define('WC_LOG_DIR', WP_LOGS_BASE_DIR . '/plugins/woocommerce/');
define('WC_LOG_DIR_CUSTOM', true);

// Configuración de logs de consultas SQL
define('SAVEQUERIES', true);

// ===========================================
// FUNCIONES AUXILIARES PARA LOGGING
// ===========================================

/**
 * Crear directorios de logs si no existen
 */
function wp_create_log_directories() {
    $log_dirs = [
        WP_LOGS_BASE_DIR . '/wordpress',
        WP_LOGS_BASE_DIR . '/mysql',
        WP_LOGS_BASE_DIR . '/cron',
        WP_LOGS_BASE_DIR . '/backup',
        WP_LOGS_BASE_DIR . '/maintenance',
        WP_LOGS_BASE_DIR . '/plugins',
        WP_LOGS_BASE_DIR . '/plugins/woocommerce',
        WP_LOGS_BASE_DIR . '/plugins/yaymail',
        WP_LOGS_BASE_DIR . '/docker'
    ];
    
    foreach ($log_dirs as $dir) {
        if (!file_exists($dir)) {
            wp_mkdir_p($dir);
            
            // Crear archivos de seguridad
            file_put_contents($dir . '/.htaccess', 'deny from all');
            file_put_contents($dir . '/index.php', '<?php // Silence is golden');
        }
    }
}

/**
 * Función personalizada de logging con rotación automática
 */
function wp_custom_log($message, $log_file = 'custom.log', $category = 'wordpress') {
    $log_path = WP_LOGS_BASE_DIR . '/' . $category . '/' . $log_file;
    
    // Crear directorio si no existe
    $log_dir = dirname($log_path);
    if (!file_exists($log_dir)) {
        wp_mkdir_p($log_dir);
    }
    
    // Formatear mensaje con timestamp
    $timestamp = date('[Y-m-d H:i:s T]');
    $formatted_message = $timestamp . ' ' . $message . PHP_EOL;
    
    // Escribir al log
    error_log($formatted_message, 3, $log_path);
    
    // Rotación automática si el archivo es muy grande (>10MB)
    if (file_exists($log_path) && filesize($log_path) > 10485760) {
        $rotated_name = $log_path . '.' . date('Y-m-d_H-i-s');
        rename($log_path, $rotated_name);
    }
}

/**
 * Hook para crear directorios al inicializar WordPress
 */
add_action('init', 'wp_create_log_directories');

// ===========================================
// CONFIGURACIÓN DE LOGS POR PLUGIN
// ===========================================

/**
 * Configurar logs de YayMail
 */
add_filter('yaymail_log_directory', function($default_dir) {
    return WP_LOGS_BASE_DIR . '/plugins/yaymail/';
});

/**
 * Configurar logs de Elementor
 */
add_filter('elementor/logger/log_directory', function($default_dir) {
    return WP_LOGS_BASE_DIR . '/plugins/elementor/';
});

/**
 * Configurar logs de MailChimp
 */
add_filter('mailchimp_for_wp_log_directory', function($default_dir) {
    return WP_LOGS_BASE_DIR . '/plugins/mailchimp/';
});

// ===========================================
// CONFIGURACIÓN DE ROTACIÓN DE LOGS
// ===========================================

/**
 * Configurar rotación automática de logs
 */
function wp_setup_log_rotation() {
    // Configurar rotación diaria para logs críticos
    if (!wp_next_scheduled('wp_daily_log_rotation')) {
        wp_schedule_event(time(), 'daily', 'wp_daily_log_rotation');
    }
}
add_action('wp', 'wp_setup_log_rotation');

/**
 * Función de rotación diaria de logs
 */
function wp_daily_log_rotation_handler() {
    $log_files = [
        WP_LOGS_BASE_DIR . '/wordpress/debug.log',
        WP_LOGS_BASE_DIR . '/wordpress/php-errors.log',
        WP_LOGS_BASE_DIR . '/mysql/mysql-errors.log',
        WP_LOGS_BASE_DIR . '/cron/cron.log'
    ];
    
    foreach ($log_files as $log_file) {
        if (file_exists($log_file) && filesize($log_file) > 52428800) { // 50MB
            $rotated_name = $log_file . '.' . date('Y-m-d');
            if (!file_exists($rotated_name)) {
                rename($log_file, $rotated_name);
                touch($log_file);
            }
        }
    }
    
    // Limpiar logs antiguos (más de 30 días)
    wp_cleanup_old_logs();
}
add_action('wp_daily_log_rotation', 'wp_daily_log_rotation_handler');

/**
 * Limpiar logs antiguos
 */
function wp_cleanup_old_logs() {
    $log_directories = [
        WP_LOGS_BASE_DIR . '/wordpress',
        WP_LOGS_BASE_DIR . '/mysql',
        WP_LOGS_BASE_DIR . '/cron',
        WP_LOGS_BASE_DIR . '/backup',
        WP_LOGS_BASE_DIR . '/maintenance',
        WP_LOGS_BASE_DIR . '/plugins',
        WP_LOGS_BASE_DIR . '/docker'
    ];
    
    foreach ($log_directories as $dir) {
        if (is_dir($dir)) {
            $files = glob($dir . '/*.log.*');
            foreach ($files as $file) {
                if (filemtime($file) < strtotime('-30 days')) {
                    unlink($file);
                }
            }
        }
    }
}

// ===========================================
// LOGGING PERSONALIZADO PARA DESARROLLO
// ===========================================

if (defined('WP_DEBUG') && WP_DEBUG) {
    /**
     * Log personalizado para queries lentas
     */
    add_action('shutdown', function() {
        global $wpdb;
        if (defined('SAVEQUERIES') && SAVEQUERIES && !empty($wpdb->queries)) {
            $slow_queries = [];
            foreach ($wpdb->queries as $query) {
                if ($query[1] > 0.1) { // Queries que toman más de 0.1 segundos
                    $slow_queries[] = $query;
                }
            }
            
            if (!empty($slow_queries)) {
                $message = "Slow queries detected:\n" . print_r($slow_queries, true);
                wp_custom_log($message, 'slow-queries.log', 'wordpress');
            }
        }
    });
    
    /**
     * Log de errores de memoria
     */
    add_action('wp_footer', function() {
        $memory_usage = memory_get_peak_usage(true);
        $memory_limit = wp_convert_hr_to_bytes(ini_get('memory_limit'));
        
        if ($memory_usage > ($memory_limit * 0.8)) { // Si usa más del 80% de memoria
            $message = sprintf(
                "High memory usage detected: %s / %s (%.2f%%)",
                size_format($memory_usage),
                size_format($memory_limit),
                ($memory_usage / $memory_limit) * 100
            );
            wp_custom_log($message, 'memory-usage.log', 'wordpress');
        }
    });
}

// ===========================================
// CONFIGURACIÓN DE LOGS PARA DOCKER
// ===========================================

/**
 * Configurar logs para contenedores Docker
 */
if (defined('DOCKER_ENV') && DOCKER_ENV) {
    // Redirigir logs de Apache a archivos específicos
    ini_set('error_log', WP_LOGS_BASE_DIR . '/docker/apache-errors.log');
    
    // Log de conexiones de base de datos
    add_action('wp_loaded', function() {
        global $wpdb;
        if ($wpdb->last_error) {
            wp_custom_log("Database error: " . $wpdb->last_error, 'database-errors.log', 'mysql');
        }
    });
}