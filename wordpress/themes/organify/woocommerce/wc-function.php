<?php

add_filter( 'woocommerce_get_settings_products', 'custom_add_setting_return_products', 10, 2 );
function custom_add_setting_return_products( $return_product ) {
	$return_product[] = array(
		'class'	=> esc_html__('titledesc','organify'),
		'title'    => esc_html__('Return Products', 'organify' ),
		'id'       => 'pxl_return_products', 
		'default'  => 'Free 20-day returns',
		'type'     => 'text',
	);
	return $return_product;
}


add_filter( 'woocommerce_get_settings_shipping', 'custom_add_setting_service', 10, 2 );
function custom_add_setting_service( $option_service ) {
	$option_service[] = array(
		'title'    => esc_html__('Service', 'organify'),
		'id'       => 'pxl_service_options', 
		'default'  => 'yes',
		'type'     => 'checkbox',
		'desc'     => esc_html__('Enable the service option.', 'organify'),
		'css'      => 'wc-enhanced-select', 
	);
	return $option_service;
}

add_filter( 'woocommerce_get_settings_shipping', 'custom_add_setting_time_delivery', 15, 2 );
function custom_add_setting_time_delivery( $shipping_time ) {
	$shipping_time[] = array(
		'class'	=> esc_html__('titledesc','organify'),
		'title'    => esc_html__('Shipping Time', 'organify' ),
		'id'       => 'pxl_shipping_time', 
		'default'  => '5',
		'desc'  => esc_html__('Enter shipping time, delivery date information will be displayed.','organify'),
		'type'     => 'number',
		'custom_attributes' => 
		array(
			'min'  => '1',  
			'max'  => '100', 
		),
	);
	return $shipping_time;
}


//Custom products layout on archive page
add_filter( 'loop_shop_columns', 'organify_loop_shop_columns', 20 ); 
function organify_loop_shop_columns() {
	$columns = isset($_GET['col']) ? sanitize_text_field($_GET['col']) : organify()->get_theme_opt('products_columns', 3);
	return $columns;
}


// Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'organify_loop_shop_per_page', 20 );
function organify_loop_shop_per_page( $limit ) {
	$limit = organify()->get_theme_opt('product_per_page', 9);	
	return $limit;
}


/* Remove result count & product ordering & item product category..... */
function organify_cwoocommerce_remove_function() {
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10, 0 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5, 0 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10, 0 );
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10, 0 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10, 0 );
	remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_catalog_ordering', 30 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );


	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_rating', 10 );
	remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_price', 10 );
	remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_excerpt', 20 );
	remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_sharing', 50 );

}
add_action( 'init', 'organify_cwoocommerce_remove_function' );

/* Product Category */
add_action( 'woocommerce_before_shop_loop', 'organify_woocommerce_nav_top', 2 );
function organify_woocommerce_nav_top() { 
	$columns = isset($_GET['col']) ? sanitize_text_field($_GET['col']) : organify()->get_theme_opt('products_columns', '3');
	?>
	<div class="woocommerce-topbar">
		<div class="woocommerce-result-count">
			<?php woocommerce_result_count(); ?>
		</div>
		<div class="woocommerce-layout-products woocommerce-archive-layout">
			<a class="menu-layout-column layout-grid active" href="javascript:void(0);" data-cls="products columns-<?php echo esc_attr($columns);?>""><i class="flaticon-grid"></i></a>
			<a class="menu-layout-column layout-list" href="javascript:void(0);" data-cls="products products-list"><i class="flaticon-menu-bar"></i></a>
		</div>
		<div class="woocommerce-topbar-ordering">
			<?php woocommerce_catalog_ordering(); ?>
		</div>
	</div>
<?php }

add_filter( 'woocommerce_after_shop_loop_item', 'organify_woocommerce_product');
function organify_woocommerce_product() {
	global $product;
	$shop_layout = organify()->get_theme_opt('shop_layout', 'grid');
	if(isset($_GET['shop-layout'])) {
		$shop_layout = $_GET['shop-layout'];
	}
	?>
	<div class="woocommerce-product-inner item-layout-<?php echo esc_attr($shop_layout); ?>">
		<div class="woocommerce-product-header">
			<a class="woocommerce-product-details" href="<?php the_permalink(); ?>">
				<?php woocommerce_template_loop_product_thumbnail(); ?>
			</a>
			<div class="woocommerce--toolbar">
				<div class="woos woocommerce--compare">
					<?php echo do_shortcode('[woosc id="'.esc_attr( $product->get_id() ).'"]'); ?>
				</div>
				<div class="woos woocommerce--wishlist">
					<?php echo do_shortcode('[woosw id="'.esc_attr( $product->get_id() ).'"]'); ?>
				</div>
				<div class="woos woocommerce--quickview">
					<?php echo do_shortcode('[woosq id="'.esc_attr( $product->get_id() ).'"]'); ?>
				</div>
			</div>
		</div>
		<div class="woocommerce-product-content">
			<div class="woocommerce-product-title">
				<a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
			</div>
			<div class="woocommerce-sg-product-excerpt">
				<?php woocommerce_template_single_excerpt(); ?>
			</div>
			<div class="woocommerce-product--rating">
				<?php woocommerce_template_loop_rating(); ?>
			</div>

			<div class="woocommerce-product--price">
				<?php woocommerce_template_loop_price(); ?>
			</div>
			<?php if ( ! $product->managing_stock() && ! $product->is_in_stock() ) { ?>
			<?php } else { ?>
				<div class="woocommerce-add-to-cart">
					<?php woocommerce_template_loop_add_to_cart(); ?>
				</div>
			<?php } ?>
		</div>
	</div>
<?php }



