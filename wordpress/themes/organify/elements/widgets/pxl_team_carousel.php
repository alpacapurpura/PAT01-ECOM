<?php
$slides_to_show = range( 1, 10 );
$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
pxl_add_custom_widget(
    array(
        'name' => 'pxl_team_carousel',
        'title' => esc_html__('Case Team Carousel', 'organify'),
        'icon' => 'eicon-lock-user',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'swiper',
            'pxl-swiper',
        ),
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
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_team_carousel/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'organify' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_team_carousel/layout2.jpg'
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
                            'name' => 'team',
                            'label' => esc_html__('Content', 'organify'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'image',
                                    'label' => esc_html__('Image', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                ),
                                array(
                                    'name' => 'title',
                                    'label' => esc_html__('Title', 'organify'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'position',
                                    'label' => esc_html__('Position', 'organify'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                    'description'   => 'Only applicable in some layouts !'
                                ),
                                array(
                                    'name' => 'item_link',
                                    'label' => esc_html__('Link Details', 'organify'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'title_color_item',
                                    'label' => esc_html__('Title Color', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::COLOR,
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-team-carousel {{CURRENT_ITEM}} .pxl-item--title' => 'color: {{VALUE}};',
                                    ],
                                ),
                                array(
                                    'name' => 'bg_item',
                                    'label' => esc_html__('Background Color', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::COLOR,
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-team-carousel {{CURRENT_ITEM}} img,
                                        {{WRAPPER}} .pxl-team-carousel {{CURRENT_ITEM}} .pxl-item--inner' => 'background-color: {{VALUE}};',
                                    ],
                                ),
                                array(
                                    'name' => 'img_rotate',
                                    'label' => esc_html__('Image Rotate', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::SLIDER,
                                    'control_type' => 'responsive',
                                    'description'   => 'Only applicable in some layouts !',
                                    'size_units' => [ 'deg' ],
                                    'range' => [
                                        'px' => [
                                        'min' => 0,
                                        'max' => 360,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-team-carousel {{CURRENT_ITEM}} .pxl-item--image' => 'transform: rotate({{SIZE}}deg);',
                                ],
                            ),
                                array(
                                    'name' => 'social',
                                    'label' => esc_html__( 'Social', 'organify' ),
                                    'type' => 'pxl_icons',
                                    'description'   => 'Only applicable in some layouts !'
                                ),
                            ),
'title_field' => '{{{ title }}}',
),

),
),

array(
    'name' => 'tab_style',
    'label' => esc_html__('Style', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'bg_item_inner',
            'label' => esc_html__('Background Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-team-carousel .pxl-item--inner' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => '2',
            ],
        ),
        array(
            'name' => 'space_items',
            'label' => esc_html__('Space Item', 'organify' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'description'   => 'Default : -350px.',
            'control_type' => 'responsive',
            'size_units' => [ 'px','custom' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-team-carousel .pxl-carousel-inner' => 'margin-inline: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'layout'    => '1',
            ],
        ),
        array(
            'name' => 'space_items_layout2',
            'label' => esc_html__('Space Item', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'control_type' => 'responsive',
            'size_units' => [ 'px' ],
            'selectors' => [
                '{{WRAPPER}} .pxl-team-carousel .pxl--content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'layout'    => '2',
            ],
        ),
        array(
            'name' => 'heading_title',
            'label' => esc_html__('Title', 'organify' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name' => 'title_color',
            'label' => esc_html__('Title Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-team .pxl-item--title' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'title_typography',
            'label' => esc_html__('Title Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-team .pxl-item--title',
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

        array(
            'name' => 'heading_position',
            'label' => esc_html__('Position', 'organify' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'layout'    => '2',
            ],
        ),
        array(
            'name' => 'position_color',
            'label' => esc_html__('Position Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-team .pxl-item--position' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => '2',
            ],
        ),
        array(
            'name' => 'position_typography',
            'label' => esc_html__('Position Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-team .pxl-item--position',
            'condition' => [
                'layout'    => '2',
            ],
        ),


        array(
            'name' => 'heading_img',
            'label' => esc_html__('Image', 'organify' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),

        array(
            'name' => 'img_border_radius',
            'label' => esc_html__('Border Radius Image', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'control_type' => 'responsive',
            'size_units' => [ 'px' ],
            'selectors' => [
                '{{WRAPPER}} .pxl-team .pxl-swiper-slide img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ),

        array(
            'name' => 'img_border_radius_center',
            'label' => esc_html__('Border Radius Image Center', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'control_type' => 'responsive',
            'size_units' => [ 'px' ],
            'selectors' => [
                '{{WRAPPER}} .pxl-team .swiper-slide-center img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ),
        array(
            'name' => 'height_img_center',
            'label' => esc_html__('Height Image Center', 'organify' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'description'   => 'Default : 580px.',
            'control_type' => 'responsive',
            'size_units' => [ 'px','custom' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-team-carousel .pxl-item--image' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ),

    ),
),
array(
    'name' => 'section_carousel_social',
    'label' => esc_html__('Social', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'condition' => [
        'layout'    => '2',
    ],
    'controls' => array(
        array(
            'name' => 'social_color',
            'label' => esc_html__('Social Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-team-carousel .pxl-item--social i' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => '2',
            ],
        ),
        array(
            'name' => 'border_social_color',
            'label' => esc_html__('Border Social Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-team-carousel .pxl-item--social a' => 'border-color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => '2',
            ],
        ),
        array(
            'name' => 'background_social_color',
            'label' => esc_html__('Background Social Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-team-carousel .pxl-item--social' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => '2',
            ],
        ),
        array(
            'name' => 'fontsize_icon',
            'label' => esc_html__('Size Icon Social', 'organify' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px','custom' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-team-carousel .pxl-item--social i' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'layout'    => '2',
            ],
        ),

        array(
            'name' => 'heading_social_wrap',
            'label' => esc_html__('Social Wrap', 'organify' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'layout'    => '2',
            ],
        ),
        array(
            'name' => 'color_social_wrap',
            'label' => esc_html__('Color Social Wrap', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-team-carousel .pxl-icon--plus::before,
                {{WRAPPER}} .pxl-team-carousel .pxl-icon--plus::after' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => '2',
            ],
        ),

        array(
            'name' => 'background_social_wrap',
            'label' => esc_html__('Background Social Wrap', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-team-carousel .pxl-social--wrap' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => '2',
            ],
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
),
),
),
organify_get_class_widget_path()
);