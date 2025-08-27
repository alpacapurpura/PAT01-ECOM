<?php
/**
 * Template part for displaying posts in loop
 *
 * @package Case-Themes
 */
$post_tag = organify()->get_theme_opt( 'post_tag', true );
$post_navigation = organify()->get_theme_opt( 'post_navigation', false );
$post_social_share = organify()->get_theme_opt( 'post_social_share', false );
$post_author_info = organify()->get_theme_opt( 'post_author_info', false );
$tags_list = get_the_tag_list();
$sg_post_title = organify()->get_theme_opt('sg_post_title', 'default');
$sg_featured_img_size = organify()->get_theme_opt('sg_featured_img_size', '960x545');
$post_video_link = get_post_meta(get_the_ID(), 'post_video_link', true);
$link_blog_page = organify()->get_theme_opt('link_blog_page');
$blog_page = organify()->get_theme_opt('blog_page');

?>
<article id="pxl-post-<?php the_ID(); ?>" <?php post_class('pxl---post'); ?>>
    <?php if ($blog_page === '1') : ?>
        <a href="<?php echo esc_url($link_blog_page); ?>" class="pxl--back-to-blog-page"><i class="fas fa-angle-left pxl-mr-17"></i>Back to Blog Page</a>
    <?php endif; ?>
    <div class="pxl-blog--inner">
        <?php organify()->blog->get_post_metas(); ?>

        <?php if(is_singular('post') && $sg_post_title == 'custom_text') { ?>
            <h2 class="pxl-item--title">
                <?php the_title(); ?>
            </h2>
        <?php } ?>
        <?php if (has_post_thumbnail()) {
            $img  = pxl_get_image_by_size( array(
                'attach_id'  => get_post_thumbnail_id($post->ID),
                'thumb_size' => $sg_featured_img_size,
            ) );
            $thumbnail    = $img['thumbnail']; ?>
            <div class="pxl-item--image">
                <?php echo wp_kses_post($thumbnail); ?>
                <?php if(!empty($post_video_link)) : ?>
                    <a href="<?php echo esc_url($post_video_link); ?>" class="post-button-video pxl-action-popup"><i class="caseicon-play1"></i></a>
                <?php endif; ?>        
            </div>
        <?php } ?>
        
    </div>
    <div class="pxl-item--content clearfix">
        <?php
        the_content();
        wp_link_pages( array(
            'before'      => '<div class="page-links">',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
        ) );
        ?>
    </div>

    <div class="pxl--post-footer">
        <?php if($post_tag && $tags_list || $post_social_share ) :  ?>
            <div class="pxl--tag-post">
                <?php if($post_tag) { organify()->blog->get_tagged_in(); } ?>
                <?php if($post_social_share) { organify()->blog->get_socials_share(); } ?>
            </div>
        <?php endif; ?>

        <?php if($post_author_info ) :  ?>
            <div class="pxl-info--author">
                <?php organify()->blog->get_post_author_info();  ?>
            </div>
        <?php endif; ?>
        
    </div>
    <?php if($post_navigation) { organify()->blog->get_post_nav(); } ?>
</article><!-- #post -->