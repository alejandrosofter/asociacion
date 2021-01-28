<h1>CTA CTE <small>Obras Sociales</small></h1>
<div class="form-inline">
    <div class="form-inline">
  <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'attribute'=>'fechaDesde', 'name'=>'fechaDesde',
     'options'=>array( 'showAnim'=>'fold', 'dateFormat' => 'yy-mm-dd', 'altFormat' => 'dd-mm-yy'),
     'htmlOptions'=>array(  'style'=>'height:20px;', 'id'=>'fechaDesde', 'placeholder'=>'Fecha Desde')
)); ?>
 <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'attribute'=>'fechaHasta', 'name'=>'fechaHasta',
     'options'=>array( 'showAnim'=>'fold', 'dateFormat' => 'yy-mm-dd', 'altFormat' => 'dd-mm-yy'),
     'htmlOptions'=>array(  'style'=>'height:20px;', 'id'=>'fechaHasta', 'placeholder'=>'Fecha Hasta')
)); ?>
<?php $this->widget('ext.2select.ESelect2',array(
  'id'=>"idObraSocial",
   'name'=>"idObraSocial",
  'htmlOptions'=>array ('style'=>'width:380px'),
  'attribute'=>'idObraSocial',
   'options'=>array(
    'placeholder'=>'Seleccione...',
    'allowClear'=>true,
  ),
  'data'=>CHtml::listData(ObrasSociales::model()->findAll(array('order'=>'nombreOs')), 'id', 'nombreOs'))
); ?>
 <?php echo CHtml::dropDownList("estado",'estado',FacturasProfesional::model()->getEstados(),array ('style'=>'width:130px;',"prompt"=>"Todos ...")); ?>
 <button onclick="consultar()" class="btn btn-success btn-sm">Buscar</button>
</div>

<div id="contenedor"></div>

<script>

function consultar()
{
	$.blockUI({ message: '<h1><img src="images/loader.gif" /> Espere un momento por favor...</h1>' }); 
	var idObraSocial=$("#idObraSocial").val();
  var fechaDesde=$("#fechaDesde").val();
  var fechaHasta=$("#fechaHasta").val();
	var estado=$("#estado").val();
	$.get("index.php?r=obrasSociales/getDeuda&idObraSocial="+idObraSocial+"&estado="+estado+"&fechaDesde="+fechaDesde+"&fechaHasta="+fechaHasta,function(res){
		$.unblockUI();
		$("#contenedor").html(res)
	})
}
</script>