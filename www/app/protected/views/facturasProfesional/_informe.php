<div id="printable">

<div style="height: 80px" class="inline-form" >
	<img style="float:right;padding: 30px" src="images/logo2.bmp">
<b>PERIODO desde </b> <?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$fechaDesde) ?> <b>hasta</b> <?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$fechaHasta) ?> 
</div>
<h1>RESUMEN DE FACTURACION A PROFESIONALES </h1>
<?php if($idProfesional!=""){?><b>PROFESIONAL: </b><?php $prof=Profesionales::model()->findByPk($idProfesional); echo $prof->nombreProfesionales; ?> <?php }?>
<?php if($idObraSocial!=""){?><b>OBRA SOCIAL: </b><?php $model=ObrasSociales::model()->findByPk($idObraSocial); echo $model->nombreOs; ?> <?php }?>
<table style="font-size:10px" class="table table-condensed">
<tr><th>Fecha</th><?=($idObraSocial=="")?"<th>Obra Social</th>":"";?><?=($idProfesional=="")?"<th>Profesional</th>":"";?><th>Paciente</th><th>Nro Orden</th><th>Nro Afiliado</th><th>Nomenclador</th><th>$ Importe</th></tr>
<?php $sum=0; for ($i=0; $i < count($data) ; $i++) { $value=$data[$i];$sum+=$value->importe; ?>
<tr>
	<td style="width: 80px"><a target="_blank" href="index.php?r=facturasProfesional/update&id=<?=$value->id?>"><?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$value->fechaConsulta) ?></a></td>
	<?php if($idObraSocial==""){?><td style="width: 250px"><?=$value->obraSocial->nombreOs ?></td> <?php }?>
	<?php if($idProfesional==""){?><td style="width: 250px"><?=$value->profesional->nombreProfesionales ?></td><?php }?>
	<td><?=$value->paciente ?></td>
	<td><?=$value->nroOrden ?></td>
	<td><?=$value->obraSocial->preCodigo.$value->nroAfiliado ?></td>
	<td><?=$value->nombreNomenclador ?></td>
	<td style="width: 80px;text-align: right;"><?=number_format($value->importe,2) ?> <?=($value->esDoble?"(2)":"")?></td>
</tr>
<?php } ?>
<tr><?=($idObraSocial=="")?"<th></th>":"";?><?=($idProfesional=="")?"<th></th>":"";?> <th></th> <th></th> <th></th> <th></th> <th>TOTAL</th><th>$ <?=number_format($sum,2)?></th></tr>
</table>
</div>
<a class="btn btn-success" style="width: 100%;display:none" id="btnImprimir" onclick="imprimir()">IMPRIMIR</a>

<script>
	function getCss()
	{
		return ""
	}
function imprimir()
{
  //$("#printable").print();
   var divToPrint=document.getElementById('printable');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><head> </head><body  onload="window.print()"><small><small>'+divToPrint.innerHTML+'</small></small></body></html>');

  newWin.document.close();
//
  setTimeout(function(){newWin.close();},10);
}
</script>