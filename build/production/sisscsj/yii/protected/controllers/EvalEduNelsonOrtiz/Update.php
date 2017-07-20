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
			
			if(isset($_GET['callback'])&&$_GET['callback']!==''){
				$callback=$_GET['callback'];			
				
				if( isset($records['id_nelson_ortiz']) && 
					isset($records['fk_id_tipo_consulta']) && 
					isset($records['fk_id_beneficiario']) && 
					isset($records['fecha_nelson_ortiz']) && 
					isset($records['observaciones_nelson_ortiz']) && 
					isset($records['motricidad_gruesa_nelson_ortiz']) && 
					isset($records['audicion_lenguaje_nelson_ortiz']) && 
					isset($records['motricidad_fina_nelson_ortiz']) && 
					isset($records['personal_social_nelson_ortiz'])
					) {
					$model=EvalEduNelsonOrtiz::model()->findByPk($records['id_nelson_ortiz']);
					$audi=new LogSistema();
					if($model!==null){
						if ($model->validaFK('tipo_consulta','id_tipo_consulta',$records['fk_id_tipo_consulta'])!==false &&
							$model->validaFK('beneficiario','id_beneficiario',$records['fk_id_beneficiario'])!==false
							) {		
							$model->fk_id_tipo_consulta				=$record['fk_id_tipo_consulta'];
        					$model->fk_id_usuario					=Yii::app()->user->getId();
        					$model->fk_id_beneficiario				=$record['fk_id_beneficiario'];
        					$model->fecha_nelson_ortiz				=$record['fecha_nelson_ortiz'];
        					$model->observaciones_nelson_ortiz		=$record['observaciones_nelson_ortiz'];
        					$model->motricidad_gruesa_nelson_ortiz	=$record['motricidad_gruesa_nelson_ortiz'];
        					$model->audicion_lenguaje_nelson_ortiz	=$record['audicion_lenguaje_nelson_ortiz'];
        					$model->motricidad_fina_nelson_ortiz	=$record['motricidad_fina_nelson_ortiz'];
        					$model->personal_social_nelson_ortiz	=$record['personal_social_nelson_ortiz'];
        					$model->total_nelson_ortiz				=$record['total_nelson_ortiz'];

							if($model->save()){
								$audi->insertAudi("update",$model->tableName(),$records['id_nelson_ortiz']);
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