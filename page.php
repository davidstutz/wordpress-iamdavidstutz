<?php get_header(); ?>

    <div class="row">
        <div class="col-md-9">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()): the_post(); ?>
                    <div class="page">
                        <div class="page-content">
                            <?php the_content(); ?>
                        </div>
                        <?php iamdavidstutz_page_footer(); ?>
                        <?php if (iamdavidstutz_comments_open()): ?>
                            <div class="page-comments">
                                <p>
                                    <?php echo __('What is <b>your opinion</b> on this article? Did you find it interesting or useful? <b>Let me know</b> your thoughts in the comments below or get in touch with me:', 'iamdavidstutz'); ?>
                                    <div class="text-center page-comments-social">
                                        <a href="https://twitter.com/david_stutz" target="_blank">@david_stutz <span class="fa fa-twitter"></span></a>&nbsp;
                                        <a href="https://www.linkedin.com/in/davidstutz92" target="_blank"><span class="fa fa-linkedin-square"></span></a>
                                        <a href="https://www.xing.com/profile/David_Stutz5" target="_blank"><span class="fa fa-xing"></span></a>
                                        <a href="https://github.com/davidstutz" target="_blank"><span class="fa fa-github"></span></a>
                                    </div>
                                </p>
                                <?php comments_template(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="nothing">
                    <h1><?php echo __('NOTHING', 'iamdavidstutz'); ?></h1>
                    <h4><?php echo __('NOTHINGFOUNDHERE', 'iamdavidstutz'); ?></h4>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-3">
            <?php get_sidebar('page'); ?>
        </div>
    </div>
    
<?php get_footer(); ?>
