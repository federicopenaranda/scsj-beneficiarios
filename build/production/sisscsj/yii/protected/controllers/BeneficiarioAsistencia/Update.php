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
				if(isset($records['id_beneficiario_asistencia']) && isset($records['fk_id_asistencia']) && isset($records['fk_id_beneficiario']) && isset($records['fk_id_estado_asistencia']) && true){
					$model=BeneficiarioAsistencia::model()->findByPk($records['id_beneficiario_asistencia']);
					$audi=new LogSistema();
					if($model!==null){
						if($model->validaFK('asistencia','id_asistencia',$records['fk_id_asistencia'])!==false && $model->validaFK('beneficiario','id_beneficiario',$records['fk_id_beneficiario'])!==false && $model->validaFK('estado_asistencia','id_estado_asistencia',$records['fk_id_estado_asistencia'])!==false){					
							$model->fk_id_asistencia=$records['fk_id_asistencia'];
							$model->fk_id_beneficiario=$records['fk_id_beneficiario'];
							$model->fk_id_estado_asistencia=$records['fk_id_estado_asistencia'];
							if($model->save()){
								$audi->insertAudi("update",$model->tableName(),$records['id_beneficiario_asistencia']);
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