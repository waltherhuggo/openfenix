<?php

/**
 * IndexController - The default controller class
 * 
 * @author Joe Nilson
 * @version 1
 */

require_once 'Zend/Controller/Action.php';

class IndexController extends Zend_Controller_Action {
	/*
	 * If has no auth user go to auth to do login
	 */
	/*
	function preDispatch() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'auth/login' );
		}
	}
	*/
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
		// TODO Auto-generated IndexController::indexAction() action
		$this->_helper->layout->setLayout('mainApp');
	}
}
