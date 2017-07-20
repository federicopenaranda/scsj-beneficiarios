<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedad y metodos de la clase padre CAtion
*/ 
class Create extends CAction{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de crear un nuevo registro y adicionarlo en una tabla
* @param array $callback se introduce el nombre de una funcion
*/
   public function run(){
		$controller=$this->getController();
		$model=new EvalNutricion();
		$respuesta=new stdClass();
		if (isset($_GET['records'])) {
			$records=CJSON::decode($_GET['records']);
			
			if (isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])) {
				$callback=$_GET['callback'];
				
				if (isset($records['fk_id_tipo_consulta']) && 
					isset($records['fk_id_usuario']) && 
					isset($records['fk_id_beneficiario']) && 
					isset($records['fecha_nutricion']) && 
					isset($records['observaciones_nutricion']) && 
					isset($records['peso_talla_nutricion']) && 
					isset($records['talla_edad_nutricion'])
					) {
					
					if ($model->validaFK('tipo_consulta','id_tipo_consulta',$records['fk_id_tipo_consulta'])!==false && 
						$model->validaFK('usuario','id_usuario',$records['fk_id_usuario'])!==false && 
						$model->validaFK('beneficiario','id_beneficiario',$records['fk_id_beneficiario'])!==false
						) {
						$model->fk_id_tipo_consulta=$records['fk_id_tipo_consulta'];
						$model->fk_id_usuario=$records['fk_id_usuario'];
						$model->fk_id_beneficiario=$records['fk_id_beneficiario'];
						$model->fecha_nutricion=$records['fecha_nutricion'];
						$model->observaciones_nutricion=$records['observaciones_nutricion'];
						$model->peso_talla_nutricion=$records['peso_talla_nutricion'];
						$model->talla_edad_nutricion=$records['talla_edad_nutricion'];
						#$model->fecha_eval_nutricion=$records['fecha_eval_nutricion'];
						if($model->save()){
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
				}else{
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error variable indefinida quizas quiso decir records");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
	}
}