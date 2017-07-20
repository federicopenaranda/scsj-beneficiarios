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
				if(isset($records['id_biblioteca']) && isset($records['fk_id_usuario']) && isset($records['fk_id_area_cononcimiento_biblioteca']) && isset($records['fk_id_escolaridad']) && isset($records['tipo_usuario_biblioteca']) && isset($records['sexo_usuario_biblioteca']) && isset($records['fecha_consulta_biblioteca']) && isset($records['observaciones_biblioteca']) && true){
					$model=Biblioteca::model()->findByPk($records['id_biblioteca']);
					if($model!==null){
						if($model->validaFK('area_conocimiento_biblioteca','id_area_conocimiento_biblioteca',$records['fk_id_area_cononcimiento_biblioteca'])!==false && $model->validaFK('escolaridad','id_escolaridad',$records['fk_id_escolaridad'])!==false && $model->validaFK('usuario','id_usuario',$records['fk_id_usuario'])!==false){					
							$model->fk_id_usuario=$records['fk_id_usuario'];
							$model->fk_id_area_cononcimiento_biblioteca=$records['fk_id_area_cononcimiento_biblioteca'];
							$model->fk_id_escolaridad=$records['fk_id_escolaridad'];
							$model->tipo_usuario_biblioteca=$records['tipo_usuario_biblioteca'];
							$model->sexo_usuario_biblioteca=$records['sexo_usuario_biblioteca'];
							$model->fecha_consulta_biblioteca=$records['fecha_consulta_biblioteca'];
							$model->observaciones_biblioteca=$records['observaciones_biblioteca'];
							#$model->fecha_creacion_biblioteca=$records['fecha_creacion_biblioteca'];
							if($model->save()){
								$respuesta->meta=array("success"=>"true","msg"=>"Fue actualizado exitosamente !!!");
								$controller->renderParTial('update',array('model'=>$respuesta,'callback'=>$callback));
							}else{
								$respuesta->meta=array("success"=>"false","msg"=>"Dato invalido");
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