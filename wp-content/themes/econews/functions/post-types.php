<?php

/* Register Custom Post Type for Toolbox */
add_action('init', 'toolbox_post_type_init');

function toolbox_post_type_init() {
    $labels = array(
        'name' => __('Toolbox Videos', 'post type general name', 'econews'),
        'singular_name' => __('Toolbox Videos', 'post type singular name', 'econews'),
        'add_new' => __('Add', 'portfolio', 'econews'),
        'add_new_item' => __('Add video', 'econews'),
        'edit_item' => __('Edit video', 'econews'),
        'new_item' => __('New video', 'econews'),
        'view_item' => __('View video', 'econews'),
        'search_items' => __('Search video', 'econews'),
        'not_found' => __('No video found', 'econews'),
        'not_found_in_trash' => __('No video found in trash', 'econews'),
        'parent_item_colon' => ''
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'show_in_nav_menus' => false,
        'menu_position' => 20,
        'rewrite' => array(
            'slug' => 'toolbox_item',
            'with_front' => FALSE,
        ),
        'taxonomies' => array('category', 'post_tag'),
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'category'
        )
    );

    register_post_type('toolbox', $args);
}

/* Register Custom Post Type for FAQ */
add_action('init', 'faq_post_type_init');

function faq_post_type_init() {
    $labels = array(
        'name' => __('FAQ', 'post type general name', 'econews'),
        'singular_name' => __('FAQ', 'post type singular name', 'econews'),
        'add_new' => __('Add', 'faq', 'econews'),
        'add_new_item' => __('Add Q/A', 'econews'),
        'edit_item' => __('Edit Q/A', 'econews'),
        'new_item' => __('New Q/A', 'econews'),
        'view_item' => __('View Q/A', 'econews'),
        'search_items' => __('Search Q/A', 'econews'),
        'not_found' => __('No Q/A found', 'econews'),
        'not_found_in_trash' => __('No Q/A found in trash', 'econews'),
        'parent_item_colon' => ''
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'show_in_nav_menus' => false,
        'menu_position' => 21,
        'rewrite' => array(
            'slug' => 'toolbox_item',
            'with_front' => FALSE,
        ),
        'taxonomies' => array('category', 'post_tag'),
        'supports' => array(
            'title',
            'editor'
        )
    );

    register_post_type('faq', $args);
}

add_image_size('toolbox-page', 160, 130);
add_image_size('cohooper-page', 200, 200);

// Hook into WordPress
add_action( 'admin_init', 'add_toolbox_metabox' );
add_action( 'save_post', 'save_toolbox_url' );

/**
 * Add meta box
 */
function add_toolbox_metabox() {
	add_meta_box( 'toolbox-metabox', __( 'Youtube Code &amp; highlight' ), 'url_toolbox_metabox', 'toolbox', 'normal', 'high' );
}

/**
 * Display the url metabox
 */
function url_toolbox_metabox() {
	global $post;
	$urllink = get_post_meta( $post->ID, 'urllink', true );
	$highlight = get_post_meta( $post->ID, 'highlight', true );
        
        ?>

	<p>
            <label for="siteurl"><strong>Youtube Code:</strong> <input id="siteurl" name="siteurl" value="<?php if( $urllink ) { echo $urllink; } ?>" style="width: 50%;" /></label>
        </p>
        <p><strong>Highlight:</strong> 
            <label for="highlightYes" style="margin-right: 12px;"><input type="radio" id="highlightYes" name="highlight" value="no" <?php if ($highlight == 'no' || empty($highlight)) echo 'checked="checked"' ?> /> No</label>
            <label for="highlightNo"><input type="radio" id="highlightNo" name="highlight" value="yes" <?php if ($highlight == 'yes') echo 'checked="checked"' ?> /> Yes</label>
        </p>
<?php
}

/**
 * Process the toolbox metabox fields
 */
function save_toolbox_url( $post_id ) {
	global $post;
        
	if( $_POST ) {
		update_post_meta( $post->ID, 'urllink', $_POST['siteurl'] );
		update_post_meta( $post->ID, 'highlight', $_POST['highlight'] );
	}
}

/**
 * Get and return the values for the URL and description
 */
function get_meta_toolbox_box() {
	global $post;
	$urllink = get_post_meta( $post->ID, 'urllink', true );
	$urldesc = get_post_meta( $post->ID, 'highlight', true );

	return array( $urllink, $urldesc );
}

?>