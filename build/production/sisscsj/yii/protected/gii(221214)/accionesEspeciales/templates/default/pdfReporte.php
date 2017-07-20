<?php echo '<?php'; ?>

/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedades y metodos de CAction
*/ 
class PdfReporte extends CAction
{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de eliminar un registro de una tabla en la base de datos
* @param array $callback se introduce el nombre de una funcion
*/
    public function run(){
		$controller=$this->getController();
		$model=ActividadFavorita::model()->findAll();
		$mPDF1=Yii::app()->ePdf->mpdf();
		$mPDF1->useOnlyCoreFonts=true;
		$mPDF1->setTitle("Reportes en mPDF");
		$mPDF1->setAuthor("victor");
		$mPDF1->SetwatermarkText("Catequil Soluciones");
		$mPDF1->showWatermarkText=true;
		$mPDF1->watermark_font='DejaVuSansCondensed';
		//$error=$mPDF1->showImageErrors=true;
		$mPDF1->setDisplayMode('fullpage');
		//$mPDF1->Image(Yii::app()->baseUrl.'/images/logo.png',0,0,210,297,'png;base64','',true,true);
		
		$mPDF1->WriteHTML($controller->renderPartial('PdfReporte',array('model'=>$model),true));
		$mPDF1->Output();
		//$mPDF1->Output('Reporte_ActividadFavorita'.date('YmdHis'),'I');
		exit();
		/*$mPDF1->WriteHtml("<table border=1 bordercolor='silver' align='center'>");
		$mPDF1->WriteHtml("<tr>");
		$mPDF1->WriteHtml("<td font color='red'>id</td>");
		$mPDF1->WriteHtml("<td font color='red'>Nombre</td>");
		$mPDF1->WriteHtml("</tr>");
		foreach ($model as $actividad) {
			$mPDF1->WriteHtml("<tr>".$actividad->id_actividad_favorita);
			$mPDF1->WriteHtml("<td>".$actividad->id_actividad_favorita."</td>");
			$mPDF1->WriteHtml("<td>".$actividad->nombre_actividad_favorita."</td>");
			$mPDF1->WriteHtml("</td>");
		}		
		$mPDF1->WriteHtml("</table>");
		$mPDF1->Output();*/
		/*$mPDF1=Yii::app()->ePdf->mpdf();
		$mPDF1->WriteHTML("<h1>Hola mundo!!</h1>");
		$mPDF1->WriteHTML("<p>Este es mi primer PDF je je !!</p>");
		$mPDF1->Output();	*/			
	}
}