//Swap Price 

function swap_sale_regular_price($price, $regular_price, $sale_price)
{
	$position_sale_price = organify()->get_theme_opt('position_sale_price', 'ps_left');
	if ($position_sale_price == 'ps_right') {
		$price = '<ins class="pxl-mr-12">' . (is_numeric($sale_price) ? wc_price($sale_price) : $sale_price) . '</ins><del aria-hidden="true">' . (is_numeric($regular_price) ? wc_price($regular_price) : $regular_price) . '</del>';
	}else{
		$price = '<del class="pxl-mr-12" aria-hidden="true">' . (is_numeric($regular_price) ? wc_price($regular_price) : $regular_price). '</del><ins >' . (is_numeric($sale_price) ? wc_price($sale_price) : $sale_price) . '</ins>';
	}
	return $price;
}
add_filter('woocommerce_format_sale_price', 'swap_sale_regular_price', 10, 3);


/* Removes the "shop" title on the main shop page */
function organify_hide_page_title()
{
	return false;
}
add_filter('woocommerce_show_page_title', 'organify_hide_page_title');

/* Replace text Onsale */
add_filter('woocommerce_sale_flash', 'organify_custom_sale_text', 10, 3);
function organify_custom_sale_text($text, $post, $_product)
{
	$regular_price = get_post_meta( get_the_ID(), '_regular_price', true);
	$sale_price = get_post_meta( get_the_ID(), '_sale_price', true);

	$product_sale = '';
	if (!empty($sale_price)) {
		$regular_price_int = intval($regular_price);
		$sale_price_int = intval($sale_price);
		$product_sale = intval((($regular_price_int - $sale_price_int) / $regular_price_int) * 100);
		if ($product_sale >= 0 && $product_sale < 25) {
			return '<span class="onsale light-discount">' . $product_sale . '%</span>';
		} elseif ($product_sale >= 25 && $product_sale < 50) {
			return '<span class="onsale regular-discount">' . $product_sale . '%</span>';
		} elseif ($product_sale >= 50 && $product_sale < 75) {
			return '<span class="onsale deep-discount">' . $product_sale . '%</span>';
		} elseif ($product_sale >= 75 && $product_sale <= 100) {
			return '<span class="onsale major-discount">' . $product_sale . '%</span>';
		}
	}
}

/**
 * Modify image width theme support.
 */

add_action( 'woocommerce_before_single_product_summary', 'organify_woocommerce_single_summer_start', 0 );
function organify_woocommerce_single_summer_start() { ?>
	<?php echo '<div class="woocommerce-summary-wrap row">'; ?>
<?php }
add_action( 'woocommerce_after_single_product_summary', 'organify_woocommerce_single_summer_end', 5 );
function organify_woocommerce_single_summer_end() { ?>
	<?php echo '</div></div>'; ?>
<?php }


function organify_woocommerce_check_variation() {
	global $product;

	if ( $product && $product->is_type( 'variable' ) ) {
		add_action( 'woocommerce_before_variations_form', 'organify_woocommerce_sg_product_category', 5 );
		add_action( 'woocommerce_before_variations_form', 'organify_woocommerce_sg_product_rating', 5 );
		add_action( 'woocommerce_before_variations_form', 'organify_woocommerce_sg_product_title', 10 );
		add_action( 'woocommerce_before_variations_form', 'woocommerce_pxl_return_products',10 );
		add_action( 'woocommerce_before_variations_form', 'organify_woocommerce_sg_product_price', 15 );

	} else {
		add_action( 'woocommerce_before_add_to_cart_form', 'organify_woocommerce_sg_product_category', 5 );
		add_action( 'woocommerce_before_add_to_cart_form', 'organify_woocommerce_sg_product_rating', 5 );
		add_action( 'woocommerce_before_add_to_cart_form', 'organify_woocommerce_sg_product_title', 10 );
		add_action( 'woocommerce_before_add_to_cart_form', 'woocommerce_pxl_return_products',10 );
		add_action( 'woocommerce_before_add_to_cart_form', 'organify_woocommerce_sg_product_price', 15 );
	}
}
add_action( 'woocommerce_single_product_summary', 'organify_woocommerce_check_variation', 5 );


