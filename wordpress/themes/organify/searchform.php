<?php
/**
 * Search Form
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
	<div class="searchform-wrap">
        <input type="text" placeholder="<?php esc_attr_e('Search here...', 'organify'); ?>" name="s" class="search-field" />
    	<button type="submit" class="search-submit"><i class="flaticon flaticon-search-1"></i></button>
    </div>
</form>