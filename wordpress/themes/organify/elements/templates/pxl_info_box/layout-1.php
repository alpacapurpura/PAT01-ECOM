<div class="pxl-info-box pxl-info-box1">
	<?php if ( !empty($settings['img_box']['id']) ) : 
		$img  = pxl_get_image_by_size( array(
			'attach_id'  => $settings['img_box']['id'],
			'thumb_size' => 'full',
		) );
		$thumbnail_url = $img['url']; ?>
		<div class="pxl-item--bg bg-image" style="background-image: url(<?php echo esc_url($thumbnail_url); ?>);"></div>
	<?php endif; ?>
	<div class="pxl-item--inner">
		<h5 class="pxl-name--author"><?php echo pxl_print_html($settings['name_author']); ?></h5>
		<div class="pxl-item--desc"><?php echo pxl_print_html($settings['desc']); ?></div>
	</div>
</div>