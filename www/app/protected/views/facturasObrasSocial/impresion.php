<link rel="stylesheet" type="text/css" href="css/impresion.css"/>
<?php if(!isset($pdf))
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
      $tipoComprobante=$model->facturaElectronica->tipoComprobante==211?"FACTURA DE CREDITO MiPyME":"FACTURA";
?>



<div id='impresion'>

<table class="tablaDos" style="width:100%;height: 1200px">
<tr> <th style='width:100%;text-align: center;'> <span style=" border: 1px solid black;font-size: 70px;width: 30px "> C </span>
  <tr> <th style='width:100%;text-align: center;'> <span style=" font-size: 9px;width: 30px "> Cod. <?=$model->facturaElectronica->tipoComprobante?> </span> 
  </th></tr>
<tr><th>
  <table style="width:100%">
<tr>
  <td style='width:500px'>
    <div class='cabezal'>
      <table>
        <tr>
          <td style='width:450px'>
            <img src='images/logo2.bmp'/>
            <br>
           <small>
              <?= utf8_decode(Settings::model()->getValorSistema('DATOS_EMPRESA_RAZONSOCIAL'))?><br>
           Fecha Inicio Act. <b>01-06-2008</b> <br>
            Administración: <?=utf8_decode(Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECCION'));?><br>
            Tel. <?=Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO')?> email:<?=Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN')?>
           </small>
          </td>
          <td>
            <strong>NRO <?=str_pad($model->facturaElectronica->puntoVenta, 4, "0", STR_PAD_LEFT)." - ".str_pad($model->facturaElectronica->nroComprobante, 6, "0", STR_PAD_LEFT)?></strong>
            <br><br>
            <div style="font-size: 18px;font-weight: bold;"><?=$duplicado?$tipoComprobante." DUPLICADO":$tipoComprobante." ORIGINAL";?></div>  
<br>
              <strong>FECHA</strong> <?=$model->fechaFacturaElectronica();?><br>
              <?php if($model->facturaElectronica->tipoComprobante==211){?>
               <strong>VTO PAGO</strong> <?=$model->fechaVtoElectronico()?><br>
               <?php }?>
             
              <strong>CUIT </strong> <?=Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT')?><br>
              <strong>IVA </strong> <?=Settings::model()->getValorSistema('DATOS_EMPRESA_CONDICIONIVA')?><br>
              <strong>INGRESOS BRUTOS </strong> <?=Settings::model()->getValorSistema('DATOS_EMPRESA_CONDICIONIVA')?><br>

          </td>
        </tr>
      </table>
      
      
      </div>
  </td>

</tr>
<tr><th>

  <strong>Señor/es: <big> <big><?=isset($model->obraSocial->obraSocialCargo)?$model->obraSocial->obraSocialCargo->nombreOs:$model->obraSocial->nombreOs;?></big></big></strong><br>
<table>
<tr>
  <td style='width:400px'>
<?php $obraSocial=isset($model->obraSocial->obraSocialCargo)?$model->obraSocial->obraSocialCargo:$model->obraSocial;?>
    <strong>Domicilio:</strong> <?=$obraSocial->direccion;?><br>
    <strong>Localidad:</strong> <?=$obraSocial->localidad;?><br>
    <strong>Condicion de Venta:</strong> <?=$obraSocial->condicionVenta;?>
  </td>
  <td>
    <strong>Tel.:</strong> <?=$obraSocial->telefono;?><br>
    <strong>Cuit:</strong> <?=$obraSocial->cuit;?><br>
    <strong>Condicion Iva:</strong> <?=isset($obraSocial->condicionIva)?$obraSocial->condicionIva->nombreIva:'-';?><br>
    
  </td>
</tr>
</table>

</th></tr>
<tr><th>
<br><br>
  <table class='tablaDos'>
<tr><th >Cant.</th><th>Descripción</th><th>Importe</th></tr>
<tr><td>1</td><td><?=$model->detalle;?></td><td>$ <?=number_format($model->importe,2);?></td></tr>
</table>
   <strong><big> <big><?=isset($model->obraSocial->obraSocialCargo)?'A/C de '.$model->obraSocial->nombreOs:'';?> </big> </big></strong>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</th></tr>
</table>
</th></tr>

<tr> <th style='width:100%;text-align: right;font-size: 10px;font-weight: normal;padding: 10px'><b>CAE:</b><?=$model->facturaElectronica->codigo;?> <b>Vto:</b><?=$model->facturaElectronica->vto;?></th></tr>
<tr> <th style='width:100%;text-align: center;'><h2>FE AFIP WEBSERVICE</h2> </th></tr>
</table>
</div>