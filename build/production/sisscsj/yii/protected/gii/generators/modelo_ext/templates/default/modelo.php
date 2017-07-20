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
<?php if($contPrimaryKey==1):?>
Ext.define('<?php echo $path;?>.model.opciones.<?php echo $modelClass; ?>', {
    extend: '<?php echo $path;?>.model.Base'
<?php foreach($columns as $column): 
  if($column->isPrimaryKey==1)
$id_llave_primaria=$column->name;
endforeach; ?>
	idProperty: '<?php echo $id_llave_primaria;?>',
	fields: [
<?php $cont=0;foreach($columns as $column):?>
<?php $cont++;if($cont!==sizeof($columns)) {?>
		{
			name: '<?php echo $column->name;?>',
            type: '<?php if($column->dbType=="date") echo "date"; else if($column->type=="integer") echo "int";else echo $column->type;?>',
            useNull:<?php if( $column->allowNull==1)echo "true \n";else echo "false \n";?>
		},
<?php } else {?>
		{
			name: '<?php echo $column->name;?>',
            type: '<?php if($column->dbType=="date") echo "date"; else if($column->type=="integer") echo "int";else echo $column->type;?>',
            useNull:<?php if( $column->allowNull==1)echo "true \n";else echo "false \n";?>
		}
<?php } ?>
<?php endforeach;?>
	]
});
<?php endif;?>

<?php #relacion de muchos a muchos?>
<?php if($contPrimaryKey >= 2):?>
Ext.define('<?php echo $path;?>.model.opciones.<?php echo $modelClass; ?>', {
    extend: '<?php echo $path;?>.model.Base'
    idProperty: 'id_<?php echo strtolower($modelClass); ?>',
	fields: [
		{
			name: 'id_<?php echo strtolower($modelClass); ?>',
            type: 'int',
            useNull:true
		},
<?php $cont=0;foreach($columns as $column):?>
<?php $cont++;if($cont!==sizeof($columns)) {?>
		{
			name: '<?php echo $column->name;?>',
            type: '<?php if($column->dbType=="date") echo "date"; else if($column->type=="integer") echo "int";else echo $column->type;?>',
            useNull:<?php if( $column->allowNull==1)echo "true \n";else echo "false \n";?>
		},
<?php } else {?>
		{
			name: '<?php echo $column->name;?>',
            type: '<?php if($column->dbType=="date") echo "date"; else if($column->type=="integer") echo "int";else echo $column->type;?>',
            useNull:<?php if( $column->allowNull==1)echo "true \n";else echo "false \n";?>
		}
<?php } ?>
<?php endforeach;?>
	]
});
<?php endif;?>