function organify_woocommerce_sg_product_category() {
	global $product;
	$categories = get_the_terms( $product->get_id(), 'product_cat' );?>
	<div class="woocommerce-summary--entry row">
		<div class="woocommerce-summary-content col-xl-7 col-lg-7 col-md-12 col-12">
			<div class="woocommerce-sg-product-details">
				<?php
				if ( $categories && ! is_wp_error( $categories ) ) {
					$top_level_categories = array_filter( $categories, function( $category ) {
						return $category->parent == 0; 
					});
					if ( ! empty( $top_level_categories ) ) {
						$first_category = array_shift( $top_level_categories );
						echo '<div class="woocommerce-sg-product-category">';
						echo '<p><a href="' . esc_url( get_term_link( $first_category ) ) . '">' . esc_html( $first_category->name ) . '</a></p>';
						echo '</div>';
					}
				}
			}
			function organify_woocommerce_sg_product_rating() { 
				?>
				<div class="woocommerce-sg-product-rating">
					<?php woocommerce_template_single_rating(); ?>
				</div>
			</div>

		<?php } 

		add_action( 'woocommerce_single_product_summary', 'organify_woocommerce_sg_product_add_to_cart', 60 );
		function organify_woocommerce_sg_product_add_to_cart() {  ?>
		</div>
	</div>
</div>
</div>

<?php }

function organify_woocommerce_sg_product_title() { 
	global $product; 
	?>
	<div class="woocommerce-sg-product-title">
		<?php woocommerce_template_single_title(); ?>
	</div>
	<?php
} 

function woocommerce_pxl_return_products() {
	$return_message  = get_option( 'pxl_return_products','Free 20-day returns' );
	if ( ! empty( $return_message ) ) {
		echo '<div class="pxl-return--products">'.
		'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
		<g clip-path="url(#clip0_2081_2361)"><path d="M15.6803 7.99982C15.6803 12.2345 12.235 15.6798 8.00031 15.6798C3.76559 15.6798 0.320312 12.2345 0.320312 7.99982C0.320312 7.73454 0.535032 7.51982 0.800312 7.51982C1.06559 7.51982 1.28031 7.73454 1.28031 7.99982C1.28031 11.7053 4.29487 14.7198 8.00031 14.7198C11.7058 14.7198 14.7203 11.7053 14.7203 7.99982C14.7203 4.29438 11.7058 1.27982 8.00031 1.27982C6.21423 1.27982 4.55615 1.97406 3.30879 3.19982H5.12031C5.38559 3.19982 5.60031 3.41454 5.60031 3.67982C5.60031 3.9451 5.38559 4.15982 5.12031 4.15982H2.24031C1.97503 4.15982 1.76031 3.9451 1.76031 3.67982V0.799824C1.76031 0.534544 1.97503 0.319824 2.24031 0.319824C2.50559 0.319824 2.72031 0.534544 2.72031 0.799824V2.43726C4.13647 1.08558 5.99727 0.319824 8.00031 0.319824C12.235 0.319824 15.6803 3.7651 15.6803 7.99982ZM12.3203 6.07982V10.3998C12.3203 10.6 12.1962 10.779 12.0091 10.8494L8.16911 12.2894C8.11471 12.3096 8.05743 12.3198 8.00031 12.3198C7.94319 12.3198 7.88591 12.3096 7.83151 12.2894L3.99151 10.8494C3.80447 10.779 3.68031 10.6 3.68031 10.3998V6.07982C3.68031 5.87966 3.80447 5.70062 3.99151 5.63022L7.83151 4.19022C7.94031 4.1499 8.06031 4.1499 8.16895 4.19022L12.009 5.63022C12.1962 5.70062 12.3203 5.87966 12.3203 6.07982ZM5.52719 6.07982L8.00031 7.00702L10.4734 6.07982L8.00031 5.15262L5.52719 6.07982ZM4.64031 10.067L7.52031 11.147V7.85262L4.64031 6.77262V10.067ZM11.3603 10.067V6.77262L8.48031 7.85262V11.147L11.3603 10.067Z" fill="white"/>
		</g>
		<defs>
		<clipPath id="clip0_2081_2361">
		<rect width="16" height="16" fill="white"/>
		</clipPath>
		</defs>
		</svg>'. esc_html($return_message).'</div>';
	}
}

function organify_woocommerce_sg_product_price() { ?>
	<div class="woocommerce-sg-product-price">
		<?php woocommerce_template_single_price(); ?>
	</div>
<?php }




