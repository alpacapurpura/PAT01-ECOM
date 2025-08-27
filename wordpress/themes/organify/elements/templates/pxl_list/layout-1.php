<?php if(isset($settings['lists']) && !empty($settings['lists']) && count($settings['lists'])): ?>
<div class="pxl-list pxl-list1 <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <?php foreach ($settings['lists'] as $key => $value): ?>
        <?php 
        $link_key = $widget->get_repeater_setting_key( 'lists', 'value', $key );
        if ( ! empty( $value['link']['url'] ) ) {
            $widget->add_render_attribute( $link_key, 'href', $value['link']['url'] );

            if ( $value['link']['is_external'] ) {
                $widget->add_render_attribute( $link_key, 'target', '_blank' );
            }

            if ( $value['link']['nofollow'] ) {
                $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
            }
        }
        $link_attributes = $widget->get_render_attribute_string( $link_key ); 
        ?>
        <div class="pxl--item">
            <div class="pxl-item--meta">
                <?php if ( $settings['icon_type'] == 'icon' && !empty($settings['pxl_icon']['value']) ) : ?>
                    <div class="pxl-item--icon <?php if($settings['icon_color_type'] == 'gradient') { echo 'pxl-icon-color-gradient'; } ?>">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['pxl_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'i' ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( $settings['icon_type'] == 'image' && !empty($settings['icon_image']['id']) ) : 
                    $img_icon  = pxl_get_image_by_size( array(
                        'attach_id'  => $settings['icon_image']['id'],
                        'thumb_size' => 'full',
                    ) );
                    $thumbnail_icon    = $img_icon['thumbnail']; 
                    ?>

                    <div class="pxl-item--icon"><?php echo pxl_print_html($thumbnail_icon); ?></div>
                <?php endif; ?>
            </div>
            <?php if(!empty($value['content'])) : ?>
                <div class="pxl-item--content">
                    <label class="pxl-empty"><?php echo pxl_print_html($value['label']); ?></label>
                    <?php if (!empty($link_attributes)): ?>
                        <div class="pxl-content"><a  <?php echo implode( ' ', [ $link_attributes ] ); ?>> <?php echo pxl_print_html($value['content'])?></a></div>
                    <?php else: ?>
                        <div class="pxl-content"> <?php echo pxl_print_html($value['content'])?></div>
                <?php endif ?>
            </div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
</div>
<?php endif; ?>