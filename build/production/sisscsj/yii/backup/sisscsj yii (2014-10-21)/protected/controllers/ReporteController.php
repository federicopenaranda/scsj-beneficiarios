<?php
/**
* Esta es la clase controlador que hereda de Controller
*/
class ReporteController extends Controller{
	public function actions(){
		return array(
				'create'=>'application.controllers.AreaActividad.Create',
				'index'=>'application.controllers.AreaActividad.Read',
				'update'=>'application.controllers.AreaActividad.Update',
				'reporte1'=>'application.controllers.Reporte.Reporte1',
				'reporte2'=>'application.controllers.Reporte.Reporte2',
				'reporte3'=>'application.controllers.Reporte.Reporte3',
				'reporte5'=>'application.controllers.Reporte.Reporte5',
				'reporteEx1'=>'application.controllers.Reporte.ReporteEx1',
		);
	}
}