add_action( 'woocommerce_single_product_summary', 'organify_woocommerce_sg_social_share', 40 );
function organify_woocommerce_sg_social_share() { 
	$product_social_share = organify()->get_theme_opt( 'product_social_share', false );
	if($product_social_share) : ?>
		<div class="woocommerce-social-share">
			<label class="pxl-mr-20"><?php echo esc_html__('Share on Social', 'organify'); ?></label>
			<a class="fb-social pxl-mr-10" title="<?php echo esc_attr__('Facebook', 'organify'); ?>" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="caseicon-facebook"></i></a>
			<a class="lin-social" title="<?php echo esc_attr__('Linkedin', 'organify'); ?>" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>%20"><i class="caseicon-linkedin"></i></a>
			<a class="tw-social pxl-mr-10" title="<?php echo esc_attr__('Twitter', 'organify'); ?>" target="_blank" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>%20"><i class="caseicon-twitter"></i></a>
			<a class="pin-social pxl-mr-10" title="<?php echo esc_attr__('Pinterest', 'organify'); ?>" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&description=<?php the_title(); ?>%20"><i class="caseicon-pinterest"></i></a>
			<a class="btn-copy-link" title="<?php echo esc_attr__('Copy Link', 'organify'); ?>" href="#"><i class="flaticon flaticon-paper-clip"></i></a>
		</div>
	<?php endif; }

	/* Checkout Page*/
	add_action( 'woocommerce_checkout_before_order_review_heading', 'organify_checkout_before_order_review_heading_start', 5 );
	function organify_checkout_before_order_review_heading_start() { ?>
		<?php echo '<div class="pxl-order-review-right"><div class="pxl-order-review-inner">'; ?>
	<?php }

	add_action( 'woocommerce_checkout_after_order_review', 'organify_checkout_after_order_review_end', 5 );
	function organify_checkout_after_order_review_end() { ?>
		<?php echo '</div></div>'; ?>
	<?php }
	/* End Checkout Page*/

	/* Product Single: Gallery */
	add_action( 'woocommerce_before_single_product_summary', 'organify_woocommerce_single_gallery_start', 0 );
	function organify_woocommerce_single_gallery_start() {
		global $product;
		?>

		<?php echo '<div class="woocommerce-gallery col-xl-5 col-lg-5 col-md-5 col-12"><div class="woocommerce-gallery-inner">'; 
		?>
		<div class="woocommerce-sg-product-button">
			<?php if (class_exists('WPCleverWoosw')) { ?>
				<div class="woocommerce-wishlist">
					<?php echo do_shortcode('[woosw id="'.esc_attr( $product->get_id() ).'"]'); ?>
				</div>
			<?php } ?>
		</div>
	<?php }


	add_action( 'woocommerce_before_single_product_summary', 'organify_woocommerce_single_gallery_end', 30 );
	function organify_woocommerce_single_gallery_end() { ?>
		<?php echo '</div></div><div class="woocommerce-summary-inner col-xl-7 col-lg-7 col-md-7 col-12">'; 
		?>

	<?php }

	add_action( 'woocommerce_before_add_to_cart_quantity', 'organify_woocommerce_sg_sidebar_before', 5 );
	function organify_woocommerce_sg_sidebar_before() { 
		if (is_single()) {
			echo '</div></div></div></div><div class="woocommerce-sg-sidebar col-xl-5 col-lg-5 col-md-12 col-12">';
		}else{
			echo '<div class="woocommerce-sg-sidebar">';
		}
		?>
		<?php echo '<div class="pxl-sidebar--content">'; 
		?>
	<?php }


	add_action( 'woocommerce_before_add_to_cart_quantity', 'organify_woocommerce_shipping_address',5 );
	function organify_woocommerce_shipping_address() {
		$user_id = get_current_user_id();
		?>
		<div class="woocommerce-title title-shipping"> <?php echo esc_html__('Ship to','organify') ?>
		<?php
		if ( $user_id ) {
			$customer = new WC_Customer( $user_id );

			$shipping_country = $customer->get_shipping_country();

			$countries = WC()->countries->countries;
			$shipping_country_full = isset( $countries[ $shipping_country ] ) ? $countries[ $shipping_country ] : $shipping_country;

			echo '<p>'
			.'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
			<path d="M8.00006 1C7.27568 0.999993 6.55843 1.14308 5.88951 1.42104C5.22058 1.699 4.61315 2.10637 4.1021 2.61974C3.59105 3.13311 3.18645 3.74238 2.91152 4.41256C2.6366 5.08274 2.49676 5.80063 2.50006 6.525C2.50006 8.715 5.21506 12.425 6.83506 14.44C6.97569 14.6134 7.15326 14.7532 7.35481 14.8493C7.55635 14.9453 7.7768 14.9951 8.00006 14.9951C8.22332 14.9951 8.44376 14.9453 8.64531 14.8493C8.84686 14.7532 9.02442 14.6134 9.16506 14.44C10.7851 12.44 13.5001 8.715 13.5001 6.525C13.5034 5.80063 13.3635 5.08274 13.0886 4.41256C12.8137 3.74238 12.4091 3.13311 11.898 2.61974C11.387 2.10637 10.7795 1.699 10.1106 1.42104C9.44168 1.14308 8.72444 0.999993 8.00006 1ZM8.38506 13.815C8.33814 13.8716 8.27931 13.9172 8.21276 13.9485C8.14622 13.9798 8.07359 13.996 8.00006 13.996C7.92652 13.996 7.8539 13.9798 7.78735 13.9485C7.7208 13.9172 7.66197 13.8716 7.61506 13.815C5.04006 10.605 3.50006 7.88 3.50006 6.525C3.50006 5.33153 3.97416 4.18693 4.81808 3.34302C5.66199 2.49911 6.80658 2.025 8.00006 2.025C9.19353 2.025 10.3381 2.49911 11.182 3.34302C12.026 4.18693 12.5001 5.33153 12.5001 6.525C12.5001 7.88 10.9601 10.605 8.38506 13.815ZM8.00006 3.5C7.40671 3.5 6.82669 3.67595 6.33335 4.00559C5.84 4.33524 5.45548 4.80377 5.22842 5.35195C5.00136 5.90013 4.94195 6.50333 5.0577 7.08527C5.17346 7.66721 5.45918 8.20176 5.87874 8.62132C6.29829 9.04088 6.83284 9.3266 7.41479 9.44236C7.99673 9.55811 8.59993 9.4987 9.14811 9.27164C9.69629 9.04458 10.1648 8.66006 10.4945 8.16671C10.8241 7.67336 11.0001 7.09334 11.0001 6.5C11.0001 5.70435 10.684 4.94129 10.1214 4.37868C9.55877 3.81607 8.79571 3.5 8.00006 3.5ZM8.00006 8.5C7.60449 8.5 7.21781 8.3827 6.88892 8.16294C6.56002 7.94318 6.30367 7.63082 6.1523 7.26537C6.00092 6.89991 5.96132 6.49778 6.03849 6.10982C6.11566 5.72186 6.30614 5.36549 6.58584 5.08579C6.86555 4.80608 7.22191 4.6156 7.60988 4.53843C7.99784 4.46126 8.39997 4.50087 8.76542 4.65224C9.13088 4.80362 9.44323 5.05996 9.663 5.38886C9.88276 5.71776 10.0001 6.10444 10.0001 6.5C10.0001 7.03043 9.78934 7.53914 9.41427 7.91421C9.0392 8.28929 8.53049 8.5 8.00006 8.5Z" fill="#504E4E"/>
			</svg>'.esc_html( $shipping_country_full ).'</p>';
		} else {
			echo '<p>Please log in to see delivery information.</p>';
		}
		?>
	</div>
	<?php
}

