<div class="form login">
<?php $form=$this->beginWidget('CActiveForm'); ?>
	<p>Por favor introduzca su Password</p>

	<?php echo $form->passwordField($model,'password'); ?>
	<?php echo $form->error($model,'password'); ?>

	<?php echo CHtml::submitButton('Ingresar'); ?>

<?php $this->endWidget(); ?>
</div><!-- form -->
