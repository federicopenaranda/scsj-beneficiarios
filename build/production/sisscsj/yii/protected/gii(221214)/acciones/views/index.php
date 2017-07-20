<h1>Generador de CRUD</h1>
 
<?php $form=$this->beginWidget('CCodeForm', array('model'=>$model)); ?>
 
    <div class="row">
        <!--yo-->
        <?php echo $form->labelEx($model,'nomodel'); ?>
        <?php echo $form->textField($model,'nomodel',array('size'=>65)); ?>
        <div class="tooltip">
            Nombre del modelo solo debe contener palabras.
        </div>

         <?php echo $form->labelEx($model,'classRuta'); ?>
         <?php echo $form->textField($model,'classRuta',array('size'=>65)); ?>
         <div class="tooltip">
           Ruta especifica del archivo a guardar.(Igual que el nombre del modelo)
        </div>
         <?php echo $form->error($model,'classRuta'); ?>
    </div>
 
<?php $this->endWidget(); ?>

