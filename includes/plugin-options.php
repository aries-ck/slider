<div class="wrap slider-pro">
	<div class="slider-icon"></div>
	<h2><?php _e('Plugin Options', 'slider_pro'); ?></h2>
    
    <form class="plugin-options" name="plugin_options" method="post" action="">
    <?php wp_nonce_field('plugin-options-update', 'plugin-options-nonce'); ?>
    	
        <div class="option">
        	<input type="checkbox" name="slider_pro_enable_timthumb" value="1" <?php echo get_option('slider_pro_enable_timthumb') == 1 ? 'checked="checked"' : ''; ?>>
            <p style="display:inline"><span>Enable TimThumb</span> - This option is needed if you want the images to be dynamically resized. </p>
        </div>
        
        <div class="option">
        	<input type="checkbox" name="slider_pro_enqueue_jquery" value="1" <?php echo get_option('slider_pro_enqueue_jquery') == 1 ? 'checked="checked"' : ''; ?>>
            <p style="display:inline"><span>Enqueue jQuery 1.6.2</span> - You can disable this option if you already include your own version of the jQuery library but please note that Slider PRO needs at least version 1.4.</p>
        </div>
        
        <div class="option">
        	<input type="checkbox" name="slider_pro_enqueue_jquery_easing" value="1" <?php echo get_option('slider_pro_enqueue_jquery_easing') == 1 ? 'checked="checked"' : ''; ?>>
            <p style="display:inline"><span>Enqueue jQuery Easing</span> - If you only use the default easing type you can disable this option.</p>
        </div>
        
        <div class="option">
        	<input type="checkbox" name="slider_pro_enqueue_jquery_mousewheel" value="1" <?php echo get_option('slider_pro_enqueue_jquery_mousewheel') == 1 ? 'checked="checked"' : ''; ?>>
            <p style="display:inline"><span>Enqueue jQuery MouseWheel</span> - If you use a different plugin for handling the mouse wheel input you can disable this option.</p>
        </div>
        
        <input type="submit" name="plugin_options_update" class="button-primary" value="Update Options"/>
    </form>
</div>