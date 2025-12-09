<?php if ( class_exists( 'Woocommerce' ) ) { ?>
	<div class="pxl-cart pxl-cart-sidebar-button <?php echo esc_attr($settings['style']); ?>">
		<div class="pxl-icon--cart pxl-counter">
			<?php if(!empty($settings['pxl_icon']['value'])) {
				\Elementor\Icons_Manager::render_icon( $settings['pxl_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'i' );
			} else  if ( !empty($settings['image']['id']) ) { 
				$image_size = !empty($settings['img_size']) ? $settings['img_size'] : 'full';
				$img  = pxl_get_image_by_size( array(
					'attach_id'  => $settings['image']['id'],
					'thumb_size' => $image_size,
				) );
				$thumbnail    = $img['thumbnail'];
				$thumbnail_url    = $img['url'];
				?>
				<?php echo wp_kses_post($thumbnail);}
				else{ ?>
					<i class="flaticon-shop-bag"></i>
				<?php } ?>
				<?php if(class_exists('Woocommerce')) : ?>
					<span class="pxl_cart_counter pxl-number--counter"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'organify' ), WC()->cart->cart_contents_count ); ?></span>


				<?php endif; ?>
			</div>
			<?php if ( !\Elementor\Plugin::$instance->editor->is_edit_mode() && $settings['show_sub_total'] == 'true'): ?>
				<div class="pxl-sub--total">
					<span class="anchor-cart-total"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
				</div>
			<?php endif; ?>
			
			
		</div>
	<?php }
	add_action( 'pxl_anchor_target', 'organify_hook_anchor_cart'); ?>