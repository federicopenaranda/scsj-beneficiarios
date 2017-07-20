<?php
/**
* Esta es la clase controlador que hereda de Controller
*/
class UsuarioController extends Controller{
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
				'actions'=>array('index','create','update','delete','lugar','idusuario','idbeneficiariotipo','idbeneficiario','listaPrivilegiosUsuario','beneficiariosUsuario'),
				'users'=>array('@'),
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
				'create'=>'application.controllers.Usuario.Create',
				'index'=>'application.controllers.Usuario.Read',
				'update'=>'application.controllers.Usuario.Update',
				'delete'=>'application.controllers.Usuario.Delete',
				'login'=>'application.controllers.Usuario.Login',
				'logout'=>'application.controllers.Usuario.Logout',
				'lugar'=>'application.controllers.Usuario.Lugar',
				'idusuario'=>'application.controllers.Usuario.Idusuario',
				'idbeneficiariotipo'=>'application.controllers.Usuario.Idbeneficiariotipo',
				'idbeneficiario'=>'application.controllers.Usuario.Idbeneficiario',
				'listaPrivilegiosUsuario'=>'application.controllers.Usuario.ListaPrivilegiosUsuario',
				'beneficiariosUsuario'=>'application.controllers.Usuario.BeneficiariosUsuario',
				
		);
	}
}