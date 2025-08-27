<?php 

if(!function_exists('organify_get_post_grid')){
    function organify_get_post_grid($posts = [], $settings = []){ 
        if (empty($posts) || !is_array($posts) || empty($settings) || !is_array($settings)) {
            return false;
        }
        switch ($settings['layout']) {
            case 'post-1':
            organify_get_post_grid_layout1($posts, $settings);
            break;

            case 'product-1':
            organify_get_product_grid_layout1($posts, $settings);
            break;


            default:
            return false;
            break;
        }
    }
}

// Start Post Grid
//--------------------------------------------------
function organify_get_post_grid_layout1($posts = [], $settings = []){ 
    extract($settings);
    
    $images_size = !empty($img_size) ? $img_size : '419x279';
    $images_size_featured = !empty($img_size_featured) ? $img_size_featured : '677x439';

    if (is_array($posts)):
        foreach ($posts as $key => $post):
            if ($items_featured_sw == 'true') {
                if ($key === 0) {
                    ?>
                    <?php
                    $item_class = "pxl-grid-item pxl-item--featured col-12";
                    if(isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
                        if($grid_masonry[$key]['col_xl_m'] == 'col-66') {
                            $col_xl_m = '66-pxl';
                        } else {
                            $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
                        }
                        if($grid_masonry[$key]['col_lg_m'] == 'col-66') {
                            $col_lg_m = '66-pxl';
                        } else {
                            $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
                        }
                        $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
                        $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
                        $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
                        $item_class = "pxl-grid-item col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m}";

                        $img_size_m = $grid_masonry[$key]['img_size_m'];
                        if(!empty($img_size_m)) {
                            $images_size = $img_size_m;
                        }
                    } elseif (!empty($img_size_featured)) {
                        $images_size_featured = $img_size_featured;
                    }

                    if(!empty($tax)) {
                        $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
                    }
                    else {
                        $filter_class = ''; 
                    }
                    $current_user = wp_get_current_user();
                    $post_video_link = get_post_meta($post->ID, 'post_video_link', true);
                    $post_images = get_post_meta($post->ID, 'post_images');
                    $type_post_feature = get_post_meta($post->ID,'type_post_feature','default');
                    ?>
                    <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                        <div class="pxl-post--inner row<?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">


                            <?php if ($type_post_feature === 'default'): ?>
                             <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)):
                             $img_id = get_post_thumbnail_id($post->ID);
                             $img          = pxl_get_image_by_size( array(
                                'attach_id'  => $img_id,
                                'thumb_size' => $images_size_featured
                            ) );
                             $thumbnail    = $img['thumbnail'];
                             ?>
                             <div class="pxl-item--featured col-md-6 col-12  ">
                                <div class="pxl-post--featured hover-imge-effect2 item-featured">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                                    <?php if($show_date == 'true'): ?>
                                        <div class="item--date">
                                            <div class="item--day">
                                                <?php $date_formart = 'd'; echo get_the_date($date_formart, $post->ID); ?>
                                            </div>
                                            <div class="item--month">
                                                <?php $date_formart = 'M'; echo get_the_date($date_formart, $post->ID); ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                        <?php endif; ?>

                    <?php elseif ($type_post_feature === 'video_link'): ?>
                        <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)):
                        $img_id = get_post_thumbnail_id($post->ID);
                        $img          = pxl_get_image_by_size( array(
                            'attach_id'  => $img_id,
                            'thumb_size' => $images_size_featured
                        ) );
                        $thumbnail    = $img['thumbnail'];
                        ?>
                        <div class="pxl-item--featured col-md-6 col-12  ">
                            <div class="pxl-post--featured hover-imge-effect2 item-featured">
                                <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                                <?php if(!empty($post_video_link)) : ?>
                                    <a href="<?php echo esc_url($post_video_link); ?>" class="post-button-video pxl-action-popup"><i class="caseicon-play1"></i></a>
                                <?php endif; ?>
                                <?php if($show_date == 'true'): ?>
                                    <div class="item--date">
                                        <div class="item--day">
                                            <?php $date_formart = 'd'; echo get_the_date($date_formart, $post->ID); ?>
                                        </div>
                                        <div class="item--month">
                                            <?php $date_formart = 'M'; echo get_the_date($date_formart, $post->ID); ?>

                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                <?php elseif ($type_post_feature === 'image_swiper'): ?>
                    <div class="pxl-swiper-slider pxl-image-carousel item-featured col-md-6 col-12 ">
                        <?php if($show_date == 'true'): ?>
                            <div class="item--date">
                                <div class="item--day">
                                    <?php $date_formart = 'd'; echo get_the_date($date_formart, $post->ID); ?>
                                </div>
                                <div class="item--month">
                                    <?php $date_formart = 'M'; echo get_the_date($date_formart, $post->ID); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="pxl-image--swiper ">
                            <?php $post_images = explode(',', $post_images[0]); ?>  
                            <?php foreach ($post_images as $image_id): ?>
                                <?php
                                $img_post = pxl_get_image_by_size(array(
                                    'attach_id'  => $image_id,
                                    'thumb_size' => $images_size_featured, 
                                ));
                                $thumbnail = $img_post['thumbnail'];
                                ?>
                                <div class="pxl-swiper-slide swiper-slide grid-item">
                                    <div class="pxl-post--featured hover-imge-effect2 ">
                                        <a href="<?php echo esc_url(get_permalink( $post->ID ));?>">
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
                <div class="pxl-post--infomation col-md-6 col-12 ">
                    <?php if($show_category == 'true'): ?>
                        <div class="pxl--category">
                            <?php
                            $categories = get_the_category($post->ID);
                            if ( !empty($categories) ) {
                                $first_category = $categories[0];
                                echo '<a href="' . esc_url(get_category_link($first_category->term_id)) . '"><i class="flaticon flaticon-superellipse pxl-mr-8""></i>'  . esc_html($first_category->name) . '</a>';
                            }
                            ?> 
                        </div>
                    <?php endif; ?>
                    <h3 class="pxl-post--title"><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo pxl_print_html(get_the_title($post->ID)); ?></a></h3>
                    <?php if($show_excerpt == 'true'): ?>
                        <div class="pxl-post--content">
                            <?php echo wp_trim_words( $post->post_excerpt, $num_words, $more = null ); ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <?php
    }

    if ($key >= 1) {
        $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
        if(isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
            if($grid_masonry[$key]['col_xl_m'] == 'col-66') {
                $col_xl_m = '66-pxl';
            } else {
                $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
            }
            if($grid_masonry[$key]['col_lg_m'] == 'col-66') {
                $col_lg_m = '66-pxl';
            } else {
                $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
            }
            $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
            $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
            $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
            $item_class = "pxl-grid-item col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m}";

            $img_size_m = $grid_masonry[$key]['img_size_m'];
            if(!empty($img_size_m)) {
                $images_size = $img_size_m;
            }
        } elseif (!empty($img_size)) {
            $images_size = $img_size;
        }

        if(!empty($tax))
            $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
        else 
            $filter_class = ''; 
        $current_user = wp_get_current_user();
        $post_video_link = get_post_meta($post->ID, 'post_video_link', true);
        $post_images = get_post_meta($post->ID, 'post_images');
        $type_post_feature = get_post_meta($post->ID,'type_post_feature','default');
        ?>
        <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
            <div class="pxl-post--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">


                <?php if ($type_post_feature === 'default'): ?>
                 <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)):
                 $img_id = get_post_thumbnail_id($post->ID);
                 $img          = pxl_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $images_size
                ) );
                 $thumbnail    = $img['thumbnail'];
                 ?>
                 <div class="pxl-post--featured hover-imge-effect2 item-featured">
                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                    <?php if($show_date == 'true'): ?>
                        <div class="item--date">
                            <div class="item--day">
                                <?php $date_formart = 'd'; echo get_the_date($date_formart, $post->ID); ?>
                            </div>
                            <div class="item--month">
                                <?php $date_formart = 'M'; echo get_the_date($date_formart, $post->ID); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        <?php elseif ($type_post_feature === 'video_link'): ?>
            <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)):
            $img_id = get_post_thumbnail_id($post->ID);
            $img          = pxl_get_image_by_size( array(
                'attach_id'  => $img_id,
                'thumb_size' => $images_size
            ) );
            $thumbnail    = $img['thumbnail'];
            ?>
            <div class="pxl-post--featured hover-imge-effect2 item-featured">
                <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                <?php if(!empty($post_video_link)) : ?>
                    <a href="<?php echo esc_url($post_video_link); ?>" class="post-button-video pxl-action-popup"><i class="caseicon-play1"></i></a>
                    <?php if($show_date == 'true'): ?>
                        <div class="item--date">
                            <div class="item--day">
                                <?php $date_formart = 'd'; echo get_the_date($date_formart, $post->ID); ?>
                            </div>
                            <div class="item--month">
                                <?php $date_formart = 'M'; echo get_the_date($date_formart, $post->ID); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    <?php elseif ($type_post_feature === 'image_swiper'): ?>
        <div class="pxl-swiper-slider pxl-image-carousel item-featured">
            <?php if($show_date == 'true'): ?>
                <div class="item--date">
                    <div class="item--day">
                        <?php $date_formart = 'd'; echo get_the_date($date_formart, $post->ID); ?>
                    </div>
                    <div class="item--month">
                        <?php $date_formart = 'M'; echo get_the_date($date_formart, $post->ID); ?>

                    </div>
                </div>
            <?php endif; ?>
            <div class="pxl-image--swiper ">
                <?php $post_images = explode(',', $post_images[0]); ?>  
                <?php foreach ($post_images as $image_id): ?>
                    <?php
                    $img_post = pxl_get_image_by_size(array(
                        'attach_id'  => $image_id,
                        'thumb_size' => $images_size, 
                    ));
                    $thumbnail = $img_post['thumbnail'];
                    ?>
                    <div class="pxl-swiper-slide swiper-slide grid-item">
                        <div class="pxl-post--featured hover-imge-effect2 ">
                            <a href="<?php echo esc_url(get_permalink( $post->ID ));?>">
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
    <?php if($show_category == 'true'): ?>
        <div class="pxl--category">
            <?php
            $categories = get_the_category($post->ID);
            if ( !empty($categories) ) {
                $first_category = $categories[0];
                echo '<a href="' . esc_url(get_category_link($first_category->term_id)) . '"><i class="flaticon flaticon-superellipse pxl-mr-8""></i>'  . esc_html($first_category->name) . '</a>';
            }
            ?> 
        </div>
    <?php endif; ?>
    <h3 class="pxl-post--title"><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo pxl_print_html(get_the_title($post->ID)); ?></a></h3>
