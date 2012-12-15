<div class="postbox">
    <div class="handlediv"></div>
    <h3 class="hndle"><?php _e('Slideshow', 'slider_pro'); ?></h3>
    <div class="inside">
        <input type="hidden" class="panel-state" name="panels_state[slideshow]" value="<?php echo sp_get_panels_state($slider, 'slideshow'); ?>"/>
        
            <label title="slideshow"><?php _e('Enabled', 'slider_pro'); ?></label>
            <input name="slider_settings[slideshow]" type="hidden" value="0"/>
            <input name="slider_settings[slideshow]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'slideshow') == true ? 'checked="checked"' : ''; ?> />
            
            <label title="slideshow_delay"><?php _e('Delay', 'slider_pro'); ?></label>
            <input name="slider_settings[slideshow_delay]" type="text"  value="<?php echo sp_get_setting($slider, 'slideshow_delay'); ?>" />
            
            <label title="slideshow_direction"><?php _e('Direction', 'slider_pro'); ?></label>
            <select name="slider_settings[slideshow_direction]">
                <?php 
                    $list = sp_get_settings_list('slideshow_direction');
                    foreach ($list as $entry) {
                        $selected = sp_get_setting($slider, 'slideshow_direction') == $entry ? 'selected="selected"' : "";
                        echo "<option $selected>$entry</option>";
                    }
                ?>
            </select>
            
            <div class="spacediv"></div>
           
            <label title="pause_slideshow_on_hover"><?php _e('Pause On Hover', 'slider_pro'); ?></label>
            <input name="slider_settings[pause_slideshow_on_hover]" type="hidden" value="0"/>
            <input name="slider_settings[pause_slideshow_on_hover]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'pause_slideshow_on_hover') == true ? 'checked="checked"' : ''; ?>/>
                        
            <label title="slideshow_controls"><?php _e('Show Controls', 'slider_pro'); ?></label>
            <input name="slider_settings[slideshow_controls]" type="hidden" value="0"/>
            <input name="slider_settings[slideshow_controls]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'slideshow_controls') == true ? 'checked="checked"' : ''; ?>/>
                        
            <label title="fade_slideshow_controls"><?php _e('Fade', 'slider_pro'); ?></label>
            <input name="slider_settings[fade_slideshow_controls]" type="hidden" value="0"/>
            <input name="slider_settings[fade_slideshow_controls]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'fade_slideshow_controls') == true ? 'checked="checked"' : ''; ?>/>
            
            <div class="spacediv"></div>
            
            <label title="slideshow_controls_hide_duration"><?php _e('Hide Duration', 'slider_pro'); ?></label>
            <input name="slider_settings[slideshow_controls_hide_duration]" type="text" value="<?php echo sp_get_setting($slider, 'slideshow_controls_hide_duration'); ?>"/>
                        
            <label title="slideshow_controls_show_duration"><?php _e('Show Duration', 'slider_pro'); ?></label>
            <input name="slider_settings[slideshow_controls_show_duration]" type="text" value="<?php echo sp_get_setting($slider, 'slideshow_controls_show_duration'); ?>"/>
            
    </div>
</div>