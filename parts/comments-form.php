<form action="<?php echo site_url(); ?>/wp-comments-post.php" method="post" id="commentform">

    <?php if ( is_user_logged_in() ) : ?>
        <?php $current_user = wp_get_current_user(); ?>
        <p><?php _e('Logged in as','properweb'); printf(' <a href="%1$s">%2$s</a>.', get_edit_user_link(), $current_user->display_name); ?> 
            <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php esc_attr_e('Log out of this account'); ?>"><?php _e('Log out'); echo ' &raquo;' ?></a></p>
    <?php else : ?>

    <p class="text-center"><small><?php _e('Your e-mail will not be shared. All the fields are mandatory.','properweb'); ?> *</small></p>
    <div class="row small-collapse medium-uncollapse">
        <div class="medium-12 large-6 columns">
            <div id="contacts" class="row small-collapse">
                <div id="name" class="small-12 medium-6 large-12 columns">
                    <label for="author"><?php _e('Name:','properweb'); ?> <?php if ($req) echo '*'; ?></label>
                    <input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
                </div>

                <div id="email" class="small-12 medium-6 large-12 columns">
                    <label for="email"><?php _e('Email:','properweb'); ?> <?php if ($req) echo '*'; ?></label>
                    <input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
                </div>
            </div>
        </div>
    <?php endif; ?>
        <div class="medium-12 large-6 columns">
            <div id="message">
                <label for="comment"><?php _e('Message:','properweb'); ?> * <a href="#" data-reveal-id="msg-tags"><i class="fa fa-info-circle"></i></a></label>
                <textarea name="comment" id="comment" cols="40" rows="6" tabindex="4"></textarea>
            </div>
            <div id="msg-tags" class="reveal-modal small" data-reveal aria-hidden="true" role="dialog">
                <?php 
                    $msg_tags = __('<p class="lead"><strong>HTML:</strong> You can use these tags:</p><p><code>%s</code></p>','properweb');
                    printf($msg_tags, allowed_tags()); ?>
                <a class="close-reveal-modal" aria-label="Close">&#215;</a>
            </div>
        </div>
    </div>
    <?php
            /** This filter is documented in wp-includes/comment-template.php */
            do_action( 'comment_form', $post->ID );
    ?>
    <br>
    <p class="clearfix text-center">
        <input name="submit" type="submit" id="submit" class="button round small" tabindex="5" value="<?php _e('Submit','properweb'); ?>" />
        <?php comment_id_fields(); ?>
    </p>
</form>
