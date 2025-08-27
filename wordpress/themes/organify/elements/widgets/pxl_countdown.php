<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_countdown',
        'title' => esc_html__('Case Countdown', 'organify' ),
        'icon' => 'eicon-countdown',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'organify-countdown',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'countdown_section',
                    'label' => esc_html__('Content', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'date',
                            'label' => esc_html__('Date', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'description' => esc_html__('Set date count down (Date format: yy/mm/dd 00:00:00)', 'organify'),
                        ),
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style1' => 'Style 1',
                            ],
                            'default' => 'style1',
                        ),
                    ),
                ),
                organify_widget_animation_settings(),
            ),
        ),
    ),
    organify_get_class_widget_path()
);