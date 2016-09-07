<?php get_header(); ?>
<div class="row">
    <div class="col-md-9">
        <div class="author">
            <?php
                global $wp_query;
                $user = $wp_query->get_queried_object();
            ?>

            <div class="author-above-header">
                <h3><?php echo __('PROFILE', 'iamdavidstutz'); ?></h3>
            </div>

            <div class="author-header">
                <h2><?php echo __('SUMMARY', 'iamdavidstutz'); ?></h2>
            </div>

            <div class="author-short-biography">

            </div>

            <div class="author-links">
                <div>
                    <a href="http://davidstutz.de/wordpress/wp-content/uploads/2014/12/CV.pdf" target="_blank"><?php echo __('CV', 'iamdavidstutz'); ?><span class="fa fa-file-pdf-o"></span></a>
                </div>
                <div>
                    <a href="http://davidstutz.de/wordpress/wp-content/uploads/2014/12/CV-german.pdf" target="_blank"><?php echo __('CV (German)', 'iamdavidstutz'); ?><span class="fa fa-file-pdf-o"></span></a>
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
            </div>

            <div class="author-biography">
                <div class="author-above-header">
                    <h3><?php echo __('PROFILE', 'iamdavidstutz'); ?></h3>
                </div>

                <div class="author-header">
                    <h2><?php echo __('BIOGRAPHY', 'iamdavidstutz'); ?></h2>
                </div>

                <p>
                    
                </p>
                <p>
                    
                </p>
                <p>
                
                </p>

                <div class="author-updates">

                    <div class="author-above-header">
                        <h3><?php echo __('PROFILE', 'iamdavidstutz'); ?></h3>
                    </div>

                    <div class="author-header">
                        <h2><?php echo __('UPDATES', 'iamdavidstutz'); ?></h2>
                    </div>

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
    </div>
    <div class="col-md-3">
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
