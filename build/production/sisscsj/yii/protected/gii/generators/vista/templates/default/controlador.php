<?php
/**
* nombre de la tabla <?php echo $tableName; ?>
*  nombre del Modelo <?php echo $modelClass; ?>
*/
?>
<?php echo "<?php\n"; ?>
/**
 * Este es el controlador para el modelo "<?php echo $modelClass; ?>".
 */
class <?php echo $modelClass; ?>Controller extends <?php echo $this->baseClass."\n"; ?>
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
    	$objusu = new Usuario();
		$nombre = Yii::app()->user->name;
		$aux = $objusu->listaAcciones($nombre,'controlador');
		
		$arreglo = array(
		array('allow',
			'actions'=>array('login','logout'),
			'users'=>array('*'),
			),
		array('allow',
			'actions'=>$aux,
			'users'=>array('@'),
			),
		array('deny',
			'users'=>array('*'),
			),	
		);
		return $arreglo;
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
				'create'=>'application.controllers.<?php echo $modelClass; ?>.create',
				'index'=>'application.controllers.<?php echo $modelClass; ?>.read',
				'update'=>'application.controllers.<?php echo $modelClass; ?>.update',
				'delete'=>'application.controllers.<?php echo $modelClass; ?>.delete',
		);
	}
}
