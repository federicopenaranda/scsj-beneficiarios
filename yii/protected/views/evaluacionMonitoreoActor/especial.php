<?php
/**
* Esta es la vista para mostrar los datos
*/
if ($callback) {
	echo $callback . '(' . str_replace (['"{{','}}"',"\\"],["","",""], json_encode ($model)) . ');';
	#echo $callback . '(' . str_replace (['"{','"}'],["",""], json_encode ($model)) . ');';
    #echo $callback . '(' . str_replace ('"{',"", json_encode ($model)) . ');';
	#echo $callback . '(' . str_replace (['"\'','\'"'],["'","'"], json_encode ($model)) . ');';
} else {
	echo str_replace ('"', "'", json_encode ($model));
}
?>
	