</div>
</div>
<?php


}
}else{
    $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
    if(isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
        if($grid_masonry[$key]['col_xl_m'] == 'col-66') {
            $col_xl_m = '66-pxl';
        } else {
            $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
        }
        if($grid_masonry[$key]['col_lg_m'] == 'col-66') {
            $col_lg_m = '66-pxl';
        } else {
            $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
        }
        $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
        $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
        $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
        $item_class = "pxl-grid-item col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m}";

        $img_size_m = $grid_masonry[$key]['img_size_m'];
        if(!empty($img_size_m)) {
            $images_size = $img_size_m;
        }
    } elseif (!empty($img_size)) {
        $images_size = $img_size;
    }

    if(!empty($tax)){
        $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
    }
    else {
        $filter_class = ''; 
    }
    $current_user = wp_get_current_user();
    $post_video_link = get_post_meta($post->ID, 'post_video_link', true);
    $post_images = get_post_meta($post->ID, 'post_images');
    $type_post_feature = get_post_meta($post->ID,'type_post_feature','default');
    ?>
    <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
        <div class="pxl-post--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">


            <?php if ($type_post_feature === 'default'): ?>
             <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)):
             $img_id = get_post_thumbnail_id($post->ID);
             $img          = pxl_get_image_by_size( array(
                'attach_id'  => $img_id,
                'thumb_size' => $images_size
            ) );
             $thumbnail    = $img['thumbnail'];
             ?>
             <div class="pxl-post--featured hover-imge-effect2 item-featured">
                <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                <?php if($show_date == 'true'): ?>
                    <div class="item--date">
                        <div class="item--day">
                            <?php $date_formart = 'd'; echo get_the_date($date_formart, $post->ID); ?>
                        </div>
                        <div class="item--month">
                            <?php $date_formart = 'M'; echo get_the_date($date_formart, $post->ID); ?>

                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    <?php elseif ($type_post_feature === 'video_link'): ?>
        <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)):
        $img_id = get_post_thumbnail_id($post->ID);
        $img          = pxl_get_image_by_size( array(
            'attach_id'  => $img_id,
            'thumb_size' => $images_size
        ) );
        $thumbnail    = $img['thumbnail'];
        ?>
        <div class="pxl-post--featured hover-imge-effect2 item-featured">
            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
            <?php if(!empty($post_video_link)) : ?>
                <a href="<?php echo esc_url($post_video_link); ?>" class="post-button-video pxl-action-popup"><i class="caseicon-play1"></i></a>
                <?php if($show_date == 'true'): ?>
                    <div class="item--date">
                        <div class="item--day">
                            <?php $date_formart = 'd'; echo get_the_date($date_formart, $post->ID); ?>
                        </div>
                        <div class="item--month">
                            <?php $date_formart = 'M'; echo get_the_date($date_formart, $post->ID); ?>

                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

