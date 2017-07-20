<h1>Bienvenido a Yii Code Generator!</h1>

<p>
	Puede usar los siguientes generadores para construir rápidamente tu aplicación Yii:
</p>
<ul>
	<?php foreach($this->module->controllerMap as $name=>$config): ?>
	<li><?php echo CHtml::link(ucwords(CHtml::encode($name).' generator'),array($name.'/index'));?></li>
	<?php endforeach; ?>
</ul>

