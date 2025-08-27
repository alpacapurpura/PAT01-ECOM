<?php
$pt_supports = ['post','product'];
pxl_add_custom_widget(
    array(
        'name' => 'pxl_post_carousel',
        'title' => esc_html__('Case Post Carousel', 'organify' ),
        'icon' => 'eicon-posts-carousel',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'swiper',
            'pxl-swiper',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__( 'Layout', 'organify' ),
                    'tab'      => 'layout',
                    'controls' => array_merge(
                        array(
                            array(
                                'name'  => 'title_product_carousel',
                                'label' => esc_html__('Title Item','organify'),
                                'type'  => \Elementor\Controls_Manager::TEXTAREA,
                                'conditions' => [
                                    'relation' => 'or',
                                    'terms' => [
                                        [
                                            'terms' => [
                                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']]
                                        ]
                                    ],
                                ],
                            ],
                        ),
                            array(
                                'name'     => 'post_type',
                                'label'    => esc_html__( 'Select Post Type', 'organify' ),
                                'type'     => 'select',
                                'multiple' => true,
                                'options'  => organify_get_post_type_options($pt_supports),
                                'default'  => 'post'
                            ) 
                        ),
                        organify_get_post_carousel_layout($pt_supports),
                    ),
                ),
                array(
                    'name' => 'section_source',
                    'label' => esc_html__('Source', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        array(
                            array(
                                'name'     => 'select_post_by',
                                'label'    => esc_html__( 'Select posts by', 'organify' ),
                                'type'     => 'select',
                                'multiple' => true,
                                'options'  => [
                                    'term_selected' => esc_html__( 'Terms selected', 'organify' ),
                                    'post_selected' => esc_html__( 'Posts selected ', 'organify' ),
                                ],
                                'default'  => 'term_selected'
                            ) 
                        ),
                        organify_get_grid_term_by_post_type($pt_supports, ['custom_condition' => ['select_post_by' => 'term_selected']]),
                        organify_get_grid_ids_by_post_type($pt_supports, ['custom_condition' => ['select_post_by' => 'post_selected']]),
                        array(
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
                                'default' => '6',
                                'control_type' => 'responsive',

                            ),
                        )
                    ),
                ),
                array(
                    'name' => 'section_carousel',
                    'label' => esc_html__('Carousel', 'organify'),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array(
                        array(
                            'name' => 'pxl_animate',
                            'label' => esc_html__('Organify Animate', 'organify' ),
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
                                'custom' => 'custom',
                            ],
                        ),

                        array(
                            'name' => 'col_md_custom',
                            'label' => esc_html__('Columns MD Custom', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'description' => 'Enter number.',
                            'condition' => [
                                'col_md' => 'custom',
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
                                'custom' => 'custom',
                            ],
                        ),

                        array(
                            'name' => 'col_lg_custom',
                            'label' => esc_html__('Columns LG Custom', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'description' => 'Enter number.',
                            'condition' => [
                                'col_lg' => 'custom',
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
                                'custom' => 'custom',
                            ],
                        ),

                        array(
                            'name' => 'col_xl_custom',
                            'label' => esc_html__('Columns XL Custom', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'description' => 'Enter number.',
                            'condition' => [
                                'col_xl' => 'custom',
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
                                'custom' => 'custom',
                            ],
                        ),

                        array(
                            'name' => 'col_xxl_custom',
                            'label' => esc_html__('Columns XXL Custom', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'description' => 'Enter number.',
                            'condition' => [
                                'col_xxl' => 'custom',
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
                    ),
),
array(
    'name' => 'section_display',
    'label' => esc_html__('Display', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
    'controls' => array(
        array(
            'name' => 'img_size',
            'label' => esc_html__('Image Size', 'organify' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'description' => 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']]
                        ]
                    ],
                ],
            ],
        ),
        array(
            'name' => 'show_date',
            'label' => esc_html__('Show Date', 'organify' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'true',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']]
                        ]
                    ]
                ],
            ]
        ),
        array(
            'name' => 'show_category',
            'label' => esc_html__('Show Category', 'organify' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'true',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']]
                        ]
                    ],
                ],
            ]
        ),
        array(
            'name' => 'show_author',
            'label' => esc_html__('Show Author', 'organify' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'true',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']]
                        ]
                    ]
                ],
            ]
        ),
        array(
            'name' => 'show_comment',
            'label' => esc_html__('Show Comment', 'organify' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'true',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']]
                        ]
                    ]
                ],
            ]
        ),
        array(
            'name' => 'show_excerpt',
            'label' => esc_html__('Show Excerpt', 'organify' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'true',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']]
                        ]
                    ]
                ],
            ]
        ),
        array(
            'name' => 'num_words',
            'label' => esc_html__('Number of Words', 'organify' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 25,
            'separator' => 'after',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']],
                            ['name' => 'show_excerpt', 'operator' => '==', 'value' => 'true'],
                        ]
                    ]
                ],
            ]
        ),
        array(
            'name' => 'show_button',
            'label' => esc_html__('Show Button Readmore', 'organify' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'true',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']]
                        ]
                    ], 
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']]
                        ]
                    ],
                ],
            ]
        ),
        array(
            'name' => 'button_text',
            'label' => esc_html__('Button Text', 'organify' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']],
                            ['name' => 'show_button', 'operator' => '==', 'value' => 'true']
                        ]
                    ]
                ],
            ]
        ),
        array(
            'name' => 'show_title',
            'label' => esc_html__('Show Title', 'organify' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'true',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']]
                        ]
                    ],
                ],
            ]
        ),
        array(
            'name' => 'show_price',
            'label' => esc_html__('Show Price', 'organify' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'true',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']]
                        ]
                    ],
                ],
            ]
        ),
    ),
),
array(
    'name' => 'section_style_title_item',
    'label' => esc_html__('Title Item', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'conditions' => [
        'relation' => 'or',
        'terms' => [
            [
                'terms' => [
                    ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                    ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']]
                ]
            ],
        ],
    ],
    'controls' => array(
        array(
            'name' => 'title_item_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-title--product-carousel' => 'color: {{VALUE}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']]
                        ]
                    ],
                ],
            ],
        ),
        array(
            'name' => 'title_item_typography',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-product-carousel .pxl-title--product-carousel',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']]
                        ]
                    ],
                ],
            ],
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
    'name' => 'section_style_inner',
    'label' => esc_html__('Inner', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name'  => 'heading_date',
            'label' => esc_html__('Date','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']]
                        ]
                    ],
                ],
            ],
        ),
        array(
            'name' => 'date_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-post-carousel .pxl-post--date' => 'color: {{VALUE}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']]
                        ]
                    ],
                ],
            ],
        ),
        array(
            'name' => 'date_typography',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-post-carousel .pxl-post--date',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']]
                        ]
                    ],
                ],
            ],
        ),

        array(
            'name'  => 'bg_color_image',
            'label' => esc_html__('Background Color Image','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-product-header' => 'background-color: {{VALUE}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']]
                        ]
                    ],
                ],
            ],
        ),
        array(
            'name'  => 'bg_color_image_hv',
            'label' => esc_html__('Background Color Image Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-item--inner:hover .pxl-product-header' => 'background-color: {{VALUE}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']]
                        ]
                    ],
                ],
            ],
        ),
        array(
            'name'  => 'bg_color_item',
            'label' => esc_html__('Background Color Item','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-item--inner ' => 'background-color: {{VALUE}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1','product-2']]
                        ]
                    ],
                ],
            ],
        ),
        array(
            'name'  => 'background_color_prd_hv',
            'label' => esc_html__('Background Color Item Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-item--inner:hover' => 'background-color: {{VALUE}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1','product-2']]
                        ]
                    ],
                ],
            ],
        ),

        array(
            'name' => 'space_top_inner',
            'label' => esc_html__( 'Space Top', 'organify' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-product-header' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']],
                        ]
                    ],
                ],
            ],
            'control_type' => 'responsive',

        ),

        array(
            'name' => 'space_bottom_inner',
            'label' => esc_html__( 'Space Bottom', 'organify' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-product-inner' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']],
                        ]
                    ],
                ],
            ],
            'control_type' => 'responsive',

        ),

        array(
            'name' => 'padding_inner',
            'label' => esc_html__( 'Padding', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-product-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']],
                        ]
                    ],
                ],
            ],
            'control_type' => 'responsive',

        ),

        array(
            'name' => 'border_inner',
            'label' => esc_html__('Border', 'organify' ),
            'type' => \Elementor\Group_Control_Border::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-product-carousel .pxl-product-inner',
        ),

        array(
            'name'  => 'border_color_prd_active',
            'label' => esc_html__('Border Color Active','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .swiper-slide-active .pxl-item--inner' => 'border-color: {{VALUE}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-2']]
                        ]
                    ],
                ],
            ],
        ),

        array(
            'name'  => 'border_color_prd',
            'label' => esc_html__('Border Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-item--inner' => 'border-color: {{VALUE}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-2']]
                        ]
                    ],
                ],
            ],
        ),

        array(
            'name'  => 'border_radius_prd',
            'label' => esc_html__('Border Radius','organify'),
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
                '{{WRAPPER}} .pxl-product-carousel .pxl-item--inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-2']]
                        ]
                    ],
                ],
            ],
        ),

        array(
            'name' => 'min_height_item',
            'label' => esc_html__('Min Height Item', 'organify' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'control_type'  => 'responsive',
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-swiper-slide' => 'min-height: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-2']]
                        ]
                    ],
                ],
            ],
        ),

        array(
            'name'  => 'heading_category',
            'label' => esc_html__('Category','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
        ),
        array(
            'name' => 'categories_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .product-category a,
                {{WRAPPER}} .pxl-post-carousel .pxl-meta--inner a' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'categories_color_hover',
            'label' => esc_html__('Color Hover', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .product-category a:hover,
                {{WRAPPER}} .pxl-post-carousel .pxl-meta--inner a:hover' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'categories_typography',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-product-carousel .product-category a',
        ),

        array(
            'name'  => 'heading_rating',
            'label' => esc_html__('Rating','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']]
                        ]
                    ],
                ],
            ],
        ),
        array(
            'name' => 'rating_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-product--rating svg path' => 'fill: {{VALUE}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']]
                        ]
                    ],
                ],
            ],
        ),
        array(
            'name' => 'rating_font_size',
            'label' => esc_html__('Font-size', 'organify' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-product--rating svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']]
                        ]
                    ],
                ],
            ],
        ),
        array(
            'name' => 'border_prd',
            'label' => esc_html__('Border', 'organify' ),
            'type' => \Elementor\Group_Control_Border::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-product-carousel .pxl-product-inner ',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']]
                        ]
                    ],
                ],
            ],
        ),
    ),
),
array(
    'name' => 'section_style_title_product',
    'label' => esc_html__('Title Product', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'title_product_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-post-carousel .pxl-post--title,
                {{WRAPPER}} .pxl-product-carousel .pxl-product-title a' => 'color: {{VALUE}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']]
                        ]
                    ], 
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1','product-2']]
                        ]
                    ],
                ],
            ],
        ),
        array(
            'name' => 'title_product_typography',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-post-carousel .pxl-post--title,
            {{WRAPPER}} .pxl-product-carousel .pxl-product-title',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']]
                        ]
                    ], 
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1','product-2']]
                        ]
                    ],
                ],
            ],
        ),
        array(
            'name' => 'space_bottom_title',
            'label' => esc_html__( 'Space Bottom', 'organify' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-product-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']],
                        ]
                    ],
                ],
            ],
            'control_type' => 'responsive',

        ),
    ),
),
array(
    'name' => 'section_style_price',
    'label' => esc_html__('Price', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'conditions' => [
        'relation' => 'or',
        'terms' => [
            [
                'terms' => [
                    ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                    ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1','product-2']]
                ]
            ],
        ],
    ],
    'controls' => array(
        array(
            'name' => 'price_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-product--price,
                {{WRAPPER}} .pxl-product-carousel .pxl-product--price ins' => 'color: {{VALUE}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1','product-2']]
                        ]
                    ],
                ],
            ],
        ),
        array(
            'name' => 'price_typography',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-product-carousel .pxl-product--price,
            {{WRAPPER}} .pxl-product-carousel .pxl-product--price ins',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1','product-2']]
                        ]
                    ],
                ],
            ],
        ),
        array(
            'name'  => 'heading_sale',
            'label' => esc_html__('Sale','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1','product-2']]
                        ]
                    ],
                ],
            ],
        ),

        array(
            'name' => 'sale_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-product--price del' => 'color: {{VALUE}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1','product-2']]
                        ]
                    ],
                ],
            ],
        ),
        array(
            'name' => 'sale_typography',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-product-carousel .pxl-product--price del',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1','product-2']]
                        ]
                    ],
                ],
            ],
        ),
    ),
),

