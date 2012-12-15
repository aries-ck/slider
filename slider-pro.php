<?php

/*
	Plugin Name: Slider PRO
	Plugin URI: http://sliderpro.net
	Description: Premium slider plugin for WordPress.
	Version: 1.5.2
	Author: bqworks
	Author URI: http://codecanyon.net/user/bqworks
*/


// current version of Slider PRO
$slider_pro_version = '1.5.2';


register_activation_hook(__FILE__, 'sp_activate_plugin');
register_deactivation_hook(__FILE__, 'sp_deactivate_plugin');
register_uninstall_hook(__FILE__, 'sp_uninstall_plugin');


add_action('admin_init', 'sp_admin_init');
add_action('admin_menu', 'sp_create_menu');

add_action('wp', 'sp_get_page_styles');
add_action('init', 'sp_init');
add_action('wp_footer', 'sp_load_slider_scripts');

add_action('wp_ajax_sp_add_new_slide', 'sp_add_new_slide');
add_action('wp_ajax_sp_duplicate_slide', 'sp_duplicate_slide');
add_action('wp_ajax_sp_slider_preview', 'sp_slider_preview');
add_action('wp_ajax_sp_slider_import', 'sp_slider_import');
add_action('wp_ajax_sp_get_help_text', 'sp_get_help_text');
add_action('wp_ajax_sp_tinymce_plugin', 'sp_tinymce_plugin');
add_action('wp_ajax_sp_open_media', 'sp_open_media');

add_action('wp_print_styles', 'sp_load_slider_styles');
add_action('widgets_init', 'sp_register_widgets');

add_shortcode('slider_pro', 'slider_pro_shortcode');
add_shortcode('slide', 'slider_pro_slide_shortcode');
add_shortcode('slide_element', 'slider_pro_element_shortcode');


include_once('includes/lists.php');


/**
* Create/update the slider database tables
*/
function sp_activate_plugin() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$table_name = $prefix . 'sp_sliders';
	
	if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {		
		$create_sliders_table = "CREATE TABLE ". $prefix . "sp_sliders (
								id mediumint(9) NOT NULL AUTO_INCREMENT,
								name varchar(100) NOT NULL,
								settings text NOT NULL,
								include_skin text NOT NULL,
								created varchar(11) NOT NULL,
								modified varchar(11) NOT NULL,
								panels_state text NOT NULL,
								PRIMARY KEY (id)
								);";
		
		$create_slides_table = "CREATE TABLE ". $prefix . "sp_slides (
								id mediumint(9) NOT NULL AUTO_INCREMENT,
								slider_id mediumint(9) NOT NULL,
								name varchar(100) NOT NULL,
								content text NOT NULL,
								settings text NOT NULL,
								position mediumint(9) NOT NULL,
								panel_state varchar(20) NOT NULL,
								PRIMARY KEY (id)
								);";
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($create_sliders_table);
		dbDelta($create_slides_table);		
	} else {
		$slider_pro_db_version = get_option('slider_pro_version');
	
		//make modifications to the database if needed
	}
	
	
	update_option('slider_pro_version', $slider_pro_version);
	
	update_option('slider_pro_enable_timthumb', true);
	update_option('slider_pro_enqueue_jquery', true);
	update_option('slider_pro_enqueue_jquery_easing', true);
	update_option('slider_pro_enqueue_jquery_mousewheel', true);
}


/**
* This function is run on deactivation
* Does nothing yet
*/
function sp_deactivate_plugin() {
	
}


/**
* On uninstall delete the slider tables from the database
*/
function sp_uninstall_plugin() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	
	$sliders_table = $prefix . 'sp_sliders';
	$slides_table = $prefix . 'sp_slides';
	
	$wpdb->query("DROP TABLE $sliders_table, $slides_table");
}


function sp_is_slider_pro_admin() {
	if (is_admin() && ($_GET['page'] == 'slider_pro' || $_GET['page'] == 'slider_pro_new' || $_GET['page'] == 'slider_pro_skin_editor' || $_GET['page'] == 'slider_pro_plugin_options'))
		return true;
	else 
		return false;
}


/**
* Create the Slider PRO menu in the admin menu sidebar
*/
function sp_create_menu() {
	add_menu_page('Slider PRO', 'Slider PRO', 'manage_options', 'slider_pro', 'sp_sliders_ui', plugins_url('/slider-pro/css/images/mini-icon.png'));
	$sliders_page = add_submenu_page('slider_pro', __('Slider PRO - Sliders', 'slider_pro'),  __('Sliders', 'slider_pro'), 'manage_options', 'slider_pro', 'sp_sliders_ui');
	$add_new_page = add_submenu_page('slider_pro',  __('Slider PRO - Add New', 'slider_pro'),  __('Add New', 'slider_pro'), 'manage_options', 'slider_pro_new', 'sp_add_new_ui');
	$skin_editor_page = add_submenu_page('slider_pro',  __('Slider PRO - Skin Editor', 'slider_pro'),  __('Skin Editor', 'slider_pro'), 'manage_options', 'slider_pro_skin_editor', 'sp_skin_editor_ui');
	$plugin_options_page = add_submenu_page('slider_pro',  __('Slider PRO - Plugin Options', 'slider_pro'),  __('Plugin Options', 'slider_pro'), 'manage_options', 'slider_pro_plugin_options', 'sp_plugin_options_ui');
	
	add_action("admin_print_scripts-$sliders_page", 'sp_load_admin_scripts');
	add_action("admin_print_scripts-$add_new_page", 'sp_load_admin_scripts');
	
	add_action("admin_print_styles-$sliders_page", 'sp_load_admin_styles');
	add_action("admin_print_styles-$add_new_page", 'sp_load_admin_styles');
	add_action("admin_print_styles-$skin_editor_page", 'sp_load_admin_styles');
	add_action("admin_print_styles-$plugin_options_page", 'sp_load_admin_styles');
}


