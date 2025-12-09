<?php
$templates_df = [0 => esc_html__('- None', 'organify')];
$templates = $templates_df + organify_get_templates_option('hidden-panel',false) ;
$page_templates = $templates_df + organify_list_post('page',false) ;

pxl_add_custom_widget(
    array(
        'name'       => 'pxl_user_anchor',
        'title'      => esc_html__( 'Case User Anchor', 'organify' ),
        'icon'       => 'eicon-lock-user',
        'categories' => array('pxltheme-core'),
        'scripts'    => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'icon_section',
                    'label'    => esc_html__( 'Settings', 'organify' ),
                    'tab'      => 'content',
                    'controls' => array(

                        array(
                            'name'        => 'title_login',
                            'label'       => esc_html__( 'Title Login', 'organify' ),
                            'type'        => 'textarea',
                            'placeholder' => esc_html__( 'My Account', 'organify' ),
                            'separator' => 'before',
                        ),
                        array(
                            'name'             => 'selected_icon',
                            'label'            => esc_html__( 'Icon', 'organify' ),
                            'type'             => 'icons',
                            'default'          => [
                                'library' => 'lnil',
                                'value'   => 'lnil lnil-user'
                            ],
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'organify' ),
                            'type' => 'color',
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor, {{WRAPPER}} .pxl-anchor-icon' => 'color: {{VALUE}};',
                            ],
                            'condition'     => [
                                'selected_icon[value]!' => ''
                            ] 
                        ), 
                        array(
                            'name' => 'icon_color_hover',
                            'label' => esc_html__('Icon Hover Color', 'organify' ),
                            'type' => 'color',
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-user-anchor-wrap:hover, {{WRAPPER}} .pxl-user-anchor-wrap:hover .pxl-anchor-icon' => 'color: {{VALUE}};',
                            ],
                            'condition'     => [
                                'selected_icon[value]!' => ''
                            ]
                        ),
                        array(
                            'name'  => 'icon_size',
                            'label' => esc_html__( 'Icon Size(px)', 'organify' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 15,
                                    'max' => 300,
                                ],
                            ],
                            'control_type' => 'responsive',
                            'default' => [
                                'unit' => 'px',
                                'size' => 25
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                            'condition'     => [
                                'selected_icon[value]!' => ''
                            ]
                        ),
                        array(
                            'name' => 'icon_margin',
                            'label' => esc_html__('Icon Margin(px)', 'organify' ),
                            'type' => 'dimensions',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition'     => [
                                'selected_icon[value]!' => ''
                            ]
                        ),  

                        array(
                            'name'        => 'title_profile',
                            'label'       => esc_html__( 'Title Profile', 'organify' ),
                            'type'        => 'textarea',
                            'placeholder' => esc_html__( 'My Account', 'organify' ),
                            'separator' => 'before',
                        ),

                        array(
                            'name'        => 'style_hover',
                            'label'       => esc_html__( 'Style Hover', 'organify' ),
                            'type'        => 'select',
                            'options'     => [
                                'df'        => esc_html__('Default','organify'),
                                'st-arrow'  => esc_html__('Hover Arrow','organify'),
                            ],
                            'default'   => 'df',
                        ),

                        array(
                            'name' => 'profile_link_page',
                            'label' => esc_html__('Page Profile', 'organify'),
                            'type' => 'select',
                            'options' => $page_templates,
                            'default' => 0,
                            'separator' => 'before',
                        ),
                        array(
                            'name'        => 'profile_text',
                            'label'       => esc_html__( 'Profile Text', 'organify' ),
                            'type'        => 'text',
                            'default'     =>  esc_html__( 'Edit Profile', 'organify' ),
                        ),
                        array(
                            'name' => 'logout_link_page',
                            'label' => esc_html__('Logout Link Page', 'organify'),
                            'type' => 'select',
                            'options' => $page_templates,
                            'default' => 0,
                            'separator' => 'before',
                        ),
                        array(
                            'name'        => 'logout_text',
                            'label'       => esc_html__( 'Logout Text', 'organify' ),
                            'type'        => 'text',
                            'default'     =>  esc_html__( 'Sign out', 'organify' ),
                        ),
                        array(
                            'name'         => 'align',
                            'label'        => esc_html__( 'Alignment', 'organify' ),
                            'type'         => 'choose',
                            'control_type' => 'responsive',
                            'options' => [
                                'start' => [
                                    'title' => esc_html__( 'Start', 'organify' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'organify' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'end' => [
                                    'title' => esc_html__( 'End', 'organify' ),
                                    'icon' => 'eicon-text-align-right',
                                ]
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-user-anchor-wrap' => 'justify-content: {{VALUE}};',
                            ],
                        ),

                    ),

),
array(
    'name'     => 'section_style',
    'label'    => esc_html__( 'Style', 'organify' ),
    'tab'      => 'content',
    'controls' => array(

        array(
            'name'  => 'heading_title',
            'label' => esc_html__('Title','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
        ),
        array(
            'name' => 'title_color',
            'label' => esc_html__('Title Color', 'organify' ),
            'type' => 'color',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} .pxl-user-anchor .pxl-title--profile, {{WRAPPER}} .pxl-user-anchor .anchor-title' => 'color: {{VALUE}};',
            ],
        ), 
        array(
            'name' => 'title_color_hover',
            'label' => esc_html__('Title Hover Color', 'organify' ),
            'type' => 'color',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}}  .pxl-user-anchor:hover .pxl-title--profile, {{WRAPPER}} .pxl-user-anchor:hover .anchor-title' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'title_typography',
            'label' => esc_html__('Title Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-user-anchor .pxl-title--profile, {{WRAPPER}} .pxl-user-anchor .anchor-title',
        ),

        array(
            'name'  => 'heading_submenu',
            'label' => esc_html__('Sub Menu','organify'),
            'type'  => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ),
        array(
            'name' => 'background_color_submenu',
            'label' => esc_html__('Background Color', 'organify' ),
            'type' => 'color',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} .pxl-user-anchor .pxl--submenu' => 'background: {{VALUE}};',
            ],
        ), 
        array(
            'name' => 'border_submenu',
            'label' => esc_html__('Border', 'organify' ),
            'type' => \Elementor\Group_Control_Border::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-user-anchor .pxl--submenu',
        ),
        array(
            'name' => 'submenu_color',
            'label' => esc_html__('Color', 'organify' ),
            'type' => 'color',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} .pxl-user-anchor .pxl-author--info a,{{WRAPPER}} .pxl-user-anchor .pxl--avatar .username' => 'color: {{VALUE}};',
            ],
        ),

        array(
            'name' => 'submenu_color_hv',
            'label' => esc_html__('Color Hover', 'organify' ),
            'type' => 'color',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} .pxl-user-anchor .pxl-author--info a:hover,{{WRAPPER}} .pxl-user-anchor .pxl--avatar .username:hover' => 'color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'submenu_typography',
            'label' => esc_html__('Typography', 'organify' ),
            'type' => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector' => '{{WRAPPER}} .pxl-user-anchor .pxl-author--info a',
        ),
        array(
            'name' => 'border_radius_submenu',
            'label' => esc_html__( 'Border Radius Sub Menu', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors' => [
                '{{WRAPPER}} .pxl-user-anchor .pxl--submenu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
            ],
        ),
        array(
            'name' => 'padding_submenu',
            'label' => esc_html__( 'Padding', 'organify' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'selectors' => [
                '{{WRAPPER}} .pxl-user-anchor .pxl--submenu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
            ],
        ),

    ),
),

)
)
),
organify_get_class_widget_path(),
);