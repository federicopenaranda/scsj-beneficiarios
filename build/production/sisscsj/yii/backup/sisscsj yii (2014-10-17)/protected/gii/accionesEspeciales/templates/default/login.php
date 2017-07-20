<?php echo '<?php'; ?>

class Login extends CAction
{
   public function run($callback=null){
   		$controller=$this->getController();
		#$model=new Usuario();
   		if(isset($_GET['login_usuario']) && isset($_GET['password_usuario'])){
   			$username=$_GET['login_usuario'];
   			$password=$_GET['password_usuario'];
			$identity=new UserIdentity($username,$password);
			$identity->authenticate();	
			if($identity->errorCode===UserIdentity::ERROR_NONE){
				//$duration=$this->rememberMe ? 3600*24*30:0
				Yii::app()->user->login($identity);
				//$controller->redirect(Yii::app()->homeUrl);
				$controller->renderParTial('index',array('model'=>array('logueado'),'callback'=>$callback));
			}
			else{
				$controller->renderParTial('index',array('model'=>array('sin acceso'),'callback'=>$callback));
			}
		}else{
			$controller->renderParTial('index',array('model'=>array('parametros indefinidos'),'callback'=>$callback));
		}
	}
		
}