<?php
/**
 * Template principal de WooCommerce para tema hijo Organify
 * 
 * Este archivo intercepta todas las páginas de WooCommerce y detecta
 * si estamos en una página de taxonomía de marcas (product_brand).
 * Si es así, carga nuestro template personalizado taxonomy-product_brand.php
 * 
 * @package Organify Child
 * @since 1.0.0
 */

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Detectar si estamos en una página de taxonomía de marcas de productos
 * y cargar el template personalizado correspondiente
 */
if (is_product_taxonomy() && is_tax('product_brand')) {
    // Cargar nuestro template personalizado para marcas desde el tema hijo
    $brand_template = get_stylesheet_directory() . '/taxonomy-product_brand.php';
    if (file_exists($brand_template)) {
        include($brand_template);
        return;
    }
}

// Para todas las demás páginas de WooCommerce, usar la lógica original del tema padre
get_header();

if(is_singular('product')){
    $organify_sidebar = organify()->get_sidebar_args(['type' => 'product', 'content_col'=> '12']);
}else{
    $organify_sidebar = organify()->get_sidebar_args(['type' => 'shop', 'content_col'=> '9']);
} ?>
<div class="container">
    <div class="row <?php echo esc_attr($organify_sidebar['wrap_class']) ?>">
        <div id="pxl-content-area" class="<?php echo esc_attr($organify_sidebar['content_class']) ?>">
            <main id="pxl-content-main">
                <?php woocommerce_content(); ?>
            </main>
        </div>

        <?php if ($organify_sidebar['sidebar_class'] && !is_singular('product')) : ?>
            <aside id="pxl-sidebar-area" class="<?php echo esc_attr($organify_sidebar['sidebar_class']) ?>">
                <div class="pxl-sidebar-sticky">
                    <?php get_sidebar(); ?>
                </div>
            </aside>
        <?php endif; ?>
    </div>
</div>
<?php get_footer();