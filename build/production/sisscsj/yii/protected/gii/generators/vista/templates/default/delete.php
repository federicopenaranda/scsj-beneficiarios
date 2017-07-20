<?php
/**
* nombre de la tabla <?php echo $tableName; ?>
*  nombre del Modelo <?php echo $modelClass; ?>
* nombre de la columnas 
* nombre de la acciont <?php echo $action; ?>
*/
?>
<?php echo "<?php\n"; ?>
/**
* Esta es la vista para mostrar los datos
*/
if ($callback) {
    echo $callback . '(' . CJSON::encode($model) . ');';
} else {
	echo CJSON::encode($model);
}
?>
	




