<?php
$this->breadcrumbs=array(
	'Facturas Profesional Rango Nomencladores'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List FacturasProfesionalRangoNomencladores','url'=>array('index')),
	array('label'=>'Create FacturasProfesionalRangoNomencladores','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('facturas-profesional-rango-nomencladores-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Facturas Profesional Rango Nomencladores</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'facturas-profesional-rango-nomencladores-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'fechaDesde',
		'fechaHasta',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
