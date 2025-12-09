<?php
$html_id = pxl_get_element_id($settings);
?>
<div class="pxl-btn-wrap">
    <?php if(isset($settings['pxl_button_rp']) && !empty($settings['pxl_button_rp']) && count($settings['pxl_button_rp'])): ?>
    <ul id="pxl-<?php echo esc_attr($html_id) ?>" class="pxl-button pxl-button--2 <?php echo esc_attr($settings['btn_action'].' '.$settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
        <?php foreach($settings['pxl_button_rp'] as $key => $value) :
            $link_key = $widget->get_repeater_setting_key( 'link', 'value', $key );
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
            <a <?php echo implode( ' ', [ $link_attributes ] ); ?> class="btn <?php if(!empty($settings['btn_icon'])) { echo 'pxl-icon-active'; } ?> <?php echo esc_attr($settings['btn_full_width'].' '.$settings['btn_text_effect'].' '.$settings['btn_style'].' pxl-icon--'.$settings['icon_align']); ?>">
                <?php if(!empty($settings['btn_icon']['value'])) { ?>
                    <span class="pxl--btn-icon">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'i' ); ?>
                        <?php if($settings['btn_style'] == 'btn-icon-box3') : ?>
                            <span class="pxl-divider-circle">
                                <svg width="100%" height="100%" viewBox="-1 -1 102 102">
                                    <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
                                </svg>
                            </span>
                        <?php endif; ?>
                    </span>
                <?php } ?>
                <span class="pxl--btn-text" data-text="<?php echo esc_attr($value['text']); ?>">
                    <?php if($settings['btn_text_effect'] == 'btn-text-nina' || $settings['btn_text_effect'] == 'btn-text-nanuk') {
                        $chars = preg_split('//u', $value['text'], null, PREG_SPLIT_NO_EMPTY);

                        foreach ($chars as $value) {
                            if($value == ' ') {
                                echo '<span class="spacer">&nbsp;</span>';
                            } else {
                                echo '<span>' . htmlspecialchars($value) . '</span>';
                            }
                        }
                    } else {
                        echo pxl_print_html($value['text']);
                    }
                    ?>
                </span>
            </a>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
</div>