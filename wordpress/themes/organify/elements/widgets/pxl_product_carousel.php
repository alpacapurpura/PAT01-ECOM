<?php
$post_term_options = pxl_get_grid_term_options('product');
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_carousel',
        'title' => esc_html__('Case Product Carousel', 'organify' ),
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
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_product_carousel/img-layout/layout1.jpg'
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
                            'name'  => 'title_product_carousel',
                            'label' => esc_html__('Heading','organify'),
                            'type'  => \Elementor\Controls_Manager::TEXTAREA,
                            'description' => 'Create Typewriter text width shortcode: [typewriter text="Text1, Text2"], Highlight text with shortcode: [highlight text="Text"] and Highlight image with shortcode: [highlight_image id_image="123"]',
                        ),
                        array(
                            'name'    => 'query_type',
                            'label'   => esc_html__( 'Select Query Type', 'organify' ),
                            'type'    => 'select',
                            'default' => 'recent_product',
                            'options' => [
                                'recent_product'   => esc_html__( 'Recent Products', 'organify' ),
                                'best_selling'     => esc_html__( 'Best Selling', 'organify' ),
                                'featured_product' => esc_html__( 'Featured Products', 'organify' ),
                                'top_rate'         => esc_html__( 'High Rate', 'organify' ),
                                'on_sale'          => esc_html__( 'On Sale', 'organify' ),
                                'recent_review'    => esc_html__( 'Recent Review', 'organify' ),
                                'deals'            => esc_html__( 'Product Deals', 'organify' ),
                                'separate'         => esc_html__( 'Product separate', 'organify' ),
                            ]
                        ),
                        array(
                            'name' => 'source',
                            'label' => esc_html__('Select Categories', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SELECT2,
                            'multiple' => true,
                            'options' => pxl_get_product_grid_term_options(),
                        ),
                        array(
                            'name' => 'limit',
                            'label' => esc_html__('Total items', 'organify' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => '4',
                        ),
                        array(
                            'name'  => 'max_height',
                            'label' => esc_html__('Max Height','organify'),
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
                                '{{WRAPPER}} .pxl-product-carousel .swiper-vertical' => 'max-height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),

                array(
                    'name'  => 'section_display',
                    'label' => esc_html__('Display','organify'),
                    'tab'   => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls'  => array(
                        array(
                            'name' => 'show_category',
                            'label' => esc_html__('Show Category', 'organify'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'false',
                        ),
                        array(
                            'name' => 'show_rating',
                            'label' => esc_html__('Show Rating', 'organify'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
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
                            'default' => 'false',
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
    'name' => 'tab_style_general',
    'label' => esc_html__('General', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'heading_color',
            'label' => esc_html__('Heading Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-title--carousel' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'heading_typography',
            'label' => esc_html__('Heading Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-product-carousel .pxl-title--carousel',
        ),
        array(
            'name' => 'border_color_heading',
            'label' => esc_html__('Border Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-title--carousel' => 'border-color: {{VALUE}};',
            ],
        ),

        array(
            'name'  => 'heading_arrow',
            'label' => esc_html__('Arrows','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'arrows' => 'true',
            ],
        ),
        array(
            'name' => 'color_arrows',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-swiper-arrow-wrap .pxl-swiper-arrow' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'arrows' => 'true',
            ],
        ),
        array(
            'name' => 'color_arrows_hv',
            'label' => esc_html__('Color Hover', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-swiper-arrow-wrap .pxl-swiper-arrow:hover' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'arrows' => 'true',
            ],
        ),
        array(
            'name' => 'background_arrows',
            'label' => esc_html__('Background Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-swiper-arrow-wrap .pxl-swiper-arrow' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'arrows' => 'true',
            ],
        ),
        array(
            'name' => 'background_arrows_hv',
            'label' => esc_html__('Background Color Hover', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-swiper-arrow-wrap .pxl-swiper-arrow:hover' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'arrows' => 'true',
            ],
        ),
        array(
            'name' => 'arrows_border',
            'label' => esc_html__(' Border', 'organify' ),
            'type' => \Elementor\Group_Control_Border::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-product-carousel .pxl-swiper-arrow-wrap .pxl-swiper-arrow',
            'condition' => [
                'arrows' => 'true',
            ],
        ),
        array(
            'name' => 'arrows_border_hv',
            'label' => esc_html__('Border Color Hover', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-swiper-arrow-wrap.ps-2 .pxl-swiper-arrow:hover' => 'border-color: {{VALUE}};',
            ],
        ),
    ),
),
array(
    'name' => 'tab_style_product',
    'label' => esc_html__('Product', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
     array(
        'name'  => 'bg_color_image',
        'label' => esc_html__('Background Color Image','organify'),
        'type'  => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .pxl-product-carousel .swiper-vertical .pxl-product-header' => 'background-color: {{VALUE}};',
        ],
    ),
     array(
        'name'  => 'bg_color_image_hv',
        'label' => esc_html__('Background Color Image Hover','organify'),
        'type'  => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .pxl-product-carousel .swiper-vertical .pxl-item--inner:hover .pxl-product-header' => 'background-color: {{VALUE}};',
        ],
    ),
     array(
        'name'  => 'bg_color_item',
        'label' => esc_html__('Background Color Item','organify'),
        'type'  => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .pxl-product-carousel .swiper-vertical .pxl-item--inner ' => 'background-color: {{VALUE}};',
        ],
    ),
     array(
        'name'  => 'background_color_prd_hv',
        'label' => esc_html__('Backgorund Color Item Hover','organify'),
        'type'  => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .pxl-product-carousel .swiper-vertical .pxl-item--inner:hover .pxl-item--inner' => 'background-color: {{VALUE}};',
        ],
    ),

     array(
        'name'  => 'heading_category',
        'label' => esc_html__('Category','organify'),
        'type'  => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
            'show_category' => 'true',
        ],
    ),
     array(
        'name' => 'category_color',
        'label' => esc_html__('Category Color', 'organify' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .pxl-product-carousel .swiper-vertical .product-category a' => 'color: {{VALUE}};',
        ],
        'condition' => [
            'show_category' => 'true',
        ],
    ),
     array(
        'name' => 'category_typography',
        'label' => esc_html__('Typography', 'organify' ),
        'type' => \Elementor\Group_Control_Typography::get_type(),
        'control_type' => 'group',
        'selector' => '{{WRAPPER}} .pxl-product-carousel .swiper-vertical .product-category a',
        'condition' => [
            'show_category' => 'true',
        ],
    ),

     array(
        'name'  => 'heading_title',
        'label' => esc_html__('Title','organify'),
        'type'  => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
    ),
     array(
        'name'  => 'space_top_title',
        'label' => esc_html__('Space Top','organify'),
        'type'  => \Elementor\Controls_Manager::SLIDER,
        'control_type' => 'responsive',
        'size_units' => [ 'px', 'custom' ],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 300,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .pxl-product-carousel .woocommerce-product--title' => 'margin-top: {{SIZE}}{{UNIT}};',
        ],
    ),
     array(
        'name'  => 'space_bottom_title',
        'label' => esc_html__('Space Bottom','organify'),
        'type'  => \Elementor\Controls_Manager::SLIDER,
        'control_type' => 'responsive',
        'size_units' => [ 'px', 'custom' ],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 300,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .pxl-product-carousel .woocommerce-product--title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
    ),
     array(
        'name' => 'title_color',
        'label' => esc_html__('Title Color', 'organify' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .pxl-product-carousel .swiper-vertical .woocommerce-product--title a' => 'color: {{VALUE}};',
        ],
    ),
     array(
        'name' => 'title_typography',
        'label' => esc_html__('Typography', 'organify' ),
        'type' => \Elementor\Group_Control_Typography::get_type(),
        'control_type' => 'group',
        'selector' => '{{WRAPPER}} .pxl-product-carousel .swiper-vertical .woocommerce-product--title',
    ),
 ),
),
array(
    'name' => 'tab_style_price',
    'label' => esc_html__('Price', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name'  => 'space_bottom_price',
            'label' => esc_html__('Space Bottom','organify'),
            'type'  => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px', 'custom' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .woocommerce-product--price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ),
        array(
            'name' => 'price_color',
            'label' => esc_html__('Price Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .swiper-vertical .woocommerce-product--price .price ins' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'price_typography',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-product-carousel .swiper-vertical .woocommerce-product--price .price ins',
        ),

        array(
            'name'  => 'heading_sale',
            'label' => esc_html__('Sale','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name' => 'sale_color',
            'label' => esc_html__('Title Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .swiper-vertical .woocommerce-product--price .price del' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'sale_typography',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-product-carousel .swiper-vertical .woocommerce-product--price .price del',
        ),
    ),
),

array(
    'name' => 'tab_style_rating',
    'label' => esc_html__('Rating', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(

        array(
            'name'  => 'heading_rating',
            'label' => esc_html__('Rating','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name' => 'rating_color',
            'label' => esc_html__('Rating Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .star-rating span::before' => 'color: {{VALUE}};',
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