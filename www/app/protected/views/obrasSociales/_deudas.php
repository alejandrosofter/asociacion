<div id="printable">
<table class="table table-condensed table-horved">
	<tr><th style="width:100px">FECHA</th><th>NRO FACTURA</th><th>$ FACTURADO</th><th>$ DEBITO</th><th>$ COBRADO</th><th>$ SALDO</th></tr>
	<tbody>
		<?php $total_saldo=0;
		$sumFact=0;
		$sumDebito=0;
		$sumCobrado=0;
		 for($i=0;$i<count($datos);$i++){
$saldo=$this->getImporteSaldo($datos[$i]);
$total_saldo+=$saldo;
$sumFact+=$datos[$i]["importe"];
$sumDebito+=$this->getDebitoFactura($datos[$i]);
$sumCobrado+=$this->getImporteCobrado($datos[$i]);
			?>
			<tr>
				<td><?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$datos[$i]['fecha'])?> <small>(<?=$this->getCantidadDiasFactura($datos[$i])?>)</small></td><td><?=$datos[$i]["nroFactura"]?> </td>
				<td><?=Yii::app()->numberFormatter->formatCurrency($datos[$i]["importe"],"")?></td>
				<td><?=Yii::app()->numberFormatter->formatCurrency($this->getDebitoFactura($datos[$i]),"")?></td>
				<td><?=Yii::app()->numberFormatter->formatCurrency($this->getImporteCobrado($datos[$i]),"")?> <small style="color:grey"><?=$this->getFechaCobro($datos[$i])?></small></td>
				<td><?=Yii::app()->numberFormatter->formatCurrency($saldo,"")?></td></tr>

		<?php }?>
		<tr><th></th><th></th><th>$ <?=Yii::app()->numberFormatter->formatCurrency($sumFact,"")?></th><th>$ <?=Yii::app()->numberFormatter->formatCurrency($sumDebito,"")?></th><th>$ <?=Yii::app()->numberFormatter->formatCurrency($sumCobrado,"")?></th><th>$ <?=Yii::app()->numberFormatter->formatCurrency($total_saldo,"")?></th></tr>
	</tbody>

</table>
</div>
<a class="btn btn-success" style="width: 100%;" id="btnImprimir" onclick="imprimir()">IMPRIMIR</a>
<script>
function imprimir()
{
  //$("#printable").print();
   var divToPrint=document.getElementById('printable');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><head></head><body  onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);
}
</script>