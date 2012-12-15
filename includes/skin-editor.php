<div class="wrap slider-pro">
	<div class="slider-icon"></div>
	<h2><?php _e('Skin Editor', 'slider_pro'); ?></h2>
    
    <form name="skin_editor" method="post" action="">
    <?php wp_nonce_field('skin-editor-update', 'skin-editor-nonce'); ?>
            
        <textarea name="skin_content" class="skin_content"><?php echo stripslashes($skin_content); ?></textarea>        
        
        <div class="skin_editor_sidebar">
        
            <label><?php _e('Select a skin to edit', 'slider_pro'); ?>
                <select name="skin_selector" onchange="this.form.submit();">
                <?php
                    global $sp_all_skins;
					
                    foreach ($sp_all_skins as $skin) {                        
                        if ($skin['Class'] == $current_skin)
                            $selected = "selected=\"selected\"";
						else
                            $selected = '';	
                        
                        echo "<option value=\"" . $skin['Class'] ."\" $selected >" . $skin['Skin Name'] . "</option>";
                    }
                ?>
                </select>
            </label>
            
            <div class="skin_meta">
            	<p><span><?php _e('Skin Name:', 'slider_pro'); ?></span>  <?php echo $skin_name; ?></p>
                <p><span><?php _e('Skin Author:', 'slider_pro'); ?></span>  <?php echo $skin_author; ?></p>
                <p><span><?php _e('Skin Description:', 'slider_pro'); ?></span>  <?php echo $skin_description; ?></p>
                <p><span><?php _e('Skin Class:', 'slider_pro'); ?></span>  <?php echo $current_skin; ?></p>
            </div>
            
            <input type="submit" name="update_skin" class="button-primary" value="Update Skin"/>
            
        </div> 
        
    </form>
</div>