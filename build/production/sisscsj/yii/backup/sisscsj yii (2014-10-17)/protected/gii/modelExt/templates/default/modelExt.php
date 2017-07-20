<?php $mode=new $this->nomodel;?>
Ext.define('sisscsj.model.opciones.<?php echo $this->nomodel?>',{
	extend:'sisscsj.model.Base',
	<?php foreach ($mode->attributeNames() as $name){if(substr($name,0,2)=='id'){?>
idProperty:'<?php echo $name?>',
	 <?php }?><?php }?>
fields:[
<?php $i=0;$num=count($mode-> attributeLabels());foreach ($mode->attributeNames() as $name){
 if($num!==1){?>
		<?php if($mode->getTipoDato($mode->TableName(),$i)=='blob'){
			$tipo='string';
		}else{
			$tipo=$mode->getTipoDato($mode->TableName(),$i);
		}
		?>
	  	{
 			name:'<?php echo $name?>',
 			type:'<?php echo $tipo;?>',
 			useNull:true
 		},
<?php }else{?>
		<?php if($mode->getTipoDato($mode->TableName(),$i)=='blob'){
			$tipo='string';
		}else{
			$tipo=$mode->getTipoDato($mode->TableName(),$i);
		}
		?>
 		{
 			name:'<?php echo $name?>',
 			type:'<?php echo $tipo;?>',
 			useNull:true
 		}
<?php }$num--;$i++;}?>
]
});
