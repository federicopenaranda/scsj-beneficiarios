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
class Catequil
{
	/**
	* $relations es un array de entrada que contiene la lista de relaciones del modelo
	* Esta function obtiene datos deL REFERENCIAL  muchos(PRINCIPAL) a uno (REFENCIAL)
	*/
	function obtRelacion($relations)
	{
		$aux=array();
		for($i=0;$i<sizeof($relations);$i++){
			$current=current($relations);
			if(current($current)=="CBelongsToRelation"){
				$key=key($relations);
				next($current);
				$nomode=current($current);
				$aux[]=$key;//retorna el fkIdBeneficiario	0
				$aux[]=$nomode;//retorna Beneficiario		1
				$aux[]=next($current);//fk_id_beneficiario	2
			}
			next($relations);
		}
		return $aux;
	}
}
?>
<?php $mode=new $modelClass;?>
<?php $array=array();$array=$mode->relations();
	$aux=array();
	for($i=0;$i<sizeof($array);$i++){
		$current=current($array);
		if(current($current)=="CBelongsToRelation"){
			$key=key($array);
			next($current);
			$nomode=current($current);
			$aux[]=$key;//retorna el fkIdBeneficiario
			$aux[]=$nomode;//retorna Beneficiario
			$aux[]=next($current);//fk_id_beneficiario
		}
		next($array);
	}
	
	
