<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
  <style type="text/css">
  /*td {border:1px solid black}*/
  .tabla{
    /*font-family: Verdana,Arial,Helvetica;*/
    /*font-size: 8px;*/
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
    /*background-color: #e4eef6;*/
    background-repeat: repeat-x;
    /*color:#6f9abc;*/
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
<p>
<h2><font color="#558FA6">MONITOREO DEL ESTADO DEL PUNTO - Proyecto Buen Trato en tus Manos</font></h2>
<table width="954" border="0">
  <tr>
    <td width="150">Punto Comunitario:</td>
    <td width="312"><?php echo $res11[0]['punto_comunitario'];?></td>
    <td width="117">Fecha:</td>
    <td width="347"><?php echo $res11[0]['fecha'];?></td>
  </tr>
  <tr>
    <td>Responsable:</td>
    <td><?php echo $res12[0]['responsable'];?></td>
    <td>Participantes:</td>
    <td><?php echo $res11[0]['participantes'];?></td>
  </tr>
  <tr>
    <td>Evaluado Por:</td>
    <td><?php echo $res11[0]['usuario'];?></td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</p>
<p>&nbsp;</p>
<table width="756" border="1" class="tabla">
  <tr>
    <th width="94" align="center" style="border:1px solid black">CARACTER'ISTICA</th>
    <th width="167" align="center" style="border:1px solid black">Ámbito</th>
    <th width="139" align="center" style="border:1px solid black">InDICADORES</th>
    <th width="136" align="center" style="border:1px solid black">PRESENTE</th>
    <th width="106" align="center" style="border:1px solid black">REFORZAR</th>
    <th width="74" align="center" style="border:1px solid black">AUSENTE</th>
  </tr>
  <?php $i=0;foreach ($res11 as $value) {?>
  <tr>
    <td><?php echo $res11[$i]['caracteristica'];?></td>
    <td><?php echo $res11[$i]['ambito'];?></td>
    <td><?php echo $res11[$i]['indicadores'];?></td>
<?php if ($res11[$i]['resultado'] == "presente"){?>
    <td>X</td>
<?php } else {?>
	<td></td>
<?php }//if?>
<?php if ($res11[$i]['resultado'] == "reforzar"){?>
    <td>X</td>
<?php } else {?>
	<td></td>
 <?php }//if?>
<?php if ($res11[$i]['resultado'] == "ausente"){?>
    <td>X</td>
<?php } else {?>
	<td></td>
<?php }//if?>
  </tr>
  <?php $i++;} ?>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>