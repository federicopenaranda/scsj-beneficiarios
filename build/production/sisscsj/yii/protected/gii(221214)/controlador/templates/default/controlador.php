<?php echo "<?php\n"; ?>
/**
* Esta es la clase controlador que hereda de Controller
*/
class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseClass; ?>{
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
				'create'=>'application.controllers.<?php echo $this->controller; ?>.Create',
				'index'=>'application.controllers.<?php echo $this->controller; ?>.Read',
				'update'=>'application.controllers.<?php echo $this->controller; ?>.Update',
				'delete'=>'application.controllers.<?php echo $this->controller; ?>.Delete',
		);
	}
}