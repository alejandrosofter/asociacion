<div class="row">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'facturas-profesional-form',
	'enableAjaxValidation'=>false,
	'focus'=>array($model,'fechaConsulta'),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
<div class="span3">
	<div class="">
		<?php echo $form->labelEx($model,'fecha',array('class'=>'')); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'attribute'=>'fecha',
    'model'=>$model,
    // additional javascript options for the date picker plugin
     'options'=>array(
        'showAnim'=>'fold',
        'dateFormat' => 'yy-mm-dd', // save to db format
        'altFormat' => 'dd-mm-yy', // show to user format
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
)); ?>
		<?php echo $form->error($model,'fechaConsulta'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'fechaConsulta',array('class'=>'')); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'attribute'=>'fechaConsulta',
    'model'=>$model,
    // additional javascript options for the date picker plugin
     'options'=>array(
        'showAnim'=>'fold',
        'dateFormat' => 'yy-mm-dd', // save to db format
        'altFormat' => 'dd-mm-yy', // show to user format
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
)); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>

		
	<div class="">
		<?php echo $form->labelEx($model,'idProfesional',array('class'=>'')); ?>
		<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:280px','placeholder'=>'seleccione...'),
  'attribute'=>'idProfesional',
  'data'=>CHtml::listData(Profesionales::model()->findAll(array('order'=>'apellido')), 'id', 'nombreProfesionales'))
); ?>
		<?php echo $form->error($model,'idProfesional'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'paciente',array('class'=>'')); ?>
		<?php echo $form->textField($model,'paciente',array('class'=>'')); ?>
		<?php echo $form->error($model,'paciente'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'nroAfiliado',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nroAfiliado',array('class'=>'')); ?>
		<?php echo $form->error($model,'nroAfiliado'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'nroOrden',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nroOrden',array('class'=>'')); ?>
		<?php echo $form->error($model,'nroOrden'); ?>
	</div>
		<div class="">
		<?php echo $form->labelEx($model,'idObraSocial',array('class'=>'')); ?>
		<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,

  'htmlOptions'=>array ('style'=>'width:280px','onchange'=>'cambiaObraSocial()','placeholder'=>'seleccione...'),
  'attribute'=>'idObraSocial',
  'data'=>CHtml::listData(ObrasSociales::model()->findAll(array('order'=>'nombreOs')), 'id', 'nombreOs'))
); ?>
		<?php echo $form->error($model,'idObraSocial'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'idRangoNomenclador',array('class'=>'')); ?>
		<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,

  'htmlOptions'=>array ('style'=>'width:280px','onchange'=>'cambiaRango()','placeholder'=>'seleccione...'),
  'attribute'=>'idRangoNomenclador',
 // 'data'=>CHtml::listData(ObrasSociales::model()->findAll(array('order'=>'nombreOs')), 'id', 'nombreOs')
)
); ?>
		<?php echo $form->error($model,'idObraSocial'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'idNomenclador',array('class'=>'')); ?>
		<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:280px','placeholder'=>'seleccione...'),
  'attribute'=>'idNomenclador',
  // 'data'=>CHtml::listData(FacturasProfesionaNomencladores::model()->findAll(array('order'=>'codigoInterno')), 'id', 'codigoInterno')
)
); 
?>
		<?php echo $form->error($model,'idProfesional'); ?>
	</div>


	<div class="form-inlne">
		<?php echo $form->labelEx($model,'importe',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importe',array('class'=>'uneditable-input')); ?>
		<span>fijo </span>
		<?php echo $form->checkBox($model,'importeFijo',array('class'=>'')); ?>
		<?php echo $form->error($model,'importe'); ?>
	</div>

	<div class="form-inline">
<?php echo $form->labelEx($model,'esDoble',array('class'=>'')); ?>
		<?php echo $form->checkBox($model,'esDoble',array('class'=>'')); ?>
		<?php echo $form->error($model,'esDoble'); ?>
	</div>
	<div class="form-inline">
		

		<?php echo $form->labelEx($model,'es50',array('class'=>'')); ?>
		<?php echo $form->checkBox($model,'es50',array('class'=>'')); ?>
		<?php echo $form->error($model,'es50'); ?>

		<?php echo $form->labelEx($model,'es75',array('class'=>'')); ?>
		<?php echo $form->checkBox($model,'es75',array('class'=>'')); ?>
		<?php echo $form->error($model,'es75'); ?>
		
		
		
		
	</div>
 
	

	<div class="">
		<?php echo $form->labelEx($model,'estado',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'estado',FacturasProfesional::model()->getEstados(),array ('style'=>'width:300px;',"prompt"=>"Seleccione ...")); ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>
	<div class="">
	Nueva Carga <?php echo CHtml::checkBox('nuevaCarga',isset($_POST['nuevaCarga']))?>
	</div>
	<div class="buttons">
	
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary','id'=>'botonAceptar','onclick'=>'$("#botonAceptar").hide()')); ?>
	</div>
</div>
<div class="span9">
<h2>Ultimas <input type="text" style="width:40px" id="cantidad" onchange="mostrarUltimasCargas()" value="10"/> Cargas desde <small><?=$_SERVER['SERVER_ADDR']?></small></h2>
<div id='ultimas'>No hay registros...</div>
</div>
	

<?php $this->endWidget(); ?>

</div><!-- form -->
<script> 
$( document ).ready(function() {
	init();
});
function init()
{
	$("#FacturasProfesional_importe").focus(); 
	mostrarUltimasCargas();
	inicarListenings();
	llenarRangos();
	//cambiaObraSocial()
}
function cambiaObraSocial()
{
	mostrarUltimasCargas();
	//llenarNomencladores()
	llenarRangos();
}
function cambiaRango()
{
	llenarNomencladores()
}
function setOpciones(data)
{
	var sal=[];
	for(var i=0;i<data.length;i++){
		var idSeleccion=<?=isset($_GET['FacturasProfesional']['idNomenclador'])?$_GET['FacturasProfesional']['idNomenclador']:0?>;
		var lab=data[i].codigoInterno+" | "+data[i].detalle.substring(0,40);
		var auxOption=new Option(lab, data[i].id, idSeleccion==data[i].id);
		auxOption.setAttribute("importe",data[i].importe);
		$('#FacturasProfesional_idNomenclador').append(auxOption).trigger('change');
		}
	
    // Append it to the select
    return sal;
}
function setOpcionesRango(data)
{
	var sal=[];
	for(var i=0;i<data.length;i++){
		var lab=data[i].fechaDesde+" ----> "+data[i].fechaHasta;
		var auxOption=new Option(lab, data[i].id, true, true);
		$('#FacturasProfesional_idRangoNomenclador').append(auxOption).trigger('change');
		}
	
    // Append it to the select
    return sal;
}
function llenarNomencladores()
{
	$('#FacturasProfesional_idNomenclador').empty().trigger('change')
	$.blockUI({ message: '<h1><img src="images/loader.gif" /> Espere un momento por favor...</h1>' }); 
	var idObraSocial=$("#FacturasProfesional_idObraSocial").val();
	var idRango=$("#FacturasProfesional_idRangoNomenclador").val();
	 $.getJSON("index.php?r=facturasProfesionalNomencladores/buscarNomencaldores",{idObraSocial:idObraSocial,idRango:idRango},function(res){
     
      $.unblockUI();
      setOpciones(res);
      $('#FacturasProfesional_idNomenclador').select2().trigger('change');
      $("#FacturasProfesional_esDoble").trigger("change");

    })
}
function llenarRangos()
{
	$('#FacturasProfesional_idRangoNomenclador').empty().trigger('change')
	$.blockUI({ message: '<h1><img src="images/loader.gif" /> Espere un momento por favor...</h1>' }); 
	var idObraSocial=$("#FacturasProfesional_idObraSocial").val();
	 $.getJSON("index.php?r=facturasProfesionalRangoNomencladores/getRangos",{idObraSocial:idObraSocial},function(res){
     
      $.unblockUI();
      setOpcionesRango(res);
      $('#FacturasProfesional_idRangoNomenclador').select2().trigger('change');

    })
}
function mostrarImporte()
{
	var importe=$('#FacturasProfesional_idNomenclador option:selected').attr('importe');

	$("#FacturasProfesional_importe").val(importe)
}
function cambiaConsultaDoble(check)
{
	var importe=$('#FacturasProfesional_idNomenclador option:selected').attr('importe')*1;
	if(!check) $("#FacturasProfesional_importe").val(importe);
		else $("#FacturasProfesional_importe").val(importe*2);

}
function cambiaImporteFijo(check)
{
	if(!check)$("#FacturasProfesional_importe").addClass("uneditable-input")
	else $("#FacturasProfesional_importe").removeClass("uneditable-input")
}
function inicarListenings()
{


	 var $e_idNomenclador = $("#FacturasProfesional_idNomenclador");
	  $e_idNomenclador.select2();

	$e_idNomenclador.on("change", function (e) { 
	mostrarImporte();
	 });
	//**************************************************
	var $e_importeFijo = $("#FacturasProfesional_importeFijo");
	

	$e_importeFijo.on("change", function (e) { 
	cambiaImporteFijo(this.checked);
	});
	//**************************************************
	var $e_consultaDoble = $("#FacturasProfesional_esDoble");
	

	$e_consultaDoble.on("change", function (e) { 
	cambiaConsultaDoble(this.checked);
	});
	//**************************************************
	var $e_al50 = $("#FacturasProfesional_es50");
	

	$e_al50.on("change", function (e) { 
	var importe=$('#FacturasProfesional_importe').val()*1;
	if(!this.checked) $("#FacturasProfesional_importe").val((importe/0.5).toFixed(2));
		else $("#FacturasProfesional_importe").val((importe*0.5).toFixed(2));
	});
	//**************************************************
	var $e_al75 = $("#FacturasProfesional_es75");
	

	$e_al75.on("change", function (e) { 
		var importe=$('#FacturasProfesional_importe').val()*1;
	if(!this.checked) $("#FacturasProfesional_importe").val((importe/0.75).toFixed(2));
		else $("#FacturasProfesional_importe").val((importe*0.75).toFixed(2));
	});

	//*******************************************
	

	window.onkeydown=function(e){
		 var code = e.keyCode ? e.keyCode : e.which;
		if(code==120){
			$("#facturas-profesional-form").submit()
		}
	}

	
}

function mostrarUltimasCargas()
{
	buscarUltimas($('#FacturasProfesional_idObraSocial').val());
}
function buscarUltimas(idOs)
{
	console.log(idOs,$('#cantidad').val());
	$.get( "index.php?r=facturasProfesional/ultimas",{idObraSocial:idOs,cantidad:$('#cantidad').val()}, function( data ) {
 	$('#ultimas').html(data);
	});
}

</script>