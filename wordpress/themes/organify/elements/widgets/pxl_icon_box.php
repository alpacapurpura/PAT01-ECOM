<?php
// Register Icon Box Widget
pxl_add_custom_widget(
    array(
        'name' => 'pxl_icon_box',
        'title' => esc_html__('Case Icon Box', 'organify' ),
        'icon' => 'eicon-icon-box',
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
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_icon_box/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'organify' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_icon_box/layout2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__('Layout 3', 'organify' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_icon_box/layout3.jpg'
                                ],
                                '4' => [
                                    'label' => esc_html__('Layout 4', 'organify' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_icon_box/layout4.jpg'
                                ],
                                '5' => [
                                    'label' => esc_html__('Layout 5', 'organify' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_icon_box/layout5.jpg'
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
                            'condition' => [
                                'layout' => ['1','3','5'],
                            ],
                        ),
                        array(
                            'name' => 'desc',
                            'label' => esc_html__('Description', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'rows' => 10,
                            'show_label' => false,
                            'condition' => [
                                'layout' => ['1','4','5'],
                            ],
                        ),                                             
                        array(
                            'name' => 'item_link',
                            'label' => esc_html__('Item Link', 'organify' ),
                            'type' => \Elementor\Controls_Manager::URL,
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
                            'name' => 'wg_max_width',
                            'label' => esc_html__('Widget Max Width', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-icon-box' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
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
                            '{{WRAPPER}} .pxl-icon-box .pxl-item--main' => 'text-align: {{VALUE}}; justify-content: {{VALUE}};',
                        ],
                    ),
                    ),
),
array(
    'name' => 'section_style_general',
    'label' => esc_html__('General', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'condition' => [
        'layout' => ['1','5'],
    ],
    'controls' => array(
        array(
            'name' => 'style',
            'label' => esc_html__('Style', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'style-1' => 'Style 1',
                'style-2' => 'Style 2',
            ],
            'default' => 'style-1',
            'condition' => [
                'layout' => '1',
            ],
        ),
        array(
            'name' => 'style_layout_5',
            'label' => esc_html__('Style', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'style-1' => 'Style 1',
                'style-2' => 'Style 2',
                'style-3' => 'Style 3',
            ],
            'default' => 'style-1',
            'condition' => [
                'layout' => '5',
            ],
        ),
        array(
            'name' => 'item_border',
            'label' => esc_html__('Border', 'organify' ),
            'type' => \Elementor\Group_Control_Border::get_type(),
            'control_type' => 'group',                            
            'selector' => '{{WRAPPER}} .pxl-icon-box',
            'condition' => [
                'layout' => '1',
            ],
        ),
        array(
            'name' => 'item_border_radius',
            'label' => esc_html__('Border Radius', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'control_type' => 'responsive',
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-icon-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ',
            ],
            'condition' => [
                'layout' => '1',
            ],
        ),

        array(
            'name' => 'padding_item',
            'label' => esc_html__('Padding', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'control_type' => 'responsive',
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ',
            ],
            'condition' => [
                'layout' => '1',
            ],
        ),
        array(
            'name' => 'background_color_box',
            'label' => esc_html__('Background Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-icon-box' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'layout' => '1',
            ],
        ),
    ),
),
array(
    'name' => 'section_style_title',
    'label' => esc_html__('Title', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'condition' => [
        'layout' => ['1','3','4','5'],
    ],
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
            'default' => 'h5',
        ),
        array(
            'name' => 'title_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-icon-box .pxl-item--title' => 'color: {{VALUE}};',
            ],
        ),
        
        array(
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-icon-box .pxl-item--title',
        ),

        array(
            'name' => 'title_top_spacer',
            'label' => esc_html__('Top Spacer', 'organify' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 3000,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-icon-box .pxl-item--title' => 'margin-top: {{SIZE}}{{UNIT}} !important;',
            ],
        ),
        array(
            'name' => 'title_bottom_spacer',
            'label' => esc_html__('Bottom Spacer', 'organify' ),
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
                '{{WRAPPER}} .pxl-icon-box .pxl-item--title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
            ],
        ),
    ),
),
array(
    'name' => 'section_style_desc',
    'label' => esc_html__('Description', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'condition' => [
        'layout' => ['1','4','5'],
    ],
    'controls' => array(
        array(
            'name' => 'desc_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-icon-box .pxl-item--description' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'desc_typography',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-icon-box .pxl-item--description',
        ),
    ),
),
array(
    'name' => 'section_style_icon',
    'label' => esc_html__('Icon', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'icon_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon i' => 'color: {{VALUE}};text-fill-color: {{VALUE}};-webkit-text-fill-color: {{VALUE}};background-image: none;',
                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon svg path' => 'stroke:{{VALUE}};',
            ],
            'condition' => [
                'icon_type' => 'icon',
            ],
        ),
        array(
            'name' => 'icon_color_hv',
            'label' => esc_html__('Color Hover', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-icon-box:hover .pxl-item--icon i' => 'color: {{VALUE}};text-fill-color: {{VALUE}};-webkit-text-fill-color: {{VALUE}};background-image: none;',
            ],
            'condition' => [
                'icon_type' => 'icon',
            ],
        ),

        array(
            'name'  => 'type_bg_color',
            'label' => esc_html__('Type Background Color','organify'),
            'type'  => \Elementor\Controls_Manager::SELECT,
            'options'   => [
                ''      => 'Default',
                'bg-gradient1'  => 'Gradient 1',
                'bg-gradient2'  => 'Gradient 2',
            ],
            'default'   => '',
            'condition' => [
                'layout'    => ['2'],
            ],
        ),
        array(
            'name' => 'icon_bg_color',
            'label' => esc_html__('Background Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon' => 'background: {{VALUE}};',
            ],
            'condition' => [
                'icon_type' => 'icon',
                'layout'    => ['1','5'],
            ],
        ),


        array(
            'name' => 'icon_bg_color2',
            'label' => esc_html__('Background Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon a:after' => 'background: {{VALUE}};',
            ],
            'condition' => [
                'icon_type' => 'icon',
                'layout'    => ['2'],
                'type_bg_color'    => '',
            ],
        ),
        array(
            'name' => 'icon_bg_color4',
            'label' => esc_html__('Background Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon' => 'background: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => ['4'],
            ],
        ),
        array(
            'name'  => 'heading_icon_bg_gr',
            'label' => esc_html__('Background Color ', 'organify' ),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'icon_type' => 'icon',
                'layout'    => ['2'],
                'type_bg_color'    => ['bg-gradient1','bg-gradient2'],
            ],
        ),
        array(
            'name' => 'icon_bg_color_gr',
            'type' => \Elementor\Group_Control_Background::get_type(),
            'control_type'  => 'group',
            'selector' =>  '{{WRAPPER}} .pxl-icon-box .pxl-item--icon a:after' ,
            'condition' => [
                'icon_type' => 'icon',
                'layout'    => ['2'],
                'type_bg_color'    => ['bg-gradient1','bg-gradient2'],
            ],
        ),
        array(
            'name'  => 'heading_icon_border_gr',
            'label' => esc_html__('Border Color','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'icon_type' => 'icon',
                'layout'    => ['2'],
                'type_bg_color'    => ['bg-gradient1','bg-gradient2'],
            ],
        ),
        array(
            'name' => 'icon_border_color2',
            'label' => esc_html__('Border Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon a:before' => 'background: {{VALUE}};',
            ],
            'condition' => [
                'icon_type' => 'icon',
                'layout'    => ['2'],
                'type_bg_color'    => '',
            ],
        ),
        array(
            'name' => 'icon_border_gr_color2',
            'label' => esc_html__('Border Color ', 'organify' ),
            'type' => \Elementor\Group_Control_Background::get_type(),
            'control_type'  => 'group',
            'selector' =>  '{{WRAPPER}} .pxl-icon-box .pxl-item--icon a:before' ,
            'condition' => [
                'icon_type' => 'icon',
                'layout'    => ['2'],
                'type_bg_color'    => ['bg-gradient1','bg-gradient2'],
            ],
        ),


        array(
            'name' => 'icon_font_size',
            'label' => esc_html__('Size Icon', 'organify' ),
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
                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon svg' => 'height: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'icon_type' => 'icon',
            ],
        ),

         array(
            'name' => 'bg_icon_font_size',
            'label' => esc_html__('Size Background', 'organify' ),
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
                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'icon_type' => 'icon',
                'layout' => '1',
            ],
        ),


        array(
            'name' => 'icon_border_radius',
            'label' => esc_html__('Border Radius', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'control_type' => 'responsive',
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ',
            ],
            'condition' => [
                'icon_type' => 'icon',
                'layout'    => ['1','3','4','5'],
            ],
        ),
        array(
            'name' => 'icon_img_max_height',
            'label' => esc_html__('Image Max Height', 'organify' ),
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
                '{{WRAPPER}} .pxl-icon-box .pxl-item--icon img' => 'max-height: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'icon_type' => 'image',
            ],
        ),
        array(
            'name'  => 'icon_box_shadow_group',
            'label' => esc_html__('Box Shadow','organify'),
            'type'  => \Elementor\Group_Control_Box_Shadow::get_type(),
            'control_type'  => 'group',
            'selector'  => '{{WRAPPER}} .pxl-icon-box .pxl-item--icon',
            'condition' => [
                'icon_type' => 'icon',
                'layout'    => ['1','3','4','5'],
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