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
            <?php $query = new WP_query('post_type=ub_part&post_author=' . $user->ID . '&orderby=date&post_limits=10'); ?>
            <?php while ($query->have_posts()): $query->the_post(); ?>
                <blockquote class="author-description">
                    <p><?php the_content(); ?></p>
                    <small>
                        <?php $day = get_the_date('d'); ?>
                        <?php if ($day == 1): ?>
                            <?php echo $day; ?><sup>st</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                        <?php elseif ($day == 2): ?>
                            <?php echo $day; ?><sup>nd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                        <?php elseif ($day == 3): ?>
                            <?php echo $day; ?><sup>rd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?> 
                        <?php else: ?>
                            <?php echo $day; ?><sup>th</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                        <?php endif; ?>, <?php echo $user->display_name; ?>
                    </small>
                </blockquote>
            <?php endwhile; ?>
        </div>
    </div>
    <div class="col-md-3">
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>	