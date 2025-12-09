<?php 

$title = !empty($settings['title']) ? $settings['title'] : 'ENJOY';

$editor_title = $widget->parse_text_editor($settings['offer']); 
$editor_title = !empty($editor_title) ? $editor_title : '40% OFF';
$object = !empty($settings['object']) ? $settings['object'] : 'On All Products';
?>
<div class="pxl-banner-box pxl-banner-box1">
	<div class="pxl--inner">
		<?php if (!empty($title)) : ?>
			<h4 class="pxl-item--title">
				<?php echo esc_html($title); ?>
			</h4>
		<?php endif; ?>

		<?php if (!empty($editor_title)) : ?>
			<div class="pxl-item--offer">
				<?php echo wp_kses_post($editor_title); ?>
			</div>
		<?php endif; ?>

		<?php if (!empty($editor_title)) : ?>
			<div class="pxl-item--object">
				<?php echo esc_html($object); ?>
			</div>
		<?php endif; ?>

	</div>
</div>