<?php
/**
 * openFenix project
 * 
 * @author  Joe Nilson
 * @version 1
 */
set_include_path ( '.' . PATH_SEPARATOR . '../../library' . PATH_SEPARATOR . '../application/default/models/' . PATH_SEPARATOR . get_include_path () );
define ( 'ROOT_DIR', dirname ( dirname ( __FILE__ ) ) );

if (file_exists ( ROOT_DIR . '/application/config/openfenix.ini' )) {
	
	require_once 'Initializer.php';
	require_once "Zend/Loader.php";
	
	// Set up autoload.
	Zend_Loader::registerAutoload ();
	
	// Set up classes load
	Zend_Loader::loadClass ( 'Zend_Config_Ini' );
	Zend_Loader::loadClass ( 'Zend_Registry' );
	Zend_Loader::loadClass ( 'Zend_Db' );
	Zend_Loader::loadClass ( 'Zend_Db_Table' );
	Zend_Loader::loadClass ( 'Zend_Debug' );
	Zend_Loader::loadClass ( 'Zend_Auth' );
	Zend_Loader::loadClass ( 'Zend_Layout' );
	
	// Prepare the front controller. 
	$frontController = Zend_Controller_Front::getInstance ();
	
	// Change to 'production' parameter under production environemtn
	$frontController->registerPlugin ( new Initializer ( 'development' ) );
	
	// Dispatch the request using the front controller. 
	$frontController->dispatch ();

} else {
	die ( "<center><h1>NO SE ENCUENTRA ARCHIVO DE CONFIGURACION, NO SE PUEDE CONTINUAR</h1></center>" );
}

?>