/**
* Load the scripts that will be used for the admin
*/
function sp_load_admin_scripts() {
	if (get_option('slider_pro_enqueue_jquery')) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', plugins_url('/slider-pro/js/jquery-1.6.2.min.js'));
		wp_print_scripts('jquery');	
	}
	
	wp_register_script('slider-pro-admin-js', plugins_url('/slider-pro/js/slider-pro-admin.js'));
	wp_register_script('slider-pro-colorpicker', plugins_url('/slider-pro/js/colorpicker.js'));
	wp_register_script('jquery-url-parser', plugins_url('/slider-pro/js/jquery.url.js'));
	
	add_filter('tiny_mce_before_init', 'sp_customize_tiny_mce');
	
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-ui-dialog');
	
	wp_enqueue_script('slider-pro-colorpicker');
	wp_enqueue_script('jquery-url-parser');
		
	wp_tiny_mce();	
	
	wp_enqueue_script('slider-pro-admin-js');
		
	// pass a few variables to the admin javascript file
	wp_localize_script('slider-pro-admin-js', 'sp_js_vars', array(
		'delete_slide' => __('Are you sure you want to delete this slide?', 'slider_pro'),
		'delete_slider' => __('Are you sure you want to delete this slider?', 'slider_pro'),
		'yes' => __('Yes', 'slider_pro'),
		'cancel' => __('Cancel', 'slider_pro'),
		'preview' => __('Preview', 'slider_pro'),
		'import_slider' => __('Import a slider', 'slider_pro'),
		'media_loader' => __('Slider PRO Media Loader', 'slider_pro'),
		'ajaxurl' => admin_url('admin-ajax.php'),
		'timthumb' => plugins_url('/slider-pro/includes/timthumb/timthumb.php'),
		'enable_timthumb' => get_option('slider_pro_enable_timthumb')		
		));
}


/**
* Load the styles that will be used for the admin
*/
function sp_load_admin_styles() {
	wp_register_style('slider-pro-admin', plugins_url('/slider-pro/css/slider-pro-admin.css'));
	wp_register_style('slider-pro-jquery-ui', plugins_url('/slider-pro/css/jquery-ui.css'));
	wp_register_style('slider-pro-colorpicker', plugins_url('/slider-pro/css/colorpicker.css'));
	
	wp_enqueue_style('slider-pro-jquery-ui');
	wp_enqueue_style('slider-pro-colorpicker');
	wp_enqueue_style('slider-pro-admin');
	
	if (floatval(get_bloginfo('version')) >= 3.2) {
		wp_register_style('slider-pro-admin-wp32', plugins_url('/slider-pro/css/slider-pro-admin-wp32.css'));
		wp_enqueue_style('slider-pro-admin-wp32');
	}
	
	sp_load_slider_styles();
}


/**
* Load the slider styles
*/
function sp_load_slider_styles() {
	
	$skins;	
	
	if (sp_is_slider_pro_admin()) {
		// load all the skins used by the sliders created
		// this is necessary for the admin area where you can't know which slider will be previewed
		$skins = sp_get_all_skins_used();
	} else {
		global $sp_styles_to_load;
		// load only the styles used on the page
		$skins = $sp_styles_to_load;
	}
	
	
	// if some skins need to be loaded, load the main CSS file as well
	if (count($skins) > 0) {
		wp_register_style('slider-pro-slider-public', plugins_url('/slider-pro/css/advanced-slider-base.css'));		
		wp_enqueue_style('slider-pro-slider-public');
	}
	
	
	// load the needed skins
	foreach($skins as $skin) {
		$skin_obj = sp_get_skin_by_class($skin);
		$id = 'slider-pro-skin-' . $skin_obj['Class'];
		
		wp_register_style($id, $skin_obj['url']);		
		wp_enqueue_style($id);
	}
}


/**
* Creates an array with all the styles used on a certain page
*/
function sp_get_page_styles() {	
	if (is_admin())
		return;
	
	global $posts, $sp_styles_to_load;
	
	// the idIDs of the sliders that are on the page
	$ids_to_load = array();
	
	$matches = array();
	
	$pattern = get_shortcode_regex();
	
	// check all posts and look for the 'slider_pro' shortcode
	if (isset($posts) && !empty($posts)) {
		foreach($posts as $post) {
			preg_match_all('/' . $pattern . '/s', $post->post_content, $matches);
			
			foreach($matches[2] as $key => $value) {
				if($value == 'slider_pro') {
					// get all the attributes specified in the shortcode
					$atts = explode(" ", $matches[3][$key]);
					
					foreach($atts as $att) {
						$a = explode("=", $att);
						
						// if a main skin was specified add it in the array of skins
						if ($a[0] == 'skin') {
							$v = str_replace("\"", "", $a[1]);
							if (!in_array($v, $sp_styles_to_load))
								array_push($sp_styles_to_load, $v);
						} else if ($a[0] == 'id') { // if a skin was not specified but the slider has an ID, add the id to the array of IDs
							$v = intval(str_replace("\"", "", $a[1]));
							if (!in_array($v, $ids_to_load))
								array_push($ids_to_load, $v);
						}
						
						// if a scrollbar skin was specified add it in the array of skins
						if ($a[0] == 'scrollbar_skin') {
							$v = str_replace("\"", "", $a[1]);
							if (!in_array($v, $sp_styles_to_load))
								array_push($sp_styles_to_load, $v);
						} else if ($a[0] == 'id') { // if a scrollbar skin was not specified but the slider has an ID, add the id to the array of IDs
							$v = intval(str_replace("\"", "", $a[1]));
							if (!in_array($v, $ids_to_load))
								array_push($ids_to_load, $v);							
						}
					}
				}
			}
		}
	}
	
	
	global $wpdb;
	$prefix = $wpdb->prefix;
	
	
	// get the IDs of the sliders for which the skin will always be included in the header
	// this is necessary for those sliders which are added in the header, sidebar or
	// anywhere else outside the post/page
	$included_skin_sliders = $wpdb->get_results("SELECT id FROM " . $prefix . "sp_sliders WHERE include_skin=1", ARRAY_A);	
	
	foreach($included_skin_sliders as $slider_id) {
		if (!in_array($slider_id['id'], $ids_to_load)) {
			array_push($ids_to_load, $slider_id['id']);
		}
	}
	
	
	// loop through the array of IDs and get the skin of the slider
	foreach($ids_to_load as $id) {
		$slider_settings = $wpdb->get_results("SELECT settings FROM " . $prefix . "sp_sliders WHERE id=$id", ARRAY_A);
		
		if ($slider_settings)
			foreach($slider_settings as $raw_settings) {
				$settings = unserialize($raw_settings['settings']);
				$skin = $settings['skin'];
				$scrollbar_skin = $settings['scrollbar_skin'];
				
				if (!in_array($skin, $sp_styles_to_load))
					array_push($sp_styles_to_load, $skin);
				
				if ($settings['thumbnail_scrollbar'])	
					if (!in_array($scrollbar_skin, $sp_styles_to_load))
						array_push($sp_styles_to_load, $scrollbar_skin);
			}
	}	
}


