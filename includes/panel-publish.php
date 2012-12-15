<div class="postbox action">
    <div class="inside">
        
        <input type="hidden" class="panel-state" name="panels_state[publish]" value="<?php echo sp_get_panels_state($slider, 'publish'); ?>"/>
        
        <input type="submit" name="submit" class="button-primary" value="<?php echo $action == 'edit' ? __('Update Slider', 'slider_pro') : __('Create Slider', 'slider_pro'); ?>"/>
        
        <?php
            if ($action == 'edit') {
                $url = wp_nonce_url(admin_url("admin.php?page=slider_pro&action=delete&id=$slider_id&name=" . sp_get_setting($slider, 'name')), 'delete-slider');
        ?> 		
                <a id="preview-slider" class="button" 
                   href="<?php echo admin_url("admin-ajax.php?action=sp_slider_preview&id=$slider_id&name=" . sp_get_setting($slider, 'name')); ?>"><?php _e('Preview Slider', 'slider_pro'); ?></a>
                   
                <a id="delete-slider" href="<?php echo $url; ?>"><?php _e('Delete Slider', 'slider_pro'); ?></a> 
        <?php
            } else {
        ?>
                <a class="button disabled" href="javascript:void(null);"><?php _e('Preview Slider', 'slider_pro'); ?></a>
        <?php		
            }
        ?>
        
    </div>
</div>