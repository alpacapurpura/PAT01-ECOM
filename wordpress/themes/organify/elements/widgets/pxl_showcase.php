<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_showcase',
        'title' => esc_html__('Case Showcase', 'organify'),
        'icon' => 'eicon-parallax',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_layout',
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
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_showcase/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'organify' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_showcase/layout2.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'organify'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'image',
                            'label' => esc_html__('Image', 'organify' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                        ),
                        array(
                            'name' => 'img_size',
                            'label' => esc_html__('Image Size', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'description' => 'Enter image size - Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme. Alternatively enter size in pixels Example: 200x100 - Width x Height.',
                        ),
                        array(
                            'name' => 'title',
                            'label' => esc_html__('Title', 'organify'),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'description' => 'Create Typewriter text width shortcode: [typewriter text="Text1, Text2"], Highlight text with shortcode: [highlight text="Text"] and Highlight image with shortcode: [highlight_image id_image="123"]',
                        ),
                        
                        array(
                            'name' => 'btn_text',
                            'label' => esc_html__('Button Text 1', 'organify'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'btn_link',
                            'label' => esc_html__('Button Link 1', 'organify'),
                            'type' => \Elementor\Controls_Manager::URL,
                            'label_block' => true,
                        ), 

                        array(
                            'name' => 'btn_text_2',
                            'label' => esc_html__('Button Text 2', 'organify'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'condition' => [
                                'layout'    => '2',
                            ],
                        ),
                        array(
                            'name' => 'btn_link_2',
                            'label' => esc_html__('Button Link 2', 'organify'),
                            'type' => \Elementor\Controls_Manager::URL,
                            'label_block' => true,
                            'condition' => [
                                'layout'    => '2',
                            ],
                        ),

                    ),
                ),
                array(
                    'name' => 'section_style',
                    'label' => esc_html__('Style', 'organify'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Title Typography', 'organify' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-showcase .pxl-item--title span',
                        ),

                        array(
                            'name' => 'title_controls',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'title_normal',
                                    'label' => esc_html__('Normal', 'organify' ),
                                    'type' => 'tab',
                                    'controls' => [  
                                        array(
                                            'name' => 'title_color',
                                            'label' => esc_html__('Title Color', 'organify' ),
                                            'type' => \Elementor\Controls_Manager::COLOR,
                                            'selectors' => [
                                            '{{WRAPPER}} .pxl-showcase .pxl-item--title span' => 'color: {{VALUE}};',
                                        ],
                                    ), 

                                        array(
                                            'name' => 'bg_color',
                                            'label' => esc_html__('Background Color', 'organify' ),
                                            'type' => \Elementor\Group_Control_Background::get_type(),
                                            'control_type'  => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-showcase .pxl-item--inner::before',

                                        ), 

                                        array(
                                            'name'  => 'heading_button',
                                            'label' => esc_html__('BUTTON','organify'),
                                            'type'  => \Elementor\Controls_Manager::HEADING,
                                            'separator' => 'before',
                                        ),
                                        array(
                                            'name' => 'button__text_color',
                                            'label' => esc_html__('Button Text', 'organify' ),
                                            'type' => \Elementor\Controls_Manager::COLOR,
                                            'selectors' => [
                                            '{{WRAPPER}} .pxl-showcase .pxl-item--readmore a' => 'color: {{VALUE}};',
                                            '{{WRAPPER}} .pxl-showcase .pxl-item--readmore svg path' => 'stroke: {{VALUE}};',
                                        ],
                                    ),
                                        array(
                                            'name' => 'button_color',
                                            'label' => esc_html__('Button Color', 'organify' ),
                                            'type' => \Elementor\Controls_Manager::COLOR,
                                            'selectors' => [
                                            '{{WRAPPER}} .pxl-showcase .btn-readmore-1 ' => 'background: {{VALUE}};',
                                        ],
                                    ),

                                        array(
                                            'name' => 'button_color_2',
                                            'label' => esc_html__('Button 2 Color', 'organify' ),
                                            'type' => \Elementor\Controls_Manager::COLOR,
                                            'selectors' => [
                                            '{{WRAPPER}} .pxl-showcase .btn-readmore-2 ' => 'background: {{VALUE}};',

                                        ],
                                        'condition' => [
                                        'layout'    => '2',
                                    ],
                                ),
                                        array(
                                            'name' => 'button_typography',
                                            'label' => esc_html__('Typography', 'organify' ),
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-showcase .btn',
                                        ),

                                        array(
                                            'name' => 'padding_button',
                                            'label' => esc_html__('Padding', 'organify' ),
                                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                            'size_units' => [ 'px' ],
                                            'selectors' => [
                                            '{{WRAPPER}} .pxl-showcase.pxl-showcase .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                        ],
                                        'control_type' => 'responsive',
                                    ),

                                        array(
                                            'name' => 'border_radius_button',
                                            'label' => esc_html__('Border Radius', 'organify' ),
                                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                            'size_units' => [ 'px' ],
                                            'selectors' => [
                                            '{{WRAPPER}} .pxl-showcase.pxl-showcase .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                        ],
                                        'control_type' => 'responsive',
                                    ),

                                        
                                    ],
                                ],
                                [
                                    'name' => 'title_hover',
                                    'label' => esc_html__('Hover', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::TAB,
                                    'controls' => [
                                       array(
                                        'name' => 'title_color_hv',
                                        'label' => esc_html__('Title Color', 'organify' ),
                                        'type' => \Elementor\Controls_Manager::COLOR,
                                        'selectors' => [
                                        '{{WRAPPER}} .pxl-showcase:hover .pxl-item--title span' => 'color: {{VALUE}};',
                                        '{{WRAPPER}} .pxl-showcase .pxl-item--title span::before,{{WRAPPER}} .pxl-showcase .pxl-item--title span::after' => 'background-color: {{VALUE}};',
                                    ],
                                ),   
                                       array(
                                        'name' => 'bg_color_hv',
                                        'label' => esc_html__('Background Color', 'organify' ),
                                        'type' => \Elementor\Group_Control_Background::get_type(),
                                        'control_type'  => 'group',
                                        'selector' =>  '{{WRAPPER}} .pxl-showcase .pxl-item--inner::after',
                                    ),
                                       array(
                                        'name'  => 'heading_button_hv',
                                        'label' => esc_html__('BUTTON','organify'),
                                        'type'  => \Elementor\Controls_Manager::HEADING,
                                        'separator' => 'before',
                                    ),
                                       array(
                                        'name' => 'button_color_hv',
                                        'label' => esc_html__('Button Color', 'organify' ),
                                        'type' => \Elementor\Controls_Manager::COLOR,
                                        'selectors' => [
                                        '{{WRAPPER}} .pxl-showcase .btn-readmore-1:hover ' => 'background: {{VALUE}};',
                                    ],
                                ),
                                       array(
                                        'name' => 'button_color_hv_2',
                                        'label' => esc_html__('Button 2 Color', 'organify' ),
                                        'type' => \Elementor\Controls_Manager::COLOR,
                                        'selectors' => [
                                        '{{WRAPPER}} .pxl-showcase .btn-readmore-2:hover ' => 'background: {{VALUE}};',
                                    ],
                                    'condition' => [
                                    'layout'    => '2',
                                ],
                            ),       

                                       array(
                                        'name' => 'button_typography_hv',
                                        'label' => esc_html__('Typography', 'organify' ),
                                        'type' => \Elementor\Group_Control_Typography::get_type(),
                                        'control_type' => 'group',
                                        'selector' => '{{WRAPPER}} .pxl-showcase .btn:hover',
                                    ),

                                       array(
                                        'name' => 'padding_button_hv',
                                        'label' => esc_html__('Padding', 'organify' ),
                                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                        'size_units' => [ 'px' ],
                                        'selectors' => [
                                        '{{WRAPPER}} .pxl-showcase.pxl-showcase .btn:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                    ],
                                    'control_type' => 'responsive',
                                ),

                                       array(
                                        'name' => 'border_radius_button_hv',
                                        'label' => esc_html__('Border Radius', 'organify' ),
                                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                        'size_units' => [ 'px' ],
                                        'selectors' => [
                                        '{{WRAPPER}} .pxl-showcase.pxl-showcase .btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                    ],
                                    'control_type' => 'responsive',
                                ),                           
                                   ],
                               ],
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