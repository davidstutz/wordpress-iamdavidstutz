<div class="sidebar">
    <hr class="hidden-lg hidden-md">
    <div class="sidebar-donate well well-sm">
        <h5>
        <span class="sidebar-lead"><?php echo __('SUPPORT', 'iamdavidstutz'); ?></span><?php echo __('ME', 'iamdavidstutz'); ?>
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
    <hr class="hidden-lg hidden-md">
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
</div>