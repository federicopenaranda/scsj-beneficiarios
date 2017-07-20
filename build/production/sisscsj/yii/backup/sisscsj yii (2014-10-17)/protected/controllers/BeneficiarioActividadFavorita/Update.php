<?php 
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedades y metodos de CAction
*/ 
class Update extends CAction{
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
				if(isset($records['fk_id_actividad_favorita']) && isset($records['fk_id_beneficiario']) && isset($records['Fk_id_actividad_favorita']) && isset($records['Fk_id_beneficiario'])){
					/*if($records['campo_bool']=='true' || $records['campo_bool']===true){
						$records['campo_bool']=1;
					}
					if($records['campo_bool']=='false' || $records['campo_bool']===false){
						$records['campo_bool']=0;
					}*/
					$model=BeneficiarioActividadFavorita::model()->find(array('condition'=>'fk_id_actividad_favorita=:fk_id_actividad_favorita and fk_id_beneficiario=:fk_id_beneficiario','params'=>array(':fk_id_actividad_favorita'=>$records['fk_id_actividad_favorita'],':fk_id_beneficiario'=>$records['fk_id_beneficiario'])));
					if($model!==null){
						if($model->validaFK('actividad_favorita','id_actividad_favorita',$records['fk_id_actividad_favorita'])!==false && $model->validaFK('beneficiario','id_beneficiario',$records['fk_id_beneficiario'])!==false && $model->validaFK('actividad_favorita','id_actividad_favorita',$records['Fk_id_actividad_favorita'])!==false && $model->validaFK('beneficiario','id_beneficiario',$records['Fk_id_beneficiario'])!==false){
							$model->fk_id_actividad_favorita=$records['Fk_id_actividad_favorita'];
							$model->fk_id_beneficiario=$records['Fk_id_beneficiario'];
							if($model->save()){
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