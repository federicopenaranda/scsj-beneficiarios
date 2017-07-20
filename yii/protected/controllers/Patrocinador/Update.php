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
				if(isset($records['id_patrocinador']) && isset($records['fk_id_tipo_patrocinador']) && isset($records['nombre_patrocinador']) && isset($records['apellido_patrocinador']) && isset($records['codigo_patrocinador']) && isset($records['observaciones_patrocinador']) && true){
					$model=Patrocinador::model()->findByPk($records['id_patrocinador']);
					$audi=new LogSistema();
					if($model!==null){
						if($model->validaFK('tipo_patrocinador','id_tipo_patrocinador',$records['fk_id_tipo_patrocinador'])!==false){
							$model->fk_id_tipo_patrocinador=$records['fk_id_tipo_patrocinador'];
							$model->nombre_patrocinador=$records['nombre_patrocinador'];
							$model->apellido_patrocinador=$records['apellido_patrocinador'];
							$model->codigo_patrocinador=$records['codigo_patrocinador'];
							$model->observaciones_patrocinador=$records['observaciones_patrocinador'];
							if($model->save()){
								$audi->insertAudi("update",$model->tableName(),$records['id_patrocinador']);
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