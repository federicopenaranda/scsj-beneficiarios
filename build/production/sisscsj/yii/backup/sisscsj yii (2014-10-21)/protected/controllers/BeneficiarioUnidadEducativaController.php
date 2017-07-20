<?php
/**
* Esta es la clase controlador que hereda de Controller
*/
class BeneficiarioUnidadEducativaController extends Controller{
	/**
	* La funcion filters() se definen todas los filtros del controlador
	* @return array retorna todas los filtros definidas en un array
	*/
	public function filters(){
		return array('accessControl'
			
		);
	}
	/**
	* La funcion accessRules es un filtro donde se autentifica los permisos para cada accion 
	* @return array retorna todas las acciones definidas en un array
	*/
	public function accessRules(){
		return array(
			array('allow',
				'actions'=>array('login','logout'),
				'users'=>array('*'),
				),
			array('allow',
				'actions'=>array('index','create','update','delete'),
				'users'=>array('*'),
				),
			array('deny',
				'users'=>array('*'),
				),
		);
	}
	/**
	* La funcion actions() se definen todas las acciones del controlador	
	* @return array retorna todas las acciones definidas en un array	
	*/
	public function actions(){
		return array(
				'create'=>'application.controllers.BeneficiarioUnidadEducativa.Create',
				'index'=>'application.controllers.BeneficiarioUnidadEducativa.Read',
				'update'=>'application.controllers.BeneficiarioUnidadEducativa.Update',
				'delete'=>'application.controllers.BeneficiarioUnidadEducativa.Delete',
		);
	}
}