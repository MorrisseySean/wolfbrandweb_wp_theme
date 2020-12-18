<?php 
/* Contains a collection of Walker classes */

/*
    wp_nav_menu(); //outputs >>>
    <div class="menu-container">
        <ul> // start_lvl
            <li><a><span> // start_el()
                Link
            </a></span></li> // end_el()
            <li><a>Link</a><span>description</span></li>
            <li><a>Link</a></li>
            <li><a>Link</a></li>
        </ul>
    </div> // end_lvl()
*/

class Walker_Nav_Primary extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth = 0, $args = NULL) { // Edit the starting ul tag
        $indent = str_repeat("\t", $depth);
        $submenu = ($depth > 0) ? 'sub-menu' : '';
        $output .= "\n$indent<ul class=\"nav__menu$submenu depth+$depth\">\n";
    }
    
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) { // Edit the starting li, a span tags
        
        $indent = ($depth) ? str_repeat("\t", $depth) : "";

        $li_attr = "";
        $class_names = $value = "";
        
        // Create an array of classes from the item, initialise an empty array if there are none
        $classes = empty($item->classes) ? array() : (array) $item ->classes;
        
        // Add a dropdown class if there are more items
        $classes[] = ($args->walker->has_children) ? 'dropdown' : '';

        // Add active class to button if on current page
        $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';

        $classes[] = 'nav__menu-item';
        // Add a menu item ID class.
        $classes[] = 'nav__menu-item-'.$item->ID;

        // Add dropdown submenu if children exist beyond first 
        if($depth && $args->walker->has_children){
            $classes[] = 'dropdown-submenu';
        }
        // Create the class string
        $class_names = join(
            ' ',
            apply_filters('nav_menu_css_class', 
                array_filter( $classes ), 
                $item, 
                $args)
        );
        $class_names = ' class="'.esc_attr($class_names).'"';

        // Generate an id for each menu item
        $id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
        // If the id has no length, return nothing, otherwise add the correct id.
        $id = strlen($id) ? ' id="'.esc_attr($id).'"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

        $attributes = !empty( $item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty( $item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty( $item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty( $item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        $attributes .= ( $args->walker->has_children) ? 'class="dropdown-toggle" data-toggle="dropdown"' : '';
        $attributes .= 'class="nav__link nav__link--menu"';
        // Print wordpress generated tags
        $item_output = $args->before;

        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= ($depth == 0 && $args->walker->has_children) ? '<b class="caret"></b></a>' : '</a>';
        // Print wordpress generated tags
        $item_output .= $args->before;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }    
}

class Walker_Nav_Secondary extends Walker_Nav_Menu {

function start_lvl(&$output, $depth = 0, $args = NULL) { // Edit the starting ul tag
    $indent = str_repeat("\t", $depth);
    $submenu = ($depth > 0) ? 'sub-menu' : '';
    $output .= "\n$indent<ul class=\"$submenu depth+$depth\">\n";
}

function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) { // Edit the starting li, a span tags
    
    $indent = ($depth) ? str_repeat("\t", $depth) : "";

    $li_attr = "";
    $class_names = $value = "";
    
    // Create an array of classes from the item, initialise an empty array if there are none
    $classes = empty($item->classes) ? array() : (array) $item ->classes;

    // Add active class to button if on current page
    $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';

    $classes[] = 'footer__item';
    // Add a menu item ID class.
    $classes[] = 'footer__item-'.$item->ID;

    // Create the class string
    $class_names = join(
        ' ',
        apply_filters('nav_menu_css_class', 
            array_filter( $classes ), 
            $item, 
            $args)
    );
    $class_names = ' class="'.esc_attr($class_names).'"';

    // Generate an id for each menu item
    $id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
    // If the id has no length, return nothing, otherwise add the correct id.
    $id = strlen($id) ? ' id="'.esc_attr($id).'"' : '';

    $output .= $indent . '<li' . $id . $value . $class_names . '>';

    $attributes = !empty( $item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty( $item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty( $item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty( $item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    $attributes .= 'class="footer__link"';

    // Print wordpress generated tags
    $item_output = $args->before;

    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= ($depth == 0 && $args->walker->has_children) ? '<b class="caret"></b></a>' : '</a>';
    // Print wordpress generated tags
    $item_output .= $args->before;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
}    
}?>