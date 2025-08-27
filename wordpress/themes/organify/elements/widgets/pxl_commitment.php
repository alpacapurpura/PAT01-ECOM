<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_commitment',
        'title' => esc_html__('Case Commitment', 'organify' ),
        'icon' => 'eicon-info-box',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
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
                        ),
                        array(
                            'name' => 'desc',
                            'label' => esc_html__('Description', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'commitment',
                            'label' => esc_html__('Commitment', 'organify'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'title_commitment',
                                    'label' => esc_html__('Title', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'desc_commitment',
                                    'label' => esc_html__('Description', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'default'   => 'Browse Our Shop',
                                    'label_block' => true,
                                ),
                            ),
                        ),
                        array(
                            'name' => 'button_text',
                            'label' => esc_html__('Text Button', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
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
                ),
                array(
                    'name' => 'section_style_title',
                    'label' => esc_html__('Title', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'title_tag',
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
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-commitment .pxl-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Typography', 'organify' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-commitment .pxl-title',
                        ),
                        array(
                            'name' => 'pxl_animate',
                            'label' => esc_html__('Case Animate', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => organify_widget_animate_v2(),
                            'default' => '',
                        ),
                        array(
                            'name' => 'pxl_animate_delay',
                            'label' => esc_html__('Animate Delay', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '0',
                            'description' => 'Enter number. Default 0ms',
                        ),
                    ),
                ),

                array(
                    'name' => 'section_style_desc',
                    'label' => esc_html__('Description', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'desc_color',
                            'label' => esc_html__('Description Color', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-commitment .pxl-desc' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'desc_typography',
                            'label' => esc_html__('Typography', 'organify' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-commitment .pxl-desc',
                        ),
                    ),
                ),

                array(
                    'name' => 'section_style_commitment',
                    'label' => esc_html__('Commitment', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name'  => 'heading_title_comm',
                            'label' => esc_html__('Title Commitment','organify'),
                            'type'  => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                        ),
                        array(
                            'name' => 'title_comm_color',
                            'label' => esc_html__('Title Color', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-commitment .pxl-ordinal--numbers .pxl-title--commit' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_comm_typography',
                            'label' => esc_html__('Typography', 'organify' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-commitment .pxl-ordinal--numbers .pxl-title--commit',
                        ),

                        array(
                            'name'  => 'heading_desc_comm',
                            'label' => esc_html__('Description Commitment','organify'),
                            'type'  => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                        ),
                        array(
                            'name' => 'desc_comm_color',
                            'label' => esc_html__('Description Color', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-commitment .pxl-desc--commit' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'desc_comm_typography',
                            'label' => esc_html__('Typography', 'organify' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-commitment .pxl-desc--commit',
                        ),
                        array(
                            'name'  => 'heading_ordinal_numbers',
                            'label' => esc_html__('Ordinal Numbers','organify'),
                            'type'  => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                        ),
                        array(
                            'name' => 'ordinal_numbers_color',
                            'label' => esc_html__('Ordinal Numbers Color', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-commitment .pxl-ordinal--numbers' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'ordinal_numbers_typography',
                            'label' => esc_html__('Typography', 'organify' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-commitment .pxl-ordinal--numbers',
                        ),
                    ),
                ),

array(
    'name' => 'section_style_btn',
    'label' => esc_html__('Button', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'button_color',
            'label' => esc_html__('Text Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-commitment .pxl--button' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'button_bg_color',
            'label' => esc_html__('Background Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-commitment .pxl--button' => 'background: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'button_typography',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-commitment .pxl--button',
        ),
        array(
            'name' => 'button_padding',
            'label' => esc_html__('Padding', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px' ],
            'selectors' => [
                '{{WRAPPER}} .pxl-commitment .pxl--button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'control_type' => 'responsive',
        ),
        array(
            'name' => 'button_border_radius',
            'label' => esc_html__('Border Radius', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px' ],
            'selectors' => [
                '{{WRAPPER}} .pxl-commitment .pxl--button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'control_type' => 'responsive',
        ),
    ),
),

),
),
),
organify_get_class_widget_path()
);