/**
* Load the public view scripts
*/
function sp_load_slider_scripts() {
	global $sp_sliders_js;
	global $sp_scripts_to_load;
	global $is_IE;
	
	
	// only load the excanvas script if it's going to be used
	if (in_array('excanvas', $sp_scripts_to_load) && $is_IE) {
		wp_register_script('slider-pro-slider-excanvas-js', plugins_url('/slider-pro/js/excanvas.compiled.js'));
		wp_print_scripts('slider-pro-slider-excanvas-js');
	}
	
	
	// only load the mousewheel script if it's going to be used
	if (in_array('mousewheel', $sp_scripts_to_load) && get_option('slider_pro_enqueue_jquery_mousewheel')) {
		wp_register_script('slider-pro-slider-mousewheel-js', plugins_url('/slider-pro/js/jquery.mousewheel.min.js'));		
		wp_print_scripts('slider-pro-slider-mousewheel-js');
	}
	
	
	// only load the lightbox script if it's going to be used
	if (in_array('lightbox', $sp_scripts_to_load)) {
		wp_register_script('slider-pro-lightbox-js', plugins_url('/slider-pro/js/jquery.prettyPhoto.custom.min.js'));		
		wp_print_scripts('slider-pro-lightbox-js');
	}
	
	
	// only load the main script and the easing script if there is at least one slider on the page
	if (in_array('slider', $sp_scripts_to_load)) {
		if (get_option('slider_pro_enqueue_jquery_easing')) {
			wp_register_script('slider-pro-slider-easing-js', plugins_url('/slider-pro/js/jquery.easing.1.3.js'));
			wp_print_scripts('slider-pro-slider-easing-js');
		}
		
		wp_register_script('slider-pro-slider-js', plugins_url('/slider-pro/js/jquery.advancedSlider.min.js'));		
		wp_print_scripts('slider-pro-slider-js');
	}
	
	echo $sp_sliders_js;
}


/**
* Init
*/
function sp_init() {	
	
	global $sp_main_skins, $sp_scrollbar_skins, $sp_all_skins, $sp_unique_id, $sp_scripts_to_load, $sp_sliders_js, $sp_styles_to_load, $sp_lightbox_loaded;	
	
	$sp_main_skins = sp_get_skins('main');
	$sp_scrollbar_skins = sp_get_skins('scrollbar');
	$sp_all_skins = array_merge($sp_main_skins, $sp_scrollbar_skins);
	$sp_unique_id = 0;
	$sp_scripts_to_load = array();
	$sp_sliders_js = "";
	$sp_styles_to_load = array();
	$sp_lightbox_loaded = false;
	
	load_plugin_textdomain('slider_pro', false, dirname(plugin_basename(__FILE__)) . '/languages');
	
	if (!is_admin() && get_option('slider_pro_enqueue_jquery')) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', plugins_url('/slider-pro/js/jquery-1.6.2.min.js'));
		wp_enqueue_script('jquery');
	}
}


