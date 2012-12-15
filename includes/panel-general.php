<div class="postbox">
    <div class="handlediv"></div>
    <h3 class="hndle"><?php _e('General', 'slider_pro'); ?></h3>
    <div class="inside">
        <input type="hidden" class="panel-state" name="panels_state[general]" value="<?php echo sp_get_panels_state($slider, 'general'); ?>"/>
        
        <fieldset>
            <legend><?php _e('Style', 'slider_pro'); ?></legend>            
            	
                <label title="width"><?php _e('Width', 'slider_pro'); ?></label>
                <input name="slider_settings[width]" type="text" value="<?php echo sp_get_setting($slider, 'width'); ?>" />
                
                <label title="height"><?php _e('Height', 'slider_pro'); ?></label>
                <input name="slider_settings[height]" type="text" value="<?php echo sp_get_setting($slider, 'height'); ?>" />
                
                <label title="align_type"><?php _e('Align', 'slider_pro'); ?></label>
                <select name="slider_settings[align_type]">
                    <?php 
                        $list = sp_get_settings_list('align_type');
                        foreach ($list as $entry) {
                            $selected = sp_get_setting($slider, 'align_type') == $entry ? 'selected="selected"' : "";
                            echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
                        }
                    ?>
                </select>
                
                <label title="shadow"><?php _e('Shadow', 'slider_pro'); ?></label>
                <input name="slider_settings[shadow]" type="hidden" value="0"/>
                <input name="slider_settings[shadow]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'shadow') == true ? 'checked="checked"' : ''; ?>/>
                
               	<div class="spacediv"></div>
                
                <label title="skin"><?php _e('Skin', 'slider_pro'); ?></label>
                <select name="slider_settings[skin]">
                    <?php								
                        global $sp_main_skins;
                            
                        $skin_class = sp_get_setting($slider, 'skin') ?  sp_get_setting($slider, 'skin') : 'pixel';
                            
                        foreach ($sp_main_skins as $skin) {                        
                            $selected = $skin['Class'] == $skin_class ? 'selected="selected"' : '';
                            echo "<option value=\"" . $skin['Class'] . "\" $selected>" . $skin['Skin Name'] . "</option>";
                        }
                    ?>
                </select>
                
                <label title="include_skin"><?php _e('Include Skin', 'slider_pro'); ?></label>
                <input name="include_skin" type="hidden" value="0"/>
                <input name="include_skin" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'include_skin') == true ? 'checked="checked"' : ''; ?>/>
                
                
        </fieldset>
        
        <fieldset>
            <legend><?php _e('Slides', 'slider_pro'); ?></legend>
            
            <label title="slide_start"><?php _e('Slide Start', 'slider_pro'); ?></label>
            <input name="slider_settings[slide_start]" type="text" value="<?php echo sp_get_setting($slider, 'slide_start'); ?>"/>
            
            <label title="link_target"><?php _e('Link Target', 'slider_pro'); ?></label>
            <select name="slider_settings[link_target]">
                <?php 
                    $list = sp_get_settings_list('link_target');
                    foreach ($list as $entry) {
                        $selected = sp_get_setting($slider, 'link_target') == $entry ? 'selected="selected"' : "";
                        echo "<option $selected>$entry</option>";
                    }
                ?>
            </select>
            
            <label title="shuffle"><?php _e('Shuffle', 'slider_pro'); ?></label>
            <input name="slider_settings[shuffle]" type="hidden" value="0"/>
            <input name="slider_settings[shuffle]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'shuffle') == true ? 'checked="checked"' : ''; ?>/>                            
            
            <div class="spacediv"></div>
            
            <label title="slides_preloaded"><?php _e('Preloaded', 'slider_pro'); ?></label>
            <input name="slider_settings[slides_preloaded]" type="text" value="<?php echo sp_get_setting($slider, 'slides_preloaded'); ?>"/>
            
            <label title="skip_broken"><?php _e('Skip Broken', 'slider_pro'); ?></label>
            <input name="slider_settings[skip_broken]" type="hidden" value="0"/>
            <input name="slider_settings[skip_broken]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'skip_broken') == true ? 'checked="checked"' : ''; ?>/>
            
        </fieldset>
    </div>
</div>  