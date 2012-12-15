<div class="postbox">
	<div class="handlediv"></div>
    <h3 class="hndle"><?php _e('Thumbnails', 'slider_pro'); ?></h3>
    <div class="inside">
        <input type="hidden" class="panel-state" name="panels_state[thumbnails]" value="<?php echo sp_get_panels_state($slider, 'thumbnails'); ?>"/>
        
        <fieldset>
            <legend><?php _e('General', 'slider_pro'); ?></legend>
                        
            <label title="thumbnails_type"><?php _e('Type', 'slider_pro'); ?></label>
            <select name="slider_settings[thumbnails_type]">
                <?php 
                    $list = sp_get_settings_list('thumbnails_type');
                    foreach ($list as $entry) {
                        $selected = sp_get_setting($slider, 'thumbnails_type') == $entry ? 'selected="selected"' : "";
                        echo "<option $selected>$entry</option>";
                    }
                ?>
            </select>
            
            <label title="thumbnail_width"><?php _e('Width', 'slider_pro'); ?></label>
            <input name="slider_settings[thumbnail_width]" type="text" value="<?php echo sp_get_setting($slider, 'thumbnail_width'); ?>"/>
            
            <label title="thumbnail_height"><?php _e('Height', 'slider_pro'); ?></label>
            <input name="slider_settings[thumbnail_height]" type="text" value="<?php echo sp_get_setting($slider, 'thumbnail_height'); ?>"/>
            
        </fieldset>            
        <div class="spacediv"></div>
                        
        <fieldset>
            <legend><?php _e('Tooltip Thumbnails', 'slider_pro'); ?></legend>
                        
            <label title="thumbnail_slide_amount"><?php _e('Slide', 'slider_pro'); ?></label>
            <input name="slider_settings[thumbnail_slide_amount]" type="text" value="<?php echo sp_get_setting($slider, 'thumbnail_slide_amount'); ?>"/>
                        
            <label title="thumbnail_slide_duration"><?php _e('Duration', 'slider_pro'); ?></label>
            <input name="slider_settings[thumbnail_slide_duration]" type="text" value="<?php echo sp_get_setting($slider, 'thumbnail_slide_duration'); ?>"/>
                        
            <label title="thumbnail_slide_easing"><?php _e('Easing', 'slider_pro'); ?></label>
            <select name="slider_settings[thumbnail_slide_easing]">
                <?php 
                    $list = sp_get_settings_list('easing');
                    foreach ($list as $entry) {
                        $selected = sp_get_setting($slider, 'thumbnail_slide_easing') == $entry ? 'selected="selected"' : "";
                        echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
                    }
                ?>
            </select>
        </fieldset>
                    
        <fieldset>
            <legend><?php _e('Navigation Thumbnails', 'slider_pro'); ?></legend>
                       
            <label title="visible_thumbnails"><?php _e('Visible', 'slider_pro'); ?></label>
            <input name="slider_settings[visible_thumbnails]" type="text" value="<?php echo sp_get_setting($slider, 'visible_thumbnails'); ?>" size="1"/>
                                           
            <label title="thumbnail_orientation"><?php _e('Orientation', 'slider_pro'); ?></label>
            <select name="slider_settings[thumbnail_orientation]">
                <?php 
                    $list = sp_get_settings_list('thumbnail_orientation');
                        foreach ($list as $entry) {
                            $selected = sp_get_setting($slider, 'thumbnail_orientation') == $entry ? 'selected="selected"' : "";
                            echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
                        }
                ?>
            </select>
                                    
            <label title="thumbnail_sync"><?php _e('Syncing', 'slider_pro'); ?></label>
            <input name="slider_settings[thumbnail_sync]" type="hidden" value="0"/>
            <input name="slider_settings[thumbnail_sync]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'thumbnail_sync') == true ? 'checked="checked"' : ''; ?>/>
                                    
            <label title="navigation_thumbnails_center"><?php _e('Center', 'slider_pro'); ?></label>
            <input name="slider_settings[navigation_thumbnails_center]" type="hidden" value="0"/>
            <input name="slider_settings[navigation_thumbnails_center]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'navigation_thumbnails_center') == true ? 'checked="checked"' : ''; ?> />
                                    
            <div class="spacediv"></div>
                                           
            <label title="fade_navigation_thumbnails"><?php _e('Fade', 'slider_pro'); ?></label>
            <input name="slider_settings[fade_navigation_thumbnails]" type="hidden" value="0"/>
            <input name="slider_settings[fade_navigation_thumbnails]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'fade_navigation_thumbnails') == true ? 'checked="checked"' : '';?>/>
                                           
            <label title="navigation_thumbnails_hide_duration"><?php _e('Hide Duration', 'slider_pro'); ?></label>
            <input name="slider_settings[navigation_thumbnails_hide_duration]" type="text" value="<?php echo sp_get_setting($slider, 'navigation_thumbnails_hide_duration'); ?>"/>
                                    
            <label title="navigation_thumbnails_show_duration"><?php _e('Show Duration', 'slider_pro'); ?></label>
            <input name="slider_settings[navigation_thumbnails_show_duration]" type="text" value="<?php echo sp_get_setting($slider, 'navigation_thumbnails_show_duration'); ?>"/>
        </fieldset>
                    
        <fieldset>
            <legend><?php _e('Scrolling', 'slider_pro'); ?></legend>
                        
            <label title="thumbnail_scroll_duration"><?php _e('Duration', 'slider_pro'); ?></label>
            <input name="slider_settings[thumbnail_scroll_duration]" type="text" value="<?php echo sp_get_setting($slider, 'thumbnail_scroll_duration'); ?>"/>
                        
            <label title="thumbnail_scroll_easing"><?php _e('Easing', 'slider_pro'); ?></label>
            <select name="slider_settings[thumbnail_scroll_easing]">
                <?php 
                    $list = sp_get_settings_list('easing');
                    foreach ($list as $entry) {
                        $selected = sp_get_setting($slider, 'thumbnail_scroll_easing') == $entry ? 'selected="selected"' : "";
                        echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
                    }
                ?>
            </select>
        </fieldset>
                    
        <fieldset>
            <legend><?php _e('Arrows', 'slider_pro'); ?></legend>
                        
            <table>
                <tr>
                    <td>
                        <label title="thumbnail_arrows"><?php _e('Show', 'slider_pro'); ?></label>
                        <input name="slider_settings[thumbnail_arrows]" type="hidden" value="0"/>
                        <input name="slider_settings[thumbnail_arrows]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'thumbnail_arrows') == true ? 'checked="checked"' : ''; ?>/>
                                    
                        <label title="fade_thumbnail_arrows"><?php _e('Fade', 'slider_pro'); ?></label>
                        <input name="slider_settings[fade_thumbnail_arrows]" type="hidden" value="0"/>
                        <input name="slider_settings[fade_thumbnail_arrows]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'fade_thumbnail_arrows') == true ? 'checked="checked"' : ''; ?>/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label title="thumbnail_arrows_hide_duration"><?php _e('Hide Duration', 'slider_pro'); ?></label>
                        <input name="slider_settings[thumbnail_arrows_hide_duration]" type="text" value="<?php echo sp_get_setting($slider, 'thumbnail_arrows_hide_duration'); ?>"/>
                    </td>
                    <td>
                        <label title="thumbnail_arrows_show_duration"><?php _e('Show Duration', 'slider_pro'); ?></label>
                    </td>
                    <td>
                        <input name="slider_settings[thumbnail_arrows_show_duration]" type="text" value="<?php echo sp_get_setting($slider, 'thumbnail_arrows_show_duration'); ?>"/>
                    </td>
                </tr>
            </table>
                    
        </fieldset>
                    
        <fieldset>                            
            <legend><?php _e('Buttons', 'slider_pro'); ?></legend>
                        
            <table>
                <tr>
                    <td>
                        <label title="thumbnail_buttons"><?php _e('Show', 'slider_pro'); ?></label>
                        <input name="slider_settings[thumbnail_buttons]" type="hidden" value="0"/>
                        <input name="slider_settings[thumbnail_buttons]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'thumbnail_buttons') == true ? 'checked="checked"' : ''; ?>/>
                                    
                        <label title="fade_thumbnail_buttons"><?php _e('Fade', 'slider_pro'); ?></label>
                        <input name="slider_settings[fade_thumbnail_buttons]" type="hidden" value="0"/>
                        <input name="slider_settings[fade_thumbnail_buttons]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'fade_thumbnail_buttons') == true ? 'checked="checked"' : ''; ?>/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label title="thumbnail_buttons_hide_duration"><?php _e('Hide Duration', 'slider_pro'); ?></label>
                        <input name="slider_settings[thumbnail_buttons_hide_duration]" type="text" value="<?php echo sp_get_setting($slider, 'thumbnail_buttons_hide_duration'); ?>"/>
                    </td>
                    <td>
                        <label title="thumbnail_buttons_show_duration"><?php _e('Show Duration', 'slider_pro'); ?></label>
                    </td>
                    <td>
                        <input name="slider_settings[thumbnail_buttons_show_duration]" type="text" value="<?php echo sp_get_setting($slider, 'thumbnail_buttons_show_duration'); ?>"/>
                    </td>
                </tr>
            </table>

        </fieldset>
                    
        <fieldset>
            <legend><?php _e('Scrollbar', 'slider_pro'); ?></legend>                          
            
            <label title="scrollbar_skin"><?php _e('Skin', 'slider_pro'); ?></label>
            <select name="slider_settings[scrollbar_skin]">
                <?php								
                    global $sp_scrollbar_skins;
                        
                    $skin_class = sp_get_setting($slider, 'scrollbar_skin') ?  sp_get_setting($slider, 'scrollbar_skin') : 'scrollbar-1';
                        
                    foreach ($sp_scrollbar_skins as $skin) {                        
                        $selected = $skin['Class'] == $skin_class ? 'selected="selected"' : '';
                        echo "<option value=\"" . $skin['Class'] . "\" $selected>" . $skin['Skin Name'] . "</option>";
                    }
                ?>
            </select>
            
            <div class="spacediv"></div>
                       
            <table>
                <tr>
                    <td>
                        <label title="thumbnail_scrollbar"><?php _e('Show', 'slider_pro'); ?></label>
                    </td>
                    <td>
                        <input name="slider_settings[thumbnail_scrollbar]" type="hidden" value="0"/>
                        <input name="slider_settings[thumbnail_scrollbar]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'thumbnail_scrollbar') == true ? 'checked="checked"' : ''; ?>/>
                    </td>
                    <td>
                        <label title="thumbnail_scrollbar_ease"><?php _e('Scrolling Speed', 'slider_pro'); ?></label>
                    </td>
                    <td>
                        <input name="slider_settings[thumbnail_scrollbar_ease]" type="text" value="<?php echo sp_get_setting($slider, 'thumbnail_scrollbar_ease'); ?>"/>
                    </td>
                    <td>
                        <label title="scrollbar_arrow_scroll_amount"><?php _e('Arrow Scroll', 'slider_pro'); ?></label>
                    </td>
                    <td>
                        <input name="slider_settings[scrollbar_arrow_scroll_amount]" type="text" value="<?php echo sp_get_setting($slider, 'scrollbar_arrow_scroll_amount'); ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label title="fade_thumbnail_scrollbar"><?php _e('Fade', 'slider_pro'); ?></label>
                    </td>
                    <td>
                        <input name="slider_settings[fade_thumbnail_scrollbar]" type="hidden" value="0"/>
                        <input name="slider_settings[fade_thumbnail_scrollbar]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'fade_thumbnail_scrollbar')==true ? 'checked="checked"':''; ?>/>
                    </td>
                    <td>
                        <label title="thumbnail_scrollbar_show_duration"><?php _e('Show Duration', 'slider_pro'); ?></label>
                    </td>
                    <td>
                        <input name="slider_settings[thumbnail_scrollbar_show_duration]" type="text" value="<?php echo sp_get_setting($slider, 'thumbnail_scrollbar_show_duration'); ?>"/>
                    </td>
                    <td>
                        <label title="thumbnail_scrollbar_hide_duration"><?php _e('Hide Duration', 'slider_pro'); ?></label>
                    </td>
                    <td>
                        <input name="slider_settings[thumbnail_scrollbar_hide_duration]" type="text" value="<?php echo sp_get_setting($slider, 'thumbnail_scrollbar_hide_duration'); ?>"/>
                    </td>
                </tr>
            </table>
        </fieldset>
            
        <fieldset>
            <legend><?php _e('Mouse Scroll', 'slider_pro'); ?></legend>
            
            <label title="thumbnail_mouse_scroll"><?php _e('Enabled', 'slider_pro'); ?></label>
            <input name="slider_settings[thumbnail_mouse_scroll]" type="hidden" value="0"/>
            <input name="slider_settings[thumbnail_mouse_scroll]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'thumbnail_mouse_scroll') == true ? 'checked="checked"' : ''; ?>/>
            
            <label title="thumbnail_mouse_scroll_speed"><?php _e('Speed', 'slider_pro'); ?></label>
            <input name="slider_settings[thumbnail_mouse_scroll_speed]" type="text" value="<?php echo sp_get_setting($slider, 'thumbnail_mouse_scroll_speed'); ?>"/>
            
            <label title="thumbnail_mouse_scroll_ease"><?php _e('Ease', 'slider_pro'); ?></label>
            <input name="slider_settings[thumbnail_mouse_scroll_ease]" type="text" value="<?php echo sp_get_setting($slider, 'thumbnail_mouse_scroll_ease'); ?>"/>
        </fieldset>
       
        <fieldset>
            <legend><?php _e('Mouse Wheel', 'slider_pro'); ?></legend>
            
            <label title="thumbnail_mouse_wheel"><?php _e('Enabled', 'slider_pro'); ?></label>
            <input name="slider_settings[thumbnail_mouse_wheel]" type="hidden" value="0"/>
            <input name="slider_settings[thumbnail_mouse_wheel]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'thumbnail_mouse_wheel') == true ? 'checked="checked"' : ''; ?>/>
            
            <label title="thumbnail_mouse_wheel_speed"><?php _e('Speed', 'slider_pro'); ?></label>
            <input name="slider_settings[thumbnail_mouse_wheel_speed]" type="text" value="<?php echo sp_get_setting($slider, 'thumbnail_mouse_wheel_speed'); ?>"/>
            
            <label title="thumbnail_mouse_wheel_reverse"><?php _e('Reverse', 'slider_pro'); ?></label>
            <input name="slider_settings[thumbnail_mouse_wheel_reverse]" type="hidden" value="0"/>
            <input name="slider_settings[thumbnail_mouse_wheel_reverse]" type="checkbox"  
                   value="1" <?php echo sp_get_setting($slider, 'thumbnail_mouse_wheel_reverse') == true ? 'checked="checked"' : ''; ?>/>
        </fieldset>
        
        <fieldset>
            <legend><?php _e('Caption', 'slider_pro'); ?></legend>
            
            <table>
                <tr>
                    <td>
                        <label title="hide_thumbnail_caption"><?php _e('Show/Hide', 'slider_pro'); ?></label>
                    </td>
                    <td>
                        <input name="slider_settings[hide_thumbnail_caption]" type="hidden" value="0"/>
                        <input name="slider_settings[hide_thumbnail_caption]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'hide_thumbnail_caption') == true ? 'checked="checked"' : ''; ?>/>
                    </td>
                    <td>
                        <label title="thumbnail_caption_position"><?php _e('Position', 'slider_pro'); ?></label>
                    </td>
                    <td>
                        <select name="slider_settings[thumbnail_caption_position]">
                            <?php 
                                $list = sp_get_settings_list('thumbnail_caption_position');
                                foreach ($list as $entry) {
                                    $selected = sp_get_setting($slider, 'thumbnail_caption_position') == $entry ? 'selected="selected"' : "";
                                    echo "<option $selected>$entry</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label title="thumbnail_caption_show_duration"><?php _e('Show Duration', 'slider_pro'); ?></label>
                    </td>
                    <td>
                        <input name="slider_settings[thumbnail_caption_show_duration]" type="text" value="<?php echo sp_get_setting($slider, 'thumbnail_caption_show_duration'); ?>"/>
                    </td>
                    <td>
                        <label title="thumbnail_caption_effect"><?php _e('Effect', 'slider_pro'); ?></label>
                    </td>
                    <td>
                        <select name="slider_settings[thumbnail_caption_effect]">
                            <?php 
                                $list = sp_get_settings_list('thumbnail_caption_effect');
                                foreach ($list as $entry) {
                                    $selected = sp_get_setting($slider, 'thumbnail_caption_effect') == $entry ? 'selected="selected"' : "";
                                    echo "<option $selected>$entry</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label title="thumbnail_caption_hide_duration"><?php _e('Hide Duration', 'slider_pro'); ?></label>
                    </td>
                    <td>
                        <input name="slider_settings[thumbnail_caption_hide_duration]" type="text" value="<?php echo sp_get_setting($slider, 'thumbnail_caption_hide_duration'); ?>"/>
                    </td>
                    <td>
                        <label title="thumbnail_caption_easing"><?php _e('Easing', 'slider_pro'); ?></label>
                    </td>
                    <td>
                        <select name="slider_settings[thumbnail_caption_easing]">
                            <?php 
                                $list = sp_get_settings_list('easing');
                                foreach ($list as $entry) {
                                    $selected = sp_get_setting($slider, 'thumbnail_caption_easing') == $entry ? 'selected="selected"' : "";
                                    echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>                                                        
        </fieldset>
        
        <fieldset>
            <legend><?php _e('Tooltip', 'slider_pro'); ?></legend>
            
            <label title="thumbnail_tooltip"><?php _e('Enable', 'slider_pro'); ?></label>
            <input name="slider_settings[thumbnail_tooltip]" type="hidden" value="0"/>
            <input name="slider_settings[thumbnail_tooltip]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'thumbnail_tooltip') == true ? 'checked="checked"' : ''; ?>/>
            
            <label title="tooltip_show_duration"><?php _e('Show Duration', 'slider_pro'); ?></label>
            <input name="slider_settings[tooltip_show_duration]" type="text" value="<?php echo sp_get_setting($slider, 'tooltip_show_duration'); ?>"/>
            
            <label title="tooltip_hide_duration"><?php _e('Hide Duration', 'slider_pro'); ?></label>
            <input name="slider_settings[tooltip_hide_duration]" type="text" value="<?php echo sp_get_setting($slider, 'tooltip_hide_duration'); ?>"/>
        </fieldset>        
	</div>
</div>