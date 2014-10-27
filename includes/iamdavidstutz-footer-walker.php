<?php

/**
 * Custom menu walker for footer navigation.
 * 
 * @see http://codex.wordpress.org/Function_Reference/wp_nav_menu
 * @class IAMDAVIDSTUTZ_Footer_Walker
 * @author David Stutz
 */
class IAMDAVIDSTUTZ_Footer_Walker extends Walker_Nav_Menu {
  
    /**
     * This walker does not support any levels.
     * 
     * @param   string  $output
     * @param   integer   $depth
     * @return  string
     */
    function start_lvl(&$output, $depth = 0, $args = array()) {
        
    }

    /**
     * Nothing to end here.
     *
     * @param   string  $output
     * @param   integer $depth
     */
    function end_lvl(&$output, $depth = 0, $args = array()) {

    }
    
    /**
     * Each item is simply displayed as anchor.
     * 
     * @param   string  $output
     * @param   object  $item
     * @param   integer $depth
     * @param   object  $args
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
        
        $item_output = '<a '
                        . (!empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '')
                        . (!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '')
                        . (!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '')
                        . (!empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '')
                        . '>' . apply_filters('the_title', strtoupper($item->title), $item->ID)
                    . '</a>';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
    /**
     * Element is already compeltely covered in start_el.
     *
     * @param   string  $output
     * @param   object  $item
     * @param   integer $depth
     */
    function end_el(&$output, $item, $depth = 0, $args = array()) {

    }
}