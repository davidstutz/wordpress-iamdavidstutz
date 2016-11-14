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
                    <h2><?php echo __('PROFILE', 'iamdavidstutz'); ?></h2>

                    <p>
                        I am a master student at <a href="https://www.rwth-aachen.de/" target="_blank">
                            RWTH Aachen University
                        </a> interested in computer vision and machine learning.
                        In my <a href="http://davidstutz.de/projects/superpixelsseeds/">
                            bachelor thesis
                        </a>, advised by <a href="http://www.vision.rwth-aachen.de/person/1/" target="_blank">
                            Prof. Bastian Leibe
                        </a>, I researched the use of depth information for superpixel segmentation and supervised by. 
                        Some of the results have been published at <a href="http://gcpr2015.rwth-aachen.de/" target="_blank">
                            GCPR 2015
                        </a>. Afterwards, I spent a semester at the
                        <a href="http://www.cc.gatech.edu/cpl/" target="_blank">
                            Computational Perception Laboratory
                        </a> at <a href="http://www.gatech.edu/" target="_blank">
                            Georgia Tech
                        </a> working in the group of <a href="http://prof.irfanessa.com/" target="_blank">
                            Prof. Essa
                        </a> on video segmentation and intrinsic video.
                        During the last two semesters of my master degree, 
                        I hard the opportunity to work for <a href="http://www.fyusion.com/" target="_blank">
                            Fyusion Inc.
                        </a> on interesting computer vision and machine learning problems.
                        Before writing my master thesis in the beginning of next year, I am
                        currently completing two internships. First at <a href="https://en.mobis.co.kr/" target="_blank">
                            MOBIS
                        </a> in Frankfurt, advised by Dr. Thomas Guthier, as front camera intern working
                        on deep learning for autonomous driving. Second, at <a href="https://www.microsoft.com/en-us/" target="_blank">
                            Microsoft
                        </a> in Dublin as software engineering intern.
                    </p>

                    <p>
                        As big fan of open source, I am eager to share insights and source code. On this blog you will
                        find seminar papers, notes on readings as well as short articles.
                        You can find big portions of my projects at <a href="https://github.com/davidstutz" target="_blank">
                            GitHub
                        </a>.
                    </p>

                    <h3><?php echo __('LOOKINGFOR', 'iamdavidstutz'); ?></h3>

                    <p>
                        I am open for internships and consulting in areas including computer vision, machine learning and 
                        autonomous driving. Additionally, I am looking for challenging PhD programs in these areas starting in 2017.
                    </p>

                    <h3><?php echo __('MORE...', 'iamdavidstutz'); ?></h3>

                    <p>
                        The statement of motivation submitted as part of my application for an exchange semester 
                        at <a href="http://www.gatech.edu/" target="_blank">
                            Georgia Tech
                        </a> can be found here: <a href="http://davidstutz.de/wordpress/wp-content/uploads/2016/09/Motivation_Georgia_Tech.pdf">
                            PDF
                        </a>. A detailed CV (in german) written for the <a href="http://www.studienstiftung.de/en/" target="_blank">
                            German Academic Scholarship Foundation
                        </a> is available here: <a href="http://davidstutz.de/wordpress/wp-content/uploads/2016/09/Curriculum_Vitae_German_Scholarship_Foundation.pdf">
                            PDF
                        </a>. Also find me on <a href="https://www.linkedin.com/in/davidstutz92" target="_blank">
                            LinkedIn
                        </a>, <a href="https://www.xing.com/profile/David_Stutz5" target="_blank">
                            Xing
                        </a> and <a href="https://github.com/davidstutz" target="_blank">
                            GitHub
                        </a>.
                    </p>

                    <div class="author-updates">
                        <h3><?php echo __('UPDATES', 'iamdavidstutz'); ?></h3>

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
