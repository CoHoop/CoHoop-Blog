<?php
/*
  Copyright 2010, idesigneco.com
  http://idesigneco.com
 */


define('IDE_NAME', 'ecoNews');
define('IDE_CODE', 'econews');
define('IDE_VERSION', '1.2');

define('SITE_URL', get_bloginfo('siteurl') . '/');
define('IDE_URL', get_bloginfo('template_url') . '/');
define('IDE_PATH', dirname(__FILE__) . '/');
define('IDE_ADMIN_PATH', IDE_PATH . 'admin/');
define('IDE_FUNC_PATH', IDE_PATH . 'functions/');
define('IDE_ADMIN_STATIC', get_bloginfo('template_url') . '/admin/static/');

// theme widgets to load
$IDE_widgets = array(
    'IDE_widget_ecosocial',
    'IDE_widget_ecobanner'
);

/* Deregister stylesheets */
wp_deregister_style('tribe_events_stylesheet_url');

/* Deregister plugin script to register them on a different page */
// event calendar is not used for now
wp_deregister_script('tribe-events-calendar-script');
wp_deregister_script('tribe-events-pjax');

if( !is_admin()){
    wp_enqueue_script('script', IDE_URL . 'js/script.min.js', array('jquery'), true, true);

    wp_deregister_script('jquery');
    wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"), false, '1.7.1');
    wp_enqueue_script('jquery');

    remove_action( 'wp_head', 'feed_links_extra'); // Display the links to the extra feeds such as category feeds
    remove_action( 'wp_head', 'feed_links'); // Display the links to the general feeds: Post and Comment Feed
    remove_action( 'wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
    remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
    remove_action( 'wp_head', 'index_rel_link' ); // index link
    remove_action( 'wp_head', 'parent_post_rel_link', 10); // prev link
    remove_action( 'wp_head', 'start_post_rel_link', 10); // start link
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10); // Display relational links for the posts adjacent to the current post.
    remove_action( 'wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version

}

// theme functions load
require_once(IDE_FUNC_PATH . 'post-types.php');
// ________________________________________________________
// add the image input field to admin
add_action('admin_menu', 'ide_admin_fields');
add_action('save_post', 'ide_admin_savepost');

// add the post-image field to write page
function ide_admin_fields() {

    function ide_admin_imagebox_html() {
        global $post;

        $imgurl = get_post_custom_values('ide_post_image', $post->ID);
        echo '<input type="text" size="100" name="ide_post_image" value="' . (!empty($imgurl[0]) ? $imgurl[0] : 'http://') . '" />
					<p>' . _('The full URL to your post image (optional)') . '</p>
			';
    }

    add_meta_box('ide_admin_imagebox', _('Post image'), 'ide_admin_imagebox_html', 'post', 'normal', 'high');
}

// save the post-image meta field when a post is being updated
function ide_admin_savepost($post_id) {
    if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            || empty($_POST['ide_post_image']) || strtolower($_POST['ide_post_image']) == 'http://')
        return $post_id; // autosave: do nothing

    update_post_meta($post_id, 'ide_post_image', $_POST['ide_post_image']);
}

// ________________________________________________________
$IDE_options = null;

// install a theme
function ide_setup_theme() {
    if (!ide_option('setup')) { // first time
        ide_save_options(
                array(
                    'setup' => true,
                    'nav' => 'on',
                    'sidebar_blog' => 'on',
                    'post_fullmeta' => 'on',
                    'post_img_resize' => 'on'
                )
        );
    }
}

// load widgets
function ide_load_widgets() {
    global $IDE_widgets;

    foreach ($IDE_widgets as $widget) {
        include IDE_PATH . 'widgets/' . $widget . '.php';
        register_widget($widget);
    }
}

// classname for page/blog based on the sidebar visibility settings (used for styling)
function ide_body_class($classes = array()) {

    // page
    /*if (is_page()) {
        if (!ide_option('sidebar_page'))
            $classes[] = 'nosidebar';
        // blog
    } else {
        $classes[] = 'blog';
        if (!ide_option('sidebar_blog'))
            $classes[] = 'nosidebar';
    }*/

    // site layout
    $classes[] = ide_option('site_layout');

    if (get_option('show_on_front') == 'page' && get_option('page_on_front') && is_front_page())
        $classes[] = 'frontpage';

    return implode(' ', $classes);
}

// show the sidebar, based on the visibility settings
function ide_sidebar() {
    $show_sidebar = false;
    if (is_page()) {
        if (ide_option('sidebar_page'))
            $show_sidebar = true;
    } elseif (ide_option('sidebar_blog')) {
        $show_sidebar = true;
    }

    if ($show_sidebar)
        get_sidebar();
}

