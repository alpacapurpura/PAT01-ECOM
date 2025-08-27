<?php
$html_id = pxl_get_element_id($settings);
$editor_title = $widget->get_settings_for_display( 'title_categories' );
$editor_title = $widget->parse_text_editor( $editor_title );
$orderby = $widget->get_setting('orderby', 'date');
$order = $widget->get_setting('order', 'desc');
$limit = $widget->get_setting('limit', 6);

$prod_categories = get_terms( 'product_cat', array(
    'orderby' => $orderby,
    'order' => $order,
    'number' => $limit,
    'hide_empty' => 1,
    'parent' => 0
));

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

$show_category = $widget->get_setting('show_category','');
$show_count = $widget->get_setting('show_count','');


$arrows = $widget->get_setting('arrows',false);
$style_item = $widget->get_setting('style_item','');
$pagination = $widget->get_setting('pagination',false);
$pagination_type = $widget->get_setting('pagination_type','bullets');
$pause_on_hover = $widget->get_setting('pause_on_hover',false);
$autoplay = $widget->get_setting('autoplay',false);
$autoplay_speed = $widget->get_setting('autoplay_speed', 5000);
$infinite = $widget->get_setting('infinite',false);
$speed = $widget->get_setting('speed', 500);

$img_size = $widget->get_setting('img_size');

$opts = [
    'slide_direction'               => 'horizontal',
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
    'show_count'                    => (bool)$show_count,
    'show_category'                 => (bool)$show_category,
    'pagination'                    => (bool)$pagination,
    'pagination_type'               => $pagination_type,
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

<div id="<?php echo esc_attr($html_id) ?>" class="pxl-swiper-slider pxl-product-categories-carousel pxl-product-categories-carousel1 <?php echo esc_attr($style_item); ?>" data-arrow="<?php echo esc_attr($arrows); ?>">
    <h3 class="pxl-title-categories  <?php echo esc_attr($settings['pxl_animate_tt']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay_tt']); ?>ms">
        <?php echo wp_kses_post($editor_title); ?>
    </h3>
    <div class="pxl-carousel-inner">
        <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
            <div class="pxl-swiper-wrapper">
                <?php
                $image_size = !empty($img_size) ? $img_size : '180x180';
                
                foreach ($prod_categories as $prod_cat):
                    if(class_exists('Woocommerce')) {
                        $img_id = get_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
                        $term_link = get_term_link( $prod_cat, 'product_cat' );
                        ?>
                        <div class="pxl-swiper-slide <?php echo esc_attr($pxl_animate); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
                            <div class="pxl-item--inner">
                                <?php if(!empty($img_id)) {
                                    $img = pxl_get_image_by_size( array(
                                        'attach_id'  => $img_id,
                                        'thumb_size' => $image_size,
                                        'class' => 'no-lazyload',
                                    ) );
                                    $thumbnail = $img['thumbnail']; ?>
                                    <a href="<?php echo esc_attr($term_link); ?>" title="<?php echo esc_attr($prod_cat->name); ?>">
                                        <div class="item--image">
                                            <?php echo wp_kses_post($thumbnail); ?>
                                        </div>
                                    </a>
                                <?php } ?>
                                <div class="item--content">
                                    <?php if(!empty($show_category) && ($show_category == 'true')) : ?>
                                    <a href="<?php echo esc_attr($term_link); ?>" title="<?php echo esc_attr($prod_cat->name); ?>">
                                        <div class="item--title">
                                            <?php $chars = str_split($prod_cat->name);
                                            foreach ($chars as $value) {
                                                if ($value == " ") {
                                                    $value = "&nbsp;";
                                                }
                                                echo '<span>'.$value.'</span>';
                                            } ?>
                                        </div>
                                    </a>
                                <?php endif; ?>
                                <?php if(!empty($show_count) && ($show_count == 'true')) : ?>
                                <div class="item--count"><?php echo pxl_print_html($prod_cat->count. ' Products'); ?></div>
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