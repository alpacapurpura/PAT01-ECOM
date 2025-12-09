<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_list_dropdown',
        'title' => esc_html__('Case List Drop Down', 'organify'),
        'icon' => 'eicon-editor-list-ul',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Drop Down', 'organify'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(

                        array(
                            'name' => 'title',
                            'label' => esc_html__('Title', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'rows' => 10,
                            'show_label' => false,
                        ),
                        array(
                            'name' => 'icon_type',
                            'label' => esc_html__('Icon Type', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'icon' => 'Icon',
                                'image' => 'Image',
                            ],
                            'default' => 'icon',
                        ),
                        array(
                            'name' => 'pxl_icon',
                            'label' => esc_html__('Icon', 'organify' ),
                            'type' => \Elementor\Controls_Manager::ICONS,
                            'fa4compatibility' => 'icon',
                            'condition' => [
                                'icon_type' => 'icon',
                            ],
                        ),
                        array(
                            'name' => 'icon_image',
                            'label' => esc_html__( 'Icon Image', 'organify' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'condition' => [
                                'icon_type' => 'image',
                            ],
                        ),
                        array(
                            'name' => 'lists',
                            'label' => esc_html__('Content', 'organify'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(

                                array(
                                    'name' => 'content',
                                    'label' => esc_html__('Content', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'rows' => 10,
                                    'show_label' => false,
                                ),
                                array(
                                    'name' => 'link',
                                    'label' => esc_html__('Link', 'organify'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'label_block' => true,
                                ),
                            ),
                            'title_field' => '{{{ content }}}',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_inner',
                    'label' => esc_html__('Inner', 'organify'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name'  => 'heading_icon',
                            'label' => esc_html__('Icon','organify'),
                            'type'  => \Elementor\Controls_Manager::HEADING,
                        ),
                        array(
                            'name'  => 'icon_color',
                            'label' => esc_html__('Icon Color','organify'),
                            'type'  => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list-dropdown .pxl-item--icon i'  => 'color: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name'  => 'icon_color_hv',
                            'label' => esc_html__('Icon Color Hover','organify'),
                            'type'  => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list-dropdown:hover .pxl-item--icon i'  => 'color: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name' => 'icon_font_size',
                            'label' => esc_html__('Icon Font Size', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px','custom' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list-dropdown .pxl-item--icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'item_gap',
                            'label' => esc_html__('Gap', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px','custom' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list-dropdown .pxl-item--inner' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'  => 'heading_title',
                            'label' => esc_html__('Title','organify'),
                            'type'  => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                        ),
                        array(
                            'name'  => 'title_color',
                            'label' => esc_html__('Title Color','organify'),
                            'type'  => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list-dropdown .pxl-item--title'  => 'color: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name'  => 'title_color_hv',
                            'label' => esc_html__('Title Color Hover','organify'),
                            'type'  => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list-dropdown:hover .pxl-item--title'  => 'color: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name'         => 'typography_title',
                            'label' => esc_html__( 'Typography Title', 'organify' ),
                            'type'         => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .pxl-list-dropdown .pxl-item--title',
                        ),
                    ),
), 

array(
    'name' => 'section_style_dropdown',
    'label' => esc_html__('Drop Down', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name'  => 'dropdown_content_color',
            'label' => esc_html__('Content Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-list-dropdown .pxl--item a'  => 'color: {{VALUE}};',
                '{{WRAPPER}} .pxl-list-dropdown .pxl-content a::before'  => 'background: {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'dropdown_content_color_hv',
            'label' => esc_html__('Content Color Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-list-dropdown .pxl--item a:hover'  => 'color: {{VALUE}};',
                '{{WRAPPER}} .pxl-list-dropdown .pxl-content a:hover::before'  => 'background: {{VALUE}};',
            ],
        ),
        array(
            'name'         => 'typography_content_dropdown',
            'label' => esc_html__( 'Content Title', 'organify' ),
            'type'         => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector'     => '{{WRAPPER}} .pxl-list-dropdown .pxl--item a',
        ),
        array(
            'name'  => 'background_color_dropdown',
            'label' => esc_html__('Background Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-list-dropdown .pxl-item--dropdown'  => 'background-color: {{VALUE}};'
            ],
        ),
        array(
            'name' => 'padding_dropdown',
            'label' => esc_html__('Padding', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px' ],
            'selectors' => [
                '{{WRAPPER}} .pxl-list-dropdown .pxl-item--dropdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'control_type' => 'responsive',
        ),
        array(
            'name' => 'border_radius_dropdown',
            'label' => esc_html__('Border Radius', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px','custom' ],
            'selectors' => [
                '{{WRAPPER}} .pxl-list-dropdown .pxl-item--dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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