<?php
// Register Button Widget
pxl_add_custom_widget(
    array(
        'name' => 'icon_cart',
        'title' => esc_html__('Case Shop Cart', 'organify' ),
        'icon' => 'eicon-cart-medium',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source Settings', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style-default' => 'Default',
                                'style-box' => 'Box',
                            ],
                            'default' => 'style-default',
                        ),
                        array(
                            'name' => 'icon_image_type',
                            'label' => esc_html__('Icon Image Type', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'img' => 'Image',
                                'ic' => 'Icon',
                            ],
                            'default' => 'ic',
                        ),
                        array(
                            'name' => 'pxl_icon',
                            'label' => esc_html__('Icon', 'organify' ),
                            'type' => \Elementor\Controls_Manager::ICONS,
                            'fa4compatibility' => 'icon',
                            'condition' => [
                                'icon_image_type' => ['ic'],
                            ],
                        ),
                        array(
                            'name' => 'image',
                            'label' => esc_html__( 'Icon Image', 'organify' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'condition' => [
                                'icon_image_type' => ['img'],
                            ],
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-cart-sidebar-button i' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'icon_image_type' => ['img'],
                            ],
                        ),
                        array(
                            'name' => 'icon_color_hover',
                            'label' => esc_html__('Icon Color Hover', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-cart-sidebar-button:hover i' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'icon_image_type' => ['img'],
                            ],
                        ),
                        array(
                            'name' => 'size',
                            'label' => esc_html__('Icon Size', 'organify' ),
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
                                '{{WRAPPER}} .pxl-cart-sidebar-button i' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'gap',
                            'label' => esc_html__('Gap', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-cart' => 'gap: {{SIZE}}px;',
                            ],
                        ),
                        array(
                            'name' => 'box_color',
                            'label' => esc_html__('Box Color', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-cart-sidebar-button' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'style' => ['style-box'],
                            ],
                        ),
                        array(
                            'name' => 'box_color_hv',
                            'label' => esc_html__('Box Color Hover', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-cart-sidebar-button:hover' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'style' => ['style-box'],
                            ],
                        ),
                        array(
                            'name' => 'box_height',
                            'label' => esc_html__('Box Height', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'condition' => [
                                'style' => ['style-box'],
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-cart-sidebar-button' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'box_width',
                            'label' => esc_html__('Box Width', 'organify' ),
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
                                '{{WRAPPER}} .pxl-cart-sidebar-button' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'style' => ['style-box'],
                            ],
                        ),
                        array(
                            'name'  => 'show_sub_total',
                            'label' => esc_html__('Show Sub Total','organify'),
                            'type'  => \Elementor\Controls_Manager::SWITCHER,
                            'default'   => 'true',
                            'description'   => 'Display outside site!'
                        ),
                        array(
                            'name'  => 'heading_subtotal',
                            'label' => esc_html__('Sub Total','organify'),
                            'type'  => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                            'condition' => [
                                'show_sub_total' => 'true',
                            ],
                        ),
                        array(
                            'name' => 'subtotal_color',
                            'label' => esc_html__('Color', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-cart .pxl-sub--total' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'show_sub_total' => 'true',
                            ],
                        ),
                        array(
                            'name' => 'subtotal_typography',
                            'label' => esc_html__('Typography', 'organify' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-cart .pxl-sub--total',
                            'condition' => [
                                'show_sub_total' => 'true',
                            ],
                        ),

                    ),
),
),
),
),
organify_get_class_widget_path()
);