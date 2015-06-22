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
        add_shortcode('pseudocode', array($this, 'pseudocode'));
        add_shortcode('mathjax', array($this, 'mathjax'));
        add_shortcode('prettify', array($this, 'prettify'));
        add_shortcode('bootstrap', array($this, 'bootstrap'));
        add_shortcode('bxslider', array($this, 'bxslider'));
        add_shortcode('line_plot', array($this, 'line_plot'));
    }
    
    /**
     * Include and initialiye jQuery Pseudocode.
     * 
     * @param	array 	attributes
     * @param	string	content
     * @param	string	html markup
     */
    public function pseudocode($attributes, $content = null) {
        extract(shortcode_atts(array(

        ), $attributes));
        
        wp_enqueue_script('pseudocode', get_bloginfo('template_directory') . '/js/jquery-pseudocode.js');
        wp_enqueue_script('pseudocode-init', get_bloginfo('template_directory') . '/js/jquery-pseudocode-init.js');

        return '';
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
            'width' => '300',
            'class' => '',
            'caption' => TRUE,
        ), $attributes));
        
        if (!empty($class)) {
            return '<script type="text/javascript">'
                    . '$(document).ready(function() {'
                        . '$(\'.' . $class . '\').bxSlider({'
                            . 'minSlides: ' . $slides . ','
                            . 'maxSlides: ' . $slides . ','
                            . 'slideWidth: ' . $width . ','
                            . 'slideMargin: 8,'
                            . ($caption !== FALSE ? 'captions: true' : '')
                        . '});'
                    . '});'
                 . '</script>';
        }
        else {
            return '';
        }
    }
    
    /**
     * Line plot using nvd3.js.
     * 
     * @param type $attributes
     * @param type $content
     */
    public function line_plot($attributes, $content = NULL) {
        extract(shortcode_atts(array(
            'file' => '',
            'field' => '',
            'height' => 200,
        ), $attributes));
        
        wp_enqueue_script('d3', 'https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.2/d3.min.js');
        wp_enqueue_script('nvd3', get_bloginfo('template_directory') . '/js/nv.d3.js');
        wp_enqueue_style('nvd3', get_bloginfo('template_directory') . '/css/nv.d3.css');
        
        if (!empty($file)) {
            $id = 'line-plot-' . time() . rand(0, 1000) . '-' . $field;
            
            return '<svg style="height:' . $height . 'px" id="' . $id . '" class="line-plot"></svg>'
                    . '<script type="text/javascript">'
                        . '$(document).ready(function() {'
                            . 'd3.json(\'' . $file . '\', function(data) {'
                                . 'nv.addGraph(function() {'
                                    . 'var chart = nv.models.lineChart()'
                                        . '.x(function(d) {'
                                            . 'return d[0];'
                                        . '})'
                                        . '.y(function(d) {'
                                            . 'return d[1];'
                                        . '});'

                                    . 'd3.select(\'#' . $id . '\')'
                                        . '.datum(data' . (empty($field) ? '' : '[\'' . $field . '\']') . ')'
                                        . '.call(chart);'

                                    . 'nv.utils.windowResize(chart.update);'

                                    . 'return chart;'
                                . '});'
                            . '});'
                        . '});'
                    . '</script>';
        }
        else {
            return 'asd';
        }
    }
}

new IAMDAVIDSTUTZ_Shortcodes();
?>