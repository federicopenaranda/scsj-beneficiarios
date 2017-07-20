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
<table width="856" height="243" border="0" class="tabla">
  <tr>
    <td height="52" colspan="4" align="center"><h1><font color="#558FA6">Ficha Social Familiar</font></h1><hr></p></td>
  </tr>
  <tr>
    <td height="23" colspan="4" align="left"><h2><font color="#558FA6">Datos Generales</font></h2></td>
  </tr>
  <tr>
    <td width="209" rowspan="2" align="center" valign="top"><table width="200" border="0">
      <tr>
        <th colspan="2" align="center"  style="border:1px solid black">Información Personal</th>
        </tr>
      <tr>
        <td width="138" style="border:1px solid black">Primer Nombre:</td>
        <td width="46" style="border:1px solid black"><?php echo $res11[0]['Primer_Nombre'];?></td>
      </tr>
      <tr>
        <td style="border:1px solid black">Segundo Nombre:</td>
        <td style="border:1px solid black"><?php echo $res11[0]['Segundo_Nombre'];?></td>
      </tr>
      <tr>
        <td style="border:1px solid black">Apellido Paterno:</td>
        <td style="border:1px solid black"><?php echo $res11[0]['Apellido_Paterno'];?></td>
      </tr>
      <tr>
        <td style="border:1px solid black">Apellido Materno:</td>
        <td style="border:1px solid black"><?php echo $res11[0]['Apellido_Materno'];?></td>
      </tr>
      <tr>
        <td style="border:1px solid black">Sexo:</td>
        <td style="border:1px solid black"><?php if($res11[0]['Sexo']=="f"){echo "Femenino";} else {if ($res11[0]['Sexo']=="m")echo "Masculino";}?></td>
      </tr>
      <tr>
        <td style="border:1px solid black">Fecha de Nacimiento:</td>
        <td style="border:1px solid black"><?php echo $res11[0]['Fecha_de_Nacimiento'];?></td>
      </tr>
      <tr>
        <td style="border:1px solid black">Edad:</td>
        <td style="border:1px solid black"><?php echo $res11[0]['Edad'];?></td>
      </tr>
      <tr>
        <td style="border:1px solid black">Religión</td>
        <td style="border:1px solid black"><?php echo $res11[0]['Religion'];?></td>
      </tr>
    </table></td>
    <td width="209" rowspan="2" align="center" valign="top"><table width="200" border="0" class="tabla">
      <tr>
        <th colspan="2" align="center" style="border:1px solid black">Información de Contacto</th>
        </tr>
      <tr>
        <td style="border:1px solid black">Domicilio:</td>
        <td style="border:1px solid black"><?php echo $res12[0]['Direccion'];?></td>
      </tr>
      <tr>
        <td style="border:1px solid black">Teléfonos:</td>
          <td style="border:1px solid black">
        <?php $i=0;foreach ($res16 as $value) {?>
          <?php if($res16[$i]['Estado_urgencia']==1)echo $res16[$i]['Telefono']." (urgente)";else echo $res16[$i]['Telefono']; ?><br>
        <?php $i++;} ?>
          </td>
      </tr>
    </table>      <table width="200" border="0">
        <tr>
          <th colspan="2" align="center" style="border:1px solid black">Documentación</th>
        </tr>
         <?php for($i=0;$i<sizeof($res19);$i++) { ?>
        <tr>
          <td width="112" style="border:1px solid black"><?php echo $res19[$i]['Nombre_identificacion'];?></td>
          <td width="72" style="border:1px solid black"><?php echo $res19[$i]['Numero_identificacion'];?></td>
        </tr>
        <?php } ?>
        <tr>
          <td style="border:1px solid black">Carnet de Salud:</td>
          <td style="border:1px solid black"><?php if($res11[0]['Carnet_de_Salud']==1)echo "Si tiene";else echo "No tiene";?></td>
        </tr>
    </table></td>
    <td width="203" height="118" align="center" valign="top"><table width="200" border="0" class="tabla">
      <tr>
        <th colspan="2" align="center" style="border:1px solid black">Información de Familia</th>
        </tr>
      <tr>
        <td width="123" align="left" style="border:1px solid black">Codigo de Familia:</td>
        <td width="61" style="border:1px solid black"><?php echo $res12[0]['Codigo_de_Familia'];?></td>
      </tr>
      <tr>
        <td align="left" style="border:1px solid black">Nro Caso:</td>
        <td style="border:1px solid black"><?php echo $res11[0]['Nro_de_Caso'];?></td>
      </tr>
    </table></td>
    <td width="207" rowspan="2" align="center" valign="top"><table width="200" border="0" class="tabla">
      <tr>
        <th colspan="2" align="center" style="border:1px solid black">Información de Instrucción</th>
        </tr>
      <tr>
        <td width="112" align="left" style="border:1px solid black">Libreta Escolar:</td>
        <td width="72" style="border:1px solid black"><?php if($res11[0]['Libreta_Escolar']==1)echo "Si tiene";else "No tiene";?></td>
      </tr>
      <tr>
        <td align="left" style="border:1px solid black">Turno:</td>
        <td style="border:1px solid black"><?php echo $res15[0]['Turno'];?></td>
      </tr>
       <tr>
        <td align="left" style="border:1px solid black">Unidad Educativa:</td>
        <td style="border:1px solid black"><?php echo $res110[0]['Unidad_Educativa'];?></td>
      </tr>
      <tr>
        <td align="left" style="border:1px solid black">Idiomas:</td>
        <td style="border:1px solid black"><?php $i=0;foreach ($res17 as $value) {?>
          <?php echo $res17[$i]['Idiomas'];?><br>
        <?php $i++;} ?></td>
      </tr>
      <tr>
        <td align="left" style="border:1px solid black">Curso: </td>
        <td style="border:1px solid black"><?php echo $res11[0]['Curso'];?></td>
      </tr>
       <tr>
        <td align="left" style="border:1px solid black">Nivel: </td>
        <td style="border:1px solid black"><?php echo $res11[0]['Nivel'];?></td>
      </tr>
       <tr>
        <td align="left" style="border:1px solid black">Formacion: </td>
        <td style="border:1px solid black"><?php echo $res11[0]['Formacion'];?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" valign="top"><table width="200" border="0" class="tabla">
      <tr>
        <th colspan="2" align="center" style="border:1px solid black">Ocupación</th>
        </tr>
      <tr>
        <td width="117" align="left" style="border:1px solid black">Trabaja:</td>
        <td width="67" style="border:1px solid black"><?php if($res11[0]['Trabaja']==1){echo "Si trabaja";}else{ if($res11[0]['Trabaja']==0)echo "No trabaja";}?></td>
        </tr>
      <tr>
        <td align="left" style="border:1px solid black">Lugar de Trabajo:</td>
        <td style="border:1px solid black"><?php echo $res14[0]['Lugar_de_Trabajo'];?></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="855" border="0" class="tabla">
  <tr>
    <td align="left"><h2><font color="#558FA6">Grupo Familiar</font></h2></td>
  </tr>
  <tr>
    <td align="center" valign="top"><table width="823" border="0" class="tabla">
      <tr>
        <th width="56" align="center" style="border:1px solid black">Nro</th>
        <th width="98" align="center" style="border:1px solid black">Nombre completo</th>
        <th width="99" align="center" style="border:1px solid black">Parentesco</th>
        <th width="79" align="center" style="border:1px solid black">Edad</th>
        <th width="104" align="center" style="border:1px solid black">Responsable</th>
        <th width="59" align="center" style="border:1px solid black">Sexo</th>
        <th width="119" align="center" style="border:1px solid black">Grado de Instruccion</th>
        <th width="76" align="center" style="border:1px solid black">Ocupación</th>
        <th width="75" align="center" style="border:1px solid black">Ingreso</th>
      </tr>
      <?php for($i=0;$i<sizeof($res21);$i++) { ?>
      <tr>
        <td style="border:1px solid black"><?php echo $i+1;?></td>
        <td style="border:1px solid black"><?php echo $res21[$i]['Nombre'];?></td>
        <td style="border:1px solid black"><?php echo $res21[$i]['Parentesco'];?></td>
        <td style="border:1px solid black"><?php echo $res21[$i]['Edad'];?></td>
        <td style="border:1px solid black"><?php if($res21[$i]['Responsable']==1)echo "Si";else echo "No";?></td>
        <td style="border:1px solid black"><?php if($res21[$i]['Sexo']=="f")echo "Femenino"; else echo "Masculino";?></td>
        <td style="border:1px solid black"><?php echo $res21[$i]['Grado'];?></td>
        <td style="border:1px solid black"><?php echo $res21[$i]['Ocupacion'];?></td>
        <td style="border:1px solid black"><?php echo $res21[$i]['Ingreso'];?></td>
      </tr>
       <?php }?>
    </table></td>
  </tr>