add_action('woocommerce_before_add_to_cart_quantity','organify_woocommerce_shipping_product',10);
function organify_woocommerce_shipping_product(){	
	echo do_shortcode('[custom_shipping_cost]'); 
}


add_action( 'woocommerce_before_add_to_cart_quantity', 'woocommerce_pxl_service_products',10 );
function woocommerce_pxl_service_products() {
	$service_option  = get_option( 'pxl_service_options');
	if ( $service_option == 'yes' ){
		echo '<div class="woocommerce-title title-service">Service<div class="pxl-content--service">Buyer protection</div></div>';
	}
}


add_action('woocommerce_before_add_to_cart_quantity', 'organify_woocommerce_title_quantity',15);
function organify_woocommerce_title_quantity() {
	echo '<div class="woocommerce-title title-quantity">Quantity</div>';
}


add_action('woocommerce_after_add_to_cart_quantity', 'organify_woocommerce_stock_info', 10);
function organify_woocommerce_stock_info() {
	global $product;
	if ($product->managing_stock()) {
		$stock_quantity = $product->get_stock_quantity();
		echo '<div class="woocommerce-title title-stock">' . esc_html($stock_quantity) . ' pieces available</div>';
	}
}

add_action( 'woocommerce_after_add_to_cart_button', 'organify_woocommerce_sg_sidebar_after', 5 );
function organify_woocommerce_sg_sidebar_after() { ?>
	<?php echo '</div></div></div><div><div><div><div>'; ?>
<?php }


/* Ajax update cart item */
add_filter('woocommerce_add_to_cart_fragments', 'organify_woo_mini_cart_item_fragment');
function organify_woo_mini_cart_item_fragment( $fragments ) {
	global $woocommerce;
	$product_subtitle = organify()->get_page_opt( 'product_subtitle' );
	ob_start();
	?>
	<div class="widget_shopping_cart">
		<div class="widget_shopping_head">
			<div class="pxl-item--close pxl-close pxl-cursor--cta"></div>
			<div class="widget_shopping_title">
				<?php echo esc_html__( 'Cart', 'organify' ); ?> <span class="widget_cart_counter">(<?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count, 'organify' ), WC()->cart->cart_contents_count ); ?>)</span>
			</div>
		</div>
		<div class="widget_shopping_cart_content">
			<?php
			$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
			?>
			<ul class="cart_list product_list_widget">

				<?php if ( ! WC()->cart->is_empty() ) : ?>

				<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

						$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
						$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
						$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
						<li>
							<?php if(!empty($thumbnail)) : ?>
								<div class="cart-product-image">
									<a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>">
										<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
									</a>
								</div>
							<?php endif; ?>
							<div class="cart-product-meta">
								<h3><a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>"><?php echo esc_html($product_name); ?></a></h3>
								<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
								<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="remove_from_cart_button pxl-close" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"></a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									esc_attr__( 'Remove this item', 'organify' ),
									esc_attr( $product_id ),
									esc_attr( $cart_item_key ),
									esc_attr( $_product->get_sku() )
								), $cart_item_key );
								?>
							</div>	
						</li>
						<?php
					}
				}
				?>

			<?php else : ?>

				<li class="empty">
					<i class="caseicon-shopping-cart-alt"></i>
					<span><?php esc_html_e( 'Your cart is empty', 'organify' ); ?></span>
					<a class="btn btn-shop" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php echo esc_html__('Browse Shop', 'organify'); ?></a>
				</li>

			<?php endif; ?>

		</ul><!-- end product list -->
	</div>
	<?php if ( ! WC()->cart->is_empty() ) : ?>
	<div class="widget_shopping_cart_footer">
		<p class="total"><strong><?php esc_html_e( 'Subtotal', 'organify' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

		<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

		<p class="buttons">
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="btn btn-shop wc-forward"><?php esc_html_e( 'View Cart', 'organify' ); ?></a>
			<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn checkout wc-forward"><?php esc_html_e( 'Checkout', 'organify' ); ?></a>
		</p>
	</div>
<?php endif; ?>
</div>
<?php
$fragments['div.widget_shopping_cart'] = ob_get_clean();
return $fragments;
}





