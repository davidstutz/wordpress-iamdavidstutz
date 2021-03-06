<div class="sidebar">
    <?php if (get_field('donate')): ?>
        <div class="sidebar-donate well well-sm">
            <h5>
            <span class="sidebar-lead"><?php echo __('SUPPORT', 'iamdavidstutz'); ?></span><?php echo __('THIS', 'iamdavidstutz'); ?>
            </h5>
            <div class="text-center">
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="V95Q7QK6JY32Q">
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
                </form>
            </div>
            <span class="pull-left small text-muted"><i class="fa fa-paypal"></i>&nbsp;<?php echo __('PayPal', 'iamdavidstutz'); ?></span>
            <a href="http://davidstutz.de/donate/" class="small pull-right"><?php echo __('Why Donate?', 'iamdavidstutz'); ?></a>
            <div class="clearfix"></div>
        </div>
    <?php endif; ?>
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