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
		$model=new BeneficiarioEntidad();
		$respuesta=new stdClass();
		if (isset($_GET['records'])){
			$records=CJSON::decode($_GET['records']);
			
			if (isset($_GET['callback']) && $_GET['callback']!=='' && !is_numeric($_GET['callback'])){
				$callback=$_GET['callback'];
				
				if (isset($records['fk_id_beneficiario']) && 
					isset($records['fk_id_entidad']) && 
					isset($records['fecha_vinculacion_beneficiario_entidad']) && 
					isset($records['fecha_retiro_beneficiario_entidad']) && 
					isset($records['razon_retiro_beneficiario']) && 
					isset($records['estado_beneficiario_entidad'])
					) {
					if($records['estado_beneficiario_entidad']=='true' || $records['estado_beneficiario_entidad']===true){
						$records['estado_beneficiario_entidad']=1;
					}
					if($records['estado_beneficiario_entidad']=='false' || $records['estado_beneficiario_entidad']===false){
						$records['estado_beneficiario_entidad']=0;
					}
					if($model->validaFK('beneficiario','id_beneficiario',$records['fk_id_beneficiario'])!==false && $model->validaFK('entidad','id_entidad',$records['fk_id_entidad'])!==false){
						$model->fk_id_beneficiario=$records['fk_id_beneficiario'];
						$model->fk_id_entidad=$records['fk_id_entidad'];
						$model->fecha_vinculacion_beneficiario_entidad=$records['fecha_vinculacion_beneficiario_entidad'];
						$model->fecha_retiro_beneficiario_entidad=$records['fecha_retiro_beneficiario_entidad'];
						$model->razon_retiro_beneficiario=$records['razon_retiro_beneficiario'];
						$model->estado_beneficiario_entidad=$records['estado_beneficiario_entidad'];
						#$model->fecha_creacion_beneficiario_entidad=$records['fecha_creacion_beneficiario_entidad'];
						if($model->save()) {
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
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error variable indefinida quizas quiso decir records");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
	}
}