/* Ajax update cart total number */

add_filter( 'woocommerce_add_to_cart_fragments', 'organify_woocommerce_sidebar_cart_count_number' );
function organify_woocommerce_sidebar_cart_count_number( $fragments ) {
	ob_start();
	?>
	<span class="widget_cart_counter">(<?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'organify' ), WC()->cart->cart_contents_count ); ?>)</span>
	<?php
	
	$fragments['span.widget_cart_counter'] = ob_get_clean();
	
	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'organify_woocommerce_sidebar_cart_count_number_header' );
function organify_woocommerce_sidebar_cart_count_number_header( $fragments ) {
	ob_start();
	?>
	<span class="widget_cart_counter_header"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'organify' ), WC()->cart->cart_contents_count ); ?></span>
	<?php
	
	$fragments['span.widget_cart_counter_header'] = ob_get_clean();
	
	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'organify_woocommerce_sidebar_cart_count_number_sidebar' );
function organify_woocommerce_sidebar_cart_count_number_sidebar( $fragments ) {
	ob_start();
	?>
	<span class="ct-cart-count-sidebar"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'organify' ), WC()->cart->cart_contents_count ); ?></span>
	<?php
	
	$fragments['span.ct-cart-count-sidebar'] = ob_get_clean();
	
	return $fragments;
}



add_filter( 'woocommerce_output_related_products_args', 'organify_related_products_args', 20 );
function organify_related_products_args( $args ) {
	$args['posts_per_page'] = 8;
	$args['columns'] = 4;
	return $args;
}

add_filter( 'woocommerce_product_related_products_heading', 'custom_related_products_title' );
function custom_related_products_title( $title ) {
	return 'You May Also Like';
}

/* Pagination Args */
function organify_filter_woocommerce_pagination_args( $array ) { 
	$array['end_size'] = 1;
	$array['mid_size'] = 1;
	return $array; 
}; 
add_filter( 'woocommerce_pagination_args', 'organify_filter_woocommerce_pagination_args', 10, 1 ); 

/* Flex Slider Arrow */
add_filter( 'woocommerce_single_product_carousel_options', 'organify_update_woo_flexslider_options' );
function organify_update_woo_flexslider_options( $options ) {
	$options['directionNav'] = true;
	return $options;
}

/* Single Thumbnail Size */
$single_img_size = organify()->get_theme_opt('single_img_size');
if(!empty($single_img_size['width']) && !empty($single_img_size['height'])) {
	add_filter('woocommerce_get_image_size_single', function ($size) {
		$single_img_size = organify()->get_theme_opt('single_img_size');
		$single_img_size_width = preg_replace('/[^0-9]/', '', $single_img_size['width']);
		$single_img_size_height = preg_replace('/[^0-9]/', '', $single_img_size['height']);
		$size['width'] = $single_img_size_width;
		$size['height'] = $single_img_size_height;
		$size['crop'] = 1;
		return $size;
	});
}
add_filter('woocommerce_get_image_size_gallery_thumbnail', function ($size) {
	$size['width'] = 417;
	$size['height'] = 417;
	$size['crop'] = 1;
	return $size;
});

add_filter('woocommerce_get_image_size_thumbnail', function ($size) {
	$size['width'] = 330;
	$size['height'] = 330;
	$size['crop'] = 1;
	return $size;
});

// paginate links
add_filter('woocommerce_pagination_args', 'organify_woocommerce_pagination_args');
function organify_woocommerce_pagination_args($default){
	$default = array_merge($default, [
		'prev_text' => '<i class="caseicon-double-chevron-left"></i>',
		'next_text' => '<i class="caseicon-double-chevron-right"></i>',
		'type'      => 'plain',
	]);
	return $default;
}



//My Account
add_filter('woocommerce_before_customer_login_form','organify_woocommerce_form_login',5);
function organify_woocommerce_form_login(){
	echo '<div class="woocommerce--login pxl--login">';
}
add_filter('woocommerce_login_form_end','organify_woocommerce_form_login_end',5);
function organify_woocommerce_form_login_end(){
	echo '</div>';
}




//Cart Page

add_filter('woocommerce_before_cart','organify_woocommerce_cart_page_before');
function organify_woocommerce_cart_page_before(){
	echo '<div class="woocommerce-cart--page pxl-cart--page">';
}

