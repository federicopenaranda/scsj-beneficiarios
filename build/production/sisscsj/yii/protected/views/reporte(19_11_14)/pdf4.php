<html>
<head>
	<title>REPORTE 1</title>
</head>
<body>
	<table border=1 bordercolor='silver' align='center'>
		<tr>
			<td colspan="3">Consultas Bibliograficas(POR GENERO)</td>
		</tr>
		<tr>
			<td>Consultas Bibliograficas(Total)</td>
			<td><?php echo $sum; ?></td>
			<td>100 %</td>
		</tr>
		<?php
		$res=$model->consulta4($fini,$ffin);
		for($i=0;$i<sizeof($res);$i++){
			if($res[$i]['sexo_usuario_biblioteca']=='f'){
		?>
		<tr>
			<td>MUJERES</td>
			<td><?php echo $res[$i]['cantidad'];?></td>
			<td><?php echo ($res[$i]['cantidad']*100)/$sum; ?> %</td>
		</tr>
	<?php } else { ?>
		<tr>
			<td>HOMBRES</td>
			<td><?php echo $res[$i]['cantidad'];?></td>
			<td><?php echo ($res[$i]['cantidad']*100)/$sum; ?> %</td>
		</tr>

		<?php } 
	}?>
	</table>
<?php
#$res=$model->consulta1($fini,$ffin);
#for($i=0;$i<sizeof($res);$i++){
#	if($res[$i]['sexo_usuario_biblioteca']=='f')
#		echo "Mujeres ".$res[$i]['cantidad'];
#	else
#		echo "Hombres ".$res[$i]['cantidad']."<br>";
#}

/*foreach ($res[$i] as $key => $value) {
		echo $key.''.$value."<br>";
		$i++;
	}*/
?>
</body>
</html>
