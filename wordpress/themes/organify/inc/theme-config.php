<?php if(!function_exists('organify_configs')){
    function organify_configs($value){
        $primary_darker = organify()->get_opt('primary_color', '#5f2dde');
        $primary_darker_10 = pxl_darker_color($primary_darker, $primary_darker_10=1);
        $primary_darker_20 = pxl_darker_color($primary_darker, $primary_darker_20=1.3);
        $primary_darker_30 = pxl_darker_color($primary_darker, $primary_darker_30=3);
        $primary_darker_40 = pxl_darker_color($primary_darker, $primary_darker_40=4);

        $configs = [
            'theme_colors' => [
                'primary'   => [
                    'title' => esc_html__('Primary', 'organify'), 
                    'value' => organify()->get_opt('primary_color', '#00853A')
                ],
                'gradient-first'   => [
                    'title' => esc_html__('Gradient First', 'organify'), 
                    'value' => organify()->get_opt('gradient_first_color', '#FE6462')
                ],
                'secondary'   => [
                    'title' => esc_html__('Secondary', 'organify'), 
                    'value' => organify()->get_opt('secondary_color', '#000000')
                ],
                'third'   => [
                    'title' => esc_html__('Third', 'organify'), 
                    'value' => organify()->get_opt('third_color', '#FE4040')
                ],
                'dark'   => [
                    'title' => esc_html__('Dark', 'organify'), 
                    'value' => organify()->get_opt('dark_color', '#000')
                ],
                'body-bg'   => [
                    'title' => esc_html__('Body Background Color', 'organify'), 
                    'value' => organify()->get_page_opt('body_bg_color', '#F6F6F6')
                ],
                'primary-darker-10'   => [
                    'title' => esc_html__('Primary Darker Color 10', 'organify'),
                    'value' => $primary_darker_10
                ],
                'primary-darker-20'   => [
                    'title' => esc_html__('Primary Darker Color 20', 'organify'), 
                    'value' => $primary_darker_20
                ],
                'primary-darker-30'   => [
                    'title' => esc_html__('Primary Darker Color 30', 'organify'), 
                    'value' => $primary_darker_30
                ],
                'primary-darker-40'   => [
                    'title' => esc_html__('Primary Darker Color 40', 'organify'), 
                    'value' => $primary_darker_40
                ]
            ],
            'link' => [
                'color' => organify()->get_opt('link_color', ['regular' => '#202020'])['regular'],
                'color-hover'   => organify()->get_opt('link_color', ['hover' => '#FCB300'])['hover'],
                'color-active'  => organify()->get_opt('link_color', ['active' => '#FCB300'])['active'],
            ],
            'gradient' => [
                'color-from' => organify()->get_opt('gradient_color', ['from' => '#FF6400'])['from'],
                'color-to' => organify()->get_opt('gradient_color', ['to' => '#FF0100'])['to'],
            ],
            'gradient2' => [
                'color-from' => organify()->get_opt('gradient_color2', ['from' => '#8c92f6'])['from'],
                'color-to' => organify()->get_opt('gradient_color2', ['to' => '#f9d78f'])['to'],
            ],
               
        ];
        return $configs[$value];
    }
}
if(!function_exists('organify_inline_styles')) {
    function organify_inline_styles() {  
        
        $theme_colors      = organify_configs('theme_colors');
        $link_color        = organify_configs('link');
        $gradient_color    = organify_configs('gradient');
        $gradient_color2   = organify_configs('gradient2');

        ob_start();
        echo ':root{';
            
            foreach ($theme_colors as $color => $value) {
                printf('--%1$s-color: %2$s;', str_replace('#', '',$color),  $value['value']);
            }
            foreach ($theme_colors as $color => $value) {
                printf('--%1$s-color-rgb: %2$s;', str_replace('#', '',$color),  organify_hex_rgb($value['value']));
            }
            foreach ($link_color as $color => $value) {
                printf('--link-%1$s: %2$s;', $color, $value);
            }
            foreach ($gradient_color as $color => $value) {
                printf('--gradient-%1$s: %2$s;', $color, $value);
            }
            foreach ($gradient_color2 as $color => $value) {
                printf('--gradient-%1$s2: %2$s;', $color, $value);
            }

        echo '}';

        return ob_get_clean();
         
    }
}
 