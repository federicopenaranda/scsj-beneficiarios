<?php echo '<?php'; ?>

/**
* Esta clase es llamado por su controlador repectivo y en aqui se definen todas las acciones del controlador
* Es una clase que hereda sus propiedades y metodos de CAction
*/ 
class ExcelReporte extends CAction
{
/**
* La funcion run ejecuta la logica de la accion
* Su funcion es la de eliminar un registro de una tabla en la base de datos
* @param array $callback se introduce el nombre de una funcion
*/
    public function run(){
    	$controller=$this->getController();
		$objPHPExcel = new PHPExcel();
        $controller=$this->getController();
        $model=ActividadFavorita::model()->findAll();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("K'iin Balam")
             ->setLastModifiedBy("K'iin Balam")
             ->setTitle("YiiExcel Test Document")
             ->setSubject("YiiExcel Test Document")
             ->setDescription("Test document for YiiExcel, generated using PHP classes.")
             ->setKeywords("office PHPExcel php YiiExcel UPNFM")
             ->setCategory("Test result file");        
        
        // Add some data
             $objDrawing=new PHPExcel_Worksheet_Drawing();
             $objDrawing->setPath('./images/logo.png');
             $objDrawing->setCoordinates('B1');
             $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true) ; 
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true) ; 
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:G6')
            ->setCellValue('A7', 'ID')
            ->setCellValue('B7', 'NOMBRE ACTIVIDAD');
        
        // Miscellaneous glyphs, UTF-8
            $i=8;
            foreach ($model as $row) {
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $row->id_actividad_favorita)
                ->setCellValue('B'.$i, $row->nombre_actividad_favorita);
                $i++;
            }
             $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A11','VALOR 1')
                ->setCellValue('B11','VALOR 2')
                ->setCellValue('C11','MAXIMO')
                ->setCellValue('D11','MINIMO')
                ->setCellValue('E11','PROMEDIO')
                ->setCellValue('F11','SUMA')
                ->setCellValue('G11','COSENO')
                ->setCellValue('A12','5')
                ->setCellValue('B12','8')
                ->setCellValue('C12','=MAX(A12:B12)')
                ->setCellValue('D12','=MIN(A12:B12)')
                ->setCellValue('E12','=AVERAGE(A12:B12)')
                ->setCellValue('F12','=SUM(A12:B12)')
                 ->setCellValue('G12','=COS(A12)');
            $styleArray=array(
                'borders' => array(
                    'allborders'=>array(
                        'style' =>PHPExcel_Style_Border::BORDER_THIN,
                        'color'=>array('argb'=>'FFE4B5'),
                    )
                ),
                'font'=>array(
                    'bold'=>true,
                    'color'=>array('rgb'=>'58ACFA'),
                    'size'=>10,
                    'name'=>'Verdana'
                ),
                /*'fill'=>array(
                    'type'=>PHPExcel_Style_Fill::FILL_SOLID,
                    'color'=>array('rgb'=>'FF0000')
                )*/
             );
            $objPHPExcel->getActiveSheet()->getStyle('A7:G12')->applyFromArray($styleArray);
            unset($styleArray);
            $styleArray2=array(
                'fill'=>array(
                    'type'=>PHPExcel_Style_Fill::FILL_SOLID,
                    'color'=>array('rgb'=>'E6E6E6')
                )
             );

           for ($i=8; $i <=13 ; $i++) { 
                if($i%2==0) 
                    $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':G'.$i)->applyFromArray($styleArray2);
                $i++;                      
            }
           //******************++
          /* function cellColor($cells,$color){
                global $objPHPExcel;
                $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()
                ->applyFromArray(array('type'=>PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor'=>array('rgb'=$color)
                ));
           }
           cellColor('A8:F8','F28A8C');*/
        
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('YiiExcel');
        
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        
        // Save a xls file
        $filename = 'YiiExcel';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        header('Cache-Control: max-age=0');
        
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        $objWriter->save('php://output');
        unset($this->objWriter);
        unset($this->objWorksheet);
        unset($this->objReader);
        unset($this->objPHPExcel);
        exit();			
	}
}