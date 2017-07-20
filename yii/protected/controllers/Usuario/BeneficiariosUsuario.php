<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda de CAction
*/ 
class BeneficiariosUsuario extends CAction
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
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
        #$error.= (!isset($_GET['start'])) ? "{ Error de start } " : "";
        #$error.= (!isset($_GET['limit'])) ? "{ Error de limit } " : "";
		
		if ($error == "") {
			
			$callback=$_GET['callback'];
			$idl=Yii::app()->user->getId();
				$model=new Beneficiario();
				$Criteria=new CDbCriteria();
				$Criteria->condition="t.id_beneficiario IN (SELECT
gb.fk_id_beneficiario
FROM
usuario_beneficiario AS ub
INNER JOIN gestion_beneficiario AS gb ON ub.fk_id_gestion_beneficiario = gb.id_gestion_beneficiario
WHERE
gb.estado_gestion_beneficiario = 1 AND
ub.fk_id_usuario = $idl)";
				$total = Beneficiario::model()->count($Criteria);
				#$Criteria->offset = $_GET['start'];
				#$Criteria->limit = $_GET['limit'];
				$bens=$model::model()->findAll($Criteria);
				#$total=sizeof($bens);
				$arreglo=array();
				foreach($bens as $staff){
					$aux=array();
					$aux['id_beneficiario']						=(int)$staff->id_beneficiario;
					#$aux['fk_id_religion']						=(int)$staff->fk_id_religion;
					#$aux['fk_id_entidad_salud']					=(int)$staff->fk_id_entidad_salud;
					#$aux['fk_id_curso']							=(int)$staff->fk_id_curso;
					#$aux['fk_id_nivel']							=(int)$staff->fk_id_nivel;
					#$aux['fk_id_turno']							=(int)$staff->fk_id_turno;
					#$aux['fk_id_formacion']						=(int)$staff->fk_id_formacion;
					$aux['codigo_beneficiario']					=$staff->codigo_beneficiario;
					$aux['primer_nombre_beneficiario']			=$staff->primer_nombre_beneficiario;
					#$aux['segundo_nombre_beneficiario']			=$staff->segundo_nombre_beneficiario;
					$aux['apellido_paterno_beneficiario']		=$staff->apellido_paterno_beneficiario;
					#$aux['apellido_materno_beneficiario']		=$staff->apellido_materno_beneficiario;
					#$aux['fecha_nacimiento_beneficiario']		=$staff->fecha_nacimiento_beneficiario;
					#$aux['sexo_beneficiario']					=$staff->sexo_beneficiario;
					#$aux['numero_hijo_beneficiario']			=$staff->numero_hijo_beneficiario;
					#$aux['fotografia_beneficiario']				=$staff->fotografia_beneficiario;
					#$aux['observacion_beneficiario']			=$staff->observacion_beneficiario;
					#$aux['trabaja_beneficiario']				=$staff->trabaja_beneficiario;
					#$aux['carnet_de_salud_beneficiario']		=$staff->carnet_de_salud_beneficiario;
					#$aux['libreta_escolar_beneficiario']		=$staff->libreta_escolar_beneficiario;
					#$aux['informacion_relevante_beneficiario']	=$staff->informacion_relevante_beneficiario;
					#$aux['fecha_creacion_beneficiario']			=$staff->fecha_creacion_beneficiario;

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