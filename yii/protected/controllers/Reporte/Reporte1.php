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
		$error="";
		$listaConsulta1=array();
		$listaConsulta2=array();
		$listaConsulta3=array();
		$listaConsulta4=array();
		if (/*$_GET['start'] && $_GET['limit'] && */isset($_GET['start']) && !is_numeric($_GET['start']) && isset($_GET['limit']) && !is_numeric($_GET['limit'])) {
			/**
			* Consultas Bibliograficas(Por Género) OK!
			*/
			$fini=$_GET['start'];
			$ffin=$_GET['limit'];
			$res=$model->consulta1_1_de_rep1($fini,$ffin);
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
				/**
				* Consultas Bibliograficas por(Nivel) OK!
				*/
				$listaConsulta2=$model->consulta2_1_de_rep1($fini,$ffin);
				$sum2=0;
				for ($i=0;$i<sizeof($listaConsulta2);$i++) {
					$sum2=$sum2+$res[$i]['cantidad'];
				}
				/**
				* Consultas Bibliograficas (Por Tipo de Usuario) OK!
				*/
				$res=$model->consulta3_1_de_rep1($fini,$ffin);
				$sum3=0;
				for($i=0;$i<sizeof($res);$i++) {
					switch ($res[$i]['tipo_usuario_biblioteca']) {
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
				/**
				* Consultas Bibliograficas (Por Area) OK!
				*/
				$res=$model->consulta4_1_de_rep1($fini,$ffin);
				$sum4=0;
				for($i=0;$i<sizeof($res);$i++) {
					$nom=$res[$i]['nombre_area_conocimiento_biblioteca'];
					$listaConsulta4[ucfirst($nom)]=$res[$i]['cantidad'];
					$sum4=$sum4+$res[$i]['cantidad'];
				}
				$mPDF1->WriteHTML($controller->renderPartial('pdf1',array('model'=>$model,'fini'=>$fini,'ffin'=>$ffin,'sum1'=>$sum1,'sum2'=>$sum2,'sum3'=>$sum3,'sum4'=>$sum4,'listaConsulta1'=>$listaConsulta1,'listaConsulta2'=>$listaConsulta2,'listaConsulta3'=>$listaConsulta3,'listaConsulta4'=>$listaConsulta4),true));
#$mPDF1->Output();				
$mPDF1->Output('REP1.PDF','D');
exit;
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Parametros invalidos, introduzca el rango de fecha");
			$controller->renderParTial('error',array('model'=>$respuesta,'callback'=>""));
		}
	}
}