/**
* Admin Init
* Do the database editing
* Create the tinyMCE plugin for Slider PRO
*/
function sp_admin_init() {
	
	if (sp_is_slider_pro_admin()) {
		
		global $wpdb, $sp_current_action, $sp_current_slider_id;
			
		// get the type of action and the id of the slider
		if (isset($_GET['action'])) {
			$sp_current_action = $_GET['action'];
			$sp_current_slider_id = $_GET['id'];
		}
		
		// if a new slider was created or an existing slider was updated
		if ($sp_current_action == 'create' || $sp_current_action == 'update') {
			check_admin_referer('slider-form-submit', 'slider-form-nonce');
			
			// get the posted data
			$name = $_POST['name'];
			$include_skin = $_POST['include_skin'];
			$settings = $_POST['slider_settings'];
			$panels_state = $_POST['panels_state'];
			
			if ($sp_current_action == 'create') {			
				
				// add the slider to the database
				$wpdb->insert($wpdb->prefix.'sp_sliders', array('name'=>$name, 
																'settings'=>serialize($settings),
																'include_skin'=>$include_skin,
																'created'=>date('m-d-Y'), 
																'modified'=>date('m-d-Y'),
																'panels_state'=>serialize($panels_state)), 
														  array('%s', '%s', '%d', '%s', '%s', '%s'));
				$sp_current_slider_id = $wpdb->insert_id;
				
				// add the slides to the database
				if (isset($_POST['slide'])) {
					foreach ($_POST['slide'] as $slide) {
						
						$slide['content']['caption'] = htmlspecialchars(wpautop($slide['content']['caption']));
						$slide['content']['html'] = htmlspecialchars(wpautop($slide['content']['html']));
						$slide['content']['lightbox_description'] = htmlspecialchars(wpautop($slide['content']['lightbox_description']));
											
						$wpdb->insert($wpdb->prefix.'sp_slides', array('slider_id'=>$sp_current_slider_id,
																	   'name'=>$slide['name'],
																	   'settings'=>serialize($slide['settings']),
																	   'content'=>serialize($slide['content']),
																	   'position'=>$slide['position'],
																	   'panel_state'=>$slide['panel_state']),
																 array('%d', '%s', '%s', '%s', '%d', '%s'));
					}
				}
			
				
			} else if ($sp_current_action == 'update') {
				// get the id of the updated slider
				$sp_current_slider_id = $_POST['slider_id'];
				
				// update the slider
				$wpdb->update($wpdb->prefix . 'sp_sliders', array('name'=>$name, 
																  'settings'=>serialize($settings),
																  'include_skin'=>$include_skin, 
																  'modified'=>date('m-d-Y'),
																  'panels_state'=>serialize($panels_state)),
															array('id'=>$sp_current_slider_id), 
															array('%s', '%s', '%d', '%s', '%s'), 
															array('%d'));
				
				// to update the slides, first delete them all from the database and then add them again			
				$wpdb->query("DELETE FROM ".$wpdb->prefix."sp_slides WHERE slider_id = $sp_current_slider_id");
				
				if (isset($_POST['slide'])) {
					foreach ($_POST['slide'] as $slide) {
						
						$slide['content']['caption'] = htmlspecialchars(wpautop($slide['content']['caption']));
						$slide['content']['html'] = htmlspecialchars(wpautop($slide['content']['html']));
						$slide['content']['lightbox_description'] = htmlspecialchars(wpautop($slide['content']['lightbox_description']));
						
						$wpdb->insert($wpdb->prefix.'sp_slides', array('slider_id'=>$sp_current_slider_id,
																	   'name'=>$slide['name'],
																	   'settings'=>serialize($slide['settings']),
																	   'content'=>serialize($slide['content']),
																	   'position'=>$slide['position'],
																	   'panel_state'=>$slide['panel_state']),
																 array('%d', '%s', '%s', '%s', '%d', '%s'));
					}
				}
			}			
			
			// create the slider XML file
			sp_slider_export($sp_current_slider_id);
			
			$sp_current_action = 'edit';
		}
		
		
		if ($sp_current_action == 'delete' && wp_verify_nonce($_GET['_wpnonce'], 'delete-slider')) {		
			// delete the slider and slides from the database		
			$wpdb->query("DELETE FROM ".$wpdb->prefix."sp_slides WHERE slider_id = $sp_current_slider_id");
			$wpdb->query("DELETE FROM ".$wpdb->prefix."sp_sliders WHERE id = $sp_current_slider_id");
		}
		
		
		if ($sp_current_action == 'duplicate' && wp_verify_nonce($_GET['_wpnonce'], 'duplicate-slider')) {		
			// duplicate the slider
			$slider = sp_get_slider($sp_current_slider_id);
			
			$wpdb->insert($wpdb->prefix.'sp_sliders', array('name'=>$slider['name'], 
															'settings'=>serialize($slider['settings']),
															'include_skin'=>$slider['include_skin'],
															'created'=>date('m-d-Y'), 
															'modified'=>date('m-d-Y'),
															'panels_state'=>serialize($slider['panels_state'])), 
													  array('%s', '%s', '%d', '%s', '%s', '%s'));
			
			$new_id = $wpdb->insert_id;
													  
			// duplicate the slides
			$slides = sp_get_slides($sp_current_slider_id);
			
			foreach ($slides as $slide) {
				$wpdb->insert($wpdb->prefix.'sp_slides', array('slider_id'=>$new_id,
															   'name'=>$slide['name'],
															   'settings'=>$slide['settings'],
															   'content'=>$slide['content'],
															   'position'=>$slide['position'],
															   'panel_state'=>$slide['panel_state']),
														 array('%d', '%s', '%s', '%s', '%d', '%s'));
			}		
			
			// create the slider XML file
			sp_slider_export($new_id);
		}
		
		
		if (isset($_POST['import-slider-submit'])) {
			check_admin_referer('import-slider-submit', 'import-slider-nonce');
			
			$xml = new DOMDocument();
			$xml->preserveWhiteSpace = false;
			$xml->load($_FILES['import-slider-file']['tmp_name']);
			
			$main = $xml->documentElement;
			
			// get the name of the slider
			$name = $main->getElementsByTagName('name')->item(0)->nodeValue;
			
			// get the 'include_skin' setting
			$include_skin = $main->getElementsByTagName('include_skin')->item(0)->nodeValue;
			
			// get the sidebar panels state
			foreach ($main->getElementsByTagName('panels_state')->item(0)->childNodes as $element) {
				$panels_state[$element->nodeName] = $element->nodeValue;
			}
			
			// get the global settings of the slider
			foreach ($main->getElementsByTagName('settings')->item(0)->childNodes as $element) {
				$settings[$element->nodeName] = $element->nodeValue;
			}
			
			
			// add the slider to the database
			$wpdb->insert($wpdb->prefix.'sp_sliders', array('name'=>$name, 
															'settings'=>serialize($settings),
															'include_skin'=>$include_skin,
															'created'=>date('m-d-Y'), 
															'modified'=>date('m-d-Y'),
															'panels_state'=>serialize($panels_state)), 
													  array('%s', '%s', '%d', '%s', '%s', '%s'));
			$sp_current_slider_id = $wpdb->insert_id;
			
			
			
			foreach ($main->getElementsByTagName('slides')->item(0)->childNodes as $slide) {
				// get the name of the slide
				$name = $slide->getElementsByTagName('name')->item(0)->nodeValue;
				// get the position
				$position = $slide->getElementsByTagName('position')->item(0)->nodeValue;
				// get the panel state
				$panel_state = $slide->getElementsByTagName('panel_state')->item(0)->nodeValue;
				
				// get the slide settings
				foreach ($slide->getElementsByTagName('settings')->item(0)->childNodes as $element) {
					$slide_settings[$element->nodeName] = $element->nodeValue;
				}
				
				// get the slide content
				foreach ($slide->getElementsByTagName('content')->item(0)->childNodes as $element) {
					$slide_content[$element->nodeName] = $element->nodeValue;
				}
				
				// add the slide to the database
				$wpdb->insert($wpdb->prefix.'sp_slides', array('slider_id'=>$sp_current_slider_id,
															   'name'=>$name,
															   'settings'=>serialize($slide_settings),
															   'content'=>serialize($slide_content),
															   'position'=>$position,
															   'panel_state'=>$panel_state),
														  array('%d', '%s', '%s', '%s', '%d', '%s'));
			}
			
			// create the slider XML file
			sp_slider_export($sp_current_slider_id);
		}
	}
	
	if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
		add_filter('mce_external_plugins', 'sp_add_tinymce_plugin');
		add_filter('mce_buttons', 'sp_register_tinymce_button');
	}
}


function sp_register_tinymce_button($buttons) {
	array_push($buttons, 'separator', 'sliderpro');
	return $buttons;
}


function sp_add_tinymce_plugin($plugin_array) {
	$plugin_array['sliderpro'] = plugins_url('/slider-pro/js/editor-plugin.js');
	return $plugin_array;
}


/**
* Create the UI for the Sliders and Add New pages
*/
function sp_sliders_ui() {
	global $sp_current_action, $sp_current_slider_id;
	
	$slider;
	$slides;	
	$action = $sp_current_action;
	$slider_id = $sp_current_slider_id;
		
	if ($sp_current_action == 'delete') {		
		// display the Sliders page	
		include_once('includes/sliders.php');
		
	} else if ($sp_current_action == 'edit') {		
		// load the updated slider and also load all the slides of the updated slider
		$slider = sp_get_slider($slider_id);
		$slides = sp_get_slides($slider_id);
		
		// display the Edit Slider page	
		include_once('includes/slider.php');
		
	} else {
		// display the Sliders page	
		include_once('includes/sliders.php');	
	}
	
}


