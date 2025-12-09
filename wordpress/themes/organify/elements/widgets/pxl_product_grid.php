<?php
$pt_supports = ['post'];
use Elementor\Controls_Manager;
pxl_add_custom_widget(
    array(
        'name'       => 'pxl_product_grid',
        'title'      => esc_html__('Case Product Grid', 'organify' ),
        'icon'       => 'eicon-posts-grid',
        'categories' => array('pxltheme-core'),
        'scripts'    => [
            'imagesloaded',
            'isotope',
            'pxl-post-grid',
        ],
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__( 'Layout', 'organify' ),
                    'tab'      => 'layout',
                    'controls' => array(
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__( 'Templates', 'organify' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'organify' ),
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_product_grid/img-layout/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'organify' ),
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_product_grid/img-layout/layout2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__( 'Layout 3', 'organify' ),
                                    'image' => get_template_directory_uri() . '/elements/templates/pxl_product_grid/img-layout/layout3.jpg'
                                ],
                               
                            ],
                            'prefix_class' => 'pxl-product-grid-layout-'
                        )
                    )
                ),

                array(
                    'name' => 'content_section',
                    'label' => esc_html__('Content', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name'    => 'title_product_grid',
                            'label'   => esc_html__('Title', 'organify' ),
                            'type'    => \Elementor\Controls_Manager::TEXTAREA,
                            'description' => 'Create Typewriter text width shortcode: [typewriter text="Text1, Text2"], Highlight text with shortcode: [highlight text="Text"] and Highlight image with shortcode: [highlight_image id_image="123"]',
                            'condition' => [
                                'layout'    => '2',
                            ],
                        ),
                    ),
                ),

                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
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
                            'name'     => 'taxonomies',
                            'label'    => esc_html__( 'Select Term of Product', 'organify' ),
                            'type'     => 'select2',
                            'multiple' => true,
                            'options'  => pxl_get_product_grid_term_options()
                        ),
                        array(
                            'name'     => 'product_ids',
                            'label'    => esc_html__( 'Products id (123,124,135...)', 'organify' ),
                            'type'     => 'text',
                            'default'  => '',
                            'condition' => array( 'query_type' => 'separate' )
                        ),
                        array(
                            'name'     => 'post_per_page',
                            'label'    => esc_html__( 'Post per page', 'organify' ),
                            'type'     => 'text',
                            'default'  => '12'
                        )
                    ),
                ),
                array(
                    'name' => 'display_section',
                    'label' => esc_html__('Display', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'show_category',
                            'label' => esc_html__('Show Category', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                            'condition' => [
                                'layout'    => ['2','3'],
                            ],
                        ),

                        array(
                            'name' => 'show_rating',
                            'label' => esc_html__('Show Rating', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                            'condition' => [
                                'layout'    => '2',
                            ],
                        ),
                        
                        array(
                            'name' => 'show_title',
                            'label' => esc_html__('Show Title', 'organify' ),
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
                            'name' => 'show_button',
                            'label' => esc_html__('Show Button', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                            'condition' => [
                                'layout'    => ['1','2'],
                            ],
                        ),

                        

                        array(
                            'name' => 'show_excerpt',
                            'label' => esc_html__('Show Excerpt', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                            'condition' => [
                                'layout'    => ['1','2'],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'general_section',
                    'label' => esc_html__('General Settings', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'img_size',
                                'label' => esc_html__('Image Size', 'organify' ),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'description' => 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).',
                            ),
                            array(
                                'name'    => 'layout_mode',
                                'label'   => esc_html__( 'Layout Mode', 'organify' ),
                                'type'    => \Elementor\Controls_Manager::SELECT,
                                'options' => [
                                    'fitRows' => esc_html__( 'Basic Grid', 'organify' ),
                                    'masonry' => esc_html__( 'Masonry Grid', 'organify' ),
                                ],
                                'default'   => 'fitRows'
                            ),
                            array(
                                'name'    => 'filter',
                                'label'   => esc_html__('Term Filter', 'organify' ),
                                'type'    => \Elementor\Controls_Manager::SELECT,
                                'default' => 'false',
                                'options' => [
                                    'true'  => esc_html__('Enable', 'organify' ),
                                    'false' => esc_html__('Disable', 'organify' ),
                                ],
                            ),

                            array(
                                'name'      => 'filter_default_title',
                                'label'     => esc_html__('Filter Default Title', 'organify' ),
                                'type'      => \Elementor\Controls_Manager::TEXT,
                                'default'   => esc_html__('All', 'organify' ),
                                'condition' => [
                                    'filter' => 'true',
                                ],
                            ),
                            array(
                                'name'    => 'pagination_type',
                                'label'   => esc_html__('Pagination Type', 'organify' ),
                                'type'    => \Elementor\Controls_Manager::SELECT,
                                'default' => 'false',
                                'options' => [
                                    'pagination' => esc_html__('Pagination', 'organify' ),
                                    'loadmore'   => esc_html__('Loadmore', 'organify' ),
                                    'false'      => esc_html__('Disable', 'organify' ),
                                ],
                            ),
                            array(
                                'name'      => 'loadmore_text',
                                'label'     => esc_html__( 'Load More text', 'organify' ),
                                'type'      => \Elementor\Controls_Manager::TEXT,
                                'default'   => esc_html__('Load More','organify'),
                                'condition' => [
                                    'pagination_type' => 'loadmore'
                                ]
                            ),
                            array(
                                'name'         => 'pagination_alignment',
                                'label'        => esc_html__( 'Pagination Alignment', 'organify' ),
                                'type'         => 'choose',
                                'control_type' => 'responsive',
                                'options' => [
                                    'start' => [
                                        'title' => esc_html__( 'Start', 'organify' ),
                                        'icon'  => 'eicon-text-align-left',
                                    ],
                                    'center' => [
                                        'title' => esc_html__( 'Center', 'organify' ),
                                        'icon'  => 'eicon-text-align-center',
                                    ],
                                    'end' => [
                                        'title' => esc_html__( 'End', 'organify' ),
                                        'icon'  => 'eicon-text-align-right',
                                    ]
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-grid-pagination, {{WRAPPER}} .pxl-load-more' => 'justify-content: {{VALUE}};'
                                ],
                                'condition' => [
                                    'pagination_type!' => 'false'
                                ],
                            ),
                            array(
                                'name' => 'item_padding',
                                'label' => esc_html__('Item Padding', 'organify' ),
                                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px' ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-grid-inner' => 'margin-top: -{{TOP}}{{UNIT}}; margin-right: -{{RIGHT}}{{UNIT}}; margin-bottom: -{{BOTTOM}}{{UNIT}}; margin-left: -{{LEFT}}{{UNIT}};',
                                    '{{WRAPPER}} .pxl-grid-inner .pxl-grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'control_type' => 'responsive',
                            ),
                            array(
                                'name'         => 'gap_extra',
                                'label'        => esc_html__( 'Item Gap Bottom', 'organify' ),
                                'description'  => esc_html__( 'Add extra space at bottom of each items','organify'),
                                'type'         => \Elementor\Controls_Manager::NUMBER,
                                'default'      => 0,
                                'control_type' => 'responsive',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-grid-inner .pxl-grid-item' => 'margin-bottom: {{VALUE}}px;',
                                ],
                            )
                        ),
organify_elementor_animation_opts([
    'name'   => 'item',
    'label' => esc_html__('Item', 'organify'),
])
)
),
array(
    'name' => 'grid_section',
    'label' => esc_html__('Grid Settings', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    'controls' => array_merge(
        organify_grid_column_settings()
    ),
),


array(
    'name' => 'tab_style_title',
    'label' => esc_html__('Title', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'condition' => [
        'layout'    => '2',
    ],
    'controls' => array(
        array(
            'name'  => 'title_color',
            'label' => esc_html__('Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-grid .pxl-heading--product-grid .pxl-title--grid' => 'color: {{VALUE}} !important;',
            ],
        ),
        array(
            'name' => 'title_typography',
            'label' => esc_html__(' Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-product-grid .pxl-heading--product-grid .pxl-title--grid',
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
                '{{WRAPPER}} .pxl-product-grid .pxl-heading--product-grid .pxl-title--grid' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ),

        array(
            'name'  => 'title_max_width',
            'label' => esc_html__('Max Width','organify'),
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
                '{{WRAPPER}} .pxl-product-grid .pxl-heading--product-grid .pxl-title--grid' => 'max-width: {{SIZE}}{{UNIT}};',
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
    'name' => 'tab_style_filter',
    'label' => esc_html__('Filter', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'condition' => [
        'filter'    => 'true',
    ],
    'controls' => array(
        array(
            'name'  => 'text_filter_color',
            'label' => esc_html__('Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-grid-filter .filter-item' => 'color: {{VALUE}} !important;',
            ],
        ),
        array(
            'name'  => 'text_filter_color_active',
            'label' => esc_html__('Color Active','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-grid-filter .filter-item.active' => 'color: {{VALUE}} !important;',
            ],
        ),
        array(
            'name'  => 'filter_bg_color',
            'label' => esc_html__('Background Color Active','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-grid-filter .filter-item::before' => 'background: {{VALUE}} !important;',
            ],
        ),
        array(
            'name' => 'text_filter_typography',
            'label' => esc_html__(' Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-grid-filter .filter-item',
        ),
        array(
            'name'  => 'space_item_filter',
            'label' => esc_html__('Space Item','organify'),
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
                '{{WRAPPER}} .pxl-grid-filter' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ),
        array(
            'name'  => 'space_bottom_item_filter',
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
                '{{WRAPPER}} .pxl-grid-filter' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ),
    ),
),

array(
    'name' => 'tab_style_product_item',
    'label' => esc_html__('Product Item', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name'  => 'bg_color_image',
            'label' => esc_html__('Background Color Image','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-grid.pxl-product-grid .pxl-grid-inner .woocommerce-product-inner .woocommerce-product-header::after' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => ['2','3'],
            ],
        ),
        array(
            'name'  => 'bg_color_image_hv',
            'label' => esc_html__('Background Color Image Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-grid.pxl-product-grid .pxl-grid-inner .woocommerce-product-inner:hover .woocommerce-product-header::after' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => ['2','3'],
            ],
        ),
        array(
            'name'  => 'bg_color_item',
            'label' => esc_html__('Background Color Item','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-grid.pxl-product-grid .pxl-grid-inner .woocommerce-product-inner ' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => ['2','3'],
            ],
        ),
        array(
            'name'  => 'background_color_prd_hv',
            'label' => esc_html__('Backgorund Color Item Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner:hover' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => ['2','3'],
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
            'condition' => [
                'layout'    => ['1','2'],
            ],
        ),

        array(
            'name'  => 'icon_color_toolbar',
            'label' => esc_html__('Icon Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-header .woocommerce--toolbar button:after' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => ['1','2'],
            ],
        ),
        array(
            'name'  => 'icon_color_toolbar_hv',
            'label' => esc_html__('Icon Color Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-header .woocommerce--toolbar button:hover:after' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => ['1','2'],
            ],
        ),
        array(
            'name'  => 'bg_color_toolbar_',
            'label' => esc_html__('Background Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-header .woocommerce--toolbar button' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => ['1','2'],
            ],
        ),
        array(
            'name'  => 'bg_color_toolbar_hv',
            'label' => esc_html__('Background Color Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-header .woocommerce--toolbar button:hover' => 'background-color: {{VALUE}};',
                '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-header .woocommerce--toolbar .woos::before,
                {{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-header .woocommerce--toolbar .woos::after' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => ['1','2'],
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
            'name' => 'border_prd',
            'label' => esc_html__('Border', 'organify' ),
            'type' => \Elementor\Group_Control_Border::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-grid.pxl-product-grid .pxl-product--inner ',
            'condition' => [
                'layout'    => '2',
            ],
        ),

        array(
            'name'  => 'heading_category_prd',
            'label' => esc_html__('Category Product','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'layout'    => ['2','3'],
            ],
        ),
        array(
            'name'  => 'category_color_prd',
            'label' => esc_html__('Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-grid.pxl-product-grid .pxl-product--inner .product-category a' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => ['2','3'],
            ],
        ),
        array(
            'name'  => 'category_color_prd_hv',
            'label' => esc_html__('Color Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-grid.pxl-product-grid .pxl-product--inner .product-category a:hover' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => '2',
            ],
        ),
        array(
            'name' => 'category_typography_prd',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-grid.pxl-product-grid .pxl-product--inner .product-category a',
            'condition' => [
                'layout'    => ['2','3'],
            ],
        ),

        array(
            'name'  => 'heading_star_prd',
            'label' => esc_html__('Star Rating','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'layout'    => '2',
                'show_rating'   => 'true',
            ],
        ),
        array(
            'name'  => 'star_color_prd',
            'label' => esc_html__('Color Star','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .woocommerce .star-rating span::before' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => '2',
                'show_rating'   => 'true',
            ],
        ),


        array(
            'name'  => 'heading_title_prd',
            'label' => esc_html__('Title Product','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name'  => 'title_color_prd',
            'label' => esc_html__('Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-grid .woocommerce-product-title a' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'title_color_prd_hv',
            'label' => esc_html__('Color Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-grid .woocommerce-product-title a:hover' => 'color: {{VALUE}};',
            ],
        ),

        array(
            'name' => 'title_typography_prd',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-product-grid .woocommerce-product-title a',
        ), 


        array(
            'name'  => 'heading_excerpt_prd',
            'label' => esc_html__('Excerpt Product','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'layout'    => '1',
                'show_excerpt'   => 'true',
            ],
        ),
        array(
            'name'  => 'excerpt_color_prd',
            'label' => esc_html__('Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-products--inner .woocommerce-product-content .woocommerce-sg-product-excerpt' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => '1',
                'show_excerpt'   => 'true',
            ],
        ),
        array(
            'name' => 'excerpt_typography_prd',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-products--inner .woocommerce-product-content .woocommerce-sg-product-excerpt',
            'condition' => [
                'layout'    => '1',
                'show_excerpt'   => 'true',
            ],
        ),


        array(
            'name'  => 'heading_price_prd',
            'label' => esc_html__('Price','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name'  => 'price_color_prd',
            'label' => esc_html__('Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-product-grid.layout-2 .pxl-grid-inner .woocommerce-product-content .woocommerce-product--price ,
                {{WRAPPER}} .pxl-product-grid.layout-2 .pxl-grid-inner .woocommerce-product-content .woocommerce-product--price ins,
                {{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-product--price ,
                {{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-product--price ins' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'price_typography_prd',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-product-grid.layout-2 .pxl-grid-inner .woocommerce-product-content .woocommerce-product--price > span,
            {{WRAPPER}} .pxl-product-grid.layout-2 .pxl-grid-inner .woocommerce-product-content .woocommerce-product--price ins,
            {{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-product--price > span,
            {{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-product--price ins'
        ),

        array(
            'name'  => 'heading_sale_prd',
            'label' => esc_html__('Sale','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name'  => 'sale_color_prd',
            'label' => esc_html__('Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
              '{{WRAPPER}} .woocommerce .woocommerce-product-inner .woocommerce-product-content .woocommerce-product--price del > span,
              {{WRAPPER}} .pxl-product-grid.layout-2 .pxl-grid-inner .woocommerce-product-content .woocommerce-product--price del > span' => 'color: {{VALUE}};',
          ],
      ),
        array(
            'name' => 'sale_typography_prd',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-grid-inner .woocommerce-product-content .woocommerce-product--price del span'
        ),
    ),
),

array(
    'name' => 'tab_style_button',
    'label' => esc_html__('Button', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'condition' => [
        'layout'    => ['1','2'],
    ],
    'controls' => array(
        array(
            'name'  => 'button_color_prd',
            'label' => esc_html__('Button Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-grid.pxl-product-grid .pxl-grid-inner .pxl-add-to-cart a' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'button_color_prd_hv',
            'label' => esc_html__('Button Color Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-grid.pxl-product-grid .pxl-grid-inner .pxl-add-to-cart a:hover' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'icon_color_prd',
            'label' => esc_html__('Icon Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-grid.pxl-product-grid .pxl-grid-inner .pxl-add-to-cart a svg path' => 'stroke: {{VALUE}} !important;',
            ],
        ),

        array(
            'name'  => 'icon_color_prd_hv',
            'label' => esc_html__('Icon Color Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-grid.pxl-product-grid .pxl-grid-inner .pxl-add-to-cart a:hover svg path' => 'stroke: {{VALUE}} !important;',
            ],
        ),

        array(
            'name'  => 'bg_color_prd',
            'label' => esc_html__('Background Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-grid.pxl-product-grid .pxl-grid-inner .pxl-add-to-cart a' => 'background-color: {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'bg_color_prd_hv',
            'label' => esc_html__('Background Color Hover','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-grid.pxl-product-grid .pxl-grid-inner .pxl-add-to-cart a:hover' => 'background-color: {{VALUE}};',
            ],
        ),

        array(
            'name'  => 'button_border_color_prd',
            'label' => esc_html__('Button Border Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-grid.pxl-product-grid .pxl-grid-inner .pxl-add-to-cart a' => 'border-color: {{VALUE}} !important;',
                '{{WRAPPER}} .pxl-grid.pxl-product-grid .pxl-grid-inner .pxl-add-to-cart a::before' => 'background: {{VALUE}} !important;',
            ],
        ),
        array(
            'name' => 'button_typography_prd',
            'label' => esc_html__('Button Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-grid.pxl-product-grid .pxl-grid-inner .pxl-add-to-cart a' ,
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
                '{{WRAPPER}} .pxl-grid.pxl-product-grid .pxl-grid-inner .pxl-add-to-cart a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ),
    )
),
organify_widget_animation_settings()
),
),
),
organify_get_class_widget_path()
);