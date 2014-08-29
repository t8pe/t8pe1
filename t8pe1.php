<?php
/*
Plugin Name: t8pe1 IN PROGRESS
Plugin URI: http://bendeschamps.com
Description: The infrastructure parts of t8pe - not including the player. See bd-jplayer as well.
Version: 0.1
Author: Ben Deschamps
Author URI: http://bendeschamps.com
License: GPLv2
*/

/* Registering jscripts */

function t8pe1_scripts_method(){
  if ( !is_admin() ){

    wp_enqueue_script(
		      't8pe1_jplayer_scripts',
		      plugins_url( '/js/t8pe1-jplayer-scripts.js', __FILE__ ),
		      array('jquery')
	             );
  }
}
add_action('wp_enqueue_scripts', 't8pe1_scripts_method');

/* Trying to add a way to track total_plays because the metabox don't like it - nope, this doesn't work either. */
/* add_post_meta( $post->ID, total_plays, 0, yes ); */

/* CUSTOM META BOXES */
/* These should be entirely backend - ie not writable from the admin interface. */

/* Total plays */
function t8pe1_create_total_plays_metabox() {
  add_meta_box( 't8pe1_total_plays_metabox', 'Total plays:', 't8pe1_create_total_plays_metabox', 'song', 'normal' );
}

function t8pe1_total_plays_metabox( $post ) {
  echo 'This is where the total plays are listed!';
}

add_action( 'add_meta_boxes', 't8pe1_create_total_plays_metabox' );

/* Total sales */
function t8pe1_create_total_sales_metabox() {
  add_meta_box( 't8pe1_total_sales_metabox', 'Total sales:', 't8pe1_create_total_sales_metabox', 'song', 'normal' );
}

function t8pe1_total_sales_metabox( $post ) {
  echo 'This is where the total sales are listed!';
}

add_action( 'add_meta_boxes', 't8pe1_create_total_sales_metabox' );


/************************************************************************/
/** CUSTOM POST TYPES **/
/************************************************************************/

/* Register Song custom post type */

add_action( 'init', 't8pe1_register_song' );

function t8pe1_register_song() {

		      
			    $labels = array(
					      'name' => 'Song',
					      'singular_name' => 'Song',
					      'add_new' => 'Add New Song',
					      'add_new_item' => 'Add New Song',
					      'edit_item' => 'Edit Song',
					      'new_item' => 'New Song',
					      'all_items' => 'All Songs',
					      'view_items' => 'View Songs',
					      'search_items' => 'Search Songs',
					      'not_found' => 'No Songs Found',
					      'not_found_in_trash' => 'No Songs found in Trash',
					      'parent_item_colon' => '',
					      'menu_name' => 'Songs'
					    
					    );
			    $args = array(
					    'public' => true,
					    'publicly_queryable' => true,
					    'labels' => $labels,
					    'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'post-formats', 'custom-fields' )
					    );
		       	       
						
		            register_post_type( 'song', $args );
			    
		    
}

/* Register playlist type. */

add_action( 'init', 't8pe1_register_playlist' );

function t8pe1_register_playlist() {

		      
			    $labels = array(
					      'name' => 'Playlists',
					      'singular_name' => 'Playlist',
					      'add_new' => 'Add New Playlist',
					      'add_new_item' => 'Add New Playlist',
					      'edit_item' => 'Edit Playlist',
					      'new_item' => 'New Playlist',
					      'all_items' => 'All Playlists',
					      'view_items' => 'View Playlists',
					      'search_items' => 'Search Playlists',
					      'not_found' => 'No Playlists Found',
					      'not_found_in_trash' => 'No Playlists found in Trash',
					      'parent_item_colon' => '',
					      'menu_name' => 'Playlists'
					    
					    );
			    $supports = array(
					      'title', 'editor', 'thumbnail', 'excerpt', 'post-formats', 'custom-fields'
					      );
			    $args = array(
					    'public' => true,
					    'labels' => $labels,
					    'supports' => $supports
					    );
		       	       
						
		            register_post_type( 'playlist', $args );
			    
		    
}

/************************************************************************/
/** TAXONOMIES: **/
/************************************************************************/

/* ALBUMS TAXONOMY
This is a tag-based system, so the same song can in theory be used for multiple albums.
*/
add_action( 'init', 't8pe1_define_albums_taxonomy' );


function t8pe1_define_albums_taxonomy() {
  
  $labels = array(
		  'name' => 'Albums',
		  'singular name' => 'Album',
		  'search_items' => 'Search Albums', 
		  'all_items' => 'All Albums',
		  'edit_item' => 'Edit Album',
		  'update_item' => 'Update Album',
		  'add_new_item' => 'Add New Album',
		  'new_item_name' => 'New Album Name',
		  'menu_name' => 'Album'
		  );

  $args = array(
		'labels' => $labels,
		'hierarchical' => false,
		'query_var' => true,
		'rewrite' => true
		);

  $posts = array(
		 'song', 'playlist'
		 );
  register_taxonomy( 'album', $posts, $args );

  } 


/* ARTISTS TAXONOMY
Note: this essentially only adds a tag to the songs & albums, indicating which artists they're by.
So be careful & make sure you don't have, e.g. 'SJ Tucker' and 'S.J. Tucker'. 
*/

add_action( 'init', 't8pe1_define_artists_taxonomy' );

function t8pe1_define_artists_taxonomy() {
  
  $labels = array(
		  'name' => 'Artists',
		  'singular name' => 'Artist',
		  'search_items' => 'Search Artists', 
		  'all_items' => 'All Artists',
		  'edit_item' => 'Edit Artist',
		  'update_item' => 'Update Artist',
		  'add_new_item' => 'Add New Artist',
		  'new_item_name' => 'New Artist Name',
		  'menu_name' => 'Artist'
		  );

  $args = array(
		'labels' => $labels,
		'hierarchical' => false,
		'query_var' => true,
		'rewrite' => true
		);

  $posts = array(
		 'song', 'playlist'
		 );

  register_taxonomy( 'artist', $posts, $args );

  } 

/************************************************************************/
/* ROLES */
/************************************************************************/

function t8pe1_add_curator_role() {
  add_role( t8pe1_curator, "Curator", array( 'upload_files', true ) );
  // Need to add an $array of capabilities yet.
}
register_activation_hook( __FILE__, 't8pe1_add_curator_role' );

function t8pe1_add_artist_role() {
  add_role( t8pe1_artist, "Artist", "" );
  // Need to add an $array of capabilities yet.
}
register_activation_hook( __FILE__, 't8pe1_add_artist_role' );

/** MISC FUNCTIONS **/

function t8pe1_play_counter(){
    $play_counter = "total_plays";
    $plays = get_post_meta( $post->ID, $play_counter, true);
    if($plays==''){
	$plays = 0; //Hmmm. Probably not needed.
	delete_post_meta($post->ID, $play_counter);
	add_post_meta($post->ID, $play_counter, '1');
    }else{
	$count++;
	update_post_meta($post->ID, $play_counter, $plays);
    }
}
?>
