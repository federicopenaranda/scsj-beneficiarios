<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda de CAction
*/ 
class FechaNacimiento extends CAction
{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de listar todos los registros de una tabla en la base de datos
* @param array $callback se introduce el nombre de una funcion
*/
	public function run()
	{
		$controller=$this->getController();
		$respuesta=new stdClass();
		$callback=$_GET['callback'];
		$obj=new Familia();
		$f=$obj->fecha($_GET['id']);
		$fecha_nacimiento =$f[0]['fecha'];
		$fecha_control = date("Y-m-d");
		#echo $fecha_nacimiento;
		$tiempo= Yii::app()->fecha->tiempo_transcurrido($fecha_nacimiento, $fecha_control);
 		$texto = "$tiempo[0] anios con $tiempo[1] meses y $tiempo[2] dias";
   		#print "edad: ".$texto."<br>";
		$respuesta->meta=array("success"=>"true","msg"=>$texto);
		$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
	}
}