// add content to the template footer, through wp's 'footer' filter
function ide_footer() {
    echo '
			<script type="text/javascript">
			<!--
				var ide_img_resize = ' . (ide_option('post_img_resize') ? 'true' : 'false') . '
			//-->
			</script>
		';

    echo ide_option('analytics');
}

// save multiple theme options
function ide_save_options($data) {
    global $IDE_options;

    $IDE_options = array_merge($IDE_options, $data);
    update_option(IDE_CODE, serialize($IDE_options));
}

// save a single theme option
function ide_save_option($key, $value) {
    global $IDE_options;

    $IDE_options[$key] = $value;
    ide_save_options($IDE_options);
}

// load theme options
function ide_load_options() {
    global $IDE_options;

    $IDE_options = @unserialize(get_option(IDE_CODE));
    if (!$IDE_options)
        $IDE_options = array();
}

// get a particular theme option
function ide_option($key = null) {
    global $IDE_options;
    return isset($IDE_options[$key]) ? $IDE_options[$key] : null;
}

// user styles
function ide_userstyles() {
    if (ide_option('css_enable'))
        wp_enqueue_style('ide_admincss', IDE_URL . 'userstyle.php', null, null, 'screen'); // load the admin css
}

// category navigation
function ide_nav_categories() {
    ?><div class="nav"><ul><?php wp_list_categories('title_li=&depth=1&menu_class=nav_categories'); ?></ul></div><?php
}

// show the post facebook/twitter strip
function ide_post_strip() {
    $permalink = urlencode(get_permalink());

    echo '<ul class="share noul">';

    if (ide_option('post_facebook'))
        echo '<li class="fb"><a href="http://www.facebook.com/share.php?u=' . $permalink . '">Share on Facebook</a></li>';

    if ($twitter = ide_option('twitter'))
        echo '<li class="tt"><a href="http://twitter.com/home/?status=@' . $twitter . '+' . urlencode(get_the_title()) . '+' . $permalink . '">Tweet</a></li>';

    echo '</ul>';
}

// ________________________________________________________
// add the theme settings link to WordPress admin menu
function ide_admin_init() {

    wp_enqueue_script('ide_adminjs', IDE_ADMIN_STATIC . 'admin.js'); // load the tabber script for admin
    wp_enqueue_style('ide_admincss', IDE_ADMIN_STATIC . 'admin.css'); // load the admin css
    // add the settings link to admin menu
    add_menu_page(IDE_NAME . " Settings", IDE_NAME . " Settings", 'edit_themes', basename(__FILE__), 'ide_admin', IDE_ADMIN_STATIC . '/ico_admin.png'
    );
}

add_action('admin_menu', 'ide_admin_init');

// load the theme's settings page
function ide_admin() {
    global $IDE_options;
    include IDE_ADMIN_PATH . 'IDE_admin.php';
}

// ________________________________________________________

// register dynamic sidebars
if (function_exists('register_sidebar')) {

    register_sidebar(array(
        'name' => 'Right sidebar',
        'id' => 'right_sidebar',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
    ));

    register_sidebar(array(
        'name' => 'Footer bar',
        'id' => 'footer_sidebar',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
    ));
}

// register menus
if (function_exists('register_nav_menus')) {
    register_nav_menus(array(
        'menu_main' => __('Header navigation'),
        'menu_category' => __('Category navigation'),
        'menu_footer' => __('Footer navigation'),
    ));
}



// register api hooks
add_action('init', 'ide_load_options');
add_action('admin_init', 'ide_setup_theme');
add_action('widgets_init', 'ide_load_widgets');
add_action('wp_print_styles', 'ide_userstyles');
add_action('wp_footer', 'ide_footer');


if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions
}

if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'cohoopers-mini', 150, 150, 'soft' );
    add_image_size( 'cohoopers-maxi', 200, 250, 'soft' );
}
/*
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'custom_trim_excerpt');

function custom_trim_excerpt($text) { // Fakes an excerpt if needed
    global $post;
    if ( '' == $text ) {
        $text = get_the_content('');
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]>', $text);
        $text = strip_tags($text);
        $excerpt_length = 500;
        $words = explode(' ', $text, $excerpt_length + 1);
        if (count($words) > $excerpt_length) {
            array_pop($words);
            array_push($words, '...');
            $text = implode(' ', $words);
        }
    }
    return $text;
}

function content($num) {
    $theContent = get_the_content();
    $output = preg_replace('/<img[^>]+./','', $theContent);
    $output = preg_replace( '/<blockquote>.*<\/blockquote>/', '', $output );
    $output = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $output );
    $limit = $num+1;
    $content = explode(' ', $output, $limit);
    array_pop($content);
    $content = implode(" ",$content)."...";
    echo $content;
}
*/
//automatic_feed_links();
?>