<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_breadcrumb',
        'title' => esc_html__('Case Breadcrumb', 'organify' ),
        'icon' => 'eicon-yoast',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_style',
                    'label' => esc_html__('Style', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'text_color',
                            'label' => esc_html__('Text Color', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-breadcrumb' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'active_color',
                            'label' => esc_html__('Active Color', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-breadcrumb span.breadcrumb-entry' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'hover_color',
                            'label' => esc_html__('Hover Color', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-breadcrumb a:hover' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'text_typography',
                            'label' => esc_html__('Text Typography', 'organify' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-breadcrumb',
                        ),
                        array(
                          'name' => 'align',
                          'label' => esc_html__( 'Alignment', 'organify' ),
                          'type' => \Elementor\Controls_Manager::CHOOSE,
                          'control_type' => 'responsive',
                          'options' => [
                            'left' => [
                                'title' => esc_html__( 'Left', 'organify' ),
                                'icon' => 'eicon-text-align-left',
                            ],
                            'center' => [
                                'title' => esc_html__( 'Center', 'organify' ),
                                'icon' => 'eicon-text-align-center',
                            ],
                            'right' => [
                                'title' => esc_html__( 'Right', 'organify' ),
                                'icon' => 'eicon-text-align-right',
                            ],
                            'justify' => [
                                'title' => esc_html__( 'Justified', 'organify' ),
                                'icon' => 'eicon-text-align-justify',
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-breadcrumb-wrap' => 'text-align: {{VALUE}}; justify-content: {{VALUE}};',
                        ],
                    ),
                    ),
                ),
                organify_widget_animation_settings(),
            ),
        ),
    ),
    organify_get_class_widget_path()
);