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
        add_shortcode('mathjax', array($this, 'mathjax'));
        add_shortcode('prettify', array($this, 'prettify'));
        add_shortcode('bootstrap', array($this, 'bootstrap'));
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
    public function mathjax($attributes, $content = null) {
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
     * Enable bootstrap JS for page/post.
     * 
     * @param	array 	attributes
     * @param	string	content
     * @param	string	html markup
     */
    public function bootstrap($attributes, $content = null) {
        extract(shortcode_atts(array(
            
        ), $attributes));

        wp_enqueue_script('bootstrap', get_bloginfo('template_directory') . '/js/bootstrap.js');

        return '';
    }
    
    /**
     * Bind a bxSlider to the slides with the given id.
     * 
     * @param   array   attributes
     * @param   string  content
     * @return  string  html markup
     */
    public function bxslider($attributes, $content = NULL) {
        extract(shortcode_atts(array(
            'slides' => 1,
            'id' => '',
            'caption' => FALSE,
        ), $attributes));
        
        if (!empty($id)) {
            return '<script type="javascript/text">'
                    . '$(document).ready(function() {'
                        . '$(\'#' . $id . '\').bxslider({'
                            . 'minSlides: ' . $slides . ','
                            . 'maxSlides: ' . $slides . ','
                            . ($caption !== FALSE ? 'caption: true' : '')
                        . '});'
                    . '});'
                 . '</script>';
        }
        else {
            return '';
        }
    }
}

new IAMDAVIDSTUTZ_Shortcodes();
?>