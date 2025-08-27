<?php 
$title = $widget->parse_text_editor( $settings['title'] ); 
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

if ( ! empty( $settings['btn_link_2']['url'] ) ) {
    $widget->add_render_attribute( 'button_2', 'href', $settings['btn_link_2']['url'] );

    if ( $settings['btn_link_2']['is_external'] ) {
        $widget->add_render_attribute( 'button_2', 'target', '_blank' );
    }

    if ( $settings['btn_link_2']['nofollow'] ) {
        $widget->add_render_attribute( 'button_2', 'rel', 'nofollow' );
    }
}
?>
<div class="pxl-showcase pxl-showcase2 <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <div class="pxl-dot--btn">
        <span></span>
        <span></span>
        <span></span>
    </div>
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
        <div class="pxl-button--readmore">
            <?php if(!empty($settings['btn_text'])) : ?>
                    <a class="btn pxl-item--readmore btn-readmore-1" <?php pxl_print_html($widget->get_render_attribute_string( 'button' )); ?>>
                        <?php echo pxl_print_html($settings['btn_text']); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M10 4.16663V15.8333" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4.16663 10H15.8333" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
            <?php endif; ?>

            <?php if(!empty($settings['btn_text_2'])) : ?>
                <a class="btn pxl-item--readmore btn-readmore-2" <?php pxl_print_html($widget->get_render_attribute_string( 'button_2' )); ?>>
                 <?php echo pxl_print_html($settings['btn_text_2']); ?>
                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M10 4.16663V15.8333" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.16663 10H15.8333" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        <?php endif; ?>
    </div>
</div>
<?php if(!empty($settings['title'])) : ?>
    <div class="pxl-item--title"><span class="text"><?php echo wp_kses_post($title); ?></span></div>
<?php endif; ?>

</div>