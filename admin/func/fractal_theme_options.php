<?php
/**
 * ----------------------------------------------------------------------------------------
 * Fractal Options Menu Page
 * ----------------------------------------------------------------------------------------
 */
function fractal_options() {
	add_menu_page( __('Fractal Options', 'fractal'), __('Fractal Options', 'fractal'), 'manage_options', 'fractal_options_page', 'display_fractal_options_page', 'dashicons-admin-generic' );
}
function display_fractal_options_page() {
	?>
	<div class="wrap">
		<h2><?php _e('Fractal options', 'fractal'); ?></h2>
		<form method="post" action="options.php" enctype="multipart/form-data">
			<?php settings_fields( 'fractal_options_page' ); ?>
			<?php do_settings_sections( __FILE__ ); ?>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

function initialize_fractal_options() {


	add_settings_section( 'main_social_section', __('Social Media Settings', 'fractal'), function() {}, __FILE__ );
	add_settings_section( 'contact_data_section', __('Contact Data', 'fractal'), function() {}, __FILE__ );
	add_settings_section( 'fractal_theme_settings', __('Theme Settings', 'fractal'), function() {}, __FILE__ );


	add_settings_field( 'facebook_link', __('Facebook profile: ', 'fractal'), function() { $options = get_option( 'fractal_options' );
		?><input type="text" name="fractal_options[facebook]" value="<?php echo isset($options['facebook']) ? $options['facebook'] : ''; ?>" size="60"><br>
		<input class="meta_image_url" value="" type="text" name="gallery[image_url][]" />
		<input class="button" type="button" value="Choose Icon" onclick="add_fractal_social_icon(this)" />
		<?php
	}, __FILE__, 'main_social_section' );
	add_settings_field( 'twitter_link', __('Twitter profile: ', 'fractal'), function() { $options = get_option( 'fractal_options' );
		?><input type="text" name="fractal_options[twitter]" value="<?php echo isset($options['twitter']) ? $options['twitter'] : ''; ?>" size="60"><?php
	}, __FILE__, 'main_social_section' );
	add_settings_field( 'linked_in_link', __('LinkedIn profile: ', 'fractal'), function() { $options = get_option( 'fractal_options' );
		?><input type="text" name="fractal_options[linked_in]" value="<?php echo isset($options['linked_in']) ? $options['linked_in'] : ''; ?>" size="60"><?php
	}, __FILE__, 'main_social_section' );
	add_settings_field( 'google_plus_link', __('Google+ profile: ', 'fractal'), function() { $options = get_option( 'fractal_options' );
		?><input type="text" name="fractal_options[google_plus]" value="<?php echo isset($options['google_plus']) ? $options['google_plus'] : ''; ?>" size="60"><?php
	}, __FILE__, 'main_social_section' );


	add_settings_field( 'fractal_phone_data', __('Phone: ', 'fractal'), function() { $options = get_option( 'fractal_options' );
		?><input type="text" name="fractal_options[phone]" value="<?php echo isset($options['phone']) ? $options['phone'] : ''; ?>" size="40"><?php
	}, __FILE__, 'contact_data_section' );
	add_settings_field( 'fractal_email_data', __('Email: ', 'fractal'), function() { $options = get_option( 'fractal_options' );
		?><input type="text" name="fractal_options[email]" value="<?php echo isset($options['email']) ? $options['email'] : ''; ?>" size="40"><?php
	}, __FILE__, 'contact_data_section' );
	add_settings_field( 'fractal_address_data', __('Address: ', 'fractal'), function() { $options = get_option( 'fractal_options' );
		?><input type="text" name="fractal_options[address]" value="<?php echo isset($options['address']) ? $options['address'] : ''; ?>" size="60"><?php
	}, __FILE__, 'contact_data_section' );
	add_settings_field( 'fractal_how_to_get_data', __('How to get: ', 'fractal'), function() { $options = get_option( 'fractal_options' );
		?><textarea name="fractal_options[how_to_get]" cols="60"><?php echo isset($options['how_to_get']) ? $options['how_to_get'] : ''; ?></textarea><?php
	}, __FILE__, 'contact_data_section' );


	add_settings_field( 'contactform_background_image', __('Contactform Background: ', 'fractal'), function() { $options = get_option( 'fractal_options' );
		?><input type="file" id="contactform_background_image" name="contactform_background_image" size="25" /><br>
		<input type="text" name="fractal_options[contactform_background_image]" value="<?php echo $options['contactform_background_image']; ?>" size="80"><br>
		<img src="<?php echo $options['contactform_background_image']; ?>" alt='...' width="250"><?php
	}, __FILE__, 'fractal_theme_settings' );
	add_settings_field( 'special_offer_status', __('Enable Special Offer: ', 'fractal'), function() { $options = get_option( 'fractal_options' );
		?><input type="checkbox" name="fractal_options[special_offer]" <?php echo (isset($options['special_offer']) && $options['special_offer']) ? 'checked' : ''; ?>><?php
	}, __FILE__, 'fractal_theme_settings' );


	register_setting( 'fractal_options_page', 'fractal_options', 'fractal_validate' );

}

// Sanitize URLs to add to database
function fractal_validate($options) {
	// $links = [];
	// foreach ($url as $key => $link) {
	// 	$links[$key] = esc_url_raw($link);
	// }
	// return $links;
	if ( !empty($_FILES['contactform_background_image']['tmp_name']) ) {
		$override = array('test_form' => false);
		$file = wp_handle_upload($_FILES['contactform_background_image'], $override);
		$options['contactform_background_image'] = $file['url'];
	} else {
		// $options['contactform_background_image'] = $options['contactform_background_image'];
	}
	return $options;
}

function fractal_options_scripts() {

	// <script>
	// function add_fractal_social_icon(obj) {
 //      var parent=jQuery(obj).parent().parent('div.field_row');
 //      var inputField = jQuery(parent).find("input.meta_image_url");

 //      tb_show('', 'media-upload.php?TB_iframe=true');

 //      window.send_to_editor = function(html) {
 //        var url = jQuery(html).find('img').attr('src');
 //        inputField.val(url);
 //        jQuery(parent)
 //        .find("div.image_wrap")
 //        .html('<img src="'+url+'" height="48" width="48" />');

 //        tb_remove();
 //      };

 //      return false;
 //    }
	// </script>
}

add_action( 'admin_menu', 'fractal_options_scripts' );
add_action( 'admin_menu', 'fractal_options' );
add_action( 'admin_init', 'initialize_fractal_options' );

