<?php
$slides_to_show = range( 1, 10 );
$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
pxl_add_custom_widget(
    array(
        'name' => 'pxl_slide_home',
        'title' => esc_html__('Case Slide Home', 'organify'),
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
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_slide_home/layout1.jpg'
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
                                    'name'  => 'bg_color',
                                    'label' => esc_html__('Background Color','organify'),
                                    'type'  => \Elementor\Controls_Manager::COLOR,
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-slide--home {{CURRENT_ITEM}} .pxl-item--inner' => 'background-color:{{VALUE}};',
                                    ],
                                ),
                                array(
                                    'name'  => 'title',
                                    'label' => esc_html__('Title','organify'),
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
                                    'name'  => 'concept',
                                    'label' => esc_html__('Concept','organify'),
                                    'type'  => \Elementor\Controls_Manager::TEXT,
                                    'label_block'   => true,
                                ),
                                array(
                                    'name'  => 'style_info_prd',
                                    'label' => esc_html__('Style Info Product','organify'),
                                    'type'  => \Elementor\Controls_Manager::SELECT,
                                    'options'   => [
                                        'inf-style-1'  => esc_html__('Style 1','organify'),
                                        'inf-style-2'  => esc_html__('Style 2','organify'),
                                    ],
                                    'default'   => 'inf-style-1',
                                ),
                                array(
                                    'name'  => 'price',
                                    'label' => esc_html__('Price','organify'),
                                    'type'  => \Elementor\Controls_Manager::TEXT,
                                ),
                                array(
                                    'name'  => 'units',
                                    'label' => esc_html__('Units','organify'),
                                    'type'  => \Elementor\Controls_Manager::TEXT,
                                ), 
                                array(
                                    'name'  => 'attributes',
                                    'label' => esc_html__('Attributes','organify'),
                                    'type'  => \Elementor\Controls_Manager::TEXT,
                                    'label_block'   => true,
                                ),
                                array(
                                    'name' => 'product_image',
                                    'label' => esc_html__('Product Image', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                ),
                                array(
                                    'name' => 'img_size',
                                    'label' => esc_html__('Image Size', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'description' => 'Enter image size - Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme. Alternatively enter size in pixels Example: 550x520 - Width x Height.',
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
            'name' => 'col_lg',
            'label' => esc_html__('Columns LG Devices', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '1',
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
            'name' => 'col_xxl',
            'label' => esc_html__('Columns XXL Devices', 'organify' ),
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
    'name'  => 'section_carousel_introduction',
    'label' => esc_html__('Introduction','organify'),
    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    'controls'  => array(
        array(
            'name'  => 'introduction_title',
            'label' => esc_html__('Title','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name'  => 'introduction_title_color',
            'label' => esc_html__('Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-slide--title'  => 'color : {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'introduction_title_typography',
            'label' => esc_html__('Typography','organify'),
            'type'  => \Elementor\Group_Control_Typography::get_type(),
            'control_type'  => 'group',
            'selector' => '{{WRAPPER}} .pxl-slide--home .pxl-slide--title',
        ),

        array(
            'name'  => 'introduction_description',
            'label' => esc_html__('Description','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name'  => 'introduction_description_color',
            'label' => esc_html__('Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-slide--description'  => 'color : {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'introduction_description_typography',
            'label' => esc_html__('Typography','organify'),
            'type'  => \Elementor\Group_Control_Typography::get_type(),
            'control_type'  => 'group',
            'selector' => '{{WRAPPER}} .pxl-slide--home .pxl-slide--description',
            
        ),

        array(
            'name'  => 'introduction_button',
            'label' => esc_html__('Button','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name'  => 'introduction_button_color',
            'label' => esc_html__('Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl--button'  => 'color : {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'introduction_button_bg',
            'label' => esc_html__('Background','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl--button'  => 'background-color : {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'introduction_button_typography',
            'label' => esc_html__('Typography','organify'),
            'type'  => \Elementor\Group_Control_Typography::get_type(),
            'control_type'  => 'group',
            'selector' => '{{WRAPPER}} .pxl-slide--home .pxl--button',
        ),
        array(
            'name'  => 'introduction_button_padding',
            'label' => esc_html__('Padding','organify'),
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
                '{{WRAPPER}} .pxl-slide--home .pxl--button'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
            ],
        ),
        array(
            'name'  => 'introduction_button_border_radius',
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
                '{{WRAPPER}} .pxl-slide--home .pxl--button'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
            ],
        ),
    ),
),
array(
    'name'  => 'section_carousel_content',
    'label' => esc_html__('Content','organify'),
    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    'controls'  => array(
        array(
            'name'  => 'content_concept',
            'label' => esc_html__('Concept','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name'  => 'content_concept_style_text',
            'label' => esc_html__('Style','organify'),
            'type'  => \Elementor\Controls_Manager::SELECT,
            'options'  => [
                'color_normal'   => 'Color Normal',
                'text_stroke'    => 'Text Stroke',
            ],
            'default'   => 'text_stroke',
        ), 
        array(
            'name'  => 'content_concept_color_stroke',
            'label' => esc_html__('Text Stroke','organify'),
            'type'  => \Elementor\Group_Control_Text_Stroke::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-slide--home .pxl-slide--concept',
            'condition' => [
                'content_concept_style_text'    => 'text_stroke',
            ],
        ), 
        array(
            'name'  => 'content_concept_color',
            'label' => esc_html__('Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-slide--concept'  => 'color : {{VALUE}};',
            ],
            'condition' => [
                'content_concept_style_text'    => 'color_normal',
            ],
        ),
        array(
            'name'  => 'content_concept_typography',
            'label' => esc_html__('Typography','organify'),
            'type'  => \Elementor\Group_Control_Typography::get_type(),
            'control_type'  => 'group',
            'selector' => '{{WRAPPER}} .pxl-slide--home .pxl-slide--concept',
        ),

        array(
            'name'  => 'content_price',
            'label' => esc_html__('Price','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name'  => 'content_price_color',
            'label' => esc_html__('Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-slide--price'  => 'color : {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'content_price_typography',
            'label' => esc_html__('Typography','organify'),
            'type'  => \Elementor\Group_Control_Typography::get_type(),
            'control_type'  => 'group',
            'selector' => '{{WRAPPER}} .pxl-slide--home .pxl-slide--price',
        ),

        array(
            'name'  => 'content_units',
            'label' => esc_html__('Units','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name'  => 'content_units_color',
            'label' => esc_html__('Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-slide--units'  => 'color : {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'content_units_typography',
            'label' => esc_html__('Typography','organify'),
            'type'  => \Elementor\Group_Control_Typography::get_type(),
            'control_type'  => 'group',
            'selector' => '{{WRAPPER}} .pxl-slide--home .pxl-slide--units',
        ),

        array(
            'name'  => 'content_attributes',
            'label' => esc_html__('Attributes','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name'  => 'content_attributes_color',
            'label' => esc_html__('Color','organify'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-slide--home .pxl-slide--attributes'  => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name'  => 'content_attributes_typography',
            'label' => esc_html__('Typography','organify'),
            'type'  => \Elementor\Group_Control_Typography::get_type(),
            'control_type'  => 'group',
            'selector' => '{{WRAPPER}} .pxl-slide--home .pxl-slide--attributes',
        ),

    ),
),

array(
    'name'  => 'section_carousel_img_product',
    'label' => esc_html__('Image Product','organify'),
    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    'controls'  => array(
         array(
            'name' => 'img_effect',
            'label' => esc_html__('Image Effect', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '' => 'None',
                'pxl-image-effect1' => 'Zigzag',
                'pxl-image-tilt' => 'Tilt',
                'pxl-image-spin' => 'Spin',
                'pxl-image-zoom' => 'Zoom 1',
                'pxl-image-zoom2' => 'Zoom 2',
                'pxl-image-bounce' => 'Bounce',
                'slide-up-down' => 'Slide Up Down',
                'slide-top-to-bottom' => 'Slide Top To Bottom ',
                'pxl-image-effect2' => 'Slide Bottom To Top ',
                'slide-right-to-left' => 'Slide Right To Left ',
                'slide-left-to-right' => 'Slide Left To Right ',
                'pxl-hover1' => 'ZoomIn',
                'pxl-hover2' => 'ZoomOut',
                'pxl-animation-round' => 'Round',
                'pxl-image-parallax' => 'Parallax Hover',
                'pxl-parallax-scroll' => 'Parallax Scroll',
            ],
            'default' => '',
           
        ),
        array(
            'name' => 'parallax_scroll_type',
            'label' => esc_html__('Parallax Scroll Type', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'y' => 'Effect Y',
                'x' => 'Effect X',
                'z' => 'Effect Z',
            ],
            'default' => 'y',
            'condition' => [
                'img_effect' => 'pxl-parallax-scroll',
            ],
        ),
        array(
            'name' => 'parallax_scroll_value_x',
            'label' => esc_html__('Parallax Value', 'organify' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'condition' => [
                'img_effect' => 'pxl-parallax-scroll',
            ],
            'default' => '80',
            'description' => esc_html__('Enter number.', 'organify' ),
        ),
        array(
            'name' => 'parallax_value',
            'label' => esc_html__('Parallax Value', 'organify' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'condition' => [
                'img_effect' => 'pxl-image-parallax',
            ],
            'default' => '40',
            'description' => esc_html__('Enter number.', 'organify' ),
        ),
    ),
),
organify_widget_animation_settings(),
),
),
),
organify_get_class_widget_path()
);