<?php
/**
 * Esta es la plantilla para generar un archivo de vista de la acccion.
 * Las sisguientes variables estan disponibles en esta plantilla:
 * - $callback nombre de la variable
 */
?>
<?php echo "<?php\n"; ?>
if ($callback){
    echo $callback . '(' . CJSON::encode($model) . ');';
}else{
    echo CJSON::encode($model);
}
?>