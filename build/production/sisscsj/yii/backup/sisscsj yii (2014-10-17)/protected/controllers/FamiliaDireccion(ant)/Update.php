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
				if(isset($records['id_familia_direccion']) && isset($records['fk_id_sector']) && isset($records['fk_id_familia']) && isset($records['direccion_familia_direccion']) && isset($records['estado_familia_direccion']) && true){
					if($records['estado_familia_direccion']=='true' || $records['estado_familia_direccion']===true){
						$records['estado_familia_direccion']=1;
					}
					if($records['estado_familia_direccion']=='false' || $records['estado_familia_direccion']===false){
						$records['estado_familia_direccion']=0;
					}
					$model=FamiliaDireccion::model()->findByPk($records['id_familia_direccion']);
					if($model!==null){
						if($model->validaFK('familia','id_familia',$records['fk_id_familia'])!==false && $model->validaFK('sector','id_sector',$records['fk_id_sector'])!==false){
							$model->fk_id_sector=$records['fk_id_sector'];
							$model->fk_id_familia=$records['fk_id_familia'];
							$model->direccion_familia_direccion=$records['direccion_familia_direccion'];
							#$model->fecha_creacion_famillia_direccion=$records['fecha_creacion_famillia_direccion'];
							$model->estado_familia_direccion=$records['estado_familia_direccion'];
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