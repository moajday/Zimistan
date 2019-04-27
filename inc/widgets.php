<?php
/**
 * Custom widgets for this theme.
 *
 * @package Zimistan
 */

/**
 * Profile widget class
 * This class is based on code from WordPress core.
 */
class Write_Widget_Profile extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'widget_write_profile', 'description' => esc_html__( 'Displays a profile with a photo and social media links.', 'write' ));
		parent::__construct('write_profile', esc_html__( 'Write Profile', 'write' ), $widget_ops);
	}

	public function widget( $args, $instance ) {
		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$profile = empty( $instance['profile'] ) ? '' : $instance['profile'];
		$name = empty( $instance['name'] ) ? '' : $instance['name'];
		$text = empty( $instance['text'] ) ? '' : $instance['text'];
		$social_1 = empty( $instance['social_1'] ) ? '' : $instance['social_1'];
		$social_2 = empty( $instance['social_2'] ) ? '' : $instance['social_2'];
		$social_3 = empty( $instance['social_3'] ) ? '' : $instance['social_3'];
		$social_4 = empty( $instance['social_4'] ) ? '' : $instance['social_4'];
		$social_5 = empty( $instance['social_5'] ) ? '' : $instance['social_5'];
		$social_6 = empty( $instance['social_6'] ) ? '' : $instance['social_6'];
		$social_7 = empty( $instance['social_7'] ) ? '' : $instance['social_7'];
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<div class="profilewidget">
			<?php if ( $profile ): ?>
				<div class="profilewidget-profile"><img src="<?php echo esc_attr( $profile ); ?>" alt="<?php echo esc_attr( $name ); ?>" /></div>
			<?php endif; ?>
			<div class="profilewidget-meta">
				<div class="profilewidget-name"><strong><?php echo esc_html( $name ); ?></strong></div>
				<?php if ( $social_1 || $social_2 || $social_3 || $social_4 || $social_5 || $social_6 || $social_7 ): ?>
				<div class="profilewidget-link menu">
					<?php if ( $social_1 ): ?><a href="<?php echo esc_url( $social_1 ); ?>"></a><?php endif; ?>
					<?php if ( $social_2 ): ?><a href="<?php echo esc_url( $social_2 ); ?>"></a><?php endif; ?>
					<?php if ( $social_3 ): ?><a href="<?php echo esc_url( $social_3 ); ?>"></a><?php endif; ?>
					<?php if ( $social_4 ): ?><a href="<?php echo esc_url( $social_4 ); ?>"></a><?php endif; ?>
					<?php if ( $social_5 ): ?><a href="<?php echo esc_url( $social_5 ); ?>"></a><?php endif; ?>
					<?php if ( $social_6 ): ?><a href="<?php echo esc_url( $social_6 ); ?>"></a><?php endif; ?>
					<?php if ( $social_7 ): ?><a href="<?php echo esc_url( $social_7 ); ?>"></a><?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
			<div class="profilewidget-text"><?php echo wp_kses_post( $text ); ?></div>
		</div>
		<?php
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['profile'] = strip_tags($new_instance['profile']);
		$instance['name'] = strip_tags($new_instance['name']);
		$instance['social_1'] = strip_tags($new_instance['social_1']);
		$instance['social_2'] = strip_tags($new_instance['social_2']);
		$instance['social_3'] = strip_tags($new_instance['social_3']);
		$instance['social_4'] = strip_tags($new_instance['social_4']);
		$instance['social_5'] = strip_tags($new_instance['social_5']);
		$instance['social_6'] = strip_tags($new_instance['social_6']);
		$instance['social_7'] = strip_tags($new_instance['social_7']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'profile' => '', 'name' => '', 'text' => '', 'social_1' => '', 'social_2' => '', 'social_3' => '', 'social_4' => '', 'social_5' => '', 'social_6' => '', 'social_7' => '' ) );
		$title = strip_tags($instance['title']);
		$profile = strip_tags($instance['profile']);
		$name = strip_tags($instance['name']);
		$text = $instance['text'];
		$social_1 = strip_tags($instance['social_1']);
		$social_2 = strip_tags($instance['social_2']);
		$social_3 = strip_tags($instance['social_3']);
		$social_4 = strip_tags($instance['social_4']);
		$social_5 = strip_tags($instance['social_5']);
		$social_6 = strip_tags($instance['social_6']);
		$social_7 = strip_tags($instance['social_7']);
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e( 'Title:', 'write' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id('profile') ); ?>"><?php esc_html_e( 'Profile Image URL:', 'write' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('profile') ); ?>" name="<?php echo esc_attr( $this->get_field_name('profile') ); ?>" type="text" value="<?php echo esc_attr( $profile ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id('name') ); ?>"><?php esc_html_e( 'Name:', 'write' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('name') ); ?>" name="<?php echo esc_attr( $this->get_field_name('name') ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" /></p>

		<textarea class="widefat" rows="8" cols="20" id="<?php echo esc_attr( $this->get_field_id('text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('text') ); ?>"><?php echo esc_textarea( $text ); ?></textarea>

		<p><label for="<?php echo esc_attr( $this->get_field_id('social_1') ); ?>"><?php esc_html_e( 'Social Link 1:', 'write' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('social_1') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social_1') ); ?>" type="text" value="<?php echo esc_url( $social_1 ); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('social_2') ); ?>"><?php esc_html_e( 'Social Link 2:', 'write' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('social_2') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social_2') ); ?>" type="text" value="<?php echo esc_url( $social_2 ); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('social_3') ); ?>"><?php esc_html_e( 'Social Link 3:', 'write' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('social_3') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social_3') ); ?>" type="text" value="<?php echo esc_url( $social_3 ); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('social_4') ); ?>"><?php esc_html_e( 'Social Link 4:', 'write' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('social_4') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social_4') ); ?>" type="text" value="<?php echo esc_url( $social_4 ); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('social_5') ); ?>"><?php esc_html_e( 'Social Link 5:', 'write' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('social_5') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social_5') ); ?>" type="text" value="<?php echo esc_url( $social_5 ); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('social_6') ); ?>"><?php esc_html_e( 'Social Link 6:', 'write' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('social_6') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social_6') ); ?>" type="text" value="<?php echo esc_url( $social_6 ); ?>" /></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id('social_7') ); ?>"><?php esc_html_e( 'Social Link 7:', 'write' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('social_7') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social_7') ); ?>" type="text" value="<?php echo esc_url( $social_7 ); ?>" /></p>
	<?php
	}
}

/**
 * Register widgets
 */
function write_register_widgets() {
	register_widget( 'Write_Widget_Profile' );
}
add_action( 'widgets_init', 'write_register_widgets' );