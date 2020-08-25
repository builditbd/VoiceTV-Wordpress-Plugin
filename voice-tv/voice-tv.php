<?php
/**
 * Plugin Name:       Voice TV24 Custom Functions
 * Plugin URI:        http://buildit.com.bd
 * Description:       This plugin adds some Custom Post Meta in Wordpress posts CRUD and RestAPI
 * Version:           1.1
 * Author:            Imtiaz Mahbub
 * Author URI:        https://buildit.com.bd/
 *
 */
if (!defined('WPINC')) {
	die;
}
add_action('rest_api_init', 'register_posts_meta_field');

function register_posts_meta_field() {
	$object_type = 'post';
	$args1 = array( // Validate and sanitize the meta value.
		// Note: currently (4.7) one of 'string', 'boolean', 'integer',
		// 'number' must be used as 'type'. The default is 'string'.
		'type'         => 'string',
		// Shown in the schema for the meta key.
		'description'  => 'A meta key associated with a string meta value.',
		// Return a single value of the type.
		'single'       => true,
		// Show in the WP REST API response. Default: false.
		'show_in_rest' => true,
	);
	register_meta( $object_type, 'is_featured', $args1 );
	register_meta( $object_type, 'youtube_video_id', $args1 );
}

/* Add meta tags filter */
function post_meta_request_params( $args, $request )
{
	$args += array(
		'meta_key'   => $request['meta_key'],
		'meta_value' => $request['meta_value'],
		'meta_query' => $request['meta_query'],
	);

	return $args;
}
add_filter( 'rest_post_query', 'post_meta_request_params', 99, 2 );


/**
 * Register meta boxes for youtube video ID.
 * add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args)
 */
function hcf_register_meta_boxes() {
	add_meta_box( 'youtube_video_id', __( 'Youtube Video ID', 'hcf' ), 'hcf_display_callback', 'post', "side", "high", null);
}
add_action( 'add_meta_boxes', 'hcf_register_meta_boxes' );


/**
 * Register meta boxes for Districts and Voice Column.
 * add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args)
 */
function hcf_register_meta_boxes_for_district() {
	add_meta_box( 'district_name', __( 'Post Features', 'hcf2' ), 'hcf_display_callback_district', 'post', "side", "high", null);
}
add_action( 'add_meta_boxes', 'hcf_register_meta_boxes_for_district' );


/**
 * Register meta boxes for Post Author.
 * add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args)
 */
function hcf_register_meta_boxes_for_author() {
	add_meta_box( 'author_info', __( 'Author Info.', 'hcf2' ), 'hcf_display_callback_author', 'post', "side", "high", null);
}
add_action( 'add_meta_boxes', 'hcf_register_meta_boxes_for_author' );

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function hcf_display_callback_district( $post ) {
	include plugin_dir_path( __FILE__ ) . './_form-district.php';
}

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function hcf_display_callback( $post ) {
	include plugin_dir_path( __FILE__ ) . './_form-youtube-id.php';
}

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function hcf_display_callback_author( $post ) {
	include plugin_dir_path( __FILE__ ) . './_form-author-info.php';
}

/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function hcf_save_meta_box( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( $parent_id = wp_is_post_revision( $post_id ) ) {
		$post_id = $parent_id;
	}
	$fields = [
		'youtube_video_id',
		'district',
		'voice_column',
		'author_info',
		'is_featured',
	];
	foreach ( $fields as $field ) {
		if ( array_key_exists( $field, $_POST ) ) {
			update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
		}
	}
	if ( empty( $_POST['is_featured'] )) {
		update_post_meta( $post_id, 'is_featured', '' );
	}
}
add_action( 'save_post', 'hcf_save_meta_box' );


/*redirect 301 to new site*/
add_action( 'template_redirect', 'redirect_to_external_url' );
function redirect_to_external_url() {

	// redirect the front page
	if ( is_front_page() ) {
		wp_redirect( 'https://bn.voicetv.tv', 301 );
		exit;
	}

	// redirect posts
	// if you want to prevent logged in users redirection, use this function: is_user_logged_in()
	if (!is_admin()) {
		if (is_singular('post')) {
			$post_slug = get_post_field( 'post_name', get_post() );
			wp_redirect( 'https://bn.voicetv.tv/'.$post_slug, 301 );
			exit;
		}
	} else {
		if (is_singular('post')) {
			$output = apply_filters( 'wpseo_sitemap_url', $output, $url ); 

			$post_slug = get_post_field( 'post_name', get_post() );
			if ( !empty( $output ) ) {
				$post_slug = json_encode($output);
			}
			wp_redirect( 'https://bn.voicetv.tv/'.$post_slug, 301 );
			exit;
		}
	}

}
/*end: redirect 301 to new site*/

