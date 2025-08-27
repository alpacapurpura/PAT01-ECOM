<?php
$pt_supports = ['product'];
$slides_to_show = range( 1, 10 );
$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
pxl_add_custom_widget(
    array(
        'name' => 'pxl_slide_home2',
        'title' => esc_html__('Case Slide Home - 2', 'organify'),
        'icon' => 'eicon-post-slider',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'swiper',
            'pxl-swiper',
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
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_slide_home2/layout1.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_content',
                    'label' => esc_html__('Content', 'organify'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'slide_home',
                            'label' => esc_html__('Content', 'organify'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'bg_image',
                                    'label' => esc_html__('Background Image', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                ),

                                array(
                                    'name'  => 'title',
                                    'label' => esc_html__('Title','organify'),
                                    'type'  => \Elementor\Controls_Manager::TEXTAREA,
                                    'description' => 'Create Typewriter text width shortcode: [typewriter text="Text1, Text2"], Highlight text with shortcode: [highlight text="Text"] and Highlight image with shortcode: [highlight_image id_image="123"]',
                                    'label_block'   => true,
                                ),
                                array(
                                    'name'  => 'concept',
                                    'label' => esc_html__('Concept','organify'),
                                    'type'  => \Elementor\Controls_Manager::TEXT,
                                    'label_block'   => true,
                                ),
                                array(
                                    'name'  => 'description',
                                    'label' => esc_html__('Description','organify'),
                                    'type'  => \Elementor\Controls_Manager::TEXTAREA,
                                    'label_block'   => true,
                                ), 
                                array(
                                    'name'  => 'text_button',
                                    'label' => esc_html__('Button','organify'),
                                    'type'  => \Elementor\Controls_Manager::TEXT,
                                    'label_block'   => true,
                                    'default'   => 'Purcharse Now',
                                ),
                                

                                array(
                                    'name' => 'button_link',
                                    'label' => esc_html__('Link Details', 'organify'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'default'   => [
                                        'url'   => '#',
                                    ],
                                    'label_block' => true,
                                ),


                                
                            ),

                        ),
                        array(
                            'name' => 'img_size',
                            'label' => esc_html__('Image Size', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'description' => 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).',
                        ),
                        array(
                            'name' => 'source',
                            'label' => esc_html__('Select Categories', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SELECT2,
                            'multiple' => true,
                            'options' => pxl_get_product_grid_term_options(),
                        ),
                        
                    ),
                ),

array(
    'name' => 'section_carousel_settings',
    'label' => esc_html__('Carousel Settings', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
    'controls' => array(


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
                '7' => '7',
                '8' => '8',
            ],
        ),
        array(
            'name' => 'arrows',
            'label' => esc_html__('Show Arrows', 'organify'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => false,
        ),

        array(
            'name' => 'pause_on_hover',
            'label' => esc_html__('Pause on Hover', 'organify'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => false,
        ),
        array(
            'name' => 'autoplay',
            'label' => esc_html__('Autoplay', 'organify'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => false,
        ),
        array(
            'name' => 'autoplay_speed',
            'label' => esc_html__('Autoplay Delay', 'organify'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 5000,
            'condition' => [
                'autoplay' => 'true'
            ]
        ),
        array(
            'name' => 'infinite',
            'label' => esc_html__('Infinite Loop', 'organify'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => false,
        ),
        array(
            'name' => 'speed',
            'label' => esc_html__('Animation Speed', 'organify'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 500,
        ),

        array(
            'name' => 'item_spacer',
            'label' => esc_html__('Item Spacer', 'organify' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-slider .pxl-swiper-container .pxl-swiper-slide' => 'padding: 0 {{SIZE}}px;',
                '{{WRAPPER}} .pxl-swiper-slider .pxl-swiper-container' => 'margin: 0 -{{SIZE}}px;',
            ],
        ),

        array(
            'name'  => 'heading_product_display',
            'label' => esc_html__('PRODUCT','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),

        array(
            'name' => 'show_category',
            'label' => esc_html__('Show Category', 'organify' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'true',
        ),
        array(
            'name' => 'show_description',
            'label' => esc_html__('Show Description', 'organify' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'true',
        ),
        array(
            'name' => 'show_price',
            'label' => esc_html__('Show Price', 'organify' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'true',
        ),
        array(
            'name' => 'show_cart',
            'label' => esc_html__('Show Cart', 'organify' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'true',
        ),
    ),
),
array(
    'name' => 'tab_style_general',
    'label' => esc_html__('General', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
       array(
        'name'  => 'padding_content',
        'label' => esc_html__('Padding Content','organify'),
        'type'  => \Elementor\Controls_Manager::DIMENSIONS,
        'control_type' => 'responsive',
        'size_units' => [ 'px' ],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 3000,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .pxl-slide--home .pxl-introduction--product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ),
       array(
        'name'  => 'margin_content',
        'label' => esc_html__('Margin Content','organify'),
        'type'  => \Elementor\Controls_Manager::DIMENSIONS,
        'control_type' => 'responsive',
        'size_units' => [ 'px' ],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 3000,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .pxl-slide--home .pxl-introduction--product' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ),
       array(
        'name'  => 'max_Width_content',
        'label' => esc_html__('Max Width Content','organify'),
        'type'  => \Elementor\Controls_Manager::SLIDER,
        'control_type' => 'responsive',
        'size_units' => [ 'px' ],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 3000,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .pxl-slide--home .pxl-introduction--product' => 'max-width: {{SIZE}}{{UNIT}};',
        ],
    ),

   ),
),
array(
    'name' => 'tab_style_title',
    'label' => esc_html__('Title', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name'  => 'title_color',
            'label' => esc_html__('Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-introduction--product .pxl-slide--title' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'title_typography',
            'label' => esc_html__('Title Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-slide--home .pxl-introduction--product .pxl-slide--title',
        ),
        array(
            'name'  => 'heading_text_highlight',
            'label' => esc_html__('Text Highlight','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name'  => 'title_highlight_color',
            'label' => esc_html__('Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-introduction--product .pxl-slide--title .pxl-title--highlight' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'title_highlight_typography',
            'label' => esc_html__('Title Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-slide--home .pxl-introduction--product .pxl-slide--title .pxl-title--highlight',
        ),
        array(
            'name'  => 'title_space_bottom',
            'label' => esc_html__('Space Bottom','organify'),
            'type'  => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 3000,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-introduction--product .pxl-slide--title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ),
        array(
            'name' => 'pxl_animate_title',
            'label' => esc_html__('Case Animate', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => organify_widget_animate_v2(),
            'default' => '',
        ),
        array(
            'name' => 'pxl_animate_delay_title',
            'label' => esc_html__('Animate Delay', 'organify' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '0',
            'description' => 'Enter number. Default 0ms',
        ),
    ),
),

array(
    'name' => 'tab_style_concept',
    'label' => esc_html__('Concept', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name'  => 'concept_color',
            'label' => esc_html__('Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-introduction--product .pxl-slide--concept' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'concept_typography',
            'label' => esc_html__('Concept Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-slide--home .pxl-introduction--product .pxl-slide--concept',
        ),
        
        array(
            'name'  => 'concept_space_bottom',
            'label' => esc_html__('Space Bottom','organify'),
            'type'  => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 3000,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-introduction--product .pxl-slide--concept' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ),

        array(
            'name' => 'pxl_animate_concept',
            'label' => esc_html__('Case Animate', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => organify_widget_animate_v2(),
            'default' => '',
        ),
        array(
            'name' => 'pxl_animate_delay_concept',
            'label' => esc_html__('Animate Delay', 'organify' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '0',
            'description' => 'Enter number. Default 0ms',
        ),
    ),
),

array(
    'name' => 'tab_style_description',
    'label' => esc_html__('Description', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name'  => 'description_color',
            'label' => esc_html__('Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-introduction--product .pxl-slide--description' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'description_typography',
            'label' => esc_html__('Description Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-slide--home .pxl-introduction--product .pxl-slide--description',
        ),
        
        array(
            'name'  => 'description_space_bottom',
            'label' => esc_html__('Space Bottom','organify'),
            'type'  => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 3000,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-introduction--product .pxl-slide--description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ),

        array(
            'name' => 'pxl_animate_description',
            'label' => esc_html__('Case Animate', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => organify_widget_animate_v2(),
            'default' => '',
        ),
        array(
            'name' => 'pxl_animate_delay_description',
            'label' => esc_html__('Animate Delay', 'organify' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '0',
            'description' => 'Enter number. Default 0ms',
        ),
    ),
),

array(
    'name' => 'tab_style_button',
    'label' => esc_html__('Button', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name'  => 'button_color',
            'label' => esc_html__('Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-introduction--product .pxl--button' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'button_bg_color',
            'label' => esc_html__('Background Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-introduction--product .pxl--button' => 'background-color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'button_typography',
            'label' => esc_html__('Button Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-slide--home .pxl-introduction--product .pxl--button',
        ),
        
        array(
            'name'  => 'heading_hover_btn',
            'label' => esc_html__('Button Hover','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),

        array(
            'name'  => 'button_color_hv',
            'label' => esc_html__('Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-introduction--product .pxl--button:hover' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'button_bg_color_hv',
            'label' => esc_html__('Background Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-introduction--product .pxl--button:hover' => 'background-color: {{VALUE}};',
            ],
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

        array(
            'name' => 'pxl_animate_button',
            'label' => esc_html__('Case Animate', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => organify_widget_animate_v2(),
            'default' => '',
        ),
        array(
            'name' => 'pxl_animate_delay_button',
            'label' => esc_html__('Animate Delay', 'organify' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '0',
            'description' => 'Enter number. Default 0ms',
        ),
    ),
),

array(
    'name' => 'tab_style_product_item',
    'label' => esc_html__('Product Item', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name'  => 'background_color_prd',
            'label' => esc_html__('Backgorund Color Item Product','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner' => 'background-color: {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'background_color_prd_hv',
            'label' => esc_html__('Backgorund Color Item Product Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner:hover' => 'background-color: {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'border_radius_item_product',
            'label' => esc_html__('Border Radius','organify'),
            'type'  => \Elementor\Controls_Manager::DIMENSIONS,
            'control_type' => 'responsive',
            'size_units' => [ 'px','custom' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ),
        array(
            'name' => 'item_product_border',
            'label' => esc_html__('Border', 'organify' ),
            'type' => \Elementor\Group_Control_Border::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .woocommerce .woocommerce-product-inner',
        ),

        array(
            'name'  => 'heading_toolbar',
            'label' => esc_html__('TOOLBAR','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),

        array(
            'name'  => 'icon_color_toolbar',
            'label' => esc_html__('Icon Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-header .woocommerce--toolbar button:after' => 'background-color: {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'icon_color_toolbar_hv',
            'label' => esc_html__('Icon Color Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-header .woocommerce--toolbar button:hover:after' => 'background-color: {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'bg_color_toolbar_',
            'label' => esc_html__('Background Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-header .woocommerce--toolbar button' => 'background-color: {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'bg_color_toolbar_hv',
            'label' => esc_html__('Background Color Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-header .woocommerce--toolbar button:hover' => 'background-color: {{VALUE}};',
            ],
        ),
    ),
),

array(
    'name' => 'tab_style_product_inner',
    'label' => esc_html__('Product Inner', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name'  => 'heading_category',
            'label' => esc_html__('CATEGORY','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name'  => 'category_color',
            'label' => esc_html__('Category Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .product-category a' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'category_typography',
            'label' => esc_html__('Category Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-slide--home .product-category a',
        ),

        array(
            'name'  => 'heading_excerpt',
            'label' => esc_html__('EXCERPT','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name'  => 'excerpt_color',
            'label' => esc_html__('Excerpt Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .woocommerce-sg-product-excerpt p' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'excerpt_typography',
            'label' => esc_html__('Excerpt Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-slide--home .woocommerce-sg-product-excerpt p',
        ),

        array(
            'name'  => 'heading_price',
            'label' => esc_html__('PRICE','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name'  => 'price_color',
            'label' => esc_html__('Price Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .woocommerce-product--price ins,
                {{WRAPPER}} .pxl-slide--home .woocommerce-product--price' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'price_typography',
            'label' => esc_html__('Price Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-slide--home .woocommerce-product--price ins',
            '{{WRAPPER}} .pxl-slide--home .woocommerce-product--price',
        ),
        array(
            'name'  => 'sale_color',
            'label' => esc_html__('Sale Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .woocommerce-product--price del' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'sale_typography',
            'label' => esc_html__('Sale Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-slide--home .woocommerce-product--price del',
        ),

        array(
            'name'  => 'heading_button_prd',
            'label' => esc_html__('BUTTON','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name'  => 'button_color_prd',
            'label' => esc_html__('Button Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-add-to-cart a.button' => 'color: {{VALUE}};',
            ],
        ),

        array(
            'name'  => 'button_color_prd_hv',
            'label' => esc_html__('Button Color Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-add-to-cart a.button:hover' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'icon_color_prd',
            'label' => esc_html__('Icon Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-add-to-cart a.button svg path' => 'stroke: {{VALUE}} !important;',
            ],
        ),

        array(
            'name'  => 'icon_color_prd_hv',
            'label' => esc_html__('Icon Color Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-add-to-cart a.button:hover svg path' => 'stroke: {{VALUE}} !important;',
            ],
        ),

        array(
            'name'  => 'button_border_color_prd',
            'label' => esc_html__('Button Border Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-add-to-cart a.button' => 'border-color: {{VALUE}} !important;',
                '{{WRAPPER}} .pxl-slide--home .pxl-add-to-cart a.button::before' => 'background: {{VALUE}} !important;',
            ],
        ),
        array(
            'name' => 'button_typography_prd',
            'label' => esc_html__('Button Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-slide--home .pxl-add-to-cart a.button' ,
        ),
        array(
            'name'  => 'btn_padding_prd',
            'label' => esc_html__('Padding','organify'),
            'type'  => \Elementor\Controls_Manager::DIMENSIONS,
            'control_type' => 'responsive',
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 3000,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-add-to-cart a.button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ),
        array(
            'name'  => 'heading_animate',
            'label' => esc_html__('Animate','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name' => 'pxl_animate_product',
            'label' => esc_html__('Case Animate', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => organify_widget_animate_v2(),
            'default' => '',
        ),
        array(
            'name' => 'pxl_animate_delay_product',
            'label' => esc_html__('Animate Delay', 'organify' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '0',
            'description' => 'Enter number. Default 0ms',
        ),
    ),
),
),
),  
),
organify_get_class_widget_path()
);