<?php
/**
 * Menus
 *  
 * @author Joe Nilson Zegarra Galvez
 * @version 0.1 Alpha
 */

class Menus extends Zend_Db_Table
{
	protected $_name = 'system_menus';
	public function allMenus()
	{
		$select = $this->getAdapter()->select();
		$select ->from($this->_name)
				->order("ord_menu");
		$resultado = $select->query();
		return $resultado->fetchAll();
	}

	public function listarMenus($user)
	{
		$select = $this->getAdapter()->select();
		$select->from(array('m'=>$this->_name),array('m.des_menu','m.img_menu','m.url_menu'))
				->where("mu.userid = ?",$user)
				->where("m.estado = ?",'t')
				->join(array('mu'=>'system_menus_usuarios'),"m.cod_menu = mu.cod_menu",'mu.cod_menu')
				->order("m.ord_menu");
		$resultado = $select->query();
		return $resultado->fetchAll();
	}

	public function listarTodosMenus()
	{
		$select = $this->getAdapter()->select();
		$select->from($this->_name,array('cod_menu','des_menu'))
				->where("estado = ?",'t')
				->order("ord_menu");
		//$resultado = $select->__toString();
		//return $resultado;
		$sql = $select->query();
		$datos = $sql->fetchAll();
		$datosMenus=array();
		for ($i = 0; $i < count($datos); $i++) {
			$datosMenus[$datos[$i]['cod_menu']]=$datos[$i]['des_menu'];
		}
		return $datosMenus;
	}
}