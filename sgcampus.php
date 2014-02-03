<?php
   /*
   Plugin Name: SG Campus stuff
   Plugin URI: http://sgcampus.com.mx
   Description: Plugin for SG Campus specific stuff
   Version: 0.10
   Author: Pedro Galvan
   Author URI: http://sg.com.mx
   License: MIT
   */

add_action( 'init', 'create_post_type' );

function create_post_type() {
	register_post_type( 'webinar',
		array(
			'labels' => array(
				'name' => __( 'Webinars' ),
				'singular_name' => __( 'Webinar' )
			),
		'public' => true,
		'has_archive' => true,
		'taxonomies' => array( 'category', 'post_tag' ),
		'register_meta_box_cb' => 'add_webinar_metaboxes',
		)
	);
	register_taxonomy_for_object_type( 'category', 'webinar' );
	register_taxonomy_for_object_type( 'post_tag', 'webinar' );
}

function add_webinar_metaboxes() {
    add_meta_box('metabox-webinar-details', __('Detalles del Webinar', 'webinar'), 'sgcampus_metabox_webinar', 'webinar', 'normal', 'high');
}

function sgcampus_metabox_webinar($post) {
    $date = get_post_meta($post->ID, 'date', true);
    $time = get_post_meta($post->ID, 'time', true);
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#date_str').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'mm/dd/yy',
                altFormat: '@',
                altField: '#date'
            });
        });
    </script>
    <p>
        <label for="date"><?php _e('Date', 'sgcampus'); ?></label>
        <input type="text" id="date_str"  value="<?php echo!empty($date) ? date('m/d/Y', timestamp_fix($date)) : ''; ?>" />
        <input type="hidden" id="date" name="date" value="<?php echo($date); ?>" />
    </p>   
    <p>
        <label for="time"><?php _e('Start Time', 'sgcampus'); ?></label>
        <input type="text" id="time" name="time" value="<?php echo $time; ?>" />
        <span><?php _e('Format hh:mm', 'sgcampus'); ?></span>
    </p>
    <?php
}

add_action('save_post', 'sgcampus_save_post');

function sgcampus_save_post($id) {

    if (isset($_POST['date']))
        update_post_meta($id, 'date', $_POST['date']);

    if (isset($_POST['time']))
        update_post_meta($id, 'time', $_POST['time']);

}

?>
