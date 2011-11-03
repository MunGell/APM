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

// Get array arguments
$argv = $_SERVER['argv'];

// enable autoloading of classes
require_once(getcwd() . '/application/third_party/MwbExporter/Core/SplClassLoader.php');
$classLoader = new SplClassLoader();
$classLoader->setIncludePath(getcwd() . '/application/third_party/');
$classLoader->register();

$filetype = 'php';
$setup = array(
	'filename'                      => '%entity%.%extension%',
	'extendTableNameWithSchemaName' => false,
    'entityNamespace'       => 'models',
    'indentation'           => 4,
);


switch($argv[1])
{
	case 'yml':
		// create a formatter
		$formatter = new \MwbExporter\Formatter\Doctrine2\Yaml\Loader($setup);
		$filetype = 'yml';
		break;
		
	case 'annotation':
		// create a formatter
		$formatter = new \MwbExporter\Formatter\Doctrine2\Annotation\Loader($setup);
		break;
		
	default:
		echo 'Error: select output format';
		exit();	
	break;
}
// parse the mwb file
$mwb = new \MwbExporter\Core\Workbench\Document($argv[2], $formatter);
echo $mwb->zipExport(getcwd(), $filetype);

/*
$setup = array(
    'enhancedManyToManyDetection' => true,
);
$setup = array(
    'bundleNamespace'               => 'Bar\Quux',
);

$setup = array(
    'useAnnotationPrefix'   => 'ORM\\', // symfony 2 beta 2
    //'useAnnotationPrefix' => 'ORM:', // symfony 2 beta 1
);
$setup = array(
    'useAutomaticRepository'        => true,
    'repositoryNamespace'           => 'Repo\Namespace'
);
$setup = array(
    'extendTableNameWithSchemaName' => true,
    'bundleNamespace'               => 'Bar\Quux',
);

*/