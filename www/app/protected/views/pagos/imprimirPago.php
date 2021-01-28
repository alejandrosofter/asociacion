<link rel="stylesheet" type="text/css" href="css/impresion.css"/>
<?php
  if(!isset($pdf))
     $this->widget('ext.mPrint.mPrint', array(
          'title' => 'Imprime',          //the title of the document. Defaults to the HTML title
          'tooltip' => 'Imprime',        //tooltip message of the print icon. Defaults to 'print'
          'text' => 'Imprimir',   //text which will appear beside the print icon. Defaults to NULL
          'element' => '#impresion',        //the element to be printed.
         // 'debug' => true,  
          //'publishCss' => true,       //publish the CSS for the whole page?
         // 'visible' => Yii::app()->user->checkAccess('print'),  //should this be visible to the current user?
        //  'alt' => 'print',       //text which will appear if image cant be loaded
          //'debug' => true,            //enable the debugger to see what you will get
          //'id' => 'link'         //id of the print link
      ));
?> 
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
    <strong>Señor/es: <big><big><?=$model->profesional->nombreProfesionales;?></big></big></strong><br>
  </td>
</tr>
<tr>
  <td colspan = "2" style='width:100%'>
  <br>
  <small><small>Debe a Asociación Austral de Oftalmología en concepto de prestaciones medicas oftalmológicas conforme al siguiente detalle:</small></small>
</table>
<table class='tablaDos'>
  <colgroup>
       <col span="1" style="width: 580px;">
       <col span="1" style="width: 120px;">
       <col span="1" style="width: 120px;">
    </colgroup>
<tr>
  <th >Detalle</th>
  <th style="text-align:right;" class='importe'>Debe $</th>
  <th style="text-align:right" class='importe'>Haber $</th>
</tr>
<?php
$arrDebitoOtros=array();
$total=0;
$totalDebe=0;
$totalHaber=0;
if(isset($model->pagosItems2))
foreach($model->pagosItems2 as $item)
  if($item->idTipoItemPago==42 || $item->idTipoItemPago==122) //42 es Debitos Otros y 122 es cuota obra
    $arrDebitoOtros[]=$item;
  else {
$total+=$item->importe;
$debe=$item->importe<=0?$item->importe:0;
$haber=$item->importe>=0?$item->importe:0;
$totalDebe+=$debe;
$totalHaber+=$haber;
  ?>
<tr>
  <td class='nombre'><?=$item->detalle;?><small></small></td>
  <td class='importe'> <?=$debe==0?'':money_format('%i',-$debe);?></td>
  <td class='importe'> <?=$haber==0?'':money_format('%i',$haber);?></tr>
<?php }?>
<tr>
  <td style="text-align:right">SUB-TOTAL</td>
  <td class='importe'><big><strong> <?=$totalDebe==0?'':money_format('%i',-$totalDebe);?></strong></big></td>
  <td class='importe'><big><strong> <?=money_format('%i',$totalHaber);?></strong></big></td>
</tr>
<?php 
//IMPRIMIR DEBITOS Otros
foreach($arrDebitoOtros as $item){
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
<?php $importeRetencion=0;if($model->impuestos)foreach($model->impuestos as $impuesto){
$total+=$impuesto->importe;
if($impuesto->impuesto->id==3)$importeRetencion=$impuesto->importe;
$totalDebe+=$impuesto->importe;
  ?>

<tr>
  <td class='nombre'><?=$impuesto->impuesto->nombreImpuesto;?></td>
  <td class='importe'> <?=money_format('%i',-$impuesto->importe);?></td>
  <td class='importe'> </td>
</tr>
<?php }
$importeNotaDebito=$totalDebe-$importeRetencion;
?>


<tr>
  <td  class='importe'></td>
  <td class='importe'><big><strong> <?=money_format('$ %i', $totalDebe);?></strong></big></td>
  <td class='importe'><big><strong> <?=money_format('$ %i',$totalHaber);?></strong></big></td>
</tr>

</table>
<br>
<div class='totalFinal' style='border:1px solid #000;float:right;width: 320px;height:30px'><strong><big><big>SALDO <?=money_format('$ %i',$total);?></big></big></strong></div>
<br><br><br><br><br>
<p>REALIZAR LOS SIGUIENTES COMPROBANTES Y ENVIAR VIA MAIL A <b>asoc.australdeoftalmologia@gmail.com</b> con ASUNTO DEL MAIL: <b>COMPROBANTES <?=$model->profesional->nombreProfesionales;?> NRO LIQUIDACION: <?=$model->id;?></b> :<br></p>
<h3>FACTURA $<?=number_format($totalHaber,2)?></h3>
<h3>NOTA DE CREDITO $<?=number_format($importeNotaDebito,2)?></h3>
<h2>IMPORTANTE!: En las Obras Sociales SEROS y OSDE no confeccionar la factura hasta recibir los datos de la Asociación. </h2>
</div>