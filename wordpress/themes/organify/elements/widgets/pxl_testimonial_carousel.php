<?php
$slides_to_show = range( 1, 10 );
$slides_to_show = array_combine( $slides_to_show, $slides_to_show );

pxl_add_custom_widget(
    array(
        'name' => 'pxl_testimonial_carousel',
        'title' => esc_html__('Case Testimonial Carousel', 'organify'),
        'icon' => 'eicon-testimonial',
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
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_testimonial_carousel/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'organify' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_testimonial_carousel/layout2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__('Layout 3', 'organify' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_testimonial_carousel/layout3.jpg'
                                ],
                                '4' => [
                                    'label' => esc_html__('Layout 4', 'organify' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_testimonial_carousel/layout4.jpg'
                                ],
                                '5' => [
                                    'label' => esc_html__('Layout 5', 'organify' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_testimonial_carousel/layout5.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'organify'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'testimonial',
                            'label' => esc_html__('Testimonial', 'organify'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
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
                                ),
                                array(
                                    'name' => 'desc',
                                    'label' => esc_html__('Description', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'rows' => 10,
                                    'show_label' => false,
                                ),
                                array(
                                    'name' => 'star',
                                    'label' => esc_html__('Star Rating', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::SELECT,
                                    'options' => [
                                        '1' => '1 star',
                                        '2' => '2 stars',
                                        '3' => '3 stars',
                                        '4' => '4 stars',
                                        '5' => '5 stars',
                                    ],
                                    'default' => '5',
                                ),
                                array(
                                    'name' => 'image',
                                    'label' => esc_html__('Avatar', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                    'description'   => 'Only applicable in some layouts!'
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
                        ),

                        array(
                            'name' => 'max_height_items',
                            'label' => esc_html__('Max Height', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px', 'custom' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .swiper-vertical' => 'max-height: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout'    => ['5'],
                            ],
                        ),
                        array(
                            'name' => 'margin_items_vertical',
                            'label' => esc_html__('Margin', 'organify' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-swiper-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => [
                                'layout'    => ['5'],
                            ],
                        ),

                    ),
),
array(
    'name' => 'section_style_general',
    'label' => esc_html__('General', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name'  => 'heading_general',
            'label' => esc_html__('General','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name' => 'icon_quote',
            'label' => esc_html__('Icon Quote', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-item--icon svg path' => 'fill: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'bg_icon_quote',
            'label' => esc_html__('Background Icon Quote', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--icon' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => ['4'],
            ],
        ),
        array(
            'name' => 'color_border_introduction',
            'label' => esc_html__('Color Border', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-testimonial-carousel .pxl--introduction::before' => 'border-color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => ['4'],
            ],
        ),

        array(
            'name'  => 'heading_info',
            'label' => esc_html__('Box Info','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'layout'    => ['2'],
            ],
        ),
        

        array(
            'name' => 'bg_info',
            'label' => esc_html__('Background Info', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--inner .pxl-item--holder::after' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => ['2'],
            ],
        ),

        array(
            'name'  => 'box_shadow_group_after_info',
            'label' => esc_html__('Box Shadow','organify'),
            'type'  => \Elementor\Group_Control_Box_Shadow::get_type(),
            'control_type'  => 'group',
            'selector'  => '{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--inner .pxl-item--holder::after',
            'condition' => [
                'layout'    => ['2'],
            ],
        ),

        
        array(
            'name'  => 'heading_border_avatar',
            'label' => esc_html__('Border Avatar','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'layout'    => ['2'],
            ],
        ),
        array(
            'name' => 'border_avatar',
            'label' => esc_html__('Border Avatar', 'organify' ),
            'type' => \Elementor\Group_Control_Border::get_type(),
            'control_type'  => 'group',
            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--inner .pxl-item--author img',

            'condition' => [
                'layout'    => ['2'],
            ],
        ),
        array(
            'name' => 'padding_inner',
            'label' => esc_html__('Padding', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px' ],
            'selectors' => [
                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'control_type' => 'responsive',
            'condition' => [
                'layout'    => ['1','3'],
            ],
        ),
        array(
            'name'  => 'heading_background_item',
            'label' => esc_html__('Item','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name'  => 'background_img',
            'label' => esc_html__('Background','organify'),
            'type'  => \Elementor\Group_Control_Background::get_type(),
            'control_type'  => 'group',
            'selector'  => '{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--inner .pxl--content::before,{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--inner .pxl--content',
            'condition' => [
                'layout'    => ['2'],
            ],
        ),
        array(
            'name'  => 'background',
            'label' => esc_html__('Background','organify'),
            'type'  => \Elementor\Group_Control_Background::get_type(),
            'control_type'  => 'group',
            'selector'  => '{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--inner',
            'condition' => [
                'layout'    => ['1','3'],
            ],
        ),
        array(
            'name'  => 'item_box_shadow_group',
            'label' => esc_html__('Box Shadow Item','organify'),
            'type'  => \Elementor\Group_Control_Box_Shadow::get_type(),
            'control_type'  => 'group',
            'selector'  => '{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--inner .pxl--content',
            'condition' => [
                'layout'    => ['2'],
            ],
        ),


    ),
),
array(
    'name' => 'section_style_title',
    'label' => esc_html__('Title', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'title_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--title' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'title_typography',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--title:not(.wg_title)',
        ),

        array(
            'name'  => 'heading_divider',
            'label' => esc_html__('Divider','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'condition' => [
                'layout'    => ['1'],
            ],
        ),
        array(
            'name' => 'divider_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--holder .pxl-item--title::before' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => ['1'],
            ],
        ),
        array(
            'name' => 'divider_width',
            'label' => esc_html__('Width', 'organify' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px', 'custom' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--holder .pxl-item--title::before' => 'width: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--holder .pxl-item--title' => 'padding-left: calc({{SIZE}}{{UNIT}} + 10px);',
            ],
            'condition' => [
                'layout'    => ['1'],
            ],
        ),

    ),
),
array(
    'name' => 'section_style_position',
    'label' => esc_html__('Position', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'position_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--position' => 'color: {{VALUE}};',
            ],

        ),
        array(
            'name' => 'position_typography',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--position',
        ),
    ),
),
array(
    'name' => 'section_style_desc',
    'label' => esc_html__('Description', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'desc_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--desc' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'desc_typography',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--desc',
        ),
    ),
),

array(
    'name' => 'section_style_star',
    'label' => esc_html__('Star Rating', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'star_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--star i' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'star_typography',
            'label' => esc_html__('Font Size', 'organify' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px', 'custom' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-item--star i' => 'font-size: {{SIZE}}{{UNIT}};'
            ],
        ),
    ),
),



array(
    'name' => 'section_settings_carousel',
    'label' => esc_html__('Settings', 'organify'),
    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
    'controls' => array(
        array(
            'name' => 'col_xs',
            'label' => esc_html__('Columns XS Devices', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '1',
            'options' => [
                'auto' => 'Auto',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
            ],
            'condition' => [
                'layout!' => ['2','3','4'],
            ],
        ),
        array(
            'name' => 'col_sm',
            'label' => esc_html__('Columns SM Devices', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '2',
            'options' => [
                'auto' => 'Auto',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
            ],
            'condition' => [
                'layout!' => ['2','3','4'],
            ],
        ),
        array(
            'name' => 'col_md',
            'label' => esc_html__('Columns MD Devices', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '3',
            'options' => [
                'auto' => 'Auto',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
            ],
            'condition' => [
                'layout!' => ['2','3','4'],
            ],
        ),
        array(
            'name' => 'col_lg',
            'label' => esc_html__('Columns LG Devices', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '3',
            'options' => [
                'auto' => 'Auto',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
            ],
            'condition' => [
                'layout!' => ['2','3','4'],
            ],
        ),
        array(
            'name' => 'col_xl',
            'label' => esc_html__('Columns XL Devices', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '3',
            'options' => [
                'auto' => 'Auto',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
            ],
            'condition' => [
                'layout!' => ['2','3','4'],
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
            ],
            'condition' => [
                'layout!' => ['2','3','4'],
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
            ],
            'condition' => [
                'layout!' => ['2','3','4'],
            ],
        ),
        array(
            'name' => 'arrows',
            'label' => esc_html__('Show Arrows', 'organify'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => false,
            'condition' => [
                'layout'    => ['1','2','3'],
            ]
        ),
        array(
            'name' => 'color_arrows',
            'label' => esc_html__('Color Arrows', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-swiper-arrow-wrap i' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => '2',
                'arrows'    => 'true',
            ],
        ),

        array(
            'name' => 'color_arrows_hv',
            'label' => esc_html__('Color Arrows Hover', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-swiper-arrow-wrap  .pxl-swiper-arrow:hover i' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => '2',
                'arrows'    => 'true',
            ],
        ),

        array(
            'name' => 'bg_color_arrows',
            'label' => esc_html__('Background Color Arrows', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-swiper-arrow-wrap .pxl-swiper-arrow' => 'background: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => '2',
                'arrows'    => 'true',
            ],
        ),

        array(
            'name' => 'bg_color_arrows_hv',
            'label' => esc_html__('Background Color Arrows Hover', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-swiper-arrow-wrap .pxl-swiper-arrow:hover' => 'background: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => '2',
                'arrows'    => 'true',
            ],
        ),

        array(
            'name' => 'border_color_arrows',
            'label' => esc_html__('Border Color Arrows', 'organify'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-swiper-arrow-wrap .pxl-swiper-arrow' => 'border-color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => '2',
                'arrows'    => 'true',
            ],
        ),

        array(
            'name' => 'border_color_arrows_hv',
            'label' => esc_html__('Border Color Arrows Hover', 'organify'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-swiper-arrow-wrap .pxl-swiper-arrow:hover' => 'border-color: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => '2',
                'arrows'    => 'true',
            ],
            'separator' => 'after',
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
                'pagination' => 'true',
                'layout'    => ['1','2','3'],
            ]
        ),

        array(
            'name' => 'pause_on_hover',
            'label' => esc_html__('Pause on Hover', 'organify'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
        ),
        array(
            'name' => 'autoplay',
            'label' => esc_html__('Autoplay', 'organify'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
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
organify_widget_animation_settings(),
),
),
),
organify_get_class_widget_path()
);