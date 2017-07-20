<?php
/**
* nombre de la tabla <?php echo $tableName; ?>
*  nombre del Modelo <?php echo $modelClass; ?>
*/
?>
<?php echo "<?php\n"; ?>
/**
 * Este es el controlador para el modelo "<?php echo $modelClass; ?>".
 */
class ReporteController extends <?php echo $this->baseClass."\n"; ?>
{
	public function actions()
    {
		return array(
				'reporte'=>'application.controllers.Reporte.reporte',
		);
	}
}
