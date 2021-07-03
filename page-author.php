<?php
/*  
Template Name: Author
*/ 
?>
<?php get_header(); ?>

    <div class="author">
        <?php
            global $wp_query;
            $user = $wp_query->get_queried_object();
        ?>

        <div class="author-biography">
            <?php $page = get_page_by_path('profile'); ?>
            <?php echo do_shortcode($page->post_content); ?>
        </div>
    </div>

<?php get_footer(); ?>