add_filter('woocommerce_after_cart','organify_woocommerce_cart_page_after');
function organify_woocommerce_cart_page_after(){
	echo '</div>';
}

add_filter('woocommerce_before_cart_table','organify_woocommerce_title_cart_form',10);
function organify_woocommerce_title_cart_form(){
	echo '<h3>Shopping Cart</h3>';
}

// add_filter('woocommerce_quantity_input_args', 'custom_quantity_input_args', 10, 2);
// function custom_quantity_input_args($args, $product) {
// 	$args['input_value'] = 1; 
// 	$args['min_value'] = 1; 
// 	$args['max_value'] = $product->get_max_purchase_quantity(); 
// 	$args['step'] = 1; 
// 	return $args;
// }

add_filter('woocommerce_quantity_input_field', 'custom_quantity_input_field', 10, 2);
function custom_quantity_input_field($input, $product) {
	return '<div class="custom-quantity">' .
	'<button class="minus">-</button>' .
	'<input type="number" name="quantity" value="1" min="1" />' .
	'<button class="plus">+</button>' .
	'</div>';
}





/* */

function organify_woocommerce_query($type='recent_product',$post_per_page=-1,$product_ids='',$categories='',$param_args=[]){
	global $wp_query;

	$product_visibility_term_ids = wc_get_product_visibility_term_ids();
	if(!empty($product_ids)){

		if (get_query_var('paged')) {
			$pxl_paged = get_query_var('paged');
		} elseif (get_query_var('page')) {
			$pxl_paged = get_query_var('page');
		} else {
			$pxl_paged = 1;
		}

		$pxl_query = new WP_Query(array(
			'post_type' => 'product',
			'post__in' => array_map('intval', explode(',', $product_ids)),
			'tax_query' => array(
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'term_taxonomy_id',
					'terms'    => is_search() ? $product_visibility_term_ids['exclude-from-search'] : $product_visibility_term_ids['exclude-from-catalog'],
					'operator' => 'NOT IN',
				)
			),
		));

		$posts = $pxl_query;

		$categories = [];
	}else{
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => $post_per_page,
			'post_status' => 'publish',
			'post_parent' => 0,
			'date_query' => array(
				array(
					'before' => date('Y-m-d H:i:s', current_time( 'timestamp' ))
				)
			),
			'tax_query' => array(
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'term_taxonomy_id',
					'terms'    => is_search() ? $product_visibility_term_ids['exclude-from-search'] : $product_visibility_term_ids['exclude-from-catalog'],
					'operator' => 'NOT IN',
				)
			),
		);

		if(!empty($categories)){

			$args['tax_query'][] = array(
				'taxonomy' => 'product_cat',
				'field' => 'slug',
				'operator' => 'IN',
				'terms' => $categories,
			);
		}

		if( !empty($param_args['pro_atts']) ){
			foreach ($param_args['pro_atts'] as $k => $v) {
				$args['tax_query'][] = array(
					'taxonomy' => $k,
					'field' => 'slug',
					'terms' => $v
				);
			}
		}

		$args['meta_query'] = array(
			'relation'    => 'AND'
		);

		if( !empty($param_args['min_price']) && !empty($param_args['max_price'])){
			$args['meta_query'][] =   array(
				'key'     => '_price',
				'value'   => array( $param_args['min_price'], $param_args['max_price'] ),
				'compare' => 'BETWEEN',
				'type'    => 'DECIMAL(10,' . wc_get_price_decimals() . ')',
			);
		}

		$args = organify_product_filter_type_args($type,$args);

		if (get_query_var('paged')){
			$pxl_paged = get_query_var('paged');
		}elseif(get_query_var('page')){
			$pxl_paged = get_query_var('page');
		}else{
			$pxl_paged = 1;
		}
		if($pxl_paged > 1){
			$args['paged'] = $pxl_paged;
		}

		$posts = $pxl_query = new WP_Query($args);

		if (empty($categories)) {
			$product_categories = get_categories(array( 'taxonomy' => 'product_cat' ));
			$categories = array();
			foreach($product_categories as $key => $category){
				$categories[] = $category->slug;
			}
		}
	}
	global $wp_query;
	$wp_query = $pxl_query;
	$pagination = get_the_posts_pagination(array(
		'screen_reader_text' => '',
		'mid_size' => 2,
		'prev_text' => esc_html__('Back', 'organify'),
		'next_text' => esc_html__('Next', 'organify'),
	));
	global $paged;
	$paged = $pxl_paged;


	wp_reset_query();
	return array(
		'posts' => $posts,
		'categories' => $categories,
		'query' => $pxl_query,
		'args' => $args,
		'paged' => $paged,
		'max' => $pxl_query->max_num_pages,
		'next_link' => next_posts($pxl_query->max_num_pages, false),
		'total' => $pxl_query->found_posts,
		'pagination' => $pagination
	);
}

