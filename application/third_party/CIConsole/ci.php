<?php

// Status debugging
define('DEBUG', false);

// Error reporting
if (DEBUG) {
    ini_set('error_reporting', E_ALL);
    error_reporting(E_ALL);
} else {
    ini_set('error_reporting', 0);
    error_reporting(0);
}

// Slashes for Windows and Unix system family
if (PHP_OS == 'WIN32' || PHP_OS == 'WINNT')
    define('DS', '\\');
else
    define('DS', '/');

// Path at now shell directory
define('BASEPATH', getcwd());
// Path at ci.php run directory
define('CIPATH', dirname(__FILE__));

// Our script must run only CLI mode
if (! defined('STDIN')) die('Run only CLI mode');

// Autoload base classes
function __autoload($className) {
    if (DEBUG) echo "Initialize $className\n";
    require_once CIPATH . DS . 'core' . DS . $className . '.php';
}

// Get array arguments
$argv = $_SERVER['argv'];

$bundle = new Bundle;
$template = new Template($argv);

switch ($argv[1]) {
    case 'create':
        
        switch ($argv[2]) {
            case 'application':            
                $bundle->install('codeigniter-2.0.3');
                break;

            case 'controller':
                $template->create('controllers');
                break;
            
            case 'model':
                $template->create('models');
                break;
            
            case 'view':
                $template->create('views');
                break;
            
            case 'helper':
                $template->create('helpers');
                break;
                
            default:
                die('Not right create command!');
                break;
        }

        break;
   
    case 'remove':      
    
        switch ($argv[2]) {
            case 'application':
              
                $bundle->uninstall('codeigniter-2.0.3');
                break;

            case 'controller':
                $template->remove('controllers');
                break;
            
            case 'model':
                $template->remove('models');
                break;
            
            case 'view':
                $template->remove('views');
                break;
            
            case 'helper':
                $template->remove('helpers');
                break;
                
            default:
                break;
        }

        break;
    
    case 'bundle':
        
        switch ($argv[2]) {
        
            case 'install':
                $bundle->install($argv[3]);
                break;

            case 'uninstall':
                $bundle->uninstall($argv[3]);
                break;
            
            case 'readme':   
                $bundle->readme($argv[3]);
                break;
                
            case 'list':
            default:
                $bundle->_list();
                break;
        }
        
        break;

    // Alias
    case 'install':
        $bundle->install($argv[2]);
        break;
        
    case 'uninstall':
        $bundle->uninstall($argv[2]);
        break;
    
    case 'readme':   
        $bundle->readme($argv[2]);
        break;
    
    case 'list':
        $bundle->_list();
        break;

    case 'help':  
    case '?':
        readfile(CIPATH . DS . 'doc' . DS . 'readme');
        break;
    
    case 'deploy':    
        $deploy = new Deploy($argv[2]);
        $deploy->deploy();
        break;
    
    case 'generate':      
        $generate = new Generate($argv);
        
        // Autoload public method at Generate class
        if (method_exists($generate, $argv[2])) {
            $ref = new ReflectionMethod($generate, $argv[2]);
            if ($ref->isPublic())
                $generate->{$argv[2]}();
            else
                die("$argv[2] is not public function\n");
        } else {
            die("Not right generate command\n");
        }  
        break;
    
    default:
        die("Not right command. May be help? ci help\n");
        break;
}
