<?php
/**
 * Este es el controlador para el modelo "BeneficiarioFamilia".
 */
class BeneficiarioFamiliaController extends Controller
{
	/**
	* La funcion filters() se definen todas los filtros del controlador
	* @return array retorna todas los filtros definidas en un array
	*/
	public function filters()
    {
		return array('accessControl');
	}
    
	/**
	* La funcion accessRules es un filtro donde se autentifica los permisos para cada accion 
	* @return array retorna todas las acciones definidas en un array
	*/
	public function accessRules()
    {
   		$objusu=new Usuario();
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
		return $arra;
		/*return array(
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
		);*/
	}
    
	/**
	* La funcion actions() se definen todas las acciones del controlador	
	* @return array retorna todas las acciones definidas en un array	
	*/
	public function actions()
    {
		return array(
				'create'=>'application.controllers.BeneficiarioFamilia.Create',
				'index'=>'application.controllers.BeneficiarioFamilia.Read',
				'update'=>'application.controllers.BeneficiarioFamilia.Update',
				'delete'=>'application.controllers.BeneficiarioFamilia.Delete',
		);
	}
}
