<div class="wrap slider-pro">
	<div class="slider-icon"></div>
	<h2><?php _e('Sliders', 'slider_pro'); ?></h2>
     
	<?php
		if ($_GET['action'] == 'delete') {
			echo '<div id="message" class="updated below-h2"><p>' . __('Slider deleted.', 'slider_pro') . '</p></div>';
		}
	?>
       
	<table class="widefat">
		<thead>
        	<tr>
            	<th width="5%"><?php _e('ID', 'slider_pro'); ?></th>
                <th width="39%"><?php _e('Name', 'slider_pro'); ?></th>
                <th width="13%"><?php _e('Created', 'slider_pro'); ?></th>
                <th width="13%"><?php _e('Modified', 'slider_pro'); ?></th>
               	<th width="35%"><?php _e('Actions', 'slider_pro'); ?></th>
        	</tr>
        </thead>
            
        <tbody>
        	<?php 
				global $wpdb;
				$prefix = $wpdb->prefix;
				$sliders = $wpdb->get_results("SELECT * FROM " . $prefix . "sp_sliders ORDER BY id");
				if (count($sliders) == 0) {
					echo '<tr>'.
							 '<td colspan="100%">' . __('No slider created yet.', 'slider_pro') . '</td>'.
						 '</tr>';
				} else {
					foreach ($sliders as $slider) {
						echo '<tr>'.
								'<td>' . $slider->id . '</td>'.
								'<td>' . $slider->name . '</td>'.
								'<td>' . $slider->created . '</td>'.
								'<td>' . $slider->modified . '</td>'.
								'<td>' .
									  '<a href="'. admin_url('admin.php?page=slider_pro&action=edit&id=' . $slider->id) . '">' . __('Edit', 'slider_pro') . '</a> | '.
									  '<a id="preview-slider" href="' . admin_url('admin-ajax.php?action=sp_slider_preview&id=' . $slider->id . '&name=' . $slider->name) . '">' . __('Preview', 'slider_pro') . '</a> | '.
									  '<a id="delete-slider" href="' . wp_nonce_url(admin_url('admin.php?page=slider_pro&action=delete&id='  .$slider->id), 'delete-slider') . '">' . __('Delete', 'slider_pro') . '</a> | '.
									  '<a id="duplicate-slider" href="' . wp_nonce_url(admin_url('admin.php?page=slider_pro&action=duplicate&id='  .$slider->id), 'duplicate-slider') . '">' . __('Duplicate', 'slider_pro') . '</a> | '.
									  '<a href="' . plugins_url('/slider-pro/includes/export.php?id=' . $slider->id) . '">' . __('Export', 'slider_pro') . '</a>'.
								'</td>'.
							'</tr>';
					}
				}
			?>
        </tbody>
        
        <tfoot>
        	<tr>
            	<th><?php _e('ID', 'slider_pro'); ?></th>
                <th><?php _e('Name', 'slider_pro'); ?></th>
                <th><?php _e('Created', 'slider_pro'); ?></th>
                <th><?php _e('Modified', 'slider_pro'); ?></th>
               	<th><?php _e('Actions', 'slider_pro'); ?></th>
            </tr>
		</tfoot>
	</table>
    
    <div id="new-slider-button">    
		<a class="button-secondary" href="<?php echo admin_url('admin.php?page=slider_pro_new'); ?>"><?php _e('Create a New Slider', 'slider_pro'); ?></a>
        <a class="button-secondary" id="import-slider" href="<?php echo admin_url('admin-ajax.php?action=sp_slider_import'); ?>"><?php _e('Import a Slider', 'slider_pro'); ?></a>
    </div>    
    
</div>