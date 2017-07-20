<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda de CAction
*/ 
class ActividadBeneficiario extends CAction
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
				$Criteria=new CDbCriteria();
				$Criteria->join='inner join beneficiario_estado_beneficiario  as beb on beb.fk_id_beneficiario=t.id_beneficiario inner join beneficiario_tipo as bt on bt.id_beneficiario_tipo=beb.fk_id_beneficiario_tipo';
				$Criteria->condition="nombre_beneficiario_tipo ='Beneficiario'";
				$Criteria->group="beb.fk_id_beneficiario";
				$b=$model::model()->findAll($Criteria);
				$total=sizeof($b);
				
				$error="";
				$condi="";
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
								$condi=$condi." ".$condicion." like '%".$valor."%' and ";
								#$Criteria->condition=$condicion." like '%".$valor."%'";

								//$Criteria->order=$condisort.' '.$valorsort;
								//$bens=$model::model()->findAll($Criteria);
								#$bens=$model::model()->with('fkIdReligion','fkIdEntidadSalud','fkIdEscolaridad','beneficiarioEstadoBeneficiarios','beneficiarioTipos')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->ordenar($condisort,$valorsort)->findAll();
								//$bens=$model::model()->with('fkIdReligion','fkIdEntidadSalud','fkIdEscolaridad','beneficiarioEstadoBeneficiarios','beneficiarioTipos')->findAll(array('condition'=>$condi,'offset'=>$_GET['start'],'limit'=>$_GET['limit'],'order'=>$condisort.' '.$valorsort));
							}
							$Criteria->condition=$condi."true";
							$condisort=$sort[0]['property'];
							$valorsort=$sort[0]['direction'];	
							$Criteria->order=$condisort.' '.$valorsort;
								
							$Criteria->limit=$_GET['limit'];
							$Criteria->offset=$_GET['start'];

							$bens=$model::model()->findAll($Criteria);
						}else{
							foreach ($filtro as $parametro) {
								$condicion=$parametro['property'];
								$valor=$parametro['value'];
								#$Criteria->condition=$condicion." like '%".$valor."%'";
								$condi=$condi." ".$condicion." like '%".$valor."%' and ";
								#$bens=$model::model()->with('fkIdReligion','fkIdEntidadSalud','fkIdEscolaridad')->filterTexto($condicion,$valor)->pagina($_GET['limit'],$_GET['start'])->findAll();
								#$bens=$model::model()->with('fkIdReligion','fkIdEntidadSalud','fkIdEscolaridad','beneficiarioEstadoBeneficiarios','beneficiarioTipos')->findAll(array('condition'=>$condicion.' like '.$valor,'offset'=>$_GET['start'],'limit'=>$_GET['limit']));
							}
							$Criteria->condition=$condi."true";
							$Criteria->limit=$_GET['limit'];
							$Criteria->offset=$_GET['start'];
							$bens=$model::model()->findAll($Criteria);
						}
						#$total="".sizeof($modelo);
						//$total="".sizeof($bens);
					}else {	
						if(isset($_GET['sort']) && $_GET['sort']!='') {
							$sort=CJSON::decode($_GET['sort']);
							$condisort=$sort[0]['property'];
							$valorsort=$sort[0]['direction'];	
							$Criteria->order=$condisort.' '.$valorsort;
							
							$Criteria->limit=$_GET['limit'];
							$Criteria->offset=$_GET['start'];
							$bens=$model::model()->findAll($Criteria);
							#$bens=Beneficiario::model()->with('fkIdReligion','fkIdEntidadSalud','fkIdEscolaridad','beneficiarioEstadoBeneficiarios','beneficiarioTipos')->findAll(array('order'=>$condisort.' '.$valorsort,'offset'=>$_GET['start'],'limit'=>$_GET['limit']));
							#echo sizeof($bens);
							
						} else {
							$Criteria->limit=$_GET['limit'];
							$Criteria->offset=$_GET['start'];
							$bens=$model::model()->findAll($Criteria);
							//$bens=$model::model()->with('fkIdReligion','fkIdEntidadSalud','fkIdEscolaridad','beneficiarioTipos','beneficiarioTipoIdentificacions')->pagina($_GET['limit'],$_GET['start'])->findAll();
							#$bens=$model::model()->with('fkIdReligion','fkIdEntidadSalud','fkIdEscolaridad','beneficiarioEstadoBeneficiarios','beneficiarioTipos')->findAll(array('offset'=>$_GET['start'],'limit'=>$_GET['limit']));
						}
						$total="".sizeof($bens);	
					}
				} catch (Exception $e) {
						$error=$e;
				}

				//$total=0;
				
				

				if ($error=="") {
					$arreglo=array();
					foreach($bens as $staff){
						$estado=0;
						$aux=array();
						$aux['id_beneficiario']						=(int)$staff->id_beneficiario;
						#$aux['fk_id_religion']						=(int)$staff->fk_id_religion;
						#$aux['fk_id_entidad_salud']					=(int)$staff->fk_id_entidad_salud;
						#$aux['fk_id_escolaridad']					=(int)$staff->fk_id_escolaridad;
						$aux['codigo_beneficiario']					=$staff->codigo_beneficiario;
						#$aux['numero_identificacion_beneficiario']	=$staff->numero_identificacion_beneficiario;
						$aux['primer_nombre_beneficiario']			=$staff->primer_nombre_beneficiario;
						$aux['segundo_nombre_beneficiario']			=$staff->segundo_nombre_beneficiario;
						$aux['apellido_paterno_beneficiario']		=$staff->apellido_paterno_beneficiario;
						$aux['apellido_materno_beneficiario']		=$staff->apellido_materno_beneficiario;
						#$aux['fecha_nacimiento_beneficiario']		=$staff->fecha_nacimiento_beneficiario;
						#$aux['sexo_beneficiario']					=$staff->sexo_beneficiario;
						#$aux['numero_hijo_beneficiario']			=(int)$staff->numero_hijo_beneficiario;
						#$aux['fotografia_beneficiario']				=$staff->fotografia_beneficiario;
						#$aux['observacion_beneficiario']			=$staff->observacion_beneficiario;
						#$aux['trabaja_beneficiario']				=(int)$staff->trabaja_beneficiario;
						#$aux['carnet_de_salud_beneficiario']		=(int)$staff->carnet_de_salud_beneficiario;
						#$aux['libreta_escolar_beneficiario']		=(int)$staff->libreta_escolar_beneficiario;
						#$aux['informacion_relevante_beneficiario']	=$staff->informacion_relevante_beneficiario;
						#$aux['fecha_creacion_beneficiario']			=$staff->fecha_creacion_beneficiario;
						
						$arreglo2=array();
						foreach ($staff->beneficiarioTipoIdentificacions as $beneficiarioTipoIdentificacion) {
							$aux2=array();
							$aux2['numero_tipo_identificacion']=$beneficiarioTipoIdentificacion->numero_tipo_identificacion;
							$arreglo2[]=$aux2;
						}
						$aux['beneficiario_tipo_identificacion']=$arreglo2;
						$arreglo[]=$aux;
						
						/*$arreglo2=array();
						foreach ($staff->beneficiarioTipos as $beneficiarioTipo) {
							$aux2=array();
							if($beneficiarioTipo->nombre_beneficiario_tipo=="Beneficiario"){
								$estado=1;
							}
							
						}
						if($estado==1) {
							$arreglo[]=$aux;
							$t++;
						}*/
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