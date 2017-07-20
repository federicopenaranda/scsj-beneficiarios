<?php

/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedad y metodos de la clase padre CAtion
*/ 
class Reporte2 extends CAction
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
		$model=new Beneficiario();
		$mPDF1=Yii::app()->ePdf->mpdf();
		//$mPDF1->SetHTMLHeaderByName('Content-Disposition: attachment;filename="REP1.PDF"');
		$error="";
		$listaConsulta1=array();
		$listaConsulta2=array();
		$listaConsulta3=array();
		$listaConsulta4=array();
		if ($_GET['id']){
			$id=$_GET['id'];
			$cont=0;
			$res=$model->consulta1_de_rep2($id);
			for($i=0;$i<sizeOf($res);$i++){
				echo "HOLA";
			}
			echo "hola";
			$mPDF1->WriteHTML($controller->renderPartial('pdf2',array('mode'=>'HOLA'),true));	
			$mPDF1->Output();
			//exit;
		}else{
			$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos");
			$controller->renderParTial('error',array('model'=>$respuesta,'callback'=>""));
		}
	}
}