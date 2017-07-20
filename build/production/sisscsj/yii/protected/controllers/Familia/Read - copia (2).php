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
				$condisort = "id_familia";
				$valorsort = "asc";
			}
			
			if (isset($_GET['filter']) && $_GET['filter']!='') {
				
				$filtro=CJSON::decode($_GET['filter']);
				$condi="";
				$contFil=1;
				foreach ($filtro as $parametro) {
					
					$condicion	= $parametro['property'];
					$valor		= $parametro['value'];
					if ($condicion == "primer_nombre_beneficiario" ||
						$condicion == 'segundo_nombre_beneficiario' ||
						$condicion == 'apellido_paterno_beneficiario' ||
						$condicion == 'apellido_materno_beneficiario'
					){
						$condi.= $contFil!=sizeof($filtro) ? 'b.'.$condicion." LIKE '%".$valor."%' OR " :  'b.'.$condicion." LIKE '%".$valor."%'";	
						$contFil++;
					} else {
						$condi.= $contFil!=sizeof($filtro) ? $condicion." LIKE '%".$valor."%' AND " :  $condicion." LIKE '%".$valor."%'";	
						$contFil++;
					}
				}
			}

			$model = new Familia();
			$id = Yii::app()->user->getId();
			$Criteria = new CDbCriteria();
			$Criteria->distinct=true; 
			$Criteria->join='LEFT JOIN familia_metodo_planificacion_familiar AS fmpf ON fmpf.fk_id_familia = t.id_familia
INNER JOIN beneficiario_familia AS bf ON bf.fk_id_familia = t.id_familia
INNER JOIN beneficiario AS b ON bf.fk_id_beneficiario = b.id_beneficiario
INNER JOIN beneficiario_entidad AS be ON be.fk_id_beneficiario = b.id_beneficiario';
			$Criteria->condition="be.fk_id_entidad IN (SELECT
ue.fk_id_entidad
FROM
usuario_entidad AS ue
WHERE
ue.fk_id_usuario = $id)";

			if (isset($_GET['filter']) && $_GET['filter']!='')
				#$Criteria->condition = "b.apellido_paterno_beneficiario = 'Nina'"; 
				$Criteria->addcondition = $condi;
				$Criteria->order=$condisort." ".$valorsort;
				$total = Familia::model()->count($Criteria);
				$Criteria->offset = $_GET['start'];
				$Criteria->limit = $_GET['limit'];
				$bens=$model::model()->findAll($Criteria);
				#$total=sizeof($bens);
				$arreglo=array();
				foreach ($bens as $staff) {

					$aux=array();
					$aux['id_familia']					=(int)$staff->id_familia;
					$aux['codigo_familia']				=$staff->codigo_familia;
					$aux['codigo_familia_antiguo']		=$staff->codigo_familia_antiguo;
					$aux['numero_hijos_viven_familia']	=(int)$staff->numero_hijos_viven_familia;
					$aux['estado_familia']				=(int)$staff->estado_familia;
					$aux['fecha_creacion_familia']		=$staff->fecha_creacion_familia;
					$aux2=array();
					foreach ($staff->familiaMetodoPlanificacionFamiliar as $va ) {
						$aux2[]=$va->fk_id_metodo_planificacion_familiar;
					}
					$aux['familia_metodo_planificacion_familiar']=$aux2;
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