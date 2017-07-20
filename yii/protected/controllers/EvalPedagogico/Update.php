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
		if (isset($_GET['records'])){
			$records=CJSON::decode($_GET['records']);
			
			if (isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
				$callback=$_GET['callback'];			
				
				if (isset($records['id_pedagogico']) && 
					isset($records['fk_id_beneficiario']) && 
					isset($records['fecha_pedagogico']) && 
					isset($records['observaciones_pedagogico']) && 
					isset($records['matematicas_pedagogico']) && 
					isset($records['lenguaje_pedagogico']) && 
					isset($records['personal_social_pedagogico']) && 
					isset($records['desarrollo_habilidades_pedagogico'])
					) {
					$model=EvalPedagogico::model()->findByPk($records['id_pedagogico']);
					$audi=new LogSistema();
					if($model!==null){
						if ($model->validaFK('beneficiario','id_beneficiario',$records['fk_id_beneficiario'])!==false
							){
							$model->fk_id_usuario						=Yii::app()->user->getId();
        					$model->fk_id_beneficiario					=$record['fk_id_beneficiario'];
        					$model->fecha_pedagogico					=$record['fecha_pedagogico'];
        					$model->observaciones_pedagogico			=$record['observaciones_pedagogico'];
        					$model->matematicas_pedagogico				=$record['matematicas_pedagogico'];
        					$model->lenguaje_pedagogico					=$record['lenguaje_pedagogico'];
        					$model->desarrollo_habilidades_pedagogico	=$record['desarrollo_habilidades_pedagogico'];
        					$model->ciencias_vida_pedagogico			=$record['ciencias_vida_pedagogico'];
        					$model->idiomas_pedagogico					=$record['idiomas_pedagogico'];
        					$model->tecnologia_pedagogico				=$record['tecnologia_pedagogico'];

							if($model->save()){
								$audi->insertAudi("update",$model->tableName(),$records['id_pedagogico']);
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