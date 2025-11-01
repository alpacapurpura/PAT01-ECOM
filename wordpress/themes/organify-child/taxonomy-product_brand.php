<?php
/**
 * Template para archivo de marcas de productos (Product Brand Archive) - Dark Theme
 * 
 * Este template se usa para mostrar todos los productos de una marca específica
 * cuando el usuario hace clic en una marca.
 * 
 * MODIFICACIONES:
 * - Removido sidebar completamente para layout full-width
 * - Agregadas clases CSS específicas para dark theme
 * 
 * @package Organify Child
 * @since 1.0.0
 */

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

get_header();

// Obtener información de la marca actual
$current_term = get_queried_object();
$brand_name = $current_term->name;
$brand_description = $current_term->description;
$brand_slug = $current_term->slug;
?>

<!-- Contenedor principal con tema dark y sin sidebar -->
<div class="tax-product_brand" style="in-height: 100vh;">
    <div class="container">
        <div class="row">
            <!-- Contenido principal ocupando todo el ancho (sin sidebar) -->
            <div id="pxl-content-area" class="col-12">
                <main id="pxl-content-main" class="brand-archive-main">
                    
                    <!-- Header personalizado de la marca con estilo dark -->
                    <div class="pxl-brand-header brand-archive-header brand-<?php echo esc_attr($brand_slug); ?>">
                        <div class="brand-header-content">
                            <h1 class="brand-title"><?php echo esc_html($brand_name); ?></h1>
                            <?php if ($brand_description) : ?>
                                <div class="brand-description"><?php echo wp_kses_post($brand_description); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Contenido de WooCommerce con clases dark -->
                    <div class="brand-products-wrapper">
                        <?php
                        // Hook antes del contenido de la marca
                        do_action('organify_child_before_brand_content', $current_term);
                        
                        // Mostrar contenido de WooCommerce
                        woocommerce_content();
                        
                        // Hook después del contenido de la marca
                        do_action('organify_child_after_brand_content', $current_term);
                        ?>
                    </div>

                </main>
            </div>
            <!-- Sidebar removido completamente para layout full-width -->
        </div>
    </div>
</div>

<?php
// Hook antes del footer
do_action('organify_child_brand_before_footer', $current_term);

get_footer();