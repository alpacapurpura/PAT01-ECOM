<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_banner_box',
        'title' => esc_html__('Case Banner Box', 'organify' ),
        'icon' => 'eicon-posts-ticker',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'tab_layout',
                    'label' => esc_html__('Layout', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'organify' ),
                            'type' => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'organify' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_banner_box/layout1.jpg'
                                ], 
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'title',
                            'label' => esc_html__('Title', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'placeholder'   => 'ENJOY',
                        ),
                        array(
                            'name' => 'offer',
                            'label' => esc_html__('Offer', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'description' => 'Create Typewriter text width shortcode: [typewriter text="Text1, Text2"], Highlight text with shortcode: [highlight text="Text"] and Highlight image with shortcode: [highlight_image id_image="123"]',
                            'placeholder'   => '40% OFF',
                        ),
                        array(
                            'name' => 'object',
                            'label' => esc_html__('Object', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'placeholder'   => 'On All Products',
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
                            '{{WRAPPER}} .pxl-banner-box .pxl--inner' => 'text-align: {{VALUE}}; justify-content: {{VALUE}};',
                        ],
                    ),
                    ),
                ),


                array(
                    'name' => 'section_style_general',
                    'label' => esc_html__('General', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'border_color',
                            'label' => esc_html__('Border Color', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-banner-box .pxl--inner' => 'border-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-banner-box .pxl-item--title::before' => 'background: {{VALUE}};',
                                '{{WRAPPER}} .pxl-banner-box .pxl-item--title::after' => 'background: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'border_width',
                            'label' => esc_html__('Border Width', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-banner-box .pxl--inner' => 'border-width: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-banner-box .pxl-item--title::before' => 'height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-banner-box .pxl-item--title::after' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'  => 'heading_title',
                            'label' => esc_html__('Title','organify'),
                            'type'  => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-banner-box .pxl-item--title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Typography', 'organify' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-banner-box .pxl-item--title',
                        ),
                        array(
                            'name' => 'space_border_tt',
                            'label' => esc_html__('Space Border', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-banner-box .pxl-item--title::before' => 'width: calc(50% - {{SIZE}}px);',
                                '{{WRAPPER}} .pxl-banner-box .pxl-item--title::after' => 'width: calc(50% - {{SIZE}}px);',
                            ],
                        ),

                        array(
                            'name' => 'space_bottom_tt',
                            'label' => esc_html__('Space Bottom', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-banner-box .pxl-item--title' => 'margin-bottom: {{SIZE}}px;',
                            ],
                        ),

                        array(
                            'name'  => 'heading_offer',
                            'label' => esc_html__('Offer','organify'),
                            'type'  => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                        ),
                        array(
                            'name' => 'offer_color',
                            'label' => esc_html__('Offer Color', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-banner-box .pxl-item--offer' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'offer_typography',
                            'label' => esc_html__('Typography', 'organify' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-banner-box .pxl-item--offer',
                        ),
                        array(
                            'name' => 'space_bottom_offer',
                            'label' => esc_html__('Space Bottom', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-banner-box .pxl-item--offer' => 'margin-bottom: {{SIZE}}px;',
                            ],
                        ),

                        array(
                            'name'  => 'heading_object',
                            'label' => esc_html__('Object','organify'),
                            'type'  => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                        ),
                        array(
                            'name' => 'pxl-item--object_color',
                            'label' => esc_html__('Object Color', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-banner-box .pxl-item--pxl-item--object' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'pxl-item--object_typography',
                            'label' => esc_html__('Typography', 'organify' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-banner-box .pxl-item--pxl-item--object',
                        ),
                        array(
                            'name' => 'space_bottom_object',
                            'label' => esc_html__('Space Bottom', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-banner-box .pxl-item--object' => 'margin-bottom: {{SIZE}}px;',
                            ],
                        ),
                    ),
),
),
),
),
organify_get_class_widget_path()
);