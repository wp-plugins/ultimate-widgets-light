<?php
// Widgets Functions

/*-----------------------------------------------------------------------------------*/
/*	- Unregister Widgets
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'unregister_uwl_widgets' ) ) {
	function unregister_uwl_widgets() {

		if ( '0' == uwl_option( 'about-me', '1' ) ) {
		    unregister_widget('uwl_about_me');
		}
		if ( '0' == uwl_option( 'contact-info', '1' ) ) {
		    unregister_widget('uwl_contact_info');
		}
		if ( '0' == uwl_option( 'flickr', '1' ) ) {
		    unregister_widget('uwl_flickr');
		}
		if ( '0' == uwl_option( 'mailchimp', '1' ) ) {
		    unregister_widget('uwl_mailchimp');
		}
		if ( '0' == uwl_option( 'menu', '1' ) ) {
		    unregister_widget('uwl_menu');
		}
	}
}
add_action('widgets_init', 'unregister_uwl_widgets', 99);