<?php 
extract($settings);
$wrap_cls = [
	'pxl-user-anchor pxl-user-anchor-wrap d-flex-wrap align-items-center'
];
?>
<div class="<?php echo implode(' ', $wrap_cls) ?>">
	<?php 
	if (is_user_logged_in()):
		$user = wp_get_current_user();
		$display_name     = $user->data->display_name;
		$username         = $user->data->user_login;
		$user_link        = $profile_link_page > 0 ? get_the_permalink( $profile_link_page ) : '#';
		$logout_link_page = $logout_link_page > 0 ? get_the_permalink( $logout_link_page ) : home_url();;
		$logout_text      = !empty( $logout_text ) ? $logout_text : esc_html__( 'Sign out', 'organify' );
		$title_login      = !empty( $$title_login ) ? $$title_login : esc_html__( 'My Account', 'organify' );
		$title_profile      = !empty( $$title_profile ) ? $$title_profile : esc_html__( 'My Account', 'organify' );

		?>
		<a class="pxl--anchor user-logged-link <?php echo pxl_print_html($settings['style_hover']); ?>" href="<?php echo esc_url($user_link) ?>">
			<?php 
			if(!empty($selected_icon['value'])){
				echo '<div class="pxl-anchor-icon d-inline-flex transition">';
				\Elementor\Icons_Manager::render_icon( $selected_icon, [ 'aria-hidden' => 'true', 'class' => '' ], 'span' );
				echo '</div>'; 
			}else{
				echo '<div class="pxl-anchor-icon d-inline-flex transition">'.'
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
				<path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="#202020" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="#202020" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M23 20.9999V18.9999C22.9993 18.1136 22.7044 17.2527 22.1614 16.5522C21.6184 15.8517 20.8581 15.3515 20 15.1299" stroke="#FCB300" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M16 3.12988C16.8604 3.35018 17.623 3.85058 18.1676 4.55219C18.7122 5.2538 19.0078 6.11671 19.0078 7.00488C19.0078 7.89305 18.7122 8.75596 18.1676 9.45757C17.623 10.1592 16.8604 10.6596 16 10.8799" stroke="#FCB300" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>'.'</div>';
			}
			echo '<span class="pxl-title--profile">'.$title_profile.'</span>';
			if ($settings['style_hover'] === 'st-arrow') {
				echo '<div class="pxl-icon--arrow">'.'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
				<path d="M4 6L8 10L12 6" stroke="#FE4040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>'.'</div>';
			}
			
			?>
		</a>
		<?php if(!empty($profile_text) || !empty($logout_text)): ?>
		<div class="pxl--submenu">
			<div class="pxl--avatar">
				<a href="<?php echo esc_url($user_link) ?>">
					<?php echo get_avatar( $user->data->ID, '64', '', '', ['width' => '64', 'height' => '64', 'class'  => 'avatar avatar-64 photo'] ); ?>
					<div class="username"><?php echo esc_html($username) ?></div>
				</a>
			</div>
			<ul class="pxl-author--info">
				<li class="user-info-item">
					<a href="<?php echo esc_url($user_link) ?>">
						<span class="display-name"><?php echo esc_html($display_name) ?></span>
					</a>
				</li>
				<?php if(!empty($profile_text)): ?>
					<li class="edit-profile-item">
						<a href="<?php echo esc_url($user_link) ?>"><?php echo esc_html($profile_text) ?></a>
					</li>
				<?php endif; ?>
				<?php if(!empty($logout_text)): ?>
					<li class="logout-item">
						<a href="<?php echo wp_logout_url($logout_link_page) ?>"><?php echo esc_html($logout_text) ?></a>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	<?php endif; ?>
<?php else: ?>
	<div class="xoo-el-login-tgr pxl--anchor d-flex">
		<?php 
		echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
		<path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="#202020" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
		<path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="#202020" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
		<path d="M23 20.9999V18.9999C22.9993 18.1136 22.7044 17.2527 22.1614 16.5522C21.6184 15.8517 20.8581 15.3515 20 15.1299" stroke="#FCB300" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
		<path d="M16 3.12988C16.8604 3.35018 17.623 3.85058 18.1676 4.55219C18.7122 5.2538 19.0078 6.11671 19.0078 7.00488C19.0078 7.89305 18.7122 8.75596 18.1676 9.45757C17.623 10.1592 16.8604 10.6596 16 10.8799" stroke="#FCB300" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>';
		echo '<span class="pxl-title--profile d-inline-flex">'.$title_login.'</span>';
		if ($settings['style_hover'] === 'st-arrow') {
			echo '<div class="pxl-icon--arrow">'.'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
			<path d="M4 6L8 10L12 6" stroke="#FE4040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>'.'</div>';
		}
		?>
	</div>
<?php endif; ?>
</div>