<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_categories_carousel',
        'title' => esc_html__('Case Product Categories Carousel', 'organify' ),
        'icon' => 'eicon-product-categories',
        'categories' => array('pxltheme-core'),
        'scripts' => [
            'swiper',
            'pxl-swiper',
        ],
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
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_product_categories_carousel/layout1.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_source',
                    'label' => esc_html__('Source', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name'  => 'title_categories',
                            'label' => esc_html__('Title','organify'),
                            'type'  => \Elementor\Controls_Manager::TEXTAREA,
                            'label_block'  => true,
                            'default'   => 'Featured Categories',
                            'description' => 'Create Typewriter text width shortcode: [typewriter text="Text1, Text2"], Highlight text with shortcode: [highlight text="Text"]',
                        ),
                        array(
                            'name' => 'orderby',
                            'label' => esc_html__('Order By', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'date',
                            'options' => [
                                'date' => esc_html__('Date', 'organify' ),
                                'ID' => esc_html__('ID', 'organify' ),
                                'author' => esc_html__('Author', 'organify' ),
                                'title' => esc_html__('Title', 'organify' ),
                                'rand' => esc_html__('Random', 'organify' ),
                            ],
                        ),
                        array(
                            'name' => 'order',
                            'label' => esc_html__('Sort Order', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'desc',
                            'options' => [
                                'desc' => esc_html__('Descending', 'organify' ),
                                'asc' => esc_html__('Ascending', 'organify' ),
                            ],
                        ),
                        array(
                            'name' => 'limit',
                            'label' => esc_html__('Total items', 'organify' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => '4',
                        ),

                        array(
                            'name' => 'show_category',
                            'label' => esc_html__('Show Category', 'organify'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'show_count',
                            'label' => esc_html__('Show Count', 'organify'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
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
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .item--content' => 'text-align: {{VALUE}}; justify-content: {{VALUE}};',
                        ],
                    ),
                    ),
),
array(
    'name' => 'section_carousel',
    'label' => esc_html__('Carousel', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
    'controls' => array(
        array(
            'name' => 'img_size',
            'label' => esc_html__('Image Size', 'organify' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'description' => 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).',
        ),
        array(
            'name' => 'col_xs',
            'label' => esc_html__('Columns XS Devices', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '1',
            'options' => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '6' => '6',
            ],
        ),
        array(
            'name' => 'col_sm',
            'label' => esc_html__('Columns SM Devices', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '2',
            'options' => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '6' => '6',
            ],
        ),
        array(
            'name' => 'col_md',
            'label' => esc_html__('Columns MD Devices', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '3',
            'options' => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '6' => '6',
            ],
        ),
        array(
            'name' => 'col_lg',
            'label' => esc_html__('Columns LG Devices', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '3',
            'options' => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
            ],
        ),
        array(
            'name' => 'col_xl',
            'label' => esc_html__('Columns XL Devices', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '4',
            'options' => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
            ],
        ),
        array(
            'name' => 'col_xxl',
            'label' => esc_html__('Columns XXL Devices', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'inherit',
            'options' => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                'inherit' => 'Inherit',
            ],
        ),
        array(
            'name' => 'slides_to_scroll',
            'label' => esc_html__('Slides to scroll', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '1',
            'options' => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
            ],
        ),
        array(
            'name' => 'item_padding',
            'label' => esc_html__('Item Padding', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px' ],
            'default' => [
                'top' => '15',
                'right' => '15',
                'bottom' => '15',
                'left' => '15'
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-container' => 'margin-top: -{{TOP}}{{UNIT}}; margin-right: -{{RIGHT}}{{UNIT}}; margin-bottom: -{{BOTTOM}}{{UNIT}}; margin-left: -{{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .pxl-swiper-container .pxl-swiper-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'control_type' => 'responsive',
        ),
        array(
            'name' => 'arrows',
            'label' => esc_html__('Show Arrows', 'organify'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'true',
        ),
        array(
            'name' => 'pause_on_hover',
            'label' => esc_html__('Pause on Hover', 'organify'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'true',
        ),
        array(
            'name' => 'autoplay',
            'label' => esc_html__('Autoplay', 'organify'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'false',
        ),
        array(
            'name' => 'autoplay_speed',
            'label' => esc_html__('Autoplay Speed', 'organify'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 5000,
            'condition' => [
                'autoplay' => 'false'
            ]
        ),
        array(
            'name' => 'infinite',
            'label' => esc_html__('Infinite Loop', 'organify'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'true',
        ),
        array(
            'name' => 'speed',
            'label' => esc_html__('Animation Speed', 'organify'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 500,
        ),
    ),
),
array(
    'name' => 'section_style_general',
    'label' => esc_html__('General', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'style_item',
            'label' => esc_html__('Style Item', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'bullets',
            'options' => [
                'item-style-1' => 'Style 1',
                'item-style-2' => 'Style 2',
            ],
            'default'   => 'item-style-1',
        ),
        array(
            'name' => 'background_color',
            'label' => esc_html__('Background Color', 'organify' ),
            'type' => \Elementor\Group_Control_Background::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-product-categories-carousel .pxl-item--inner',
        ),

        array(
            'name'  => 'border_radius_item',
            'label' => esc_html__('Border Radius','organify'),
            'type'  => \Elementor\Controls_Manager::DIMENSIONS,
            'control_type'  => 'responsive',
            'size_units'    => ['px','custom'],
            'range' => [
                'px'    => [
                    'min'   => '0',
                    'max'   => '300',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-product-categories-carousel .pxl-item--inner'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
            ],
        ),
        
        array(
            'name'  => 'space_item',
            'label' => esc_html__('Spacer','organify'),
            'type'  => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px', 'custom' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-product-categories-carousel .pxl-title-categories' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ),
    ),
),

array(
    'name' => 'section_title',
    'label' => esc_html__('Title', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name'  => 'heading_title',
            'label' => esc_html__('Title','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name' => 'title_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-categories-carousel .pxl-title-categories' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-product-categories-carousel .pxl-title-categories',
        ),

        array(
            'name'  => 'heading_title_highlight',
            'label' => esc_html__('Title Highlight','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name' => 'title_color_highlight',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-categories-carousel .pxl-title-categories .pxl-title--highlight' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'title_typography_highlight',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-product-categories-carousel .pxl-title-categories .pxl-title--highlight',
        ),
        array(
            'name' => 'pxl_animate_tt',
            'label' => esc_html__('Case Animate', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => organify_widget_animate_v2(),
            'default' => '',
        ),
        array(
            'name' => 'pxl_animate_delay_tt',
            'label' => esc_html__('Animate Delay', 'organify' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '0',
            'description' => 'Enter number. Default 0ms',
        ),

    ),
),


array(
    'name' => 'section_inner',
    'label' => esc_html__('Inner', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name'  => 'space_inner',
            'label' => esc_html__('Spacer','organify'),
            'type'  => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px', 'custom' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-product-categories-carousel .item--content' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ),
        array(
            'name'  => 'heading_category',
            'label' => esc_html__('Category','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name' => 'categories_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-categories-carousel .item--content .item--title' => 'color: {{VALUE}};',
            ],
        ),

        array(
            'name' => 'categories_color_hv',
            'label' => esc_html__('Color Hover', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-categories-carousel .pxl-swiper-slide:hover .item--content .item--title' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'categories_typography',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-product-categories-carousel .item--content .item--title',
        ),


        array(
            'name'  => 'heading_count',
            'label' => esc_html__('Count','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name' => 'count_cate_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-categories-carousel .item--content .item--count' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'count_categories_typography',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-product-categories-carousel .item--content .item--count',
        ),
    ),
),

array(
    'name' => 'section_style_hover',
    'label' => esc_html__('Hover', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'background_color_hv',
            'label' => esc_html__('Background Color Hover', 'organify' ),
            'type' => \Elementor\Group_Control_Background::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-product-categories-carousel .pxl-item--inner::before',
        ),
        array(
            'name' => 'box_shadow_item_hv',
            'label' => esc_html__('Box Shadow Hover', 'organify' ),
            'type' => \Elementor\Group_Control_Box_Shadow::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-product-categories-carousel .pxl-item--inner::before',
        ),
    ),
),


array(
    'name' => 'arrows_style',
    'label' => esc_html__('Arrows Style', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'arrows_color',
            'label' => esc_html__('Icon Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-categories-carousel1 .pxl-swiper-arrow-wrap .pxl-swiper-arrow i' => 'color: {{VALUE}};',
                '{{WRAPPER}} .pxl-product-categories-carousel1 .pxl-swiper-arrow-wrap .pxl-swiper-arrow' => 'border-color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'arrows_color_hover',
            'label' => esc_html__('Icon Color Hover', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-categories-carousel1 .pxl-swiper-arrow-wrap .pxl-swiper-arrow:hover i' => 'color: {{VALUE}};',
                '{{WRAPPER}} .pxl-product-categories-carousel1 .pxl-swiper-arrow-wrap .pxl-swiper-arrow:hover' => 'border-color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'bg_arrows_color',
            'label' => esc_html__('Background Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-categories-carousel1 .pxl-swiper-arrow-wrap .pxl-swiper-arrow' => 'background: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'bg_arrows_color_hover',
            'label' => esc_html__('Background Color Hover', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-categories-carousel1 .pxl-swiper-arrow-wrap .pxl-swiper-arrow:hover' => 'background: {{VALUE}};',
            ],
        ),


         array(
            'name' => 'border_arrows_color',
            'label' => esc_html__('Border Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-categories-carousel1 .pxl-swiper-arrow-wrap .pxl-swiper-arrow' => 'border-color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'border_arrows_color_hover',
            'label' => esc_html__('Border Color Hover', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-categories-carousel1 .pxl-swiper-arrow-wrap .pxl-swiper-arrow:hover' => 'border-color: {{VALUE}};',
            ],
        ),
    ),
),
organify_widget_animation_settings()
),
),
),
organify_get_class_widget_path()
);