<?php
$html_id = pxl_get_element_id($settings);

$editor_title = $widget->get_settings_for_display( 'title_product_grid' );
$editor_title = $widget->parse_text_editor( $editor_title ); 

$query_type = $widget->get_setting('query_type', 'recent_product');
$post_per_page = $widget->get_setting('post_per_page', 8);
$product_ids = $widget->get_setting('product_ids', '');
$categories = $widget->get_setting('taxonomies', '');
$param_args=[];

$loop = organify_woocommerce_query($query_type,$post_per_page,$product_ids,$categories,$param_args);
extract($loop);

$layout               = $widget->get_setting('layout', '2');
$filter_default_title = $widget->get_setting('filter_default_title', 'All');
$filter               = $widget->get_setting('filter', 'false');
$pagination_type      = $widget->get_setting('pagination_type', 'false');
$layout_mode          = $widget->get_setting('layout_mode', 'fitRows');

$item_animation          = $widget->get_setting('item_animation', '') ;
$item_animation_duration = $widget->get_setting('item_animation_duration', 'normal');
$item_animation_delay    = $widget->get_setting('item_animation_delay', '150');

$img_size = $widget->get_setting('img_size');

$show_title = $widget->get_setting('show_title');
$show_price = $widget->get_setting('show_price');
$show_excerpt = $widget->get_setting('show_excerpt');
$show_button = $widget->get_setting('show_button');


$load_more = array(
    'layout'             => $layout,
    'query_type'         => $query_type,
    'product_ids'        => $product_ids,
    'categories'         => $categories,
    'param_args'         => $param_args,
    'startPage'          => $paged,
    'maxPages'           => $max,
    'total'              => $total,
    'limit'              => $post_per_page,
    'nextLink'           => $next_link,
    'layout_mode'         => $layout_mode,
    'filter'              => $filter,
    'item_animation'          => $item_animation ,
    'item_animation_duration' => $item_animation_duration,
    'item_animation_delay'    => $item_animation_delay,
    'col_xs'                  => $widget->get_setting('col_xs', '1'),
    'col_sm'                  => $widget->get_setting('col_sm', '2'),
    'col_md'                  => $widget->get_setting('col_md', '2'),
    'col_lg'                  => $widget->get_setting('col_lg', '3'),
    'col_xl'                  => $widget->get_setting('col_xl', '4'),
    'col_xxl'                 => $widget->get_setting('col_xxl', '4')
);

$widget->add_render_attribute( 'wrapper', [
    'id'               => $html_id,
    'class'            => trim('pxl-grid woocommerce pxl-product-grid layout-'.$layout),
    'data-layout'      =>  $layout_mode,
    'data-start-page'  => $paged,
    'data-max-pages'   => $max,
    'data-total'       => $total,
    'data-perpage'     => $post_per_page,
    'data-next-link'   => $next_link
]);

if(is_admin())
    $grid_class = 'pxl-grid-inner pxl-grid-masonry-adm row ';
else
    $grid_class = 'pxl-grid-inner pxl-grid-masonry row';

$widget->add_render_attribute( 'grid', 'class', $grid_class);

if( $total <= 0){
    echo '<div class="pxl-no-post-grid">'.esc_html__( 'No Post Found', 'organify' ). '</div>';
    return;
}

$col_xxl = 'col-xxl-'.str_replace('.', '',12 / floatval( $settings['col_xxl']));
$col_xl  = 'col-xl-'.str_replace('.', '',12 / floatval( $settings['col_xl']));
$col_lg  = 'col-lg-'.str_replace('.', '',12 / floatval( $settings['col_lg']));
$col_md  = 'col-md-'.str_replace('.', '',12 / floatval( $settings['col_md']));
$col_sm  = 'col-sm-'.str_replace('.', '',12 / floatval( $settings['col_sm']));
$col_xs  = 'col-'.str_replace('.', '',12 / floatval( $settings['col_xs']));


$item_class = trim(implode(' ', ['pxl-grid-item', $col_xxl, $col_xl, $col_lg, $col_md, $col_sm, $col_xs]));

$data_animation = [];
$animate_cls = '';
$data_settings = '';
if ( !empty( $item_animation ) ) {
    $animate_cls = ' pxl-animate pxl-invisible animated-'.$item_animation_duration;
    $data_animation['animation'] = $item_animation;
    $data_animation['animation_delay'] = $item_animation_delay;
}

