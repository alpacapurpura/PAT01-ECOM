<?php 
if ( ! empty( $settings['image_link']['url'] ) ) {
    $widget->add_render_attribute( 'image_link', 'href', $settings['image_link']['url'] );

    if ( $settings['image_link']['is_external'] ) {
        $widget->add_render_attribute( 'image_link', 'target', '_blank' );
    }

    if ( $settings['image_link']['nofollow'] ) {
        $widget->add_render_attribute( 'image_link', 'rel', 'nofollow' );
    }
}
$html_id = pxl_get_element_id($settings); 
?>
<?php if(isset($settings['image']) && !empty($settings['image']) && count($settings['image'])) : 
$image = isset($settings['image']) ? $settings['image'] : '';
$img_size = !empty($settings['img_size']) ? $settings['img_size'] : 'full';
?>
<div class="pxl-image-box pxl-image-box1">
    <div class="pxl-item--inner">
     <?php if(!empty($image['id'])) { 
        $img = pxl_get_image_by_size( array(
            'attach_id'  => $image['id'],
            'thumb_size' => $img_size,
            'class' => 'no-lazyload',
        ));
        $thumbnail = $img['thumbnail'];
        ?>
        <a  <?php pxl_print_html($widget->get_render_attribute_string( 'image_link' )); ?>>

            <div class="pxl-item--image">
                <?php echo wp_kses_post($thumbnail); ?>
            </div>
            <div class="pxl--content">
                <?php if (!empty($settings['img_excerpt'])): ?>
                    <div class="pxl-item--excerpt">
                        <?php echo pxl_print_html($settings['img_excerpt']); ?>
                    </div>
                <?php endif ?>
                <a class="button-img btn-image-box" <?php pxl_print_html($widget->get_render_attribute_string( 'image_link' )); ?>>
                    <h3>
                        <?php echo pxl_print_html($settings['button_image']); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M9 18L15 12L9 6" stroke="#FCB300" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </h3>

                </a>
            </div>
        </a>

    <?php } ?>

</div>
</div>
<?php endif; ?>