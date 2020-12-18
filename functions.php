<?php
// NOTE: Always create a unique name for functions 
// to prevent cross contamination with plugins

// Setup css and javascript
function basic_script_enqueue() {
    // Include css files
    wp_enqueue_style('customstyle', get_template_directory_uri().'/css/base.css', array(), '1.0.0', 'all');
    
    // Include js files
    //wp_enqueue_script('customjs', get_template_directory_uri().'/js/scroll_style.js', array(), '1.0.0', true);
    wp_enqueue_script('customjs', get_template_directory_uri().'/js/base.js', array(), '1.0.0', true);
    //Imports customjs as a module:
    add_filter('script_loader_tag', 'add_type_to_script', 10, 3);
    function add_type_to_script($tag, $handle, $source) {
        if ('customjs' === $handle) {
            $tag = '<script src="' . $source . '" type="module" ></script>';
        }
        return $tag;
    }
    wp_enqueue_script('jquery');
}

function basic_theme_setup() {
    /*
        ===================================
        Activate menus
        ===================================
    */
    // Generate wordpress support for menus.
    add_theme_support('menus');
    // Generate a default menu
    register_nav_menu('primary', 'Primary Header Navigation');
    register_nav_menu('secondary', 'Footer Navigation');

    /*
        ===================================
        Activate theme support functions
        ===================================
    */
    // Enable custom background support, allowing users to add a custom background to their site.
    add_theme_support('custom-background');
    // Enable custom header support, allowing users to add a custom header image to their site.
    add_theme_support( 'custom-header');
    // Enable post thumbnails, allowing users to add their custom thumbnails to their posts
    add_theme_support('post-thumbnails');    
    // Enable post formats, allowing for different formats for different posts
    add_theme_support('post-formats', array('aside', 'image', 'video'));
    // Enable html5 search support
    add_theme_support('html5', array('search-form'));
}

/*
    ===================================
    Sidebar function
    ===================================
*/
function basic_widget_setup() {
    // Setup a sidebar
    register_sidebar(
        array(
            'name'  => 'Sidebar',
            'id'    => 'sidebar-1',
            'class' => 'custom',
            'description' => 'Standard sidebar',
            'before_widget' =>  '<aside id=%1$s" class="sidebar__item %2$s">',
            'after_widget'  =>  '</aside>',
            'before_title'  =>  '<h1 class="sidebar__item-title">',
            'after_title'   =>  '</h1>',  
        )
        );
}
//Hide categories from WordPress category widget
function exclude_widget_categories($args){
    $exclude = "3, 12";
    $args["exclude"] = $exclude;
    return $args;
}
add_filter("widget_categories_args","exclude_widget_categories");

function custom_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


// Register Custom Walkers
require get_template_directory() . '/inc/walker.php';

// Add the functions on load
add_action( 'wp_enqueue_scripts', 'basic_script_enqueue');
// Generate theme support after initialisation.
add_action('init', 'basic_theme_setup');
// Initialise the sidebar
add_action('widgets_init', 'basic_widget_setup');


/*
    ===================================
    Head tag function
    ===================================
*/
// Removes wordpress version from meta tags for increased security.
function wbtech_remove_version() { return ''; }
add_filter('the_generator', "wbtech_remove_version");

?>