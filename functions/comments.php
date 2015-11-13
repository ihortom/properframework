<?php

//custom gbook comment function
function pweb_comments ($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>" class="comment-container">
            <div class="row small-uncollapse">
                <div class="comment-avatar text-center small-centered small-3 medium-2 columns">
                    <?php echo get_avatar( $comment->comment_author_email, 50 ); ?>
                </div>
                <div class="comment-author small-9 medium-10 columns">
                    <span class="author"><?php printf('<cite>%s</cite>', get_comment_author()) ?></span><br>
                    <time datetime="<?php echo get_comment_date("c")?>" class="comment-date">  
                            <?php 
                                printf('%1$s %2$s', get_comment_date(),  get_comment_time()); 
                            ?>
                            &nbsp;&nbsp;&nbsp;
                            <?php
                                edit_comment_link(__('(Edit)','properweb')); 
                            ?>
                    </time>
                </div>
            </div>
            <div class="row">
                <div class="small-12 large-10 large-offset-2 columns">
                    <div class="comment-text">
                        <?php if ($comment->comment_approved == '0') : ?>
                                 <br /><em><?php _e('Your comment is awaiting approval.','properweb') ?></em>
                        <?php endif; ?>

                        <?php comment_text() ?>

                    </div>
                </div>
            </div>
        </div>
<?php } ?>
