<?php
/**
 * Menu Widget
*/
class uwl_menu extends WP_Widget {
	function uwl_menu() {
		
		// define widget title and description
		$widget_ops = array(
			'classname'		=> 'uwl_widget_wrap uwl_menu_widget',
			'description'	=> __( 'Displays a menu.', 'kho' )
		);
		// register the widget
		$this->WP_Widget('uwl_menu', __( 'UWL - Menu', 'kho' ), $widget_ops);
	
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {
		extract($args);
		$title 		= apply_filters('widget_title', $instance['title']);
		$class_wrap = isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$nav_menu 	= $instance['nav_menu'];

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

		if($nav_menu != '0') {
			echo $before_widget;
				if($title) { ?>
					<h3 class="uwl-title">
						<span><?php echo esc_attr( $title ); ?></span>
					</h3>
				<?php } ?>

				<ul>
					<?php wp_nav_menu( array(
						'menu'				=> $nav_menu,
						'container'       	=> false,
						'fallback_cb'		=> false,
						'items_wrap'      	=> '%3$s',
						'depth'           	=> 0,
						'walker'          	=> new UWL_Dropdown_Walker_Nav_Menu()
					)); ?>
				</ul>
			<?php
			echo $after_widget;
		}
	}

	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance ) {
		$instance 				= $old_instance;
		$instance['title'] 		= strip_tags($new_instance['title']);
		$instance['class_wrap'] = strip_tags($new_instance['class_wrap']);
		$instance['nav_menu'] 	= (int)$new_instance['nav_menu'];
		return $instance;
	}

	/** @see WP_Widget::form */
	function form( $instance ) {
		$title 		= isset( $instance['title'] ) ? $instance['title'] : __('Menu','kho');
		$class_wrap = isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$nav_menu 	= isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		// Get menus
		$menus = wp_get_nav_menus(); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('class_wrap'); ?>"><?php _e('Class Wrap (optional):', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('class_wrap'); ?>" name="<?php echo $this->get_field_name('class_wrap'); ?>" type="text" value="<?php echo esc_attr($class_wrap); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e( 'Menu:', 'kho' ); ?></label>
			<select class='uwl-widget-select widefat' name="<?php echo $this->get_field_name('nav_menu'); ?>" id="<?php echo $this->get_field_id('nav_menu'); ?>">
				<option value="0"><?php _e( '&mdash; Select &mdash;' ) ?></option>
					<?php foreach ( $menus as $menu ) {
							echo '<option value="' . $menu->term_id . '"'
								. selected( $nav_menu, $menu->term_id, false )
								. '>'. esc_html( $menu->name ) . '</option>';
						} ?>
			</select>
		</p>
		
	<?php
	}
}

// Register the Menu widget
if ( ! function_exists( 'register_uwl_menu' ) ) {
    function register_uwl_menu() {
        register_widget( 'uwl_menu' );
    }
}
add_action( 'widgets_init', 'register_uwl_menu' );