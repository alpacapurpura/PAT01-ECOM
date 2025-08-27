<?php
/**
 * Include the TGM_Plugin_Activation class.
 */
get_template_part( 'inc/admin/libs/tgmpa/class-tgm-plugin-activation' );

add_action( 'tgmpa_register', 'organify_register_required_plugins' );
function organify_register_required_plugins() {
    include( locate_template( 'inc/admin/demo-data/demo-config.php' ) );
    $pxl_server_info = apply_filters( 'pxl_server_info', ['plugin_url' => 'https://api.casethemes.net/plugins/'] ) ; 
    $default_path = $pxl_server_info['plugin_url'];  
    $images = get_template_directory_uri() . '/inc/admin/assets/img/plugins';
    $plugins = array(

        array(
            'name'               => esc_html__('Redux Framework', 'organify'),
            'slug'               => 'redux-framework',
            'required'           => true,
            'logo'        => $images . '/redux.png',
            'description' => esc_html__( 'Build theme options and post, page options for WordPress Theme.', 'organify' ),
        ),

        array(
            'name'               => esc_html__('Elementor', 'organify'),
            'slug'               => 'elementor',
            'required'           => true,
            'logo'        => $images . '/elementor.png',
            'description' => esc_html__( 'Introducing a WordPress website builder, with no limits of design. A website builder that delivers high-end page designs and advanced capabilities', 'organify' ),
        ),

        array(
            'name'               => esc_html__('Case Addons', 'organify'),
            'slug'               => 'case-addons',
            'source'             => 'case-addons.zip',
            'required'           => true,
            'logo'        => $images . '/case-addons.png',
            'description' => esc_html__( 'Main process and Powerful Elements Plugin, exclusively for Organify WordPress Theme.', 'organify' ),
        ),

        array(
            'name'               => esc_html__('Revolution Slider', 'organify'),
            'slug'               => 'revslider',
            'source'             => 'revslider.zip',
            'required'           => true,
            'logo'        => $images . '/rev-slider.png',
            'description' => esc_html__( 'Revolution Slider helps beginner-and mid-level designers WOW their clients with pro-level visuals.', 'organify' )
        ),

        array(
            'name'               => esc_html__('Contact Form 7', 'organify'),
            'slug'               => 'contact-form-7',
            'required'           => true,
            'logo'        => $images . '/contact-f7.png',
            'description' => esc_html__( 'Contact Form 7 can manage multiple contact forms, you can customize the form and the mail contents flexibly with simple markup', 'organify' ),
        ),

        array(
            'name'               => esc_html__('Mailchimp', 'organify'),
            'slug'               => "mailchimp-for-wp",
            'required'           => true,
            'logo'        => $images . '/mailchimp.png',
            'description' => esc_html__( 'Allowing your visitors to subscribe to your newsletter should be easy. With this plugin, it finally is.', 'organify' ),
        ),
        
        array(
            'name'               => esc_html__('WooCommerce', 'organify'),
            'slug'               => "woocommerce",
            'required'           => true,
            'logo'        => $images . '/woo.png',
            'description' => esc_html__( 'WooCommerce is the world’s most popular open-source eCommerce solution.', 'organify' ),
        ),

        array(
            'name'               => esc_html__('Wishlist for WooCommerce', 'organify'),
            'slug'               => "woo-smart-wishlist",
            'required'           => false,
            'logo'        => $images . '/woo-smart-wishlist.png',
            'description' => esc_html__( 'WPC Smart Wishlist is a simple but powerful tool that can help your customer save products for buying later.', 'organify' ),
        ),

        array(
            'name'               => esc_html__('Smart Quick View for WooCommerce', 'organify'),
            'slug'               => "woo-smart-quick-view",
            'required'           => false,
            'logo'        => $images . '/woo-smart-quickview.png',
            'description' => esc_html__( 'WPC Smart Quick View allows users to get a quick look of products without opening the product page.', 'organify' ),
        ),

        array(
            'name'               => esc_html__('Compare for WooCommerce', 'organify'),
            'slug'               => "woo-smart-compare",
            'required'           => false,
            'logo'        => $images . '/woo-smart-compare.png',
            'description' => esc_html__( 'WPC Smart Compare is an extension of WooCommerce plugin that allows your users to compare some products of your shop.', 'organify' ),
        ),

        array(
            'name'               => esc_html__('Login/Signup Popup', 'organify'),
            'slug'             => 'easy-login-woocommerce',
            'required'           => false,
            'logo'        => $images . '/login.png',
            'description' => esc_html__( 'Allow users to login/signup using interactive popup design.', 'organify' )
        ),

    );


$config = array(
        'default_path' => $default_path,           // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'is_automatic' => true,
    );

tgmpa( $plugins, $config );

}