array(
    'name' => 'section_style_button',
    'label' => esc_html__('Button', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'conditions' => [
        'relation' => 'or',
        'terms' => [
            [
                'terms' => [
                    ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                    ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']]
                ]
            ],
        ],
    ],
    'controls' => array(
        array(
            'name'  => 'button_color_prd',
            'label' => esc_html__('Button Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-add-to-cart a' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'button_color_prd_hv',
            'label' => esc_html__('Button Color Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-add-to-cart a:hover' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'icon_color_prd',
            'label' => esc_html__('Icon Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-add-to-cart a svg path' => 'stroke: {{VALUE}} !important;',
            ],
        ),

        array(
            'name'  => 'icon_color_prd_hv',
            'label' => esc_html__('Icon Color Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-add-to-cart a:hover svg path' => 'stroke: {{VALUE}} !important;',
            ],
        ),

        array(
            'name'  => 'bg_color_prd',
            'label' => esc_html__('Background Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-add-to-cart a' => 'background-color: {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'bg_color_prd_hv',
            'label' => esc_html__('Background Color Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-add-to-cart a:hover' => 'background-color: {{VALUE}};',
            ],
        ),

        array(
            'name'  => 'button_border_color_prd',
            'label' => esc_html__('Button Border Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-carousel .pxl-add-to-cart a' => 'border-color: {{VALUE}} !important;',
                '{{WRAPPER}} .pxl-product-carousel .pxl-add-to-cart a::before' => 'background: {{VALUE}} !important;',
            ],
        ),
        array(
            'name' => 'button_typography_prd',
            'label' => esc_html__('Button Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-product-carousel .pxl-add-to-cart a' ,
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
                '{{WRAPPER}} .pxl-product-carousel .pxl-add-to-cart a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ),

        array(
            'name'  => 'btn_border_radius_prd',
            'label' => esc_html__('Border Radius','organify'),
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
                '{{WRAPPER}} .pxl-product-carousel .pxl-add-to-cart a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']]
                        ]
                    ],
                ],
            ],
        ),
    ),
),
),
),
),
organify_get_class_widget_path()
);