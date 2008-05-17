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
	}

	public function loginAction() {
		// TODO Auto-generated AuthController::loginAction() action
		$this->_helper->layout->setLayout('loginLayout');
		$this->view->pageTitle = "Hablame!";
        $this->view->bodyTitle = '<h1>Hello World!</h1>';
        $this->view->bodyCopy = "<p>Lorem ipsum dolor etc.</p>";
		
	}
}
