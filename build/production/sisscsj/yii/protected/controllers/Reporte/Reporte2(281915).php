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
		$error="";
		$listaConsulta1=array();
		$listaConsulta2=array();
		$listaConsulta3=array();
		$listaConsulta4=array();
		if ($_GET['id'] && isset($_GET['id'])) {
			$id=$_GET['id'];
			$res11=$model->consulta1_1_de_rep2($id);
			$nom=$res11[0]['fotografia_beneficiario'];
			$res12=$model->consulta1_2_de_rep2($id);
			#$res13=$model->consulta1_3_de_rep2($id);
			$res14=$model->consulta1_4_de_rep2($id);
			$res15=$model->consulta1_5_de_rep2($id);
			$res16=$model->consulta1_6_de_rep2($id);
			$res17=$model->consulta1_7_de_rep2($id);
			$res18=$model->consulta1_8_de_rep2($id);
			$res19=$model->consulta1_9_de_rep2($id);
			$res110=$model->consulta1_10_de_rep2($id);
			$res21=$model->consulta2_1_de_rep2($id);
			$res3=$model->consulta3_de_rep2($id);
			$res31=$model->subconsulta1_de_rep3($id);
			$header='<img src="'.'images/logo2.png"/>';
			$mPDF1->SetHTMLHeader($header);
			$mPDF1->WriteHTML($controller->renderPartial('pdf2',array('res11'=>$res11,'res12'=>$res12,'res14'=>$res14,'res15'=>$res15,'res16'=>$res16,'res17'=>$res17,'res18'=>$res18,'res19'=>$res19,'res110'=>$res110,'res21'=>$res21,'res3'=>$res3,'res31'=>$res31),true));
			$mPDF1->Output();
			#$mPDF1->Output('REP2.PDF','D');
		} else {
			$respuesta->meta=array("success"=>"false","msg"=>"Campos invalidos {id}");
			$controller->renderPartial('error',array('model'=>$respuesta,'callback'=>""));
		}
	}
}