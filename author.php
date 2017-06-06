<?php get_header(); ?>

    <div class="author">
        <?php
            global $wp_query;
            $user = $wp_query->get_queried_object();
        ?>

        <div class="author-links">
            <div>
                <a href="http://davidstutz.de/wordpress/wp-content/uploads/2014/12/CV.pdf" target="_blank"><?php echo __('CV', 'iamdavidstutz'); ?><span class="fa fa-file-pdf-o"></span></a>
            </div>
            <div>
                <a href="https://www.linkedin.com/in/davidstutz92" target="_blank"><?php echo __('LinkedIn', 'iamdavidstutz'); ?><span class="fa fa-linkedin-square"></span></a>
            </div>
            <div>
                <a href="https://www.xing.com/profile/David_Stutz5" target="_blank"><?php echo __('Xing', 'iamdavidstutz'); ?><span class="fa fa-xing"></span></a>
            </div>
            <div>
                <a href="https://github.com/davidstutz" target="_blank"><?php echo __('GitHub', 'iamdavidstutz'); ?><span class="fa fa-github"></span></a>
            </div>
            <div>
                <a href="https://twitter.com/david_stutz" target="_blank"><?php echo __('Twitter', 'iamdavidstutz'); ?><span class="fa fa-twitter"></span></a>
            </div>
        </div>

        <div class="author-biography">
            <?php $page = get_page_by_path('profile'); ?>
            <?php echo do_shortcode($page->post_content); ?>
        </div>
    </div>

<?php get_footer(); ?>
