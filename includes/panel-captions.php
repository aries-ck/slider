 <div class="postbox">
    <div class="handlediv"></div>
    <h3 class="hndle"><?php _e('Captions', 'slider_pro'); ?></h3>
    <div class="inside">
        <input type="hidden" class="panel-state" name="panels_state[captions]" value="<?php echo sp_get_panels_state($slider, 'captions'); ?>"/>
        
        <fieldset>
            <legend><?php _e('Style', 'slider_pro'); ?></legend>
            
            <label title="caption_background_opacity"><?php _e('Background Opacity', 'slider_pro'); ?></label>
            <input name="slider_settings[caption_background_opacity]" type="text" value="<?php echo sp_get_setting($slider, 'caption_background_opacity'); ?>"/>
            
            <label title="caption_background_color"><?php _e('Background Color', 'slider_pro'); ?></label>
            <input name="slider_settings[caption_background_color]" type="hidden" value="<?php echo sp_get_setting($slider, 'caption_background_color'); ?>" class="color"/>
            <input type="button" class="color-picker"/>
            
            <div class="spacediv"></div>
            
            <label title="hide_caption"><?php _e('Show/Hide on Hover', 'slider_pro'); ?></label>
            <input name="slider_settings[hide_caption]" type="hidden" value="0"/>
            <input name="slider_settings[hide_caption]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'hide_caption') == true ? 'checked="checked"' : ''; ?>/>
            
        </fieldset>
        
        <fieldset>
            <legend><?php _e('Size & Position', 'slider_pro'); ?></legend>
            
            <table>
            <tr>
                <td>
                    <label title="caption_position"><?php _e('Position', 'slider_pro'); ?></label>
                </td>
                <td>
                    <select name="slider_settings[caption_position]">
                        <?php 
                            $list = sp_get_settings_list('caption_position');
                            foreach ($list as $entry) {
                                $selected = sp_get_setting($slider, 'caption_position') == $entry ? 'selected="selected"' : "";
                                echo "<option $selected>$entry</option>";
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <label title="caption_width"><?php _e('Width', 'slider_pro'); ?></label>
                </td>
                <td>
                    <input name="slider_settings[caption_width]" type="text" value="<?php echo sp_get_setting($slider, 'caption_width'); ?>"/>
                </td>
                <td>
                    <label title="caption_left"><?php _e('Left', 'slider_pro'); ?></label>
                </td>
                <td>
                    <input name="slider_settings[caption_left]" type="text" value="<?php echo sp_get_setting($slider, 'caption_left'); ?>"/>
                </td>
            </tr>
            
            <tr>
                <td>
                    <label title="caption_size"><?php _e('Size', 'slider_pro'); ?></label>
                </td>
                <td>
                    <input name="slider_settings[caption_size]" type="text" value="<?php echo sp_get_setting($slider, 'caption_size'); ?>"/>
                </td>
                <td>
                    <label title="caption_height"><?php _e('Height', 'slider_pro'); ?></label>
                </td>
                <td>
                    <input name="slider_settings[caption_height]" type="text" value="<?php echo sp_get_setting($slider, 'caption_height'); ?>"/>
                </td>
                <td>
                    <label title="caption_top"><?php _e('Top', 'slider_pro'); ?></label>
                </td>
                <td>
                    <input name="slider_settings[caption_top]" type="text" value="<?php echo sp_get_setting($slider, 'caption_top'); ?>"/>
                </td>
            </tr>
            
            </table>
        </fieldset>                       
            
        <fieldset>
            <legend><?php _e('Show Effect', 'slider_pro'); ?></legend>
           
            <label title="caption_show_effect"><?php _e('Effect', 'slider_pro'); ?></label>
            <select name="slider_settings[caption_show_effect]">
                <?php 
                    $list = sp_get_settings_list('caption_effect');
                    foreach ($list as $entry) {
                        $selected = sp_get_setting($slider, 'caption_show_effect') == $entry ? 'selected="selected"' : "";
                        echo "<option $selected>$entry</option>";
                    }
                ?>
            </select>                     
           
            <label title="caption_show_effect_duration"><?php _e('Duration', 'slider_pro'); ?></label>
            <input name="slider_settings[caption_show_effect_duration]" type="text" value="<?php echo sp_get_setting($slider, 'caption_show_effect_duration'); ?>"/>
           
            <label title="caption_show_effect_easing"><?php _e('Easing', 'slider_pro'); ?></label>
            <select name="slider_settings[caption_show_effect_easing]">
                <?php 
                    $list = sp_get_settings_list('easing');
                    foreach ($list as $entry) {
                        $selected = sp_get_setting($slider, 'caption_show_effect_easing') == $entry ? 'selected="selected"' : "";
                        echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
                    }
                ?>
            </select>
            
            <div class="spacediv"></div>
            
            <label title="caption_show_slide_direction"><?php _e('Slide', 'slider_pro'); ?></label>
            <select name="slider_settings[caption_show_slide_direction]">
                <?php 
                    $list = sp_get_settings_list('caption_slide_direction');
                    foreach ($list as $entry) {
                        $selected = sp_get_setting($slider, 'caption_show_slide_direction') == $entry ? 'selected="selected"' : "";
                        echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
                    }
                ?>
            </select>
        </fieldset>
       
        <fieldset>
            <legend><?php _e('Hide Effect', 'slider_pro'); ?></legend>
           
            <label title="caption_hide_effect"><?php _e('Effect', 'slider_pro'); ?></label>
            <select name="slider_settings[caption_hide_effect]">
                <?php 
                    $list = sp_get_settings_list('caption_effect');
                    foreach ($list as $entry) {
                        $selected = sp_get_setting($slider, 'caption_hide_effect') == $entry ? 'selected="selected"' : "";
                        echo "<option $selected>$entry</option>";
                    }
                ?>
            </select>                     
           
            <label title="caption_hide_effect_duration"><?php _e('Duration', 'slider_pro'); ?></label>
            <input name="slider_settings[caption_hide_effect_duration]" type="text" value="<?php echo sp_get_setting($slider, 'caption_hide_effect_duration'); ?>"/>
           
            <label title="caption_hide_effect_easing"><?php _e('Easing', 'slider_pro'); ?></label>
            <select name="slider_settings[caption_hide_effect_easing]">
                <?php 
                    $list = sp_get_settings_list('easing');
                    foreach ($list as $entry) {
                        $selected = sp_get_setting($slider, 'caption_hide_effect_easing') == $entry ? 'selected="selected"' : "";
                        echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
                    }
                ?>
            </select>
            
            <div class="spacediv"></div>
            
            <label title="caption_hide_slide_direction"><?php _e('Slide', 'slider_pro'); ?></label>
            <select name="slider_settings[caption_hide_slide_direction]">
                <?php 
                    $list = sp_get_settings_list('caption_slide_direction');
                    foreach ($list as $entry) {
                        $selected = sp_get_setting($slider, 'caption_hide_slide_direction') == $entry ? 'selected="selected"' : "";
                        echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
                    }
                ?>
            </select>
        </fieldset>
    </div>
</div>