</table>
<table width="855" height="114" border="0" class="tabla">
  <tr>
    <td colspan="6" align="left"><h2><font color="#558FA6">Situación Socioeconómica</font></h2></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top"><table width="229" border="0" class="tabla">
      <tr>
        <th colspan="2" align="center" style="border:1px solid black">Información de Casa</th>
        </tr>
      <tr>
        <td width="158" align="left" style="border:1px solid black">Tipo de Vivienda:</td>
        <td width="55" style="border:1px solid black"><?php echo $res3[0]['Tipo_de_Vivienda'];?></td>
      </tr>
      <tr>
        <td align="left" style="border:1px solid black">Numero de Habitaciones:</td>
        <td style="border:1px solid black"><?php echo $res3[0]['Numero_de_Habitaciones'];?></td>
      </tr>
      <tr>
        <td align="left" style="border:1px solid black">Tipo Cocina:</td>
        <td style="border:1px solid black"><?php echo $res3[0]['Tipo_de_Cocina'];?></td>
      </tr>
    </table></td>
    <td width="304" align="center" valign="top"><table width="200" border="0" class="tabla">
      <tr>
        <th colspan="2" align="center" style="border:1px solid black">Servicios Básicos</th>
        </tr>
      <tr>
        <td width="101" align="center" style="border:1px solid black">Servicio:</td>
        <td width="83" style="border:1px solid black"><?php $i=0;foreach ($res31 as $value) {?>
          <?php echo $res31[$i]['Servicio'];?><br>
        <?php $i++;} ?></td>
        </tr>
    </table></td>
    <td colspan="2" align="center" valign="top">&nbsp;</td>
    <td width="457" align="center" valign="top"><table width="200" height="85" border="0.5" class="tabla">
      <tr>
        <th colspan="2" align="center" style="border:1px solid black">Firma</th>
        </tr>
      <tr>
        <td height="35" colspan="2" style="border:1px solid black">&nbsp;</td>
        </tr>
      <tr>
        <td width="156" style="border:1px solid black">Fecha y Hora de Reporte</td>
        <td width="28" style="border:1px solid black"><?php echo date('Y-m-d H:i:s');?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td width="237" align="left" style="border:1px solid black">Observaciones:</td>
    <td width="63">&nbsp;</td>
    <td>&nbsp;</td>
    
    <td width="142"></td>
    <td width="5">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" colspan="3" align="left" style="border:1px solid black"><?php echo $res3[0]['Observaciones'];?></td>
    
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>