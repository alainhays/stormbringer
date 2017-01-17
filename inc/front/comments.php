<?php
// Comment Layout
function stormbringer_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class('media'); ?>>
    <div class="pull-left">
      <div class="comment-avatar vcard">
        <?php echo get_avatar($comment,apply_filters('stormbringer_author_bio_avatar_size', 100) ); ?>
      </div>
    </div>
    <!-- /.comment-avatar -->
    <div class="media-body">
      <div class="comment-message">
        <?php printf(__('<h4 class="media-heading">%s</h4>','stormbringer'), get_comment_author_link()) ?>
        <?php edit_comment_link(__('Edit','stormbringer'),'<span class="edit-comment btn btn-info"><span class="glyphicon glyphicon-pencil"></span>','</span>') ?>

        <?php if ($comment->comment_approved == '0') : ?>
          <div class="alert-message success">
            <p><?php _e('Your comment is awaiting moderation.','stormbringer') ?></p>
          </div>
        <?php endif; ?>

        <?php comment_text() ?>

        <time datetime="<?php echo comment_time('c'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(esc_attr__( 'F j, Y', 'stormbringer' )); ?> <?php _e('at', 'stormbringer'); ?> <?php comment_time(esc_attr__( 'H:i', 'stormbringer' )); ?> </a></time>

      </div>
    </div>
    <!-- /.comment-message	-->

    <!-- </li> is added by wordpress automatically -->
<?php
}

// Disable comments on attachment pages
function stormbringer_media_comment_status( $open, $post_id ) {
    $post = get_post( $post_id );
    if( $post->post_type == 'attachment' ) {
        return false;
    }
    return $open;
}
add_filter( 'comments_open', 'stormbringer_media_comment_status', 10 , 2 );