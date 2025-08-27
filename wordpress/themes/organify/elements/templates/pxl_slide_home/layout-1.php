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
if($settings['img_effect'] == 'pxl-image-parallax') { wp_enqueue_script( 'pxl-parallax-move-mouse'); }
if(isset($settings['slide_home']) && !empty($settings['slide_home']) && count($settings['slide_home'])): ?>
    <div class="pxl-swiper-slider pxl-slide--home pxl-slide--home1">
        <div class="pxl-carousel-inner">
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php foreach ($settings['slide_home'] as $key => $value):
                        $bg_image = isset($value['bg_image']) ? $value['bg_image'] : '';
                        $title = isset($value['title']) ? $value['title'] : '';
                        $description = isset($value['description']) ? $value['description'] : '';
                        $text_button = isset($value['text_button']) ? $value['text_button'] : 'Purchase Now';
                        $concept = isset($value['concept']) ? $value['concept'] : '';
                        $price = isset($value['price']) ? $value['price'] : '';
                        $units = isset($value['units']) ? $value['units'] : '';
                        $attributes = isset($value['attributes']) ? $value['attributes'] : '';
                        $product_image = isset($value['product_image']) ? $value['product_image'] : '';

                        $link_key = $widget->get_repeater_setting_key( 'button_link', 'value', $key );
                        if ( ! empty( $value['button_link']['url'] ) ) {
                            $widget->add_render_attribute( $link_key, 'href', $value['button_link']['url'] );

                            if ( $value['button_link']['is_external'] ) {
                                $widget->add_render_attribute( $link_key, 'target', '_blank' );
                            }

                            if ( $value['button_link']['nofollow'] ) {
                                $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                            }
                        }
                        $link_attributes = $widget->get_render_attribute_string( $link_key );
                        $img_size = !empty($value['img_size']) ? $value['img_size'] : 'full';

                        ?>
                        <div class="pxl-swiper-slide elementor-repeater-item-<?php echo esc_attr($value['_id']); ?>">
                         <?php                             
                         $bg_image = pxl_get_image_by_size( 
                            array(
                                'attach_id'  => $bg_image['id'],
                                'thumb_size' => 'full',
                                'class' => 'no-lazyload',
                            ));
                         $product_image = pxl_get_image_by_size( 
                            array(
                                'attach_id'  => $product_image['id'],
                                'thumb_size' => $img_size,
                                'class' => 'no-lazyload',
                            ));
                         $bg_image_url = $bg_image['url'];
                         $product_image = $product_image['thumbnail'];

                         ?>
                         <div class="pxl-item--inner  <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms" style="background-image: url(<?php echo esc_url($bg_image_url); ?>);">
                            <div class="pxl-introduction--product ">
                             <?php if (!empty($title)): ?>
                                <h2 class="pxl-slide--title">
                                    <?php echo pxl_print_html($title); ?>
                                </h2>
                            <?php endif ?>
                            <?php if (!empty($description)): ?>
                                <div class="pxl-slide--description">
                                    <?php echo pxl_print_html($description); ?>
                                </div>
                            <?php endif ?>
                            <?php if (!empty($text_button)): ?>
                                <a class="btn pxl--button" <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                                    <?php echo pxl_print_html($text_button); ?>
                                </a>
                            <?php endif ?>
                        </div>


                        <div class="pxl-content--product">
                            <?php if (!empty($concept)): ?>
                                <h1 class="pxl-slide--concept <?php echo pxl_print_html($settings['content_concept_style_text']); ?> ">
                                    <?php echo pxl_print_html($concept); ?>
                                </h1>
                            <?php endif ?>
                            <div class="pxl-info--product <?php echo pxl_print_html($value['style_info_prd']); ?>">
                                <?php if (!empty($price)): ?>
                                    <h3 class="pxl-slide--price">
                                        <?php echo pxl_print_html($price); ?>
                                    </h3>
                                <?php endif ?>
                                <div class="pxl-detail--product">
                                    <?php if (!empty($units)): ?>
                                        <div class="pxl-slide--units">
                                            <?php echo pxl_print_html($units); ?>
                                        </div>
                                    <?php endif ?>
                                    <?php if (!empty($attributes)): ?>
                                        <div class="pxl-slide--attributes">
                                            <?php echo pxl_print_html($attributes); ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <?php if (!empty($product_image)): ?>
                            <div class="pxl-product--image <?php if(!empty($settings['img_effect'])) { echo esc_attr($settings['img_effect']); } ?> <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms" <?php if($settings['img_effect'] == 'pxl-image-tilt') : ?>data-maxtilt="<?php echo esc_attr($settings['max_tilt']); ?>" data-speedtilt="<?php echo esc_attr($settings['speed_tilt']); ?>" data-perspectivetilt="<?php echo esc_attr($settings['perspective_tilt']); ?>"<?php endif; ?> <?php if($settings['img_effect'] == 'pxl-parallax-scroll') : ?>data-parallax='{"<?php echo esc_attr($settings['parallax_scroll_type']); ?>":<?php echo esc_attr($settings['parallax_scroll_value_x']); ?>}'<?php endif; ?> >
                                <div class="pxl-item--image" data-parallax-value="<?php echo esc_attr($settings['parallax_value']); ?>">
                                   <?php echo wp_kses_post($product_image); ?>
                               </div> 
                           </div>
                       <?php endif ?>
                   </div>
               </div>
           <?php endforeach; ?>
       </div>
   </div>

   <?php if($pagination !== false): ?>
    <div class="pxl-swiper-dots style-1"></div>
<?php endif; ?>

<?php if($arrows !== false): ?>
    <div class="pxl-swiper-arrow-wrap style-2">
        <div class="pxl-swiper-arrow pxl-swiper-arrow-prev"><i class="caseicon-angle-arrow-left rtl-icon"></i></div>
        <div class="pxl-swiper-arrow pxl-swiper-arrow-next"><i class="caseicon-angle-arrow-right rtl-icon"></i></div>
    </div>
<?php endif; ?>

</div>
</div>
<?php endif; ?>
