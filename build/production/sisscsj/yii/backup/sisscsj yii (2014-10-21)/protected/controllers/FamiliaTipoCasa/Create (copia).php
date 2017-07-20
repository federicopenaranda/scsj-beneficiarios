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
		$model=new FamiliaTipoCasa();
		$respuesta=new stdClass();
		if(isset($_GET['records'])){
			$records=CJSON::decode($_GET['records']);
			
			if(isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
				$callback=$_GET['callback'];
				
				if(isset($records['fk_id_familia']) && 
					isset($records['fk_id_tipo_cocina']) && 
					isset($records['fk_id_tipo_casa']) && 
					isset($records['observacion_familia_tipo_casa']) && 
					isset($records['estado_familia_tipo_casa']) && 
					isset($records['fecha_registro_familia_tipo_casa']) && 
					isset($records['cuartos_multiuso_familia_tipo_casa']) && 
					isset($records['ambientes_familia_tipo_casa'])
					) {
					
					if($records['estado_familia_tipo_casa']=='true' || $records['estado_familia_tipo_casa']===true){
						$records['estado_familia_tipo_casa']=1;
					}
					if($records['estado_familia_tipo_casa']=='false' || $records['estado_familia_tipo_casa']===false){
						$records['estado_familia_tipo_casa']=0;
					}
					if($records['cuartos_multiuso_familia_tipo_casa']=='true' || $records['cuartos_multiuso_familia_tipo_casa']===true){
						$records['cuartos_multiuso_familia_tipo_casa']=1;
					}
					if($records['cuartos_multiuso_familia_tipo_casa']=='false' || $records['cuartos_multiuso_familia_tipo_casa']===false){
						$records['cuartos_multiuso_familia_tipo_casa']=0;
					}
					if($model->validaFK('familia','id_familia',$records['fk_id_familia'])!==false && 
						$model->validaFK('tipo_casa','id_tipo_casa',$records['fk_id_tipo_casa'])!==false && 
						$model->validaFK('tipo_cocina','id_tipo_cocina',$records['fk_id_tipo_cocina'])!==false
						) {
						$model->fk_id_familia=$records['fk_id_familia'];
						$model->fk_id_tipo_cocina=$records['fk_id_tipo_cocina'];
						$model->fk_id_tipo_casa=$records['fk_id_tipo_casa'];
						$model->observacion_familia_tipo_casa=$records['observacion_familia_tipo_casa'];
						$model->estado_familia_tipo_casa=$records['estado_familia_tipo_casa'];
						$model->fecha_registro_familia_tipo_casa=$records['fecha_registro_familia_tipo_casa'];
						$model->cuartos_multiuso_familia_tipo_casa=$records['cuartos_multiuso_familia_tipo_casa'];
						$model->ambientes_familia_tipo_casa=$records['ambientes_familia_tipo_casa'];
						#$model->fecha_creacion_familia_tipo_casa=$records['fecha_creacion_familia_tipo_casa'];
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
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Error variable indefinida quizas quiso decir records");
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
	}
}