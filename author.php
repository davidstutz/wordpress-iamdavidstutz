<?php get_header(); ?>
<div class="row">
    <div class="col-md-9">
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
                <div class="author-title">
                    <h2><?php echo __('PROFILE', 'iamdavidstutz'); ?></h2>
                    <div class="author-title-text">
                        <p>
                            After obtaining my bachelor degree in computer science from <a href="http://www.rwth-aachen.de/" target="_blank">RWTH Aachen University</a> in 2014, I am currently working towards my master degree.
                            Based on several lectures on computer vision and machine learning, I wrote my bachelor thesis, supervised by <a href="" target="_blank">Prof. Dr. Bastian Leibe</a>,
                            at the <a href="http://www.vision.rwth-aachen.de/" target="_blank">Computer Vision Group</a> on superpixel segmentation. Results from my bachelor thesis were recently published as student
                            paper at the <a href="http://gcpr2015.rwth-aachen.de/" target="_blank">German Conference on Pattern Recognition (GCPR) in Aachen</a>. After my bachelor thesis, I had the great opportunity to spend
                            spring 2015 at <a href="http://www.gatech.edu/" target="_blank">Georgia Tech</a>. During my exchange semester, I was a visiting graduate student at the <a href="http://www.cc.gatech.edu/cpl/" target="_blank">Computational Perception Laboratory</a>,
                            supervised by <a href="http://prof.irfanessa.com/" target="_blank">Prof. Irfan Essa, Ph.D.</a>, and worked on video segmentation.
                            Thereafter, I had the pleasure of working as research scientist with Dr. Stefan Holzer and Alexander Trevor, Ph.D., at <a href="http://www.fyusion.com/" target="_blank">Fyusion Inc.</a>
                            &dash; one of the most exiting startups in the field of computer vision!
                            With only the master thesis being left for finishing my master degree, I decided to complete two internships this summer.
                            First, I am spending three months at <a href="http://www.mobisparts.eu/" target="_blank">MOBIS Parts Europe N.V.</a> in Frankfurt, Germany, working as front camera intern supervised
                            by Dr. Thomas Guthier. Second, I will be spending three months as a software engineering intern at <a href="https://www.microsoft.com/de-de/" target="_blank">Microsoft Corporation</a> in Dublin, Ireland.
                        </p>
                        <p>
                            Apart from my academic career, I was early working as web developer at <a href="http://www.rs-computer.de/" target="_blank">RS Computer</a>. In particular, I was responsible for developing
                            plugins and themes for content management and shop systems such as CMSimple, Wordpress and xtCommerce. Furthermore,
                            I had the opportunity to conceptually design and implement several web applications for medium-sized companies.
                        </p>
                        <p>
                            I am a big fan of open source. Therefore, you can find most of my work &dash; both regarding computer
                            vision and machine learning as well as web development &dash; at <a href="https://github.com/davidstutz" target="_blank">GitHub</a>.
                        </p>
                    </div>
                </div>

                <h2><?php echo __('UPDATES', 'iamdavidstutz'); ?></h2>
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
