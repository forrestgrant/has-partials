<?

/**
 * @package Has-Partials
 * @author Forrest Grant
 * @version 1.0
 */
/*
Plugin Name: Has Partials
Plugin URI: https://github.com/forrestgrant/has-partials
Description: This plugin adds the ability for partials on any page
Author: Forrest Grant
Version: 1.0
Author URI: http://www.forrestgrant.com/
*/

add_filter('the_content', 'add_partials');

function add_partials($content) {
	preg_match_all("/\[has_partial *[a-zA-Z0-9_%+-]+.php\]/i", $content, $partials);
	foreach($partials[0] as $partial) {
		preg_match("/[a-zA-Z0-9_%+-]+.php/i", $partial, $php_files);
		if($php_files[0]) {
			$text = file_get_contents(getcwd() . "/wp-content/plugins/has-partials/partials/$php_files[0]");
			ob_start();
			eval("?>$text<?php ");
			$result = ob_get_clean();
			$content = str_replace("[has_partial $php_files[0]]", $result, $content);
		}
	}
	return $content;
}

/***************************
* 
* 	Add TinyMCE buttons (WP 2.5+)
*
*/

add_action('init', 'has_partials_addbuttons');

function has_partials_addbuttons() {
   // Don't bother doing this stuff if the current user lacks permissions
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
 
   // Add only in Rich Editor mode
   if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "add_has_partials_tinymce_plugin");
		add_filter('mce_buttons', 'register_has_partials_button');
   }
}
 
function register_has_partials_button($buttons) {
   array_push($buttons, "separator", "partial","relatedratings");
   return $buttons;
}
function the_plugin_url () {
	if ( function_exists('plugin_url') )
		$plugin_url = plugin_url();
	else
		$plugin_url = get_option('siteurl') . '/wp-content/plugins/' . plugin_basename(dirname(__FILE__));

	return $plugin_url;
}
function add_has_partials_tinymce_plugin($plugin_array) {
	
	$plugin_array['ratings_mce'] = the_plugin_url().'/tinymce/editor_plugin.js';
	return $plugin_array;
}


// Insertion scripts
function has_partials_admin_scripts() {
	wp_register_script('has_partials_admin_scripts', the_plugin_url() . '/has-partials.js');
	wp_enqueue_script('has_partials_admin_scripts');
}    
if (is_admin()) {
	add_action('init', has_partials_admin_scripts);
}



// Quicktags
function has_partials_quicktags(){
	$buttonshtml = '<input type="button" class="ed_button" onclick="" title="' . __('Insert a partial','has-partials') . '" value="' . __('partial','has-partials') . '" />';
	?>
	<script type="text/javascript" charset="utf-8">
	// <![CDATA[
	   (function(){
		  if (typeof jQuery === 'undefined') {
			 return;
		  }
		  jQuery(document).ready(function(){
			 jQuery("#ed_toolbar").append('<?php echo $buttonshtml; ?>');
		  });
	   }());
	// ]]>
	</script>
	<?php
}
add_action('edit_page_form', 'has_partials_quicktags');
add_action('edit_form_advanced', 'has_partials_quicktags');
?>