<?php elseif ($type_post_feature === 'image_swiper'): ?>
    <div class="pxl-swiper-slider pxl-image-carousel item-featured">
        <?php if($show_date == 'true'): ?>
            <div class="item--date">
                <div class="item--day">
                    <?php $date_formart = 'd'; echo get_the_date($date_formart, $post->ID); ?>
                </div>
                <div class="item--month">
                    <?php $date_formart = 'M'; echo get_the_date($date_formart, $post->ID); ?>

                </div>
            </div>
        <?php endif; ?>
        <div class="pxl-image--swiper ">
            <?php $post_images = explode(',', $post_images[0]); ?>  
            <?php foreach ($post_images as $image_id): ?>
                <?php
                $img_post = pxl_get_image_by_size(array(
                    'attach_id'  => $image_id,
                    'thumb_size' => $images_size, 
                ));
                $thumbnail = $img_post['thumbnail'];
                ?>
                <div class="pxl-swiper-slide swiper-slide grid-item">
                    <div class="pxl-post--featured hover-imge-effect2 ">
                        <a href="<?php echo esc_url(get_permalink( $post->ID ));?>">
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
<?php if($show_category == 'true'): ?>
    <div class="pxl--category">
        <?php
        $categories = get_the_category($post->ID);
        if ( !empty($categories) ) {
            $first_category = $categories[0];
            echo '<a href="' . esc_url(get_category_link($first_category->term_id)) . '"><i class="flaticon flaticon-superellipse pxl-mr-8""></i>'  . esc_html($first_category->name) . '</a>';
        }
        ?> 
    </div>
