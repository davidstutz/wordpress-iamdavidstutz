<form method="get" action="<?php echo home_url( '/' ); ?>">
    <div class="input-group">
        <span class="input-group-addon"><span class="elusive icon-search"></span></span>
        <input type="text" name="s" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><?php echo __('SEARCH', 'iamdavidstutz'); ?></button>
        </span>
    </div>
</form>