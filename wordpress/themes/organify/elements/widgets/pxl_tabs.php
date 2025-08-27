<?php
$templates = organify_get_templates_option('tab', []) ;
pxl_add_custom_widget(
    array(
        'name' => 'pxl_tabs',
        'title' => esc_html__( 'Case Tabs', 'organify' ),
        'icon' => 'eicon-tabs',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'organify-tabs'
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
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_tabs/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'organify' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/img/pxl_tabs/layout2.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_content',
                    'label' => esc_html__( 'Tabs', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(

                        array(
                            'name' => 'tab_active',
                            'label' => esc_html__( 'Active Tab', 'organify' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 1,
                            'separator' => 'after',
                        ),
                        array(
                            'name' => 'tabs',
                            'label' => esc_html__( 'Content', 'organify' ),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'title',
                                    'label' => esc_html__( 'Title', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'content_type',
                                    'label' => esc_html__('Content Type', 'organify'),
                                    'type' => 'select',
                                    'options' => [
                                        'df' => esc_html__( 'Default', 'organify' ),
                                        'template' => esc_html__( 'From Template Builder', 'organify' )
                                    ],
                                    'default' => 'df' 
                                ),
                                array(
                                    'name' => 'pxl_icon',
                                    'label' => esc_html__('Icon', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::ICONS,
                                    'fa4compatibility' => 'icon',
                                    'description' => 'Apply layout 2.'
                                ),
                                array(
                                    'name' => 'desc',
                                    'label' => esc_html__( 'Content', 'organify' ),
                                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                                    'condition' => ['content_type' => 'df'] 
                                ),
                                array(
                                    'name' => 'content_template',
                                    'label' => esc_html__('Select Template', 'organify'),
                                    'type' => 'select',
                                    'options' => $templates,
                                    'default' => 'df',
                                    'description' => 'Add new tab template: "<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '" target="_blank">Click Here</a>" and Edit template "<a href="' . esc_url( admin_url( 'edit.php?s&post_status=all&post_type=pxl-template&action=-1&m=0&pxl_filter_template_type=tab&filter_action=Filter&paged=1&action2=-1' ) ) . '" target="_blank">Here.</a>"',
                                    'condition' => ['content_type' => 'template'] 
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
                        ),
                        array(
                            'name' => 'max_width',
                            'label' => esc_html__('Content Max Width', 'organify' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-tabs .pxl-tabs--inner' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
),
array(
    'name' => 'tab_style_general',
    'label' => esc_html__( 'General', 'organify' ),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    'controls' => array(
        array(
            'name' => 'tab_effect',
            'label' => esc_html__('Effect', 'organify' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'tab-effect-slide' => 'Slide',
                'tab-effect-fade' => 'Fade',
            ],
            'default' => 'tab-effect-fade',
        ),
        array(
            'name' => 'border_content',
            'label' => esc_html__('Border Content', 'organify' ),
            'type' => \Elementor\Group_Control_Border::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-tabs1 .pxl-tabs--title,{{WRAPPER}} .pxl-tabs2 .pxl-tab--title',
        ),

         array(
            'name' => 'background_color_item_active',
            'label' => esc_html__('Background Color Active', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-tabs .pxl-tab--title::before' => 'background: {{VALUE}};',
            ],
            'condition' => [
                'layout'    => '2',
            ],
        ),

        array(
            'name'  => 'space_item',
            'label' => esc_html__('Space Items','organify'),
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
                '{{WRAPPER}} .pxl-tabs1 .pxl-tab--title' => 'margin-right: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .pxl-tabs2 .pxl-tab--title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ),
        array(
            'name'  => 'heading_title',
            'label' => esc_html__('Title','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name' => 'title_color',
            'label' => esc_html__('Title Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-tabs .pxl-tab--title' => 'color: {{VALUE}};--tab-title-color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'title_color_active',
            'label' => esc_html__('Title Color Active', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-tabs .pxl-tab--title.active' => 'color: {{VALUE}};--tab-title-color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'title_typography',
            'label' => esc_html__('Title Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-tabs .pxl-tab--title',
            'separator' => 'after',
        ),
        array(
            'name' => 'border_color_title',
            'label' => esc_html__('Border Color Title', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-tabs.pxl-tabs1 .pxl-tab--title::before,
                {{WRAPPER}} .pxl-tabs.pxl-tabs1 .pxl-tab--title::after' => 'background-color: {{VALUE}};',
            ],
            'condition'    => [
                'layout'    => '1',
            ],
        ),
        
        array(
            'name'  => 'heading_icon',
            'label' => esc_html__('Icon','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name' => 'icon_color',
            'label' => esc_html__('Icon Color', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-tabs .pxl-tab--icon svg path' => 'fill: {{VALUE}};',
                '{{WRAPPER}} .pxl-tabs .pxl-tab--icon i ' => 'color: {{VALUE}};',
            ],
            'condition'    => [
                'layout'    => '2',
            ], 
        ),

        array(
            'name' => 'icon_color_active',
            'label' => esc_html__('Icon Color Active', 'organify' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-tabs .active .pxl-tab--icon svg path' => 'fill: {{VALUE}};',
                '{{WRAPPER}} .pxl-tabs .active  .pxl-tab--icon i ' => 'color: {{VALUE}};',
            ],
            'condition'    => [
                'layout'    => '2',
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