<?php
$slides_to_show = range( 1, 10 );
$slides_to_show = array_combine( $slides_to_show, $slides_to_show );

pxl_add_custom_widget(
    array(
        'name' => 'pxl_testimonial_marquee',
        'title' => esc_html__('Case Testimonial Slide', 'organify'),
        'icon' => 'eicon-image',
        'categories' => array('pxltheme-core'),
        'scripts'    => array(
            'gsap',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'organify'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'items',
                            'label' => esc_html__('Items', 'organify'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'image',
                                    'label' => esc_html__('Image', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                ),
                                array(
                                    'name' => 'img_size',
                                    'label' => esc_html__('Image Size', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'description' => 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).',
                                ),
                                array(
                                    'name' => 'text',
                                    'label' => esc_html__('Text', 'organify'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'sub_title',
                                    'label' => esc_html__('Sub Title', 'organify'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'desc',
                                    'label' => esc_html__('Description', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'rows' => 10,
                                    'show_label' => false,
                                ),
                                array(
                                    'name' => 'style_star',
                                    'label' => esc_html__('Choose Star', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::SELECT,
                                    'options' => [
                                        '5' => '5 Star',
                                        '4' => '4 Star',
                                        '3' => '3 Star',
                                        '2' => '2 Star',
                                        '1' => '1 Star',
                                    ],
                                    'default' => '5',
                                ),
                            ),
                            'title_field' => '{{{ text }}}',
                        ),
                        array(
                            'name' => 'show_star',
                            'label' => esc_html__('Show Star', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_style',
                    'label' => esc_html__('Tab Style', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style1' => 'Style 1',
                            ],
                            'default' => 'style1',
                        ),
                        array(
                            'name' => 'effect',
                            'label' => esc_html__('Effect', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'none' => 'None',
                                'text-slide-to-top' => 'Slide to Top',
                                'text-slide-to-bottom' => 'Slide to Bottom',
                            ],
                            'default' => 'none',
                        ),
                        array(
                            'name' => 'effect_speed',
                            'label' => esc_html__('Effect Speed', 'organify'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'description' => 'Default: 16000 - Unit: ms',
                        ),
                    ),
                ),
                organify_widget_animation_settings(),
            ),
        ),
    ),
    organify_get_class_widget_path()
);