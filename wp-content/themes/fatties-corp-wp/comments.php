<?php
if (post_password_required()) {
  return;
}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()): ?>
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            echo $comments_number . ' Bình luận';
            ?>
        </h2>

        <ul class="comment-list">
            <?php
            wp_list_comments(array(
              'style' => 'ul',
              'short_ping' => true,
              'avatar_size' => 60,
              'callback' => 'fatties_corp_comment_list',  // Custom callback
            ));
            ?>
        </ul>

        <?php
        if (get_comment_pages_count() > 1 && get_option('page_comments')):
          ?>
            <nav class="navigation comment-navigation" role="navigation">
                <div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'fatties-corp')); ?></div>
                <div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'fatties-corp')); ?></div>
            </nav>
        <?php endif; ?>

    <?php
endif;  // Check for have_comments().
?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')): ?>
        <p class="no-comments"><?php _e('Bình luận đã bị khóa.', 'fatties-corp'); ?></p>
    <?php endif; ?>

    <div class="comment-form-wrapper">
        <?php
        $comment_args = array(
          'title_reply' => 'Thảo luận',
          'title_reply_to' => 'Trả lời %s',
          'class_submit' => 'submit-btn',
          'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
          'comment_field' => '<div class="comment-form-comment form-group"><textarea id="comment" name="comment" cols="45" rows="5" aria-required="true" placeholder="Chia sẻ suy nghĩ của bạn..."></textarea></div>',
          'fields' => apply_filters('comment_form_default_fields', array(
            'author' => '<div class="form-row"><div class="comment-form-author form-group"><input id="author" name="author" type="text" value="" size="30" aria-required="true" placeholder="Tên của bạn *"></div>',
            'email' => '<div class="comment-form-email form-group"><input id="email" name="email" type="text" value="" size="30" aria-required="true" placeholder="Email *"></div></div>',
            'url' => ''  // Remove website field for cleaner look
          )),
          'label_submit' => 'Gửi bình luận'
        );
        comment_form($comment_args);
        ?>
    </div>

</div>
