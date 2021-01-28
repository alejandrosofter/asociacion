<link rel="stylesheet" type="text/css" href="css/impresion.css"/>

<div id='impresion'>
<table class='table' style="width:100%">
<tr>
  <td style='width:500px'>
    <div class='cabezal'>
      <img src='images/logo2.bmp'/>
      <p>
      <?=utf8_decode(Settings::model()->getValorSistema('DATOS_EMPRESA_RAZONSOCIAL')); ?><br>
     <br>
      Administración: <?=Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECCION')?><br>
      Tel. <?=Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO')?> email:<?=Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN')?>
      
      </p>
      </div>
  </td>
  <td>
    <strong>FECHA</strong> <?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$model->fecha)?><br>
    <strong>LIQUIDACION Nro </strong> <?=$model->id;?><br>
    <strong>CUIT </strong> <?=Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT')?><br>
    <strong>IVA </strong> <?=Settings::model()->getValorSistema('DATOS_EMPRESA_CONDICIONIVA')?><br>
    <strong>INGRESOS BRUTOS </strong> <?=Settings::model()->getValorSistema('DATOS_EMPRESA_CONDICIONIVA')?><br>
  </td>
</tr>
</table>

<table style="width:100%">
<tr>
  <td>
    <strong>Señor/es: <big><big><?=$model->profesional->nombreProfesionales;?></big></big></strong><br>
  </td>
</tr>
<tr>
  <td colspan = "2" style='width:100%'>
  <br>
  <small><small>Debe a Asociación Austral de Oftalmología en concepto de prestaciones medicas oftalmológicas conforme al siguiente detalle:</small></small>
</table>
<table class='tablaDos'>
<tr>
  <th >Detalle</th>
  <th style="text-align:right" class='importe'>Debe $</th>
  <th style="text-align:right" class='importe'>Haber $</th>
</tr>
<?php

$total=0;
$totalDebe=0;
$totalHaber=0;
if(isset($model->pagosItems))
foreach($model->pagosItems as $item){
$total+=$item->importe;
$debe=$item->importe<=0?$item->importe:0;
$haber=$item->importe>=0?$item->importe:0;
$totalDebe+=$debe;
$totalHaber+=$haber;
  ?>
<tr>
  <td class='nombre'><?=$item->detalle;?></td>
  <td class='importe'> <?=$debe==0?'':money_format('%i',-$debe);?></td>
  <td class='importe'> <?=$haber==0?'':money_format('%i',$haber);?></tr>
<?php }?>
<tr>
  <td style="text-align:right">SUB-TOTAL</td>
  <td class='importe'><big><strong> <?=$totalDebe==0?'':money_format('%i',-$totalDebe);?></strong></big></td>
  <td class='importe'><big><strong> <?=money_format('%i',$totalHaber);?></strong></big></td>
</tr>
<?php foreach($model->impuestos as $impuesto){
$total+=$impuesto->importe;
$totalDebe+=$impuesto->importe;
  ?>
<tr>
  <td class='nombre'><?=$impuesto->impuesto->nombreImpuesto;?></td>
  <td class='importe'> <?=money_format('%i',-$impuesto->importe);?></td>
  <td class='importe'> </td>
</tr>
<?php }?>
<tr>
  <td  class='importe'></td>
  <td class='importe'><big><strong> <?=money_format('$ %i', $totalDebe);?></strong></big></td>
  <td class='importe'><big><strong> <?=money_format('$ %i',$totalHaber);?></strong></big></td>
</tr>

</table>
<br>
<div class='totalFinal' style='border:1px solid #000;float:right;width: 320px;height:30px'><strong><big><big>SALDO <?=money_format('$ %i',$total);?></big></big></strong></div>

</div>