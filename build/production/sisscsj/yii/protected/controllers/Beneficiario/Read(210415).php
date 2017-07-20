<?php
error_reporting(0);
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
		$error="";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        $error.= (!isset($_GET['start'])) ? "{ Error de start } " : "";
        $error.= (!isset($_GET['limit'])) ? "{ Error de limit } " : "";
		if ($error == "") {
			
			$callback=$_GET['callback'];
			
			if (isset($_GET['sort']) && $_GET['sort']!='') {
				$sort=CJSON::decode($_GET['sort']);
				$condisort = $sort[0]['property'];
				$valorsort = $sort[0]['direction'];
			} else {
				$sort=CJSON::decode($_GET['sort']);
				$condisort = "id_beneficiario";
				$valorsort = "asc";
			}
			
			if (isset($_GET['query']) && $_GET['query'] != "") {
					
				$condiQuery = "";
				$filtro = CJSON::decode($_GET['query']);

				foreach ($filtro as $fvalues):
					foreach($fvalues as $fk=>$fv):
						$condiQuery.= $fk." LIKE '%".$fv."%' OR ";
					endforeach;
				endforeach;
				$condiQuery = substr ($condiQuery, 0, -3);
			} else {

				if (isset($_GET['filter']) && $_GET['filter']!='') {
	
					$filtro=CJSON::decode($_GET['filter']);
					$condi="";
					$contFil=1;
					foreach ($filtro as $parametro) {
						
						$condicion	= $parametro['property'];
						$valor		= $parametro['value'];
						$condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " :  $condicion." LIKE '%".$valor."%'";	
						$contFil++;
					}
				}
			}//query

				$model = new Beneficiario();
				$id = Yii::app()->user->getId();
				$Criteria = new CDbCriteria();
				$Criteria->join='INNER JOIN beneficiario_entidad AS ne ON ne.fk_id_beneficiario = t.id_beneficiario
INNER JOIN entidad AS e ON ne.fk_id_entidad = e.id_entidad';
				$Criteria->condition="e.id_entidad IN (SELECT
ue.fk_id_entidad
FROM
usuario_entidad AS ue
WHERE
ue.fk_id_usuario = $id)";
				if (isset($_GET['query']) && $_GET['query'] != "")
					$Criteria->condition = $condiQuery;
				if (isset($_GET['filter']) && $_GET['filter']!='')
					$Criteria->condition = $condi;
				$Criteria->order=$condisort." ".$valorsort;
				$total = Beneficiario::model()->count($Criteria);
				$Criteria->offset = $_GET['start'];
				$Criteria->limit = $_GET['limit'];
				$bens=$model::model()->findAll($Criteria);
				#$total=sizeof($bens);
				$arreglo=array();
				foreach($bens as $staff){
					$aux=array();
					$aux['id_beneficiario']						=(int)$staff->id_beneficiario;
					$aux['fk_id_religion']						=(int)$staff->fk_id_religion;
					$aux['fk_id_entidad_salud']					=(int)$staff->fk_id_entidad_salud;
					$aux['fk_id_curso']							=(int)$staff->fk_id_curso;
					$aux['fk_id_nivel']							=(int)$staff->fk_id_nivel;
					$aux['fk_id_turno']							=(int)$staff->fk_id_turno;
					$aux['fk_id_formacion']						=(int)$staff->fk_id_formacion;
					$aux['codigo_beneficiario']					=$staff->codigo_beneficiario;
					$aux['primer_nombre_beneficiario']			=$staff->primer_nombre_beneficiario;
					$aux['segundo_nombre_beneficiario']			=$staff->segundo_nombre_beneficiario;
					$aux['apellido_paterno_beneficiario']		=$staff->apellido_paterno_beneficiario;
					$aux['apellido_materno_beneficiario']		=$staff->apellido_materno_beneficiario;
					$aux['fecha_nacimiento_beneficiario']		=$staff->fecha_nacimiento_beneficiario;
					$aux['sexo_beneficiario']					=$staff->sexo_beneficiario;
					$aux['numero_hijo_beneficiario']			=$staff->numero_hijo_beneficiario;
					$aux['fotografia_beneficiario']				=$staff->fotografia_beneficiario;
					$aux['observacion_beneficiario']			=$staff->observacion_beneficiario;
					$aux['trabaja_beneficiario']				=$staff->trabaja_beneficiario;
					$aux['carnet_de_salud_beneficiario']		=$staff->carnet_de_salud_beneficiario;
					$aux['libreta_escolar_beneficiario']		=$staff->libreta_escolar_beneficiario;
					$aux['informacion_relevante_beneficiario']	=$staff->informacion_relevante_beneficiario;
					$aux['fecha_creacion_beneficiario']			=$staff->fecha_creacion_beneficiario;
					//***********************************************************
					$aux['id_religion']=$staff->fkIdReligion->id_religion;
					$aux['nombre_religion']=$staff->fkIdReligion->nombre_religion;
					$aux['descripcion_religion']=$staff->fkIdReligion->descripcion_religion;
					//**********************************************************
					$aux['id_entidad_salud']=$staff->fkIdEntidadSalud->id_entidad_salud;
					$aux['nombre_entidad_salud']=$staff->fkIdEntidadSalud->nombre_entidad_salud;
					$aux['observaciones_entidad_salud']=$staff->fkIdEntidadSalud->observaciones_entidad_salud;
					//**********************************************************
					$aux['id_curso']=$staff->fkIdCurso->id_curso;
					$aux['nombre_curso']=$staff->fkIdCurso->nombre_curso;
					//**********************************************************
					$aux['id_nivel']=$staff->fkIdNivel->id_nivel;
					$aux['nombre_nivel']=$staff->fkIdNivel->nombre_nivel;
					//**********************************************************
					$aux['id_turno']=$staff->fkIdTurno->id_turno;
					$aux['nombre_turno']=$staff->fkIdTurno->nombre_turno;
					//*******************************************************
					$aux['id_formacion']=$staff->fkIdFormacion->id_formacion;
					$aux['nombre_formacion']=$staff->fkIdFormacion->nombre_formacion;
					$aux['descripcion_formacion']=$staff->fkIdFormacion->descripcion_formacion;
					$aux2=array();
					foreach($staff->beneficiarioIdiomas as $va) {
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
					
					$aux2=array();
					foreach($staff->beneficiarioDonantes as $va){
						$aux2[]=$va->fk_id_donante;
					}
					$aux['beneficiario_donante']=$aux2;
					$arreglo[]=$aux;
				}
				$respuesta->success="true";
				$respuesta->registros=$arreglo;	
				$respuesta->total=(int)$total;
				$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$controller->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
}