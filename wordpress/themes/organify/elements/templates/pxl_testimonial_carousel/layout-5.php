<?php
$col_xs = $widget->get_setting('col_xs', '');
$col_sm = $widget->get_setting('col_sm', '');
$col_md = $widget->get_setting('col_md', '');
$col_lg = $widget->get_setting('col_lg', '');
$col_xl = $widget->get_setting('col_xl', '');
$col_xxl = $widget->get_setting('col_xxl', '');
if($col_xxl == 'inherit') {
    $col_xxl = $col_xl;
}
$slides_to_scroll = $widget->get_setting('slides_to_scroll');
$arrows = $widget->get_setting('arrows', false);  
$pagination = $widget->get_setting('pagination', false);
$pagination_type = $widget->get_setting('pagination_type', 'bullets');
$pause_on_hover = $widget->get_setting('pause_on_hover', false);
$autoplay = $widget->get_setting('autoplay', false);
$autoplay_speed = $widget->get_setting('autoplay_speed', 5000);
$infinite = $widget->get_setting('infinite', false);  
$speed = $widget->get_setting('speed', 500);
$drap = $widget->get_setting('drap', false);
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
    'pagination'                    => (bool)$pagination,
    'pagination_type'               => $pagination_type,
    'autoplay'                      => (bool)$autoplay,
    'pause_on_hover'                => (bool)$pause_on_hover,
    'pause_on_interaction'          => true,
    'delay'                         => (int)$autoplay_speed,
    'loop'                          => (bool)$infinite,
    'speed'                         => (int)$speed
];
$opts_thumb = [
    'slide_direction'               => 'vertical',
    'slides_to_show'                => 'auto', 
    'slide_mode'                    => 'slide',
    'loop'                          => false,
];
$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
$widget->add_render_attribute( 'thumb', [
    'class'         => 'pxl-swiper-thumbs',
    'data-settings' => wp_json_encode($opts_thumb)
]);
if(isset($settings['testimonial']) && !empty($settings['testimonial']) && count($settings['testimonial'])): ?>
    <div class="pxl-swiper-slider pxl-testimonial-carousel pxl-testimonial-carousel5" <?php if($drap !== false) : ?>data-cursor-drap="<?php echo esc_attr('DRAG', 'organify'); ?>"<?php endif; ?>>
        <div class="pxl-carousel-inner">

            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php foreach ($settings['testimonial'] as $key => $value):
                        $title = isset($value['title']) ? $value['title'] : '';
                        $position = isset($value['position']) ? $value['position'] : '';
                        $desc = isset($value['desc']) ? $value['desc'] : '';
                        $star = isset($value['star']) ? $value['star'] : '';
                        $image = isset($value['image']) ? $value['image'] : '';
                        $image_size = !empty($settings['img_size']) ? $settings['img_size'] : '314x314';
                        ?>
                        <div class="pxl-swiper-slide">
                            <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
                                <div class="pxl--introduction">
                                    <?php if(!empty($image['id'])) { 
                                        $img  = pxl_get_image_by_size( array(
                                            'attach_id'  => $image['id'],
                                            'thumb_size' => $image_size,
                                            'class' => 'no-lazyload'
                                        ) );
                                        $thumbnail    = $img['thumbnail'];
                                        ?>
                                        <div class="pxl-item--author">
                                            <?php echo wp_kses_post($thumbnail); ?>
                                        </div>
                                    <?php } ?>
                                    <div class="pxl-item--holder">
                                        <h6 class="pxl-item--title"><?php echo pxl_print_html($title); ?></h6>
                                        <div class="pxl-item--position">
                                            <?php echo pxl_print_html($position); ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="pxl--content">
                                       <div class="pxl-item--desc">
                                        <p><?php echo pxl_print_html($desc); ?></p>
                                    </div>
                                    <div class="pxl-item--star pxl-item--<?php echo esc_attr($star); ?>-star">
                                        <?php for ($i = 0; $i < $star; $i++) : ?>
                                            <i class="fas fa-star"></i>
                                        <?php endfor; ?>
                                    </div>
                            </div>

                            

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php if($pagination !== false): ?>
        <div class="pxl-swiper-dots style-1"></div>
    <?php endif; ?>
</div>
<?php endif; ?>
