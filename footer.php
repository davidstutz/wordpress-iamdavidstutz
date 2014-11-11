            <hr>
            <div class="footer">
                <div class="row">
                    <div class="col-md-4">
                        <div class="text-muted">
                            <small>
                                <?php echo __('COPYRIGHT', 'iamdavidstutz'); ?><b><?php echo __('DAVIDSTUTZ', 'iamdavidstutz'); ?></b><br>
                                <span class="hidden-xs-inline hidden-sm-inline"><?php echo __('POWEREDBY', 'iamdavidstutz'); ?><a target="_blank" href="http://wordpress.org/"><?php echo __('WORDPRESS', 'iamdavidstutz'); ?></a><br></span>
                                <span class="hidden-xs-inline hidden-sm-inline"><?php echo __('SUPPORTEDBY', 'iamdavidstutz'); ?><a target="_blank" href="http://rs-computer.de"><?php echo __('RSCOMPUTER', 'iamdavidstutz'); ?></span></a>
                            </small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted">
                            <small>
                                <b><?php echo __('DAVIDSTUTZ', 'iamdavidstutz'); ?></b><?php echo __('ON', 'iamdavidstutz'); ?><a target="_blank" href="https://twitter.com/david_stutz"><?php echo __('TWITTER', 'iamdavidstutz'); ?></a><br>
                                <b><?php echo __('DAVIDSTUTZ', 'iamdavidstutz'); ?></b><?php echo __('ON', 'iamdavidstutz'); ?><a target="_blank" href="https://github.com/davidstutz"><?php echo __('GITHUB', 'iamdavidstutz'); ?></a><br>
                            </small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <small>
                            <?php wp_nav_menu(array(
                                'menu' => 'footer',
                                'menu_class' => '',
                                'theme_location' => 'footer',
                                'container' => FALSE,
                                'depth' => 1,
                                'items_wrap' => '%3$s',
                                'walker' => new IAMDAVIDSTUTZ_Footer_Walker(),
                            )); ?>
                        </small>
                    </div>
                </div>
            </div>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>
