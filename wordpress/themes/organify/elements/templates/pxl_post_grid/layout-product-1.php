<?php
if(class_exists('Woocommerce')) {
    $html_id = pxl_get_element_id($settings);
    $tax = array();
    $select_post_by = $widget->get_setting('select_post_by', '');
    $source = $post_ids = [];
    if($select_post_by === 'post_selected'){
        $post_ids = $widget->get_setting('source_'.$settings['post_type'].'_post_ids', '');
    }else{
        $source  = $widget->get_setting('source_'.$settings['post_type'], '');
    }
    $orderby = $widget->get_setting('orderby', 'date');
    $order = $widget->get_setting('order', 'desc');
    $limit = $widget->get_setting('limit', 6);
    extract(pxl_get_posts_of_grid(
        'product', 
        ['source' => $source, 'orderby' => $orderby, 'order' => $order, 'limit' => $limit, 'post_ids' => $post_ids],
        ['product_cat']
    ));
    $filter_default_title = $widget->get_setting('filter_default_title', 'All');
    if($settings['col_xl'] == '5') {
        $col_xl = 'pxl5';
    } else {
        $col_xl = 12 / intval($widget->get_setting('col_xl', 4));
    }
    $col_lg = 12 / intval($widget->get_setting('col_lg', 4));
    $col_md = 12 / intval($widget->get_setting('col_md', 3));
    $col_sm = 12 / intval($widget->get_setting('col_sm', 2));
    $col_xs = 12 / intval($widget->get_setting('col_xs', 1));
    $grid_sizer = "col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";

    $grid_class = 'pxl-grid-inner pxl-grid-masonry row';

    $filter = $widget->get_setting('filter', 'false');
    $filter_alignment = $widget->get_setting('filter_alignment', 'center');
    $pagination_type = $widget->get_setting('pagination_type', 'pagination');

    $post_type = $widget->get_setting('post_type','product');
    $layout = $widget->get_setting('layout_'.$post_type, 'product-1');

    $grid_masonry = $widget->get_setting('grid_masonry');
    $pxl_animate = $widget->get_setting('pxl_animate');
    $show_title = $widget->get_setting('show_title');
    $filter_style = $widget->get_setting('filter_style');
    $show_price = $widget->get_setting('show_price');
    $show_excerpt = $widget->get_setting('show_excerpt');
    $show_button = $widget->get_setting('show_button');
    $img_size = $widget->get_setting('img_size');

    $load_more = array(
        'post_type'       => $post_type,   
        'layout'          => $layout,
        'startPage'       => $paged,
        'maxPages'        => $max,
        'total'           => $total,
        'perpage'         => $limit,
        'nextLink'        => $next_link,
        'source'          => $source,
        'orderby'         => $orderby,
        'order'           => $order,
        'limit'           => $limit,
        'post_ids'        => $post_ids,
        'col_xl'          => $col_xl,
        'col_lg'          => $col_lg,
        'col_md'          => $col_md,
        'col_sm'          => $col_sm,
        'col_xs'          => $col_xs,
        'show_title' => $show_title,
        'filter_style' => $filter_style,
        'img_size' => $img_size,
        'show_price' => $show_price,
        'show_excerpt' => $show_excerpt,
        'show_button' => $show_button,
        'pagination_type' => $pagination_type,
        'grid_masonry'    => $grid_masonry,
        'pxl_animate'    => $pxl_animate,
    );
    ?>

    <div id="<?php echo esc_attr($html_id) ?>" class="pxl-grid pxl-product-grid pxl-product-grid-layout1 woocommerce filter-<?php echo esc_attr($filter_style); ?>" data-layout="masonry" data-start-page="<?php echo esc_attr($paged); ?>" data-max-pages="<?php echo esc_attr($max); ?>" data-total="<?php echo esc_attr($total); ?>" data-perpage="<?php echo esc_attr($limit); ?>" data-next-link="<?php echo esc_attr($next_link); ?>">
        <?php if ($select_post_by == 'term_selected' && $filter == "true"): ?>
            <div class="pxl-grid-filter pxl-grid-filter1 <?php echo esc_attr($filter_style); ?>">
                <div class="filter-item active" data-filter="*"><?php echo esc_html($filter_default_title); ?></div>
                <?php foreach ($categories as $category): ?>
                    <?php $category_arr = explode('|', $category); ?>
                    <?php $tax[] = $category_arr[1]; ?>
                    <?php $term = get_term_by('slug',$category_arr[0], $category_arr[1]); ?>

                    <div class="filter-item" data-filter="<?php echo esc_attr('.' . $term->slug); ?>">
                        <?php echo esc_html($term->name); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="<?php echo esc_attr($grid_class); ?>" data-gutter="15">
            <?php $load_more['tax'] = $tax; organify_get_post_grid($posts, $load_more); ?>
            <div class="grid-sizer <?php echo esc_attr($grid_sizer); ?>"></div>
        </div>
        <?php   

        if ($pagination_type == 'pagination') { ?>
            <div class="pxl-grid-pagination" data-loadmore="<?php echo esc_attr(json_encode($load_more)); ?>" data-query="<?php echo esc_attr(json_encode($args)); ?>">
                <?php organify()->page->get_pagination($query, true); ?>
            </div>
        <?php } ?>
        <?php if (!empty($next_link) && $pagination_type == 'loadmore') { 
            $text_btn_loadmore = !empty($settings['text_btn_loadmore']) ? $settings['text_btn_loadmore'] : 'Load More';
            ?>
            <div class="pxl-load-more">
                <span class="btn btn-grid-loadmore">
                    <span class="pxl-loadmore-text"><?php echo esc_html__($text_btn_loadmore).'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M10 4.1665V15.8332" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.16669 10H15.8334" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>' ?>
                </span>
                <span class="pxl-load-icon"></span>
            </span>
        </div>
    <?php } ?>
</div>
<?php } ?>