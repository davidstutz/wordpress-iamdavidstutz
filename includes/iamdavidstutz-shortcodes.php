<?php

/**
 * Class containing and adding all available shortcodes.
 * 
 * @author	David Stutz
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class IAMDAVIDSTUTZ_Shortcodes {
	
    /**
     * Constructor: init shortcodes.
     * 
     * @return	Yabt_Shortcodes	this
     */
    public function __construct() {
        $this->init();
    }

    /**
     * Register all shortcodes.
     */
    public function init() {
        add_shortcode('button', array($this, 'button'));
        add_shortcode('mathjax', array($this, 'mathjax'));
        add_shortcode('prettify', array($this, 'prettify'));
        add_shortcode('tabgroup', array($this, 'tabgroup'));
        add_shortcode('tab', array($this, 'tab'));
        add_shortcode('warning', array($this, 'warning'));
        add_shortcode('info', array($this, 'info'));
        add_shortcode('error', array($this, 'error'));
        add_shortcode('success', array($this, 'success'));
        add_shortcode('muted', array($this, 'muted'));
    }
    /**
     * Shortcode for Twitter Bootstrap buttons.
     * 
     * Usage:
     * 	[button type="primary" size="large" url="http://google.de"]
     * 
     * @param	array	attributes
     * @param	string	content
     * @return	string	html markup
     */
    public function button($attributes, $content = null) {
        extract(shortcode_atts( array(
            'type' => 'default',
            'size' => 'default',
            'url'  => '#',
            'class' => '',
        ), $attributes));

        if ($type == 'default') {
            $type = '';
        }

        return '<a href="' . $url . '" class="btn btn-'. $type . ' btn-' . $size . ' ' . $class . '">' . do_shortcode( $content ) . '</a>';
    }

    /**
     * Init mathjax for the whole page.
     * 
     * 	[mathjax]
     * 
     * @param	array 	attributes
     * @param	string	content
     * @param	string	html markup
     */
    public function mathjax( $attributes, $content = null) {
        extract(shortcode_atts(array(

        ), $attributes));

        wp_enqueue_script('mathjax', 'http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML');
        wp_enqueue_script('mathjax-init', get_bloginfo('template_directory') . '/js/mathjax-init.js');

        return '';
    }

    /**
     * Enable prettifying code within <pre class="prettyprint [linenums]"></pre>.
     * 
     * @param	array 	attributes
     * @param	string	content
     * @param	string	html markup
     */
    public function prettify($attributes, $content = null) {
        extract(shortcode_atts(array(

        ), $attributes));

        wp_enqueue_script('prettify', get_bloginfo('template_directory') . '/js/prettify.js');
        wp_enqueue_style('prettify', get_bloginfo('template_directory') . '/css/prettify.css');

        wp_enqueue_script('prettify-init', get_bloginfo('template_directory') . '/js/prettify-init.js');

        return '';
    }

/**
     * Shortcode for tabgroup.
     * 
     * @param	array 	attributes
     * @param	string	content
     * @return	string	html markup
     */
    public function tabgroup( $attributes, $content = null ) {
        extract(shortcode_atts(array(
            'position' => FALSE,
        ), $attributes));

        wp_enqueue_script( 'bootstrap-tab', get_bloginfo('template_directory') . '/js/bootstrap-tab.js' );

        if (!isset($GLOBALS['yabt_tabs'])) {
            $GLOBALS['yabt_tabs'] = array();
        }

        $content = do_shortcode($content);

        $tabs = $GLOBALS['yabt_tabs'];

        $output = '<div class="tabbable ' . ($position ? 'tabs-' . $position : NULL) . '"><ul class="nav nav-tabs">';

        foreach ($tabs as $array) {
            $output .= '<li ' . ($array['active'] ? 'class="active"' : NULL) . '><a href="#' . $array['id'] . '" data-toggle="tab">' . $array['title'] . '</a></li>';
        }

        $output .= '</ul><div class="tab-content">';

        foreach ($tabs as $array) {
            $output .= '<div class="tab-pane ' . ($array['active'] ? 'active' : NULL) . '" id="' . $array['id'] . '">' . $array['content'] . '</div>';
        }

        $output .= '</div></div>';

        unset($GLOBALS['yabt_tabs']);

        return '<script type="text/javascript">
                    $(document).ready(function() {
                        $(\'.tabbable .nav a\').click(function(event) {
                            event.preventDefault();
                            $(this).tab();
                        });
                    });
                </script>'
                . $output;
    }

    /**
     * Shortcode for single tab.
     * Will save the tab in $GLOBALS['yabt_tabs'] to be ahndled by tabgroup.
     * 
     * @param	array 	attributes
     * @param	string	content
     * @return	string	html markup
     */
    public function tab( $attributes, $content = null ) {
        extract(shortcode_atts(array(
            'title' => '',
            'id' => '',
            'active' => false,
        ), $attributes));

        if (isset($GLOBALS['yabt_tabs'])) {
            if (!empty($title) && !empty($id)) {
                $GLOBALS['yabt_tabs'][] = array(
                    'content' => do_shortcode($content),
                    'id' => $id,
                    'title' => $title,
                    'active' => $active,
                );
            }
        }

        return '';
    }

/**
     * Shortcode to display the text as info alert.
     * 
     * Usage:
     * 	[info]Lorem ipsum ...[/info]
     * 
     * @param	array	attributes
     * @param	string	content
     * @return	string	html markup
     */
    public function info($attributes, $content = null) {
        return '<p class="alert alert-info">' . do_shortcode($content) . '</p>';
    }

/**
     * Shortcode to display the text as error alert.
     * 
     * Usage:
     * 	[error]Lorem ipsum ...[/error]
     * 
     * @param	array	attributes
     * @param	string	content
     * @return	string	html markup
     */
    public function error($attributes, $content = null) {
        return '<p class="alert alert-error">' . do_shortcode($content) . '</p>';
    }

/**
     * Shortcode to display the text as warning alert.
     * 
     * Usage:
     * 	[warning]Lorem ipsum ...[/warning]
     * 
     * @param	array	attributes
     * @param	string	content
     * @return	string	html markup
     */
    public function warning($attributes, $content = null) {
        return '<p class="alert alert-warning">' . do_shortcode($content) . '</p>';
    }

/**
     * Shortcode to display the text as success alert.
     * 
     * Usage:
     * 	[success]Lorem ipsum ...[/success]
     * 
     * @param	array	attributes
     * @param	string	content
     * @return	string	html markup
     */
    public function success($attributes, $content = null) {
        return '<p class="alert alert-success">' . do_shortcode($content) . '</p>';
    }

/**
     * Shortcode for Twitter Bootstrap muted text.
     * 
     * Usage:
     * 	[muted]This text is muted...[/muted]
     * 
     * @param	array	attributes
     * @param	string	content
     * @return	string	html markup
     */
    public function muted($attributes, $content = null) {
        return '<span class="text-muted">' . $content . '</span>';
    }
}

new IAMDAVIDSTUTZ_Shortcodes();
?>