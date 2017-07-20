<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda de CAction
*/ 
class Read extends CAction{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de listar todos los registros de una tabla en la base de datos
* @param array $callback se introduce el nombre de una funcion
*/
	public function run(){
		$controller=$this->getController();
		$respuesta=new stdClass();
		if(isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
			$callback=$_GET['callback'];
			
			if(isset($_GET['limit']) && $_GET['limit']>0 && is_numeric($_GET['limit'])&&isset($_GET['start']) && $_GET['start']>=0 && $_GET['start']<=$_GET['limit'] && isset($_GET['start'])&& is_numeric($_GET['start'])){
				$model=new PrivilegiosTipoUsuario();
				$error="";
				try {
					if(isset($_GET['filter']) && $_GET['filter']!=''){
						$filtro=CJSON::decode($_GET['filter']);
						
						if(isset($_GET['sort']) && $_GET['sort']!=''){		
							$sort=CJSON::decode($_GET['sort']);
							$condisort=$sort[0]['property'];
							$valorsort=$sort[0]['direction'];
							foreach ($filtro as $parametro) {
								$condicion=$parametro['property'];
								$valor=$parametro['value'];
								$modelo=$model::model()->with('fkIdPrivilegiosUsuario','TipoUsuario')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
							}	
						} else {
							foreach ($filtro as $parametro) {
								$condicion=$parametro['property'];
								$valor=$parametro['value'];
								$modelo=$model::model()->with('fkIdPrivilegiosUsuario','TipoUsuario')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();	
							}
						}
						$total="".sizeof($modelo);	
					} else {
						if (isset($_GET['sort']) && $_GET['sort']!=''){
							$sort=CJSON::decode($_GET['sort']);
							$condisort=$sort[0]['property'];
							$valorsort=$sort[0]['direction'];	
							$modelo=$model::model()->with('fkIdPrivilegiosUsuario','TipoUsuario')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
						} else {
							$modelo=$model::model()->with('fkIdPrivilegiosUsuario','TipoUsuario')->pagina($_GET['limit'],$_GET['start'])->findAll();
						}
						$total=$model->count();
					}
				} catch (Exception $e) {
						$error=$e;
				}
				if ($error=="") {
					$arreglo=array();
					foreach($modelo as $staff){
						$aux=array();
						$aux['fk_id_privilegios_usuario']		=(int)$staff->fk_id_privilegios_usuario;
						$aux['fk_id_tipo_usuario']				=(int)$staff->fk_id_tipo_usuario;
						$aux['estado_privilegio_tipo_usuario']	=(int)$staff->estado_privilegio_tipo_usuario;
						//***********************************************************
						$aux['id_privilegios_usuario']			=(int)$staff->fkIdPrivilegiosUsuario->id_privilegios_usuario;
						$aux['nombre_privilegio_usuario']		=$staff->fkIdPrivilegiosUsuario->nombre_privilegio_usuario;
						$aux['accion_privilegio_usuario']		=$staff->fkIdPrivilegiosUsuario->accion_privilegio_usuario;
						$aux['opciones_privilegio_usuario']		=$staff->fkIdPrivilegiosUsuario->opciones_privilegio_usuario;
						$aux['funcion_privilegio_usuario']		=$staff->fkIdPrivilegiosUsuario->funcion_privilegio_usuario;
						$aux['descripcion_privilegios_usuario']	=$staff->fkIdPrivilegiosUsuario->descripcion_privilegios_usuario;
						//**********************************************************
						$aux['id_tipo_usuario']					=(int)$staff->TipoUsuario->id_tipo_usuario;
						$aux['nombre_tipo_usuario']				=$staff->TipoUsuario->nombre_tipo_usuario;
						$aux['descripcion_tipo_usuario']		=$staff->TipoUsuario->descripcion_tipo_usuario;
						$arreglo[]=$aux;
					}
					$respuesta->registros=$arreglo;	
					$respuesta->total=(int)$total;
					$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
				} else {
					$respuesta->meta=array("success"=>"false","msg"=>$error);
					$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
				}
			}else{
				$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			}
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Error de callback");
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}