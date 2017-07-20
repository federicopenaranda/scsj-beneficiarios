<?php 
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedades y metodos de CAction
*/ 
class Update extends CAction
{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de actualizar todos los registros de una tabla en la base de datos
* @param array $callback se introduce el nombre de una funcion
*/
    public function run(){
		$controller=$this->getController();
		$respuesta=new stdClass();
		if(isset($_GET['records'])){
			$records=CJSON::decode($_GET['records']);
			if(isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
				$callback=$_GET['callback'];			
				if(isset($records['id_entidad']) && isset($records['fk_id_tipo_entidad']) && isset($records['nombre_entidad']) && isset($records['fecha_inicio_actividades_entidad']) && isset($records['fecha_fin_actividades_entidad']) && isset($records['direccion_entidad']) && isset($records['observaciones_entidad']) && true){
					$model=Entidad::model()->findByPk($records['id_entidad']);
					if($model!==null){
						if($model->validaFK('tipo_entidad','id_tipo_entidad',$records['fk_id_tipo_entidad'])!==false){
							$model->fk_id_tipo_entidad=$records['fk_id_tipo_entidad'];
							$model->nombre_entidad=$records['nombre_entidad'];
							$model->fecha_inicio_actividades_entidad=$records['fecha_inicio_actividades_entidad'];
							$model->fecha_fin_actividades_entidad=$records['fecha_fin_actividades_entidad'];
							$model->direccion_entidad=$records['direccion_entidad'];
							$model->observaciones_entidad=$records['observaciones_entidad'];
							#$model->fecha_creacion_entidad=$records['fecha_creacion_entidad'];
							if($model->save()){
								$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}else{
								$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}
						}else{
							$respuesta->meta=array("success"=>"false","msg"=>"Error de clave forenea");
							$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
						}
					}else{
						$respuesta->meta=array("success"=>"false","msg"=>"id fuera de rango");
						$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
					}
				}else{
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));		
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error de filtrado");
			$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>''));
		}
	}
}
?>