?>
<?php if ($posts->found_posts > 0): ?>
    <div <?php pxl_print_html($widget->get_render_attribute_string( 'wrapper' )) ?>>
        <div class="pxl-grid-overlay"></div>
        <div class="pxl-heading--product-grid">
            <?php if (!empty ($settings['title_product_grid'])) : ?>
                <h3 class="pxl-title--grid <?php echo esc_attr($settings['pxl_animate_tt']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay_tt']); ?>ms">
                    <?php echo wp_kses_post($editor_title); ?>
                </h3>
            <?php endif; ?>

            <?php if ($filter == "true" && !empty($categories) ): ?>
                <div class="pxl-grid-filter pxl-grid-filter1 style-2">
                    <span class="filter-item active pxl-transtion" data-filter="*"><?php echo esc_html($filter_default_title); ?></span>
                    <?php foreach ($categories as $category): ?>
                        <?php $term = get_term_by('slug',$category, 'product_cat'); ?>
                        <span class="filter-item pxl-transtion" data-filter="<?php echo esc_attr('.' . $term->slug); ?>"><?php echo esc_html($term->name); ?></span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div <?php pxl_print_html($widget->get_render_attribute_string('grid')); ?>>
            <?php
            $d = 0;
            while ($posts->have_posts()) {
                $posts->the_post();
                global $product;
                $d++;
                $term_list = array();
                $term_of_post = wp_get_post_terms($product->get_ID(), 'product_cat');
                $categories = $product->get_category_ids();

                $unit_price = get_post_meta($product->get_id(), 'unit_price');
                foreach ($term_of_post as $term) {
                    $term_list[] = $term->slug;
                }
                $filter_class = implode(' ', $term_list);

                if ( !empty( $data_animation ) ) {
                    $data_animation['animation_delay'] = ((float)$item_animation_delay * $d);
                    $data_animations = json_encode($data_animation);
                    $data_settings = 'data-settings="'.esc_attr($data_animations).'"';
                }

                $regular_price = get_post_meta( get_the_ID(), '_regular_price', true);
                $sale_price = get_post_meta( get_the_ID(), '_sale_price', true);
                $product_sale = '';

                ?>
                
                <div class="<?php echo trim(implode(' ', [$item_class, $filter_class, $animate_cls])); ?>" <?php pxl_print_html($data_settings); ?>>
                    <div class="pxl-item--inner pxl-products--inner <?php echo esc_attr($settings['pxl_animate']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms" data-wow-duration="">
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
                            <?php
                            $image_size = !empty($img_size) ? $img_size : '282x256';
                            $img_id     = get_post_thumbnail_id( $product->get_ID());
                            if (has_post_thumbnail($product->get_ID())):
                                $img = pxl_get_image_by_size( array(
                                    'attach_id'  => $img_id,
                                    'thumb_size' => $image_size,
                                ) );
                            $thumbnail = $img['thumbnail'];
                            ?>
                            <div class="woocommerce-product-header">
                                <?php if(isset($thumbnail)): ?>
                                <a class="woocommerce-product-details" href="<?php echo esc_url(get_permalink( $product->get_ID() )); ?>">
                                    <?php echo wp_kses_post($thumbnail); ?>
                                </a>
                            <?php endif; ?>
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
                            <?php if ($settings['show_rating'] === 'true'): ?>
                                <div class="woocommerce-product-rating">
                                    <?php woocommerce_template_loop_rating(); ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <?php if($show_title == 'true'): ?>
                            <h4 class="woocommerce-product-title">
                                <a href="<?php echo esc_url(get_permalink( $product->get_id())); ?>"><?php echo pxl_print_html(get_the_title($product->get_id())); ?></a>

                            </h4>
                        <?php endif; ?>
                        <div class="woocommerce-product-content">
                            <?php if($show_price == 'true'): ?>
                                <div class="woocommerce-product--price"><?php echo wp_kses_post($product->get_price_html()); ?></div>
                            <?php endif; ?>
                            <?php if($show_button == 'true'): ?>
                                <div class="pxl-add-to-cart">
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
                <?php
            }

                echo '<div class="grid-sizer '.$item_class.'"></div>';
            ?>
            <?php wp_reset_postdata(); ?>
        </div>

        <?php if ($pagination_type == 'pagination') { ?>
            <div class="pxl-grid-pagination pagin-product d-flex" data-loadmore="<?php echo esc_attr(json_encode($load_more)); ?>" data-query="<?php echo esc_attr(json_encode($args)); ?>">
                <?php organify()->page->get_pagination($query, true); ?>
            </div>
        <?php } ?>
        <?php if (!empty($next_link) && $pagination_type == 'loadmore'):
            ?>
            <div class="pxl-load-more product" data-loadmore="<?php echo esc_attr(json_encode($load_more)); ?>" data-loading-text="<?php echo esc_attr__('Loading', 'organify') ?>" data-loadmore-text="<?php echo esc_html($settings['loadmore_text']); ?>">
                <span class="pxl-btn btn-product-grid-loadmore right">
                    <span class="btn-text"><?php echo esc_html($settings['loadmore_text']); ?></span>
                    <span class="pxl-btn-icon pxli-spinner"></span>
                </span>
            </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>