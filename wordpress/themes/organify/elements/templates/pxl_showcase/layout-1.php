<?php 
$img_size = !empty($settings['img_size']) ? $settings['img_size'] : 'full'; 
if ( ! empty( $settings['btn_link']['url'] ) ) {
    $widget->add_render_attribute( 'button', 'href', $settings['btn_link']['url'] );

    if ( $settings['btn_link']['is_external'] ) {
        $widget->add_render_attribute( 'button', 'target', '_blank' );
    }

    if ( $settings['btn_link']['nofollow'] ) {
        $widget->add_render_attribute( 'button', 'rel', 'nofollow' );
    }
}
?>
<div class="pxl-showcase pxl-showcase1 pxl-hover-parallax <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <div class="pxl-item--inner">
        <?php if(!empty($settings['image']['id'])) :
            $img = pxl_get_image_by_size( array(
                'attach_id'  => $settings['image']['id'],
                'thumb_size' => $img_size,
            ));
            $thumbnail = $img['thumbnail']; ?>
            <div class="pxl-item--image">
                <?php echo pxl_print_html($thumbnail); ?>
            </div>
        <?php endif; ?>
        <?php if(!empty($settings['btn_text'])) : ?>
                <a class="pxl-item--readmore btn-readmore-1 pxl-item-parallax" <?php pxl_print_html($widget->get_render_attribute_string( 'button' )); ?>>
                    <span class="pxl-item-text-parallax"><?php echo pxl_print_html($settings['btn_text']); ?></span>
                </a>
            <div class="pxl-item--overlay"></div>
        <?php endif; ?>
        <?php if(!empty($settings['title'])) : ?>
            <a class="pxl-item--title" <?php pxl_print_html($widget->get_render_attribute_string( 'button' )); ?>><span class="text"><?php echo pxl_print_html($settings['title']); ?></span></a>
        <?php endif; ?>
        
    </div>
</div>