/**
* Create the UI for the Add New page
*/
function sp_add_new_ui() {
	include_once('includes/slider.php');
}


/**
* Create the UI for the Skin Editor page
*/
function sp_skin_editor_ui() {
	// set the default value to 'pixel', which is the default skin
	$current_skin = "pixel";
	
	// get the chosen skin
	if(isset($_POST['skin_selector'])) {
		$current_skin = $_POST['skin_selector'];
	}	
	
	//get the skin object by name
	$skin = sp_get_skin_by_class($current_skin);
	
	// get the path of the skin
	$skin_path = $skin['dir'];
	
	// if the skin was updated write the updated content to the file		
	if (isset($_POST['update_skin'])){
		check_admin_referer('skin-editor-update', 'skin-editor-nonce');
		
		$updated_content = $_POST['skin_content'];
		
		if (is_writable($skin_path)) {
			$fw = fopen($skin_path, 'w+');					
			fwrite($fw, $updated_content);
			fclose($fw);
		}	
	}
		
	// read the content at the chosen path	
	if (is_file($skin_path)) {
    	$fr = fopen($skin_path, 'r');					
    	$skin_content = fread($fr, filesize($skin_path));
    }
	
	
	// get the data of the skin
	$skin_author = $skin['Author'];
	$skin_description = $skin['Description'];
	$skin_name = $skin['Skin Name'];
	
	
	// display the Skin Editor page
	include_once('includes/skin-editor.php');
}


/**
* Create the UI for the Plugin Options page
*/
function sp_plugin_options_ui() {
		
	if (isset($_POST['plugin_options_update'])) {
		check_admin_referer('plugin-options-update', 'plugin-options-nonce');
		
		
		if (isset($_POST['slider_pro_enable_timthumb']))
			update_option('slider_pro_enable_timthumb', true);
		else
			update_option('slider_pro_enable_timthumb', false);
			
			
		if (isset($_POST['slider_pro_enqueue_jquery']))
			update_option('slider_pro_enqueue_jquery', true);
		else
			update_option('slider_pro_enqueue_jquery', false);
			
		
		if (isset($_POST['slider_pro_enqueue_jquery_easing']))
			update_option('slider_pro_enqueue_jquery_easing', true);
		else
			update_option('slider_pro_enqueue_jquery_easing', false);
			
			
		if (isset($_POST['slider_pro_enqueue_jquery_mousewheel']))
			update_option('slider_pro_enqueue_jquery_mousewheel', true);
		else
			update_option('slider_pro_enqueue_jquery_mousewheel', false);
	}
	
	
	include_once('includes/plugin-options.php');
}


/**
* Return the slider based of the specified ID
*/
function sp_get_slider($id) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'sp_sliders';
	$slider_raw = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id", ARRAY_A);
	
	if ($slider_raw){
		$slider['name'] = $slider_raw['name'];
		$slider['include_skin'] = $slider_raw['include_skin'];
		$slider['settings'] = unserialize($slider_raw['settings']);
		$slider['panels_state'] = unserialize($slider_raw['panels_state']);
		return $slider;
	} else {
		return false;	
	}
}


/**
* Return the slides based of the specified ID
*/
function sp_get_slides($id) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'sp_slides';
	$slides = $wpdb->get_results("SELECT * FROM $table_name WHERE slider_id = $id ORDER BY position", ARRAY_A);
	
	return $slides;
}


/**
* Return the value of a slider's setting
*/
function sp_get_setting($slider, $setting_name) {
	$value;
	
	// if the specified slider exists, get its value
	if (isset($slider)) {
		if ($setting_name == 'name')
			$value = $slider['name'];
		else if ($setting_name == 'include_skin') {
			$value = $slider['include_skin'];
		}
		else
			$value = $slider['settings'][$setting_name];		
	} else { // else get the default value for that setting
		global $sp_default_slider_settings;
		$value = $sp_default_slider_settings[$setting_name];
	}
	
	return $value;
}


/**
* Return the value of a slides' setting
*/
function sp_get_slide_setting($slide_settings, $setting_name) {
	$value;
	
	if (isset($slide_settings)) {
		$value = $slide_settings[$setting_name];
		
	} else {
		global $sp_default_slider_settings;
		$value = $sp_default_slider_settings[$setting_name];
		
		if (!$value) $value = 0;
	}
	
	return $value;
}


/**
* Return the slides' content (can be html, caption, tooltip caption etc)
*/
function sp_get_slide_content($slide_content, $content_name) {
	return isset($slide_content) ? $slide_content[$content_name] : "";
}


/**
* Return the panel's state (opened/closed)
*/
function sp_get_panels_state($slider, $panel_name) {
	$state;
	
	if (isset($slider))
		$state = $slider['panels_state'][$panel_name];
	else 
		$state = ($panel_name == 'publish' || $panel_name == 'general') ? 'opened' :  'closed';
			
	return $state;
}


/**
* Return the list of available settings for a slider
*/
function sp_get_settings_list($list) {
	global $sp_slider_settings_lists;
	
	return $sp_slider_settings_lists[$list];
}


/**
* Return the shortname for a setting
*/
function sp_get_settings_shortname($name) {
	global $sp_settings_shortname;
	
	return $sp_settings_shortname[$name];
}


/**
* Add a new slide, using AJAX
*/
function sp_add_new_slide() {
	$counter = $_POST['counter'];
	include_once('includes/slide.php');	
	
	die();
}


/**
* Duplicate a slide, using AJAX
*/
function sp_duplicate_slide() {
	$counter = $_POST['counter'];
	$id = $_POST['id'];
	
	if ($id != -1) {
		global $wpdb;
		$table_name = $wpdb->prefix . 'sp_slides';
		$slide = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id", ARRAY_A);
		
		$is_slide = true;
		$slide['id'] = -1;
		$slide_content = unserialize($slide['content']);
		$slide_settings = unserialize($slide['settings']);
	}
	
	include_once('includes/slide.php');	
	
	die();
}


/**
* Get the description of a property, using AJAX
*/
function sp_get_help_text() {
	$title = $_GET['title'];
	
	global $sp_properties_help;
	echo $sp_properties_help[$title];
	
	die();
}


/**
* Preview the slider
*/
function sp_slider_preview() {
	$id = $_POST['id'];
	
	echo slider_pro($id);	
	sp_load_slider_scripts();
	
	die();
}


