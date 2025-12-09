<?php
/**
 * @package Case-Themes
 */
$archive_readmore_text = organify()->get_theme_opt('archive_readmore_text', esc_html__('Read More', 'organify'));
$featured_img_size = organify()->get_theme_opt('featured_img_size', '869x320');
$post_video_link = get_post_meta(get_the_ID(), 'post_video_link', true);
$post_images = get_post_meta(get_the_ID(), 'post_images');
$type_post_feature = get_post_meta(get_the_ID(),'type_post_feature','default');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('pxl---post pxl-item--archive pxl-item--standard'); ?>>


    <?php if ($type_post_feature === 'default'): ?>
        <?php if (has_post_thumbnail()): ?>
            <?php
            $img = pxl_get_image_by_size(array(
                'attach_id'  => get_post_thumbnail_id($post->ID),
                'thumb_size' => $featured_img_size,
            ));
            $thumbnail = $img['thumbnail'];
            ?>
            <div class="pxl-item--image">
                <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo pxl_print_html($thumbnail); ?></a>
            </div>
        <?php endif; ?>

    <?php elseif ($type_post_feature === 'video_link'): ?>
        <?php if (has_post_thumbnail()): ?>
            <?php
            $img = pxl_get_image_by_size(array(
                'attach_id'  => get_post_thumbnail_id($post->ID),
                'thumb_size' => $featured_img_size,
            ));
            $thumbnail = $img['thumbnail'];
            ?>
            <div class="pxl-item--image">
                <a href="<?php echo esc_url(get_permalink()); ?>">
                    <?php echo pxl_print_html($thumbnail); ?>
                </a>
                <?php if (!empty($post_video_link)): ?>
                    <a href="<?php echo esc_url($post_video_link); ?>" class="post-button-video pxl-action-popup">
                        <i class="caseicon-play1"></i>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    <?php elseif ($type_post_feature === 'image_swiper'): ?>
        <div class="pxl-swiper-slider pxl-image-carousel">
            <div class="pxl-image--swiper ">
                <?php $post_images = explode(',', $post_images[0]); ?>  
                <?php foreach ($post_images as $image_id): ?>
                    <?php
                    $img_post = pxl_get_image_by_size(array(
                        'attach_id'  => $image_id,
                        'thumb_size' => 'full', 
                    ));
                    $thumbnail = $img_post['thumbnail'];
                    ?>
                    <div class="pxl-swiper-slide swiper-slide grid-item">
                        <div class="pxl-item--image">
                            <a href="<?php echo esc_url(get_permalink()); ?>">
                                <?php echo pxl_print_html($thumbnail); ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
            <div class="pxl-swiper-arrow-wrap style-3">
                <div class="pxl-swiper-arrow pxl-swiper-arrow-prev"><i class="caseicon-angle-arrow-left rtl-icon"></i></div>
                <div class="pxl-swiper-arrow pxl-swiper-arrow-next"><i class="caseicon-angle-arrow-right rtl-icon"></i></div>
            </div>
        </div>
        
        
    <?php endif; ?>


    <div class="pxl-item--holder">
        <?php organify()->blog->get_archive_meta(); ?>
        <h4 class="pxl-item--title">
            <a href="<?php echo esc_url( get_permalink()); ?>" title="<?php the_title_attribute(); ?>">
                <?php if(is_sticky()) { ?>
                    <i class="caseicon-check-mark pxl-mr-4"></i>
                <?php } ?>
                <?php the_title(); ?>
            </a>
        </h4>
        <div class="pxl-item--excerpt">
            <?php
            organify()->blog->get_excerpt();
            wp_link_pages( array(
                'before'      => '<div class="page-links">',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ) );
            ?>
        </div>
        <div class="pxl-item--readmore">
            <a class="btn-icon-box" href="<?php echo esc_url( get_permalink()); ?>">
                <span class="pxl--btn-text"><?php echo organify_html($archive_readmore_text); ?></span>
                <span class="pxl--btn-icon pxl-ml-8"><i class="flaticon flaticon-right-arrow-1"></i></span>
            </a>
        </div>
    </div>
</article>