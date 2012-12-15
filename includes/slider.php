<div class="wrap slider-pro">
	<div class="slider-icon"></div>
	<h2>
    	<?php
    		echo $action == 'edit' ? __('Edit Slider', 'slider_pro') : __('Create a New Slider', 'slider_pro');
		?>
    </h2>
    
    <?php
    	if ($_GET['action'] == 'create') {
			echo '<div id="message" class="updated below-h2"><p>' . __('Slider created.', 'slider_pro') . '</p></div>';
		} else if ($_GET['action'] == 'update') {
			echo '<div id="message" class="updated below-h2"><p>' . __('Slider updated.', 'slider_pro') . '</p></div>';
		}
	?>
    
    <form action="<?php echo $action == 'edit' ? admin_url('admin.php?page=slider_pro&action=update') : admin_url('admin.php?page=slider_pro&action=create'); ?>" method="post">
    	<?php wp_nonce_field('slider-form-submit', 'slider-form-nonce'); ?>
        <?php if ($action == 'edit') { ?> <input type="hidden" name="slider_id" value="<?php echo $slider_id; ?>"/> <?php } ?>
        
        <div class="metabox-holder has-right-sidebar">
            <div class="editor-wrapper meta-box-sortables">
                <div class="editor-body">
                    <div id="titlediv">
                    	<input name="name" id="title" type="text" value="<?php echo $action == 'edit' ? sp_get_setting($slider, 'name') : __('My Slider', 'slider_pro'); ?>"/>
                    </div>
                    
                    <div class="slideboxes ui-sortable">
                    <?php
						$counter = 1;
						
						if ($action == 'edit')
							foreach($slides as $slide) {
								$is_slide = true;
								$slide_content = unserialize($slide['content']);
								$slide_settings = unserialize($slide['settings']);
								
								include('slide.php');
								$counter++;
							}
						else
							include('slide.php');
                    ?>
                    </div>
                    
                    <div id="add-new-slide"> 
                   		<a class="button-secondary" href="<?php echo admin_url("admin-ajax.php?action=sp_add_new_slide"); ?>">Add a New Slide</a>
                    </div>
                </div>
            </div>
            
            <div class="inner-sidebar meta-box-sortables ui-sortable">
                
                <?php
					global $sp_slider_settings_panels;
					
					if ($action == 'edit')
						foreach($slider['panels_state'] as $key => $value)
							include_once($sp_slider_settings_panels[$key]);
					else
						foreach($sp_slider_settings_panels as $key => $value)
							include_once($value);	
				?>
                
            </div>
        </div>
	</form>
</div>