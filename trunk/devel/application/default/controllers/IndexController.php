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
		$auth = Zend_Auth::getInstance();
		if (!$auth->hasIdentity()) {
			$this->_redirect('auth/login');
		}
	}
	
	 function init()
	{
		// Render sidebar for every action
        $response = $this->getResponse();
        //$response->insert('sidebar', $this->view->render('sidebar.phtml')); 
		$this->initView();
		//$this->view->user = Zend_Auth::getInstance()->getIdentity();
		/*
		$this->view->baseImg = "theader_index.jpg";
*/
		Zend_Loader::loadClass('Users');
		Zend_Loader::loadClass('Menus');
		Zend_Loader::loadClass('Submenus');
		Zend_Loader::loadClass('Zend_Json');
	}

	/**
	 * The default action - show the home page
	 */
    public function indexAction() 
    {
        // TODO Auto-generated IndexController::indexAction() action
       	$userOn = Zend_Auth::getInstance()->getIdentity();
       	$menus = new Menus();
       	$this->view->lmenus=$menus->listarMenus($userOn->id);
    	$this->view->pageTitle = "openFenix 2.0 ";
        $this->view->bodyTitle = "Bienvenido: ".$userOn->username;
        $this->view->bodyCopy = "<p>Esto no necesariamente va aqui.</p>";
    	
    }
    public function getnodesAction()
    {
    	$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		$userOn = Zend_Auth::getInstance()->getIdentity();
       	$menus = new Menus();
       	$this->view->lmenus=$menus->listarMenus($userOn->id);
		$smenus=new Submenus();
		$arraySubmenus=array();
		$cMenu=$this->getRequest()->getParam('headerNode');
		$csMenu=$this->getRequest()->getParam('node');
		if($csMenu=='id')$csMenu=1;
		$listSubMenusUser=$smenus->listarCabecerasSMUsers($userOn->id,$cMenu,$csMenu);
		//echo count($listSubMenusUser);
		//print_r($listSubMenusUser);
		foreach ($listSubMenusUser as $ksMenu => $vsMenu)
		{
			$cls=(empty($vsMenu['href']))?"folder":"file";
			$arraySubmenus[]=array("text"=>$vsMenu['text'],"id"=>$vsMenu['id'],"href"=>$vsMenu['href'],"cls"=>$cls);
		}
		$json = $arraySubmenus;  
		$json = Zend_Json::encode($json);	
    	echo $json;
    }
}
