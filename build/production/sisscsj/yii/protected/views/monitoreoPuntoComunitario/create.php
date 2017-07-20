<?php
/**
* Esta es la vista para mostrar los datos
*/
if ($callback) {
    echo $callback . '(' . CJSON::encode($model) . ');';
} else {
	echo CJSON::encode($model);
}
?>
	




