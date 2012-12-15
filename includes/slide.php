<div class="postbox slidebox">
	<div class="handlediv" title="<?php _e('Show/Hide Slide', 'slider_pro'); ?>"></div>
    <div class="closediv" title="<?php _e('Delete Slide', 'slider_pro'); ?>"></div>
    <div class="duplicatediv" title="<?php _e('Duplicate Slide', 'slider_pro'); ?>"></div>
    
	<h3 class="hndle"><?php echo $is_slide ? $slide['name'] : __('Slide', 'slider_pro') . $counter; ?></h3>
    
    <input type="hidden" class="id" value="<?php echo $is_slide ? $slide['id'] : -1; ?>"/>
    <input type="hidden" class="name" name="slide[<?php echo $counter; ?>][name]" value="<?php echo $is_slide ? $slide['name'] : __('Slide', 'slider_pro') . $counter; ?>"/>
    <input type="hidden" class="counter" value="<?php echo $counter; ?>"/>
    <input type="hidden" class="position" name="slide[<?php echo $counter; ?>][position]" value="<?php echo $counter; ?>"/>
    <input type="hidden" class="panel-state" name="slide[<?php echo $counter; ?>][panel_state]" value="<?php echo $is_slide ? $slide['panel_state'] : 'opened'; ?>"/>
    
	<div class="inside">
        <div class="slide-tabs">
        
        	<ul>
            	<li><a href="#image-<?php echo $counter;?>"><?php _e('Image', 'slider_pro'); ?></a></li>
                <li><a href="#thumbnail-<?php echo $counter;?>"><?php _e('Thumbnail', 'slider_pro'); ?></a></li>
        		<li><a href="#caption-<?php echo $counter;?>"><?php _e('Caption', 'slider_pro'); ?></a></li>
                <li><a href="#html-<?php echo $counter;?>"><?php _e('Inline HTML', 'slider_pro'); ?></a></li>
                <li><a href="#lightbox-<?php echo $counter;?>"><?php _e('Lightbox', 'slider_pro'); ?></a></li>
                <li><a href="#settings-<?php echo $counter;?>"><?php _e('Settings', 'slider_pro'); ?></a></li>
            </ul>
            
            <div id="image-<?php echo $counter;?>" class="clearfix">
            	
                <?php
					if (sp_get_slide_content($slide_content, 'image') != "") {
						$timthumb = get_option('slider_pro_enable_timthumb') ? plugins_url('/slider-pro/includes/timthumb/timthumb.php') . '?w=155&h=95&q=100&src=' : '';
						echo '<div class="main-image preview-box">';
						echo '<img class="image" src="'. $timthumb . sp_get_slide_content($slide_content, 'image') . '"/>';
						echo '</div>';
					} else {
						echo '<div class="main-image preview-box no-image">';
						echo '</div>';
					}					
				?>
                
                
                <div class="info-input">
                    <table>
                        <tbody>
                            <tr>
                                <td><label title="image_path"><?php _e('Path', 'slider_pro'); ?></label></td>
                                <td><input name="slide[<?php echo $counter;?>][content][image]" type="text" value="<?php echo sp_get_slide_content($slide_content, 'image'); ?>" class="path"/></td>
                            </tr>
                            
                            <tr>
                                <td><label title="image_alt"><?php _e('ALT', 'slider_pro'); ?></label></td>
                                <td><input name="slide[<?php echo $counter;?>][content][alt]" type="text" value="<?php echo stripslashes(sp_get_slide_content($slide_content, 'alt')); ?>" /></td>
                            </tr>
                            
                            <tr>
                                <td><label title="image_link"><?php _e('Link', 'slider_pro'); ?></label></td>
                                <td><input name="slide[<?php echo $counter;?>][content][link]" type="text" value="<?php echo sp_get_slide_content($slide_content, 'link'); ?>" /></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="main-image-buttons">
                    	<a class="button-secondary preview-button" href="#"><?php _e('Refresh Image', 'slider_pro'); ?></a>
                        <a class="button-secondary add-button" href="<?php echo admin_url("admin-ajax.php?action=sp_open_media&show_page=1&show_date=all"); ?>"> <?php _e('Add Image', 'slider_pro'); ?></a>
                	</div>
                </div>
            </div>
            
            <div id="thumbnail-<?php echo $counter;?>" class="clearfix">
            	 <?php
					if (sp_get_slide_content($slide_content, 'thumbnail_image') != "") {
						$timthumb = get_option('slider_pro_enable_timthumb') ? plugins_url('/slider-pro/includes/timthumb/timthumb.php') . '?h=95&src=' : '';
						echo '<div class="thumbnail preview-box">';
						echo '<img class="image" src="' . $timthumb . sp_get_slide_content($slide_content, 'thumbnail_image') . '"/>';
						echo '</div>';
					} else {
						echo '<div class="thumbnail preview-box no-image">';
						echo '</div>';
					}
				?>
              	
                <div class="info-input">
                    <table>
                        <tbody>
                            <tr>
                                <td><label title="thumbnail_path"><?php _e('Path', 'slider_pro'); ?></label></td>
                                <td><input name="slide[<?php echo $counter;?>][content][thumbnail_image]" type="text" value="<?php echo sp_get_slide_content($slide_content, 'thumbnail_image'); ?>" class="path"/></td>
                            </tr>
                            
                            <tr>
                                <td><label title="thumbnail_alt"><?php _e('ALT', 'slider_pro'); ?></label></td>
                                <td><input name="slide[<?php echo $counter;?>][content][thumbnail_alt]" type="text" value="<?php echo stripslashes(sp_get_slide_content($slide_content, 'thumbnail_alt')); ?>" /></td>
                            </tr>
                            
                            <tr>
                                <td><label title="thumbnail_caption_content"><?php _e('Caption', 'slider_pro'); ?></label></td>
                                <td><input name="slide[<?php echo $counter;?>][content][thumbnail_caption]" type="text" value="<?php echo stripslashes(sp_get_slide_content($slide_content, 'thumbnail_caption')); ?>" /></td>
                            </tr>
                            
                            <tr>
                                <td><label title="thumbnail_tooltip_content"><?php _e('Tooltip', 'slider_pro'); ?></label></td>
                                <td><input name="slide[<?php echo $counter;?>][content][thumbnail_tooltip]" type="text" value="<?php echo stripslashes(sp_get_slide_content($slide_content, 'thumbnail_tooltip')); ?>" /></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="thumbnail-buttons">
                    	<a class="button-secondary preview-button" href="#"> <?php _e('Refresh Image', 'slider_pro'); ?></a>
                        <a class="button-secondary add-button" href="<?php echo admin_url("admin-ajax.php?action=sp_open_media&show_page=1&show_date=all"); ?>"> <?php _e('Add Image', 'slider_pro'); ?></a>
                	</div>
                </div>
            </div>
            
            <div id="caption-<?php echo $counter;?>">
                <textarea class="the-editor" id="caption-editor-<?php echo $counter;?>" name="slide[<?php echo $counter;?>][content][caption]">
					<?php echo html_entity_decode(stripslashes(sp_get_slide_content($slide_content, 'caption'))); ?>
            	</textarea>	
            </div>
            
            <div id="html-<?php echo $counter;?>">
            	<textarea class="the-editor" id="html-editor-<?php echo $counter;?>" name="slide[<?php echo $counter;?>][content][html]">
					<?php echo html_entity_decode(stripslashes(sp_get_slide_content($slide_content, 'html'))); ?>
            	</textarea>
            </div>
            
            <div id="lightbox-<?php echo $counter;?>">
            	<div class="info-input">
                    <table>
                        <tbody>
                            <tr>
                                <td><label title="lightbox_content"><?php _e('Content', 'slider_pro'); ?></label></td>
                                <td><input name="slide[<?php echo $counter;?>][content][lightbox_content]" type="text" value="<?php echo stripslashes(sp_get_slide_content($slide_content, 'lightbox_content')); ?>" /></td>
                            </tr>
                                
                            <tr>
                                <td><label title="lightbox_title"><?php _e('Title', 'slider_pro'); ?></label></td>
                                <td><input name="slide[<?php echo $counter;?>][content][lightbox_title]" type="text" value="<?php echo stripslashes(sp_get_slide_content($slide_content, 'lightbox_title')); ?>" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="lightbox-description">
                	<label class="lightbox-description-label" title="lightbox_description"><?php _e('Description', 'slider_pro'); ?></label>
                	<textarea class="the-editor" id="lightbox-editor-<?php echo $counter;?>" name="slide[<?php echo $counter;?>][content][lightbox_description]">
						<?php echo html_entity_decode(stripslashes(sp_get_slide_content($slide_content, 'lightbox_description'))); ?>
                    </textarea>
            	</div>
            </div>
            
            <div id="settings-<?php echo $counter;?>">
            	
                <div class="slide-tabs slide-tabs-settings">
        
                    <ul>
                        <li><a href="#slide-settings-effect-<?php echo $counter;?>"><?php _e('Effect', 'slider_pro'); ?></a></li>
                        <li><a href="#slide-settings-caption-<?php echo $counter;?>"><?php _e('Caption', 'slider_pro'); ?></a></li>
                        <li><a href="#slide-settings-lightbox-<?php echo $counter;?>"><?php _e('Lightbox', 'slider_pro'); ?></a></li>
                        <li><a href="#slide-settings-other-<?php echo $counter;?>"><?php _e('Other', 'slider_pro'); ?></a></li>
                    </ul>
                    
                    <div id="slide-settings-effect-<?php echo $counter;?>">
                    	<label title="effect_type"><?php _e('Effect Type', 'slider_pro'); ?>
                            <input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][effect_type_override]" 
                            	   value="<?php echo sp_get_slide_setting($slide_settings, 'effect_type_override'); ?>"/>
                        </label>
                                                
                        <select name="slide[<?php echo $counter;?>][settings][effect_type]">
                                <?php 
									$list = sp_get_settings_list('effect_type');
									foreach ($list as $entry) {
										$selected = sp_get_slide_setting($slide_settings, 'effect_type') == $entry ? 'selected="selected"' : '';
										echo "<option $selected>" . $entry . "</option>";
									}
								?>
                        </select>
                        
                        
                        <label title="html_during_transition"><?php _e('Show HTML', 'slider_pro'); ?>
                            <input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][html_during_transition_override]" 
                            	   value="<?php echo sp_get_slide_setting($slide_settings, 'html_during_transition_override'); ?>"/>
                        </label>
                        
                        <input name="slide[<?php echo $counter;?>][settings][html_during_transition]" type="hidden" value="0"/>
                        <input name="slide[<?php echo $counter;?>][settings][html_during_transition]" type="checkbox" value="1" 
							   <?php echo sp_get_slide_setting($slide_settings, 'html_during_transition') == true ? 'checked="checked"' : ''; ?> />
            
                        <div class="spacediv"></div>
                        
                        <fieldset>
                            <legend><?php _e('Slice General Settings', 'slider_pro'); ?></legend>
                            
                            <table>
                                <tr>
                                    <td>
                                        <label title="horizontal_slices"><?php _e('Horizontal', 'slider_pro'); ?>
                                            <input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][horizontal_slices_override]" 
                                                   value="<?php echo sp_get_slide_setting($slide_settings, 'horizontal_slices_override'); ?>"/>
                                        </label>
                                    </td>
                                    <td>
                                        <input name="slide[<?php echo $counter;?>][settings][horizontal_slices]" type="text" 
                                               value="<?php echo sp_get_slide_setting($slide_settings, 'horizontal_slices'); ?>"/>
                                    </td>
                                    <td>
                                        <label title="vertical_slices"><?php _e('Vertical', 'slider_pro'); ?>
                                            <input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][vertical_slices_override]" 
                                                   value="<?php echo sp_get_slide_setting($slide_settings, 'vertical_slices_override'); ?>"/>
                                        </label>
                                    </td>
                                    <td>
                                        <input name="slide[<?php echo $counter;?>][settings][vertical_slices]" type="text" 
                                               value="<?php echo sp_get_slide_setting($slide_settings, 'vertical_slices'); ?>"/>
                                    </td>
                                    <td>
                                        <label title="slice_pattern"><?php _e('Pattern', 'slider_pro'); ?>
                                            <input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][slice_pattern_override]" 
                                                   value="<?php echo sp_get_slide_setting($slide_settings, 'slice_pattern_override'); ?>"/>
                                        </label>
                                    </td>
                                    <td>
                                        <select name="slide[<?php echo $counter;?>][settings][slice_pattern]">
                                            <?php 
                                                $list = sp_get_settings_list('slice_pattern');
                                                foreach ($list as $entry) {
                                                    $selected = sp_get_slide_setting($slide_settings, 'slice_pattern') == $entry ? 'selected="selected"' : '';
                                                    echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <label title="slice_fade"><?php _e('Fade', 'slider_pro'); ?>
                                            <input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][slice_fade_override]" 
                                                   value="<?php echo sp_get_slide_setting($slide_settings, 'slice_fade_override'); ?>"/>
                                        </label>
                                    </td>
                                    <td>
                                        <input name="slide[<?php echo $counter;?>][settings][slice_fade]" type="hidden" value="0"/>
                                        <input name="slide[<?php echo $counter;?>][settings][slice_fade]" type="checkbox" value="1" 
											   <?php echo sp_get_slide_setting($slide_settings, 'slice_fade') == true ? 'checked="checked"' : ''; ?> />
                                    </td>
                                </tr>
                            
                            	<tr>
                                    <td>
                                        <label title="slice_duration"><?php _e('Duration', 'slider_pro'); ?>
                                            <input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][slice_duration_override]" 
                                                   value="<?php echo sp_get_slide_setting($slide_settings, 'slice_duration_override'); ?>"/>
                                        </label>
                                    </td>
                                    <td>
                                        <input name="slide[<?php echo $counter;?>][settings][slice_duration]" type="text" 
                                                value="<?php echo sp_get_slide_setting($slide_settings, 'slice_duration'); ?>"/>
                                    </td>
                                    <td>                            
                                        <label title="slice_delay"><?php _e('Delay', 'slider_pro'); ?>
                                            <input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][slice_delay_override]" 
                                                   value="<?php echo sp_get_slide_setting($slide_settings, 'slice_delay_override'); ?>"/>
                                        </label>
                                    </td>
                                    <td>
                                        <input name="slide[<?php echo $counter;?>][settings][slice_delay]" type="text" 
                                                value="<?php echo sp_get_slide_setting($slide_settings, 'slice_delay'); ?>"/>
                                         </td>
                                    <td>
                                        <label title="slice_easing"><?php _e('Easing', 'slider_pro'); ?>
                                            <input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][slice_easing_override]" 
                                                   value="<?php echo sp_get_slide_setting($slide_settings, 'slice_easing_override'); ?>"/>
                                        </label>
                            		</td>
                                    <td>
                                        <select name="slide[<?php echo $counter;?>][settings][slice_easing]">
                                            <?php 
                                                $list = sp_get_settings_list('easing');
                                                foreach ($list as $entry) {
                                                    $selected = sp_get_slide_setting($slide_settings, 'slice_easing') == $entry ? 'selected="selected"' : '';
                                                    echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
                                                }
                                            ?>
                                        </select>                            
                            		</td>
                                    <td>
                                        <label title="slice_point"><?php _e('Point', 'slider_pro'); ?>
                                             <input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][slice_point_override]" 
                                                    value="<?php echo sp_get_slide_setting($slide_settings, 'slice_point_override'); ?>"/>
                                        </label>
                            		</td>
                                    <td>
                                        <select name="slide[<?php echo $counter;?>][settings][slice_point]">
                                            <?php 
                                                $list = sp_get_settings_list('slice_point');
                                                foreach ($list as $entry) {
                                                    $selected = sp_get_slide_setting($slide_settings, 'slice_point') == $entry ? 'selected="selected"' : '';
                                                    echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                            	</tr>
                            </table>
                        </fieldset>
                        
                        <fieldset>
                            <legend><?php _e('Slide Effect Settings', 'slider_pro'); ?></legend>
                            
                            <label title="slide_start_position"><?php _e('Start Position', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][slide_start_position_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'slide_start_position_override'); ?>"/>
                            </label>
                            
                            <select name="slide[<?php echo $counter;?>][settings][slide_start_position]">
                            	<?php 
									$list = sp_get_settings_list('slide_start_position');
									foreach ($list as $entry) {
										$selected = sp_get_slide_setting($slide_settings, 'slide_start_position') == $entry ? 'selected="selected"' : '';
										echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
									}
								?>
                            </select>
                            
                            <label title="slide_start_ratio"><?php _e('Start Ratio', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][slide_start_ratio_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'slide_start_ratio_override'); ?>"/>
                            </label>
                            
                            <input name="slide[<?php echo $counter;?>][settings][slide_start_ratio]" type="text" 
                            value="<?php echo sp_get_slide_setting($slide_settings, 'slide_start_ratio'); ?>"/>
                            
                            <label title="slide_mask"><?php _e('Mask', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][slide_mask_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'slide_mask_override'); ?>"/>
                            </label>   
                            
                            <input name="slide[<?php echo $counter;?>][settings][slide_mask]" type="hidden" value="0"/>
                            <input name="slide[<?php echo $counter;?>][settings][slide_mask]" type="checkbox" value="1" 
								   <?php echo sp_get_slide_setting($slide_settings, 'slide_mask') == true ? 'checked="checked"' : ''; ?>/>
                        </fieldset>
                        
                        <fieldset>
                            <legend><?php _e('Simple Slide Effect Settings', 'slider_pro'); ?></legend>
                            
                            <label title="simple_slide_direction"><?php _e('Direction', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][simple_slide_direction_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'simple_slide_direction_override'); ?>"/>
                            </label>
                            
                            <select name="slide[<?php echo $counter;?>][settings][simple_slide_direction]">
                            	<?php 
									$list = sp_get_settings_list('simple_slide_direction');
									foreach ($list as $entry) {
										$selected = sp_get_slide_setting($slide_settings, 'simple_slide_direction') == $entry ? 'selected="selected"' : '';
										echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
									}
								?>
                            </select>
                            
                            <label title="simple_slide_easing"><?php _e('Easing', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][simple_slide_easing_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'simple_slide_easing_override'); ?>"/>
                            </label>
                            
                            <select name="slide[<?php echo $counter;?>][settings][simple_slide_easing]">
                            	<?php 
									$list = sp_get_settings_list('easing');
									foreach ($list as $entry) {
										$selected = sp_get_slide_setting($slide_settings, 'simple_slide_easing') == $entry ? 'selected="selected"' : '';
										echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
									}
								?>
                           	</select>
                            
                            <label title="simple_slide_duration"><?php _e('Duration', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][simple_slide_duration_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'simple_slide_duration_override'); ?>"/>
                            </label>
                            
                            <input name="slide[<?php echo $counter;?>][settings][simple_slide_duration]" type="text" 
                            	   value="<?php echo sp_get_slide_setting($slide_settings, 'simple_slide_duration'); ?>"/>
                        </fieldset>
                        
                        <fieldset>
                            <legend><?php _e('Fade Previous Slide', 'slider_pro'); ?></legend>
                            
                            <label title="fade_previous_slide"><?php _e('Fade Previous Slide', 'slider_pro'); ?>
                            <input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][fade_previous_slide_override]" 
                            	   value="<?php echo sp_get_slide_setting($slide_settings, 'fade_previous_slide_override'); ?>"/>
                            </label>
                            <input name="slide[<?php echo $counter;?>][fade_previous_slide]" type="hidden" value="0"/>
                            <input name="slide[<?php echo $counter;?>][fade_previous_slide]" type="checkbox" value="1" 
                                   <?php echo sp_get_slide_setting($slide_settings, 'fade_previous_slide') == true ? 'checked="checked"' : ''; ?>/>
                            
                            
                            <label title="fade_previous_slide_duration"><?php _e('Fade Previous Slide Duration', 'slider_pro'); ?>
                                <input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][fade_previous_slide_duration_override]" 
                                       value="<?php echo sp_get_slide_setting($slide_settings, 'fade_previous_slide_duration_override'); ?>"/>
                            </label>
                            <input name="slide[<?php echo $counter;?>][fade_previous_slide_duration]" type="text" 
                                   value="<?php echo sp_get_slide_setting($slide_settings, 'fade_previous_slide_duration'); ?>"/>
                        </fieldset>
                    </div>
                    
                    <div id="slide-settings-caption-<?php echo $counter;?>">
                    	<fieldset>
                            <legend><?php _e('Style', 'slider_pro'); ?></legend>
                            
                            <label title="caption_background_opacity"><?php _e('Background Opacity', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][caption_background_opacity_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_background_opacity_override'); ?>"/>
                            </label>
                            
                            <input name="slide[<?php echo $counter;?>][settings][caption_background_opacity]" type="text" 
                           		   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_background_opacity'); ?>"/>
                           
                            <label title="caption_background_color"><?php _e('Background Color', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][caption_background_color_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_background_color_override'); ?>"/>
                            </label>
                            
                            <input name="slide[<?php echo $counter;?>][settings][caption_background_color]" type="hidden" 
                            	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_background_color'); ?>" class="color"/>
                                    
                            <input type="button" class="color-picker"/>
                        </fieldset>
                        
                        <fieldset>
                            <legend><?php _e('Show Effect', 'slider_pro'); ?></legend>
                            
                            <label title="caption_show_effect"><?php _e('Effect', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][caption_show_effect_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_show_effect_override'); ?>"/>
                            </label>
                            
                            <select name="slide[<?php echo $counter;?>][settings][caption_show_effect]">
                            	<?php 
									$list = sp_get_settings_list('caption_effect');
									foreach ($list as $entry) {
										$selected = sp_get_slide_setting($slide_settings, 'caption_show_effect') == $entry ? 'selected="selected"' : '';
										echo "<option $selected>" . $entry . "</option>";
									}
								?>
                            </select>
                            
                            <label title="caption_show_slide_direction"><?php _e('Slide Direction', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][caption_show_slide_direction_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_show_slide_direction_override'); ?>"/>
                            </label> 
                               
                            <select name="slide[<?php echo $counter;?>][settings][caption_show_slide_direction]">
                            	<?php 
									$list = sp_get_settings_list('caption_slide_direction');
									foreach ($list as $entry) {
										$selected = sp_get_slide_setting($slide_settings, 'caption_show_slide_direction') == $entry ? 'selected="selected"' : '';
										echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
									}
								?>
                            </select>
                            
                            <label title="caption_show_effect_duration"><?php _e('Duration', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][caption_show_effect_duration_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_show_effect_duration_override'); ?>"/>
                            </label>
                            
                            <input name="slide[<?php echo $counter;?>][settings][caption_show_effect_duration]" type="text" 
                            	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_show_effect_duration'); ?>"/>
                            
                            <label title="caption_show_effect_easing"><?php _e('Easing', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][caption_show_effect_easing_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_show_effect_easing_override'); ?>"/>
                            </label>
                            
                            <select name="slide[<?php echo $counter;?>][settings][caption_show_effect_easing]">
                            	<?php 
									$list = sp_get_settings_list('easing');
									foreach ($list as $entry) {
										$selected = sp_get_slide_setting($slide_settings, 'caption_show_effect_easing') == $entry ? 'selected="selected"' : '';
										echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
									}
								?>
                        	</select>                            
                        </fieldset>
                        
                        <fieldset>
                            <legend><?php _e('Hide Effect', 'slider_pro'); ?></legend>
                            
                            <label title="caption_hide_effect"><?php _e('Effect', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][caption_hide_effect_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_hide_effect_override'); ?>"/>
                            </label>
                            
                            <select name="slide[<?php echo $counter;?>][settings][caption_hide_effect]">
                            	<?php 
									$list = sp_get_settings_list('caption_effect');
									foreach ($list as $entry) {
										$selected = sp_get_slide_setting($slide_settings, 'caption_hide_effect') == $entry ?  'selected="selected"' : '';
										echo "<option $selected>$entry</option>";
									}
								?>
                            </select>
                            
                            <label title="caption_hide_slide_direction"><?php _e('Slide Direction', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][caption_hide_slide_direction_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_hide_slide_direction_override'); ?>"/>
                            </label>
                            
                            <select name="slide[<?php echo $counter;?>][settings][caption_hide_slide_direction]">
                            	<?php 
									$list = sp_get_settings_list('caption_slide_direction');
									foreach ($list as $entry) {
										$selected = sp_get_slide_setting($slide_settings, 'caption_hide_slide_direction') == $entry ? 'selected="selected"' : '';
										echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
									}
								?>
                            </select>
                            
                            <label title="caption_hide_effect_duration"><?php _e('Duration', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][caption_hide_effect_duration_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_hide_effect_duration_override'); ?>"/>
                            </label>
                            
                            <input name="slide[<?php echo $counter;?>][settings][caption_hide_effect_duration]" type="text" 
                            value="<?php echo sp_get_slide_setting($slide_settings, 'caption_hide_effect_duration'); ?>"/>
                            
                            <label title="caption_hide_effect_easing"><?php _e('Easing', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][caption_hide_effect_easing_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_hide_effect_easing_override'); ?>"/>
                            </label>
                            
                            <select name="slide[<?php echo $counter;?>][settings][caption_hide_effect_easing]">
                            	<?php 
									$list = sp_get_settings_list('easing');
									foreach ($list as $entry) {
										$selected = sp_get_slide_setting($slide_settings, 'caption_hide_effect_easing') == $entry ? 'selected="selected"' : '';
										echo "<option value=\"$entry\" $selected>" . sp_get_settings_shortname($entry) . "</option>";
									}
								?>
                            </select>                            
                        </fieldset>
                        
                        <fieldset>
                            <legend><?php _e('Size & Position', 'slider_pro'); ?></legend>
                            
                            <label title="caption_position"><?php _e('Position', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][caption_position_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_position_override'); ?>"/>
                            </label>
                            
                            <select name="slide[<?php echo $counter;?>][settings][caption_position]">
                            	<?php 
                                	$list = sp_get_settings_list('caption_position');
                                	foreach ($list as $entry) {
                                    	$selected = sp_get_slide_setting($slide_settings, 'caption_position') == $entry ? 'selected="selected"' : '';
                                        echo "<option $selected>" . $entry . "</option>";
                                    }
                                ?>
                            </select>
                            
                            <label title="caption_size"><?php _e('Size', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][caption_size_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_size_override'); ?>"/>
                            </label>
                            
                            <input name="slide[<?php echo $counter;?>][settings][caption_size]" type="text" 
                            	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_size'); ?>"/>
                            
                            <label title="caption_width"><?php _e('Width', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][caption_width_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_width_override'); ?>"/>
                            </label>
                            
                            <input name="slide[<?php echo $counter;?>][settings][caption_width]" type="text" 
                            	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_width'); ?>"/>
                            
                            <label title="caption_height"><?php _e('Height', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][caption_height_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_height_override'); ?>"/>
                            </label>
                            
                            <input name="slide[<?php echo $counter;?>][settings][caption_height]" type="text" 
                            	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_height'); ?>"/>
                            
                            <label title="caption_left"><?php _e('Left', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][caption_left_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_left_override'); ?>"/>
                            </label>
                            
                            <input name="slide[<?php echo $counter;?>][settings][caption_left]" type="text" 
                            	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_left'); ?>"/>
                            
                            <label title="caption_top"><?php _e('Top', 'slider_pro'); ?>
                            	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][caption_top_override]" 
                                	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_top_override'); ?>"/>
                            </label>
                            
                            <input name="slide[<?php echo $counter;?>][settings][caption_top]" type="text" 
                            	   value="<?php echo sp_get_slide_setting($slide_settings, 'caption_top'); ?>"/>
                        </fieldset>
                    </div>
                    
                    <div id="slide-settings-lightbox-<?php echo $counter;?>">
                    	<label title="lightbox_default_width"><?php _e('Width', 'slider_pro'); ?>
                        	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][lightbox_default_width_override]" 
                            	   value="<?php echo sp_get_slide_setting($slide_settings, 'lightbox_default_width_override'); ?>"/>
                        </label>
                        
                        <input name="slide[<?php echo $counter;?>][settings][lightbox_default_width]" type="text"  
                        	   value="<?php echo sp_get_slide_setting($slide_settings, 'lightbox_default_width'); ?>"/>
                                
                                
                        <label title="lightbox_default_height"><?php _e('Height', 'slider_pro'); ?>
                        	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][lightbox_default_height_override]" 
                            	   value="<?php echo sp_get_slide_setting($slide_settings, 'lightbox_default_height_override'); ?>"/>
                        </label>
                        
                        <input name="slide[<?php echo $counter;?>][settings][lightbox_default_height]" type="text"  
                        	   value="<?php echo sp_get_slide_setting($slide_settings, 'lightbox_default_height'); ?>"/>
                                
                                
                        <label title="lightbox_theme"><?php _e('Theme', 'slider_pro'); ?>
                        	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][lightbox_theme_override]" 
                            	   value="<?php echo sp_get_slide_setting($slide_settings, 'lightbox_theme_override'); ?>"/>
                        </label>
                        
                        <select name="slide[<?php echo $counter;?>][settings][lightbox_theme]">
                        	<?php 
								$list = sp_get_settings_list('lightbox_theme');
								foreach ($list as $entry) {
									$selected = sp_get_slide_setting($slide_settings, 'lightbox_theme') == $entry ? 'selected="selected"' : '';
									echo "<option $selected>" . $entry . "</option>";
								}
							?>
                        </select>
                        
                        
                        <label title="lightbox_opacity"><?php _e('Opacity', 'slider_pro'); ?>
                        	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][lightbox_opacity_override]" 
                            	   value="<?php echo sp_get_slide_setting($slide_settings, 'lightbox_opacity_override'); ?>"/>
                        </label>
                        
                        <input name="slide[<?php echo $counter;?>][settings][lightbox_opacity]" type="text"  
                        	   value="<?php echo sp_get_slide_setting($slide_settings, 'lightbox_opacity'); ?>"/>
                   	</div>
                    
                    <div id="slide-settings-other-<?php echo $counter;?>">
                    	<label title="slideshow_delay"><?php _e('Slideshow Delay', 'slider_pro'); ?>
                        	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][slideshow_delay_override]" 
                            	   value="<?php echo sp_get_slide_setting($slide_settings, 'slideshow_delay_override'); ?>"/>
                        </label>                        
                        
                    	<input name="slide[<?php echo $counter;?>][settings][slideshow_delay]" type="text"  
                        	   value="<?php echo sp_get_slide_setting($slide_settings, 'slideshow_delay'); ?>"/>
                        
                        <label title="align_type"><?php _e('Align', 'slider_pro'); ?>
                        	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][align_type_override]" 
                            	   value="<?php echo sp_get_slide_setting($slide_settings, 'align_type_override'); ?>"/>
                        </label>
                        
                        <select name="slide[<?php echo $counter;?>][settings][align_type]">
                        	<?php 
								$list = sp_get_settings_list('align_type');
								foreach ($list as $entry) {
									$selected = sp_get_slide_setting($slide_settings, 'align_type') == $entry ? 'selected="selected"' : '';
									echo "<option $selected>" . $entry . "</option>";
								}
							?>
                        </select>
                        
                        <label title="link_target"><?php _e('Link Target', 'slider_pro'); ?>
                        	<input class="override" type="hidden" name="slide[<?php echo $counter;?>][settings][link_target_override]" 
                            	   value="<?php echo sp_get_slide_setting($slide_settings, 'link_target_override'); ?>"/>
                        </label>
                        
                        <select name="slide[<?php echo $counter;?>][settings][link_target]">
                           	<?php 
                            	$list = sp_get_settings_list('link_target');
                                	foreach ($list as $entry) {
                                	$selected = sp_get_slide_setting($slide_settings, 'link_target') == $entry ? 'selected="selected"' : '';
                                    echo "<option $selected>" . $entry . "</option>";
                             	}
                            ?>
                        </select>
                   	</div>
                    
                </div>
                
            </div>
            
        </div>
    </div>
    
</div>