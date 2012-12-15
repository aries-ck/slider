<div class="postbox">
	<div class="handlediv"></div>
    <h3 class="hndle"><?php _e('Slide Navigation Controls', 'slider_pro'); ?></h3>
    <div class="inside">
    	<input type="hidden" class="panel-state" name="panels_state[slide_navigation_controls]" value="<?php echo sp_get_panels_state($slider, 'slide_navigation_controls'); ?>"/>
                        
		<fieldset>                            
        	<legend><?php _e('Arrows', 'slider_pro'); ?></legend>
                        	
            <label title="navigation_arrows"><?php _e('Show Arrows', 'slider_pro'); ?></label>
            <input name="slider_settings[navigation_arrows]" type="hidden" value="0"/>
            <input name="slider_settings[navigation_arrows]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'navigation_arrows') == true ? 'checked="checked"' : ''; ?>/>
            
            <label title="navigation_arrows_show_duration"><?php _e('Show Duration', 'slider_pro'); ?></label>
            <input name="slider_settings[navigation_arrows_show_duration]" type="text" value="<?php echo sp_get_setting($slider, 'navigation_arrows_show_duration'); ?>"/>
            
            <div class="spacediv"></div>
            
            <label title="fade_navigation_arrows"><?php _e('Fade Arrows', 'slider_pro'); ?></label>
            <input name="slider_settings[fade_navigation_arrows]" type="hidden" value="0"/>
            <input name="slider_settings[fade_navigation_arrows]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'fade_navigation_arrows') == true ? 'checked="checked"' : ''; ?>/>
                            
            <label title="navigation_arrows_hide_duration"><?php _e('Hide Duration', 'slider_pro'); ?></label>
            <input name="slider_settings[navigation_arrows_hide_duration]" type="text" value="<?php echo sp_get_setting($slider, 'navigation_arrows_hide_duration'); ?>"/>
		</fieldset>

		<div class="spacediv"></div>

		<fieldset>                            
        	<legend><?php _e('Buttons', 'slider_pro'); ?></legend>
                                       
            <label title="navigation_buttons"><?php _e('Show', 'slider_pro'); ?></label>
            <input name="slider_settings[navigation_buttons]" type="hidden" value="0"/>
            <input name="slider_settings[navigation_buttons]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'navigation_buttons') == true ? 'checked="checked"' : ''; ?>/>            
            
            <label title="navigation_buttons_numbers"><?php _e('Number', 'slider_pro'); ?></label>
            <input name="slider_settings[navigation_buttons_numbers]" type="hidden" value="0"/>
            <input name="slider_settings[navigation_buttons_numbers]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'navigation_buttons_numbers') == true ? 'checked="checked"' : ''; ?>/>
            
            <label title="navigation_buttons_center"><?php _e('Center', 'slider_pro'); ?></label>
            <input name="slider_settings[navigation_buttons_center]" type="hidden" value="0"/>
            <input name="slider_settings[navigation_buttons_center]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'navigation_buttons_center') == true ? 'checked="checked"' : ''; ?>/>
           
            <label title="navigation_buttons_container_center"><?php _e('Container Center', 'slider_pro'); ?></label>
            <input name="slider_settings[navigation_buttons_container_center]" type="hidden" value="0"/>
            <input name="slider_settings[navigation_buttons_container_center]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'navigation_buttons_container_center') == true ? 'checked="checked"' : ''; ?>/>
            
            <div class="spacediv"></div>
            
            <label title="fade_navigation_buttons"><?php _e('Fade', 'slider_pro'); ?></label>
            <input name="slider_settings[fade_navigation_buttons]" type="hidden" value="0"/>
            <input name="slider_settings[fade_navigation_buttons]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'fade_navigation_buttons') == true ? 'checked="checked"' : ''; ?>/>
            
            <label title="navigation_buttons_show_duration"><?php _e('Show Duration', 'slider_pro'); ?></label>
            <input name="slider_settings[navigation_buttons_show_duration]" type="text" value="<?php echo sp_get_setting($slider, 'navigation_buttons_show_duration'); ?>"/>
            
            <label title="navigation_buttons_hide_duration"><?php _e('Hide Duration', 'slider_pro'); ?></label>
            <input name="slider_settings[navigation_buttons_hide_duration]" type="text" value="<?php echo sp_get_setting($slider, 'navigation_buttons_hide_duration'); ?>"/>
            
		</fieldset>
                    
	</div>
</div>