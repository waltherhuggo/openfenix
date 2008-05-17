<?php

/**
 * IndexController - The default controller class
 * 
 * @author
 * @version 
 */

require_once 'Zend/Controller/Action.php';

class IndexController extends Zend_Controller_Action 
{
	function preDispatch()
	{
		/*
		$auth = Zend_Auth::getInstance();
		if (!$auth->hasIdentity()) {
			$this->_redirect('auth/login');
		}
		*/
	}
	
	 function init()
	{
		// Render sidebar for every action
        $response = $this->getResponse();
        $response->insert('sidebar', $this->view->render('sidebar.phtml')); 
		/*
		$this->initView();
		$this->view->baseUrl = $this->_request->getBaseUrl();
		$this->view->user = Zend_Auth::getInstance()->getIdentity();
		
		$this->view->baseImg = "theader_index.jpg";
		Zend_Loader::loadClass('Users');
		Zend_Loader::loadClass('Menus');
		Zend_Loader::loadClass('Submenus');
		*/
	}

	/**
	 * The default action - show the home page
	 */
    public function indexAction() 
    {
        // TODO Auto-generated IndexController::indexAction() action
        $this->view->pageTitle = "Zend Layout Example";

        $this->view->bodyTitle = '<h1>Hello World!</h1>';
        $this->view->bodyCopy = "<p>Lorem ipsum dolor etc.</p>";
    	
    }
}
