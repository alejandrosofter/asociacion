<?php
$this->breadcrumbs=array(
	'Facturas Profesionales'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array( );
?>
<button class="btn btn-danger" style="float:right;" onclick="quitar()">QUITAR</button>
<header id="page-header">
<h1 id="page-title">Actualizar FACTURA <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<script>
function quitar()
{
	console.log("ss")
	$.getJSON("index.php?r=facturasProfesional/delete&id=<?=$model->id?>",function(res){
		if(res)
		window.top.close();else{
			swal("Ops","No se puede borrar el registro por que esta asociado a una factura..","error");
		}
	})
}
</script>