<?php

class AccionesCode extends CCodeModel
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
			'create.php',
			'read.php',
			'update.php',
			'delete.php',
		);
	}

    public function prepare()
    {
        $path=Yii::getPathOfAlias('application.controllers.'.$this->classRuta.'.' . "Create") . '.php';
        //$path=Yii::getPathOfAlias('application.components.' . $this->className) . '.php';
        $code=$this->render($this->templatepath.'/create.php');
        $this->files[]=new CCodeFile($path, $code);
		//yo
		$path=Yii::getPathOfAlias('application.controllers.'.$this->classRuta.'.' ."Read"). '.php';
		$code=$this->render($this->templatepath.'/read.php');
		$this->files[]=new CCodeFile($path, $code);
		$path=Yii::getPathOfAlias('application.controllers.'.$this->classRuta.'.' ."Update"). '.php';
		$code=$this->render($this->templatepath.'/update.php');
		$this->files[]=new CCodeFile($path, $code);
		$path=Yii::getPathOfAlias('application.controllers.'.$this->classRuta.'.' ."Delete"). '.php';
		$code=$this->render($this->templatepath.'/delete.php');
		$this->files[]=new CCodeFile($path, $code);
        
    }

}
