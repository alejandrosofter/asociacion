<?php
$this->breadcrumbs=array(
	'Detalle de Horas',
);

$this->menu=array(
	array('label'=>'Nuevo EquiposHorasDetalle', 'url'=>array('create')),
);
?>

<h1>Detalle de <span class='colored bolder'>Horas</span></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'equipos-horas-detalle-grid',
	'dataProvider'=>$model,

	'columns'=>array(
		array(
			'header'=>'Fecha',
			'value'=>'$data->equipoHora->fechaCarga',
			),
		array(
			'header'=>'Equipo',
			'value'=>'$data->equipoHora->equipo->nroInterno."-".$data->equipoHora->equipo->EquiposTipos->nombreTipo',
			),
		array(
			'header'=>'tipo',
			'value'=>'$data->costo->nombreCostoTipo',
			),
		array(
			'header'=>'Cantidad Horas',
			'value'=>'$data->cantidadHoras." hrs."',
			),
		array(
			'header'=>'Locación',
			'value'=>'$data->equipoHora->zona->nombreZona."-".$data->equipoHora->codLocacion',
			),
	),
)); ?>
