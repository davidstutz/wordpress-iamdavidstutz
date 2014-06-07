<?php if ('open' == $post->comment_status): ?>
    <script type="text/javascript"><!--//--><![CDATA[//><!--
            $(document).ready(function() {
                $('.comment-form').validate({
                    rules: {
                        name: {
                            minlength: 2,
                            required: true
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        comment: {
                            minlength: 40,
                            required: true
                        },
                    },
                    messages: {
                        email: {
                            email: '<?php echo __('Enter a valid email address.', 'iamdavidstutz'); ?>',
                            required: '<?php echo __('Enter your email address.', 'iamdavidstutz'); ?>',
                        },
                        comment: {
                            minLength: '<?php echo __('Your comment is not long enough. 40 characters are required.', 'iamdavidstutz'); ?>',
                            required: '<?php echo __('What do you want to say without any comment?', 'iamdavidstutz'); ?>',
                        },
                        name: {
                            minLength: '<?php echo __('Enter at least 2 characters for your name.', 'iamdavidstutz'); ?>',
                            required: '<?php echo __('Enter your name.', 'iamdavidstutz'); ?>',
                        }
                    },
                    highlight: function(label) {
                        $(label).closest('.form-group').addClass('has-error');
                    },
                    errorContainer: '.comment-form-errors',
                    errorLabelContainer: '.comment-form-errors',
                });
            });
    //--><!]]></script>
    
    <h4>COMMENTS</h4>                         
    <form method="POST" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" class="comment-form form-horizontal">
        <div class="comment-form-errors"></div>
        <?php if (!$user_ID): ?>
            <div class="form-group">
                <label class="col-md-2 control-label" for="author">
                   <?php echo __('Name', 'iamdavidstutz'); ?>
                </label>
                <div class="col-md-10">
                    <input class="form-control" name="author" type="text" value="<?php echo $comment_author ?>" size="30" maxlength="20" tabindex="3" />
                </div>
            </div>
            <div class="form-group has-error">
                <label class="col-md-2 control-label" for="email">
                    <?php echo __('Email', 'iamdavidstutz'); ?>
                </label>
                <div class="col-md-10">
                    <input class="form-control" name="email" type="text" value="<?php echo $comment_author_email ?>" size="30" maxlength="50" tabindex="4" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="url">
                    <?php echo __('Website', 'iamdavidstutz'); ?>
                </label>
                <div class="col-md-10">
                    <input class="form-control" name="url" type="text" value="<?php echo $comment_author_url ?>" size="30" maxlength="50" tabindex="5" />
                </div>
            </div>
        <?php else: ?>
            <div class="form-group">
                <label class="col-md-2 control-label" for="author">
                   Posting as
                </label>
                <div class="col-md-10">
                    <div class="comment-form-user">
                        <span class="elusive icon-user"></span> David Stutz
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label class="col-md-2 control-label" for="comment">
                <?php echo __('Comment', 'iamdavidstutz'); ?>
            </label>
            <div class="col-md-10">
                <textarea class="form-control" name="comment" tabindex="5"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" class="btn btn-primary"><?php echo __('RESPOND', 'iamdavidstutz'); ?></button>
                <?php comment_id_fields(get_the_ID()); ?>
            </div>
        </div>
    </form>
<?php endif; ?>
<?php if (have_comments()) : ?>
    <div class="comments">
        <?php wp_list_comments(array(
            'type' => 'comment',
            'callback' => 'iamdavidstutz_custom_comments',
        )); ?>
    </div>
<?php endif; ?>
