<?php echo '<?php'; ?>

/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda de CAction
*/ 
class <?php echo $action; ?> extends CAction
{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de listar todos los registros de una tabla en la base de datos
* @param array $callback se introduce el nombre de una funcion
*/

<?php #return array('fkIdBeneficiario' => array(self::BELONGS_TO, 'Beneficiario','fk_id_beneficiario'),/;?>
<?php
/**
* 'VarName'=>array('RelationType', 'ClassName', 'ForeignKey', ...additional options)
*/
require_once "Dato.php";
$mode=new $modelClass();

/**
* Lista de nombre de tipo primari key
* @var array
* @access public
*/
$listNamePrimaryKey=listNamePrimaryKey($columns);
/**
* Lista de nombre de tipo primari foreignkey
* @var array
* @access public
*/
$listNameForeignKey=listNameForeignKey($columns);
/**
* Lista de codigos del nombre de una tabla
* @var array
* @access public
*/
$listCodigo=divideCodigo($tableName);
/**
* Lista de relacion de tipo hasMany
* @var array
* @access public
*/
$listRelation=listRelation($mode->relations());
/**
* Lista de relaciones con 3 elementos (VarName,ClassName,ForeignKey) 
*/
$aux=obtRelacion($mode->relations());
$listRelHasMany = obtHasMany($mode->relations());
/**
* 
*/
?>
<?php if(sizeof($aux)==0)://RELACION 0?>
	public function run()
    {
		$controller=$this->getController();
        $respuesta=new stdClass();
        $error="";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        $error.= (!isset($_GET['start'])) ? "{ Error de start } " : "";
        $error.= (!isset($_GET['limit'])) ? "{ Error de limit } " : "";
        if ($error == "") {
			$callback=$_GET['callback'];
			$model=new <?php echo $modelClass; ?>();
			try {
				if (isset($_GET['filter']) && $_GET['filter']!='') {
					$filtro=CJSON::decode($_GET['filter']);
                    $condi="";
					$contFil=1;
					if (isset($_GET['sort']) && $_GET['sort']!='') {		
						$sort=CJSON::decode($_GET['sort']);
						$condisort=isset($sort[0]['property']) ? $sort[0]['property'] : "";
						$valorsort=isset($sort[0]['direction']) ? $sort[0]['direction'] :"error";
						foreach ($filtro as $parametro) {
							$condicion=isset($parametro['property']) ? $parametro['property'] : "" ;
							$valor=isset($parametro['value']) ? $parametro['value'] : "error" ;
                            $condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " :  $condicion." LIKE '%".$valor."%'";	
							$contFil++;
						}
                        $arreglo=$model::model()->pagina($_GET['limit'],$_GET['start'])->findAll(array("condition"=>$condi,"order"=>$condisort." ".$valorsort));
					} else {
						foreach ($filtro as $parametro) {
							$condicion=isset($parametro['property']) ? $parametro['property'] : "" ;
							$valor=isset($parametro['value']) ? $parametro['value'] : "error" ;
                            $condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " :  $condicion." LIKE '%".$valor."%'";	
							$contFil++;
						}
                        $arreglo=$model::model()->pagina($_GET['limit'],$_GET['start'])->findAll($condi);
					}
					$total="".sizeof($arreglo);
				} else {
					if (isset($_GET['sort']) && $_GET['sort']!=''){
						$sort=CJSON::decode($_GET['sort']);
						$condisort=isset($sort[0]['property']) ? $sort[0]['property'] : "";
						$valorsort=isset($sort[0]['direction']) ? $sort[0]['direction'] :"error";
						$arreglo=$model->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
					} else {
						$arreglo=$model->pagina($_GET['limit'],$_GET['start'])->findAll();
					}
					$total=$model->count();
				}
			} catch(Exception $e) {
				$error=$e->getMessage();
			}
			if ($error=="") {
				$respuesta->registros=$arreglo;	
				$respuesta->total=$total;
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>$error);
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}
<?php endif;?>
<?php if(sizeof($aux)==3)://RELACION 1?>
	public function run()
    {
		$controller=$this->getController();
        $respuesta=new stdClass();
        $audi=new LogSistema();
        $error="";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        $error.= (!isset($_GET['start'])) ? "{ Error de start } " : "";
        $error.= (!isset($_GET['limit'])) ? "{ Error de limit } " : "";
        if ($error == "") {
			$callback=$_GET['callback'];
			$model=new <?php echo $modelClass; ?>();
			if (isset($_GET['filter']) && $_GET['filter']!='') {
				$filtro=CJSON::decode($_GET['filter']);
                $condi="";
				$contFil=1;
				if (isset($_GET['sort']) && $_GET['sort']!='') {		
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
                        $condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " :  $condicion." LIKE '%".$valor."%'";	
						$contFil++;
					}
                    $modelo=$model::model()->with('<?php echo $aux[0] ?>')->pagina($_GET['limit'],$_GET['start'])->findAll(array("condition"=>$condi,"order"=>$condisort." ".$valorsort));		
				}else{
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
                        $condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " :  $condicion." LIKE '%".$valor."%'";	
						$contFil++;			
					}
                    $modelo=$model::model()->with('<?php echo $aux[0] ?>')->pagina($_GET['limit'],$_GET['start'])->findAll($condi);
				}
				$total="".sizeof($modelo);
			} else {
				if(isset($_GET['sort']) && $_GET['sort']!=''){
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];
					$modelo=$model::model()->with('<?php echo $aux[0] ?>')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
				} else {
					$modelo=$model::model()->with('<?php echo $aux[0] ?>')->pagina($_GET['limit'],$_GET['start'])->findAll();
				}
				$total=$model->count();
			}
			$arreglo=array();
			foreach($modelo as $staff){
				$aux=array();
<?php foreach ($mode->attributeNames() as $name){?>
				$aux['<?php echo$name; ?>']=$staff-><?php echo$name; ?>;<?php echo"\n";?><?php } ?>
					//***********************************************************
<?php $mode=new $aux[1];?><?php foreach ($mode->attributeNames() as $name){?>
				$aux['<?php echo$name; ?>']=$staff-><?php echo $aux[0]?>-><?php echo$name; ?>;<?php echo"\n";?><?php } ?>
<?php if(sizeof($listRelHasMany)!==0) { 
for($i=0;$i<sizeof($listRelHasMany);$i=$i*3){?>
				$aux2=array();
				foreach($staff-><?php echo $listRelHasMany[$i]; ?> as $va){
					#$aux2=$va->ATRIBUTO;
				}
				#$aux['ATRIBUTO']=$aux2;
<?php if($i==0)$i=1;?>
<?php } }?>
				$arreglo[]=$aux;
			}
			$audi->insertAudi("read",$model->tableName());
			$respuesta->registros=$arreglo;	
			$respuesta->total=$total;
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}
<?php endif;?>
<?php if(sizeof($aux)==6)://RELACION 2?>
	public function run()
    {
		$controller=$this->getController();
        $respuesta=new stdClass();
        $audi=new LogSistema();
        $error="";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        $error.= (!isset($_GET['start'])) ? "{ Error de start } " : "";
        $error.= (!isset($_GET['limit'])) ? "{ Error de limit } " : "";
        if ($error == "") {
			$callback=$_GET['callback'];
			
			$model=new <?php echo $modelClass; ?>();
			if(isset($_GET['filter']) && $_GET['filter']!=''){
				$filtro=CJSON::decode($_GET['filter']);
                $condi="";
				$contFil=1;
				if(isset($_GET['sort']) && $_GET['sort']!=''){		
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
                        $condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " :  $condicion." LIKE '%".$valor."%'";	
						$contFil++;
					}
                    $modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>')->pagina($_GET['limit'],$_GET['start'])->findAll(array("condition"=>$condi,"order"=>$condisort." ".$valorsort));		
				} else {
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
                        $condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " :  $condicion." LIKE '%".$valor."%'";	
						$contFil++;
					}
                    $modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>')->pagina($_GET['limit'],$_GET['start'])->findAll($condi);	
				}
				$total="".sizeof($modelo);	
			} else {
				if (isset($_GET['sort']) && $_GET['sort']!=''){
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];	
					$modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
				} else {
					$modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>')->pagina($_GET['limit'],$_GET['start'])->findAll();
				}
				$total=$model->count();
			}
			$arreglo=array();
			foreach($modelo as $staff){
				$aux=array();
<?php foreach ($mode->attributeNames() as $name){?>
				$aux['<?php echo$name; ?>']=$staff-><?php echo$name; ?>;<?php echo"\n";?><?php } ?>
					//***********************************************************
<?php $mode=new $aux[1];?><?php foreach ($mode->attributeNames() as $name){?>
				$aux['<?php echo$name; ?>']=$staff-><?php echo $aux[0]?>-><?php echo$name; ?>;<?php echo"\n";?><?php } ?>
					//**********************************************************
<?php $mode=new $aux[4];?><?php foreach ($mode->attributeNames() as $name){?>
				$aux['<?php echo$name; ?>']=$staff-><?php echo $aux[3]?>-><?php echo$name; ?>;<?php echo"\n";?><?php } ?>
<?php if(sizeof($listRelHasMany)!==0) { 
for($i=0;$i<sizeof($listRelHasMany);$i=$i*3){?>
				$aux2=array();
				foreach($staff-><?php echo $listRelHasMany[$i]; ?> as $va){
					#$aux2=$va->ATRIBUTO;
				}
				#$aux['ATRIBUTO']=$aux2;
<?php if($i==0)$i=1;?>
<?php } }?>
				$arreglo[]=$aux;
			}
			$audi->insertAudi("read",$model->tableName());
			$respuesta->registros=$arreglo;	
			$respuesta->total=$total;
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}
<?php endif;?>
<?php if(sizeof($aux)==9)://RELACION 3?>
	public function run()
    {
		$controller=$this->getController();
        $respuesta=new stdClass();
        $audi=new LogSistema();
        $error="";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        $error.= (!isset($_GET['start'])) ? "{ Error de start } " : "";
        $error.= (!isset($_GET['limit'])) ? "{ Error de limit } " : "";
        if ($error == "") {
			$callback=$_GET['callback'];
			$model=new <?php echo $modelClass; ?>();
			if (isset($_GET['filter']) && $_GET['filter']!='') {
				$filtro=CJSON::decode($_GET['filter']);
                $condi="";
				$contFil=1;
				if(isset($_GET['sort']) && $_GET['sort']!=''){		
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
                        $condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " :  $condicion." LIKE '%".$valor."%'";	
						$contFil++;
					}
                    $modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>','<?php echo $aux[6] ?>')->pagina($_GET['limit'],$_GET['start'])->findAll(array("condition"=>$condi,"order"=>$condisort." ".$valorsort));	
				} else {
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
                        $condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " :  $condicion." LIKE '%".$valor."%'";	
						$contFil++;
					}
                    $modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>','<?php echo $aux[6] ?>')->pagina($_GET['limit'],$_GET['start'])->findAll($condi);
				}
				$total="".sizeof($modelo);
			} else {
				if(isset($_GET['sort']) && $_GET['sort']!=''){
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];	
					$modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>','<?php echo $aux[6] ?>')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
				} else {
					$modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>','<?php echo $aux[6] ?>')->pagina($_GET['limit'],$_GET['start'])->findAll();
				}
				$total=$model->count();
			}
			$arreglo=array();
			foreach($modelo as $staff){
				$aux=array();
<?php foreach ($mode->attributeNames() as $name){?>
				$aux['<?php echo$name; ?>']=$staff-><?php echo$name; ?>;<?php echo"\n";?><?php } ?>
				//***********************************************************
<?php $mode=new $aux[1];?><?php foreach ($mode->attributeNames() as $name){?>
				$aux['<?php echo$name; ?>']=$staff-><?php echo $aux[0]?>-><?php echo$name; ?>;<?php echo"\n";?><?php } ?>
				//**********************************************************
<?php $mode=new $aux[4];?><?php foreach ($mode->attributeNames() as $name){?>
				$aux['<?php echo$name; ?>']=$staff-><?php echo $aux[3]?>-><?php echo$name; ?>;<?php echo"\n";?><?php } ?>
				//**********************************************************
<?php $mode=new $aux[7];?><?php foreach ($mode->attributeNames() as $name){?>
				$aux['<?php echo$name; ?>']=$staff-><?php echo $aux[6]?>-><?php echo$name; ?>;<?php echo"\n";?><?php } ?>
<?php if(sizeof($listRelHasMany)!==0) { 
for($i=0;$i<sizeof($listRelHasMany);$i=$i*3){?>
				$aux2=array();
				foreach($staff-><?php echo $listRelHasMany[$i]; ?> as $va){
					#$aux2=$va->ATRIBUTO;
				}
				#$aux['ATRIBUTO']=$aux2;
<?php if($i==0)$i=1;?>
<?php } }?>
				$arreglo[]=$aux;
			}
			$audi->insertAudi("read",$model->tableName());
			$respuesta->registros=$arreglo;	
			$respuesta->total=$total;
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}					
<?php endif;?>
<?php if(sizeof($aux)==12)://RELACION 4?>
	public function run()
    {
		$controller=$this->getController();
        $respuesta=new stdClass();
        $audi=new LogSistema();
        $error="";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        $error.= (!isset($_GET['start'])) ? "{ Error de start } " : "";
        $error.= (!isset($_GET['limit'])) ? "{ Error de limit } " : "";
        if ($error == "") {
			$callback=$_GET['callback'];
			$model=new <?php echo $modelClass; ?>();
			if (isset($_GET['filter']) && $_GET['filter']!=''){
				$filtro=CJSON::decode($_GET['filter']);
                $condi="";
				$contFil=1;
				if(isset($_GET['sort']) && $_GET['sort']!=''){		
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
                        $condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " :  $condicion." LIKE '%".$valor."%'";	
						$contFil++;
					}
                    $modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>','<?php echo $aux[6] ?>','<?php echo $aux[9] ?>')->pagina($_GET['limit'],$_GET['start'])->findAll(array("condition"=>$condi,"order"=>$condisort." ".$valorsort));
				} else {
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
                        $condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " :  $condicion." LIKE '%".$valor."%'";	
						$contFil++;
					}
                    $modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>','<?php echo $aux[6] ?>','<?php echo $aux[9] ?>')->pagina($_GET['limit'],$_GET['start'])->findAll($condi);
				}
				$total="".sizeof($modelo);
			} else {
				if(isset($_GET['sort']) && $_GET['sort']!=''){
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];	
					$modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>','<?php echo $aux[6] ?>','<?php echo $aux[9] ?>')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
				} else {
					$modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>','<?php echo $aux[6] ?>','<?php echo $aux[9] ?>')->pagina($_GET['limit'],$_GET['start'])->findAll();
				}
				$total=$model->count();
			}
			$arreglo=array();
			foreach($modelo as $staff){
				$aux=array();
<?php foreach ($mode->attributeNames() as $name){?>
				$aux['<?php echo$name; ?>']=$staff-><?php echo$name; ?>;<?php echo"\n";?><?php } ?>
				//***********************************************************
<?php $mode=new $aux[1];?><?php foreach ($mode->attributeNames() as $name){?>
				$aux['<?php echo$name; ?>']=$staff-><?php echo $aux[0]?>-><?php echo$name; ?>;<?php echo"\n";?><?php } ?>
				//**********************************************************
<?php $mode=new $aux[4];?><?php foreach ($mode->attributeNames() as $name){?>
				$aux['<?php echo$name; ?>']=$staff-><?php echo $aux[3]?>-><?php echo$name; ?>;<?php echo"\n";?><?php } ?>
				//**********************************************************
<?php $mode=new $aux[7];?><?php foreach ($mode->attributeNames() as $name){?>
				$aux['<?php echo$name; ?>']=$staff-><?php echo $aux[6]?>-><?php echo$name; ?>;<?php echo"\n";?><?php } ?>
				//**********************************************************
<?php $mode=new $aux[10];?><?php foreach ($mode->attributeNames() as $name){?>
				$aux['<?php echo$name; ?>']=$staff-><?php echo $aux[9]?>-><?php echo$name; ?>;<?php echo"\n";?><?php } ?>
<?php if(sizeof($listRelHasMany)!==0) { 
for($i=0;$i<sizeof($listRelHasMany);$i=$i*3){?>
				$aux2=array();
				foreach($staff-><?php echo $listRelHasMany[$i]; ?> as $va){
					#$aux2=$va->ATRIBUTO;
				}
				#$aux['ATRIBUTO']=$aux2;
<?php if($i==0)$i=1;?>
<?php } }?>
				$arreglo[]=$aux;					
			}
			$audi->insertAudi("read",$model->tableName());
			$respuesta->registros=$arreglo;	
			$respuesta->total=$total;
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}
<?php endif;?>
<?php if(sizeof($aux)==15)://RELACION 5?>
	public function run()
    {
		$controller=$this->getController();
        $respuesta=new stdClass();
        $audi=new LogSistema();
        $error="";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        $error.= (!isset($_GET['start'])) ? "{ Error de start } " : "";
        $error.= (!isset($_GET['limit'])) ? "{ Error de limit } " : "";
        if ($error == "") {
			$callback=$_GET['callback'];
			
			$model=new <?php echo $modelClass; ?>();
			if(isset($_GET['filter']) && $_GET['filter']!=''){
				$filtro=CJSON::decode($_GET['filter']);
                $condi="";
				$contFil=1;
				if(isset($_GET['sort']) && $_GET['sort']!=''){		
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
                        $condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " :  $condicion." LIKE '%".$valor."%'";	
						$contFil++;
					}
                    $modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>','<?php echo $aux[6] ?>','<?php echo $aux[9] ?>','<?php echo $aux[12] ?>')->findAll(array("condition"=>$condi,"order"=>$condisort." ".$valorsort));              
				} else {
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
                        $condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " :  $condicion." LIKE '%".$valor."%'";	
						$contFil++;
					}
                    $modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>','<?php echo $aux[6] ?>','<?php echo $aux[9] ?>','<?php echo $aux[12] ?>')->pagina($_GET['limit'],$_GET['start'])->findAll($condi);
				}
				$total="".sizeof($modelo);
			} else {
				if(isset($_GET['sort']) && $_GET['sort']!=''){
					$sort=CJSON::decode($_GET['sort']);
					$condisort=$sort[0]['property'];
					$valorsort=$sort[0]['direction'];	
					$modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>','<?php echo $aux[6] ?>','<?php echo $aux[9] ?>','<?php echo $aux[12] ?>')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
				} else {
					$modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>','<?php echo $aux[6] ?>','<?php echo $aux[9] ?>','<?php echo $aux[12] ?>')->pagina($_GET['limit'],$_GET['start'])->findAll();
				}
				$total=$model->count();
			}
			$arreglo=array();
			foreach($modelo as $staff){
				$aux=array();
<?php foreach ($mode->attributeNames() as $name){?>
				$aux['<?php echo$name; ?>']=$staff-><?php echo$name; ?>;<?php echo"\n";?><?php } ?>
				//***********************************************************
<?php $mode=new $aux[1];?><?php foreach ($mode->attributeNames() as $name){?>
				$aux['<?php echo$name; ?>']=$staff-><?php echo $aux[0]?>-><?php echo$name; ?>;<?php echo"\n";?><?php } ?>
				//**********************************************************
<?php $mode=new $aux[4];?><?php foreach ($mode->attributeNames() as $name){?>
				$aux['<?php echo$name; ?>']=$staff-><?php echo $aux[3]?>-><?php echo$name; ?>;<?php echo"\n";?><?php } ?>
				//**********************************************************
<?php $mode=new $aux[7];?><?php foreach ($mode->attributeNames() as $name){?>
				$aux['<?php echo$name; ?>']=$staff-><?php echo $aux[6]?>-><?php echo$name; ?>;<?php echo"\n";?><?php } ?>
				//**********************************************************
<?php $mode=new $aux[10];?><?php foreach ($mode->attributeNames() as $name){?>
				$aux['<?php echo$name; ?>']=$staff-><?php echo $aux[9]?>-><?php echo$name; ?>;<?php echo"\n";?><?php } ?>
				//**********************************************************
<?php $mode=new $aux[13];?><?php foreach ($mode->attributeNames() as $name){?>
				$aux['<?php echo$name; ?>']=$staff-><?php echo $aux[12]?>-><?php echo$name; ?>;<?php echo"\n";?><?php } ?>
<?php if(sizeof($listRelHasMany)!==0) { 
for($i=0;$i<sizeof($listRelHasMany);$i=$i*3){?>
				$aux2=array();
				foreach($staff-><?php echo $listRelHasMany[$i]; ?> as $va){
					#$aux2=$va->ATRIBUTO;
				}
				#$aux['ATRIBUTO']=$aux2;
<?php if($i==0)$i=1;?>
<?php } }?>					
				$arreglo[]=$aux;					
			}
			$audi->insertAudi("read",$model->tableName());
			$respuesta->registros=$arreglo;	
			$respuesta->total=$total;
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}
<?php endif;?>