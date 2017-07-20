<?php $mode=new $this->nomodel;?>
Ext.define('sisscsj.store.opciones.<?php echo $this->nomodel?>',{
	extend:'sisscsj.store.Base',
	alias:'store.opciones.<?php echo strtolower($this->nomodel); ?>',
	requires:[
		'sisscsj.model.opciones.<?php echo $this->nomodel;?>'
	],
	restPath:'<?php echo $this->nomodel;?>',
	storeId:'<?php echo $this->nomodel;?>',
	model:'sisscsj.model.opciones.<?php echo $this->nomodel;?>'
});

