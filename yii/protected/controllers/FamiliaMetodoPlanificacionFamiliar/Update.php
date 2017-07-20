<?php 
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedades y metodos de CAction
*/ 
class Update extends CAction{
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
				if(isset($records['fk_id_familia']) && isset($records['fk_id_metodo_planificacion_familiar']) && isset($records['Fk_id_familia']) && isset($records['Fk_id_metodo_planificacion_familiar'])){
					$model=FamiliaMetodoPlanificacionFamiliar::model()->find(array('condition'=>'fk_id_familia=:fk_id_familia and fk_id_metodo_planificacion_familiar=:fk_id_metodo_planificacion_familiar','params'=>array(':fk_id_familia'=>$records['fk_id_familia'],':fk_id_metodo_planificacion_familiar'=>$records['fk_id_metodo_planificacion_familiar'])));
					$audi=new LogSistema();
					if($model!==null){
						if($model->validaFK('familia','id_familia',$records['fk_id_familia'])!==false && $model->validaFK('metodo_planificacion_familiar','id_metodo_planificacion_familiar',$records['fk_id_metodo_planificacion_familiar'])!==false && $model->validaFK('familia','id_familia',$records['Fk_id_familia'])!==false && $model->validaFK('metodo_planificacion_familiar','id_metodo_planificacion_familiar',$records['Fk_id_metodo_planificacion_familiar'])!==false){
							$model->fk_id_familia=$records['Fk_id_familia'];
							$model->fk_id_metodo_planificacion_familiar=$records['Fk_id_metodo_planificacion_familiar'];
							if($model->save()){
								$audi->insertAudi("update",$model->tableName()/*,$records['fk_id_familia']."-".$records['fk_id_metodo_planificacion_familiar']*/);
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