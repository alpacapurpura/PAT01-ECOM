<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! is_a( $product, 'WC_Product' ) ) {
	return;
}

?>
<li>
	<?php do_action( 'woocommerce_widget_product_item_start', $args ); ?>
	<div class="pxl-item--img">
		<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
			<?php echo ''.$product->get_image(); ?>
		</a>
	</div>
	<div class="pxl-item--holder">
		<?php if ( ! empty( $show_rating ) ) : ?>
			<?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
		<?php endif; ?>
		<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
			<span class="product-title"><?php echo wp_kses_post( $product->get_name() ); ?></span>
		</a>
		<div class="price">
			<?php echo ''.$product->get_price_html(); ?>
			
		</div>
	</div>
	

	<?php do_action( 'woocommerce_widget_product_item_end', $args ); ?>
</li>
