<?php
/**
* nombre de la tabla <?php echo $tableName; ?>
*  nombre del Modelo <?php echo $modelClass; ?>
* nombre de la columnas 
* nombre de la acciont <?php echo $action; ?>
*/
?>
<?php echo "<?php\n"; ?>
/**
 * Esta es la accion para el controlador PrivilegiosUsuario
 */
class insert extends CAction
{
	/**
    * Esta accion inserta las 4 acciones (create,read,update,delete) por cada tabla de la base de datos.
    */
	public function run()
	{
    	$controller=$this->getController();
		$respuesta=new stdClass();
        $error="";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
		if ($error == "") {
        	$callback=$_GET['callback'];
        	$arreglo=array (
<?php $arreglo=$modelClass;foreach($arreglo as $valor) {
					echo "'".$valor."',\n";
			}?>
            );
            foreach ($arreglo as $valor) {
                
                for ($i=1;$i<=4;$i++) {
                    $model=new PrivilegiosUsuario();
                    switch ($i) {
                        case 1:
                            $model->accion_privilegio_usuario="create";
                            $model->nombre_privilegio_usuario="crea ".$valor;
                        break;
                        case 2:
                            $model->accion_privilegio_usuario="read";
                            $model->nombre_privilegio_usuario="lee ".$valor;
                        break;
                        case 3:
                            $model->accion_privilegio_usuario="update";
                            $model->nombre_privilegio_usuario="actualiza ".$valor;
                        break;
                        case 4:
                            $model->accion_privilegio_usuario="delete";
                            $model->nombre_privilegio_usuario="elimina ".$valor;
                        break;
                     }  
					$model->opciones_privilegio_usuario="controlador";
                    $model->descripcion_privilegios_usuario="automatico";
					if ($model->validate())
						$model->save(); 
                }
            }
            $respuesta->meta=array("success"=>"true","msg"=>"Registros Creados!!");
            $controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>''));
		}
	}
}