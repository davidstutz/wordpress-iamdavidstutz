<?php get_header(); ?>

    <div class="row">
        <div class="col-md-9">

            <?php if (have_posts()) : ?>
                <?php while (have_posts()): the_post(); ?>
                    <?php if (in_category('reading')): ?>
                        <div class="reading-container">
                            <div class="reading">
                                <div class="reading-date">
                                    <?php $day = get_the_date('d'); ?>
                                    <?php if ($day == 1): ?>
                                        <?php echo $day; ?><sup>st</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                                    <?php elseif ($day == 2): ?>
                                        <?php echo $day; ?><sup>nd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                                    <?php elseif ($day == 3): ?>
                                        <?php echo $day; ?><sup>rd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                                    <?php else: ?>
                                        <?php echo $day; ?><sup>th</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="reading-above-header">
                                    <h3><?php echo __('READING', 'iamdavidstutz'); ?></h3>
                                </div>
                                <div class="reading-reference">
                                    <?php the_field('reference'); ?>
                                </div>
                                <?php iamdavidstutz_reading_tags(); ?>
                                <?php if (!empty($post->post_content) && $post->post_content != '' && $post->post_content != '<p></p>'): ?>
                                    <div class="reading-comment">
                                        <?php echo the_content(); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="reading-comments">
                                    <p>
                                        <?php echo __('What is <b>your opinion</b> on the summarized work? Or do you know related work that is of interest? <b>Let me know</b> your thoughts in the comments below or using the following platforms:', 'iamdavidstutz'); ?>
                                        <div class="text-center reading-comments-social">
                                            <a href="https://www.linkedin.com/in/davidstutz92" target="_blank"><span class="fa fa-linkedin-square"></span></a>
                                            <a href="https://www.xing.com/profile/David_Stutz5" target="_blank"><span class="fa fa-xing"></span></a>
                                            <a href="https://github.com/davidstutz" target="_blank"><span class="fa fa-github"></span></a>
                                            <a href="https://twitter.com/david_stutz" target="_blank"><span class="fa fa-twitter"></span></a>
                                        </div>
                                    </p>
                                    <?php comments_template(); ?>
                                </div>
                            </div>
                        </div>
                    <?php elseif (in_category('snippet')): ?>
                        <div class="snippet-container">
                            <div class="snippet">
                                <div class="snippet-date">
                                    <?php $day = get_the_date('d'); ?>
                                    <?php if ($day == 1): ?>
                                        <?php echo $day; ?><sup>st</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                                    <?php elseif ($day == 2): ?>
                                        <?php echo $day; ?><sup>nd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                                    <?php elseif ($day == 3): ?>
                                        <?php echo $day; ?><sup>rd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                                    <?php else: ?>
                                        <?php echo $day; ?><sup>th</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="snippet-above-header">
                                    <h3><?php echo __('SNIPPET', 'iamdavidstutz'); ?></h3>
                                </div>
                                <div class="snippet-header">
                                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                </div>
                                <?php iamdavidstutz_snippet_tags(); ?>
                                <div class="snippet-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                <?php if (get_field('github')): ?>
                                    <div class="snippet-github">
                                        <a href="<?php the_field('github'); ?>" target="_blank" class="btn btn-block btn-primary"><?php echo __('This snippet on GitHub', 'iamdavidstutz'); ?></a>
                                    </div>
                                <?php endif; ?>
                                <div class="snippet-code">
                                    <?php echo the_content(); ?>
                                </div>
                                <div class="snippet-comments">
                                    <p>
                                        <?php echo __('What is <b>your opinion</b> on the code snippet? Is it working? <b>Let me know</b> your thoughts in the comments below or using the following platforms:', 'iamdavidstutz'); ?>
                                        <div class="text-center snippet-comments-social">
                                            <a href="https://www.linkedin.com/in/davidstutz92" target="_blank"><span class="fa fa-linkedin-square"></span></a>
                                            <a href="https://www.xing.com/profile/David_Stutz5" target="_blank"><span class="fa fa-xing"></span></a>
                                            <a href="https://github.com/davidstutz" target="_blank"><span class="fa fa-github"></span></a>
                                            <a href="https://twitter.com/david_stutz" target="_blank"><span class="fa fa-twitter"></span></a>
                                        </div>
                                    </p>
                                    <?php comments_template(); ?>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="article-container">
                            <div class="article">
                                <div class="article-date">
                                    <?php $day = get_the_date('d'); ?>
                                    <?php if ($day == 1): ?>
                                        <?php echo $day; ?><sup>st</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                                    <?php elseif ($day == 2): ?>
                                        <?php echo $day; ?><sup>nd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                                    <?php elseif ($day == 3): ?>
                                        <?php echo $day; ?><sup>rd</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                                    <?php else: ?>
                                        <?php echo $day; ?><sup>th</sup><?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
                                    <?php endif; ?>
                                </div>
                                <?php if(in_category('series')): ?>
                                    <div class="article-above-header">
                                        <h3><?php echo __('SERIES', 'iamdavidstutz'); ?>&raquo;<?php the_field('series'); ?>&laquo;</h3>
                                    </div>
                                <?php else: ?>
                                    <div class="article-above-header">
                                        <h3><?php echo __('ARTICLE', 'iamdavidstutz'); ?></h3>
                                    </div>
                                <?php endif; ?>
                                <div class="article-header">
                                    <h2><?php the_title(); ?></h2>
                                </div>
                                <?php iamdavidstutz_article_tags(); ?>
                                <?php if (has_excerpt(get_the_ID())): ?>
                                    <div class="article-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="article-content">
                                    <?php the_content(); ?>
                                </div>
                                <?php if (in_category('series')): ?>
                                    <div class="article-series">
                                        <?php
                                            $category = get_category_by_slug('series');
                                            $posts = get_posts('cat=' . $category->term_id);
                                        ?>
                                        <?php if (sizeof($posts) > 0): ?>
                                            <p><?php echo __('More from', 'iamdavidstutz'); ?>&nbsp;&raquo;<?php the_field('series'); ?>&laquo;:</p>
                                            <ul>
                                        <?php endif; ?>
                                            <?php $i = 0; ?>
                                            <?php foreach ($posts as $post): ?>
                                                <?php if ($i >= 5) break; ?>
                                                <li><a href="<?php echo get_post_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></li>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        <?php if (sizeof($posts) > 0): ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <?php iamdavidstutz_article_footer(); ?>
                                <div class="article-comments">
                                    <p>
                                        <?php echo __('What is <b>your opinion</b> on this article? Did you find it interesting or useful? <b>Let me know</b> your thoughts in the comments below or using the following platforms:', 'iamdavidstutz'); ?>
                                        <div class="text-center article-comments-social">
                                            <a href="https://www.linkedin.com/in/davidstutz92" target="_blank"><span class="fa fa-linkedin-square"></span></a>
                                            <a href="https://www.xing.com/profile/David_Stutz5" target="_blank"><span class="fa fa-xing"></span></a>
                                            <a href="https://github.com/davidstutz" target="_blank"><span class="fa fa-github"></span></a>
                                            <a href="https://twitter.com/david_stutz" target="_blank"><span class="fa fa-twitter"></span></a>
                                        </div>
                                    </p>
                                    <?php comments_template(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="nothing">
                    <h1><?php echo __('NOTHING', 'iamdavidstutz'); ?></h1>
                    <h4><?php echo __('NOTHINGFOUNDHERE', 'iamdavidstutz'); ?></h4>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-3">
            <?php get_sidebar(); ?>
        </div>
    </div>
    
<?php get_footer(); ?>
