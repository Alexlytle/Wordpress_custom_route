<?php


class Custom_Route {

/**
 *  How to use:
 *  Require this in functions.php file
 *  Create a new instance of this class:
 *
 *  Argument 1: Url file path
 *  Argument 2: Array of query variables that come from the url path. Number of regex in url file path must match the amount of query params
 *  Argument 3: file path to template
 *  Argument 4: Boolean. True will rebuild the permalink structure. Recomend you dont use this for production. 
 * 
 *  Example:
 *  new Custom_Route('my-unique-route/(.+?)/(.+?)/?$',array('param_1','param_2'),'public/path_to_template_file.php',true);
 * 
 *  Template File:
 *  To get the value of query variable just echo get_query_var('param_1');
 * 
*/
    public $route_name;

     public $query_name;

     public $route_path;
	
     public $params;

     public $forch_flush;

     public function __construct($route_name,$query_name,$route_path,$forch_flush) 
	{

		$this->route_name = $route_name;
		$this->query_name = $query_name;
		$this->route_path = $route_path;
		$this->forch_flush = $forch_flush;
		
		$this->query_name_array = $query_name;
	
		add_action('init' , array($this,'add_custom_rewrite'));
		add_filter('query_vars' ,  array($this, 'add_custom_query_vars'));
		add_action('template_include' , array($this, 'add_custom_template_include'));
		add_action('init', array($this,'change_permalinks_option'));

		add_action('after-switch-theme', array($this,'change_permalinks_option'));
	
		
	}

    public function add_custom_rewrite()
    {
		$str = '';
		$keys=1;
		   foreach ($this->query_name_array  as $value) {
			   $str .= $value .'=$matches['.$keys.']&';
			   $keys++;
		   }
		add_rewrite_rule( $this->route_name , 'index.php?'. $str , 'top' );
    }


    public function add_custom_query_vars($query_vars)
    {
		foreach ($this->query_name_array as $value) {
			$query_vars[] = $value;
		}
		
		return $query_vars;
    }


    public function add_custom_template_include($template)
    {
		foreach ($this->query_name_array as $value) {
			if ( get_query_var( $value ) == false || get_query_var( $value ) == '' ) {
				return $template;
			}else{
				return  get_template_directory() . $this->route_path;
			}
		}
    }



	public function change_permalinks_option()
	{
		if($this->forch_flush == true){
			global $wp_rewrite;
			$wp_rewrite->set_permalink_structure('/%postname%/');
			$wp_rewrite->flush_rules();
		}
	
	}



}
