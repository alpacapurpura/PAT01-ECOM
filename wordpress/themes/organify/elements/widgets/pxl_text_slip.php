<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_text_slip',
        'title' => esc_html__('Case Text Slip', 'organify' ),
        'icon' => 'eicon-heading',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'items',
                            'label' => esc_html__('Content', 'organify'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'text',
                                    'label' => esc_html__('Text', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'label_block' => true,
                                ),


                                array(
                                    'name' => 'img',
                                    'label' => esc_html__('Image', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                ),
                                array(
                                    'name' => 'pxl_icon',
                                    'label' => esc_html__('Icon', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::ICONS,
                                    'fa4compatibility' => 'icon',
                                ),
                            ),
                            'title_field' => '{{{ text }}}',
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
                            '{{WRAPPER}} .pxl-text-slip' => 'text-align: {{VALUE}};',
                        ],
                    ),
                        array(
                            'name' => 'h_width',
                            'label' => esc_html__('Max Width', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-slip .pxl-item--inner' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_text',
                    'label' => esc_html__('Text', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'text_tag',
                            'label' => esc_html__('HTML Tag', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'h1' => 'H1',
                                'h2' => 'H2',
                                'h3' => 'H3',
                                'h4' => 'H4',
                                'h5' => 'H5',
                                'h6' => 'H6',
                                'div' => 'div',
                                'span' => 'span',
                                'p' => 'p',
                            ],
                            'default' => 'h3',
                        ),
                        array(
                            'name' => 'banner',
                            'label' => esc_html__('Banner', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'no' => 'No',
                                'yes' => 'Yes',
                            ],
                            'default' => 'no',
                        ),
                        array(
                            'name' => 'background_color',
                            'label' => esc_html__('Background Color', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-slip.pxl-text-white-shadow .pxl-item--container' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'banner' => 'yes',
                            ],
                        ),
                        
                        array(
                            'name'  => 'heading_text',
                            'label' => esc_html__('Text','organify'),
                            'type'  => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                        ),

                        array(
                            'name' => 'text_typography',
                            'label' => esc_html__('Typography', 'organify' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-text-slip .pxl-item--text',
                        ),
                        array(
                            'name'  => 'style_text_color',
                            'label' => esc_html__('Style Text Color','organify'),
                            'type'  => \Elementor\Controls_Manager::SELECT,
                            'options'   => [
                                'color_normal'  => 'Normal',
                                'gradient_color' => 'Gradient',
                            ],
                            'default'   => 'color_normal',
                        ),
                        array(
                            'name'  => 'style_text_normal',
                            'label' => esc_html__('Text Color','organify'),
                            'type'  => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-slip .pxl-item--text'=> '--gradient-color-from: {{VALUE}}; --gradient-color-to:{{VALUE}};',
                            ], 
                            'condition' => [
                               'style_text_color' => 'color_normal',
                           ],
                       ),
                        array(
                            'name'  => 'style_gradient_from',
                            'label' => esc_html__('Text Color From','organify'),
                            'type'  => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-slip .pxl-item--text'=> '--gradient-color-from: {{VALUE}};',
                            ], 
                            'condition' => [
                               'style_text_color' => 'gradient_color',
                           ],
                       ),
                        array(
                            'name'  => 'style_gradient_to',
                            'label' => esc_html__('Text Color To','organify'),
                            'type'  => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-slip .pxl-item--text'=> ' --gradient-color-to:{{VALUE}};',
                            ], 
                            'condition' => [
                               'style_text_color' => 'gradient_color',
                           ],
                       ),

                        array(
                            'name'  => 'style_text',
                            'label' => esc_html__('Style Text','organify'),
                            'type'  => \Elementor\Controls_Manager::SELECT,
                            'options'   => [
                                'text-stroke'  => 'Stroke',
                                'text-fill' => 'Fill',
                            ],
                            'default'   => 'text-fill',
                        ),
                        array(
                            'name'  => 'text_stroke_width',
                            'label' => esc_html__('Text Stroke Width','organify'),
                            'type'  => \Elementor\Controls_Manager::SLIDER,
                            'control_type'  => 'responsive',
                            'size_units'    => ['px','custom'],
                            'range' => [
                                'px'    => [
                                    'min'   => 0,
                                    'max'   => 50,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-slip .pxl-item--text'=> '-webkit-text-stroke-width:{{SIZE}}{{UNIT}};',
                            ], 

                        ),
                        array(
                            'name'  => 'text_fill_color',
                            'label' => esc_html__('Text Fill Color','organify'),
                            'type'  => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-slip .pxl-item--text'=> ' -webkit-text-fill-color:{{VALUE}};',
                            ], 

                        ),

                        array(
                            'name'  => 'heading_icon',
                            'label' => esc_html__('Icon','organify'),
                            'type'  => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                        ),
                        array(
                            'name'  => 'color_icon',
                            'label' => esc_html__('Icon Color','organify'),
                            'type'  => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-slip .pxl-item--text svg path'=> ' stroke:{{VALUE}};',
                                '{{WRAPPER}} .pxl-text-slip .pxl-item--text i'=> ' color:{{VALUE}};',
                            ], 
                        ),

                        array(
                            'name'  => 'fontsize_icon',
                            'label' => esc_html__('Size Icon','organify'),
                            'type'  => \Elementor\Controls_Manager::SLIDER,
                            'control_type'  => 'responsive',
                            'size_units'    => ['px','custom'],
                            'range' => [
                                'px'    => [
                                    'min'   => 0,
                                    'max'   => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-text-slip .pxl-item--text svg'=> 'width:{{SIZE}}{{UNIT}};',
                            ], 

                        ),


                        array(
                            'name'  => 'heading_effect',
                            'label' => esc_html__('Effect','organify'),
                            'type'  => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                        ),
                        array(
                            'name' => 'text_effect',
                            'label' => esc_html__('Effect', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'no-effect' => 'None',
                                'pxl-slide-to-left' => 'Slide Right To Left',
                                'pxl-slide-to-right' => 'Slide Left To Right',
                            ],
                            'default' => 'no-effect',
                        ),
                        array(
                            'name' => 'effect_speed',
                            'label' => esc_html__('Effect Speed', 'organify'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'description' => 'Default: 30 - Unit: s',
                            'condition' => [
                                'text_effect' => ['pxl-slide-to-left', 'pxl-slide-to-right'],
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