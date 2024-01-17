<?php

    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
    defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'xampp'.DS.'htdocs'.DS.'work'.DS.'blog-mgmt'.DS.'blog-mgmt-system');

    //Defines the paths of all the directories used within the site
    
    define('INC_PATH') ? null : define('INC_PATH', SITE_ROOT.DS.'includes');
    define('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT.DS.'core');

    //Load the config file

    require_once(INC_PATH.DS."config.php");

    //Core Classes

    require_once(CORE_PATH.DS."post.php");
    

?>