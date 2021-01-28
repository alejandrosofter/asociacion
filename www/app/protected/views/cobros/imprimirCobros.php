<link rel="stylesheet" type="text/css" href="css/impresion.css"/>

<div style='pading:20px' id='impresion'>
<table style="width:100%">
<tr>
  <td style='width:500px'>
    <div class='cabezal'>
      <img src='images/logo2.bmp'/>
      <p>
      <?=utf8_decode(Settings::model()->getValorSistema('DATOS_EMPRESA_RAZONSOCIAL'))?><br>
     <br>
      Administración: <?=utf8_decode(Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECCION'))?><br>
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
    <strong> <big>COBROS ASOCIADOS A LA LIQUIDACION<big></big></big></strong><br>
  </td>
</tr>
<tr>
  <td colspan = "2" style='width:100%'>
  <br>
  
</table>
<table class='tablaDos'>
  <colgroup>
       <col span="1" style="width: 90px;">
       <col span="1" style="width: 220px;">
       <col span="1" style="width: 80px;">
       <col span="1" style="width: 80px;">
    </colgroup>
<tr>
  <th style="width: 90px;">Fecha</th>
  <th >Obra Social</th>
   <th class='importe' style="width: 130px;">$ Debitos</th>
    <th class='importe' style="width: 130px;">$ Cobrado</th>
</tr>
<?php

$total=0;
$totalDebitos=0;
if(isset($cobros))
foreach($cobros as $item){
$total+=$item->importe;
$totalDebitos+=$item->importeDebitos;
  ?>
<tr>
  <td class='nombre'><?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$item->fecha)?></td>
  <td class='nombre'><?=$item->getObrasSociales(false);?></td>
  <td class='importe'> <?=money_format('%i',$item->importeDebitos);?></td>
  <td class='importe'> <?=money_format('%i',$item->importe);?></td>
</tr>
<?php }?>
<tr>
  <td></td>
  <td style="text-align:right">SUB-TOTAL</td>
  <td class='importe'><big><strong> <?=$total==0?'':money_format('%i',$totalDebitos);?></strong></big></td>
  <td class='importe'><big><strong> <?=money_format('%i',$total);?></strong></big></td>
</tr>

</table>



</div>