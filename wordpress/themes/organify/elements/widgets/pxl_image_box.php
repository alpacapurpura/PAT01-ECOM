<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_image_box',
        'title' => esc_html__('Case Image Box', 'organify' ),
        'icon' => 'eicon-image',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'tilt',
            'pxl-tweenmax',
            'gsap',
            'scroll-trigger'
        ),
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
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_image_box/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'organify' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_image_box/layout2.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_content',
                    'label' => esc_html__('Content', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'image',
                            'label' => esc_html__('Choose Image', 'organify' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                        ),
                        array(
                            'name' => 'img_size',
                            'label' => esc_html__('Image Size', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'description' => 'Enter image size - Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme. Alternatively enter size in pixels Example: 200x100 - Width x Height.',
                        ),
                        array(
                            'name' => 'img_title',
                            'label' => esc_html__('Title', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'condition' => [
                                'layout'    => '2',
                            ],
                        ),
                        array(
                            'name' => 'img_excerpt',
                            'label' => esc_html__('Excerpt', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'button_image',
                            'label' => esc_html__('Button Text', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default'   => 'Browse Products',
                            'label_block' => true,
                            'condition' => [
                                'layout'    => '1',
                            ],
                        ),
                        array(
                            'name' => 'image_link',
                            'label' => esc_html__('Link', 'organify' ),
                            'type' => \Elementor\Controls_Manager::URL,
                            'default' => [
                                'url'   => '#',
                            ],
                        ),
                    ),
                ),

                array(
                    'name' => 'tab_style_general',
                    'label' => esc_html__('General', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'border_radius_box',
                            'label' => esc_html__('Border Radius', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-box .pxl-item--inner' => 'border-radius: {{SIZE}}{{UNIT}};',
                            ],
                        ), 

                        array(
                            'name' => 'gap_inner',
                            'label' => esc_html__('Gap', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-box .pxl-item--inner' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout'    => '2',
                            ],
                        ),
                        array(
                            'name'  => 'heading_title',
                            'label' => esc_html__('Title','organify'),
                            'type'  => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                        ),

                        array(
                            'name' => 'color_title',
                            'label' => esc_html__('Color Title', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-box .pxl-item--inner .pxl-item--title .pxl--text' => 'color: {{VALUE}};',
                            ],
                        ),

                        array(
                            'name' => 'typography_title',
                            'label' => esc_html__('Typography Title', 'organify' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type'  => 'group',
                            'selector' => '{{WRAPPER}} .pxl-image-box .pxl-item--inner .pxl-item--title .pxl--text',
                        ),

                        array(
                            'name'  => 'heading_excerpt',
                            'label' => esc_html__('Excerpt','organify'),
                            'type'  => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                        ),

                        array(
                            'name' => 'color_excerpt',
                            'label' => esc_html__('Color Excerpt', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-box .pxl-item--inner .pxl-item--excerpt' => 'color: {{VALUE}};',
                            ],
                        ),

                        array(
                            'name' => 'typography_excerpt',
                            'label' => esc_html__('Typography Excerpt', 'organify' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type'  => 'group',
                            'selector' => '{{WRAPPER}} .pxl-image-box .pxl-item--inner .pxl-item--excerpt',
                        ),


                        array(
                            'name'  => 'heading_button',
                            'label' => esc_html__('Button','organify'),
                            'type'  => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                        ),
                        array(
                            'name' => 'color_button',
                            'label' => esc_html__('Color Button', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-box .pxl-item--inner .btn-image-box h3' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'typography_button',
                            'label' => esc_html__('Typography Button Text', 'organify' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type'  => 'group',
                            'selector' => '{{WRAPPER}} .pxl-image-box .pxl-item--inner .btn-image-box h3',
                        ),

                        array(
                            'name'  => 'heading_icon',
                            'label' => esc_html__('Icon','organify'),
                            'type'  => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                        ),
                        array(
                            'name' => 'color_icon',
                            'label' => esc_html__('Color Icon', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-box .pxl-item--inner .btn-image svg path' => 'stroke: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'fontsize_icon',
                            'label' => esc_html__('Size Icon', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-box .pxl-item--inner .btn-image svg' => 'width: {{SIZE}}{{UNIT}};,height:{{SIZE}}{{UNIT}};',
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