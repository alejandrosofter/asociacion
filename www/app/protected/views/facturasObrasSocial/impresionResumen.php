
<?php if(!isset($pdf))
     $this->widget('ext.mPrint.mPrint', array(
          'title' => 'Imprime',          //the title of the document. Defaults to the HTML title
          'tooltip' => 'Imprime',        //tooltip message of the print icon. Defaults to 'print'
          'text' => 'Imprimir',   //text which will appear beside the print icon. Defaults to NULL
          'element' => '#impresion',        //the element to be printed.
         // 'debug' => true,  
         // 'publishCss' => true,       //publish the CSS for the whole page?
         // 'visible' => Yii::app()->user->checkAccess('print'),  //should this be visible to the current user?
        //  'alt' => 'print',       //text which will appear if image cant be loaded
          //'debug' => true,            //enable the debugger to see what you will get
          //'id' => 'link'         //id of the print link
      ));
?>
<div id='impresion'>
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
    <strong>FECHA</strong> <?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$model->fecha)?><br>
    <strong>LIQUIDACION Nro </strong> <?=$model->id;?><br>
    <strong>CUIT </strong> <?=Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT')?><br>
    <strong>IVA </strong> <?=Settings::model()->getValorSistema('DATOS_EMPRESA_CONDICIONIVA')?><br>
    <strong>INGRESOS BRUTOS </strong> <?=Settings::model()->getValorSistema('DATOS_EMPRESA_CONDICIONIVA')?><br>
  </td>
</tr>
</table>
</big>

<table style="width:100%">
<tr>
  <td style='width:100%'>
   <strong>Señor/es: <span style="font-size: 20px"> <?=$model->obraSocial->nombreOs;?></span></strong><br>
    <strong>Domicilio: </strong> <?=$model->obraSocial->direccion;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <strong>Cond. Iva: </strong> <?=isset($model->obraSocial->condicionIva)?$model->obraSocial->condicionIva->nombreIva:'-';?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <strong>Cuit: </strong> <?=$model->obraSocial->cuit;?> 
   
  </td>
  
</tr>
<tr>

  <td style="width: 100%;">
    
  </td></tr>
<tr>
  <td colspan = "2" style='width:100%'>
  <br>
  <small><small>Debe a Asociación Austral de Oftalmología en concepto de prestaciones medicas oftalmológicas conforme al siguiente detalle:</small></small>
<table class='tablaDos'>
<tr><th >Profesional</th><th>Importe</th></tr>
<?php
$total=0;
  if($model->facturasProfesionales_group)
    foreach($model->facturasProfesionales_group as $item){
$total+=$item->importe;
  ?>
<tr><td class='nombre'><?=$item->profesional->nombreProfesionales;?></td><td class='importe'><?=number_format($item->importe,2);?></td></tr>
<?php }?>
<tr><td class='importe'>TOTAL</td><td style='width:220px' class='importe'><strong><big><big><?=$this->formatearNum($total,20);?></big></big></strong></td></tr>
</table>
  <td>
</tr>
</table>
<br>
SON PESOS <?=Settings::model()->num2letras(number_format($total,2,'.',''));?> centésimos.<br>

<table style="width:100%">
<tr>
  <td style='width:800px'>
      FECHA DE RECEPCION: <br>
      <small>ASOCIACION ASUTRAL DE OFTALMOLOGIA</small>
  </td>
  <td style='width:500px'>
      RECIBI CONFORME: <br>
      <small>(FIRMA Y SELLO DE OBRA SOCIAL) </small>
  </td>
<tr>

</table>

