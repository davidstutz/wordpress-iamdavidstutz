<?php get_header(); ?>

    <div class="row">
        <div class="col-md-9">

            <?php if (have_posts()) : ?>
                <?php while (have_posts()): the_post(); ?>
                    <?php if (in_category('reading')): ?>
                        <div class="reading-container">
                            <div class="reading">
                                <div class="reading-date">
                                    <?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
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

                                <?php if (get_field('shortscience')): ?>
                                    <div class="reading-shortscience">
                                        <?php echo __('Also find this summary on', 'iamdavidstutz'); ?> <a href="<?php the_field('shortscience'); ?>" target="_blank">ShortScience.org</a>.
                                    </div>
                                <?php endif; ?>

                                <?php if (iamdavidstutz_comments_open()): ?>
                                    <div class="reading-comments">
                                        <?php comments_template(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="article-container">
                            <div class="article">
                                <div class="article-date">
                                    <?php echo strtoupper(get_the_date('F')); ?><?php echo get_the_date('Y'); ?>
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
                                <?php if (iamdavidstutz_comments_open()): ?>
                                    <div class="article-comments">
                                        <?php comments_template(); ?>
                                    </div>
                                <?php endif; ?>
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
