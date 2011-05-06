<?php
// look up for the path
require_once( dirname( dirname( dirname(__FILE__) ) ) . '/has-partials/config.php');

// check for rights
//if ( !current_user_can('edit_pages') && !current_user_can('edit_posts') ) 
	//wp_die(__("You are not allowed to be here"));

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Insert a Partial</title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-content/plugins/has-partials/tinymce/has-partials.js"></script>
	<base target="_self" />
</head>
<body id="link">
<!-- <form onsubmit="insertLink();return false;" action="#"> -->
	<form name="HasPartials" action="#">
	
		<table border="0" cellpadding="4" cellspacing="0">
         <tr>
            <td nowrap="nowrap"><label for="partial"><?php _e("Select Partial", 'haspartials'); ?></label></td>
            <td><select id="partial" name="partial" style="width: 200px">
				<?php
				
					$handle = opendir(getcwd() . "/../partials");
					while (false !== ($file = readdir($handle))) {
						if(($file == ".") || ($file == "..")) {
						} else {
							echo '<option value="' . $file . '" >' . $file . '</option>' . "\n";
						}
					}
				?>
            </select></td>
          </tr>
        </table>
        
	<div class="mceActionPanel">
		<div style="float: left">
			<input type="button" id="cancel" name="cancel" value="<?php _e("Cancel", 'haspartials'); ?>" onclick="tinyMCEPopup.close();" />
		</div>

		<div style="float: left">
			<input type="submit" id="insert" name="insert" value="<?php _e("Insert", 'haspartials'); ?>" onclick="insertPartialCode();" />
		</div>
	</div>
</form>
</body>
</html>
