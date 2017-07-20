<?php echo '<?php'; ?>

/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedades y metodos de CAction
*/ 
class Delete extends CAction{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de eliminar un registro de una tabla en la base de datos
* @param array $callback se introduce el nombre de una funcion
*/
    public function run(){
		$controller=$this->getController();
		if(isset($_GET['records'])){
			$records=CJSON::decode($_GET['records']);
			if(isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
				$callback=$_GET['callback'];
<?php $mode=new $this->nomodel;?><?php $sw=0?>
<?php foreach ($mode->attributeNames() as $name){ ?><?php if($sw==0){ ?><?php $v=$name;$sw=1;?><?php }?><?php }?>
				if(isset($records['<?php echo $v?>'])&& is_numeric($records['<?php echo $v?>']) && $records['<?php echo $v?>']>0){				
					$model=<?php echo $this->nomodel; ?>::model()->deleteByPk($records['<?php echo $v?>']);
					if($model==1){
						$respuesta->meta=array("success"=>"true","msg"=>"Registro eliminado !!");
						$controller->renderPartial('delete',array('model'=>$respuesta,'callback'=>$callback));
					}else{
						$respuesta->meta=array("success"=>"false","msg"=>"El registro no se pudo eliminar");
						$controller->renderPartial('delete',array('model'=>$respuesta,'callback'=>$callback));
					}
				}
				else{
					$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
					$controller->renderPartial('delete',array('model'=>$respuesta,'callback'=>$callback));
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
				$controller->renderParTial('delete',array('model'=>$respuesta,'callback'=>''));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error de filtrado");
			$controller->renderParTial('delete',array('model'=>$respuesta,'callback'=>''));
		}
	}
}