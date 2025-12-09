<?php if(!empty($settings['items'])) : ?>
	<div class="pxl-text-slip pxl-text-slip1 <?php echo esc_attr($settings['text_effect'].' '.$settings['pxl_animate']); if($settings['banner'] == 'yes') { echo ' pxl-text-white-shadow'; }  ?> <?php echo esc_attr($settings['style_text']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
		<div class="pxl-item--container">
			<div class="pxl-item--inner" <?php if(!empty($settings['effect_speed'])) { ?>style="animation-duration:<?php echo esc_attr($settings['effect_speed']); ?>s"<?php } ?>>
				<?php if(isset($settings['items']) && !empty($settings['items']) && count($settings['items'])): ?>
				<?php foreach ($settings['items'] as $key => $value):
					$text = isset($value['text']) ? $value['text'] : '';
					$icon_key = $widget->get_repeater_setting_key( 'pxl_icon', 'icons', $key );
					$img_id = $value['img']['id'];
					$image_size = !empty($settings['img_size']) ? $settings['img_size'] : 'full';
					$img  = pxl_get_image_by_size( array(
						'attach_id'  => $img_id,
						'thumb_size' => 'full',
						'class' => 'no-lazyload'
					) );
					$thumbnail    = $img['thumbnail'];
					$widget->add_render_attribute( $icon_key, [
						'class' => $value['pxl_icon'],
						'aria-hidden' => 'true',
					] );
					$link_key = $widget->get_repeater_setting_key( 'link', 'value', $key );
					if ( ! empty( $value['link']['url'] ) ) {
						$widget->add_render_attribute( $link_key, 'href', $value['link']['url'] );

						if ( $value['link']['is_external'] ) {
							$widget->add_render_attribute( $link_key, 'target', '_blank' );
						}

						if ( $value['link']['nofollow'] ) {
							$widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
						}
					}
					$link_attributes = $widget->get_render_attribute_string( $link_key );
					$is_new = \Elementor\Icons_Manager::is_migration_allowed();
					?>
					<<?php echo esc_attr($settings['text_tag']); ?> class="pxl-item--text ">				
					<span class="pxl-text-backdrop"><?php echo pxl_print_html($text); ?></span>
					<?php if (!empty($thumbnail)): ?>
						<div class="pxl-item--author">
							<?php echo wp_kses_post($thumbnail); ?>
						</div>
					<?php endif ?>
					<?php if ( ! empty( $value['pxl_icon'] ) ) : ?>
						<?php if ( $is_new ):
							\Elementor\Icons_Manager::render_icon( $value['pxl_icon'], [ 'aria-hidden' => 'true' ] );
						elseif(!empty($value['pxl_icon'])): ?>
							<i class="<?php echo esc_attr( $value['pxl_icon'] ); ?>" aria-hidden="true"></i>
						<?php endif; ?>
					<?php endif; ?>
					</<?php echo esc_attr($settings['text_tag']); ?>>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<div class="pxl-item--inner" <?php if(!empty($settings['effect_speed'])) { ?>style="animation-duration:<?php echo esc_attr($settings['effect_speed']); ?>s"<?php } ?>>
			<?php if(isset($settings['items']) && !empty($settings['items']) && count($settings['items'])): ?>
			<?php foreach ($settings['items'] as $key => $value):
				$text = isset($value['text']) ? $value['text'] : '';
				$icon_key = $widget->get_repeater_setting_key( 'pxl_icon', 'icons', $key );
				$img_id = $value['img']['id'];
				$image_size = !empty($settings['img_size']) ? $settings['img_size'] : 'full';
				$img  = pxl_get_image_by_size( array(
					'attach_id'  => $img_id,
					'thumb_size' => 'full',
					'class' => 'no-lazyload'
				) );
				$thumbnail    = $img['thumbnail'];
				$widget->add_render_attribute( $icon_key, [
					'class' => $value['pxl_icon'],
					'aria-hidden' => 'true',
				] );
				$link_key = $widget->get_repeater_setting_key( 'link', 'value', $key );
				if ( ! empty( $value['link']['url'] ) ) {
					$widget->add_render_attribute( $link_key, 'href', $value['link']['url'] );

					if ( $value['link']['is_external'] ) {
						$widget->add_render_attribute( $link_key, 'target', '_blank' );
					}

					if ( $value['link']['nofollow'] ) {
						$widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
					}
				}
				$link_attributes = $widget->get_render_attribute_string( $link_key );
				$is_new = \Elementor\Icons_Manager::is_migration_allowed();
				?>
				<<?php echo esc_attr($settings['text_tag']); ?> class="pxl-item--text ">				
				<span class="pxl-text-backdrop"><?php echo pxl_print_html($text); ?></span>
				<?php if (!empty($thumbnail)): ?>
					<div class="pxl-item--author">
						<?php echo wp_kses_post($thumbnail); ?>
					</div>
				<?php endif ?>
				<?php if ( ! empty( $value['pxl_icon'] ) ) : ?>
					<?php if ( $is_new ):
						\Elementor\Icons_Manager::render_icon( $value['pxl_icon'], [ 'aria-hidden' => 'true' ] );
					elseif(!empty($value['pxl_icon'])): ?>
						<i class="<?php echo esc_attr( $value['pxl_icon'] ); ?>" aria-hidden="true"></i>
					<?php endif; ?>
				<?php endif; ?>
				</<?php echo esc_attr($settings['text_tag']); ?>>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
</div>
<?php endif; ?>