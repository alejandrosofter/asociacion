<table class="table table-condensed table-horved">
	<tr><th style="width:100px">FECHA</th><th>NRO FACTURA</th><th>O.S</th><th>$ FACTURADO</th><th>COBRADO</th><th>$ DEBITADO</th><th>$ PAGO</th><th>$ SALDO</th></tr>
	<tbody>
		<?php $total_saldo=0;
		 for($i=0;$i<count($datos);$i++){
$saldo=$datos[$i]["importeFactura"]-$datos[$i]["importePago"]+$datos[$i]["importeDebita"];
$colorSaldo=$saldo>0?"red":"green";
if($saldo==0)$colorSaldo="grey";
if($datos[$i]["importeDebita"]<0)$colorSaldo="orange";
$total_saldo+=$saldo;
			?>
			<tr idCobro="<?=$datos[$i]['idCobro']?>">
				<td><?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$datos[$i]['fecha'])?></td><td><?=$datos[$i]["nroComprobante"]?> </td>
				<td><?=$datos[$i]["obraSocial"]?> </td>
				<td><?=Yii::app()->numberFormatter->formatCurrency($datos[$i]["importeFactura"],"")?> </td>
				<td>
				<?php if(isset($datos[$i]["fechaCobro"])){?>
					<a target="_blank" href="index.php?r=cobrosItems/index&id=<?=$datos[$i]['idCobro']?>"><?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$datos[$i]['fechaCobro'])?></a>
				<?php } else{ ?>
					NO

				<?php }?>
				</td>
				<td style="color:red"><?=Yii::app()->numberFormatter->formatCurrency($datos[$i]["importeDebita"],"")?></td>
				<td style="color:green"><?=Yii::app()->numberFormatter->formatCurrency($datos[$i]["importePago"],"")?></td>
				<td style="color:<?=$colorSaldo?>"><?=Yii::app()->numberFormatter->formatCurrency($saldo,"")?></td>
			</tr>

		<?php }?>
		<tr><th></th><th></th><th></th><th></th><th></th><th>$ <?=Yii::app()->numberFormatter->formatCurrency($total_saldo,"")?></th></tr>
	</tbody>

</table>