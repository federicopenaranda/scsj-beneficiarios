<?php

class AccionesEspecialesCode extends CCodeModel
{
	public $className;
    public $classRuta;
    public $nomodel;
 
    public function rules()
    {
        return array_merge(parent::rules(), array(
            array('classRuta nomodel', 'required'),
            array('classRuta', 'match', 'pattern'=>'/^\w+$/'),
        ));
    }
 
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), array(
            //'className'=>'Nombre de la accion',
            'nomodel'=>'Nombre del modelo',
            'classRuta'=>'Ruta de la accion',
        ));
    }
	public function requiredTemplates()
	{
		return array(
			'pdfReporte.php',
			'excelReporte.php',
            'login.php',
            'logout.php',
		);
	}

    public function prepare()
    {
        $path=Yii::getPathOfAlias('application.controllers.'.$this->classRuta.'.' . "PdfReporte") . '.php';
        //$path=Yii::getPathOfAlias('application.components.' . $this->className) . '.php';
        $code=$this->render($this->templatepath.'/pdfReporte.php');
        $this->files[]=new CCodeFile($path, $code);
		$path=Yii::getPathOfAlias('application.controllers.'.$this->classRuta.'.' ."ExcelReporte"). '.php';
		$code=$this->render($this->templatepath.'/excelReporte.php');
		$this->files[]=new CCodeFile($path, $code);
        $path=Yii::getPathOfAlias('application.controllers.'.$this->classRuta.'.' ."Login"). '.php';
        $code=$this->render($this->templatepath.'/login.php');
        $this->files[]=new CCodeFile($path, $code);
        $path=Yii::getPathOfAlias('application.controllers.'.$this->classRuta.'.' ."Logout"). '.php';
        $code=$this->render($this->templatepath.'/logout.php');
        $this->files[]=new CCodeFile($path, $code);
        
    }

}
