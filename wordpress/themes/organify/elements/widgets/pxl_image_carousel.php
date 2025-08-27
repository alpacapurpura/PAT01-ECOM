<?php
$slides_to_show = range( 1, 10 );
$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
pxl_add_custom_widget(
    array(
        'name' => 'pxl_image_carousel',
        'title' => esc_html__('Case Image Carousel', 'organify'),
        'icon' => 'eicon-image-box',
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
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_image_carousel/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'organify' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_image_carousel/layout2.jpg'
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
                            'name'  => 'heading_img_cr',
                            'label' => esc_html__('Heading','organify'),
                            'type'  => \Elementor\Controls_Manager::TEXTAREA,
                            'label_block'   => true,
                            'description' => 'Create Typewriter text width shortcode: [typewriter text="Text1, Text2"], Highlight text with shortcode: [highlight text="Text"] and Highlight image with shortcode: [highlight_image id_image="123"]',
                            'condition' => [
                                'layout'    => '2',
                            ],
                        ),
                        array(
                            'name' => 'imgs',
                            'label' => esc_html__('Content', 'organify'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'image',
                                    'label' => esc_html__('Image', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                ),
                                array(
                                    'name'  => 'title',
                                    'label' => esc_html__('Title','organify'),
                                    'type'  => \Elementor\Controls_Manager::TEXT,
                                    'label_block'   => true,
                                ),
                                array(
                                    'name' => 'item_link',
                                    'label' => esc_html__('Link Details', 'organify'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'label_block' => true,
                                ),
                                array(
                                    'name'  => 'background_color_item',
                                    'label' => esc_html__('Background Color','organify'),
                                    'type'  => \Elementor\Controls_Manager::COLOR,
                                    'description'   => 'Only applies to some layouts.',
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-image-carousel {{CURRENT_ITEM}}'  => 'background-color:{{VALUE}};'
                                    ],
                                ),
                                array(
                                    'name'  => 'border_color_item',
                                    'label' => esc_html__('Border Color Hover','organify'),
                                    'type'  => \Elementor\Controls_Manager::COLOR,
                                    'description'   => 'Only applies to some layouts.',
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-image-carousel {{CURRENT_ITEM}}:hover'  => 'border-color:{{VALUE}};'
                                    ],
                                ),
                                array(
                                    'name'  => 'box_shadow_item_hv',
                                    'label' => esc_html__('Box Shadow Hover','organify'),
                                    'type'  => \Elementor\Group_Control_Box_Shadow::get_type(),
                                    'description'   => 'Only applies to some layouts.',
                                    'control_type'  => 'group',
                                    'selector'  => '{{WRAPPER}} .pxl-image-carousel {{CURRENT_ITEM}}:hover',
                                )
                            ),
                        ),
                    ),
                ),

