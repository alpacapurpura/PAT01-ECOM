<?php
$pt_supports = ['post','product'];
pxl_add_custom_widget(
    array(
        'name' => 'pxl_post_grid',
        'title' => esc_html__('Case Post Grid', 'organify' ),
        'icon' => 'eicon-posts-grid',
        'categories' => array('pxltheme-core'),
        'scripts' => [
            'imagesloaded',
            'isotope',
            'pxl-post-grid',
        ],
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'tab_layout',
                    'label'    => esc_html__( 'Layout', 'organify' ),
                    'tab'      => 'layout',
                    'controls' => array_merge(
                        array(
                            array(
                                'name'     => 'post_type',
                                'label'    => esc_html__( 'Select Post Type', 'organify' ),
                                'type'     => 'select',
                                'multiple' => true,
                                'options'  => organify_get_post_type_options($pt_supports),
                                'default'  => 'post'
                            ) 
                        ),
                        organify_get_post_grid_layout($pt_supports)
                    ),
                ),

                array(
                    'name' => 'tab_source',
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
                            ),
                        )
                    ),
                ),
                array(
                    'name' => 'tab_grid',
                    'label' => esc_html__('Grid', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array(
                        array(
                            'name' => 'img_size',
                            'label' => esc_html__('Image Size', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'description' => 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 419x279 (Width x Height)).',
                        ),
                        array(
                            'name' => 'img_size_featured',
                            'label' => esc_html__('Image Size Featured', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'description' => 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 677x439 (Width x Height)).',
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
                            'name' => 'pxl_animate',
                            'label' => esc_html__('Case Animate', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => organify_widget_animate(),
                            'default' => '',
                        ),
                        array(
                            'name' => 'filter',
                            'label' => esc_html__('Filter on Masonry', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'false',
                            'options' => [
                                'true' => esc_html__('Enable', 'organify' ),
                                'false' => esc_html__('Disable', 'organify' ),
                            ],
                            'condition' => [
                                'select_post_by' => 'term_selected',
                            ],
                        ),
                        array(
                            'name'    => 'filter_style',
                            'label'   => esc_html__('Filter Style', 'organify' ),
                            'type'    => \Elementor\Controls_Manager::SELECT,
                            'default' => 'style-1',
                            'options' => [
                                'style-1'  => esc_html__('Style 1', 'organify' ),
                                'style-2' => esc_html__('Style 2', 'organify' ),
                            ],
                            'condition' => [
                                'select_post_by' => 'term_selected',
                                'filter' => 'true',
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
                            'name'    => 'filter_type',
                            'label'   => esc_html__('Filter Type', 'organify' ),
                            'type'    => \Elementor\Controls_Manager::SELECT,
                            'default' => 'normal',
                            'options' => [
                                'normal'  => esc_html__('Normal', 'organify' ),
                                'ajax' => esc_html__('Ajax', 'organify' ),
                            ],
                            'condition' => [
                                'select_post_by' => 'term_selected',
                                'filter' => 'true',
                            ],
                        ),
                        array(
                            'name' => 'filter_default_title',
                            'label' => esc_html__('Filter Default Title', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__('All', 'organify' ),
                            'condition' => [
                                'filter' => 'true',
                                'select_post_by' => 'term_selected',
                            ],
                        ),
                        array(
                            'name' => 'pagination_type',
                            'label' => esc_html__('Pagination Type', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'false',
                            'options' => [
                                'pagination' => esc_html__('Pagination', 'organify' ),
                                'loadmore' => esc_html__('Loadmore', 'organify' ),
                                'false' => esc_html__('Disable', 'organify' ),
                            ],
                        ),
                        array(
                            'name'  => 'text_btn_loadmore',
                            'label' => esc_html__('Custom Text Button','organify'),
                            'type'  => \Elementor\Controls_Manager::TEXT,
                            'condition' => [
                                'pagination_type'   => 'loadmore',
                            ],
                        ),
                        array(
                            'name' => 'col_xs',
                            'label' => esc_html__('Columns: Screen <= 575', 'organify' ),
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
                            'label' => esc_html__('Columns: Screen <= 767', 'organify' ),
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
                            'label' => esc_html__('Columns: Screen <= 991', 'organify' ),
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
                            'label' => esc_html__('Columns: Screen <= 1199', 'organify' ),
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
                            'name' => 'col_xl',
                            'label' => esc_html__('Columns: Screen => 1200', 'organify' ),
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
                            'name' => 'item_spacer',
                            'label' => esc_html__('Item Spacer', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'description' => 'Default: 15',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-grid .pxl-grid-item' => 'padding:{{SIZE}}px;',
                                '{{WRAPPER}} .pxl-grid .pxl-post--inner' => 'margin-bottom:{{SIZE}}px;',
                                '{{WRAPPER}} .pxl-grid .pxl-grid-masonry' => 'margin-left: -{{SIZE}}px;margin-right: -{{SIZE}}px;',
                            ],
                        ),
                        array(
                            'name' => 'grid_masonry',
                            'label' => esc_html__('Grid Masonry', 'organify'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'col_xs_m',
                                    'label' => esc_html__('Columns: Screen <= 575', 'organify' ),
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
                                    'name' => 'col_sm_m',
                                    'label' => esc_html__('Columns: Screen <= 767', 'organify' ),
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
                                    'name' => 'col_md_m',
                                    'label' => esc_html__('Columns: Screen <= 991', 'organify' ),
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
                                    'name' => 'col_lg_m',
                                    'label' => esc_html__('Columns: Screen <= 1199', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::SELECT,
                                    'default' => '3',
                                    'options' => [
                                        '1' => '1',
                                        '2' => '2',
                                        '3' => '3',
                                        '4' => '4',
                                        '6' => '6',
                                        'col-66' => 'Column 66%',
                                    ],
                                ),
                                array(
                                    'name' => 'col_xl_m',
                                    'label' => esc_html__('Columns: Screen => 1200', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::SELECT,
                                    'default' => '3',
                                    'options' => [
                                        '1' => '1',
                                        '2' => '2',
                                        '3' => '3',
                                        '4' => '4',
                                        '6' => '6',
                                        'col-66' => 'Column 66%',
                                    ],
                                ),
                                array(
                                    'name' => 'img_size_m',
                                    'label' => esc_html__('Image Size', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'description' => 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).',
                                ),
                            ),
),
),
),
array(
    'name' => 'tab_display',
    'label' => esc_html__('Display', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
    'controls' => array(
        array(
            'name'  => 'items_featured_sw',
            'label' => esc_html__('Items Featured','organify'),
            'type'  => \Elementor\Controls_Manager::SWITCHER,
            'default'   => 'true',
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
        array(
            'name' => 'show_button',
            'label' => esc_html__('Show Button', 'organify' ),
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
                    ],
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
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']],
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
            'name' => 'num_words',
            'label' => esc_html__('Number of Words', 'organify' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 20,
            'separator' => 'after',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']],
                            ['name' => 'show_excerpt', 'operator' => '==', 'value' => 'true']
                        ]
                    ],
                ],
            ]
        ),
    ),
),
array(
    'name' => 'section_style_general',
    'label' => esc_html__('General', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name'  => 'space_bottom_item',
            'label' => esc_html__('Space Bottom Item','organify'),
            'type'  => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px','custom'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-blog-style1 .pxl-post--inner' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
            'separator' => 'after',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']],
                        ]
                    ],
                ],
            ]
        ),
        array(
            'name' => 'background_color_item',
            'label' => esc_html__('Background Item', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner,
                {{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-add-to-cart' => 'background: {{VALUE}};',
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

        ),

        array(
            'name' => 'background_color_item_hover',
            'label' => esc_html__('Background Item Hover', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner:hover,
                {{WRAPPER}} .woocommerce .woocommerce-product-inner:hover .woocommerce-product-content .woocommerce-add-to-cart' => 'background: {{VALUE}};',
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

        ),

        array(
            'name' => 'background_color_product_hv',
            'label' => esc_html__('Background Product Hover', 'organify' ),
            'type'  => \Elementor\Group_Control_Background::get_type(),
            'control_type'  => 'group',
            'selector' => '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-header::after',
        ),

        array(
            'name' => 'border_color_product',
            'label' => esc_html__('Border Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner,
                {{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-add-to-cart' => 'border-color: {{VALUE}};',
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

        ),
        array(
            'name'  => 'heading_toolbar',
            'label' => esc_html__('TOOLBAR','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
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
        ),

        array(
            'name'  => 'icon_color_toolbar',
            'label' => esc_html__('Icon Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-header .woocommerce--toolbar button:after' => 'background-color: {{VALUE}};',
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
        ),
        array(
            'name'  => 'icon_color_toolbar_hv',
            'label' => esc_html__('Icon Color Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-header .woocommerce--toolbar button:hover:after' => 'background-color: {{VALUE}};',
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
        ),
        array(
            'name'  => 'bg_color_toolbar_',
            'label' => esc_html__('Background Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-header .woocommerce--toolbar button' => 'background-color: {{VALUE}};',
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
        ),
        array(
            'name'  => 'bg_color_toolbar_hv',
            'label' => esc_html__('Background Color Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-header .woocommerce--toolbar button:hover' => 'background-color: {{VALUE}};',
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
        ),
    ),
),
array(
    'name' => 'section_style_title',
    'label' => esc_html__('Title', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'title_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-grid .pxl-post--title' => 'color: {{VALUE}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']],
                        ]
                    ],
                ],
            ]

        ),
        array(
            'name' => 'title_color_prd',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-product-title a' => 'color: {{VALUE}};',
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
            ]

        ),
        array(
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-grid .pxl-post--title, .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-product-title a',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']],
                        ]
                    ],
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']],
                        ]
                    ],
                ],
            ]
        ),
        array(
            'name'  => 'space_title_top',
            'label' => esc_html__('Space Top','organify'),
            'type'  => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px','custom'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-header' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
            'separator' => 'after',
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
            ]
        ),

        array(
            'name'  => 'space_title',
            'label' => esc_html__('Space Bottom','organify'),
            'type'  => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px','custom'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-grid .pxl-post--title, .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-product-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
            'separator' => 'after',
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
            ]
        ),

    ),
),
array(
    'name' => 'section_style_categories',
    'label' => esc_html__('Category', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'categories_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-grid .pxl--category a' => 'color: {{VALUE}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']],
                        ]
                    ],
                ],
            ]
        ),
        array(
            'name' => 'categories_typography',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-grid .pxl--category a',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']],
                        ]
                    ],
                ],
            ]
        ),

    ),
),
array(
    'name' => 'section_style_excerpt',
    'label' => esc_html__('Exceprt', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'excerpt_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-grid .pxl-post--content' => 'color: {{VALUE}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']],
                        ]
                    ],
                ],
            ]

        ),
        array(
            'name' => 'excerpt_color_prd',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-sg-product-excerpt p' => 'color: {{VALUE}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']],
                            ['name' => 'show_title', 'operator' => '==', 'value' => 'true']
                        ]
                    ],
                ],
            ]

        ),
        array(
            'name' => 'excerpt_typography',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-grid .pxl-post--content, {{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-sg-product-excerpt p',
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'post'],
                            ['name' => 'layout_post', 'operator' => 'in', 'value' => ['post-1']],
                        ]
                    ],
                    [
                        'terms' => [
                            ['name' => 'post_type', 'operator' => '==', 'value' => 'product'],
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']],
                        ]
                    ],
                ],
            ]
        ),
        array(
            'name'  => 'space_excerpt',
            'label' => esc_html__('Space Bottom','organify'),
            'type'  => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px','custom'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-sg-product-excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
            'separator' => 'after',
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
            ]
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
                            ['name' => 'layout_product', 'operator' => 'in', 'value' => ['product-1']],
                        ]
                    ],
                ],
            ],
    'controls' => array(
        array(
            'name' => 'price_color_prd',
            'label' => esc_html__('Cost Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-product--price,
                {{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-product--price ins' => 'color: {{VALUE}};',
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

        ),
        array(
            'name' => 'price_typography',
            'label' => esc_html__('Cost Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-product--price',
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
        ),
        array(
            'name' => 'price_sale_color_prd',
            'label' => esc_html__('Sale Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-product--price del' => 'color: {{VALUE}};',
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
            ]

        ),
        array(
            'name' => 'price_sale_typography',
            'label' => esc_html__('Sale Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-product--price del',
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
            ]
        ),
        array(
            'name'  => 'space_price',
            'label' => esc_html__('Space Bottom','organify'),
            'type'  => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px','custom'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-product--price' => 'padding-bottom: {{SIZE}}{{UNIT}};',
            ],
            'separator' => 'after',
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
            ]
        ),

    ),
),

array(
    'name' => 'section_style_button',
    'label' => esc_html__('Button', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'button_color',
            'label' => esc_html__('Button Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-add-to-cart a' => 'color: {{VALUE}};',
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
            ]
        ),

        array(
            'name' => 'button_color_hv',
            'label' => esc_html__('Button Color Hover', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-add-to-cart a:hover' => 'color: {{VALUE}};',
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
            ]
        ),

        array(
            'name' => 'button_color_border',
            'label' => esc_html__('Boder Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-add-to-cart a:hover' => 'border-color: {{VALUE}};',
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
            ]

        ),
        array(
            'name' => 'button_color_hover',
            'label' => esc_html__('Hover Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-add-to-cart .button::after' => 'background: {{VALUE}};',
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

        ),
        array(
            'name' => 'button_typography',
            'label' => esc_html__('Button Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-add-to-cart .button',
        ),
        array(
            'name' => 'padding_button',
            'label' => esc_html__( 'Padding', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-add-to-cart .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
            'responsive' => true,
        ),
    ),
),

),
),
),
organify_get_class_widget_path()
);