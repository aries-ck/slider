<div class="postbox">
	<div class="handlediv"></div>
	<h3 class="hndle"><?php _e('Timer Animation', 'slider_pro'); ?></h3>
	<div class="inside">
		<input type="hidden" class="panel-state" name="panels_state[timer_animation]" value="<?php echo sp_get_panels_state($slider, 'timer_animation'); ?>"/>
                        
		<fieldset>
			<legend><?php _e('General', 'slider_pro'); ?></legend>
                            
            <label title="timer_animation"><?php _e('Enabled', 'slider_pro'); ?></label>
            <input name="slider_settings[timer_animation]" type="hidden" value="0"/>
            <input name="slider_settings[timer_animation]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'timer_animation') == true ? 'checked="checked"' : ''; ?>/>
                                   
            <label title="fade_timer"><?php _e('Fade', 'slider_pro'); ?></label>
           	<input name="slider_settings[fade_timer]" type="hidden" value="0"/>
            <input name="slider_settings[fade_timer]" type="checkbox" value="1" <?php echo sp_get_setting($slider, 'fade_timer') == true ? 'checked="checked"' : ''; ?>/>
                                        
            <label title="timer_fade_duration"><?php _e('Fade Duration', 'slider_pro'); ?></label>
           	<input name="slider_settings[timer_fade_duration]" type="text" value="<?php echo sp_get_setting($slider, 'timer_fade_duration'); ?>"/>
                        
		</fieldset>
                        
        <fieldset>
        	<legend><?php _e('Graphic Style', 'slider_pro'); ?></legend>                            
                                            
            <label title="timer_stroke_width1"><?php _e('Width 1', 'slider_pro'); ?></label>
            <input name="slider_settings[timer_stroke_width1]" type="text" value="<?php echo sp_get_setting($slider, 'timer_stroke_width1'); ?>"/>
                            
            <label title="timer_stroke_color1"><?php _e('Color 1', 'slider_pro'); ?></label>
            <input name="slider_settings[timer_stroke_color1]" type="hidden" value="<?php echo sp_get_setting($slider, 'timer_stroke_color1'); ?>" class="color"/>
            <input type="button" class="color-picker"/>
                            
            <label title="timer_stroke_opacity1"><?php _e('Opacity 1', 'slider_pro'); ?></label>
            <input name="slider_settings[timer_stroke_opacity1]" type="text" value="<?php echo sp_get_setting($slider, 'timer_stroke_opacity1'); ?>"/>                            
                            
            <div class="spacediv"></div>
                                        
            <label title="timer_stroke_width2"><?php _e('Width 2', 'slider_pro'); ?></label>
            <input name="slider_settings[timer_stroke_width2]" type="text" value="<?php echo sp_get_setting($slider, 'timer_stroke_width2'); ?>"/>
                                        
            <label title="timer_stroke_color2"><?php _e('Color 2', 'slider_pro'); ?></label>
            <input name="slider_settings[timer_stroke_color2]" type="hidden" value="<?php echo sp_get_setting($slider, 'timer_stroke_color2'); ?>" class="color"/>
            <input type="button" class="color-picker"/>
                                        
            <label title="timer_stroke_opacity2"><?php _e('Opacity 2', 'slider_pro'); ?></label>
            <input name="slider_settings[timer_stroke_opacity2]" type="text" value="<?php echo sp_get_setting($slider, 'timer_stroke_opacity2'); ?>"/>
                            
			<div class="spacediv"></div>

			<label title="timer_radius"><?php _e('Radius', 'slider_pro'); ?></label>
            <input name="slider_settings[timer_radius]" type="text" value="<?php echo sp_get_setting($slider, 'timer_radius'); ?>"/>
                        
		</fieldset>                                    
	</div>
</div>