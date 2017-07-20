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
				if(isset($records['fk_id_actividad']) && isset($records['fk_id_tipo_actividad']) && isset($records['Fk_id_actividad']) && isset($records['Fk_id_tipo_actividad'])){
					/*if($records['campo_bool']=='true' || $records['campo_bool']===true){
						$records['campo_bool']=1;
					}
					if($records['campo_bool']=='false' || $records['campo_bool']===false){
						$records['campo_bool']=0;
					}*/
					$model=ActividadTipoActividad::model()->find(array('condition'=>'fk_id_actividad=:fk_id_actividad and fk_id_tipo_actividad=:fk_id_tipo_actividad','params'=>array(':fk_id_actividad'=>$records['fk_id_actividad'],':fk_id_tipo_actividad'=>$records['fk_id_tipo_actividad'])));
					if($model!==null){
						if($model->validaFK('actividad','id_actividad',$records['fk_id_actividad'])!==false && $model->validaFK('tipo_actividad','id_tipo_actividad',$records['fk_id_tipo_actividad'])!==false && $model->validaFK('actividad','id_actividad',$records['Fk_id_actividad'])!==false && $model->validaFK('tipo_actividad','id_tipo_actividad',$records['Fk_id_tipo_actividad'])!==false){
							$model->fk_id_actividad=$records['Fk_id_actividad'];
							$model->fk_id_tipo_actividad=$records['Fk_id_tipo_actividad'];
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