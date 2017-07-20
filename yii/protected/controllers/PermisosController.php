<?php
/**
 * Este es el controlador para el modelo "".
 */
class PermisosController extends Controller
{
	public function actionPribilegio()
	{
		$respuesta=new stdClass();
		$error="";
		$error.= (!isset($_GET['limit'])) ? "{ Error variable indefinida limit } " : "";
		$error.= (!isset($_GET['start'])) ? "{ Error variable indefinida start } " : "";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
    	if ($error == "") {
			$callback=$_GET['callback'];
			$objusu=new PrivilegiosUsuario();
			$nombre=Yii::app()->user->name;
			$Criteria=new CDbCriteria();
			$Criteria->join='INNER JOIN privilegios_tipo_usuario AS ptu ON ptu.fk_id_privilegios_usuario =									t.id_privilegios_usuario
							INNER JOIN tipo_usuario AS tu ON ptu.fk_id_tipo_usuario = tu.id_tipo_usuario
							INNER JOIN usuario AS u ON u.fk_id_tipo_usuario = tu.id_tipo_usuario';
			$Criteria->condition="u.login_usuario = '$nombre'";
			$b=$objusu::model()->findAll($Criteria);
			$total=sizeof($b);
			$condi="";
			$error="";
			try {
				if (isset($_GET['filter']) && $_GET['filter']!='') {
					$filtro=CJSON::decode($_GET['filter']);
					foreach ($filtro as $parametro) {
						$condicion=$parametro['property'];
						$valor=$parametro['value'];
						$condi=$condi." ".$condicion." like '%".$valor."%' and ";		
					}
					$Criteria->condition=$condi."true";
					if (isset($_GET['sort']) && $_GET['sort']!='') {
						$sort=CJSON::decode($_GET['sort']);
						$condisort=$sort[0]['property'];
						$valorsort=$sort[0]['direction'];	
						$Criteria->order=$condisort.' '.$valorsort;
					}
					$Criteria->limit=$_GET['limit'];
					$Criteria->offset=$_GET['start'];
					$bens=$objusu::model()->findAll($Criteria);	
				} else {
					if (isset($_GET['sort']) && $_GET['sort']!='') {
						$sort=CJSON::decode($_GET['sort']);
						$condisort=$sort[0]['property'];
						$valorsort=$sort[0]['direction'];	
						$Criteria->order=$condisort.' '.$valorsort;
					}
					$Criteria->limit=$_GET['limit'];
					$Criteria->offset=$_GET['start'];
					$bens=$objusu::model()->findAll($Criteria);
					$total="".sizeof($bens);	
				}
			} catch (Exception $e) {
				$error=$e;
			}
			if ($error=="") {
				$arreglo=array();
				foreach($bens as $staff){
					$aux=array();
					$aux['nombre_privilegio_usuario']	=$staff->nombre_privilegio_usuario;
					$aux['accion_privilegio_usuario']	=$staff->accion_privilegio_usuario;
					$arreglo[]=$aux;	
				}
				$respuesta->registros=$arreglo;	
				$respuesta->total=(int)$total;
				$this->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			} else {
				$respuesta->meta=array("success"=>"false","msg"=>$error);
				$this->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
			}
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$this->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}
	
	public function actionTipousuario()
	{
		$respuesta=new stdClass();
		$error="";
		$error.= (!isset($_GET['callback'])) ? "{ Error de Callback } " : "";
		if ($error == "") {
			$callback=$_GET['callback'];
			$objusu=new Usuario();
			#$nombre=Yii::app()->user->name;
			$nombre=Yii::app()->user->id;
			$condicion="id_usuario='$nombre'";
			$bens=$objusu::model()->with('fkIdTipoUsuario')->findAll(array('condition'=>$condicion));
			$total=sizeof($bens);
			$arreglo=array();
			foreach($bens as $staff){
				$aux=array();
				$aux['nombre_usuario']=$staff->nombre_usuario;
				$aux['nombre_tipo_usuario']	=$staff->fkIdTipoUsuario->nombre_tipo_usuario;
				$arreglo[]=$aux;	
			}
			$respuesta->registros=$arreglo;	
			$respuesta->total=(int)$total;
			$this->renderParTial('read',array('model'=>$respuesta,'callback'=>$callback));
				
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>$error);
			$this->renderParTial('read',array('model'=>$respuesta,'callback'=>''));
		}
	}		
}
