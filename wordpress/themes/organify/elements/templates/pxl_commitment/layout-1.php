<?php 
$title = $settings['title'];
$desc = $settings['desc'];
$button_text = !empty($settings['button_text']) ? $settings['button_text'] : 'Browse Our Shop';
if ( ! empty( $settings['link']['url'] ) ) {
    $widget->add_render_attribute( 'button', 'href', $settings['link']['url'] );

    if ( $settings['link']['is_external'] ) {
        $widget->add_render_attribute( 'button', 'target', '_blank' );
    }

    if ( $settings['link']['nofollow'] ) {
        $widget->add_render_attribute( 'button', 'rel', 'nofollow' );
    }
}
?>

<div class="pxl-commitment pxl-commitment1 ">
 <?php if ($title) : ?> 
    <<?php echo esc_attr($settings['title_tag']); ?> class="pxl-title <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
    <?php echo pxl_print_html($title); ?>
    </<?php echo esc_attr($settings['title_tag']); ?>>
<?php endif; ?>
<?php if ($desc) : ?> 
    <div class="pxl-desc">
        <?php echo pxl_print_html($desc); ?>
    </div>
<?php endif; ?>
<div class="pxl-content--commitment">
    <?php foreach ($settings['commitment'] as $key => $value) : 
        $ordinal_numbers = $key + 1;
        $title_commitment = $value['title_commitment'];
        $desc_commitment = $value['desc_commitment'];
        ?>

        <div class="pxl--items">
            <?php if ($title_commitment) : ?> 

                <h4 class="pxl-ordinal--numbers">
                    <?php if ($ordinal_numbers < 10) {
                        echo pxl_print_html('0'.$ordinal_numbers);
                    }else{
                        echo pxl_print_html($ordinal_numbers);
                    }
                    ?>
                    <div class="pxl-title--commit">
                        <?php echo pxl_print_html($title_commitment); ?>

                    </div>
                </h4>
            <?php endif; ?>

            <?php if ($desc_commitment) : ?> 
                <div class="pxl-desc--commit">
                    <?php echo pxl_print_html($desc_commitment); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
<a <?php pxl_print_html($widget->get_render_attribute_string( 'button' )); ?> class="btn pxl--button">
    <?php echo pxl_print_html($button_text); ?>
    <svg class="pxl-ml-8" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
        <path d="M10 4.16667V15.8333" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M4.16675 10H15.8334" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</a>
</div>
