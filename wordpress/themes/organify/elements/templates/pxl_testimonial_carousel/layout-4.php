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
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => 1, 
    'slide_mode'                    => 'fade', 
    'slides_to_show'                => 1,
    'slides_to_show_xxl'            => 1, 
    'slides_to_show_lg'             => 1, 
    'slides_to_show_md'             => 1, 
    'slides_to_show_sm'             => 1, 
    'slides_to_show_xs'             => 1, 
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
    'slide_direction'               => 'horizontal',
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
    <div class="pxl-swiper-slider pxl-testimonial-carousel pxl-testimonial-carousel4" <?php if($drap !== false) : ?>data-cursor-drap="<?php echo esc_attr('DRAG', 'organify'); ?>"<?php endif; ?>>
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
                                    <div class="pxl-item--icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60" fill="none">
                                            <path d="M1.5 47.132V25.9346C1.5 20.7639 3.65649 13.7063 13.9488 9.44236C15.8409 8.70654 17.9712 9.64385 18.7071 11.5359C19.4195 13.3678 18.5648 15.4359 16.767 16.2304C9.68487 19.1711 8.85168 23.1655 8.85168 25.9346V26.3022H22.3298C24.3599 26.3022 26.0056 27.9479 26.0056 29.978V47.132C26.0056 49.1621 24.3599 50.8078 22.3298 50.8078H5.17584C3.14573 50.8078 1.5 49.1621 1.5 47.132ZM33.9944 47.132V25.9346C33.9944 20.7639 36.1509 13.7063 46.4432 9.44236C48.3353 8.70652 50.4656 9.6438 51.2015 11.5359C51.9139 13.3677 51.0592 15.4359 49.2614 16.2304C42.1793 19.1711 41.3461 23.1655 41.3461 25.9346V26.3022H54.8242C56.8543 26.3022 58.5 27.9479 58.5 29.978V47.132C58.5 49.1621 56.8543 50.8078 54.8242 50.8078H37.6702C35.6401 50.8078 33.9944 49.1621 33.9944 47.132Z" fill="white"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="pxl--content">
                                    <div class="pxl-item--star pxl-item--<?php echo esc_attr($star); ?>-star">
                                        <?php for ($i = 0; $i < $star; $i++) : ?>
                                            <i class="fas fa-star"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <div class="pxl-item--desc">
                                        <p><?php echo pxl_print_html($desc); ?></p>
                                    </div>
                                    
                                    <div class="pxl-item--holder">
                                        <h6 class="pxl-item--title"><?php echo pxl_print_html($title); ?></h6>
                                        <div class="pxl-item--position">
                                            <?php echo pxl_print_html($position); ?>
                                        </div>
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
