<?php
$html_id = pxl_get_element_id($settings);
$editor_title = $widget->get_settings_for_display( 'title_product_carousel' );
$editor_title = $widget->parse_text_editor( $editor_title ); 

$query_type = $widget->get_setting('query_type', 'recent_product');
$post_per_page = $widget->get_setting('post_per_page', 8);

$product_ids = $widget->get_setting('product_ids', '');
$categories = $widget->get_setting('taxonomies', '');
$param_args=[];


$source = $widget->get_setting('source', '');
$limit = $widget->get_setting('limit', 4);
$post_ids = $widget->get_setting('post_ids', '');

extract(pxl_get_posts_of_grid('product', [
    'source' => $source,
    'limit' => $limit,
    'post_ids' => $post_ids,
]));

$loop = organify_woocommerce_query($query_type,$limit,$product_ids,$source,$param_args);
extract($loop);


$pxl_animate = $widget->get_setting('pxl_animate', '');
$col_xs = $widget->get_setting('col_xs', '');
$col_sm = $widget->get_setting('col_sm', '');
$col_md = $widget->get_setting('col_md', '');
$col_lg = $widget->get_setting('col_lg', '');
$col_xl = $widget->get_setting('col_xl', '');
$col_xxl = $widget->get_setting('col_xxl', '');
if($col_xxl == 'inherit') {
    $col_xxl = $col_xl;
}
$slides_to_scroll = $widget->get_setting('slides_to_scroll', '');


$arrows = $widget->get_setting('arrows','false');
$pause_on_hover = $widget->get_setting('pause_on_hover');
$autoplay = $widget->get_setting('autoplay');
$autoplay_speed = $widget->get_setting('autoplay_speed', '5000');
$infinite = $widget->get_setting('infinite');
$speed = $widget->get_setting('speed', '500');

$img_size = $widget->get_setting('img_size');

$opts = [
    'slide_direction'               => 'vertical',
    'slide_percolumn'               => 1, 
    'slide_mode'                    => 'slide', 
    'slides_to_show'                => (int)$col_xl,
    'slides_to_show_xxl'            => (int)$col_xxl, 
    'slides_to_show_lg'             => (int)$col_lg, 
    'slides_to_show_md'             => (int)$col_md, 
    'slides_to_show_sm'             => (int)$col_sm, 
    'slides_to_show_xs'             => (int)$col_xs, 
    'slides_to_scroll'              => (int)$slides_to_scroll,
    'arrow'                         => (bool)$arrows,
    'autoplay'                      => (bool)$autoplay,
    'pause_on_hover'                => (bool)$pause_on_hover,
    'pause_on_interaction'          => true,
    'delay'                         => (int)$autoplay_speed,
    'loop'                          => (bool)$infinite,
    'speed'                         => (int)$speed
];
$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]); ?>

<?php if ($posts->found_posts > 0): ?>
    <div id="<?php echo esc_attr($html_id) ?>" class="pxl-swiper-slider pxl-product-carousel pxl-product-carousel1 woocommerce" data-arrow="<?php echo esc_attr($arrows); ?>">
        <div class="pxl-carousel-inner  <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
            <?php if (!empty ($settings['title_product_carousel'])) : ?>
                <h3 class="pxl-title--carousel">
                    <?php echo wp_kses_post($editor_title); ?>
                </h3>
            <?php endif; ?>
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper ">
                    <?php
                    $d = 0;
                    while ($posts->have_posts()) {
                        $posts->the_post();
                        global $product;
                        $d++;
                        $term_list = array();
                        $term_of_post = wp_get_post_terms($product->get_ID(), 'product_cat');
                        $categories = $product->get_category_ids();
                        ?>
                        <div class="pxl-swiper-slide">
                            <div class="pxl-item--inner">

                                <?php
                                $image_size = !empty($img_size) ? $img_size : '151x140';
                                $img_id     = get_post_thumbnail_id( $product->get_ID() );
                                if (has_post_thumbnail($product->get_ID()) && wp_get_attachment_image_src(get_post_thumbnail_id($product->get_ID()), false)):
                                    $img = pxl_get_image_by_size( array(
                                        'attach_id'  => $img_id,
                                        'thumb_size' => $image_size
                                    ) );
                                $thumbnail = $img['thumbnail'];
                                ?>

                                <div class="pxl-product-header">
                                    <a class="pxl-product-details" href="<?php echo esc_url(get_permalink( $product->get_ID() )); ?>">
                                        <?php echo wp_kses_post($thumbnail); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="woocommerce-product-content">

                                <?php if (!empty($categories) && $settings['show_category'] === 'true') : 
                                    $first_category_id = $categories[0];
                                    $first_category = get_term($first_category_id, 'product_cat');
                                    $link_url_category = esc_url(get_term_link($first_category));
                                    ?>
                                    <div class="product-category">
                                        <a href="<?php pxl_print_html($link_url_category); ?>"> <?php echo esc_html($first_category->name); ?></a> 
                                    </div>
                                <?php endif; ?>

                                <h5 class="woocommerce-product--title">
                                    <a href="<?php echo esc_url(get_permalink($product->get_ID())); ?>"><?php echo pxl_print_html(get_the_title($product->get_id())); ?></a>
                                </h5>

                                <div class="woocommerce-product--price">
                                    <span class="price"><?php echo wp_kses_post($product->get_price_html()); ?></span>
                                </div>

                                <?php if ($settings['show_rating'] === 'true'): ?>
                                    <div class="woocommerce-product-rating">
                                        <?php woocommerce_template_loop_rating(); ?>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                <?php }  ?>

            </div>
        </div>
        <?php if($arrows !== false): ?>
            <div class="pxl-swiper-arrow-wrap style-2 ps-2">
                <div class="pxl-swiper-arrow pxl-swiper-arrow-prev"><i class="caseicon-angle-arrow-left rtl-icon"></i></div>
                <div class="pxl-swiper-arrow pxl-swiper-arrow-next"><i class="caseicon-angle-arrow-right rtl-icon"></i></div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>