<?php

add_action( 'pxl_post_metabox_register', 'organify_page_options_register' );
function organify_page_options_register( $metabox ) {

	$panels = [
		'post' => [
			'opt_name'            => 'post_option',
			'display_name'        => esc_html__( 'Post Options', 'organify' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'post_settings' => [
					'title'  => esc_html__( 'Post Options', 'organify' ),
					'icon'   => 'el el-cog',
					'fields' => array_merge(
						organify_sidebar_pos_opts(['prefix' => 'post_', 'default' => true, 'default_value' => '-1']),
						organify_page_title_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(

							array(
								'id'	=> 'type_post_feature',
								'type'	=> 'button_set',
								'title'	=> esc_html__('Post Feature','organify'),
								'options'	=>  array(
									'default'	=> esc_html__('Default','organify'),
									'video_link'=> esc_html__('Video','organify'),
									'image_swiper'	=> esc_html__('Image Swiper','organify'),
								),
								'default'	=> 'default',	
							),
							array(
								'id'=> 'post_video_link',
								'type' => 'text',
								'title' => esc_html__('Video Link', 'organify'),
								'validate' => 'url',
								'default' => '',
								'indent' => true,
								'required' => array( 0 => 'type_post_feature', 1 => 'equals', 2 => 'video_link' ),
							),
							array(
								'id'       => 'post_images',
								'type'     => 'gallery',
								'title'    => esc_html__('Images', 'organify'),
								'default'  => array(),
								'url'      => false,
								'indent' => true,
								'required' => array( 0 => 'type_post_feature', 1 => 'equals', 2 => 'image_swiper' ),
							),
							array(
								'id'             => 'content_spacing',
								'type'           => 'spacing',
								'output'         => array( '#pxl-wapper #pxl-main' ),
								'right'          => false,
								'left'           => false,
								'mode'           => 'padding',
								'units'          => array( 'px' ),
								'units_extended' => 'false',
								'title'          => esc_html__( 'Spacing Top/Bottom', 'organify' ),
								'default'        => array(
									'padding-top'    => '',
									'padding-bottom' => '',
									'units'          => 'px',
								)
							),
						)
					)
				]
			]
		],
		'page' => [
			'opt_name'            => 'pxl_page_options',
			'display_name'        => esc_html__( 'Page Options', 'organify' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'header' => [
					'title'  => esc_html__( 'Header', 'organify' ),
					'icon'   => 'el-icon-website',
					'fields' => array_merge(
						organify_header_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						organify_header_mobile_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(
							array(
								'id'       => 'header_display',
								'type'     => 'button_set',
								'title'    => esc_html__('Header Display', 'organify'),
								'options'  => array(
									'show' => esc_html__('Show', 'organify'),
									'hide'  => esc_html__('Hide', 'organify'),
								),
								'default'  => 'show',
							),
							array(
								'id'       => 'page_mobile_style',
								'type'     => 'button_set',
								'title'    => esc_html__('Mobile Style', 'organify'),
								'options'  => array(
									'inherit'  => esc_html__('Inherit', 'organify'),
									'light'  => esc_html__('Light', 'organify'),
									'dark'  => esc_html__('Dark', 'organify'),
								),
								'default'  => 'inherit',
							),
							array(
								'id'       => 'logo_m',
								'type'     => 'media',
								'title'    => esc_html__('Mobile Logo Dark', 'organify'),
								'default'  => '',
								'url'      => false,
							),
							array(
								'id'       => 'logo_light_m',
								'type'     => 'media',
								'title'    => esc_html__('Mobile Logo Light', 'organify'),
								'default'  => '',
								'url'      => false,
							),
							array(
								'id'       => 'p_menu',
								'type'     => 'select',
								'title'    => esc_html__( 'Menu', 'organify' ),
								'options'  => organify_get_nav_menu_slug(),
								'default' => '',
								'description' => 'When you select Custom Menu. The custom menu will apply to the entire layout when you use Case Nav Menu widget in Elementor and Menu on header layout in Mobile.'
							),
						),
						array(
							array(
								'id'       => 'sticky_scroll',
								'type'     => 'button_set',
								'title'    => esc_html__('Sticky Scroll', 'organify'),
								'options'  => array(
									'-1' => esc_html__('Inherit', 'organify'),
									'pxl-sticky-stt' => esc_html__('Scroll To Top', 'organify'),
									'pxl-sticky-stb'  => esc_html__('Scroll To Bottom', 'organify'),
								),
								'default'  => '-1',
							),
							array(
								'id'       => 'header_margin',
								'type'     => 'spacing',
								'mode'     => 'margin',
								'title'    => esc_html__('Margin', 'organify'),
								'width'    => false,
								'unit'     => 'px',
								'output'    => array('#pxl-header-elementor .pxl-header-elementor-main'),
							),
						)
					)

				],
				'page_title' => [
					'title'  => esc_html__( 'Page Title', 'organify' ),
					'icon'   => 'el el-indent-left',
					'fields' => array_merge(
						organify_page_title_opts([
							'default'         => true,
							'default_value'   => '-1'
						])
					)
				],
				'content' => [
					'title'  => esc_html__( 'Content', 'organify' ),
					'icon'   => 'el-icon-pencil',
					'fields' => array_merge(
						organify_sidebar_pos_opts(['prefix' => 'page_', 'default' => false, 'default_value' => '0']),
						array(
							array(
								'id'             => 'content_spacing',
								'type'           => 'spacing',
								'output'         => array( '#pxl-wapper #pxl-main' ),
								'right'          => false,
								'left'           => false,
								'mode'           => 'padding',
								'units'          => array( 'px' ),
								'units_extended' => 'false',
								'title'          => esc_html__( 'Spacing Top/Bottom', 'organify' ),
								'default'        => array(
									'padding-top'    => '',
									'padding-bottom' => '',
									'units'          => 'px',
								)
							), 
						)
					)
				],
				'footer' => [
					'title'  => esc_html__( 'Footer', 'organify' ),
					'icon'   => 'el el-website',
					'fields' => array_merge(
						organify_footer_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(
							array(
								'id'       => 'footer_display',
								'type'     => 'button_set',
								'title'    => esc_html__('Footer Display', 'organify'),
								'options'  => array(
									'show' => esc_html__('Show', 'organify'),
									'hide'  => esc_html__('Hide', 'organify'),
								),
								'default'  => 'show',
							),
							array(
								'id'       => 'p_footer_fixed',
								'type'     => 'button_set',
								'title'    => esc_html__('Footer Fixed', 'organify'),
								'options'  => array(
									'inherit' => esc_html__('Inherit', 'organify'),
									'on' => esc_html__('On', 'organify'),
									'off' => esc_html__('Off', 'organify'),
								),
								'default'  => 'inherit',
							),
							array(
								'id'       => 'back_top_top_style',
								'type'     => 'button_set',
								'title'    => esc_html__('Back to Top Style', 'organify'),
								'options'  => array(
									'style-default' => esc_html__('Default', 'organify'),
									'style-round' => esc_html__('Round', 'organify'),
								),
								'default'  => 'style-default',
							),
						)
					)
				],
				'colors' => [
					'title'  => esc_html__( 'Colors', 'organify' ),
					'icon'   => 'el el-website',
					'fields' => array_merge(
						array(
							array(
								'id'        => 'page_body_color',
								'type'      => 'color',
								'title'     => esc_html__('Body Background Color', 'organify'),
								'default'   => '',
								'transparent' => false,
								'output'    => array(
									'background-color' => 'body',
								)
							),
							array(
								'id'          => 'primary_color',
								'type'        => 'color',
								'title'       => esc_html__('Primary Color', 'organify'),
								'transparent' => false,
								'default'     => ''
							),
							array(
								'id'          => 'gradient_color',
								'type'        => 'color_gradient',
								'title'       => esc_html__('Gradient Color', 'organify'),
								'transparent' => false,
								'default'  => array(
									'from' => '',
									'to'   => '', 
								),
							),
						)
					)
				],
				'extra' => [
					'title'  => esc_html__( 'Extra', 'organify' ),
					'icon'   => 'el el-website',
					'fields' => array_merge(
						array(
							array(
								'id' => 'body_custom_class',
								'type' => 'text',
								'title' => esc_html__('Body Custom Class', 'organify'),
							),
							array(
								'id'       => 'site_loader',
								'type'     => 'button_set',
								'title'    => esc_html__('Site Loader', 'organify'),
								'options'  => array(
									'on' => esc_html__('On', 'organify'),
									'off' => esc_html__('Off', 'organify'),
								),
								'default'  => 'off',
							),
							array(
								'id'       => 'site_loader_style',
								'type'     => 'button_set',
								'title'    => esc_html__('Site Loader Style', 'organify'),
								'options'  => array(
									'style-1' => esc_html__('Style 1', 'organify'),
									'style-2' => esc_html__('Style 2', 'organify'),
								),
								'default'  => 'style-1',
								'required' => array( 0 => 'site_loader', 1 => 'equals', 2 => 'on' ),
								'force_output' => true
							),
						)
					)
				]
			]
		],
		'portfolio' => [
			'opt_name'            => 'pxl_portfolio_options',
			'display_name'        => esc_html__( 'Portfolio Options', 'organify' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'header' => [
					'title'  => esc_html__( 'General', 'organify' ),
					'icon'   => 'el-icon-website',
					'fields' => array_merge(
						array(
							array(
								'id'=> 'portfolio_excerpt',
								'type' => 'textarea',
								'title' => esc_html__('Excerpt', 'organify'),
								'validate' => 'html_custom',
								'default' => '',
							),
							array(
								'id'             => 'content_spacing',
								'type'           => 'spacing',
								'output'         => array( '#pxl-wapper #pxl-main' ),
								'right'          => false,
								'left'           => false,
								'mode'           => 'padding',
								'units'          => array( 'px' ),
								'units_extended' => 'false',
								'title'          => esc_html__( 'Content Spacing Top/Bottom', 'organify' ),
								'default'        => array(
									'padding-top'    => '',
									'padding-bottom' => '',
									'units'          => 'px',
								)
							),
						)
					)
				],
			]
		],
		'service' => [
			'opt_name'            => 'pxl_service_options',
			'display_name'        => esc_html__( 'Service Options', 'organify' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'header' => [
					'title'  => esc_html__( 'General', 'organify' ),
					'icon'   => 'el-icon-website',
					'fields' => array_merge(
						array(
							array(
								'id'=> 'service_external_link',
								'type' => 'text',
								'title' => esc_html__('External Link', 'organify'),
								'validate' => 'url',
								'default' => '',
							),
							array(
								'id'=> 'service_excerpt',
								'type' => 'textarea',
								'title' => esc_html__('Excerpt', 'organify'),
								'validate' => 'html_custom',
								'default' => '',
							),
							array(
								'id'       => 'service_icon_type',
								'type'     => 'button_set',
								'title'    => esc_html__('Icon Type', 'organify'),
								'options'  => array(
									'icon'  => esc_html__('Icon', 'organify'),
									'image'  => esc_html__('Image', 'organify'),
								),
								'default'  => 'icon'
							),
							array(
								'id'       => 'service_icon_font',
								'type'     => 'pxl_iconpicker',
								'title'    => esc_html__('Icon', 'organify'),
								'required' => array( 0 => 'service_icon_type', 1 => 'equals', 2 => 'icon' ),
								'force_output' => true
							),
							array(
								'id'       => 'service_icon_img',
								'type'     => 'media',
								'title'    => esc_html__('Icon Image', 'organify'),
								'default' => '',
								'required' => array( 0 => 'service_icon_type', 1 => 'equals', 2 => 'image' ),
								'force_output' => true
							),
							array(
								'id'             => 'content_spacing',
								'type'           => 'spacing',
								'output'         => array( '#pxl-wapper #pxl-main' ),
								'right'          => false,
								'left'           => false,
								'mode'           => 'padding',
								'units'          => array( 'px' ),
								'units_extended' => 'false',
								'title'          => esc_html__( 'Content Spacing Top/Bottom', 'organify' ),
								'default'        => array(
									'padding-top'    => '',
									'padding-bottom' => '',
									'units'          => 'px',
								)
							),
						),
						organify_footer_opts([
							'default'         => true,
							'default_value'   => '-1'
						])
					)
				],
			]
		],

		'pxl-template' => [ //post_type
		'opt_name'            => 'pxl_hidden_template_options',
		'display_name'        => esc_html__( 'Template Options', 'organify' ),
		'show_options_object' => false,
		'context'  => 'advanced',
		'priority' => 'default',
		'sections'  => [
			'header' => [
				'title'  => esc_html__( 'General', 'organify' ),
				'icon'   => 'el-icon-website',
				'fields' => array(
					array(
						'id'    => 'template_type',
						'type'  => 'select',
						'title' => esc_html__('Type', 'organify'),
						'options' => [
							'df'       	   => esc_html__('Select Type', 'organify'), 
							'header'       => esc_html__('Header Desktop', 'organify'),
							'header-mobile'       => esc_html__('Header Mobile', 'organify'),
							'footer'       => esc_html__('Footer', 'organify'), 
							'mega-menu'    => esc_html__('Mega Menu', 'organify'), 
							'page-title'   => esc_html__('Page Title', 'organify'), 
							'tab' => esc_html__('Tab', 'organify'),
							'hidden-panel' => esc_html__('Hidden Panel', 'organify'),
							'popup' => esc_html__('Popup', 'organify'),
							'page' => esc_html__('Page', 'organify'),
							'slider' => esc_html__('Slider', 'organify'),
							'widget'          => esc_html__('Widget Sidebar', 'organify'),
						],
						'default' => 'df',
					),
					array(
						'id'    => 'header_type',
						'type'  => 'select',
						'title' => esc_html__('Header Type', 'organify'),
						'options' => [
							'px-header--default'       	   => esc_html__('Default', 'organify'), 
							'px-header--transparent'       => esc_html__('Transparent', 'organify'),
							'px-header--left_sidebar'       => esc_html__('Left Sidebar', 'organify'),
						],
						'default' => 'px-header--default',
						'indent' => true,
						'required' => array( 0 => 'template_type', 1 => 'equals', 2 => 'header' ),
					),

					array(
						'id'    => 'header_mobile_type',
						'type'  => 'select',
						'title' => esc_html__('Header Type', 'organify'),
						'options' => [
							'px-header--default'       	   => esc_html__('Default', 'organify'), 
							'px-header--transparent'       => esc_html__('Transparent', 'organify'),
						],
						'default' => 'px-header--default',
						'indent' => true,
						'required' => array( 0 => 'template_type', 1 => 'equals', 2 => 'header-mobile' ),
					),

					array(
						'id'    => 'hidden_panel_position',
						'type'  => 'select',
						'title' => esc_html__('Hidden Panel Position', 'organify'),
						'options' => [
							'top'       	   => esc_html__('Top', 'organify'),
							'right'       	   => esc_html__('Right', 'organify'),
						],
						'default' => 'right',
						'required' => array( 0 => 'template_type', 1 => 'equals', 2 => 'hidden-panel' ),
					),
					array(
						'id'          => 'hidden_panel_height',
						'type'        => 'text',
						'title'       => esc_html__('Hidden Panel Height', 'organify'),
						'subtitle'       => esc_html__('Enter number.', 'organify'),
						'transparent' => false,
						'default'     => '',
						'force_output' => true,
						'required' => array( 0 => 'hidden_panel_position', 1 => 'equals', 2 => 'top' ),
					),
					array(
						'id'          => 'hidden_panel_boxcolor',
						'type'        => 'color',
						'title'       => esc_html__('Box Color', 'organify'),
						'transparent' => false,
						'default'     => '',
						'required' => array( 0 => 'template_type', 1 => 'equals', 2 => 'hidden-panel' ),
					),
					array(
						'id'          => 'header_sidebar_width',
						'type'        => 'slider',
						'title'       => esc_html__('Header Sidebar Width', 'organify'),
						"default"   => 300,
						"min"       => 50,
						"step"      => 1,
						"max"       => 900,
						'force_output' => true,
						'required' => array( 0 => 'header_type', 1 => 'equals', 2 => 'px-header--left_sidebar' ),
					),

					array(
						'id'    => 'header_sidebar_style',
						'type'  => 'select',
						'title' => esc_html__('Header Sidebar Style', 'organify'),
						'options' => [
							'px-header-sidebar-style1'      => esc_html__('Style 1', 'organify'), 
							'px-header-sidebar-style2'      => esc_html__('Style 2', 'organify'),
						],
						'default' => 'px-header-sidebar-style1',
						'indent' => true,
						'required' => array( 0 => 'header_type', 1 => 'equals', 2 => 'px-header--left_sidebar' ),
					),
				),

			],
		]
	],
];

$metabox->add_meta_data( $panels );
}
