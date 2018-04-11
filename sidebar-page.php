<div class="sidebar">
    <div class="sidebar-search">
        <h5>
            <span class="sidebar-lead"><?php echo __('SEARCH', 'iamdavidstutz'); ?></span><span class="visible-lg-inline visible-sm-inline visible-xs-inline"><?php echo __('THEBLOG', 'iamdavidstutz'); ?></span>
        </h5>
        <?php get_search_form(); ?>
    </div>
    <hr class="hidden-lg hidden-md">
    <div class="sidebar-header">
        <h4><?php echo __('ARCHIVES', 'iamdavidstutz'); ?></h4>
        <h4 style="margin-left:30%;"><?php echo __('TAGS', 'TAGS'); ?></h4>
    </div>
    <div class="sidebar-archives">
        <?php echo iamdavidstutz_get_archives(); ?>
    </div>
    <div class="sidebar-tags">
        <ul class="list-unstyled">
            <?php $tags = get_tags(); ?>
            <?php foreach ($tags as $tag): ?>
                <li><a href="<?php echo get_tag_link($tag->term_id); ?>"><span class="label label-primary"><?php echo strtoupper($tag->name); ?></span></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <hr class="hidden-lg hidden-md">
</div>