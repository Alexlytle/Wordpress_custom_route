How to use:
Require this class from themes function.php file
Create a new instance of this class:
 
Argument 1: Url file path
Argument 2: Array of query variables that come from the url path. Number of regex in url file path must match the amount of query params
Argument 3: file path to template
Argument 4: Boolean. True will rebuild the permalink structure. Recomend not to use this for production as it will cause force rebuild of permalink structure everytime. 
            I recomond using the activation hook for plugins or for a theme use(this is already built into the class)
            add_action('after-switch-theme', array($this,'change_permalinks_option'));
 
Example:
new Custom_Route('my-unique-route/(.+?)/(.+?)/?$',array('param_1','param_2'),'public/path_to_template_file.php',true);
 
Template File:
To get the value of query variable do the following
Example:
echo get_query_var('param_1');
  
