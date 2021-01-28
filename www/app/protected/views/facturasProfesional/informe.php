<h1>INFORME <small>de facturacion de profesionales</small></h1>
<br>
<div class="form-inline">
 <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'attribute'=>'fechaDesde', 'name'=>'fechaDesde',
     'options'=>array( 'showAnim'=>'fold', 'dateFormat' => 'yy-mm-dd', 'altFormat' => 'dd-mm-yy'),
     'htmlOptions'=>array(  'class'=>'span2', 'id'=>'fechaDesde', 'placeholder'=>'Fecha Desde')
)); ?>
 <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'attribute'=>'fechaHasta', 'name'=>'fechaHasta',
     'options'=>array( 'showAnim'=>'fold', 'dateFormat' => 'yy-mm-dd', 'altFormat' => 'dd-mm-yy'),
     'htmlOptions'=>array(  'class'=>'span2','id'=>'fechaHasta', 'placeholder'=>'Fecha Hasta')
)); ?>
  <?php $this->widget('ext.2select.ESelect2',array(

  'htmlOptions'=>array ('style'=>'width:250px',"id"=>"idProfesional",'prompt'=>'Seleccione...'),
  "options"=>array('allowClear'=>true,'placeholder'=>'Seleccione'),
  'attribute'=>'idProfesional',
  "name"=>"idProfesional",

  'data'=>CHtml::listData(Profesionales::model()->findAll(array('order'=>'apellido')), 'id', 'nombreProfesionales')
)
); ?>
 <?php $this->widget('ext.2select.ESelect2',array(

  'htmlOptions'=>array ('style'=>'width:270px',"id"=>"idObraSocial",'prompt'=>'Seleccione...'),
  "options"=>array('allowClear'=>true,'placeholder'=>'Seleccione OS'),
  'attribute'=>'idObraSocial',
  "name"=>"idObraSocial",

  'data'=>CHtml::listData(ObrasSociales::model()->findAll(array('order'=>'nombreOs')), 'id', 'nombreOs')
)
); ?>
<a class="btn btn-success" onclick="buscar()">Buscar</a>
</div>

<div id="contenedor">

</div>

<script>

function buscar()
{
    var idProfesional=$("#idProfesional").val();
    var idObraSocial=$("#idObraSocial").val();
    var fechaDesde=$("#fechaDesde").val();
    var fechaHasta=$("#fechaHasta").val();

    //$.blockUI({ message: '<h1><img src="images/loader.gif" /> Espere un momento por favor...</h1>' }); 
     $("#btnImprimir").hide();
    $.get("index.php?r=facturasProfesional/informe_",{idProfesional:idProfesional,idObraSocial:idObraSocial,fechaHasta:fechaHasta,fechaDesde:fechaDesde},function(res){
     $.unblockUI();
     $("#contenedor").html(res);
     $("#btnImprimir").show();

    })
}
</script>