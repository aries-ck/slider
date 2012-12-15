<?php
	global $wpdb;
	$table_name = $wpdb->prefix . 'sp_sliders';
	$sliders = $wpdb->get_results("SELECT id, name FROM $table_name", ARRAY_A);
?>

<p><strong>Select the slider:</strong></p>

<select name="<?php echo $this->get_field_name('slider_id'); ?>" id="<?php echo $this->get_field_name('slider_id'); ?>" class="widefat">
	<?php 
		foreach ($sliders as $slider) {
			$selected = $slider_id == $slider['id'] ? 'selected="selected"' : "";
			echo "<option value=". $slider['id'] ." $selected>" . $slider['name'] . ' (' . $slider['id'] . ')' . "</option>";
        }
    ?>
</select>