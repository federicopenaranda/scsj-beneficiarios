<?php
if ($callback){
    echo $callback . '(' . CJSON::encode($model) . ');';
}else{
	echo CJSON::encode($model);
}
?>