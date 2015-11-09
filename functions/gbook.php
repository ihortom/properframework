<?php if ( comments_open() ) : ?>
<div>
    <div id="gbook">
	<div id="respond">
            <h3><?php comment_form_title( __('LEAVE A MESSAGE IN THE GUEST BOOK', 'properweb') ); ?></h3>

            <div id="cancel-comment-reply">
                    <small><?php cancel_comment_reply_link() ?></small>
            </div>

            <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
                    <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url( get_permalink() )); ?></p>
            <?php else : ?>

            <?php include_once dirname(dirname(__FILE__)).'/parts/comments-form.php'; ?>

            <?php endif; // If registration required and not logged in ?>
        </div>
	
<!-- COMMENTS -->
    <?php if ( have_comments() ) : ?>
        <div id="comments">	
                <h3 class="gbook-stats"><?php	printf( _n( 'One message in %2$s', '%1$s messages in %2$s', get_comments_number() ),
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
                    <p class="text-center"><i class="fa fa-comment-o fa-lg fa-fw"></i>There are no messages yet. Be the first to leave a message.</p>
                </div>
            <?php else : // comments are closed ?>
                <!-- If comments are closed. -->
                <p class="nocomments"><?php _e('Comments are closed.'); ?></p>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div><!-- #gbook -->
<?php else : ?>
    <p class="text-center">Comments are not enabled.</p>
<?php endif; ?>
