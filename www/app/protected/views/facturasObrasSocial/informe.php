<h1>INFORME <small>de facturacion a O.S</small></h1>
<br>
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

  'htmlOptions'=>array ('style'=>'width:350px',"id"=>"idObraSocial",'prompt'=>'Seleccione...'),
  "options"=>array('allowClear'=>true,'placeholder'=>'Seleccione'),
  'attribute'=>'idObraSocial',
  "name"=>"idObraSocial",

  'data'=>CHtml::listData(ObrasSociales::model()->findAll(array('order'=>'nombreOs')), 'id', 'nombreOs')
)
); ?>
<a class="btn btn-success" onclick="buscar()">Buscar</a>
</div>

<div id="contenedor">

</div>
<a class="btn btn-success" style="width: 100%;display:none" id="btnImprimir" onclick="imprimir()">IMPRIMIR</a>
<script>
function imprimir()
{
  $("#contenedor").print();
}
function buscar()
{
    var idObraSocial=$("#idObraSocial").val();
    var fechaDesde=$("#fechaDesde").val();
    var fechaHasta=$("#fechaHasta").val();

    $.blockUI({ message: '<h1><img src="images/loader.gif" /> Espere un momento por favor...</h1>' }); 
     $("#btnImprimir").hide();
    $.get("index.php?r=facturasObrasSocial/informe_",{idObraSocial:idObraSocial,fechaHasta:fechaHasta,fechaDesde:fechaDesde},function(res){
     $.unblockUI();
     $("#contenedor").html(res);
     $("#btnImprimir").show();

    })
}
</script>