function organify_product_filter_type_args($type,$args){
	switch ($type) {
		case 'best_selling':
		$args['meta_key']='total_sales';
		$args['orderby']='meta_value_num';
		$args['ignore_sticky_posts']   = 1;
		break;
		case 'featured_product':
		$args['ignore_sticky_posts'] = 1;
		$args['tax_query'][] = array(
			'taxonomy' => 'product_visibility',
			'field'    => 'term_taxonomy_id',
			'terms'    => $product_visibility_term_ids['featured'],
		);
		break;
		case 'top_rate':
		$args['meta_key']   ='_wc_average_rating';
		$args['orderby']    ='meta_value_num';
		$args['order']      ='DESC';
		break;
		case 'recent_product':
		$args['orderby']    = 'date';
		$args['order']      = 'DESC';
		break;
		case 'on_sale':
		$args['post__in'] = wc_get_product_ids_on_sale();
		break;
		case 'recent_review':
		if($post_per_page == -1) $_limit = 4;
		else $_limit = $post_per_page;
		global $wpdb;
		$query = $wpdb->prepare("SELECT c.comment_post_ID FROM {$wpdb->prefix}posts p, {$wpdb->prefix}comments c WHERE p.ID = c.comment_post_ID AND c.comment_approved > 0 AND p.post_type = 'product' AND p.post_status = 'publish' AND p.comment_count > 0 ORDER BY c.comment_date ASC LIMIT 0, %d", $_limit);
		$results = $wpdb->get_results($query, OBJECT);
		$_pids = array();
		foreach ($results as $re) {
			$_pids[] = $re->comment_post_ID;
		}

		$args['post__in'] = $_pids;
		break;
		case 'deals':
		$args['meta_query'][] = array(
			'key' => '_sale_price_dates_to',
			'value' => '0',
			'compare' => '>');
		$args['post__in'] = wc_get_product_ids_on_sale();
		break;
		case 'separate':
		if ( ! empty( $product_ids ) ) {
			$ids = array_map( 'trim', explode( ',', $product_ids ) );
			if ( 1 === count( $ids ) ) {
				$args['p'] = $ids[0];
			} else {
				$args['post__in'] = $ids;
			}
		}
		break;
	}
	return $args;
}



//Add short code
function custom_simple_shipping_info() {
	if ( WC()->cart && ! WC()->cart->is_empty() ) {
		ob_start();

		$packages = WC()->shipping()->get_packages(); 
		$chosen_methods = WC()->session->get( 'chosen_shipping_methods' ); 
		$chosen_shipping_method = isset( $chosen_methods[0] ) ? $chosen_methods[0] : ''; 

		if ( ! empty( $packages ) ) {
			foreach ( $packages as $i => $package ) {
				$shipping_zone = WC_Shipping_Zones::get_zone_matching_package( $package );
				$shipping_method = isset( $package['rates'][ $chosen_shipping_method ] ) ? $package['rates'][ $chosen_shipping_method ] : null;

				if ( $shipping_method ) {
					echo '<div class="woocommerce-shipping-info">';
					echo '<p><strong>' . esc_html__( 'Shipping', 'organify' ) . ':</strong> ' . WC()->cart->get_cart_shipping_total() . '</p>';
					echo '<p>' . $shipping_method->get_label() . '</p>'; 
					echo '<p>' . esc_html__( 'Shipping to', 'organify' ) . ' ' . WC()->customer->get_shipping_country() . '</p>';
					echo '</div>';
				}
			}
		}

		return ob_get_clean();
	}
}
pxl_register_shortcode( 'simple_shipping_info', 'custom_simple_shipping_info' );


function custom_shipping_cost_shortcode() {
	$shipping_cost = WC()->cart->get_shipping_total();
	$shipping_time = (int) get_option('pxl_shipping_time','5');
	$today = date('Y-m-d');
	$delivery_date = date('M d', strtotime($today. ' + '.$shipping_time.'days'));

	?>
	<div class="woocommerce-title title-delivery">Delivery
		<?php
		if ($shipping_cost) {
			echo '<div class="product-shipping--cost">' . wp_kses_post(wc_price($shipping_cost)) . '</div>';
		} else {
			echo '<div class="product-shipping--cost">Free Shipping</div>';
		}
		if ($shipping_time){
			echo '<div class="product-shipping--time">Delivery: <div class="pxl-shipping--time">'.esc_html__($delivery_date).'</div></div>';
		}
		?>
	</div>
	<?php 
}
pxl_register_shortcode('custom_shipping_cost', 'custom_shipping_cost_shortcode');


function show_product_attributes() {
	global $product;

	if ( ! $product || ! $product->is_type( 'variable' ) ) {
		return ''; 
	}

	$attributes = $product->get_attributes();

	if ( empty( $attributes ) ) {
		return '';
	}

	ob_start(); 

	echo '<ul class="product-attributes">';
	foreach ( $attributes as $attribute ) {
		$name = wc_attribute_label( $attribute->get_name() );
		$value = implode( ', ', $attribute->get_options() );
		echo '<li><strong>' . esc_html( $name ) . ':</strong> ' . esc_html( $value ) . '</li>';
	}
	echo '</ul>';

	return ob_get_clean(); 
}
pxl_register_shortcode( 'product_attributes', 'show_product_attributes' );



