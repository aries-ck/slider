<div class="postbox">
    <div class="handlediv"></div>
    <h3 class="hndle"><?php _e('Transition Effects', 'slider_pro'); ?></h3>
    <div class="inside">
        <input type="hidden" class="panel-state" name="panels_state[transition_effects]" value="<?php echo sp_get_panels_state($slider, 'transition_effects'); ?>"/>
        
        <fieldset>
            <legend><?php _e('General', 'slider_pro'); ?></legend>
            
            <label title="effect_type"><?php _e('Type', 'slider_pro'); ?></label>
            <select name="slider_settings[effect_type]">
                <?php 
                    $list = sp_get_settings_list('effect_type');
                    foreach ($list as $entry) {
                        $selected = sp_get_setting($slider, 'effect_type') == $entry ? 'selected="selected"' : "";
                        echo "<option $selected>$entry</option>";
                    }
                ?>
            </select>
            
            <label title="override_transition"><?php _e('Override Transition', 'slider_pro'); ?></label>
            <input name="slider_settings[override_transition]" type="hidden" value="0"/>
            <input name="slider_settings[override_transition]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'override_transition') == true ? 'checked="checked"' : ''; ?>/>
            
            <label title="html_during_transition"><?php _e('HTML', 'slider_pro'); ?></label>
            <input name="slider_settings[html_during_transition]" type="hidden" value="0"/>
            <input name="slider_settings[html_during_transition]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'html_during_transition') == true ? 'checked="checked"' : ''; ?>/>
        </fieldset>
        
        <fieldset>
            <legend><?php _e('Previous Slide', 'slider_pro'); ?></legend>                            
            <label title="fade_previous_slide"><?php _e('Fade Out', 'slider_pro'); ?></label>
            <input name="slider_settings[fade_previous_slide]" type="hidden" value="0"/>
            <input name="slider_settings[fade_previous_slide]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'fade_previous_slide') == true ? 'checked="checked"' : ''; ?>/>
            
            <label title="fade_previous_slide_duration"><?php _e('Fade Out Duration', 'slider_pro'); ?></label>
            <input name="slider_settings[fade_previous_slide_duration]" type="text" value="<?php echo sp_get_setting($slider, 'fade_previous_slide_duration'); ?>"/>
        </fieldset>
        
        <fieldset>
            <legend><?php _e('Slice General Settings', 'slider_pro'); ?></legend>
            
            <table>
            <tr>
                <td>
                    <label title="horizontal_slices"><?php _e('Horizontal', 'slider_pro'); ?></label>
                </td>
                <td>
                    <input name="slider_settings[horizontal_slices]" type="text" value="<?php echo sp_get_setting($slider, 'horizontal_slices'); ?>"/>
                </td>
            
                <td>
                    <label title="vertical_slices"><?php _e('Vertical', 'slider_pro'); ?></label>
                </td>
                <td>
                    <input name="slider_settings[vertical_slices]" type="text" value="<?php echo sp_get_setting($slider, 'vertical_slices'); ?>"/>
                </td>
                <td>
                    <label title="slice_point"><?php _e('Point', 'slider_pro'); ?></label>
                </td>
                <td>
                    <select name="slider_settings[slice_point]">
                        <?php 
                            $list = sp_get_settings_list('slice_point');
                            foreach ($list as $entry) {
                                $selected = sp_get_setting($slider, 'slice_point') == $entry ? 'selected="selected"' : "";
                                echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
                            }
                        ?>
                    </select>
                </td>
               
            </tr>
            
            <tr>
                <td>
                    <label title="slice_duration"><?php _e('Duration', 'slider_pro'); ?></label>
                </td>
                <td>
                    <input name="slider_settings[slice_duration]" type="text" value="<?php echo sp_get_setting($slider, 'slice_duration'); ?>"/>
                </td>
                <td>
                    <label title="slice_delay"><?php _e('Delay', 'slider_pro'); ?></label>
                </td>
                <td>
                    <input name="slider_settings[slice_delay]" type="text" value="<?php echo sp_get_setting($slider, 'slice_delay'); ?>"/>
                </td>
                <td>
                    <label title="slice_fade"><?php _e('Fade', 'slider_pro'); ?></label>
                </td>
                <td>
                    <input name="slider_settings[slice_fade]" type="hidden" value="0"/>
                    <input name="slider_settings[slice_fade]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'slice_fade') == true ? 'checked="checked"' : ''; ?>/>
                </td>
            </tr>
        </table>
        
                    <label title="slice_pattern"><?php _e('Pattern', 'slider_pro'); ?></label>
                    <select name="slider_settings[slice_pattern]">
                        <?php 
                            $list = sp_get_settings_list('slice_pattern');
                            foreach ($list as $entry) {
                                $selected = sp_get_setting($slider, 'slice_pattern') == $entry ? 'selected="selected"' : "";
                                echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
                            }
                        ?>
                    </select>                 
                    <label title="slice_easing"><?php _e('Easing', 'slider_pro'); ?></label>
                    <select name="slider_settings[slice_easing]">
                        <?php 
                            $list = sp_get_settings_list('easing');
                            foreach ($list as $entry) {
                                $selected = sp_get_setting($slider, 'slice_easing') == $entry ? 'selected="selected"' : "";
                                echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
                            }
                        ?>
                    </select>
           
        </fieldset>
        
        <fieldset>
            <legend><?php _e('Slide Effect Settings', 'slider_pro'); ?></legend>
            
            <label title="slide_start_position"><?php _e('Start Position', 'slider_pro'); ?></label>
            <select name="slider_settings[slide_start_position]">
                <?php 
                    $list = sp_get_settings_list('slide_start_position');
                    foreach ($list as $entry) {
                        $selected = sp_get_setting($slider, 'slide_start_position') == $entry ? 'selected="selected"' : "";
                        echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
                    }
                ?>
            </select>
            
            <label title="slide_start_ratio"><?php _e('Start Ratio', 'slider_pro'); ?></label>
            <input name="slider_settings[slide_start_ratio]" type="text" value="<?php echo sp_get_setting($slider, 'slide_start_ratio'); ?>"/>
            
            <label title="slide_mask"><?php _e('Mask', 'slider_pro'); ?></label>
            <input name="slider_settings[slide_mask]" type="hidden" value="0"/>
            <input name="slider_settings[slide_mask]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'slide_mask') == true ? 'checked="checked"' : ''; ?>/>
            
        </fieldset>
        
        <fieldset>
            <legend><?php _e('Simple Slide Effect Settings', 'slider_pro'); ?></legend>
            
            <label title="simple_slide_direction"><?php _e('Direction', 'slider_pro'); ?></label>
            <select name="slider_settings[simple_slide_direction]">
                <?php 
                    $list = sp_get_settings_list('simple_slide_direction');
                    foreach ($list as $entry) {
                        $selected = sp_get_setting($slider, 'simple_slide_direction') == $entry ? 'selected="selected"' : "";
                        echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
                    }
                ?>
            </select>
            
            <label title="simple_slide_easing"><?php _e('Easing', 'slider_pro'); ?></label>
            <select name="slider_settings[simple_slide_easing]">
                <?php 
                    $list = sp_get_settings_list('easing');
                    foreach ($list as $entry) {
                        $selected = sp_get_setting($slider, 'simple_slide_easing') == $entry ? 'selected="selected"' : "";
                        echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
                    }
                ?>
            </select>
            
            <div class="spacediv"></div>
            
            <label title="simple_slide_duration"><?php _e('Duration', 'slider_pro'); ?></label>
            <input name="slider_settings[simple_slide_duration]" type="text" value="<?php echo sp_get_setting($slider, 'simple_slide_duration'); ?>"/>                            
            
        </fieldset>
    </div>
</div>