/**
* Show the available sliders in the tinyMCE plugin
*/
function sp_tinymce_plugin() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'sp_sliders';
	$sliders = $wpdb->get_results("SELECT id, name FROM $table_name");
	
	echo json_encode($sliders);
	
	die();
}


/**
* Open the media lightbox
*/
function sp_open_media() {	
	$images_total_height = $_POST['images_total_height'];
	$show_page = $_POST['show_page'];
	$show_date = $_POST['show_date'];
	
	include('includes/media-loader.php');
	
	die();
}


/**
* Import a slider
*/
function sp_slider_import() {	
	
	include('includes/import-slider-form.php');
	
	die();
}


/**
* Export the slider
*/
function sp_slider_export($id) {
	
	// load the slider and its slides
	$slider = sp_get_slider($id);
	$slides = sp_get_slides($id);
	
	// create the XML document
	$xml = new DOMDocument();
	$xml->formatOutput = true;
	
	$main = $xml->createElement('slider');
	$xml->appendChild($main);
	
	// parse the slider data and write it in the XML document
	foreach ($slider as $key => $value) {
		if (is_array($value)) {
			$slider_element = $xml->createElement($key);
			$main->appendChild($slider_element);
			
			foreach ($value as $key2 => $value2) {
				$element = $xml->createElement($key2, $value2);
				$slider_element->appendChild($element);
			}
		} else {
			$slider_element = $xml->createElement($key, $value);
			$main->appendChild($slider_element);
		}
	}
	
	// create the slides wrapper in the XML document
	$slides_wrapper = $xml->createElement('slides');
	$main->appendChild($slides_wrapper);
	
	// get each slide
	foreach ($slides as $slide) {
		$slide_instance = $xml->createElement('slide');
		$slides_wrapper->appendChild($slide_instance);
		
		// get each value or array(in the case of 'content' and 'settings')
		foreach($slide as $key => $value) {			
			if (is_serialized($value)) { // array/serialized data
				$unserialized_data = unserialize($value);
				
				$slide_instance_array_element = $xml->createElement($key);
				$slide_instance->appendChild($slide_instance_array_element);
				
				if ($key == 'content') {
					foreach ($unserialized_data as $key2 => $value2) {
						$slide_instance_element = $xml->createElement($key2);
						
						// put the content inside CDATA
						$cdata_value = $xml->createCDATASection($value2);
						$slide_instance_element->appendChild($cdata_value);
						$slide_instance_array_element->appendChild($slide_instance_element);
					}
				} else {
					foreach ($unserialized_data as $key2 => $value2) {
						$slide_instance_element = $xml->createElement($key2, $value2);
						$slide_instance_array_element->appendChild($slide_instance_element);
					}
				}
			} else { // simple value
				$slide_instance_element = $xml->createElement($key, $value);
				$slide_instance->appendChild($slide_instance_element);
			}
		}
	}
	
	
	$path = WP_PLUGIN_DIR . "/slider-pro/xml/slider-$id.xml";
	$xml->save($path);
}


