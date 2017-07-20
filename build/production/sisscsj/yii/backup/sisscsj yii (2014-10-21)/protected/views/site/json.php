<?php
if ($callback){
	//header('Content-Type: text/javascript');
    echo $callback . '(' . CJSON::encode($model) . ');';
}else{
        //header('Content-Type: application/x-json');
      echo CJSON::encode($model);
}
?>