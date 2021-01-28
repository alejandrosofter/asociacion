<div id='impresionDetalle'>
<link rel="stylesheet" type="text/css" href="css/impresion.css"/>

<big>
<table style="width:100%">
<tr>
  <td style='width:450px'>
    <div class='cabezal'>
      <img src='images/logo2.bmp'/>
      <p>
      <?=utf8_decode(Settings::model()->getValorSistema('DATOS_EMPRESA_RAZONSOCIAL'));?><br>
     <br>
      Administración: <?=utf8_decode(Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECCION'));?><br>
      Tel. <?=Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO')?> email:<?=Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN')?>
      
      </p>
      </div>
  </td>
  <td>
    <strong>FECHA COMIENZO: </strong> <?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$model->fechaComienzo)?><br>
      <strong>FECHA ENTREGA: </strong> <?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$model->fechaEntrega)?><br>
    <strong>LIQUIDACION Nro </strong> <?=str_pad($model->nroLiquidacion,5,"0",STR_PAD_LEFT);?><br>
  </td>
</tr>
</table>
</big>

<table style="width:100%">
<tr>
  <td style='width:100%'>
   <strong>PROFESIONAL: <span style="font-size: 20px"> <?=$model->profesional->nombreProfesionales;?></span></strong><br>
   
  </td>
  <td style='width:100%'>
   <strong>OBRA SOCIAL: <span style="font-size: 20px"> <?=$os;?></span></strong><br>
   
  </td>
  
</tr>
<tr>

  <td style="width: 100%;">
    
  </td></tr>
<tr>
  <td colspan = "2" style='width:100%'>
  <br>
<small>Debe a Asociación Austral de Oftalmología en concepto de prestaciones medicas oftalmológicas conforme al siguiente detalle:</small>



  </td>
</tr>
</table>
<table class='tabla22'>
  <thead> <tr><th>Paciente</th><th>Nro Orden</th><th>Nro Afiliado</th><th>Nomenclador</th><th>Importe</th></tr> </thead>
  <tbody>
<?php
$total=0;
  if($items)
    foreach($items as $item){
$total+=$item->factura->importe;
  ?>
<tr>
<td class='nombre'><?=$item->factura->paciente ?></td>
  <td class='nroOrden'><?=$item->factura->nroOrden ?></td>
  <td class='nroOrden'><?=$item->factura->obraSocial->preCodigo.$item->factura->nroAfiliado ?></td>
  <td class='nombre'><?=$item->factura->nombreNomenclador ?></td>
  <td class='importe' style="width: 80px;text-align: right;"><?=number_format($item->factura->importe,2) ?> <?=($item->factura->esDoble?"(2)":"")?></td>
</tr>
<?php }?>
<tr>
<td class='nombre'></td>
  <td class='nombre'></td>
  <td class='nombre'></td>
  <td class='nombre'>TOTAL</td>
  <td class='importe' style="width: 80px;text-align: right;"><?=$total?></td>
</tr>
</tbody>
</table>
<br>
SON PESOS <?=Settings::model()->num2letras(number_format($total,2,'.',''));?> centésimos.<br>
</div>
