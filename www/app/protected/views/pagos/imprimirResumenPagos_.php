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
    <strong> <big>RESUMEN PAGOS DE LA LIQUIDACION<big></big></big></strong><br>
  </td>
</tr>
<tr>
  <td colspan = "2" style='width:100%'>
  <br>
  
</table>
<table class='tablaDos'>
  
<tr>
  <th style="width: 210px;">Profesional</th>
  <th style="width: 110px;">CUIT</th>
  <th style="width: 100px;">$ FACT.</th>
   <th class='importe' style="width: 90px;">$ Ret.</th>
   <th class='importe' style="width: 90px;">% Asoc.</th>
   <th class='importe' style="width: 90px;">% Cheq.</th>
   <th class='importe' style="width: 90px;">$ Debitos</th>
    <th class='importe' style="width: 130px;">$ Pagado</th>
</tr>
<?php

$total=0;
$totalDebitos=0;
$totalRetiene=0;
$totalCreditos=0;
$totalAsoc=0;
$totalCheq=0;
if(isset($pagos))
foreach($pagos as $item){
$total+=$item->importe;
$totalDebitos+=$item->getImporteDebitos();
$totalRetiene+=$item->getImporteRetencion();
$totalAsoc+=$item->getImporteAsoc();
$totalCheq+=$item->getImporteCheq();
$totalCreditos+=$item->getImporteCreditos();
  ?>
<tr>
  <td class='nombre'><?=$item->profesional->getnombreProfesionales();?></td>
  <td class='nombre'><?=$item->profesional->cuit;?></td>
  <td class='importe'>  <?=money_format('%i',$item->getImporteCreditos());?> </td>
  <td class='importe'> <?=money_format('%i',$item->getImporteRetencion());?></td>
  <td class='importe'> <?=money_format('%i',$item->getImporteAsoc());?></td>
  <td class='importe'> <?=money_format('%i',$item->getImporteCheq());?></td>
   <td class='importe'> <?=money_format('%i',$item->getImporteDebitos());?></td>
  <td class='importe'> <?=money_format('%i',$item->importe);?></td>
</tr>
<?php }?>
<tr>
  <td></td><td style="text-align:right">SUB-TOTAL</td>
 <td class='importe'><big><strong> <?=$total==0?'':money_format('%i',$totalCreditos);?></strong></big></td>
  <td class='importe'><big><strong> <?=$total==0?'':money_format('%i',$totalRetiene);?></strong></big></td>
  <td class='importe'><big><strong> <?=$total==0?'':money_format('%i',$totalAsoc);?></strong></big></td>
  <td class='importe'><big><strong> <?=$total==0?'':money_format('%i',$totalCheq);?></strong></big></td>
  <td class='importe'><big><strong> <?=$total==0?'':money_format('%i',$totalDebitos);?></strong></big></td>
  <td class='importe'><big><strong> <?=money_format('%i',$total);?></strong></big></td>
</tr>

</table>



</div>