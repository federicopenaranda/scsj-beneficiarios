<?php
/**
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 * - <?php echo $tableName; ?>
 * - <?php echo $modelClass; ?>
 *<?php foreach($labels as $name=>$label): ?>
			<?php echo "'$name' => '$label',\n"; ?>
<?php endforeach; ?>
 
 */
?>
<?php #echo print_r($columns);?>
<?php 
$contPrimaryKey=0;
foreach($columns as $column):
if($column->isPrimaryKey==1)
	$contPrimaryKey++; 
endforeach; 
?>
<?php $path=str_replace("C:/xampp/htdocs/","",Yii::getPathOfAlias('webroot'));?>
Ext.define('<?php echo $path;?>.store.<?php  echo strtolower($modelClass);?>.<?php echo $modelClass; ?>', {
    extend: '<?php echo $path;?>.store.Base',
    alias: 'store.<?php  echo strtolower($modelClass);?>.<?php  echo strtolower($modelClass);?>',
    requires: [
        '<?php echo $path;?>.model.<?php  echo strtolower($modelClass);?>.<?php echo $modelClass; ?>'
    ],
    restPath: '<?php echo $modelClass; ?>',
    storeId: '<?php echo $modelClass; ?>',
    model: '<?php echo $path;?>.model.<?php  echo strtolower($modelClass);?>.<?php echo $modelClass; ?>'
});






   
