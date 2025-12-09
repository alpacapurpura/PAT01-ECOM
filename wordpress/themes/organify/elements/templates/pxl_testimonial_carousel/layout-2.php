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
$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
if(isset($settings['testimonial']) && !empty($settings['testimonial']) && count($settings['testimonial'])): ?>
    <div class="pxl-swiper-slider pxl-testimonial-carousel pxl-testimonial-carousel2" <?php if($drap !== false) : ?>data-cursor-drap="<?php echo esc_attr('DRAG', 'organify'); ?>"<?php endif; ?>>
        <div class="pxl-carousel-inner">

            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php foreach ($settings['testimonial'] as $key => $value):
                        $title = isset($value['title']) ? $value['title'] : '';
                        $position = isset($value['position']) ? $value['position'] : '';
                        $desc = isset($value['desc']) ? $value['desc'] : '';
                        $star = isset($value['star']) ? $value['star'] : '';
                        $image = isset($value['image']) ? $value['image'] : '';
                        $image_size = !empty($settings['img_size']) ? $settings['img_size'] : '120x120';
                        
                        ?>
                        <div class="pxl-swiper-slide">
                            <div class="pxl-item--inner <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="92" height="80" viewBox="0 0 92 80">
                                        <path opacity="0.56" d="M82.8571 0H60C55.1786 0 51.4286 3.92857 51.4286 8.57143V31.4286C51.4286 36.25 55.1786 40 60 40H74.2857V51.4286C74.2857 57.8571 69.1071 62.8571 62.8571 62.8571H61.4286C58.9286 62.8571 57.1429 64.8214 57.1429 67.1429V75.7143C57.1429 78.2143 58.9286 80 61.4286 80H62.8571C78.5714 80 91.4286 67.3214 91.4286 51.4286V8.57143C91.4286 3.92857 87.5 0 82.8571 0ZM31.4286 0H8.57143C3.75 0 0 3.92857 0 8.57143V31.4286C0 36.25 3.75 40 8.57143 40H22.8571V51.4286C22.8571 57.8571 17.6786 62.8571 11.4286 62.8571H10C7.5 62.8571 5.71429 64.8214 5.71429 67.1429V75.7143C5.71429 78.2143 7.5 80 10 80H11.4286C27.1429 80 40 67.3214 40 51.4286V8.57143C40 3.92857 36.0714 0 31.4286 0Z" fill="#6ABC29"/>
                                    </svg>
                                </div>

                                <div class="pxl--content">
                                    <div class="pxl-item--star pxl-item--<?php echo esc_attr($star); ?>-star">
                                        <?php for ($i = 0; $i < $star; $i++) : ?>
                                            <i class="fas fa-star"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <div class="pxl-item--desc el-empty">
                                        <p><?php echo pxl_print_html($desc); ?></p>
                                    </div>
                                </div>

                                <div class="pxl-item--holder">
                                    <h6 class="pxl-item--title el-empty"><?php echo pxl_print_html($title); ?></h6>
                                    <div class="pxl-item--position el-empty"><?php echo pxl_print_html($position); ?></div>
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

        <?php if($arrows !== false): ?>
            <div class="pxl-swiper-arrow-wrap style-2">
                <div class="pxl-swiper-arrow pxl-swiper-arrow-prev pxl-cursor--cta"><i class="caseicon-angle-arrow-left rtl-icon"></i></div>
                <div class="pxl-swiper-arrow pxl-swiper-arrow-next pxl-cursor--cta"><i class="caseicon-angle-arrow-right rtl-icon"></i></div>
            </div>
        <?php endif; ?>

    </div>
<?php endif; ?>
