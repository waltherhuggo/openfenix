<?php
class Submenus extends Zend_Db_Table
{
	protected $_name = 'submenus';
	public function allSubmenus()
	{
		$select = $this->getAdapter()->select();
		$select ->from($this->_name)
				->order(array("orderfield"));
		$resultado = $select->query();
		return $resultado->fetchAll();
	}

	public function listarSmenus($user,$cmenu)
	{
		$select = $this->getAdapter()->select();
		$select->from(array('m'=>$this->_name),array('m.id','m.text','m.href','m.parent_id','m.target','m.title'))
				->where("su.logusu = ?",$user)
				->where("m.estado = ?",'t')
				->where("m.cod_menu = ?",$cmenu)
				->where("su.cod_menu = ?",$cmenu)
				->join(array('su'=>'submenus_usuarios'),"m.id = su.id",'su.id')
				->order("m.orderfield");
		$resultado = $select->query();
		$resSMenu=array(); $resSSMenu=array(); $resPMenu=array();
		foreach ($resultado->fetchAll() as $k=>$v)
		{
		  if($v['parent_id']==1){
		      $indice=strlen($v['id']);
		      $resPMenu[$indice][$v['id']]=array(
			  		'parent_id'=>$v['parent_id'],
			  		'text'=>$v['text'],
			  		'href'=>$v['href'],
			  		'target'=>$v['target'],
			  		'title'=>$v['title'],
		  			'id'=>$v['id']
		          );
		  }elseif((strlen($v['parent_id'])==2)&&(strlen($v['id'])==3)){
		      $resSSMenu[$v['parent_id']][$v['id']]=array(
			  		'parent_id'=>$v['parent_id'],
			  		'text'=>$v['text'],
			  		'href'=>$v['href'],
			  		'target'=>$v['target'],
			  		'title'=>$v['title'],
		  			'id'=>$v['id']
		          );
		  }else{
		      $resSMenu[$v['parent_id']][$v['id']]=array(
			  		'parent_id'=>$v['parent_id'],
			  		'text'=>$v['text'],
			  		'href'=>$v['href'],
			  		'target'=>$v['target'],
			  		'title'=>$v['title'],
		  			'id'=>$v['id']
		          );
		  }
		}
		$resTotal=array($resPMenu,$resSMenu,$resSSMenu);
        return $resTotal;
	}

	public function crearSmenus($datosSmenus)
	{
		$datosIngreso=array(
				'id'=>$datosSmenus['id'],
				'parent_id'=>$datosSmenus['parent_id'],
				'text'=>$datosSmenus['text'],
				'href'=>$datosSmenus['href'],
				'title'=>$datosSmenus['title'],
				'icon1'=>$datosSmenus['icon1'],
				'icon2'=>$datosSmenus['icon2'],
				'target'=>$datosSmenus['target'],
				'orderfield'=>$datosSmenus['orderfield'],
				'expanded'=>$datosSmenus['expanded'],
				'cod_menu'=>$datosSmenus['cod_menu'],
				'user_perm'=>$datosSmenus['user_perm'],
				'estado'=>$datosSmenus['estado']
		);
		$select = $this->getAdapter()->insert($datosIngreso);
	}

	public function listarCabecerasSubmenus()
	{
		$select = $this->getAdapter()->select();
		$select->from($this->_name,array('id','text'))
				->where("estado = ?",'t')
				->where("parent_id = ?",1)
				->order("orderfield");
		//$resultado = $select->__toString();
		//return $resultado;
		$sql = $select->query();
		$datos = $sql->fetchAll();
		$datosSubmenus=array();
		for ($i = 0; $i < count($datos); $i++) {
			$datosSubmenus[$datos[$i]['id']]=$datos[$i]['text'];
		}
		return $datosSubmenus;
	}
}