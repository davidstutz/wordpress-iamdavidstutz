<?php get_header(); ?>
<div class="row">
    <div class="col-md-9">
        <div class="author">
            <?php
                global $wp_query;
                $user = $wp_query->get_queried_object();
            ?>
            <div class="author-title">
                <h2 style="display:inline;float:left;margin:0 12px 0 0;"><?php echo __('PROFILE', 'iamdavidstutz'); ?></h2>
                <div class="author-title-text">
                    <p>
                        Inspired by the elegant and simultaneously versatile world of computer science, I am a student eager to learn more in all its different disciplines. I focus on computer vision and machine learning – combining the depth of theory with the most interesting applications of today’s world.
                    </p>
                    <p>
                        Planning a career in academia, I am not only passionate about acquiring new knowledge, but also motivated to share this knowledge with other professionals as well as future generations.
                    </p>
                </div>
            </div>
            
            <div class="author-links">
                <div>
                    <a href="http://davidstutz.de/wordpress/wp-content/uploads/2014/06/CV-online.pdf" target="_blank"><?php echo __('Resum&eacute;', 'iamdavidstutz'); ?><span class="fa fa-file-pdf-o"></span></a>
                </div>
                <div>
                    <a href="https://github.com/davidstutz" target="_blank"><?php echo __('GitHub', 'iamdavidstutz'); ?><span class="fa fa-github"></span></a>
                </div>
                <div>
                    <a href="https://twitter.com/david_stutz" target="_blank"><?php echo __('Twitter', 'iamdavidstutz'); ?><span class="fa fa-twitter"></span></a>
                </div>
            </div>
            <div class="author-biography">
                <?php $query = new WP_query('post_type=ub_part&post_author=' . $user->ID . '&orderby=date&post_limits=10'); ?>
                <?php while ($query->have_posts()): $query->the_post(); ?>
                    <blockquote class="author-description">
                        <?php str_replace('<p></p>', '', the_content()); ?>
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
    </div>
    <div class="col-md-3">
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>	