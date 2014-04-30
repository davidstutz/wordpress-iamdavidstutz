<div class="sidebar">
    <div class="sidebar-search">
        <h4>
            <span class="sidebar-lead"><?php echo __('SEARCH', 'iamdavidstutz'); ?></span><?php echo __('THEBLOG', 'iamdavidstutz'); ?>
        </h4>
        <?php get_search_form(); ?>
        <h4 class="pull-right">
            <?php echo __('FOR', 'iamdavidstutz'); ?><?php echo __('INTERESTING', 'iamdavidstutz'); ?><?php echo __('STUFF', 'iamdavidstutz'); ?>
        </h4>
        <div class="clearfix"></div>
    </div>
    <div class="sidebar-header">
        <h4>ARCHIVES</h4>
        <h4 style="margin-left:30%;">TAGS</h4>
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
</div>