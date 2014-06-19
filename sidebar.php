<div class="sidebar">
    <div class="sidebar-search">
        <h5>
            <span class="sidebar-lead"><?php echo __('SEARCH', 'iamdavidstutz'); ?></span><span class="visible-lg-inline visible-sm-inline visible-xs-inline"><?php echo __('THEBLOG', 'iamdavidstutz'); ?></span>
        </h5>
        <?php get_search_form(); ?>
        <h5 class="pull-right">
            <?php echo __('FOR', 'iamdavidstutz'); ?><span class="visible-lg-inline visible-sm-inline visible-xs-inline hidden-md-inline"><?php echo __('INTERESTING', 'iamdavidstutz'); ?></span><span class="hidden-xs-inline hidden-sm-inline visible-md-inline hidden-lg-inline"><?php echo __('COOL', 'iamdavidstutz'); ?></span><?php echo __('STUFF', 'iamdavidstutz'); ?>
        </h5>
        <div class="clearfix"></div>
    </div>
    <div class="sidebar-twitter">
        <a class="twitter-timeline" href="https://twitter.com/david_stutz" data-widget-id="478636565548118016">Tweets von @david_stutz</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
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