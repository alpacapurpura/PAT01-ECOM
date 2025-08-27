<?php

$col_xs = $widget->get_setting('col_xs', '1');
$col_sm = $widget->get_setting('col_sm', '1');
$col_md = $widget->get_setting('col_md', '1');
$col_lg = $widget->get_setting('col_lg', '1');
$col_xl = $widget->get_setting('col_xl', '1');
$col_xxl = $widget->get_setting('col_xxl', '1');
if($col_xxl == 'inherit') {
    $col_xxl = $col_xl;
}

$query_type = $widget->get_setting('query_type', 'recent_product');
$param_args=[];
$source = $widget->get_setting('source', '');
$limit = $widget->get_setting('limit', 4);
$post_ids = $widget->get_setting('post_ids', '');

extract(pxl_get_posts_of_grid('product', [
    'source' => $source,
    'limit' => $limit,
    'post_ids' => $post_ids,
]));

$loop = organify_woocommerce_query($query_type,$limit,$post_ids,$source,$param_args);
extract($loop);


$slides_to_scroll = $widget->get_setting('slides_to_scroll');
$arrows = $widget->get_setting('arrows', false);  
$pagination = $widget->get_setting('pagination', false);
$pagination_type = $widget->get_setting('pagination_type', 'bullets');
$pause_on_hover = $widget->get_setting('pause_on_hover', false);
$autoplay = $widget->get_setting('autoplay', false);
$autoplay_speed = $widget->get_setting('autoplay_speed', 5000);
$infinite = $widget->get_setting('infinite', false);  
$speed = $widget->get_setting('speed', 500);
$img_size = $widget->get_setting('img_size');
$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => 1, 
    'slide_mode'                    => 'fade', 
    'slides_to_show'                => (int)$col_xl, 
    'slides_to_show_xxl'            => (int)$col_xxl, 
    'slides_to_show_lg'             => (int)$col_lg, 
    'slides_to_show_md'             => (int)$col_md, 
    'slides_to_show_sm'             => (int)$col_sm, 
    'slides_to_show_xs'             => (int)$col_xs, 
    'slides_to_scroll'              => (int)$slides_to_scroll,
    'arrow'                         => (bool)$arrows,
    'pagination'                    => (bool)$pagination,
    'pagination_type'               => $pagination_type,
    'autoplay'                      => (bool)$autoplay,
    'pause_on_hover'                => (bool)$pause_on_hover,
    'pause_on_interaction'          => true,
    'delay'                         => (int)$autoplay_speed,
    'loop'                          => (bool)$infinite,
    'speed'                         => (int)$speed
];
$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
if(isset($settings['slide_home']) && !empty($settings['slide_home']) && count($settings['slide_home'])): ?>
    <div class="pxl-swiper-slider pxl-slide--home pxl-slide--home2">
        <div class="pxl-carousel-inner">
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper">
                    <?php foreach ($settings['slide_home'] as $key => $value):

                        $d = 0;
                        $posts->the_post();
                        global $product;
                        $d++;
                        $regular_price = get_post_meta( get_the_ID(), '_regular_price', true);
                        $sale_price = get_post_meta( get_the_ID(), '_sale_price', true);
                        $product_sale = '';

                        $categories = $product->get_category_ids();


                        $bg_image = isset($value['bg_image']) ? $value['bg_image'] : '';
                        $title = isset($value['title']) ? $value['title'] : '';
                        $concept = isset($value['concept']) ? $value['concept'] : '';
                        $description = isset($value['description']) ? $value['description'] : '';
                        $text_button = isset($value['text_button']) ? $value['text_button'] : 'Purchase Now';

                        $editor_title = $widget->parse_text_editor( $value['title'] );

                        $link_key = $widget->get_repeater_setting_key( 'button_link', 'value', $key );
                        if ( ! empty( $value['button_link']['url'] ) ) {
                            $widget->add_render_attribute( $link_key, 'href', $value['button_link']['url'] );

                            if ( $value['button_link']['is_external'] ) {
                                $widget->add_render_attribute( $link_key, 'target', '_blank' );
                            }

                            if ( $value['button_link']['nofollow'] ) {
                                $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                            }
                        }
                        $link_attributes = $widget->get_render_attribute_string( $link_key );

                        ?>
                        <div class="pxl-swiper-slide elementor-repeater-item-<?php echo esc_attr($value['_id']); ?>">

                            <?php                             
                            $bg_image = pxl_get_image_by_size( 
                                array(
                                    'attach_id'  => $bg_image['id'],
                                    'thumb_size' => 'full',
                                    'class' => 'no-lazyload',
                                ));
                            $bg_image_url = $bg_image['url'];

                            ?>
                            <div class="pxl-item--inner" style="background-image: url(<?php echo esc_url($bg_image_url); ?>);" >
                                <div class="pxl-introduction--product">
                                 <?php if (!empty($title)): ?>
                                    <h2 class="pxl-slide--title <?php echo esc_attr($settings['pxl_animate_title']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay_title']); ?>ms">
                                        <?php echo wp_kses_post($editor_title); ?>
                                    </h2>
                                <?php endif ?>
                                <?php if (!empty($concept)): ?>
                                    <h4 class="pxl-slide--concept <?php echo esc_attr($settings['pxl_animate_concept']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay_concept']); ?>ms">
                                        <?php echo pxl_print_html($concept); ?>
                                    </h4>
                                <?php endif ?>
                                <?php if (!empty($description)): ?>
                                    <div class="pxl-slide--description <?php echo esc_attr($settings['pxl_animate_description']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay_description']); ?>ms">
                                        <?php echo pxl_print_html($description); ?>
                                    </div>
                                <?php endif ?>
                                <?php if (!empty($text_button)): ?>
                                    <a class="btn pxl--button  <?php echo esc_attr($settings['pxl_animate_button'].' '.$settings['btn_text_effect']); ?>" <?php echo implode( ' ', [ $link_attributes ] ); ?> data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay_button']); ?>ms">
                                        <span class="pxl--btn-text" data-text="<?php echo esc_attr($text_button); ?>">
                                            <?php if($settings['btn_text_effect'] == 'btn-text-nina' || $settings['btn_text_effect'] == 'btn-text-nanuk') {
                                                $chars = preg_split('//u', $text_button, null, PREG_SPLIT_NO_EMPTY);

                                                foreach ($chars as $value) {
                                                    if($value == ' ') {
                                                        echo '<span class="spacer">&nbsp;</span>';
                                                    } else {
                                                        echo '<span>' . htmlspecialchars($value) . '</span>';
                                                    }
                                                }
                                            } else {
                                                echo pxl_print_html($text_button);
                                            }
                                            ?>
                                        </span>
                                    </a>
                                <?php endif ?>
                            </div>

                            <div class="woocommerce  <?php echo esc_attr($settings['pxl_animate_product']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay_product']); ?>ms">
                                <div class="woocommerce-product-inner ">

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

                                    <?php
                                    $img_size = !empty($value['img_size']) ? $value['img_size'] : '233x192';
                                    $img_id     = get_post_thumbnail_id( $product->get_ID() );
                                    if (has_post_thumbnail($product->get_ID()) && wp_get_attachment_image_src(get_post_thumbnail_id($product->get_ID()), false)):
                                        $img = pxl_get_image_by_size( array(
                                            'attach_id'  => $img_id,
                                            'thumb_size' => $img_size,
                                        ) );
                                    $thumbnail = $img['thumbnail'];
                                    ?>

                                    <div class="woocommerce-product-header">
                                        <a class="woocommerce-product-details" href="<?php echo esc_url(get_permalink( $product->get_ID() )); ?>">
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
                                <div class="pxl--content">
                                    <div class="pxl-product--inner">
                                        <?php if (!empty($categories) && $settings['show_category'] === 'true') : 
                                            $first_category_id = $categories[0];
                                            $first_category = get_term($first_category_id, 'product_cat');
                                            $link_url_category = esc_url(get_term_link($first_category));
                                            ?>
                                            <div class="product-category">
                                                <a href="<?php pxl_print_html($link_url_category); ?>"> <?php echo esc_html($first_category->name); ?></a> 
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($settings['show_description'] === 'true') : ?>
                                            <div class="woocommerce-sg-product-excerpt">
                                                <p><?php echo pxl_print_html($product->get_short_description());?></p>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                    <div class="woocommerce-product-content">
                                        <?php if ($settings['show_price'] === 'true') : ?>
                                            <div class="woocommerce-product--price">
                                                <?php echo wp_kses_post($product->get_price_html()); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($settings['show_cart'] === 'true') : ?>
                                            <div class="pxl-add-to-cart">
                                                <?php echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                                                    sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button ajax_add_to_cart %s product_type_%s">%s</a>',
                                                        esc_url( $product->add_to_cart_url() ),
                                                        esc_attr( $product->get_id() ),
                                                        esc_attr( $product->get_sku() ),
                                                        $product->is_purchasable() ? 'add_to_cart_button' : '',
                                                        esc_attr( $product->get_type() ),
                                                        esc_html( $product->add_to_cart_text() )
                                                    ), $product ); ?>
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php if($arrows !== false): ?>
            <div class="pxl-swiper-arrow-wrap style-2">
                <div class="pxl-swiper-arrow pxl-swiper-arrow-prev"><i class="caseicon-angle-arrow-left rtl-icon"></i></div>
                <div class="pxl-swiper-arrow pxl-swiper-arrow-next"><i class="caseicon-angle-arrow-right rtl-icon"></i></div>
            </div>
        <?php endif; ?>

    </div>
</div>
<?php endif; ?>
