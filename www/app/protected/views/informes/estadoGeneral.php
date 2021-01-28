<div class='row'>
<h1>Estado General</h1>

	<div class='span5'>
		<?=$this->renderPartial('_buscadorGeneral');?>
	</div>
	<div class='span7'>
		<h3>Impuestos Anuales Recaudados</h3>
		<? if(isset($_POST['ano'])) echo $this->renderPartial('_impuestos',array('model'=>$impuestos));?>

	</div>
<? if(isset($_POST['ano'])) echo $this->renderPartial('_anualGeneral',array('anualFacturacion'=>$anualFacturacion,'anualPagos'=>$anualPagos,'anualCobros'=>$anualCobros));?>
</div>