<?php
class Users extends Zend_Db_Table
{
	protected $_name = 'system_users';
	public function generalesUsers($user)
	{
		$where = $this->getAdapter()->select();
		$where	->from($this->_name,array('usercountry','userbranch','username'))
				->where("userlogin = ?",$user);
		$resultado = $where->query();
		return $resultado->fetchAll();
	}
	public function busquedaUsuarios($field,$user)
	{
		$where = $this->getAdapter()->select();
		$where	->from($this->_name,array('userlogin','username'))
				->where("$field like ?","%$user%");
		$resultado = $where->query();
		return $resultado->fetchAll();
		//$resultado = $where->__toString();
		//return $resultado;//->fetchAll();
	}
}