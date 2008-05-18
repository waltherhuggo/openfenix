<?php

/**
 * AuthController
 * 
 * @author
 * @version 
 */

require_once 'Zend/Controller/Action.php';

class AuthController extends Zend_Controller_Action {
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
		// TODO Auto-generated AuthController::indexAction() default action
		$this->_redirect('/');
	}

	public function loginAction() {
		// TODO Auto-generated AuthController::loginAction() action
		$this->_helper->layout->setLayout('loginLayout');
		$this->view->pageTitle = "openFenix 2.0";
	}
	public function dologinAction() {
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
 		//Recibimos los datos del Formulario
		Zend_Loader::loadClass('Zend_Filter_StripTags');
		$f = new Zend_Filter_StripTags();
		$module = $f->filter($this->_request->getPost('module'));
		$username = $f->filter($this->_request->getPost('loginUsername'));
		$password = $f->filter($this->_request->getPost('loginPassword'));
		if(!empty($module)&&$module=='loginOF'){
			// Configuramos el Zend_Auth para trabajar con la tabla de usuarios
			Zend_Loader::loadClass('Zend_Auth_Adapter_DbTable');
			$dbAdapter = Zend_Registry::get('dbAdapter');
			$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
			$authAdapter->setTableName('system_users');
			$authAdapter->setIdentityColumn('userlogin');
			$authAdapter->setCredentialColumn('userpass');
			
			//Configuramos los Valores del Usuario a identifiar
			$authAdapter->setIdentity($username);
			$authAdapter->setCredential(md5($password));
			
			// Identificamos
			$auth = Zend_Auth::getInstance();
			$result = $auth->authenticate($authAdapter);
			if ($result->isValid()) {
				// success: store database row to auth's storage
				// system. (Not the password though!)
				$data = $authAdapter->getResultRowObject(null,'password');
				$auth->getStorage()->write($data);
				$json = "{success:true}";
			} else {
				// failure: clear database row from session
				$json = "{success: false, errors: { reason: 'Login failed. Try again.' }}";
			}
	    	echo $json;
		} else {
		    echo "{success: false, errors: { reason: 'Login failed. Try again.' }}";
		}
	}
}
