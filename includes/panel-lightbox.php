<div class="postbox">
    <div class="handlediv"></div>
    <h3 class="hndle"><?php _e('Lightbox', 'slider_pro'); ?></h3>
    <div class="inside">
        <input type="hidden" class="panel-state" name="panels_state[lightbox]" value="<?php echo sp_get_panels_state($slider, 'lightbox'); ?>"/>
        
        <label title="lightbox"><?php _e('Enabled', 'slider_pro'); ?></label>
        <input name="slider_settings[lightbox]" type="hidden" value="0"/>
        <input name="slider_settings[lightbox]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'lightbox') == true ? 'checked="checked"' : ''; ?> />
        
        <label title="lightbox_navigation"><?php _e('Navigation', 'slider_pro'); ?></label>
        <input name="slider_settings[lightbox_navigation]" type="hidden" value="0"/>
        <input name="slider_settings[lightbox_navigation]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'lightbox_navigation') == true ? 'checked="checked"' : ''; ?> />
        
        <label title="lightbox_theme"><?php _e('Theme', 'slider_pro'); ?></label>
        <select name="slider_settings[lightbox_theme]">
            <?php 
                $list = sp_get_settings_list('lightbox_theme');
                foreach ($list as $entry) {
                    $selected = sp_get_setting($slider, 'lightbox_theme') == $entry ? 'selected="selected"' : '';
                    echo "<option $selected>" . $entry . "</option>";
                }
            ?>
        </select>        
        
        <div class="spacediv"></div>        
        
        <label title="lightbox_default_width"><?php _e('Width', 'slider_pro'); ?></label>
        <input name="slider_settings[lightbox_default_width]" type="text" value="<?php echo sp_get_setting($slider, 'lightbox_default_width'); ?>"/>
        
        <label title="lightbox_default_height"><?php _e('Height', 'slider_pro'); ?></label>
        <input name="slider_settings[lightbox_default_height]" type="text" value="<?php echo sp_get_setting($slider, 'lightbox_default_height'); ?>"/>
        
        <label title="lightbox_opacity"><?php _e('Opacity', 'slider_pro'); ?></label>
        <input name="slider_settings[lightbox_opacity]" type="text" value="<?php echo sp_get_setting($slider, 'lightbox_opacity'); ?>"/>
            
    </div>
</div>