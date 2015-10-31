<?php

//custom gbook comment function
function pwrf_gbook_comment ($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>" class="comment-container">
                <div class="comment-avatar">
    <?php echo get_avatar( $comment->comment_author_email, 50 ); ?>
            </div>
                <div class="comment-text">
                    <header class="comment-author">
                        <span class="author"><?php printf(__('<cite>%s</cite>','wip'), get_comment_author()) ?></span><br>
                        <time datetime="<?php echo get_comment_date("c")?>" class="comment-date">  
                                <?php 
                                        printf(__('%1$s %2$s','wip'), get_comment_date(),  get_comment_time()); 
                                ?>
                                &nbsp;&nbsp;&nbsp;
                                <?php
                                        edit_comment_link(__('(Edit)','wip')); 
                                ?>
                        </time>
                    </header>
                    <?php if ($comment->comment_approved == '0') : ?>
                             <br /><em><?php _e('Your comment is awaiting approval.','wip') ?></em>
                    <?php endif; ?>

                    <?php comment_text() ?>

                </div>

                <div class="clearfix"></div>
            </div>
<?php } ?>
