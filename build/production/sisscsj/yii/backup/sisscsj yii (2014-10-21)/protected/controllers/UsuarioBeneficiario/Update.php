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
				if(isset($records['id_usuario_beneficiario']) && isset($records['fk_id_usuario']) && isset($records['fk_id_beneficiario']) && isset($records['fk_id_gestion_beneficiario']) && isset($records['fecha_asignacion_usuario_beneficiario']) && isset($records['estado_usuario_beneficiario']) && true){
					if($records['estado_usuario_beneficiario']=='true' || $records['estado_usuario_beneficiario']===true){
						$records['estado_usuario_beneficiario']=1;
					}
					if($records['estado_usuario_beneficiario']=='false' || $records['estado_usuario_beneficiario']===false){
						$records['estado_usuario_beneficiario']=0;
					}
					$model=UsuarioBeneficiario::model()->findByPk($records['id_usuario_beneficiario']);
					if($model!==null){
						if($model->validaFK('beneficiario','id_beneficiario',$records['fk_id_beneficiario'])!==false && $model->validaFK('gestion_beneficiario','id_gestion_beneficiario',$records['fk_id_gestion_beneficiario'])!==false && $model->validaFK('usuario','id_usuario',$records['fk_id_usuario'])!==false){					
							$model->fk_id_usuario=$records['fk_id_usuario'];
							$model->fk_id_beneficiario=$records['fk_id_beneficiario'];
							$model->fk_id_gestion_beneficiario=$records['fk_id_gestion_beneficiario'];
							$model->fecha_asignacion_usuario_beneficiario=$records['fecha_asignacion_usuario_beneficiario'];
							$model->estado_usuario_beneficiario=$records['estado_usuario_beneficiario'];
							#$model->fecha_creacion_usuario_beneficiario=$records['fecha_creacion_usuario_beneficiario'];
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