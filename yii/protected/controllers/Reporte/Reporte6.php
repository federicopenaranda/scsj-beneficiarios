<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedad y metodos de la clase padre CAtion
*/ 
class reporte6 extends CAction
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
		$model = new MonitoreoPuntoComunitario();
		$mPDF1 = Yii::app()->ePdf->mpdf();
		if(isset($_GET['id_monitoreo_punto_comunitario'])){
			$res11=$model->consulta11_de_rep6($_GET['id_monitoreo_punto_comunitario']);
			$r=$res11[0]['usuario_responsable'];
			if ($r == NULL || $r == "")
				$r=0;  
			$res12=$model->consulta12_de_rep6($r);
			$mPDF1->SetHTMLHeader($header);
			$mPDF1->WriteHTML($controller->renderPartial('pdf6',array('res11'=>$res11,'res12'=>$res12),true));
			$mPDF1->Output('REP6.PDF','D');
			#$mPDF1->Output();
		} else{
			$respuesta->meta=array("success"=>"false","msg"=>"variable indefinida id_monitoreo_punto_comunitario");
			return $this->controller->renderPartial('error',['model'=>$respuesta,'callback'=>$_GET['callback']]);
		}
			
	}
}