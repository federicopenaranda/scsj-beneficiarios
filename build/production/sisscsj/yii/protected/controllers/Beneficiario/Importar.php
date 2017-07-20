<?php
/**
 * Estas son la accion para el controlador "Beneficiario".
 */

class Importar extends CAction
{
    /**
    * La funcion run ejecuta la logica de la accion
    * Su funcion es la de crear un nuevo registro y adicionarlo en una tabla
    * @param array $callback se introduce el nombre de una funcion
    */
	public function run()
	{
		$controller=$this->getController();
		$respuesta= new stdClass();
		$model = new Beneficiario();
		$callback=$_GET['callback'];
		$file = CUploadedFile::getInstance($model,'fotografia_beneficiario');
		
		if(isset($_POST['Beneficiario'])) {
		#if(!is_null($file)){
			
			$error = "";
			$archivo = $file->getName();
			#$tmp = $file->tempName;
			$tmp = Yii::getPathOfAlias('webroot')."/images";
			echo $tmp;
			
			
			try {
				if(@copy($tmp,$archivo)){
					echo "Archivo Copiado";
				} else {
					echo "Archivo No copiado";
				}
				if(file_exists($archivo)){
					
					$objReader= new PHPExcel_Reader_Excel2007();
					$objPHPExcel = $objReader->load($archivo);
					$objFecha= new PHPExcel_Shared_Date();
					$objPHPExcel->setActiveSheetIndex(0);
					for($i=8;$i<=9;$i++) {
						$_DATOS_EXCEL[$i]['curso'] = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
					}
					foreach($_DATOS_EXCEL as $campo => $valor){
						$subModel=new Curso();
						$subModel->nombre_curso = $valor['curso'];
						if($subModel->validate()){
							$subModel->save();
						} else{
							$error=$obj->getErrors();
						}
					}
				} else {
					$error = "No existe el Archivo";
				}
			} catch(Exception $e) {
				$error=$e->getMessage();
			}
			
			if($error == "") {
				$respuesta->meta=array("success"=>"true", "msg"=>"Datos Importados!!!");
				$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
			} else {
				$respuesta->meta=array("success"=>"false", "msg"=>$error);
				$controller->renderPartial('create',array('model'=>$respuesta,'callback'=>$callback));
			}
		} else {
			$controller->render('importar', array('model'=>$model));
			#$respuesta->meta=array("success"=>"false","msg"=>"El archivo no fue instanciado");
			#$controller->renderParTial('create',array('model'=>$respuesta,'callback'=>$callback));
		}
	}
}

