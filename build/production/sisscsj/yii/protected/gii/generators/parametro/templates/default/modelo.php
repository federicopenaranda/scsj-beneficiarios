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
 */
?>

<?php #YiiBase::getPathOfAlias('application');?>
<?php #echo  print_r($columns);?>
<?php $cont=0;$url="";foreach($columns as $column){
	$cont++;
	if($column->isPrimaryKey == ""){
		if($column->type== "string" && $column->dbType!=="datetime" &&  $column->dbType!=="date"){
			if($cont==sizeof($columns))
				$url.='"'.$column->name.'":"valor"}&callback=Ext';
			else
				$url.='"'.$column->name.'":"valor",';
		}
		if($column->type=="string" && $column->dbType =="datetime"){
			if($cont==sizeof($columns))
				$url.='"'.$column->name.'":"'.date("Y-m-d H:m:s").'"}&callback=Ext';
			else
				$url.='"'.$column->name.'":"'.date("Y-m-d H:m:s").'",';
		}
		if($column->type=="string" && $column->dbType =="date"){
			if($cont==sizeof($columns))
				$url.='"'.$column->name.'":"'.date("Y-m-d").'"}&callback=Ext';
			else
				$url.='"'.$column->name.'":"'.date("Y-m-d").'",';
		}
		if($column->type=="integer"){
			if($cont==sizeof($columns))
				$url.='"'.$column->name.'":1}&callback=Ext';
			else
				$url.='"'.$column->name.'":1,';
		}
		if($column->type=="double"){
			if($cont==sizeof($columns))
				$url.='"'.$column->name.'":25.4}&callback=Ext';
			else
				$url.='"'.$column->name.'":25,4,';
		}
		
	}
}
?>
<?php $listUrl=explode("/",Yii::getPathOfAlias("webroot"));
if(sizeof($listUrl)==5)
$link="http://localhost:8081/".$listUrl[sizeof($listUrl)-2]."/".$listUrl[sizeof($listUrl)-1]."/index.php";
if(sizeof($listUrl)==4)
$link="http://localhost:8081/".$listUrl[sizeof($listUrl)-1]."/index.php";
?>
<?php echo $link."/".$modelClass?>/create?records={<?php echo $url;?>

<?php $cont=0;$url="";foreach($columns as $column){
	$cont++;
	if($column->type== "string" && $column->dbType!=="datetime" &&  $column->dbType!=="date"){
		if($cont==sizeof($columns))
			$url.='"'.$column->name.'":"valorxx"}&callback=Ext';
		else
			$url.='"'.$column->name.'":"valorxx",';
	}
	if($column->type=="string" && $column->dbType =="datetime"){
		if($cont==sizeof($columns))
			$url.='"'.$column->name.'":"'.date("Y-m-d H:m:s").'"}&callback=Ext';
		else
			$url.='"'.$column->name.'":"'.date("Y-m-d H:m:s").'",';
	}
	if($column->type=="string" && $column->dbType =="date"){
		if($cont==sizeof($columns))
			$url.='"'.$column->name.'":"'.date("Y-m-d").'"}&callback=Ext';
		else
			$url.='"'.$column->name.'":"'.date("Y-m-d").'",';
	}
	if($column->type=="integer"){
		if($cont==sizeof($columns))
			$url.='"'.$column->name.'":1}&callback=Ext';
		else
			$url.='"'.$column->name.'":1,';
	}
	if($column->type=="double"){
		if($cont==sizeof($columns))
			$url.='"'.$column->name.'":25.4}&callback=Ext';
		else
			$url.='"'.$column->name.'":25,4,';
	}
}
?>
<?php echo $link."/".$modelClass?>/update?records={<?php echo $url;?>

<?php $cont=0;$url="";foreach($columns as $column){
	$cont++;
	if($column->isPrimaryKey == 1)
		$url.='"'.$column->name.'":1}&callback=Ext';
}
?>
<?php echo $link."/".$modelClass?>/delete?records={<?php echo $url;?>

<?php echo $link."/".$modelClass?>/?start=0&limit=3&callback=Ext
<?php echo $link."/".$modelClass?>/?start=0&limit=3&filter=[{"property":"","value":""}]&sort=[{"property":"value":""}]&callback=Ext