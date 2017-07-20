<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedad y metodos de la clase padre CAtion
*/ 
class Create extends CAction
{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de crear un nuevo registro y adicionarlo en una tabla
* @param array $callback se introduce el nombre de una funcion
*/
   public function run()
   {
		$controller=$this->getController();
		$model=new EvalComputacion();
		$respuesta=new stdClass();
		if (isset($_GET['records'])){
			$records=CJSON::decode($_GET['records']);
			
			if (isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])) {
				$callback=$_GET['callback'];
				
				if (isset($records['fk_id_usuario']) && 
					isset($records['fk_id_beneficiario']) && 
					isset($records['tipo_eval_computacion']) && 
					isset($records['fecha_eval_computacion']) && 
					isset($records['evaluacion_computacion']) && 
					isset($records['observaciones_eval_computacion'])
					) {
					
					if($model->validaFK('beneficiario','id_beneficiario',$records['fk_id_beneficiario'])!==false && $model->validaFK('usuario','id_usuario',$records['fk_id_usuario'])!==false){
						$model->fk_id_usuario=$records['fk_id_usuario'];
						$model->fk_id_beneficiario=$records['fk_id_beneficiario'];
						$model->tipo_eval_computacion=$records['tipo_eval_computacion'];
						$model->fecha_eval_computacion=$records['fecha_eval_computacion'];
						$model->evaluacion_computacion=$records['evaluacion_computacion'];
						$model->observaciones_eval_computacion=$records['observaciones_eval_computacion'];
						#$model->fecha_creacion_eval_computacion=$records['fecha_creacion_eval_computacion'];
						if ($model->save()) {
							$respuesta->meta=array("success"=>"true","msg"=>"Se creo exitosamente !!!");
							$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
						} else {
							$respuesta->meta=array("success"=>"false","msg"=>$model->getErrors());
							$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));						
						}
					} else {
						$respuesta->meta=array("success"=>"false","msg"=>"Error llave foranea");
						$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
					}
				} else {
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
				}
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error variable indefinida quizas quiso decir records");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
	}
}