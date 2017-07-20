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
			
			if (isset($_GET['callback'])&&$_GET['callback']!=='') {
				$callback=$_GET['callback'];			
				
				if (isset($records['id_childfund']) && 
					isset($records['fk_id_tipo_consulta']) && 
					isset($records['fk_id_beneficiario']) && 
					isset($records['fecha_childfund']) && 
					isset($records['observaciones_childfund']) && 
					isset($records['evaluacion_childfund'])
					) {
					$model=EvalEduChildfund::model()->findByPk($records['id_childfund']);
					$audi=new LogSistema();
					if($model!==null){
						if ($model->validaFK('tipo_consulta','id_tipo_consulta',$records['fk_id_tipo_consulta'])!==false && 
							$model->validaFK('beneficiario','id_beneficiario',$records['fk_id_beneficiario'])!==false
							) {
							$model->fk_id_tipo_consulta			=$records['fk_id_tipo_consulta'];
							$model->fk_id_usuario				=Yii::app()->user->getId();
							$model->fk_id_beneficiario			=$records['fk_id_beneficiario'];
							$model->fecha_childfund				=$records['fecha_childfund'];
							$model->observaciones_childfund		=$records['observaciones_childfund'];
							$model->evaluacion_childfund		=$records['evaluacion_childfund'];

							if($model->save()){
								$audi->insertAudi("update",$model->tableName(),$records['id_childfund']);
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