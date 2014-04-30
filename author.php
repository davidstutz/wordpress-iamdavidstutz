<?php get_header(); ?>
<div class="row">
    <div class="col-md-9">
        <div class="author">
            <?php
                global $wp_query;
                $user = $wp_query->get_queried_object();
            ?>
            <div class="author-title">
                <h1><?php echo __('AUTHOR', 'iamdavidstutz'); ?>&raquo;<?php echo $user->display_name; ?>&laquo;</h1>
            </div>
            <blockquote class="author-description">
                <p><?php echo $user->description; ?></p>
                <small><?php echo $user->display_name; ?></small>
            </blockquote>
        </div>
    </div>
    <div class="col-md-3">
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>	