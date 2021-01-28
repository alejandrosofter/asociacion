<link rel="stylesheet" type="text/css" href="css/impresion.css"/>
<div id="printable">
<table style="width:100%">
<tr>
  <td style='width:60%'>
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
  <td  style='width:120px'>
    <strong>FECHA DESDE</strong> <?=$_GET['fechaDesde']?><br>
    <strong>FECHA HASTA </strong> <?=$_GET['fechaHasta']?><br>
    <strong>CUIT </strong> <?=Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT')?><br>
    <strong>IVA </strong> <?=Settings::model()->getValorSistema('DATOS_EMPRESA_CONDICIONIVA')?><br>
    <strong>INGRESOS BRUTOS </strong> <?=Settings::model()->getValorSistema('DATOS_EMPRESA_CONDICIONIVA')?><br>
     <strong>PROFESIONAL </strong> <?=$nombre?><br>
  </td>
</tr>
</table>

<h1>RESUMEN DE DEBITOS </h1>
<table style="width: 100%" class='tablaDos'>
	<colgroup>
		<col span="1" style="width: 100px;">
       <col span="1" style="width: 80px;">
       <col span="1" style="width: 80px;">
       <col span="1" style="width: 80px;">
       <col span="1" style="width: 80px;">
       <col span="1" style="width: 80px;">
       <col span="1" style="width: 80px;">
       <col span="1" style="width: 80px;">
    </colgroup>
		<tr><th>Fecha Pago</th><th>$ Obra Social</th><th >$ Debitos Os</th><th >$ Debitos</th><th  >$ Chq.</th><th >$ Asoc.</th><th  >$ Ret.</th><th >$ Creditos</th><th >$ Debitos</th><th >$ Deb s/ret</th><th  >$ Saldo</th>
		</tr>
		<?php 
		$sum=0;$sumTotalDebitos=0;$saldo=0;$sumCheque=0;$sumDebitos=0;$sumRetenciones=0;$sumDebitoOs=0;$sumCuotaSocial=0;$sumAsoc=0;$sumDebitosTotal=0;$sumSaldo=0;$sumDebRet=0;
		 for ($i=0; $i < count($cuenta) ; $i++) { 
		 	$value=$cuenta[$i];

		 	
		 	
		 	$sumCheque+=$value['importeCheque'];
		 	$sumDebitos+=$value['importeDebitos'];
		 	$sumRetenciones+=$value['importeRetenciones'];
		 	$sumDebitoOs+=$value['importeDebitoOs'];
		 	$sumCuotaSocial+=$value['importeCuotaSocial'];
		 	$sumAsoc+=$value['importeAsociacion'];
		 	$sumTotalDebitos+=$sum+$sumCheque+$sumDebitos+$sumRetenciones+$sumDebitoOs+$sumCuotaSocial+$sumAsoc;
		 	$debitos=$value['importeCheque']+$value['importeDebitos']+$value['importeDebitoOs']+$value['importeCuotaSocial']+$value['importeAsociacion']+$value['importeRetenciones'];
		 	$creditos=$value['importe']-$debitos;
		 	$debitosRet=$value['importeCheque']+$value['importeDebitos']+$value['importeDebitoOs']+$value['importeCuotaSocial']+$value['importeAsociacion'];
		 	$sumDebRet+=$debitosRet;
		 	$sum+=$creditos;
		 	$sumDebitosTotal+=$debitos;
		 	$saldo=$creditos+$debitos;
		 	$sumSaldo+=$saldo;
		 	 ?>
		<tr >
			<td class='nombre'><?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$value['fecha']) ?></td>
			<td class='importe'><?=number_format($value['importeCuotaSocial'],2) ?></td>
			<td class='importe'><?=number_format($value['importeDebitoOs'],2) ?></td>
			<td class='importe'><?=number_format($value['importeDebitos'],2) ?></td>

			
			<td class='importe' ><?=number_format($value['importeAsociacion'],2) ?></td>
			<td class='importe'><?=number_format($value['importeCheque'],2) ?></td>
			<td class='importe' ><?=number_format($value['importeRetenciones'],2) ?></td>

			<td class='importe'><?=number_format($creditos,2) ?></td>
			<td class='importe'><?=number_format($debitos,2) ?></td>
			<td class='importe'><?=number_format($debitosRet,2) ?></td>
			
			<td class='importe' ><?=number_format($saldo,2) ?></td>
			
			
		</tr>
		<?php } ?>
		<tr>
			<th style="text-align: right;" >TOTALES</th>
			<th style="text-align: right;" class='importe'>$ <?=number_format($sumCuotaSocial,2)?></th>
			
			<th style="text-align: right;"  class='importe'>$ <?=number_format($sumDebitoOs,2)?></th>
			<th style="text-align: right;"  class='importe'>$ <?=number_format($sumDebitos,2)?></th>
			
			<th style="text-align: right;" class='importe'>$ <?=number_format($sumAsoc,2)?></th>
			<th style="text-align: right;"  class='importe'>$ <?=number_format($sumCheque,2)?></th>
			<th style="text-align: right;"  class='importe'>$ <?=number_format($sumRetenciones,2)?></th>
			<th style="text-align: right;"  class='importe'>$ <?=number_format($sum,2)?></th>
			<th style="text-align: right;"  class='importe'>$ <?=number_format($sumDebitosTotal,2)?></th>
			<th style="text-align: right;"  class='importe'>$ <?=number_format($sumDebRet,2)?></th>
			
			<th style="text-align: right;"  class='importe'>$ <?=number_format($sumSaldo,2)?></th>

		</tr>
		</table>
	<big>ACLARACIÓN PARA LA FACTURACIÓN A LA ASOCIACIÓN: </big>
	Para realizar la factura debe utilizar el importe de la columna <b> $ créditos </b> para realizar la nota de crédito utilizar la columna <b>$ Deb s/ret</b>
	</div>
