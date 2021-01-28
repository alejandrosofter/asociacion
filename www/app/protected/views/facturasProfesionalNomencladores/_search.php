<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	 'htmlOptions'=>array(
                          'class'=>'form-inline',
                        )
)); ?>


	<?php echo $form->textFieldRow($model,'codigoInterno',array('class'=>'span1')); ?>
	<?php echo $form->textFieldRow($model,'codigoExterno',array('class'=>'span1')); ?>
	<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:280px'),
  'attribute'=>'idObraSocial',
  'data'=>CHtml::listData(ObrasSociales::model()->findAll(array('order'=>'nombreOs')), 'id', 'nombreOs'))
); ?>
  <?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:200px',),
  'attribute'=>'idRangoNomenclador',

  //'data'=>CHtml::listData(FacturasProfesionalRangoNomencladores::model()->findAll(array('order'=>'fechaHasta')), 'id', 'nombreRango')
)
); ?>


		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Buscar',
		)); ?>


<?php $this->endWidget(); ?>

<script>
  $( document ).ready(function() {
    var selectorOs="#FacturasProfesionalNomencladores_idObraSocial";
escucharObraSocial(selectorOs);
buscarRangos($(selectorOs).val());
});
function escucharObraSocial(selector)
{
    var $eventSelect = $(selector);
$eventSelect.select2();

$eventSelect.on("change", function (e) { 
buscarRangos($(selector).val());
 });
}
function buscarRangos(idObraSocial)
  {
     $.blockUI({ message: '<h1><img src="images/loader.gif" /> Espere un momento por favor...</h1>' }); 
    $.getJSON("index.php?r=FacturasProfesionalRangoNomencladores/getRangos",{idObraSocial:idObraSocial},function(res){
        llenar(res);
     $.unblockUI();

    })
  }
  function llenar(data)
{
  var sal=[];
  $('#FacturasProfesionalNomencladores_idRangoNomenclador').empty().trigger('change')
  for(var i=0;i<data.length;i++){
    var lab=data[i].fechaDesde+" ----> "+data[i].fechaHasta;
    var idSeleccion=<?=isset($_GET['FacturasProfesionalNomencladores']['idRangoNomenclador'])?$_GET['FacturasProfesionalNomencladores']['idRangoNomenclador']:0?>;
    var seleccionado=idSeleccion==data[i].id?true:false;
    var auxOption=new Option(lab, data[i].id, seleccionado,seleccionado);
    $('#FacturasProfesionalNomencladores_idRangoNomenclador').append(auxOption).trigger('change');
    }
  
    return sal;
}
</script>