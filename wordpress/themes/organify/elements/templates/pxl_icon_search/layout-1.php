<div class="pxl-search pxl-search1">
	<form role="search" method="get" class="pxl-widget-searchform" action="<?php echo esc_url(home_url( '/' )); ?>">
		<div class="searchform-wrap">
			<?php 
			if (!empty($settings['pxl_icon']['value'])) {
				\Elementor\Icons_Manager::render_icon($settings['pxl_icon'], ['aria-hidden' => 'true', 'class' => '']);
			} else { ?>
				<i class="flaticon flaticon-magnifying-glass"></i>
			<?php }
			?>
			<input type="text" placeholder="<?php if(!empty($settings['email_placefolder'])) { echo esc_attr($settings['email_placefolder']); } else { esc_attr_e('Search...', 'organify'); } ?>" name="s" class="search-field" />
		</div>
	</form>
</div>