<?php
$show_star = $widget->get_setting('show_star');
if(isset($settings['items']) && !empty($settings['items']) && count($settings['items'])):
$image_size = !empty($settings['img_size']) ? $settings['img_size'] : '43x48'; ?>
    <div class="pxl-pxl_testimonial_marquee pxl-pxl_testimonial_marquee1 pxl-text-slide1 <?php echo esc_attr($settings['style']); ?>">
        <div class="pxl-text-slide <?php echo esc_attr($settings['effect']); ?>" <?php if(!empty($settings['effect_speed'])) { ?>style="animation-duration:<?php echo esc_attr($settings['effect_speed']); ?>ms"<?php } ?>>
            <?php foreach ($settings['items'] as $key => $value):
                $image = isset($value['image']) ? $value['image'] : '';
                $text = isset($value['text']) ? $value['text'] : '';
                $sub_title = isset($value['sub_title']) ? $value['sub_title'] : '';
                $desc = isset($value['desc']) ? $value['desc'] : '';
                $style_star = isset($value['style_star']) ? $value['style_star'] : '';
                if(!empty($text)) : ?>
                    <div class="pxl--item <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
                        <div class="pxl-item-top">
                            <?php if(!empty($image['id'])) { 
                                $img = pxl_get_image_by_size( array(
                                    'attach_id'  => $image['id'],
                                    'thumb_size' => $image_size,
                                    'class' => 'no-lazyload',
                                ));
                                $thumbnail = $img['thumbnail'];
                                ?>
                                <div class="pxl-image">
                                    <?php echo wp_kses_post($thumbnail); ?>
                                </div>
                            <?php } ?>
                            <div class="pxl-item-right">
                                <span class="pxl-item--text"><?php echo pxl_print_html($text); ?></span>
                                <span class="pxl-sub-title"><?php echo pxl_print_html($sub_title); ?></span>
                            </div>
                        </div>
                        <div class="pxl-item-desc"><?php echo pxl_print_html($desc); ?></div>
                        <?php if( $show_star == 'true' ) : ?>
                            <span class="pxl-item--star pxl-item--<?php echo esc_attr( $style_star ); ?>-star">
                                <i class="fa fa-star pxl-mr-5"></i>
                                <i class="fa fa-star pxl-mr-5"></i>
                                <i class="fa fa-star pxl-mr-5"></i>
                                <i class="fa fa-star pxl-mr-5"></i>
                                <i class="fa fa-star pxl-mr-5"></i>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="pxl-text-fixed">
            <?php foreach ($settings['items'] as $key => $value):
                $image = isset($value['image']) ? $value['image'] : '';
                $text = isset($value['text']) ? $value['text'] : '';
                $sub_title = isset($value['sub_title']) ? $value['sub_title'] : '';
                $desc = isset($value['desc']) ? $value['desc'] : '';
                $style_star = isset($value['style_star']) ? $value['style_star'] : '';
                if(!empty($text)) : ?>
                    <div class="pxl--item <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
                        <div class="pxl-item-top">
                            <?php if(!empty($image['id'])) { 
                                $img = pxl_get_image_by_size( array(
                                    'attach_id'  => $image['id'],
                                    'thumb_size' => $image_size,
                                    'class' => 'no-lazyload',
                                ));
                                $thumbnail = $img['thumbnail'];
                                ?>
                                <div class="pxl-image">
                                    <?php echo wp_kses_post($thumbnail); ?>
                                </div>
                            <?php } ?>
                            <div class="pxl-item-right">
                                <span class="pxl-item--text"><?php echo pxl_print_html($text); ?></span>
                                <span class="pxl-sub-title"><?php echo pxl_print_html($sub_title); ?></span>
                            </div>
                        </div>
                        <div class="pxl-item-desc"><?php echo pxl_print_html($desc); ?></div>
                        <?php if( $show_star == 'true' ) : ?>
                            <span class="pxl-item--star pxl-item--<?php echo esc_attr( $style_star ); ?>-star">
                                <i class="fa fa-star pxl-mr-5"></i>
                                <i class="fa fa-star pxl-mr-5"></i>
                                <i class="fa fa-star pxl-mr-5"></i>
                                <i class="fa fa-star pxl-mr-5"></i>
                                <i class="fa fa-star pxl-mr-5"></i>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
