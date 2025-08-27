<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_icon_search',
        'title' => esc_html__('Case Search', 'organify' ),
        'icon' => 'eicon-search',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'email_placefolder',
                            'label' => esc_html__('Email Placefolder', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'condition' => [
                                'search_type' => ['form'],
                            ],
                        ),
                        
                        array(
                            'name' => 'pxl_icon',
                            'label' => esc_html__('Icon', 'organify' ),
                            'type' => \Elementor\Controls_Manager::ICONS,
                            'fa4compatibility' => 'icon',
                        ),
                        
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-search-popup-button i' => 'color: {{VALUE}} !important;',
                                '{{WRAPPER}} .pxl-search-popup-button svg path' => 'stroke: {{VALUE}} !important;',
                            ],
                            'condition' => [
                                'search_type' => ['popup'],
                            ],
                        ),

                        array(
                            'name' => 'text_color',
                            'label' => esc_html__('Text Color', 'organify' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-search input[type="text"]' => 'color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'text_typography',
                            'label' => esc_html__('Typography', 'organify' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-search input[type="text"]',
                        ),
                        array(
                            'name' => 'gap',
                            'label' => esc_html__('Gap', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-search .searchform-wrap' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    organify_get_class_widget_path()
);