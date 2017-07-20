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
		$respuesta=new stdClass();
		$model=new EvalPsicologico();
		$audi=new LogSistema();
		if(isset($_GET['records'])){
			$records=CJSON::decode($_GET['records']);
			
			if (isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
				$callback=$_GET['callback'];
				
				if (isset($records['fk_id_tipo_consulta']) && 
					isset($records['fk_id_tipo_problematica']) && 
					isset($records['fk_id_sub_area_referencia']) && 
					isset($records['fk_id_beneficiario']) && 
					isset($records['fecha_psicologico']) && 
					isset($records['observaciones_psicologico']) && 
					isset($records['diagnostico_psicologico']) && 
					isset($records['tratamiento_psicologico'])
					) {
					
					if ($model->validaFK('tipo_consulta','id_tipo_consulta',$records['fk_id_tipo_consulta'])!==false && 
						$model->validaFK('beneficiario','id_beneficiario',$records['fk_id_beneficiario'])!==false && 
						$model->validaFK('sub_area','id_sub_area',$records['fk_id_sub_area_referencia'])!==false && 
						$model->validaFK('tipo_problematica','id_tipo_problematica',$records['fk_id_tipo_problematica'])!==false
						) {
						$model->fk_id_tipo_consulta			=$records['fk_id_tipo_consulta'];
						$model->fk_id_usuario				=Yii::app()->user->getId();
						$model->fk_id_tipo_problematica		=$records['fk_id_tipo_problematica'];
						$model->fk_id_sub_area_referencia	=$records['fk_id_sub_area_referencia'];
						$model->fk_id_beneficiario			=$records['fk_id_beneficiario'];
						$model->fecha_psicologico			=$records['fecha_psicologico'];
						$model->observaciones_psicologico	=$records['observaciones_psicologico'];
						$model->diagnostico_psicologico		=$records['diagnostico_psicologico'];
						$model->tratamiento_psicologico		=$records['tratamiento_psicologico'];

						if ($model->save()){
							$audi->insertAudi("create",$model->tableName(),$model->getPrimaryKey());
							$respuesta->meta=array("success"=>"true","msg"=>"Se creo exitosamente !!!");
							$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
						}else{
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