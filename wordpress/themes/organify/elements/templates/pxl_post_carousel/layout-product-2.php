<?php

$html_id = pxl_get_element_id($settings);
$editor_title = $widget->get_settings_for_display( 'title_product_carousel' );
$editor_title = $widget->parse_text_editor( $editor_title ); 
$orderby = $widget->get_setting('orderby', 'date');
$order = $widget->get_setting('order', 'desc');
$limit = $widget->get_setting('limit', 6);
$select_post_by = $widget->get_setting('select_post_by', '');

$source = $post_ids = [];
if($select_post_by === 'post_selected'){
    $post_ids = $widget->get_setting('source_'.$settings['post_type'].'_post_ids', '');
}else{
    $source  = $widget->get_setting('source_'.$settings['post_type'], '');
}

$settings['layout']    = $settings['layout_'.$settings['post_type']];
extract(pxl_get_posts_of_grid(
    'product', 
    ['source' => $source, 'orderby' => $orderby, 'order' => $order, 'limit' => $limit, 'post_ids' => $post_ids],
    ['product_cat']
));

$pxl_animate = $widget->get_setting('pxl_animate', '');
$col_xs = $widget->get_setting('col_xs', '');
$col_sm = $widget->get_setting('col_sm', '');
$col_md = (int)$widget->get_setting('col_md', '');
if($col_md == 'custom') {
    $col_md = $widget->get_setting('col_md_custom', '');
}
$col_lg = (int)$widget->get_setting('col_lg', '');
if($col_lg == 'custom') {
    $col_lg = $widget->get_setting('col_lg_custom', '');
}
$col_xl = (int)$widget->get_setting('col_xl', '');
if($col_xl == 'custom') {
    $col_xl = $widget->get_setting('col_xl_custom', '');
}
$col_xxl = (int)$widget->get_setting('col_xxl', '');
if($col_xxl == 'custom') {
    $col_xxl = $widget->get_setting('col_xxl_custom', '');
}
$slides_to_scroll = $widget->get_setting('slides_to_scroll', '');

$arrows = $widget->get_setting('arrows', false);  
$pagination = $widget->get_setting('pagination', false);
$pagination_type = $widget->get_setting('pagination_type', 'bullets');
$pause_on_hover = $widget->get_setting('pause_on_hover', false);
$autoplay = $widget->get_setting('autoplay', false);
$autoplay_speed = $widget->get_setting('autoplay_speed', 5000);
$infinite = $widget->get_setting('infinite', false);
$speed = $widget->get_setting('speed', 500);

$img_size = $widget->get_setting('img_size');


$show_title = $widget->get_setting('show_title');
$show_price = $widget->get_setting('show_price');
$show_excerpt = $widget->get_setting('show_excerpt');
$show_button = $widget->get_setting('show_button');

$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => 1, 
    'slide_percolumnfill'           => 1, 
    'slide_mode'                    => 'slide', 
    'slides_to_show'                => $col_xl,
    'slides_to_show_xxl'            => $col_xxl,  
    'slides_to_show_lg'             => $col_lg, 
    'slides_to_show_md'             => $col_md, 
    'slides_to_show_sm'             => (int)$col_sm, 
    'slides_to_show_xs'             => (int)$col_xs, 
    'slides_to_scroll'              => (int)$slides_to_scroll,  
    'slides_gutter'                 => 30, 
    'arrow'                         => (bool)$arrows,
    'pagination'                    => (bool)$pagination,
    'pagination_type'               => $pagination_type,
    'autoplay'                      => (bool)$autoplay,
    'pause_on_hover'                => (bool)$pause_on_hover,
    'pause_on_interaction'          => true,
    'delay'                         => (int)$autoplay_speed,
    'loop'                          => (bool)$infinite,
    'speed'                         => (int)$speed,
    'show_title'                    => $show_title,
    'show_price'                    => $show_price,
    'show_button'                   => $show_button,
];

$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]); 
?>


<div id="<?php echo esc_attr($html_id) ?>" class="pxl-swiper-slider pxl-product-carousel pxl-product-carousel2" data-arrow="<?php echo esc_attr($arrows); ?>">
    <?php if ($settings['title_product_carousel']): ?>
        <h3 class="pxl-title--product-carousel">
            <?php  echo wp_kses_post($editor_title); ?>
        </h3>
    <?php endif ?>
    <div class="pxl-carousel-inner <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms" data-wow-duration="">
        <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
            <div class="pxl-swiper-wrapper">
                <?php
                foreach ($posts as $key => $post):
                    if(class_exists('Woocommerce')) {
                        $img_size = !empty($img_size) ? $img_size : '276x206';
                        $product = wc_get_product( $post->ID );
                        $categories = $product->get_category_ids();
                        ?>
                        <div class="pxl-swiper-slide">
                            <div class="pxl-item--inner">
                                <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)): 
                                $img_id = get_post_thumbnail_id($post->ID);
                                $img = organify_get_image_by_size( array(
                                    'attach_id'  => $img_id,
                                    'thumb_size' => $img_size,
                                    'class' => 'no-lazyload',
                                ));
                                $thumbnail = $img['thumbnail'];
                                ?>

                                <div class="pxl-product-header">
                                    <a class="pxl-product-details" href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                        <?php echo wp_kses_post($thumbnail); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="pxl-product-inner">
                                <?php if (!empty($categories)) : 
                                    $first_category_id = $categories[0];
                                    $first_category = get_term($first_category_id, 'product_cat');
                                    $link_url_category = esc_url( get_term_link( $first_category ));
                                    ?>
                                    <div class="product-category">
                                        <a href="<?php pxl_print_html($link_url_category); ?>"> <?php echo esc_html($first_category->name); ?></a> 
                                    </div>
                                <?php endif; ?>
                            </div>

                            
                            <?php if($show_title == 'true'): ?>
                                <h4 class="pxl-product-title">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo pxl_print_html(get_the_title($post->ID)); ?></a>
                                </h4>
                            <?php endif; ?>
                            <div class="pxl-product-content">
                                <?php if($show_price == 'true'): ?>
                                    <div class="pxl-product--price"><?php echo wp_kses_post($product->get_price_html()); ?></div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php endforeach;  ?>
        </div>
    </div>
</div> 
<?php if($arrows !== false): ?>
    <div class="pxl-swiper-arrow-wrap style-2">
        <div class="pxl-swiper-arrow pxl-swiper-arrow-prev"><i class="caseicon-angle-arrow-left rtl-icon"></i></div>
        <div class="pxl-swiper-arrow pxl-swiper-arrow-next"><i class="caseicon-angle-arrow-right rtl-icon"></i></div>
    </div>
<?php endif; ?>
</div>