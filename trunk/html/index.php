<?php
/**
 * openFenix 2.0  Framework project
 * 
 * @author  Joe Nilson
 * @version 2.0.0.0 Alpha 1
 */

set_include_path('.' . PATH_SEPARATOR . '../library' . PATH_SEPARATOR . './application/default/models/' . PATH_SEPARATOR . get_include_path());

/**
 * Llamada a Classes del ZF
 */
include "Zend/Loader.php";
Zend_Loader::loadClass('Zend_Controller_Front');
Zend_Loader::loadClass('Zend_Config_Ini');
Zend_Loader::loadClass('Zend_Registry');
Zend_Loader::loadClass('Zend_Db');
Zend_Loader::loadClass('Zend_Db_Table');
Zend_Loader::loadClass('Zend_Debug');
Zend_Loader::loadClass('Zend_Auth');

if(file_exists('../application/config/config2.ini'))
{
	//Cargar Configuracion del Archivo INI
	$config = new Zend_Config_Ini('../application/config/config.ini', 'general');
	$registry = Zend_Registry::getInstance();
	$registry->set('config', $config);
	
	//Configurando Base de Datos
	$db = Zend_Db::factory($config->db->adapter,
	$config->db->config->toArray());
	Zend_Db_Table::setDefaultAdapter($db);
	Zend_Registry::set('dbAdapter', $db);
	
	require_once 'Zend/Controller/Front.php';
	
	
	/**
	 * Setup controller
	 */
	$controller = Zend_Controller_Front::getInstance();
	$controller->setControllerDirectory('../application/default/controllers');
	$controller->throwExceptions(true); // should be turned on in development time 
	
	// run!
	$controller->dispatch();
}else{
	die("<center><h1>NO SE ENCUENTRA ARCHIVO DE CONFIGURACION, NO SE PUEDE CONTINUAR</h1></center>");
}