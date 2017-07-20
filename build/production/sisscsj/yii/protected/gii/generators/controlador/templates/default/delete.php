<?php echo '<?php'; ?>

/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedades y metodos de CAction
*/ 
class <?php echo $action; ?> extends CAction{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de eliminar un registro de una tabla en la base de datos
* @param array $callback se introduce el nombre de una funcion
*/
<?php $mode=new $modelClass();?>
<?php $array=$mode->relations();
$aux=array();
$aux2=array();
$relacion=array();
for($i=0;$i<sizeof($array);$i++){
	$current=current($array);
	if(current($current)=="CHasManyRelation"){
		$key=key($array);next($current);
		$nomode=current($current);
		$aux[]=$nomode;	
	}
	next($array);
}
for($i=0;$i<sizeof($aux);$i++){
	$relacion[trim(strtolower (preg_replace ('/([A-Z])/', '_$1', $aux[$i])),"_")] =$aux[$i] ;
}
?>
<?php 
$contPrimaryKey=0;
$contForeignKey=0;
foreach($columns as $valor){
	if($valor->isPrimaryKey==1)
		$contPrimaryKey++;
	if($valor->isForeignKey==1)
		$contForeignKey++;
		#echo $valor->name;
}
?>
<?php if($contPrimaryKey==1):?>
    public function run()
    {
		$controller=$this->getController();
		$respuesta=new stdClass();
		$model=new <?php echo $modelClass; ?>();
        $error="";
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
		if ($error == "") {
			$callback=$_GET['callback'];
			$query=explode('&', $_SERVER['QUERY_STRING']);
			$listaRecords=$model->divideRecords($query);
			$numeroRecords=sizeof($listaRecords);
			$contValRecords=0;
			$transaction=$model->dbConnection->beginTransaction();
            try {
            	foreach ($listaRecords as $listaRecord) {
					
					$record=CJSON::decode(urldecode($listaRecord));
                    if (json_last_error() === JSON_ERROR_NONE) {
<?php foreach($columns as $column):
if ($column->isPrimaryKey==1):$llavep=$column->name;?>
						if (isset($record['<?php echo $column->name;?>'])) {
							$model=<?php echo $modelClass; ?>::model()->deleteByPk($record['<?php echo $column->name;?>']);
                            $audi=new LogSistema();
<?php endif;endforeach;?>
	                		if ($model==1) {
                            	$audi->insertAudi("delete",<?php echo $modelClass;?>::model()->tableName(),$record['<?php echo $llavep;?>']);
	                    		$contValRecords++;
	                    	} else {
								$error="Registro no se pudo eliminar";
							}
						} else {
							$error="Variable indefinida";
						}
					} else {
                        $error="Error de json";
                    }
                }//foreach
	            if ($contValRecords == $numeroRecords) {
	                $transaction->commit();
					$respuesta->meta=array("success"=>"true","msg"=>"Registro eliminado !!");
					$controller->renderPartial('delete',array('model'=>$respuesta,'callback'=>$callback));
	            } else {
	                $transaction->rollback();
					$respuesta->meta=array("success"=>"false","msg"=>$error);
					$controller->renderParTial('delete',array('model'=>$respuesta,'callback'=>$callback));
	            }
	        } catch (Exception $e) {
				$transaction->rollback();
				throw $e;
			}
        } else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('delete',array('model'=>$respuesta,'callback'=>''));
		}
    }
}

<?php endif;?>

<?php if($contPrimaryKey==2):?>
	public function run()
    {
		$controller=$this->getController();
		$respuesta=new stdClass();
		$model=new <?php echo $modelClass; ?>();
        $error="";
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
		if ($error == "") {
			$callback=$_GET['callback'];
			$query=explode('&', $_SERVER['QUERY_STRING']);
			$listaRecords=$model->divideRecords($query);
			$numeroRecords=sizeof($listaRecords);
			$contValRecords=0;
			$transaction=$model->dbConnection->beginTransaction();
            try {
            	foreach ($listaRecords as $listaRecord) {
					
					$record=CJSON::decode(urldecode($listaRecord));
                    if (json_last_error() === JSON_ERROR_NONE) {
<?php foreach($columns as $column):
if ($column->isForeignKey==1):$listaF[]=$column->name;?>
        				$error.= (!isset($record['<?php echo ($column->name);?>'])) ? "Variable indefinida {<?php echo $column->name;?>}" : "";
<?php endif;endforeach;?>
						if ($error == "") {
							$model=<?php echo $modelClass;?>::model()->deleteAll(array('condition'=>'<?php echo $listaF[0]?>=:<?php echo $listaF[0]?> and <?php echo $listaF[1]?>=:<?php echo $listaF[1]?>','params'=>array(':<?php echo $listaF[0]?>'=>$record['<?php echo $listaF[0]?>'],':<?php echo $listaF[1]?>'=>$record['<?php echo $listaF[1]?>'])));
							$audi=new LogSistema();
	                		if ($model==1) {
                            	$audi->insertAudi("delete",Actividad::model()->tableName(),$record['id_actividad']);
	                    		$contValRecords++;
	                    	} else {
								$error="Registro no se pudo eliminar";
							}
						} 
					} else {
                        $error="Error de json";
                    }
                }//foreach
	            if ($contValRecords == $numeroRecords) {
	                $transaction->commit();
					$respuesta->meta=array("success"=>"true","msg"=>"Registro eliminado !!");
					$controller->renderPartial('delete',array('model'=>$respuesta,'callback'=>$callback));
	            } else {
	                $transaction->rollback();
					$respuesta->meta=array("success"=>"false","msg"=>$error);
					$controller->renderParTial('delete',array('model'=>$respuesta,'callback'=>$callback));
	            }
	        } catch (Exception $e) {
				$transaction->rollback();
				throw $e;
			}
        } else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('delete',array('model'=>$respuesta,'callback'=>''));
		}
    }
}	
<?php endif;?>