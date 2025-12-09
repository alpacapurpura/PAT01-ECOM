<?php
$templates_df = ['0' => esc_html__('None', 'organify')];
$templates = $templates_df + organify_get_templates_option('page') ;
pxl_add_custom_widget(
    array(
        'name' => 'pxl_button_2',
        'title' => esc_html__('Case Button 2', 'organify' ),
        'icon' => 'eicon-button',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'btn_style',
                            'label' => esc_html__('Type', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'btn-default',
                            'options' => [
                                'btn-default' => esc_html__('Default', 'organify' ),
                                'btn-text-underline' => esc_html__('Text Underline', 'organify' ),
                                'btn-gradient-rotate' => esc_html__('Gradient Rotate', 'organify' ),
                                'btn-gradient-horizontal' => esc_html__('Gradient Horizontal 1', 'organify' ),
                                'btn-gradient-horizontal2' => esc_html__('Gradient Horizontal 2', 'organify' ),
                                'btn-icon-box' => esc_html__('Icon Box 1', 'organify' ),
                                'btn-icon-box2' => esc_html__('Icon Box 2', 'organify' ),
                                'btn-icon-box3' => esc_html__('Icon Box 3', 'organify' ),
                                'btn-icon-box4' => esc_html__('Icon Box 4', 'organify' ),
                            ],
                        ),
                        array(
                            'name'  => "pxl_button_rp",
                            'label' => esc_html__('Button','organify'),
                            'type'  => \Elementor\Controls_Manager::REPEATER,
                            'controls'  => array(
                               array(
                                'name' => 'text',
                                'label' => esc_html__('Text', 'organify' ),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'default' => esc_html__('Click Here', 'organify'),
                            ),
                               array(
                                'name' => 'link',
                                'label' => esc_html__('Link', 'organify' ),
                                'type' => \Elementor\Controls_Manager::URL,
                                'default' => [
                                    'url' => '#',
                                ],
                            ),
                           ),
                            'title_field' => '{{{ text }}}',

                        ),
                        

                        array(
                            'name' => 'gap_btn',
                            'label' => esc_html__('Gap', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units'   => ['px','custom'],
                            'options'      => [
                                'px'    => [
                                    'min'   => 0,
                                    'max'   => 100,
                                ],
                            ], 
                            'selectors'         => [
                                '{{WRAPPER}} .pxl-button' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'btn_icon',
                            'label' => esc_html__('Icon', 'organify' ),
                            'type' => \Elementor\Controls_Manager::ICONS,
                            'label_block' => true,
                            'fa4compatibility' => 'icon',
                        ),
                        array(
                            'name' => 'icon_align',
                            'label' => esc_html__('Icon Position', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'left',
                            'options' => [
                                'left' => esc_html__('Before', 'organify' ),
                                'right' => esc_html__('After', 'organify' ),
                            ],
                        ),
                    ),
),

array(
    'name' => 'section_style_button',
    'label' => esc_html__('Button Normal', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array_merge(
        array(
            array(
                'name' => 'color',
                'label' => esc_html__('Color', 'organify' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pxl-button .btn' => 'color: {{VALUE}};',
                ],
            ),
            array(
                'name' => 'btn_bg_color',
                'label' => esc_html__('Background Color', 'organify' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pxl-button .btn' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'btn_style!' => ['btn-text-underline','btn-gradient-rotate','btn-gradient-horizontal','btn-gradient-horizontal2'],
                ],
            ),

            array(
                'name' => 'btn_typography',
                'label' => esc_html__('Typography', 'organify' ),
                'type' => \Elementor\Group_Control_Typography::get_type(),
                'control_type' => 'group',
                'selector' => '{{WRAPPER}} .pxl-button .btn',
            ),
            array(
                'name'         => 'btn_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'organify' ),
                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                'control_type' => 'group',
                'selector'     => '{{WRAPPER}} .pxl-button .btn',
            ),
            array(
                'name' => 'border_type',
                'label' => esc_html__( 'Border Type', 'organify' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'None', 'organify' ),
                    'solid' => esc_html__( 'Solid', 'organify' ),
                    'double' => esc_html__( 'Double', 'organify' ),
                    'dotted' => esc_html__( 'Dotted', 'organify' ),
                    'dashed' => esc_html__( 'Dashed', 'organify' ),
                    'groove' => esc_html__( 'Groove', 'organify' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-button .btn' => 'border-style: {{VALUE}} !important;',
                ],
                'condition' => [
                    'btn_style' => ['btn-default'],
                ],
            ),
            array(
                'name' => 'border_width',
                'label' => esc_html__( 'Border Width', 'organify' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .pxl-button .btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'border_type!' => '',
                    'btn_style' => ['btn-default'],
                ],
                'responsive' => true,
            ),
            array(
                'name' => 'border_color',
                'label' => esc_html__( 'Border Color', 'organify' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pxl-button .btn' => 'border-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'border_type!' => '',
                    'btn_style' => ['btn-default'],
                ],
            ),
        ),

        array(
            array(
                'name' => 'btn_border_radius',
                'label' => esc_html__('Border Radius', 'organify' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-button .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ),
            array(
                'name' => 'btn_padding',
                'label' => esc_html__('Padding', 'organify' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-button .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'control_type' => 'responsive',
            ),
            array(
                'name' => 'text_inner_margin',
                'label' => esc_html__('Text Inner Margin', 'organify' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-button .btn .pxl--btn-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'control_type' => 'responsive',
            ),
            array(
                'name' => 'btn_full_width',
                'label' => esc_html__( 'Full Width', 'organify' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'btn-block-inline' => esc_html__( 'No', 'organify' ),
                    'btn-block' => esc_html__( 'Yes', 'organify' ),
                ],
                'default' => 'btn-block-inline',
            ),
        )
    ),
),

array(
    'name' => 'section_style_button_hover',
    'label' => esc_html__('Button Hover', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'color_hover',
            'label' => esc_html__('Color Hover', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-button .btn:hover, {{WRAPPER}} .pxl-button .btn:focus' => 'color: {{VALUE}};',
                '{{WRAPPER}} .pxl-button .btn:hover svg path' => 'stroke: {{VALUE}} !important;',
            ],
        ),
        array(
            'name' => 'btn_bg_color_hover',
            'label' => esc_html__('Background Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-button .btn:hover, {{WRAPPER}} .pxl-button .btn:focus' => 'background: {{VALUE}};',
            ],
            'condition' => [
                'btn_style!' => ['btn-text-underline','btn-gradient-rotate','btn-gradient-horizontal','btn-gradient-horizontal2'],
            ],
        ),

        array(
            'name' => 'border_type_hover',
            'label' => esc_html__( 'Border Type', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '' => esc_html__( 'None', 'organify' ),
                'solid' => esc_html__( 'Solid', 'organify' ),
                'double' => esc_html__( 'Double', 'organify' ),
                'dotted' => esc_html__( 'Dotted', 'organify' ),
                'dashed' => esc_html__( 'Dashed', 'organify' ),
                'groove' => esc_html__( 'Groove', 'organify' ),
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-button .btn:hover' => 'border-style: {{VALUE}} !important;',
            ],
            'condition' => [
                'btn_style' => ['btn-default'],
            ],
        ),
        array(
            'name' => 'border_width_hover',
            'label' => esc_html__( 'Border Width', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors' => [
                '{{WRAPPER}} .pxl-button .btn:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
            ],
            'condition' => [
                'border_type_hover!' => '',
                'btn_style' => ['btn-default'],
            ],
            'responsive' => true,
        ),
        array(
            'name' => 'border_color_hover',
            'label' => esc_html__( 'Border Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .pxl-button .btn:hover' => 'border-color: {{VALUE}} !important;',
            ],
            'condition' => [
                'border_type_hover!' => '',
                'btn_style' => ['btn-default'],
            ],
        ),

        array(
            'name' => 'btn_border_radius_hover',
            'label' => esc_html__('Border Radius', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px' ],
            'selectors' => [
                '{{WRAPPER}} .pxl-button .btn:hover, {{WRAPPER}} .pxl-button .btn:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ),

        array(
            'name'         => 'btn_box_shadow_hover',
            'label' => esc_html__( 'Box Shadow', 'organify' ),
            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
            'control_type' => 'group',
            'selector'     => '{{WRAPPER}} .pxl-button .btn:hover, {{WRAPPER}} .pxl-button .btn:focus',
        ),

        array(
            'name' => 'btn_text_effect',
            'label' => esc_html__('Text Effect', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '',
            'options' => [
                '' => esc_html__('Default', 'organify' ),
                'btn-text-nina' => esc_html__('Nina', 'organify' ),
                'btn-text-nanuk' => esc_html__('Nanuk', 'organify' ),
                'btn-text-parallax' => esc_html__('Parallax', 'organify' ),
            ],
        ),
    ),
),

array(
    'name' => 'section_style_icon',
    'label' => esc_html__('Icon', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'icon_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-button .btn .pxl--btn-icon' => 'color: {{VALUE}};',
                '{{WRAPPER}} .pxl-button .btn svg path' => 'stroke: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'icon_font_size',
            'label' => esc_html__('Font Size', 'organify' ),
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
                '{{WRAPPER}} .pxl-button .btn .pxl--btn-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .pxl-button .btn svg' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ),
        array(
            'name' => 'icon_space_left',
            'label' => esc_html__('Icon Spacer', 'organify' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'default' => [
                'size' => 9,
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-button .pxl-icon--left .pxl--btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'icon_align' => ['left'],
            ],
        ),
        array(
            'name' => 'icon_space_right',
            'label' => esc_html__('Icon Spacer', 'organify' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'default' => [
                'size' => 9,
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-button .pxl-icon--right .pxl--btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'icon_align' => ['right'],
            ],
        ),
        array(
            'name' => 'icon_box_color',
            'label' => esc_html__( 'Box Color Main', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .btn.pxl-icon-active .pxl--btn-icon' => 'background-color: {{VALUE}};--gradient-color-from2: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'icon_box_color_gradient',
            'label' => esc_html__( 'Box Color Gradient', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .btn.pxl-icon-active .pxl--btn-icon' => '--gradient-color-to2: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'icon_box_width',
            'label' => esc_html__('Box Width', 'organify' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .btn.pxl-icon-active .pxl--btn-icon' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ),
        array(
            'name' => 'icon_box_height',
            'label' => esc_html__('Box Height', 'organify' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .btn.pxl-icon-active .pxl--btn-icon' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ),
        array(
            'name' => 'icon_border_radius',
            'label' => esc_html__('Border Radius', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px' ],
            'selectors' => [
                '{{WRAPPER}} .btn.pxl-icon-active .pxl--btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ),
        array(
            'name' => 'icon_margin',
            'label' => esc_html__('Margin', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px' ],
            'selectors' => [
                '{{WRAPPER}} .btn.pxl-icon-active .pxl--btn-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'control_type' => 'responsive',
        ),
    ),
),
organify_widget_animation_settings(),
),
),
),
organify_get_class_widget_path()
);