<?php endif; ?>
<h3 class="pxl-post--title"><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo pxl_print_html(get_the_title($post->ID)); ?></a></h3>
</div>
</div>
<?php
}

endforeach;
endif;
}

// End Post Grid
//--------------------------------------------------



// Start Product Grid
//--------------------------------------------------

function organify_get_product_grid_layout1($posts = [], $settings = []){ 
    extract($settings);

    $images_size = !empty($img_size) ? $img_size : '600x600';

    if (is_array($posts)):
        foreach ($posts as $key => $post):
            $item_class = "pxl-grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
            if(isset($grid_masonry) && !empty($grid_masonry[$key]) && (count($grid_masonry) > 1)) {
                $col_xl_m = 12 / $grid_masonry[$key]['col_xl_m'];
                $col_lg_m = 12 / $grid_masonry[$key]['col_lg_m'];
                $col_md_m = 12 / $grid_masonry[$key]['col_md_m'];
                $col_sm_m = 12 / $grid_masonry[$key]['col_sm_m'];
                $col_xs_m = 12 / $grid_masonry[$key]['col_xs_m'];
                $item_class = "pxl-grid-item col-xl-{$col_xl_m} col-lg-{$col_lg_m} col-md-{$col_md_m} col-sm-{$col_sm_m} col-{$col_xs_m}";
                
                $img_size_m = $grid_masonry[$key]['img_size_m'];
                if(!empty($img_size_m)) {
                    $images_size = $img_size_m;
                }
            } elseif (!empty($img_size)) {
                $images_size = $img_size;
            }

            if(!empty($tax))
                $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
            else 
                $filter_class = '';

            $product = wc_get_product( $post->ID );
            $regular_price = get_post_meta( $product->get_id(), '_regular_price', true);
            $sale_price = get_post_meta( $product->get_id(), '_sale_price', true);
            $product_sale = '';
            ?>
            <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                <div class="pxl-item--inner pxl-products--inner <?php echo esc_attr($pxl_animate); ?>" data-wow-duration="1.2s">
                    <?php if (!empty($sale_price)) {
                        $regular_price_int = intval($regular_price);
                        $sale_price_int = intval($sale_price);
                        $product_sale = intval((($regular_price_int - $sale_price_int) / $regular_price_int) * 100);
                        if ($product_sale >= 0 && $product_sale < 25) {
                            echo '<span class="onsale light-discount">' . $product_sale . '%</span>';
                        } elseif ($product_sale >= 25 && $product_sale < 50) {
                            echo '<span class="onsale regular-discount">' . $product_sale . '%</span>';
                        } elseif ($product_sale >= 50 && $product_sale < 75) {
                            echo '<span class="onsale deep-discount">' . $product_sale . '%</span>';
                        } elseif ($product_sale >= 75 && $product_sale <= 100) {
                            echo '<span class="onsale major-discount">' . $product_sale . '%</span>';
                        }
                    } ?>
                    <div class="woocommerce-product-inner">
                        <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)): 
                        $img_id = get_post_thumbnail_id($product->get_id());
                        $img = organify_get_image_by_size( array(
                            'attach_id'  => $img_id,
                            'thumb_size' => $images_size,
                            'class' => 'no-lazyload',
                        ));
                        $thumbnail = $img['thumbnail'];
                        ?>


                        <div class="woocommerce-product-header">
                            <a class="woocommerce-product-details" href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>
                            <div class="woocommerce-product-meta">

                                <div class="woocommerce--toolbar">
                                    <?php if (class_exists('WPCleverWoosc')) { ?>
                                        <div class="woos woocommerce--compare">
                                            <?php echo do_shortcode('[woosc id="'.esc_attr( $product->get_id() ).'"]'); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if (class_exists('WPCleverWoosw')) { ?>
                                        <div class="woos woocommerce--wishlist ">
                                            <?php echo do_shortcode('[woosw id="'.esc_attr( $product->get_id() ).'"]'); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if (class_exists('WPCleverWoosq')) { ?>
                                        <div class="woos woocommerce--quickview">
                                            <?php echo do_shortcode('[woosq id="'.esc_attr( $product->get_id() ).'"]'); ?>
                                        </div>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="woocommerce-product-content">
                        <?php if($show_title == 'true'): ?>
                            <div class="woocommerce-product-title">
                                <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo pxl_print_html(get_the_title($post->ID)); ?></a>
                            </div>
                        <?php endif; ?>
                        <?php if($show_excerpt == 'true'): ?>
                            <div class="woocommerce-sg-product-excerpt">
                                <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><p><?php echo pxl_print_html($product->get_short_description());?></p></a>
                                
                            </div>
                        <?php endif; ?>
                        <?php if($show_price == 'true'): ?>
                            <div class="woocommerce-product--price"><?php echo wp_kses_post($product->get_price_html()); ?></div>
                        <?php endif; ?>
                        <?php if($show_button == 'true'): ?>
                            <div class="woocommerce-add-to-cart">
                                <?php
                                echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                                    sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button ajax_add_to_cart %s product_type_%s">%s</a>',
                                        esc_url( $product->add_to_cart_url() ),
                                        esc_attr( $product->get_id() ),
                                        esc_attr( $product->get_sku() ),
                                        $product->is_purchasable() ? 'add_to_cart_button' : '',
                                        esc_attr( $product->get_type() ),
                                        esc_html( $product->add_to_cart_text() )
                                    ),
                                    $product );
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php wp_reset_postdata(); ?>
            <?php
        endforeach;
    endif;
}
// End Product Grid
//--------------------------------------------------