/**
* Create the Slider PRO
*/
function slider_pro($id, $atts = null, $content = null) {
	
	global $sp_default_slider_settings, $sp_unique_id, $sp_scripts_to_load, $sp_sliders_js, $sp_timthumb_align, $sp_styles_to_load;
	
	// increment the id, so that each slider from a certain page will have a unique ID
	$sp_unique_id++;
	
	// if id is -1, it means that an id was not specified and the slider will be created
	// based on shortcode data
	if ($id == -1) {
		$slides = array();
		
		// merge the values specified in the shortcode with the default ones
		$slider_settings = $atts ? array_merge($sp_default_slider_settings, $atts) : $sp_default_slider_settings;
			
	} else {
		// if an id was specified, load the slider
		$slider = sp_get_slider($id);
		
		// if the slider does not exist, display a message
		if (!$slider)
			return "A slider with the ID of $id was not found.";
		
		// merge the values specified in the shortcode with the values specified for the slider in the admin area
		$slider_settings = $atts ? array_merge($slider['settings'], $atts) : $slider['settings'];
		
		// load the slider's slides
		$slides = sp_get_slides($id);
	}
	
	
	// analyze the shortcode's content, if any
	if ($content) {
		// create an array that will hold extra slides
		$slides_extra = array();
		
		// counter for the slides for which an index was not specified and will be added at the end of the other slides
		$end_counter = 1;
		
		// get all the added slides
		$slides_sc = do_shortcode($content);
		$slides_sc = str_replace('<br />', '', $slides_sc);		
		$slides_sc = explode('%sp_sep%', $slides_sc);
		
		
		// loop through all the slides added within the shortcode 
		// and add the slide to the slides_extra array
		foreach($slides_sc as $slide_sc) {
			$slide_sc = unserialize(trim($slide_sc));
			
			if ($slide_sc) {
				$index = $slide_sc['settings']['index'];
				
				if (!is_numeric($index)) {
					$index .= "_$end_counter";
					$end_counter++;
				}
				
				$slides_extra[$index] = $slide_sc;
			}
		}
		
		
		// loop through all the existing slides and override the settings and/or the content
		// if it's the case
		foreach($slides as &$slide_r) {
			$slide_settings = unserialize($slide_r['settings']);
			$slide_content = unserialize($slide_r['content']);
			
			if($slides_extra[$slide_r['position']]) {
				$slide_extra = $slides_extra[$slide_r['position']];
				
				if ($slide_extra['settings'])
					$slide_settings = array_merge($slide_settings, $slide_extra['settings']);
				
				if ($slide_extra['content'])
					$slide_content = array_merge($slide_content, $slide_extra['content']);
				
				unset($slides_extra[$slide_r['position']]);
			}
			
			$slide_r['settings'] = $slide_settings;
			$slide_r['content'] = $slide_content;
		}
		
		
		// add the extra slides at the end of the initial slides
		foreach($slides_extra as $slide_end) {
			array_push($slides, $slide_end);
		}
	} else {
		foreach($slides as &$slide_s) {
			$slide_settings = unserialize($slide_s['settings']);
			$slide_content = unserialize($slide_s['content']);
			
			$slide_s['settings'] = $slide_settings;
			$slide_s['content'] = $slide_content;
		}	
	}
	
	
	// if a value is different from the default value, add it to the string
	foreach($sp_default_slider_settings as $name => $value) {		
		if ($slider_settings[$name] != $value) {			
			if ($slider_js_properties != "")
				$slider_js_properties .= ", ";
			$slider_js_properties .= sp_get_js_property_name($name) . ": " . sp_get_js_property_value($slider_settings[$name]);
		}
	}
	
	
	// decide what javascript files will need to be included in public view
	// based on the sliders' settings
	if (!in_array('slider', $sp_scripts_to_load))
		array_push($sp_scripts_to_load, 'slider');
	if ($slider_settings['timer_animation'] && !in_array('excanvas', $sp_scripts_to_load))
		array_push($sp_scripts_to_load, 'excanvas');
	if ($slider_settings['thumbnail_mouse_wheel'] && !in_array('mousewheel', $sp_scripts_to_load))
		array_push($sp_scripts_to_load, 'mousewheel');
	if ($slider_settings['lightbox'] && !in_array('lightbox', $sp_scripts_to_load))
		array_push($sp_scripts_to_load, 'lightbox');
	
	
	// string that will contain the javascript properties of the slides
	$slides_js_properties = "";
	
	$index = 0;
	
	// loop through all the slides 
	foreach($slides as $slide) {
		$slide_settings = $slide['settings'];
		$slide_js_properties = "";		
		
		// if a setting was marked to override the global setting, add that property to the string
		foreach($slide_settings as $name => $value) {			
			if (strpos($name, '_override') && $value == true) {
				if ($slide_js_properties != "")
					$slide_js_properties .= ", ";
					
				$prop_name = substr($name, 0, strlen($name) - 9);
				$slide_js_properties .= sp_get_js_property_name($prop_name) . ": " . sp_get_js_property_value($slide_settings[$prop_name]);
			}
		}
		
		if ($slide_js_properties != "") {
			if ($slides_js_properties != "")
				$slides_js_properties .= ", ";
			
			$slides_js_properties .= "$index: {" . $slide_js_properties . "}";	
		}
		
		$index++;
	}
	
	
	// create the Javascript output
	$js_string = "";	
	$js_string .= "<script type=\"text/javascript\">";
	$js_string .= "jQuery(document).ready(function() {";
	$js_string .= "jQuery(\"#slider-pro-$sp_unique_id\").advancedSlider({";
	$js_string .= $slider_js_properties;
	
	if ($slides_js_properties != "") {
		if ($slider_js_properties != "")
			$js_string .= ", ";	
		
		$js_string .= "slideProperties:{" . $slides_js_properties . "}";	
	}
	
	$js_string .= "});";
	
	// append the lightbox css to the header if it's going to be used
	if ($slider_settings['lightbox'] && !$sp_lightbox_loaded) {
		$sp_lightbox_loaded = true;
		$js_string .= "jQuery('<link>').attr({rel: 'stylesheet', type: 'text/css', media: 'screen', href: '" . plugins_url('/slider-pro/css/prettyPhoto.css') . "' }).appendTo(jQuery('head')); ";
	}
	
	
	$js_string .= "});";
	$js_string .= "</script>";
	
	// to be printed in foother
	$sp_sliders_js .= "\n" . $js_string; 
	
	// create the HTML output
	$html_string .= "\n <div id=\"slider-pro-" . $sp_unique_id . "\">";
	
	
	foreach($slides as $slide) {
		$slide_content = $slide['content'];
		
		$align = $slide['settings']['align_type_override'] ? $sp_timthumb_align[$slide['settings']['align_type']] : $sp_timthumb_align[$slider_settings['align_type']];
		
		$timthumb_image_path = get_option('slider_pro_enable_timthumb') ? 
		esc_attr(plugins_url('/slider-pro/includes/timthumb/timthumb.php')."?q=100&w=".$slider_settings['width']."&h=".$slider_settings['height'].'&a='.$align."&src=") : '';
		
		$timthumb_thumbnails_path = get_option('slider_pro_enable_timthumb') ? 
		esc_attr(plugins_url('/slider-pro/includes/timthumb/timthumb.php') ."?q=100&w=".$slider_settings['thumbnail_width']."&h=".$slider_settings['thumbnail_height'].'&a='.$align."&src=") : '';
		
		$html_string .= "\n      <div class=\"slider-item\">";
		
		if ($slide_content['link'] != "")
			$html_string .= "\n           <a href=\"" . $slide_content['link'] . "\">";
		
		if ($slide_content['image'] != "") {
			$html_string .= "\n           <img src=\"". $timthumb_image_path . $slide_content['image'] . "\"" . " alt=\"" . $slide_content['alt'] . "\"" . "/>";
		}
		
		if ($slide_content['link'] != "")
			$html_string .= "\n           </a>";
		
		if ($slide_content['caption'] != "")
			$html_string .= "\n           <div class=\"caption\">" . html_entity_decode(stripslashes($slide_content['caption'])) . "</div>";
			
		if ($slide_content['html'] != "")
			$html_string .= "\n           <div class=\"html\">" . html_entity_decode(stripslashes($slide_content['html'])) . "</div>";
		
		if ($slider_settings['thumbnails_type'] != 'none') {
			$thumbnail_path = $slide_content['thumbnail_image'] ? $slide_content['thumbnail_image'] : $slide_content['image'];
			
			$html_string .= "\n           <img class=\"thumbnail\" src=\"". $timthumb_thumbnails_path . $thumbnail_path . "\" alt=\"" . $slide_content['thumbnail_alt'] . "\" title=\"" . stripslashes($slide_content['thumbnail_caption']) . "\"/>";
				
			if ($slide_content['thumbnail_tooltip'] != "")
				$html_string .= "\n           <div class=\"thumbnailTooltip\">" . stripslashes($slide_content['thumbnail_tooltip']) . "</div>";
		}
		
		if ($slide_content['lightbox_content'] != "") {
			$html_string .= "\n           <a class=\"lightbox\" href=\"". esc_attr($slide_content['lightbox_content']) ."\" title=\"" . html_entity_decode(stripslashes($slide_content['lightbox_description'])) . "\">" . $slide_content['lightbox_title'] . "</a>";
		}
		
		$html_string .= "\n      </div>";
	}
	
	$html_string .= "\n </div>";
	
	return $html_string;
}


/**
* Shortcode used to create the slider
*/
function slider_pro_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
				'id' => '-1',
	), $atts));	
	
	return slider_pro($id, $atts, $content);		
}



