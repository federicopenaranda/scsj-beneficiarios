<?php
/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedad y metodos de la clase padre CAtion
*/ 
class ReporteEx1 extends CAction
{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de crear un nuevo registro y adicionarlo en una tabla
* @param array $callback se introduce el nombre de una funcion
*/
   public function run(){
    	$controller=$this->getController();
		$phpExcel = new PHPExcel();
		$model=new Biblioteca();
		$fini=$_GET['start'];
		$ffin=$_GET['limit'];
        //area de diseño de excel
        $styleArray=array(
                'borders' => array(
                    'allborders'=>array(
                        'style' =>PHPExcel_Style_Border::BORDER_THIN,
                        'color'=>array('argb'=>'000000'),
                    )
                ),
              );
        $listaConsulta1=array();
        $listaConsulta2=array();
        $listaConsulta3=array();
        $listaConsulta4=array();
		//inicio*******************************************************
        $sum1=0;
        $res=$model->consulta1($fini,$ffin);
		for ($i=0;$i<sizeof($res);$i++) {
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
		$phpExcel->getActiveSheet()->getTitle("My Sheet");
		$phpExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
		$phpExcel->getActiveSheet(0);
		$phpExcel->setActiveSheetIndex(0)
            ->mergeCells('B2:D2')
            ->setCellValue('B2', 'Consultas Bibliográficas(Por Género)');
        $pos=3;
        $i=0;
        foreach ($listaConsulta1 as $key => $value) {
            if($sum1!==0){
                $phpExcel->setActiveSheetIndex(0)
                    ->setCellValue('B'.$pos, $key)
                    ->setCellValue('C'.$pos,'='.$res[$i]['cantidad'])
                    ->setCellValue('D'.$pos,'='.($res[$i]['cantidad']/$sum1));
            }else{
                $phpExcel->setActiveSheetIndex(0)
                    ->setCellValue('B'.$pos, $key)
                    ->setCellValue('C'.$pos,'='.$res[$i]['cantidad'])
                    ->setCellValue('D'.$pos,'='.'0');
            }
            $pos++;
            $i++;
        }
        if($sum1!==0) {
            $phpExcel->setActiveSheetIndex(0)
                ->setCellValue('B'.$pos, 'Consultas Bibliograficas(Total)')
                ->setCellValue('C'.$pos, $sum1)
                ->setCellValue('D'.$pos, '='.$sum1/$sum1);
        }else{
            $phpExcel->setActiveSheetIndex(0)
                ->setCellValue('B'.$pos, 'Consultas Bibliograficas(Total)')
                ->setCellValue('C'.$pos, $sum1)
                ->setCellValue('D'.$pos, '='.'0');
        }
        $phpExcel->getActiveSheet()->getStyle('B2:D'.$pos)->applyFromArray($styleArray);
        //*****************************************************
        $sum2=0;
        $res=$model->consulta2($fini,$ffin);
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
        $pos=$pos+3;
        $posi=$pos;
        $phpExcel->setActiveSheetIndex(0)
            ->mergeCells('B'.$pos.':D'.$pos)
            ->setCellValue('B'.$pos, 'Consultas Bibliográficas(Por Género)');
        
        $i=0;
        $pos++;
        foreach ($listaConsulta2 as $key => $value) {
            if($sum2!==0){
                $phpExcel->setActiveSheetIndex(0)
                    ->setCellValue('B'.$pos, $key)
                    ->setCellValue('C'.$pos,'='.$res[$i]['cantidad'])
                    ->setCellValue('D'.$pos,'='.($res[$i]['cantidad']/$sum2));
            }else{
                $phpExcel->setActiveSheetIndex(0)
                    ->setCellValue('B'.$pos, $key)
                    ->setCellValue('C'.$pos,'='.$res[$i]['cantidad'])
                    ->setCellValue('D'.$pos,'='.'0');
            }
            $pos++;
            $i++;
        }
         if($sum2!==0){
            $phpExcel->setActiveSheetIndex(0)
                ->setCellValue('B'.$pos, 'Consultas Bibliograficas(Total)')
                ->setCellValue('C'.$pos, $sum2)
                ->setCellValue('D'.$pos, '='.$sum2/$sum2);
        }else{
            $phpExcel->setActiveSheetIndex(0)
                ->setCellValue('B'.$pos, 'Consultas Bibliograficas(Total)')
                ->setCellValue('C'.$pos, $sum2)
                ->setCellValue('D'.$pos, '='.'0');
        }
        $phpExcel->getActiveSheet()->getStyle('B'.$posi.':D'.$pos)->applyFromArray($styleArray);
        //*****************************************************
        $sum3=0;
        $res=$model->consulta3($fini,$ffin);
        for ($i=0;$i<sizeof($res);$i++) {
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
        //$pos=15;
        $pos=$pos+3;
        $posi=$pos;
        $phpExcel->setActiveSheetIndex(0)
            ->mergeCells('B'.$pos.':D'.$pos)
            ->setCellValue('B'.$pos, 'Consultas Bibliográficas(Por Género)');
        
        $i=0;
        $pos++;
        foreach ($listaConsulta3 as $key => $value) {
            if($sum3!==0){
                $phpExcel->setActiveSheetIndex(0)
                    ->setCellValue('B'.$pos, $key)
                    ->setCellValue('C'.$pos,'='.$res[$i]['cantidad'])
                    ->setCellValue('D'.$pos,'='.($res[$i]['cantidad']/$sum3));
            } else {
                 $phpExcel->setActiveSheetIndex(0)
                    ->setCellValue('B'.$pos, $key)
                    ->setCellValue('C'.$pos,'='.$res[$i]['cantidad'])
                    ->setCellValue('D'.$pos,'='.'0');
            }
            $pos++;
            $i++;
        }
        if($sum3!==0){
            $phpExcel->setActiveSheetIndex(0)
                ->setCellValue('B'.$pos, 'Consultas Bibliograficas(Total)')
                ->setCellValue('C'.$pos, $sum3)
                ->setCellValue('D'.$pos, '='.$sum3/$sum3);
        } else {
            $phpExcel->setActiveSheetIndex(0)
                ->setCellValue('B'.$pos, 'Consultas Bibliograficas(Total)')
                ->setCellValue('C'.$pos, $sum3)
                ->setCellValue('D'.$pos, '='.'0');
        }
        $phpExcel->getActiveSheet()->getStyle('B'.$posi.':D'.$pos)->applyFromArray($styleArray);
        //*****************************************************
       //*****************************************************
        $sum4=0;
        $res=$model->consulta4($fini,$ffin);
        for ($i=0;$i<sizeof($res);$i++) {
            $nom=$res[$i]['nombre_area_conocimiento_biblioteca'];
            $listaConsulta4[ucfirst($nom)]=$res[$i]['cantidad'];
            $sum4=$sum4+$res[$i]['cantidad'];
        }
        //$pos=15;
        $pos=$pos+3;
        $posi=$pos;
        $phpExcel->setActiveSheetIndex(0)
            ->mergeCells('B'.$pos.':D'.$pos)
            ->setCellValue('B'.$pos, 'Consultas Bibliográficas(Por Género)');
        
        $i=0;
        $pos++;
        foreach ($listaConsulta4 as $key => $value) {
            if($sum4!==0){
                $phpExcel->setActiveSheetIndex(0)
                    ->setCellValue('B'.$pos, $key)
                    ->setCellValue('C'.$pos,'='.$res[$i]['cantidad'])
                    ->setCellValue('D'.$pos,'='.($res[$i]['cantidad']/$sum4));
            } else {
                $phpExcel->setActiveSheetIndex(0)
                    ->setCellValue('B'.$pos, $key)
                    ->setCellValue('C'.$pos,'='.$res[$i]['cantidad'])
                    ->setCellValue('D'.$pos,'='.'0');
            }
            $pos++;
            $i++;
        }
        if($sum4!==0){
            $phpExcel->setActiveSheetIndex(0)
                ->setCellValue('B'.$pos, 'Consultas Bibliograficas(Total)')
                ->setCellValue('C'.$pos, $sum4)
                ->setCellValue('D'.$pos, '='.$sum4/$sum4);
        }else{
             $phpExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$pos, 'Consultas Bibliograficas(Total)')
            ->setCellValue('C'.$pos, $sum4)
            ->setCellValue('D'.$pos, '='.'0');
        }
        $phpExcel->getActiveSheet()->getStyle('B'.$posi.':D'.$pos)->applyFromArray($styleArray);
        //*****************************************************



      	$filename = 'YiiExcel';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel5');
        $objWriter->save('php://output');
        exit();
	}
}