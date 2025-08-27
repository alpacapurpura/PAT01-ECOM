<?php

if (!class_exists('Organify_Footer')) {

    class Organify_Footer
    {
        public function getFooter()
        {
            if(is_singular('elementor_library')) return;
            
            $footer_layout = (int)organify()->get_opt('footer_layout');
            
            if ($footer_layout <= 0 || !class_exists('Pxltheme_Core') || !is_callable( 'Elementor\Plugin::instance' )) {
                get_template_part( 'template-parts/footer/default');
            } else {
                $args = [
                    'footer_layout' => $footer_layout
                ];
                get_template_part( 'template-parts/footer/elementor','', $args );
            } 

            // Back To Top
            $back_totop_on = organify()->get_theme_opt('back_totop_on', true);
            $back_top_top_style = organify()->get_opt('back_top_top_style', 'style-default');
            if (isset($back_totop_on) && $back_totop_on == true) : ?>
                <a class="pxl-scroll-top <?php echo esc_attr($back_top_top_style); ?>" href="#">
                    <i class="fas fa-arrow-up"></i>
                    <svg class="pxl-scroll-progress-circle" width="100%" height="100%" viewBox="-1 -1 102 102">
                        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
                    </svg>
                </a>
            <?php endif;

            // Mouse Move Animation
            organify_mouse_move_animation();

            // Cookie Policy
            organify_cookie_policy();

            // Subscribe Popup
            organify_subscribe_popup();

            // Cart Sidebar
            organify_hook_anchor_cart();
            
        }
 
    }
}
 