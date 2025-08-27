<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_info_box',
        'title' => esc_html__('Case Info Box', 'organify' ),
        'icon' => 'eicon-info-box',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'organify' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'name_author',
                            'label' => esc_html__('Name Author', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'desc',
                            'label' => esc_html__('Description', 'organify' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'img_box',
                            'label' => esc_html__('Image Box', 'organify' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                        ),
                    ),
                ),
                array(
                    'name'  => 'section_style',
                    'label' => esc_html__('Style','organify'),
                    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls'  => array(
                        array(
                            'name'  => 'heading_name_author',
                            'label' => esc_html__('Name Author','organify'),
                            'type'  => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                        ),
                        array(
                            'name' => 'name_color',
                            'label' => esc_html__('Color','organify'),
                            'type'  => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-info-box .pxl-name--author'  => 'color: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name'         => 'name_typography',
                            'label' => esc_html__( 'Typography', 'organify' ),
                            'type'         => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .pxl-info-box .pxl-name--author',
                        ), 

                        array(
                            'name'  => 'heading_description_author',
                            'label' => esc_html__('Description','organify'),
                            'type'  => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                        ),
                        array(
                            'name' => 'description_color',
                            'label' => esc_html__('Color','organify'),
                            'type'  => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-info-box .pxl-item--desc'  => 'color: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name'         => 'description_typography',
                            'label' => esc_html__( 'Typography', 'organify' ),
                            'type'         => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .pxl-info-box .pxl-item--desc',
                        ),
                    ),
                ),
                organify_widget_animation_settings(),
            ),
        ),
    ),
    organify_get_class_widget_path()
);