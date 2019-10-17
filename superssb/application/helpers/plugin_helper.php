<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if( ! defined('DS')) define('DS', DIRECTORY_SEPARATOR);

class Plugin
{
    function run($params)
	{
		$widget_id = isset($params['widget_id']) ? $params['widget_id'] : '';
		$title = isset($params['title']) ? $params['title'] : '';
		$name = isset($params['url']) ? $params['url'] : '';
		$options = isset($params['option']) ? json_decode(out($params['option']), TRUE) : array();
		$position = isset($params['position']) ? $params['position'] : '';

		$ci = & get_instance();
		
		$current_theme = $ci->config->item('user_path');
		$plugin_path = FCPATH.'themes'.DS.'public'.DS.$current_theme.DS.'widget';

		$path = $plugin_path.'/'.$name.'/'.$name.EXT;
		
		/* plugin directory trigger */
		if( ! file_exists($path)){
			return;
		}

        require_once $path;
        $name = ucfirst($name);
        
		if( ! class_exists($name)){
			die('Class '.$name.' not exists.');
		}
		
		$widget = new $name();
		/* call widget */
		$add = array('title' => $title, 'widget_id' => $widget_id);
		$options = array_merge($options, $add);
		obj_register_action($position, $widget, 'run', $options);
    }

	function run_once($params)
	{
		$title = isset($params['title']) ? $params['title'] : '';
		$name = isset($params['url']) ? $params['url'] : '';
		$options = isset($params['option']) ? json_decode(out($params['option']), TRUE) : array();
		$position = isset($params['position']) ? $params['position'] : '';

		$ci = & get_instance();
		
		$current_theme = $ci->config->item('user_path');
		$plugin_path = FCPATH.'themes'.DS.'public'.DS.$current_theme.DS.'widget';

		$path = $plugin_path.'/'.$name.'/'.$name.EXT;
		
		/* plugin directory trigger */
		if( ! file_exists($path)){
			return;
		}

        require_once $path;
        $name = ucfirst($name);
		
		$widget = new $name();

		/* call widget css */
		obj_register_action('THEME_CSS', $widget, 'theme_css', $options);
		/* call widget js */
		obj_register_action('THEME_JS', $widget, 'theme_js', $options);
		/* call widget head content */
		obj_register_action('THEME_HEAD', $widget, 'theme_head', $options);
	}
    
    function render($view, $data = array(), $buffer=FALSE)
	{
		$ci = & get_instance();
		$current_theme = $ci->config->item('user_path');
		$plugin_path = FCPATH.DS.'themes'.DS.'public'.DS.$current_theme.DS.'widget';
		
		$plugin_name = strtolower(strtoupper(get_class($this)));
        extract($data);
		$path = $plugin_path.'/'.$plugin_name.'/views/'.$view.EXT;
		ob_start();
		include $path;
		$c = ob_get_contents();
		ob_end_clean();
		
		if( ! $buffer) echo $c;
		else return $c;
    }

    function load($object) {
        $this->$object =& load_class(ucfirst($object));
    }

    function __get($var) {
        static $ci;
        isset($ci) OR $ci = get_instance();
        return $ci->$var;
    }
}