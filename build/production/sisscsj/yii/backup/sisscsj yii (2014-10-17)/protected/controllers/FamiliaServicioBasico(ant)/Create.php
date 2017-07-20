<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedad y metodos de la clase padre CAtion
*/ 
class Create extends CAction{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de crear un nuevo registro y adicionarlo en una tabla
* @param array $callback se introduce el nombre de una funcion
*/
   public function run(){
		$controller=$this->getController();
		$respuesta=new stdClass();
		$model=new FamiliaServicioBasico();
		
		if(isset($_GET['records']))
		{
			$records=CJSON::decode($_GET['records']);

			if ( isset($_GET['callback']) && $_GET['callback']!=='' && !is_numeric($_GET['callback']))
			{
				$callback=$_GET['callback'];

				if( isset($records['fk_id_servicio_basico']) && 
					isset($records['fk_id_familia']) && 
					isset($records['observacion_familia_servicio_basico']) && 
					isset($records['estado_familia_servicio_basico']))
					{
					if($records['estado_familia_servicio_basico']=='true' || $records['estado_familia_servicio_basico']===true){
						$records['estado_familia_servicio_basico']=1;
					}
					if($records['estado_familia_servicio_basico']=='false' || $records['estado_familia_servicio_basico']===false){
						$records['estado_familia_servicio_basico']=0;
					}
					if($model->validaFK('familia','id_familia',$records['fk_id_familia'])!==false && $model->validaFK('servicio_basico','id_servicio_basico',$records['fk_id_servicio_basico'])!==false){
						$model->fk_id_servicio_basico=$records['fk_id_servicio_basico'];
						$model->fk_id_familia=$records['fk_id_familia'];
						$model->observacion_familia_servicio_basico=$records['observacion_familia_servicio_basico'];
						$model->estado_familia_servicio_basico=$records['estado_familia_servicio_basico'];
						#$model->fecha_creacion_familia_servicio_basico=$records['fecha_creacion_familia_servicio_basico'];
						if ($model->save()){
							$respuesta->meta=array("success"=>"true","msg"=>"Se creo exitosamente !!!");
							$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
						} else {
							$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
							$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));						
						}
					} else {
						$respuesta->meta=array("success"=>"false","msg"=>"Error llave foranea");
						$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
					}
				} else {
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
				}
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error variable indefinida quizas quiso decir records");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
	}
}