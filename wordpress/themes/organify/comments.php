<?php
/**
 * @package Case-Themes
 */

if ( post_password_required() ) {
    return;
} 
$post_related = organify()->get_theme_opt( 'post_related', false );
?>

<div id="comments" class="comments-area">

    <?php
    if ( have_comments() ) : ?>
        <div class="comment-list-wrap">

            <h2 class="comments-title">
                <?php
                $comment_count = get_comments_number();
                if ( 1 === intval($comment_count) ) {
                    echo esc_html__( '1 Comment', 'organify' );
                } else {
                    echo esc_attr( $comment_count ).' '.esc_html__('Comments', 'organify');
                }
                ?>
            </h2>

            <?php the_comments_navigation(); ?>

            <ul class="comment-list">
                <?php
                wp_list_comments( array(
                    'style'      => 'ul',
                    'short_ping' => true,
                    'callback'   => 'organify_comment_list',
                    'max_depth'  => 3
                ) );
                ?>
            </ul>

            <?php the_comments_navigation(); ?>
        </div>
        <?php if ( ! comments_open() ) : ?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'organify' ); ?></p>
            <?php
        endif;

    endif;

    $args = array(
        'id_form'           => 'commentform',
        'id_submit'         => 'submit',
        'class_submit'         => 'btn btn-text-parallax btn-icon-box',
        'title_reply'       => esc_attr__( 'Leave A Comment', 'organify'),
        'title_reply_to'    => esc_attr__( 'Leave A Comment To ', 'organify') . '%s',
        'cancel_reply_link' => esc_attr__( 'Cancel Comment', 'organify'),
        'submit_button'     => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" /><span class="pxl--btn-text">Submit Now <i class="fas fa-plus"></i></span></button>',
        'comment_notes_before' => '',
        'fields' => apply_filters( 'comment_form_default_fields', array(

            'author_firstname' =>
            '<div class="row"><div class="comment-form-author col-lg-12 col-md-12 col-sm-12">'.
            '<div class="pxl-title">first name</div><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
            '" size="30" placeholder="'.esc_attr__('e.g. Oliver Spiteri', 'organify').'"/></div>',

            'author_lastname' =>
            '<div class="comment-form-author col-lg-12 col-md-12 col-sm-12">'.
            '<div class="pxl-title">last name</div><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
            '" size="30" placeholder="'.esc_attr__('e.g. Oliver Spiteri', 'organify').'"/></div>',

            'email' =>
            '<div class="comment-form-email col-lg-12 col-md-12 col-sm-12">'.
            '<div class="pxl-title">email</div><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
            '" size="30" placeholder="'.esc_attr__('example@email.com', 'organify').'"/></div></div>',
        )
    ),
        'comment_field' =>  '<div class="comment-form-comment"><div class="pxl-title">comment</div><textarea id="comment" name="comment" cols="45" rows="8" placeholder="'.esc_attr__('Write your comment here...', 'organify').'" aria-required="true">' .
        '</textarea></div>',
    );
    comment_form($args); ?>
</div>
<?php if ($post_related) :?>
    <?php organify()->blog->get_related_post();  ?>
<?php endif; ?>
