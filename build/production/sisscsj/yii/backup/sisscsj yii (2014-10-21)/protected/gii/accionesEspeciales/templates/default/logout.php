<?php echo '<?php'; ?>
 
class Logout extends CAction
{
   public function run($callback=null){
   		$controller=$this->getController();
		Yii::app()->user->logout();
		//$controller->redirect(Yii::app()->);
		$controller->renderParTial('index',array('model'=>array('deslogeado'),'callback'=>$callback));
	}
		
}