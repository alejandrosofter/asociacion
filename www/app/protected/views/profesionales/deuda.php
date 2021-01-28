<h1>CTA CTE <small>Profesionales</small></h1>
<div class="form-inline">
<?php $this->widget('ext.2select.ESelect2',array(
  'id'=>"idProfesional",
   'name'=>"idProfesional",
  'htmlOptions'=>array ('style'=>'width:380px'),
  'attribute'=>'idProfesional',
   'options'=>array(
    'placeholder'=>'Seleccione...',
    'allowClear'=>true,
  ),
  'data'=>CHtml::listData(Profesionales::model()->findAll(array('order'=>'apellido')), 'id', 'nombreProfesionales'))
); ?>

 <button onclick="consultar()" class="btn btn-success btn-sm">Buscar</button>
</div>
<div id="contenedor"></div>

<script>

function consultar()
{
	$.blockUI({ message: '<h1><img src="images/loader.gif" /> Espere un momento por favor...</h1>' }); 
	var idProfesional=$("#idProfesional").val();
	$.get("index.php?r=profesionales/getDeuda&idProfesional="+idProfesional,function(res){
		$.unblockUI();
		$("#contenedor").html(res)
	})
}
</script>