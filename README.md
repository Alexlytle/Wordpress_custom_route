How to use:
Require this class from themes function.php file<br>


Create a new instance of this class:<br>


  Argument 1: Url file path <br>
  
Argument 2: Array of query variables that come from the url path. Number of regex in url file path must match the amount of query params<br>

Argument 3: file path to template<br>

Argument 4: Boolean. True will rebuild the permalink structure. Recomend not to use this for production as it will cause force rebuild of permalink structure everytime. 
            I recomond using the activation hook for plugins or for a theme use(this is already built into the class)
            add_action('after-switch-theme', array($this,'change_permalinks_option'));
            
 <br>
Example with 2 params:<br>

new Custom_Route('my-unique-route/(.+?)/(.+?)/?$',array('param_1','param_2'),'/public/path_to_template_file.php',true);

 <br>
Example with 1 params:<br>

new Custom_Route('my-unique-route/(.+?)/(.+?)/?$',array('param_1','param_2'),'/public/path_to_template_file.php',true);

 <br>
 
Example with 0 params:<br>

new Custom_Route('my-unique-route',array(''),'/public/path_to_template_file.php',true);

 <br> 
Template File:<br>

To get the value of query variable do the following<br>

Example:<br>

echo get_query_var('param_1');<br>
  