array(
    'name' => 'section_carousel_settings',
    'label' => esc_html__('Carousel Settings', 'organify'),
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
            'name' => 'col_lg',
            'label' => esc_html__('Columns LG Devices', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '3',
            'options' => [
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '6' => '6',
                '7' => '7',
                '8' => '8',
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
                '7' => '7',
                '8' => '8',
            ],
        ),
        array(
            'name' => 'col_xxl',
            'label' => esc_html__('Columns XXL Devices', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '3',
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
            'name' => 'pagination',
            'label' => esc_html__('Show Pagination', 'organify'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => false,
        ),
        array(
            'name' => 'pagination_type',
            'label' => esc_html__('Pagination Type', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'bullets',
            'options' => [
                'bullets' => 'Bullets',
                'fraction' => 'Fraction',
                'progressbar' => 'Progressbar',
            ],
            'condition' => [
                'pagination' => 'true'
            ]
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
            'name' => 'drap',
            'label' => esc_html__('Show Scroll Drap', 'organify'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => false,
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
    ),
),
array(
    'name' => 'section_style',
    'label' => esc_html__('General', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'style_items',
            'label' => esc_html__('Style Item', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options'   => [
                'style-items-1' => 'Style 1',
                'style-items-2' => 'Style 2',
            ],
            'default'   => 'style-items-1',
            'condition' => [
                'layout'    => '1',
            ],
        ),
        array(
            'name'  => 'color_heading',
            'label' => esc_html__('Heading Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-image-carousel2 .pxl-heading--carousel'  => 'color: {{VALUE}};'
            ],
            'condition' => [
                'layout'    => '2',
            ],
        ),
        array(
            'name'  => 'typography_heading',
            'label' => esc_html__(' Heading Typography','organify'),
            'type'  => \Elementor\Group_Control_Typography::get_type(),
            'control_type'  => 'group',
            'selector'  => '{{WRAPPER}} .pxl-image-carousel2 .pxl-heading--carousel',
            'condition' => [
                'layout'    => '2',
            ],
        ),  
        array(
            'name' => 'border_radius',
            'label' => esc_html__('Border Radius', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px' ],
            'selectors' => [
                '{{WRAPPER}} .pxl-image-carousel .pxl-item--image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ),
        array(
            'name' => 'item_padding',
            'label' => esc_html__('Item Padding', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px' ],
            'selectors' => [
                '{{WRAPPER}} .pxl-image-carousel .style-items-1 .pxl-item--inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'control_type' => 'responsive',
        ),

        
        array(
            'name' => 'general_controls',
            'control_type' => 'tab',
            'tabs' => [
                [
                    'name' => 'general_normal',
                    'label' => esc_html__('Normal', 'organify' ),
                    'type' => 'tab',
                    'controls' => [ 
                     array(
                        'name'  => 'box_shadow',
                        'label' => esc_html__('Box Shadow','organify'),
                        'type'  => \Elementor\Group_Control_Box_Shadow::get_type(),
                        'control_type'  => 'group',
                        'selector'  => '{{WRAPPER}} .pxl-swiper-slider .pxl-swiper-container',
                    ),
                     array(
                        'name'  => 'background',
                        'label' => esc_html__('Background','organify'),
                        'type'  => \Elementor\Group_Control_Background::get_type(),
                        'control_type'  => 'group',
                        'selector'  => '{{WRAPPER}} .pxl-image-carousel .pxl-carousel-inner .pxl-swiper-slide .pxl-item--inner',
                    ),
                     array(
                        'name'  => 'border_color_sty2',
                        'label' => esc_html__('Border Color','organify'),
                        'type'  => \Elementor\Controls_Manager::COLOR,
                        'selectors'  => [
                        '{{WRAPPER}} .pxl-image-carousel .style-items-2'    => '--border-style-2-color:{{VALUE}};',
                        'condition' => [
                        'style_items'   => 'style-items-2',
                        ],
                    ],
                ),
                     array(
                        'name' => 'item_border',
                        'label' => esc_html__('Border', 'organify' ),
                        'type' => \Elementor\Group_Control_Border::get_type(),
                        'selector' => '{{WRAPPER}} .pxl-image-carousel .pxl-carousel-inner .pxl-item--inner',
                        'control_type' => 'group',
                        'condition' => [
                        'style_items!'   => 'style-items-2',
                    ],
                ),
                 ],
             ],
             [
                'name' => 'general_hover',
                'label' => esc_html__('Hover', 'organify' ),
                'type' => 'tab',
                'controls' => [
                    array(
                        'name'  => 'background_hv',
                        'label' => esc_html__('Background Hover','organify'),
                        'type'  => \Elementor\Group_Control_Background::get_type(),
                        'control_type'  => 'group',
                        'selector'  => '{{WRAPPER}} .pxl-image-carousel .pxl-carousel-inner .pxl-swiper-slide:hover .pxl-item--inner',
                    ),
                    array(
                        'name' => 'item_border_hv',
                        'label' => esc_html__('Border', 'organify' ),
                        'type' => \Elementor\Group_Control_Border::get_type(),
                        'selector'  => '{{WRAPPER}} .pxl-image-carousel .pxl-carousel-inner .pxl-swiper-slide:hover .pxl-item--inner',
                        'control_type' => 'group',
                        'condition' => [
                        'style_items!'   => 'style-items-2',
                    ],
                ),
                ],
            ],
        ],
    ),

        array(
            'name' => 'pxl_animate_tt',
            'label' => esc_html__('Heading Animate', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => organify_widget_animate_v2(),
            'default' => '',
            'separator' => 'before',
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
    'name' => 'section_title',
    'label' => esc_html__('Title', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name'  => 'color_title',
            'label' => esc_html__('Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-image-carousel .pxl-carousel-inner a .pxl-item--title'  => 'color: {{VALUE}};'
            ],
        ),
        array(
            'name'  => 'color_title_hv',
            'label' => esc_html__('Color Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-image-carousel .pxl-carousel-inner a:hover .pxl-item--title'  => 'color: {{VALUE}};'
            ],
        ),
        array(
            'name'  => 'typography_title',
            'label' => esc_html__('Typography','organify'),
            'type'  => \Elementor\Group_Control_Typography::get_type(),
            'control_type'  => 'group',
            'selector'  => '{{WRAPPER}} .pxl-image-carousel .pxl-carousel-inner .pxl-item--title',
        ), 
        array(
            'name' => 'title_padding',
            'label' => esc_html__('Title Padding', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px' ],
            'selectors' => [
                '{{WRAPPER}} .pxl-image-carousel .pxl-carousel-inner a .pxl-item--title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'control_type' => 'responsive',
        ),
    ),
),

array(
    'name' => 'section_image',
    'label' => esc_html__('Image', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'condition' => [
        'layout'    => '1',
        'style_items'    => 'style-items-1',
    ],
    'controls' => array(
     array(
        'name' => 'style_hover_image',
        'label' => esc_html__('Image Hover', 'organify' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
            'hover_normal' => 'Normal',
            'hover_1' => 'Style 1',
        ],
        'default'   => 'hover_1',
        'condition' => [
            'layout'    => '1',
            'style_items'    => 'style-items-1',
        ],
    ),
     array(
        'name'  => 'background_image',
        'label' => esc_html__('Background Image Hover','organify'),
        'type'  => \Elementor\Group_Control_Background::get_type(),
        'control_type'  => 'group',
        'selector'  => '{{WRAPPER}} .pxl-image-carousel1 .style-items-1 .pxl-item--image::before',
        'condition' => [
            'layout'    => '1',
            'style_items'    => 'style-items-1',
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