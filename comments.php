<?php if ( comments_open() ) : ?>

    <div id="gbook">
	<div id="respond">
            <h3><?php comment_form_title( __('LEAVE A COMMENT', 'properweb') ); ?></h3>

            <div id="cancel-comment-reply">
                    <small><?php cancel_comment_reply_link() ?></small>
            </div>

            <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
                    <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url( get_permalink() )); ?></p>
            <?php else : ?>

            <form action="<?php echo site_url(); ?>/wp-comments-post.php" method="post" id="commentform">

                <?php if ( is_user_logged_in() ) : ?>
                        <?php $current_user = wp_get_current_user(); ?>
                        <p><?php printf(__('Logged in as <a href="%1$s">%2$s</a>.'), get_edit_user_link(), $current_user->display_name); ?> 
                            <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php esc_attr_e('Log out of this account'); ?>"><?php _e('Log out &raquo;'); ?></a></p>
                <?php else : ?>

                <p style="text-align: center; margin-bottom: 20px;">Your e-mail will not be shared. All the fields are mandatory. *</p>

                <div id="contacts">
                    <div><label for="author"><?php _e('Name:'); ?> <?php if ($req) _e('*'); ?></label><br>
                    <input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> /></div>

                    <div><label for="email"><?php _e('Email:'); ?> <?php if ($req) _e('*'); ?></label><br>
                    <input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> /></div>
                </div>
                <?php endif; ?>

                <div id="message">
                        <label for="comment"><?php _e('Message: *'); ?></label><br>
                        <textarea name="comment" id="comment" cols="40" rows="10" tabindex="4"></textarea>

                        <p><small><?php printf(__('<strong>XHTML:</strong> You can use these tags: <code>%s</code>'), allowed_tags()); ?></small></p>
                </div>			
                <?php
                        /** This filter is documented in wp-includes/comment-template.php */
                        do_action( 'comment_form', $post->ID );
                ?>
                <p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php esc_attr_e('Submit Comment'); ?>" />
                <?php comment_id_fields(); ?></p>
            </form>

            <?php endif; // If registration required and not logged in ?>
        </div>
	
<!-- COMMENTS -->
    <?php if ( have_comments() ) : ?>
        <div id="comments">	
                <h3 class="gbook-stats"><?php	printf( _n( 'One comment', '%1$s comments', get_comments_number() ),
                                                                                number_format_i18n( get_comments_number() ), '&#8220;' . "Guest Book" . '&#8221;' ); ?></h3>


                <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
                <div class="gbook-navigation nav-top">
                        <div class="alignright"><?php previous_comments_link(' » ') ?></div>
                        <div class="alignright"><?php next_comments_link(' « ') ?></div>
                </div>
                <div class="clearfix"></div>
                <?php endif; // check for comment navigation ?>

                <ul class="comment-list">
                        <?php wp_list_comments('type=comment&callback=pweb_comments'); //use custom comment list in functions.php ?>
                </ul>

                <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
                <div class="gbook-navigation nav-bottom">
                        <div class="alignright"><?php previous_comments_link(' » ') ?></div>
                        <div class="alignright"><?php next_comments_link(' « ') ?></div>
                </div>
                <div class="clearfix"></div>
                <?php endif; // check for comment navigation ?>

         <?php else : // this is displayed if there are no comments so far ?>

            <?php if ( comments_open() ) : ?>

                <br>
                <div data-alert class="alert-box info radius">
                    <p class="text-center"><i class="fa fa-comment-o fa-lg fa-fw"></i>There are no comments yet. Be the first to leave a comment.</p>
                </div>

            <?php else : // comments are closed ?>
                <!-- If comments are closed. -->
                <p class="nocomments"><?php _e('Comments are closed.'); ?></p>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div><!-- #gbook -->
<?php endif; // if you delete this the sky will fall on your head ?>
</div>
