<?php

class ModelExtCode extends CCodeModel
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
            'modelExt.php',
            'store.php',
            'controllerExt.php',
            'viewsExt.php',
		);
	}

    public function prepare()
    {
        //$path=Yii::getPathOfAlias('application.modelExt.'.$this->nomodel.'.php';
        $path=Yii::getPathOfAlias('application.modelExt.' . $this->nomodel) . '.js';
        $code=$this->render($this->templatepath.'/modelExt.php');
        $this->files[]=new CCodeFile($path, $code);
        $path=Yii::getPathOfAlias('application.store.' . $this->nomodel) . '.js';
        $code=$this->render($this->templatepath.'/store.php');
        $this->files[]=new CCodeFile($path, $code);
        $path=Yii::getPathOfAlias('application.controllerExt.' . $this->nomodel) . '.js';
        $code=$this->render($this->templatepath.'/controllerExt.php');
        $this->files[]=new CCodeFile($path, $code);
        $path=Yii::getPathOfAlias('application.viewsExt.'.$this->nomodel.'.' .'Lista') . '.js';
        $code=$this->render($this->templatepath.'/viewsExt.php');
        $this->files[]=new CCodeFile($path, $code);
    }

}
