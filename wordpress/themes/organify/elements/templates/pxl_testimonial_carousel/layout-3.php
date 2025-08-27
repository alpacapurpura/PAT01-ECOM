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
    <div class="pxl-swiper-slider pxl-testimonial-carousel pxl-testimonial-carousel3" <?php if($drap !== false) : ?>data-cursor-drap="<?php echo esc_attr('DRAG', 'organify'); ?>"<?php endif; ?>>
        <div class="pxl-carousel-inner">

            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php foreach ($settings['testimonial'] as $key => $value):
                        $title = isset($value['title']) ? $value['title'] : '';
                        $position = isset($value['position']) ? $value['position'] : '';
                        $desc = isset($value['desc']) ? $value['desc'] : '';
                        $star = isset($value['star']) ? $value['star'] : '';
                        $image = isset($value['image']) ? $value['image'] : '';
                        $image_size = !empty($settings['img_size']) ? $settings['img_size'] : 'full';
                        ?>
                        <div class="pxl-swiper-slide">
                            <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
                                <div class="pxl--content">
                                    <div class="pxl-item--icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60" fill="none">
                                            <g opacity="0.24">
                                                <path d="M1.5 47.1324V25.9351C1.5 20.7644 3.65649 13.7068 13.9488 9.44285C15.8409 8.70702 17.9712 9.64434 18.7071 11.5364C19.4195 13.3683 18.5648 15.4364 16.767 16.2309C9.68487 19.1716 8.85168 23.166 8.85168 25.9351V26.3027H22.3298C24.3599 26.3027 26.0056 27.9484 26.0056 29.9785V47.1324C26.0056 49.1626 24.3599 50.8083 22.3298 50.8083H5.17584C3.14573 50.8083 1.5 49.1626 1.5 47.1324ZM33.9944 47.1324V25.9351C33.9944 20.7644 36.1509 13.7068 46.4432 9.44285C48.3353 8.707 50.4656 9.64429 51.2015 11.5364C51.9139 13.3682 51.0592 15.4364 49.2614 16.2309C42.1793 19.1716 41.3461 23.166 41.3461 25.9351V26.3027H54.8242C56.8543 26.3027 58.5 27.9484 58.5 29.9785V47.1324C58.5 49.1626 56.8543 50.8083 54.8242 50.8083H37.6702C35.6401 50.8083 33.9944 49.1626 33.9944 47.1324Z" fill="#00853A"/>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="pxl-item--desc">
                                        <p><?php echo pxl_print_html($desc); ?></p>
                                    </div>
                                    <div class="pxl-item--star pxl-item--<?php echo esc_attr($star); ?>-star">
                                        <?php for ($i = 0; $i < $star; $i++) : ?>
                                            <i class="fas fa-star"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <div class="pxl-item--holder">
                                        <h6 class="pxl-item--title"><?php echo pxl_print_html($title); ?></h6>
                                        <div class="pxl-item--position">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="6" height="7" viewBox="0 0 6 7" fill="none">
                                                <circle cx="3" cy="3.5" r="3" fill="#00BD39"/>
                                            </svg>
                                            <?php echo pxl_print_html($position); ?>
                                        </div>
                                        </div>
                                    </div>

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

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <?php if($pagination !== false): ?>
                <div class="pxl-swiper-arrow-wrap style-2">
                    <div <?php pxl_print_html($widget->get_render_attribute_string( 'thumb' )); ?>>
                        <div class="pxl-swiper-wrapper swiper-wrapper ">
                            <?php foreach ($settings['testimonial'] as $key => $value):
                                $image_thumb = isset($value['image']) ? $value['image'] : '';
                                $image_thumb_small = isset($value['image_thumbnail']) ? $value['image_thumbnail'] : ''; 
                                if(!empty($image_thumb_small['id'])) {
                                    $image_thumb['id'] = $image_thumb_small['id'];
                                } ?>
                                <div class="pxl-swiper-slide swiper-slide">
                                    <?php if(!empty($image_thumb['id'])) { 
                                        $img = pxl_get_image_by_size( array(
                                            'attach_id'  => $image_thumb['id'],
                                            'thumb_size' => '80x88',
                                            'class' => 'no-lazyload',
                                        ));
                                        $thumbnail = $img['thumbnail'];?>
                                        <div class="pxl-item--thumb">
                                            <?php echo wp_kses_post($thumbnail); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($arrows !== false): ?>
                <div class="pxl-swiper-arrow-wrap style-2">
                    <div class="pxl-swiper-arrow pxl-swiper-arrow-prev pxl-cursor--cta"><i class="caseicon-angle-arrow-left rtl-icon"></i></div>
                    <div class="pxl-swiper-arrow pxl-swiper-arrow-next pxl-cursor--cta"><i class="caseicon-angle-arrow-right rtl-icon"></i></div>
                </div>
            <?php endif; ?>

        </div>
    <?php endif; ?>
