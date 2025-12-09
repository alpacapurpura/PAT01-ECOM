<?php
if ( ! class_exists( 'WPCleverWoosw' ) ) return;

$widget->add_render_attribute( 'custom_link', 'href', $settings['link']['url'] );

if ( $settings['link']['is_external'] ) {
	$widget->add_render_attribute( 'custom_link', 'target', '_blank' );
}

if ( $settings['link']['nofollow'] ) {
	$widget->add_render_attribute( 'custom_link', 'rel', 'nofollow' );
}

$custom_cls = $widget->get_setting('custom_class','');

$wrap_cls = [
	'pxl-anchor-wishlist d-inline-flex align-items-center align-content-center relative',
	$custom_cls
];

$count = WPCleverWoosw::get_count(); 

?>
<div class="<?php echo implode(' ', $wrap_cls) ?>">
	<?php if( !empty($settings['link']['url'])): ?>
		<a <?php pxl_print_html($widget->get_render_attribute_string( 'custom_link' )); ?>>
		<?php endif; ?>
		<div class="pxl-counter pxl-wishlist-button">
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
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<path d="M20.8401 4.60999C20.3294 4.099 19.7229 3.69364 19.0555 3.41708C18.388 3.14052 17.6726 2.99817 16.9501 2.99817C16.2276 2.99817 15.5122 3.14052 14.8448 3.41708C14.1773 3.69364 13.5709 4.099 13.0601 4.60999L12.0001 5.66999L10.9401 4.60999C9.90843 3.5783 8.50915 2.9987 7.05012 2.9987C5.59109 2.9987 4.19181 3.5783 3.16012 4.60999C2.12843 5.64169 1.54883 7.04096 1.54883 8.49999C1.54883 9.95903 2.12843 11.3583 3.16012 12.39L4.22012 13.45L12.0001 21.23L19.7801 13.45L20.8401 12.39C21.3511 11.8792 21.7565 11.2728 22.033 10.6053C22.3096 9.93789 22.4519 9.22248 22.4519 8.49999C22.4519 7.77751 22.3096 7.0621 22.033 6.39464C21.7565 5.72718 21.3511 5.12075 20.8401 4.60999Z" stroke="#202020" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				<?php } ?>
				<span class="pxl_wishlist_counter pxl-number--counter"><?php echo esc_html($count); ?></span>
			</div>
			<?php if( !empty($settings['link']['url'])): ?>
			</a>
		<?php endif; ?>

	</div>