?>
<?php 
$mode=new $modelClass;
$obj=new Catequil();
$rel=$obj->obtRelacion($mode->relations());
echo print_r($rel);?>
<?php if(sizeof($aux)==0)://RELACION 0?>
REFERNCIAL
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
			try {
				if (isset($_GET['filter']) && $_GET['filter']!='') {
					$filtro=CJSON::decode($_GET['filter']);
					if (isset($_GET['sort']) && $_GET['sort']!='') {		
						$sort=CJSON::decode($_GET['sort']);
						$condisort=isset($sort[0]['property']) ? $sort[0]['property'] : "";
						$valorsort=isset($sort[0]['direction']) ? $sort[0]['direction'] :"error";
						foreach ($filtro as $parametro) {
							$condicion=isset($parametro['property']) ? $parametro['property'] : "" ;
							$valor=isset($parametro['value']) ? $parametro['value'] : "error" ;
							$arreglo=$model::model()->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
						}
					} else {
						foreach ($filtro as $parametro) {
							$condicion=isset($parametro['property']) ? $parametro['property'] : "" ;
							$valor=isset($parametro['value']) ? $parametro['value'] : "error" ;
							$arreglo=$model::model()->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
						}
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
				$audi->insertAudi("read",$model->tableName());
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
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        $error.= (!isset($_GET['start']) && $_GET['start']>0 && is_numeric($_GET['start']) ? "{ Error de start } " : "";
        $error.= (!isset($_GET['limit']) && $_GET['limit']>0 && is_numeric($_GET['limit']) ? "{ Error de limit } " : "";
        if ($error == "") {
			$callback=$_GET['callback'];
			if(isset($_GET['limit']) && $_GET['limit']>0 && is_numeric($_GET['limit'])&&isset($_GET['start']) && $_GET['start']>=0 && $_GET['start']<=$_GET['limit'] && isset($_GET['start'])&& is_numeric($_GET['start'])){
				$model=new <?php echo $modelClass; ?>();
				if(isset($_GET['filter']) && $_GET['filter']!=''){
					$filtro=CJSON::decode($_GET['filter']);
					if(isset($_GET['sort']) && $_GET['sort']!=''){		
						$sort=CJSON::decode($_GET['sort']);
						$condisort=$sort[0]['property'];
						$valorsort=$sort[0]['direction'];
						foreach ($filtro as $parametro) {
							$condicion=$parametro['property'];
							$valor=$parametro['value'];
								$modelo=$model::model()->with('<?php echo $aux[0] ?>')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();					
							}
						}
					}else{
						foreach ($filtro as $parametro) {
							$condicion=$parametro['property'];
							$valor=$parametro['value'];
							$modelo=$model::model()->with('<?php echo $aux[0] ?>')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
						}
					}
					$total="".sizeof($modelo);
				}else{
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
					$arreglo[]=$aux;
				}
				$audi->insertAudi("read",$model->tableName());
				$respuesta->registros=$arreglo;	
				$respuesta->total=$total;
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			}
		}else{
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
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        $error.= (!isset($_GET['start']) && $_GET['start']>0 && is_numeric($_GET['start']) ? "{ Error de start } " : "";
        $error.= (!isset($_GET['limit']) && $_GET['limit']>0 && is_numeric($_GET['limit']) ? "{ Error de limit } " : "";
        if ($error == "") {
			$callback=$_GET['callback'];
			if(isset($_GET['limit']) && $_GET['limit']>0 && is_numeric($_GET['limit'])&&isset($_GET['start']) && $_GET['start']>=0 && $_GET['start']<=$_GET['limit'] && isset($_GET['start'])&& is_numeric($_GET['start'])){
				$model=new <?php echo $modelClass; ?>();
				if(isset($_GET['filter']) && $_GET['filter']!=''){
					$filtro=CJSON::decode($_GET['filter']);
					if(isset($_GET['sort']) && $_GET['sort']!=''){		
						$sort=CJSON::decode($_GET['sort']);
						$condisort=$sort[0]['property'];
						$valorsort=$sort[0]['direction'];
						foreach ($filtro as $parametro) {
							$condicion=$parametro['property'];
							$valor=$parametro['value'];
								$modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();			
							}
						}	
					}else{
						foreach ($filtro as $parametro) {
							$condicion=$parametro['property'];
							$valor=$parametro['value'];
							$modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
						}
					}
					$total="".sizeof($modelo);	
				}else{
					if(isset($_GET['sort']) && $_GET['sort']!=''){
						$sort=CJSON::decode($_GET['sort']);
						$condisort=$sort[0]['property'];
						$valorsort=$sort[0]['direction'];	
						$modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
					}else{
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
					$arreglo[]=$aux;
				}
				$audi->insertAudi("read",$model->tableName());
				$respuesta->registros=$arreglo;	
				$respuesta->total=$total;
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			}
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
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        $error.= (!isset($_GET['start']) && $_GET['start']>0 && is_numeric($_GET['start']) ? "{ Error de start } " : "";
        $error.= (!isset($_GET['limit']) && $_GET['limit']>0 && is_numeric($_GET['limit']) ? "{ Error de limit } " : "";
        if ($error == "") {
			$callback=$_GET['callback'];
			if(isset($_GET['limit']) && $_GET['limit']>0 && is_numeric($_GET['limit'])&&isset($_GET['start']) && $_GET['start']>=0 && $_GET['start']<=$_GET['limit'] && isset($_GET['start'])&& is_numeric($_GET['start'])){
				$model=new <?php echo $modelClass; ?>();
				if(isset($_GET['filter']) && $_GET['filter']!=''){
					$filtro=CJSON::decode($_GET['filter']);
					if(isset($_GET['sort']) && $_GET['sort']!=''){		
						$sort=CJSON::decode($_GET['sort']);
						$condisort=$sort[0]['property'];
						$valorsort=$sort[0]['direction'];
						foreach ($filtro as $parametro) {
							$condicion=$parametro['property'];
							$valor=$parametro['value'];
								$modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>','<?php echo $aux[6] ?>')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();			
							}
						}
					}else{
						foreach ($filtro as $parametro) {
							$condicion=$parametro['property'];
							$valor=$parametro['value'];
							$modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>','<?php echo $aux[6] ?>')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
						}
					}
					$total="".sizeof($modelo);
				}else{
					if(isset($_GET['sort']) && $_GET['sort']!=''){
						$sort=CJSON::decode($_GET['sort']);
						$condisort=$sort[0]['property'];
						$valorsort=$sort[0]['direction'];	
						$modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>','<?php echo $aux[6] ?>')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
					}else{
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
					$arreglo[]=$aux;
				}
				$audi->insertAudi("read",$model->tableName());
				$respuesta->registros=$arreglo;	
				$respuesta->total=$total;
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			}
		}else{
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
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        $error.= (!isset($_GET['start']) && $_GET['start']>0 && is_numeric($_GET['start']) ? "{ Error de start } " : "";
        $error.= (!isset($_GET['limit']) && $_GET['limit']>0 && is_numeric($_GET['limit']) ? "{ Error de limit } " : "";
        if ($error == "") {
			$callback=$_GET['callback'];
			if(isset($_GET['limit']) && $_GET['limit']>0 && is_numeric($_GET['limit'])&&isset($_GET['start']) && $_GET['start']>=0 && $_GET['start']<=$_GET['limit'] && isset($_GET['start'])&& is_numeric($_GET['start'])){
				$model=new <?php echo $modelClass; ?>();
				if(isset($_GET['filter']) && $_GET['filter']!=''){
					$filtro=CJSON::decode($_GET['filter']);
					if(isset($_GET['sort']) && $_GET['sort']!=''){		
						$sort=CJSON::decode($_GET['sort']);
						$condisort=$sort[0]['property'];
						$valorsort=$sort[0]['direction'];
						foreach ($filtro as $parametro) {
							$condicion=$parametro['property'];
							$valor=$parametro['value'];
								$modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>','<?php echo $aux[6] ?>','<?php echo $aux[9] ?>')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();			
							}
						}
					}else{
						foreach ($filtro as $parametro) {
							$condicion=$parametro['property'];
							$valor=$parametro['value'];
							if(gettype($valor)=='string'){
								$modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>','<?php echo $aux[6] ?>','<?php echo $aux[9] ?>')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();								
							}
						}
					}
					$total="".sizeof($modelo);
				}else{
					if(isset($_GET['sort']) && $_GET['sort']!=''){
						$sort=CJSON::decode($_GET['sort']);
						$condisort=$sort[0]['property'];
						$valorsort=$sort[0]['direction'];	
						$modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>','<?php echo $aux[6] ?>','<?php echo $aux[9] ?>')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
					}else{
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
					$arreglo[]=$aux;					
				}
				$audi->insertAudi("read",$model->tableName());
				$respuesta->registros=$arreglo;	
				$respuesta->total=$total;
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			}
		}else{
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
		$error.= (!isset($_GET['records'])) ? "{ Error en la variable records } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        $error.= (!isset($_GET['start']) && $_GET['start']>0 && is_numeric($_GET['start']) ? "{ Error de start } " : "";
        $error.= (!isset($_GET['limit']) && $_GET['limit']>0 && is_numeric($_GET['limit']) ? "{ Error de limit } " : "";
        if ($error == "") {
			$callback=$_GET['callback'];
			if(isset($_GET['limit']) && $_GET['limit']>0 && is_numeric($_GET['limit'])&&isset($_GET['start']) && $_GET['start']>=0 && $_GET['start']<=$_GET['limit'] && isset($_GET['start'])&& is_numeric($_GET['start'])){
				$model=new <?php echo $modelClass; ?>();
				if(isset($_GET['filter']) && $_GET['filter']!=''){
					$filtro=CJSON::decode($_GET['filter']);
					if(isset($_GET['sort']) && $_GET['sort']!=''){		
						$sort=CJSON::decode($_GET['sort']);
						$condisort=$sort[0]['property'];
						$valorsort=$sort[0]['direction'];
						foreach ($filtro as $parametro) {
							$condicion=$parametro['property'];
							$valor=$parametro['value'];
								$modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>','<?php echo $aux[6] ?>','<?php echo $aux[9] ?>','<?php echo $aux[12] ?>')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();			
							}
						}
					}else{
						foreach ($filtro as $parametro) {
							$condicion=$parametro['property'];
							$valor=$parametro['value'];
							if(gettype($valor)=='string'){
								$modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>','<?php echo $aux[6] ?>','<?php echo $aux[9] ?>','<?php echo $aux[12] ?>')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();								
							}
						}
					}
					$total="".sizeof($modelo);
				}else{
					if(isset($_GET['sort']) && $_GET['sort']!=''){
						$sort=CJSON::decode($_GET['sort']);
						$condisort=$sort[0]['property'];
						$valorsort=$sort[0]['direction'];	
						$modelo=$model::model()->with('<?php echo $aux[0] ?>','<?php echo $aux[3] ?>','<?php echo $aux[6] ?>','<?php echo $aux[9] ?>','<?php echo $aux[12] ?>')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
					}else{
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
					$arreglo[]=$aux;					
				}
				$audi->insertAudi("read",$model->tableName());
				$respuesta->registros=$arreglo;	
				$respuesta->total=$total;
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}
<?php endif;?>