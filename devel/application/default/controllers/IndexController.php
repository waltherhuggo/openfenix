<?php

/**
 * IndexController - The default controller class
 * 
 * @author Joe Nilson
 * @version 1
 */

require_once 'Zend/Controller/Action.php';

class IndexController extends Zend_Controller_Action {
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
		// TODO Auto-generated IndexController::indexAction() action
		$this->view->opciones="que pasara aqui?";
	}
}
