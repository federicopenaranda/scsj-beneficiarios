<?php
/**
* Esta es la clase controlador que hereda de Controller
*/
class ReporteController extends Controller{
	public function filters(){
		return array('accessControl'
			
		);
	}
	/**
	* La funcion accessRules es un filtro donde se autentifica los permisos para cada accion 
	* @return array retorna todas las acciones definidas en un array
	*/
	public function accessRules(){
		/*$objusu=new Usuario();
		$nombre=Yii::app()->user->name;
		$aux=$objusu->listaAcciones($nombre,'controlador');
		
		$arra=array(
		array('allow',
			'actions'=>array('login','logout'),
			'users'=>array('*'),
			),
		array('allow',
			'actions'=>$aux,
			'users'=>array('*'),
			),
		array('deny',
			'users'=>array('*'),
			),	
		);
		return $arra;*/
		return array(
			array('allow',
				'actions'=>array('login','logout'),
				'users'=>array('*'),
				),
			array('allow',
				'actions'=>array('reporte','reporte1','reporte2','reporte3','reporte5','reporte6','reporteEx1'),
				'users'=>array('*'),
				),
			array('deny',
				'users'=>array('*'),
				),
		);
	}
	
	public function actions(){
		return array(
			'reporte'=>'application.controllers.Reporte.Reporte',
			'reporte1'=>'application.controllers.Reporte.Reporte1',
			'reporte2'=>'application.controllers.Reporte.Reporte2',
			'reporte3'=>'application.controllers.Reporte.Reporte3',
			'reporte5'=>'application.controllers.Reporte.Reporte5',
			'reporte6'=>'application.controllers.Reporte.Reporte6',
			'reporteEx1'=>'application.controllers.Reporte.ReporteEx1',
		);
	}
}