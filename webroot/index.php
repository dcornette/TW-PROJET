<?php 
define('WEBROOT', dirname(__FILE__));
define('ROOT', dirname(WEBROOT));
define('DS', DIRECTORY_SEPARATOR);
define('CORE', ROOT.DS.'core');
define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
define('REG_CONV','/&([A-za-z]{1,2})'.
                  '(?:acute|breve|caron|cedil|circ|dblac|die|dot|grave|macr|ogon|ring|tilde|uml|lig);'.
                  '|(&)amp;/'
       );

require CORE.DS.'includes.php';

new Dispatcher();
?>