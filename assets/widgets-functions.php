<?php
// Widgets Functions

/*-----------------------------------------------------------------------------------*/
/*	- Widgets
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'uwl_custom_widgets' ) ) {
	function uwl_custom_widgets() {

		// Define array of custom widgets
		$widgets = array(
			'about-me',
			'contact-info',
			'flickr',
			'mailchimp',
			'menu',
		);

		// Apply filters so you can remove custom widgets via a child theme if wanted
		$widgets = apply_filters( 'custom_widgets', $widgets );

		// Loop through widgets and load their files
		foreach ( $widgets as $widget ) {
			$widget_file = UWL_PLUGIN_DIR .'/widgets/widget-'. $widget .'.php';
			if ( file_exists( $widget_file ) ) {
				require_once( $widget_file );
			}
		}

	}
}

/*-----------------------------------------------------------------------------------*/
/*	- Register Widgets
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'register_uwl_widgets' ) ) {
	function register_uwl_widgets() {

		if ( '1' == uw_option( 'about-me', '1' ) ) {
		    register_widget('uw_about_me');
		}
		if ( '1' == uwl_option( 'about-me', '1' ) ) {
		    register_widget('uwl_about_me');
		}
		if ( '1' == uwl_option( 'contact-info', '1' ) ) {
		    register_widget('uwl_contact_info');
		}
		if ( '1' == uwl_option( 'flickr', '1' ) ) {
		    register_widget('uwl_flickr');
		}
		if ( '1' == uwl_option( 'mailchimp', '1' ) ) {
		    register_widget('uwl_mailchimp');
		}
		if ( '1' == uwl_option( 'menu', '1' ) ) {
		    register_widget('uwl_menu');
		}

	}
}
add_action('widgets_init', 'register_uwl_widgets');