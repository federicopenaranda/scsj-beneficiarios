<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda de CAction
*/ 
class Read extends CAction
{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de listar todos los registros de una tabla en la base de datos
* @param array $callback se introduce el nombre de una funcion
*/
	public function run()
	{
		$controller=$this->getController();
		$respuesta=new stdClass();
		if(isset($_GET['callback'])&&$_GET['callback']!=='' && !is_numeric($_GET['callback'])){
			$callback=$_GET['callback'];
			if(isset($_GET['limit']) && $_GET['limit']>0 && is_numeric($_GET['limit'])&&isset($_GET['start']) && $_GET['start']>=0 && $_GET['start']<=$_GET['limit'] && isset($_GET['start'])&& is_numeric($_GET['start'])){
				$model=new Beneficiario();
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
								$modelo=$model::model()->with('fkIdReligion','fkIdEntidadSalud','fkIdEscolaridad')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();			
							}
						}else{
							foreach ($filtro as $parametro) {
								$condicion=$parametro['property'];
								$valor=$parametro['value'];
								$modelo=$model::model()->with('fkIdReligion','fkIdEntidadSalud','fkIdEscolaridad')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();	
							}
						}
						$total="".sizeof($modelo);
					}else{
						
							if(isset($_GET['sort']) && $_GET['sort']!=''){
							$sort=CJSON::decode($_GET['sort']);
							$condisort=$sort[0]['property'];
							$valorsort=$sort[0]['direction'];	
							$modelo=$model::model()->with('fkIdReligion','fkIdEntidadSalud','fkIdEscolaridad')->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();		
							}else{
								$modelo=$model::model()->with('fkIdReligion','fkIdEntidadSalud','fkIdEscolaridad')->pagina($_GET['limit'],$_GET['start'])->findAll();
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
						$aux['id_beneficiario']						=(int)$staff->id_beneficiario;
						$aux['fk_id_religion']						=(int)$staff->fk_id_religion;
						$aux['fk_id_entidad_salud']					=(int)$staff->fk_id_entidad_salud;
						$aux['fk_id_escolaridad']					=(int)$staff->fk_id_escolaridad;
						$aux['codigo_beneficiario']					=$staff->codigo_beneficiario;
						$aux['numero_identificacion_beneficiario']	=$staff->numero_identificacion_beneficiario;
						$aux['primer_nombre_beneficiario']			=$staff->primer_nombre_beneficiario;
						$aux['segundo_nombre_beneficiario']			=$staff->segundo_nombre_beneficiario;
						$aux['apellido_paterno_beneficiario']		=$staff->apellido_paterno_beneficiario;
						$aux['apellido_materno_beneficiario']		=$staff->apellido_materno_beneficiario;
						$aux['fecha_nacimiento_beneficiario']		=$staff->fecha_nacimiento_beneficiario;
						$aux['sexo_beneficiario']					=$staff->sexo_beneficiario;
						$aux['numero_hijo_beneficiario']			=(int)$staff->numero_hijo_beneficiario;
						$aux['fotografia_beneficiario']				=$staff->fotografia_beneficiario;
						$aux['observacion_beneficiario']			=$staff->observacion_beneficiario;
						$aux['trabaja_beneficiario']				=(int)$staff->trabaja_beneficiario;
						$aux['carnet_de_salud_beneficiario']		=(int)$staff->carnet_de_salud_beneficiario;
						$aux['libreta_escolar_beneficiario']		=(int)$staff->libreta_escolar_beneficiario;
						$aux['informacion_relevante_beneficiario']	=$staff->informacion_relevante_beneficiario;
						$aux['fecha_creacion_beneficiario']			=$staff->fecha_creacion_beneficiario;
						//***********************************************************
						$aux['id_religion']							=(int)$staff->fkIdReligion->id_religion;
						$aux['nombre_religion']						=$staff->fkIdReligion->nombre_religion;
						$aux['descripcion_religion']				=$staff->fkIdReligion->descripcion_religion;
						//**********************************************************
						$aux['id_entidad_salud']					=(int)$staff->fkIdEntidadSalud->id_entidad_salud;
						$aux['nombre_entidad_salud']				=$staff->fkIdEntidadSalud->nombre_entidad_salud;
						$aux['observaciones_entidad_salud']			=$staff->fkIdEntidadSalud->observaciones_entidad_salud;
						//**********************************************************
						$aux['id_escolaridad']						=(int)$staff->fkIdEscolaridad->id_escolaridad;
						$aux['nombre_escolaridad']					=$staff->fkIdEscolaridad->nombre_escolaridad;
						$aux['descripcion_escolaridad']				=$staff->fkIdEscolaridad->descripcion_escolaridad;
						$aux['turno_escolaridad']					=$staff->fkIdEscolaridad->turno_escolaridad;
						$aux2=array();
						foreach($staff->beneficiarioIdiomas as $va){
							$aux2[]=$va->fk_id_idioma;
						}
						$aux['beneficiario_idioma']=$aux2;
						$aux2=array();
						foreach($staff->beneficiarioActividadFavoritas as $va){
							$aux2[]=$va->fk_id_actividad_favorita;
						}
						$aux['beneficiario_actividad_favorita']=$aux2;
						$aux2=array();
						foreach($staff->beneficiarioOtrosProgramas as $va){
							$aux2[]=$va->fk_id_otros_programas;
						}
						$aux['beneficiario_otros_programas']=$aux2;
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