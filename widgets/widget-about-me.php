<?php
/**
 * About Me Widget
*/
class uwl_about_me extends WP_Widget {
	
	function uwl_about_me() {

		// define widget title and description
		$widget_ops = array(
			'classname'		=> 'uwl_widget_wrap uwl_about_me_widget',
			'description'	=> __( 'Adds a About Me widget.', 'kho' )
		);
		// register the widget
		$this->WP_Widget('uwl_about_me', __( 'UWL - About Me', 'kho' ), $widget_ops);
	
	}

	function widget($args, $instance) {
		extract($args);
		$title 				= apply_filters('widget_title', $instance['title']);
		$class_wrap 		= isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$background 		= $instance['background'];
		$color 				= $instance['color'];
		$border_color 		= $instance['border_color'];
		$img_header 		= $instance['img_header'];
		$img_avatar 		= $instance['img_avatar'];
		$name 				= $instance['name'];
		$text 				= $instance['text'];
		$social_style 		= $instance['social_style'];
		$target 			= $instance['target'];
		$social_services 	= $instance['social_services'];

		// Class wrap
		if ( '' != $class_wrap ) {
      		$class_widget = $class_wrap;
		} else {
      		$class_widget = uwl_option('widgets_style', 'style1');
		}

		// no 'class' attribute
		if( strpos($before_widget, 'class') === false ) {
			$before_widget = str_replace('>', 'class="'. $class_widget . '"', $before_widget);
		}
		// there is 'class' attribute
		else {
			$before_widget = str_replace('class="', 'class="'. $class_widget . ' ', $before_widget);
		}

		echo $before_widget;
			if($title) { ?>
				<h3 class="uwl-title">
					<span><?php echo esc_attr( $title ); ?></span>
				</h3>
			<?php }
			
			// ADD Style
			if ( '' != $background ) {
				$background = 'style=background:'. $background .';';
			}
			if ( '' != $color ) {
				$color = 'style=color:'. $color .';';
			}
			if ( '' != $border_color ) {
				$border_color = 'style=border-color:'. $border_color .';';
			} ?>
			<div class="about-me" <?php echo esc_attr( $background ); ?>>
				<?php if ( $img_header ) { ?>
					<img src="<?php echo esc_url( $img_header ); ?>" class="about-me-banner" alt="">
				<?php } ?>
				<div class="about-me-header clr">
					<?php if ( $img_avatar ) { ?>
						<img src="<?php echo esc_url( $img_avatar ); ?>" class="about-me-avatar" alt="" <?php echo esc_attr( $border_color ); ?>>
					<?php } ?>
					<?php if ( $name ) { ?>
						<h3 class="about-me-name" <?php echo esc_attr( $color ); ?>><?php echo esc_attr( $name ); ?></h3>
					<?php } ?>
				</div>
				<?php if ( $text ) { ?>
					<div class="about-me-text clr" <?php echo esc_attr( $color ); ?>><?php echo esc_attr( $text ); ?></div>
				<?php } ?>
				<?php if ( $social_services ) { ?>
					<ul class="uwl-ul about-me-social style-<?php echo esc_attr( $social_style ); ?>">
						<?php
						// Loop through each social service and display font icon
						foreach( $social_services as $key => $service ) {
							$link = !empty( $service['url'] ) ? $service['url'] : null;
							$social_name = $service['name'];
							if ( $link ) {
								if ( 'youtube' == $key ) {
									$key = 'youtube-play';
								}
								echo '<li class="'. esc_attr( $key ) .'"><a href="'. esc_url( $link ) .'" title="'. esc_attr( $social_name ) .'" target="_'.esc_attr( $target ).'"><i class="fa fa-'. esc_attr( $key ) .'"></i></a></li>';
							}
						} ?>
					</ul>
				<?php } ?>
			</div>
		<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['class_wrap'] 		= strip_tags( $new_instance['class_wrap'] );
		$instance['background'] 		= $new_instance['background'];
		$instance['color'] 				= $new_instance['color'];
		$instance['border_color'] 		= $new_instance['border_color'];
		$instance['img_header'] 		= $new_instance['img_header'];
		$instance['img_avatar'] 		= $new_instance['img_avatar'];
		$instance['name'] 				= $new_instance['name'];
		$instance['text'] 				= $new_instance['text'];
		$instance['social_style'] 		= $new_instance['social_style'];
		$instance['target'] 			= $new_instance['target'];
		$instance['social_services'] 	= $new_instance['social_services'];

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args((array) $instance, array(
			'title'				=> __('About Me','kho'),
			'class_wrap'		=> '',
			'background'		=> '',
			'color'				=> '',
			'border_color'		=> '',
			'img_header'		=> plugins_url( 'assets/images/about-header.png', dirname(__FILE__) ),
			'img_avatar'		=> plugins_url( 'assets/images/about-avatar.png', dirname(__FILE__) ),
			'name'				=> 'John Doe',
			'text'				=> 'Lorem ipsum ex vix illud nonummy novumtatio et his. At vix patrioque scribentur at fugitertissi ext scriptaset verterem molestiae.',
			'social_style' 		=> 'color',
			'target' 			=> 'blank',
			'social_services'	=> array(
				'facebook'		=> array(
					'name'		=> 'Facebook',
					'url'		=> ''
				),
				'google-plus'	=> array(
					'name'		=> 'GooglePlus',
					'url'		=> ''
				),
				'instagram'		=> array(
					'name'		=> 'Instagram',
					'url'		=> ''
				),
				'linkedin' 		=> array(
					'name'		=> 'LinkedIn',
					'url'		=> ''
				),
				'pinterest' 	=> array(
					'name'		=> 'Pinterest',
					'url'		=> ''
				),
				'twitter' 		=> array(
					'name'		=> 'Twitter',
					'url'		=> ''
				),
				'youtube' 		=> array(
					'name'		=> 'Youtube',
					'url'		=> ''
				),	
			),
		)); ?>

		<script type="text/javascript" >
            jQuery(document).ready(function($) {
                $(document).ajaxSuccess(function(e, xhr, settings) {
                    var widget_id_base = 'uwl_about_me';
                    if(settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=' + widget_id_base) != -1) {
                        uwlAboutSortServices();
                    }
                });
                function uwlAboutSortServices() {
                    $('.uwl-services-list').each( function() {
                        var id = $(this).attr('id');
                        $('#'+ id).sortable({
                            placeholder: "placeholder",
                            opacity: 0.6
                        });
                    });
                }
                uwlAboutSortServices();
            });
        </script>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'kho'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('class_wrap'); ?>"><?php _e('Class Wrap (optional):', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('class_wrap'); ?>" name="<?php echo $this->get_field_name('class_wrap'); ?>" type="text" value="<?php echo $instance['class_wrap']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('background'); ?>"><?php _e('Background Color:', 'kho'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('background'); ?>" name="<?php echo $this->get_field_name('background'); ?>" value="<?php echo $instance['background']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Text Color:', 'kho'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('color'); ?>" value="<?php echo $instance['color']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('border_color'); ?>"><?php _e('Avatar Border Color:', 'kho'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('border_color'); ?>" name="<?php echo $this->get_field_name('border_color'); ?>" value="<?php echo $instance['border_color']; ?>" />
		</p>
		<p class="uwl-left">
		    <label for="<?php echo $this->get_field_id( 'img_header' ); ?>"><?php _e('Image Header:', 'kho') ?></label>
		    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'img_header' ); ?>" name="<?php echo $this->get_field_name( 'img_header' ); ?>" value="<?php echo $instance['img_header']; ?>" />
		</p>
		<p class="uwl-right">
		    <label for="<?php echo $this->get_field_id( 'img_avatar' ); ?>"><?php _e('Avatar:', 'kho') ?></label>
		    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'img_avatar' ); ?>" name="<?php echo $this->get_field_name( 'img_avatar' ); ?>" value="<?php echo $instance['img_avatar']; ?>" />
		</p>
		<p class="uwl-left">
			<label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Name:', 'kho'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" value="<?php echo $instance['name']; ?>" />
		</p>
		<p class="uwl-right">
			<label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:', 'kho'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" value="<?php echo $instance['text']; ?>" />
		</p>
		<p class="uwl-left">
			<label for="<?php echo $this->get_field_id('social_style'); ?>"><?php _e('Social Style:', 'kho'); ?></label>
			<br />
			<select class='uwl-widget-select widefat' name="<?php echo $this->get_field_name('social_style'); ?>" id="<?php echo $this->get_field_id('social_style'); ?>">
				<option value="color" <?php if($instance['social_style'] == 'color') { ?>selected="selected"<?php } ?>><?php _e( 'Color', 'kho' ); ?></option>				
				<option value="light" <?php if($instance['social_style'] == 'light') { ?>selected="selected"<?php } ?>><?php _e( 'Light', 'kho' ); ?></option>
				<option value="dark" <?php if($instance['social_style'] == 'dark') { ?>selected="selected"<?php } ?>><?php _e( 'Dark', 'kho' ); ?></option>
			</select>
		</p>
		<p class="uwl-right">
			<label for="<?php echo $this->get_field_id('target'); ?>"><?php _e( 'Social Link Target:', 'kho' ); ?></label>
			<br />
			<select class='uwl-widget-select widefat' name="<?php echo $this->get_field_name('target'); ?>" id="<?php echo $this->get_field_id('target'); ?>">
				<option value="blank" <?php if($instance['target'] == 'blank') { ?>selected="selected"<?php } ?>><?php _e( 'Blank', 'kho' ); ?></option>
				<option value="self" <?php if($instance['target'] == 'self') { ?>selected="selected"<?php } ?>><?php _e( 'Self', 'kho'); ?></option>
			</select>
		</p>
		<h3 style="margin-top:20px;margin-bottom:5px;"><?php _e( 'Social Links','kho' ); ?></h3>  
		<small style="display:block;margin-bottom:10px;"><?php _e('Enter the full URL to your social profile','kho'); ?></small>
		<ul id="<?php echo $this->get_field_id( 'social_services' ); ?>" class="uwl-services-list">
			<input type="hidden" id="<?php echo $this->get_field_name( 'social_services' ); ?>" value="<?php echo $this->get_field_name( 'social_services' ); ?>">
			<input type="hidden" id="<?php echo wp_create_nonce('uwl_about_me_nonce'); ?>">
			<?php
			$social_services = $instance['social_services'];
			foreach( $social_services as $key => $service ) {
				$url=0;
				if(isset($service['url'])) $url = $service['url'];
				if(isset($service['name'])) $name = $service['name']; ?>
				<li id="<?php echo $this->get_field_id( $service ); ?>_0<?php echo $key ?>">
					<p>
						<label for="<?php echo $this->get_field_id( 'social_services' ); ?>-<?php echo $key ?>-name"><?php echo $name; ?>:</label>
						<input type="hidden" id="<?php echo $this->get_field_id( 'social_services' ); ?>-<?php echo $key ?>-url" name="<?php echo $this->get_field_name( 'social_services' ).'['.$key.'][name]'; ?>" value="<?php echo $name; ?>">
						<input type="url" class="widefat" id="<?php echo $this->get_field_id( 'social_services' ); ?>-<?php echo $key ?>-url" name="<?php echo $this->get_field_name( 'social_services' ).'['.$key.'][url]'; ?>" value="<?php echo $url; ?>" />
					</p>
				</li>
			<?php } ?>
		</ul>
	<?php
	}
}

// Register the About Me widget
if ( ! function_exists( 'register_uwl_about_me' ) ) {
    function register_uwl_about_me() {
        register_widget( 'uwl_about_me' );
    }
}
add_action( 'widgets_init', 'register_uwl_about_me' );