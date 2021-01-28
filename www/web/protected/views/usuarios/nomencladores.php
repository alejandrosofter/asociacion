<table class="table">
<tbody>
	<tr><th>Obra Social</th></tr>
</tbody>
<?php foreach($nomencladores as $item){ ?>
<tr><td><i><small><small>(<?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$item->fechaModificacion);?>)</small> </small></i><a target="_blank" href="index.php?r=usuarios/descargar&id=<?=$item->id;?> "><small><?=$item->obraSocial->nombreOs;?> </small> </a></td></tr>
<?php } ?>
</table>