add_action( 'wp_ajax_organify_load_more_post_grid', 'organify_load_more_post_grid' );
add_action( 'wp_ajax_nopriv_organify_load_more_post_grid', 'organify_load_more_post_grid' );
function organify_load_more_post_grid(){
    try{
        if(!isset($_POST['settings'])){
            throw new Exception(('Something went wrong while requesting. Please try again!'));
        }
    
        $settings = isset($_POST['settings']) ? $_POST['settings'] : null;
       
        $source = isset($settings['source']) ? $settings['source'] : '';
        $term_slug = isset($settings['term_slug']) ? $settings['term_slug'] : '';
        if( !empty($term_slug) && $term_slug !='*'){
            $term_slug = str_replace('.', '', $term_slug);
            $source = [$term_slug.'|'.$settings['tax'][0]]; 
        }
        if( isset($_POST['handler_click']) && sanitize_text_field(wp_unslash( $_POST[ 'handler_click' ] )) == 'filter'){
            set_query_var('paged', 1);
            $settings['paged'] = 1;
        }else{
            set_query_var('paged', $settings['paged']);
        }
        extract(pxl_get_posts_of_grid($settings['post_type'], [
                'source' => $source,
                'orderby' => isset($settings['orderby'])?$settings['orderby']:'date',
                'order' => isset($settings['order'])?$settings['order']:'desc',
                'limit' => isset($settings['limit'])?$settings['limit']:'6',
                'post_ids' => isset($settings['post_ids'])?$settings['post_ids']: [],
                'post_not_in' => isset($settings['post_not_in'])?$settings['post_not_in']: [],
            ],
            $settings['tax']
        ));

        ob_start();
            organify_get_post_grid($posts, $settings);
        $html = ob_get_clean();

        $pagin_html = '';
        if( isset($settings['pagination_type']) && $settings['pagination_type'] == 'pagination' ){ 
            ob_start();
                organify()->page->get_pagination( $query,  true );
            $pagin_html = ob_get_clean();
        }
        wp_send_json(
            array(
                'status' => true,
                'message' => esc_attr('Load Successfully!', 'organify'),
                'data' => array(
                    'html' => $html,
                    'pagin_html' => $pagin_html,
                    'paged' => $settings['paged'],
                    'posts' => $posts,
                    'max' => $max,
                ),
            )
        );
    }
    catch (Exception $e){
        wp_send_json(array('status' => false, 'message' => $e->getMessage()));
    }
    die;
}