/**
* Shortcode used to create a slide
*/
function slider_pro_slide_shortcode($atts, $content = null) {
	global $sp_default_slide_settings;
	
	// merge the specified values with the default ones
	$attributes = array_merge($sp_default_slide_settings, array('index' => 'end'));
	
	// if any setting was specified add it to a list
	// and mark it to override the global setting
	if($atts) {
		foreach($atts as $key => $value) {
			$attributes[$key] = $value;
			
			if ($key != 'index')
				$attributes[$key.'_override'] = true;
		}
	}
	
	$slide = array();
	
	$slide_content = do_shortcode($content);	
	$slide_content = str_replace('<br />', '', $slide_content);	
	$slide_content_elements = explode('%sp_sep%', $slide_content);
	
	
	// get the content of the slide
	foreach($slide_content_elements as $element) {
		$element = unserialize(trim($element));		
		
		if ($element)
			foreach($element as $key => $value)
				$slide['content'][$key] = $value;
	}
	
	$settings = array();
	
	// get the slide's settings
	foreach($attributes as $key => $value)
		$settings[$key] = $value;		
	
	$slide['settings'] = $settings;
	
	return serialize($slide) . '%sp_sep%';
}


/**
* Shortcode used to create a slide element (like HTML content, caption, tooltip, tooltip caption)
*/
function slider_pro_element_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('type' => 'none'), $atts));
	
	$content = do_shortcode($content);
	
	return serialize(array($type => $content)) . '%sp_sep%';
}


/**
* Customize the TinyMCE editor to display only certain buttons
*/
function sp_customize_tiny_mce($settings) {
	//$settings['plugins'] = "inlinepopups,spellchecker,paste,wordpress,fullscreen,wpeditimage,wpgallery,tabfocus,wpdialogs";
	$settings['theme_advanced_buttons1'] = "bold,italic,underline,strikethrough,|,bullist,numlist,blockquote,|,removeformat,|,link,unlink,|,image,charmap,|,undo,redo,|,wp_adv,code";
	$settings['theme_advanced_buttons2'] = "formatselect,fontselect,fontsizeselect,forecolor,backcolor,|,pastetext,pasteword,outdent,indent";
	$settings['extended_valid_elements'] = "iframe[src|class|width|height|name|align|frameborder],script[type|src]";
	
	$settings['apply_source_formatting'] = true;
	//$settings['force_p_newlines'] = false;
	//$settings['force_br_newlines'] = true;
	
	return $settings;
}


/**
* Get the javascript name of the setting
*/
function sp_get_js_property_name($raw_name) {
	global $sp_js_properties;
	
	return $sp_js_properties[$raw_name];
}


/**
* Get the javascript value of the setting
*/
function sp_get_js_property_value($raw_value) {
	$value;
	
	if (is_numeric($raw_value) || $raw_value == 'true' || $raw_value == 'false')
		$value = $raw_value;
	else
		$value = "'" . $raw_value . "'";
	
	return $value;
}


/**
* Read all the files from the 'skin' directory, create a skin object containing 
* all the information of the skin and store all the skin objects in an array
*/
function sp_get_skins($type) {
	$skins = array();
	
	$skins_path = WP_PLUGIN_DIR . '/slider-pro/skins/' . $type;
	$skins_directory = opendir($skins_path);
	
	while (($file = readdir($skins_directory)) !== false) {
		if (preg_match('|^\.+$|', $file))
			continue;
					
		if (is_dir($skins_path . '/' . $file)) {
			$skin_dir_name = $file;
			$skin_dir_path = $skins_path . '/' . $skin_dir_name;
			$skin_dir = opendir($skin_dir_path);
			if ($skin_dir) {
				while (($file = readdir($skin_dir)) !== false) {
					if (preg_match('|^\.+$|', $file))
						continue;
						
					if (preg_match('|\.css$|', $file)) {
						$skin = sp_get_skin_meta($skin_dir_path . '/' . $file);
						$skin['url'] = plugins_url('slider-pro/skins/' . $type . '/' . $skin_dir_name . '/' . $file);
						$skin['dir'] = $skins_path . '/' . $skin_dir_name . '/' . $file;
						
						array_push($skins, $skin);
					}
				}
			}
		}
	}
	
	return $skins;
}


/**
* Get the header date specified in a file
*/
function sp_get_skin_meta($file) {
	$default_headers = array(
		'Skin Name' => 'Skin Name',
		'Class' => 'Class',
		'Description' => 'Description',
		'Author' => 'Author',
		);
	
	return get_file_data($file, $default_headers);	
}


/**
* Get a skin by it's class
*/
function sp_get_skin_by_class($name) {
	global $sp_all_skins;
	
	foreach ($sp_all_skins as $skin)
		if ($skin['Class'] == $name)
			return $skin;
}


/**
* Get all the skins used by all the sliders created
*/
function sp_get_all_skins_used() {
	$skins = array();
	
	global $wpdb;
	$prefix = $wpdb->prefix;
	$slider_settings = $wpdb->get_results("SELECT settings FROM " . $prefix . "sp_sliders", ARRAY_A);
	
	if ($slider_settings)
		foreach($slider_settings as $raw_settings) {
			$settings = unserialize($raw_settings['settings']);
			$main_skin = $settings['skin'];
			$scrollbar_skin = $settings['scrollbar_skin'];
			
			if (!in_array($main_skin, $skins))
				array_push($skins, $main_skin);
				
			if (!in_array($scrollbar_skin, $skins))
				array_push($skins, $scrollbar_skin);
		}
	return $skins;
}


function sp_register_widgets() {
	register_widget('Slider_Pro_Widget');
}


/**
* Create the Slider PRO widget
*/
class Slider_Pro_Widget extends WP_Widget {
	
	function Slider_Pro_Widget() {
		
		$widget_opts = array(
			'classname' => 'slider-pro-widget',
			'description' => 'Display a Slider PRO instance in the widgets area.'
		);
		
		$this->WP_Widget('slider-pro-widget', 'Slider PRO', $widget_opts);
	}
	
	
	// create the admin interface
	function form($instance) {
		$instance = wp_parse_args( (array)$instance, array('slider_id' => ''));
		
		$slider_id = strip_tags($instance['slider_id']);
		
		include('includes/widget-form.php');
	}
	
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;		
		$instance['slider_id'] = strip_tags($new_instance['slider_id']);
		return $instance;
	}
	
	
	// create the public view output
	function widget($args, $instance) {   
		extract($args, EXTR_SKIP);
		
		echo $before_widget;
		echo slider_pro($instance['slider_id']);
		echo $after_widget;
	}
}
?>