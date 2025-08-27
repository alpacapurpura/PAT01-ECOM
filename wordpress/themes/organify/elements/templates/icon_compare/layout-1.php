<?php
if ( ! class_exists( 'WPCleverWoosc' ) ) return;

$widget->add_render_attribute( 'custom_link', 'href', $settings['link']['url'] );

if ( $settings['link']['is_external'] ) {
	$widget->add_render_attribute( 'custom_link', 'target', '_blank' );
}

if ( $settings['link']['nofollow'] ) {
	$widget->add_render_attribute( 'custom_link', 'rel', 'nofollow' );
}

$custom_cls = $widget->get_setting('custom_class','');

$wrap_cls = [
	'pxl-anchor-compare d-inline-flex align-items-center align-content-center relative',
	$custom_cls
];

$count = WPCleverWoosc::get_count(); 

?>
<div class="<?php echo implode(' ', $wrap_cls) ?>">
	<?php if( !empty($settings['link']['url'])): ?>
		<a <?php pxl_print_html($widget->get_render_attribute_string( 'custom_link' )); ?>>
		<?php endif; ?>
		<div class="pxl-counter pxl-compare-button">
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
						<path d="M17 1L21 5L17 9" stroke="#FCB300" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M3 11V9C3 7.93913 3.42143 6.92172 4.17157 6.17157C4.92172 5.42143 5.93913 5 7 5H21" stroke="#FCB300" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M7 23L3 19L7 15" stroke="#202020" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M21 13V15C21 16.0609 20.5786 17.0783 19.8284 17.8284C19.0783 18.5786 18.0609 19 17 19H3" stroke="#202020" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				<?php } ?>
				<span class="pxl_wishlist_counter pxl-number--counter"><?php echo esc_html($count); ?></span>
			</div>
			<?php if( !empty($settings['link']['url'])): ?>
			</a>
		<?php endif; ?>
		
	</div>
	