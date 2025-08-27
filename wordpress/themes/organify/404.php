<?php
/**
 * @package Case-Themes
 */

$title_404 = organify()->get_theme_opt('title_404');
$description_404 = organify()->get_theme_opt('description_404');
$background_404 = organify()->get_opt( 'background_404', ['url' => get_template_directory_uri().'/assets/img/bg-404.jpg', 'id' => '' ] );
get_header(); ?>
<div class="pxl-content--404" style="background-image:url(<?php echo esc_url($background_404['url']); ?>);">
    <div class="row content-row">
        <div id="pxl-content-area" class="pxl-content-area col-12">
            <main id="pxl-content-main">
                <div class="pxl-error-inner">
                    <div class="pxl-error-heading"><?php echo esc_html('404','organify') ?></div>
                    <div class="pxl-error-holder">
                        <div class="wrap-error-holder">
                            <h3 class="pxl-error-title">
                                <?php if (!empty($title_404)) {
                                    echo pxl_print_html($title_404);
                                } else{
                                   echo esc_html__('PAGE NOT FOUND', 'organify');
                               }?>
                           </h3>
                           <div class="pxl-error-description">
                            <?php if (!empty($description_404)) {
                                echo pxl_print_html($description_404);
                            } else{
                                echo esc_html__('Oops! The page you are looking for does not exist. It might have been moved or deleted.', 'organify');
                            }?>
                        </div>
                    <a class="btn btn-primary btn-text-parallax" href="<?php echo esc_url(home_url('/')); ?>">
                        <span>
                            <?php echo esc_html__('Go Back Home', 'organify'); ?>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>
</div>
</div>
<?php get_footer();
