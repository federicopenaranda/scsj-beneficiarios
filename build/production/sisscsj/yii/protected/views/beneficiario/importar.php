<?php
echo CHtml::form('','post',array('enctype'=>'multipart/form-data'));
echo CHtml::activeFileField($model,'fotografia_beneficiario');
echo CHtml::submitButton('Importar', array('name' => 'submit'));
echo CHtml::endForm();
?>
	




