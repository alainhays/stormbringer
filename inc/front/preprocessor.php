<?php

function stormbringer_preprocessor()
{
	$preprocessor = 'less';
	if(get_theme_support('preprocessor')[0] != ''){
		$preprocessor = get_theme_support('preprocessor')[0];
	}

  if ($preprocessor == 'less') {
    if (!is_admin()) {
      // less.js for admin (development only)
      //if ( current_user_can('administrator') && (ENVIRONMENT == "dev" || ENVIRONMENT == "local")) {
      if (current_user_can('administrator') && $_GET['lesscompile'] != '1') {
        echo '<!-- Less -->' . "\n";
        echo '<link rel="stylesheet/less" href="' . get_template_directory_uri() . '/less/_application.less"/>' . "\n";
        echo '<script src="http://cdnjs.cloudflare.com/ajax/libs/less.js/'.get_theme_support('libraries')[0]['lessjs'].'/less.min.js"></script>' . "\n";
        echo "<script type='text/javascript'>less.env = 'development';less.async = true;less.poll = 600;less.watch();</script>" . "\n";
      } // compile with lessphp http://leafo.net/lessphp/ for users
      else {
        $to_cache = array(STYLESHEETPATH . '/less/_application.less' => '');
        Less_Cache::$cache_dir = STYLESHEETPATH . '/css/';
        $css_file_name = Less_Cache::Get($to_cache);
        wp_register_style('stormbringer-app', get_template_directory_uri() . '/css/application.css', array(), null, null);
        wp_enqueue_style('stormbringer-app');
      }

    }
  }

  if ($preprocessor == 'scss') {
    if (!is_admin()) {
      if (current_user_can('administrator') || $_GET['scsscompile'] == '1') {
        if(defined('LIVERELOAD') && LIVERELOAD==true){
            $livereloadurl = get_bloginfo('url').':35729';
            if(defined('LIVERELOAD_URL')) $url = LIVERELOAD_URL;
            echo '<script src="'.$livereloadurl.'/livereload.js"></script>' . "\n";

        }
        wp_register_style('stormbringer-app', get_template_directory_uri() . '/css/application.css', array(), null, null);
        wp_enqueue_style('stormbringer-app');
      }
      else{
        wp_register_style('stormbringer-app', get_template_directory_uri() . '/css/application.min.css', array(), null, null);
        wp_enqueue_style('stormbringer-app');
      }
    }
  }

}
add_action('wp_enqueue_scripts', 'stormbringer_preprocessor',10);

