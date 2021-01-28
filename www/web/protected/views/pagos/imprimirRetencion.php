<?
$arr=explode('-',$model->fecha);
$meses=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
$index=$arr[1]-1;
$mes=strtoupper($meses[$index]);
?>
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
?>
<div id='impresion'>
<div style="float: right; top: 50px; right: 30px; width: 200px;"><br>
<strong>FECHA</strong> <?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$model->fecha)?><br>
<strong>LIQUIDACION Nro </strong> <?=$model->id;?><br>
<strong>CUIT </strong> <?=Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT')?><br>
<strong>IVA </strong> <?=Settings::model()->getValorSistema('DATOS_EMPRESA_CONDICIONIVA')?><br>
<strong>INGRESOS BRUTOS </strong> <?=Settings::model()->getValorSistema('DATOS_EMPRESA_CONDICIONIVA')?><br>
</div>
<br><br><br><br>
<h4>Comprobante de retención de impuesto a las ganancias R.G 830</h4>
<h4>A) Datos del Agente de Retención</h4>
<table style="width:100%,;font-size:12px">
<tr>
  <td>
    <strong>Apellido y Nombre o Denominación: </strong> <?=Settings::model()->getValorSistema('DATOS_EMPRESA_RAZONSOCIAL')?><br>
    <strong>Domicilio: </strong><?=Settings::model()->getValorSistema('DATOS_EMPRESA_DOMFISCAL')?><br>
    <strong>Localidad: </strong> <?=Settings::model()->getValorSistema('DATOS_EMPRESA_LOCALIDAD')?><br>
  </td>
   <td>
    <strong>Provincia: </strong>  <?=Settings::model()->getValorSistema('DATOS_EMPRESA_PCIA')?><br>
    <strong>C.U.I.T.: </strong>  <?=Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT')?><br>
  </td>
</tr>
</table>
<br>

<h4>B) Datos del Sujeto Retenido</h4>

<table style="width:100%;font-size:12px">
<tr>
  <td>
    <strong>Apellido y Nombre o Denominación: <big><strong></strong> <?=$model->profesional->nombreProfesionales;?></strong></big><br>
    <strong>Domicilio: </strong> <?=$model->profesional->domicilio;?><br>
    <strong>Localidad: </strong> <?=$model->profesional->localidad;?><br>
  </td>
   <td>
    <strong>Condición Frente al Impuesto: </strong> <?=isset($model->profesional->condicionIva)?$model->profesional->condicionIva->nombreIva:'-';?><br>
    <strong>C.U.I.T.: </strong> <?=$model->profesional->cuit;?><br>
  </td>
</tr>
</table>
<br>
<h4>C) Datos de la Retención Practicada</h4>

<table style="width:100%;font-size:12px">
<tr>
  <td>
    <strong>Concepto: </strong><?=$model->profesional->regimen=='actual'?'Profesionales Liberales(Cod. 116)':'Profesionales (Cod. 64)'?><br>
    <strong>Fecha Retención: </strong> <?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$model->fecha)?><br>
  </td>
   <td>
    <strong>Importe Sujeto a Retención: </strong> $ <?=number_format($model->retencion->importeBase,2);?><br>
    <strong>Importe Retenido: </strong> $ <?=number_format(-$model->retencion->importeRetencion,2)?><br>
  </td>
</tr>
</table>
<br>
<small>
<p>SE DEJA CONSTANCIA QUE EL PROVEEDOR A NOMBRE DE QUIEN SE EMITE EL PRESENTE COMPROBANTE ESTA COMPRENDIDO EN LAS DISPOSICIONES DEL 
 REGIMEN DE RETENCIONES DEL IMPUESTO A LAS GANANCIAS IMPLEMENTADO 
POR LA RESOLUCION VIGENTE. LA RETENCION EFECTUADA INGRESARA 
A LA D.G.I. SEGUN DECLARACION JURADA DEL MES DE <?=$mes;?>
</p>
Firma del Agente de Retención<br>
</small>
<img src='images/firma.png'/>
</div>