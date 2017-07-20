<?php

/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedad y metodos de la clase padre CAtion
*/ 
class Reporte1 extends CAction
{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de crear un nuevo registro y adicionarlo en una tabla
* @param array $callback se introduce el nombre de una funcion
*/
   public function run()
   {
	  
		$controller=$this->getController();
		$respuesta=new stdClass();
		$model=new Biblioteca();
		$mPDF1=Yii::app()->ePdf->mpdf();
		//$mPDF1->SetHTMLHeaderByName('Content-Disposition: attachment;filename="REP1.PDF"');
		$error="";
		$listaConsulta1=array();
		$listaConsulta2=array();
		$listaConsulta3=array();
		$listaConsulta4=array();
		$cien=0;
		if ($_GET['start'] && $_GET['limit'] && isset($_GET['start']) && isset($_GET['limit'])){
			$fini=$_GET['start'];
			$ffin=$_GET['limit'];
			$fechini=explode("-", $fini);
			$fechfin=explode("-", $ffin);
					$res=$model->consulta1($fini,$ffin);
					$sum1=0;
					for ($i=0;$i<sizeof($res);$i++){
						switch ($res[$i]['sexo_usuario_biblioteca']) {
							case 'f':
								$listaConsulta1["Femenino"]=$res[$i]['cantidad'];
								break;
							case 'm':
								$listaConsulta1["Masculino"]=$res[$i]['cantidad'];
								break;
						}	
						$sum1=$sum1+$res[$i]['cantidad'];
					}

					$res=$model->consulta2($fini,$ffin);
					$sum2=0;
					for ($i=0;$i<sizeof($res);$i++) {
						switch ($res[$i]['nombre_escolaridad'].'-'.$res[$i]['turno_escolaridad']) {
							case 'Primaria-manana':
								$listaConsulta2["Primaria (Mañana)"]=$res[$i]['cantidad'];
								break;
							case 'Primaria-tarde':
								$listaConsulta2["Primaria (Tarde)"]=$res[$i]['cantidad'];
								break;
							case 'Primaria-noche':
								$listaConsulta2["Primaria (Noche)"]=$res[$i]['cantidad'];
								break;
							case 'Secundaria-manana':
								$listaConsulta2["Secundaria (Mañana)"]=$res[$i]['cantidad'];
								break;
							case 'Secundaria-tarde':
								$listaConsulta2["Secundaria (Tarde)"]=$res[$i]['cantidad'];
								break;
							case 'Secundaria-noche':
								$listaConsulta2["Secundaria (Noche)"]=$res[$i]['cantidad'];
								break;
							case 'Técnico-manana':
								$listaConsulta2["Técnico (Mañana)"]=$res[$i]['cantidad'];
								break;
							case 'Técnico-tarde':
								$listaConsulta2["Técnico (Tarde)"]=$res[$i]['cantidad'];
								break;
							case 'Técnico-noche':
								$listaConsulta2["Técnico (Noche)"]=$res[$i]['cantidad'];
								break;
						}
						$sum2=$sum2+$res[$i]['cantidad'];
					}
					$res=$model->consulta3($fini,$ffin);
					$sum3=0;
					for($i=0;$i<sizeof($res);$i++) {
						switch ($res[$i]['tipo_usuario_biblioteca']) {
							case 'Beneficiario':
								$listaConsulta3["Beneficiario"]=$res[$i]['cantidad'];
								break;
							case 'beneficiario':
								$listaConsulta3["Beneficiario"]=$res[$i]['cantidad'];
								break;
							case 'comunidad':
								$listaConsulta3["Comunidad"]=$res[$i]['cantidad'];
								break;
							case 'educador_funcionario':
								$listaConsulta3["Educador/funcionario"]=$res[$i]['cantidad'];
								break;
							case 'entorno_familiar':
								$listaConsulta3["Entorno Familiar"]=$res[$i]['cantidad'];
								break;
							case 'otros':
								$listaConsulta3["Otros"]=$res[$i]['cantidad'];
								break;
						}
						$sum3=$sum3+$res[$i]['cantidad'];
					}
					$res=$model->consulta4($fini,$ffin);
					$sum4=0;
					for($i=0;$i<sizeof($res);$i++) {
						$nom=$res[$i]['nombre_area_conocimiento_biblioteca'];
						$listaConsulta4[ucfirst($nom)]=$res[$i]['cantidad'];
						$sum4=$sum4+$res[$i]['cantidad'];
					}
					#$ffin='2014-06-01';
					$mPDF1->WriteHTML($controller->renderPartial('pdf1',array('model'=>$model,'fini'=>$fini,'ffin'=>$ffin,'sum1'=>$sum1,'sum2'=>$sum2,'sum3'=>$sum3,'sum4'=>$sum4,'listaConsulta1'=>$listaConsulta1,'listaConsulta2'=>$listaConsulta2,'listaConsulta3'=>$listaConsulta3,'listaConsulta4'=>$listaConsulta4,'cien'=>$cien),true));
					
$mPDF1->Output('REP1.PDF','D');
exit;
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
			$controller->renderParTial('error',array('model'=>$respuesta,'callback'=>""));
		}
	}
}