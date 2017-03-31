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
        add_shortcode('readings', array($this, 'readings'));
        add_shortcode('hide_mail', array($this, 'hide_mail'));
    }
    
    /**
     * Include and initialiye jQuery Pseudocode.
     * 
     * @param	array 	attributes
     * @param	string	content
     * @return	string	html markup
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
     * @return	string	html markup
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
     * @return	string	html markup
     */
    public function prettify($attributes, $content = null) {
        extract(shortcode_atts(array(

        ), $attributes));

        // wp_enqueue_script('prettify', get_bloginfo('template_directory') . '/js/prettify.js');
        wp_enqueue_script('prettify-matlab', 'https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js?autoload=true');
        wp_enqueue_script('prettify-matlab', get_bloginfo('template_directory') . '/js/prettify-matlab.js');
        wp_enqueue_script('prettify-tex', get_bloginfo('template_directory') . '/js/prettify-tex.js');
        wp_enqueue_script('prettify-sql', get_bloginfo('template_directory') . '/js/prettify-sql.js');
        wp_enqueue_script('prettify-lua', get_bloginfo('template_directory') . '/js/prettify-lua.js');
        wp_enqueue_script('prettify-css', get_bloginfo('template_directory') . '/js/prettify-css.js');
        // wp_enqueue_script('prettify-init', get_bloginfo('template_directory') . '/js/prettify-init.js');

        //wp_enqueue_style('prettify', get_bloginfo('template_directory') . '/css/prettify.css');
        wp_enqueue_style('prettify-tomorrow', get_bloginfo('template_directory') . '/css/prettify-github2.css');

        return '';
    }

    /**
     * Enable bootstrap JS for page/post.
     * 
     * @param	array 	attributes
     * @param	string	content
     * @return	string	html markup
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
     * @param array $attributes
     * @param string $content
     */
    public function line_plot($attributes, $content = NULL) {
        extract(shortcode_atts(array(
            'file' => '',
            'field' => '',
            'height' => 200,
        ), $attributes));
        
        wp_enqueue_script('d3', 'https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.2/d3.min.js');
        wp_enqueue_script('nvd3', get_bloginfo('template_directory') . '/js/nv.d3.min.js');
        wp_enqueue_style('nvd3', get_bloginfo('template_directory') . '/css/nv.d3.min.css');
        
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
            return '';
        }
    }
    
    /**
     * Bar chart using nvd3.js.
     * 
     * @param array $attributes
     * @param string $content
     */
    public function bar_char($attributes, $contents = NULL) {
        extract(shortcode_atts(array(
            'file' => '',
            'height' => 200,
        ), $attributes));
        
        wp_enqueue_script('d3', 'https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.2/d3.min.js');
        wp_enqueue_script('nvd3', get_bloginfo('template_directory') . '/js/nv.d3.min.js');
        wp_enqueue_style('nvd3', get_bloginfo('template_directory') . '/css/nv.d3.min.css');
        
        if (!empty($file)) {
            $id = 'bar-chart-' . time() . rand(0, 1000);
            
            return '<svg style="height:' . $height . 'px" id="' . $id . '" class="bar-chart"></svg>'
                    . '<script type="text/javascript">'
                        . '$(document).ready(function() {'
                            . 'd3.json(\'' . $file . '\', function(data) {'
                            . 'nv.addGraph({'
                                . 'generate: function() {'
                                    . 'var chart = nv.models.multiBarChart()'
                                        . '.height(' . $height . ')'
                                        . '.stacked(false)'
                                        . '.showControls(false)'
                                        . '.reduceXTicks(false)'
                                        . '.color(["#337ab7", "#ce4844", "#3c763d"])'
                                        . ';'

                                    . "var svg = d3.select("#' . $id . '").datum(data);'
                                    . 'svg.transition().duration(0).call(chart);'

                                    . 'return chart;'
                                . '},'
                                . 'callback: function(graph) {'
                                    . 'nv.utils.windowResize(function() {'
                                        . 'var width = nv.utils.windowSize().width;'
                                        . 'var height = nv.utils.windowSize().height;'
                                        . 'graph.width(width).height(height);'

                                        . "d3.select("#' . $id . '")'
                                            . '.attr("height", height)'
                                            . '.transition().duration(0)'
                                            . '.call(graph);'
                                    . '});'
                                . '}'
                            . '});'
                        . '});'
                    . '</script>';
        }
        else {
            return '';
        }
    }
    
    public function tiles($attributes, $contents = NULL) {
        extract(shortcode_atts(array(
            'id' => '',
        ), $attributes));
        
        wp_enqueue_script('unitegallery', get_bloginfo('template_directory') . '/js/unitegallery.min.js');
        wp_enqueue_script('unitegallery-tiles', get_bloginfo('template_directory') . '/js/tiles.js');
        wp_enqueue_style('unitegallery', get_bloginfo('template_directory') . '/css/unitegallery.css');
        
        if (!empty($id)) {
            return '<script type="text/javascript">'
                . '$(document).ready(function() {'
                    . '$("#' . $id . '").unitegallery({'
                        . 'tile_enable_textpanel: true,'
                        . 'tile_textpanel_title_text_align: "center",'
                        . 'tile_textpanel_always_on: true,'
                        . 'tiles_type: "justified",'
                    . '});'
                . '});'
            . '</script>';
        }
        else {
            return '';
        }
    }
    
    /**
     * Display several readings as accordion.
     * 
     * @param array $attributes
     * @param string $content
     */
    public function readings($attributes, $contents = NULL) {
        extract(shortcode_atts(array(
            'ids' => '',
        ), $attributes));
        
        if (!empty($ids)) {
            $readings = array_map('trim', explode(',', $ids));
            
            $html = '<div class="panel" role="tablist" aria-multiselectable="true">';
            foreach ($readings as $id) {
                $reading = get_post($id);
                
                if ($reading != NULL) {
                    $panel_id = 'panel-' . time() . '-' . $reading->ID;
                    $html .= '<div class="panel-group panel-default">'
                                . '<div class="panel-heading" role="tab">'
                                    . '<h4 class="panel-title">'
                                        . '<a data-toggle="collapse" href="#' . $panel_id . '" aria-expanded="true" aria-controls="' . $panel_id . '">' 
                                            . get_field('reference', $reading->ID)
                                            // . ' <a href="' . get_field('pdf', $reading->ID) . '" target="_blank">PDF</a>'
                                        . '</a>'
                                    . '</h4>'
                                . '</div>'
                                . '<div class="panel-collapse collapse" id="' . $panel_id . '">'
                                    . '<div class="panel-body">'
                                        . do_shortcode($reading->post_content)
                                    . '</div>'
                                . '</div>'
                            . '</div>';   
                }
            }
            
            return $html . '</div>';
        }
        else {
            return '';
        }
    }

    /**
     * More spam resistent mails.
     *
     * @param array $attributes
     * @param string $content
     */
    function hide_mail($attributes, $content = NULL) {
        extract(shortcode_atts(array(
            'mail' => '',
            'class' => '',
        ), $attributes));
        
        if (!empty($mail)) {
            return '<a class="' . $class . '" href="mailto:' . antispambot($mail) . '">' . antispambot($mail) . '</a>';
        }
    }
}

new IAMDAVIDSTUTZ_Shortcodes();

?>