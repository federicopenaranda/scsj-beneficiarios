<?php
#header('Content-Disposition: attachment; filename="REP1.PDF"');
?>
<html>
<head>
	<title>REPORTE 1</title>
	<?php $url=Yii::app()->baseUrl.'/style.css';?>
	<style type="text/css">
	.tabla{
		font-family: Verdana,Arial,Helvetica;
		font-size: 8px;
		text-align: center;
		width: 300px;
	}
	.tabla th{
		padding: 3px;
		font-size: 8px;
		background-color: #6f9abc;
		background-repeat: repeat-x;
		color: #FFFFFF;
		border-right-style: solid;
		border-right-color: #558FA6;
		border-bottom-color: #558FA6;
		font-family:"Trebuchet MS",Arial;
		text-transform: uppercase;
		text-align: left;
	}
	.tabla td{
		padding: 3px;
		font-size: 8px;
		background-color: #e4eef6;
		background-repeat: repeat-x;
		color:#6f9abc;
		height: 3px;
		text-transform: uppercase;
	}
	.tabla2{
		positioning: static;
		top: 150px;
		left: 250px;
		font-size: 8px;
	}
	</style>
</head>
<body>
	<table class="tabla" align="center">
		<tr>
			<td colspan="3"><strong>Consultas Bibliográficas (POR GENERO)</strong></td>
		</tr>
		<tr>
			<th>Descripción</th>
			<th>Cantidad</th>
			<th>Porcentaje</th>
		</tr>
		<?php
		$i=0;
		foreach ($listaConsulta1 as $key => $value) {?>
		<tr>
			<th><?php echo $key;?></th>
			<td><?php echo $value;?></td>
			<td><?php echo number_format(($value*100)/$sum1,2); ?> %</td>
		</tr>
		<?php } ?>
		<tr>
			<td>Consultas Bibliográficas (Total)</td>
			<td><?php echo $sum1; ?></td>
			<td><?php if ($sum1!==0) echo number_format(($sum1*100)/$sum1,2); else echo '0';?> %</td>
		</tr>
	</table>
<br>
	<table class="tabla" align="center">
		<tr>
			<td colspan="3"><strong>Consultas Bibliográficas (POR NIVEL)</strong></td>
		</tr>
		<tr>
			<th>Descripción</th>
			<th>Cantidad</th>
			<th>Porcentaje</th>
		</tr>
		<?php
		$i=0;
		foreach ($listaConsulta2 as $key => $value) {?>
		<tr>
			<th><?php echo $key;?></th>
			<td><?php echo $value;?></td>
			<td><?php echo number_format(($value*100)/$sum2,2); ?> %</td>
		</tr>
		<?php } ?>
		<tr>
			<td>Consultas Bibliográficas (Total)</td>
			<td><?php echo $sum2; ?></td>
			<td><?php if ($sum2!==0) echo number_format(($sum2*100)/$sum2,2); else echo '0';?> %</td>
		</tr>
	</table>
<br>
	<table class="tabla" align="center">
		<tr>
			<td colspan="3"><strong>Consultas Bibliográficas (POR TIPO DE USUARIO)</strong></td>
		</tr>
		<tr>
			<th>Descripción</th>
			<th>Cantidad</th>
			<th>Porcentaje</th>
		</tr>
		<?php
		$i=0;
		foreach ($listaConsulta3 as $key => $value) {?>
		<tr>
			<th><?php echo $key;?></th>
			<td><?php echo $value;?></td>
			<td><?php echo number_format(($value*100)/$sum3,2); ?> %</td>
		</tr>
		<?php } ?>
		<tr>
			<td>Consultas Bibliográficas (Total)</td>
			<td><?php echo $sum3; ?></td>
			<td><?php if ($sum3!==0) echo number_format(($sum3*100)/$sum3,2); else echo '0';?> %</td>
		</tr>
	</table>
<br>
	<table class="tabla" align="center">
		<tr>
			<td colspan="3"><strong>Consultas Bibliograficas (POR ÁREA)</strong></td>
		</tr>
		<tr>
			<th>Descripción</th>
			<th>Cantidad</th>
			<th>Porcentaje</th>
		</tr>
		<?php
		$i=0;
		foreach ($listaConsulta4 as $key => $value) {?>
		<tr>
			<th><?php echo $key;?></th>
			<td><?php echo $value;?></td>
			<td><?php echo number_format(($value*100)/$sum4,2); ?> %</td>
		</tr>
		<?php } ?>
		<tr>
			<td>Consultas Bibliográficas (Total)</td>
			<td><?php echo $sum4; ?></td>
			<td><?php if ($sum4!==0) echo number_format(($sum4*100)/$sum4,2); else echo '0';?> %</td>
		</tr>
	</table>


</body>
</html>
