<form action="<?php echo site_url(); ?>/wp-comments-post.php" method="post" id="commentform">

    <?php if ( is_user_logged_in() ) : ?>
        <?php $current_user = wp_get_current_user(); ?>
        <p><?php printf(__('Logged in as <a href="%1$s">%2$s</a>.'), get_edit_user_link(), $current_user->display_name); ?> 
            <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php esc_attr_e('Log out of this account'); ?>"><?php _e('Log out &raquo;'); ?></a></p>
    <?php else : ?>

    <p class="text-center">Your e-mail will not be shared. All the fields are mandatory. *</p><br>
    <div class="row large-uncollapse">
        <div class="medium-12 large-6 columns">
            <div id="contacts" class="row">
                <div id="name" class="medium-6 large-12 columns">
                    <label for="author"><?php _e('Name:'); ?> <?php if ($req) _e('*'); ?></label><br>
                    <input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
                </div>

                <div id="email" class="medium-6 large-12 columns">
                    <label for="email"><?php _e('Email:'); ?> <?php if ($req) _e('*'); ?></label><br>
                    <input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
                </div>
            </div>
        </div>
    <?php endif; ?>
        <div class="medium-12 large-6 columns">
            <div id="message">
                <label for="comment"><?php _e('Message: *'); ?></label><br>
                <textarea name="comment" id="comment" cols="40" rows="5" tabindex="4"></textarea>

                <p><small><?php printf(__('<strong>HTML:</strong> You can use these tags: <code>%s</code>'), allowed_tags()); ?></small></p>
            </div>
        </div>
    </div>
    <?php
            /** This filter is documented in wp-includes/comment-template.php */
            do_action( 'comment_form', $post->ID );
    ?>
    <p class="clearfix text-center"><input name="submit" type="submit" id="submit" class="button round small" tabindex="5" value="<?php esc_attr_e('Submit'); ?>" />
    <?php comment_id_fields(); ?></p>
</form>