<div class="row">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'obras-sociales-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required"></p>
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
        'style'=>'height:20px;',
        'class'=>'span2'
    ),
)); ?>
		<?php echo $form->error($model,'fecha'); ?>                                                                                              
	</div>
	<?php echo $form->textField($model,'importe',array('class'=>'')); ?>
		<?php echo $form->error($model,'importe'); ?>
	</div>
	<div class=""></div>
	<?php echo $form->textField($model,'estado',array('TYPE'=>'hidden','size'=>60,'maxlength'=>255)); ?>
	</div><!-- form -->
	<div class="form-actions">
		<button id='btnAceptar' class="btn btn-primary" onclick='ingresar()' type="button">Aceptar</button>
	</div>

<?php $this->endWidget(); ?>
<script>
var items=new Array();
var proximo=0;
cambiaProfesional();
function cambiaAplica()
{
	if($('#noAplicaImpuestos:checked').val())$('#aplicaImpuestos').show();else $('#aplicaImpuestos').hide();
	getImpuestos()
}
function cambiaProfesional()
{
	$.getJSON('index.php?r=pagos/getPendientes',{id:$('#Pagos_idProfesional').val()}, function(data) {
	items=new Array();
 	for(var i=0;i<data.length;i++)items.push(data[i]);
 	mostrarItems();
});
}
function getImpuestos()
{
	var arr=new Array();
	$('.impuestos').each(function() {
	var aux=new Object();
	aux.idImpuesto=$(this).attr('data');
	aux.importe=$(this).val();
	arr.push(aux);
});
	return arr;
}
function ingresar()
{
	$('#btnAceptar').hide();

	$.getJSON('index.php?r=pagos/agregar',{items:items,importe:$('#Pagos_importe').val(),impuestos:getImpuestos(),noAplicaImpuestos:$('#noAplicaImpuestos').val(),fecha:$('#Pagos_fecha').val(),idProfesional:$('#Pagos_idProfesional').val()}, function(data) {
		if(!data.valido)
			alert(data.error);
			else
					window.location.replace('index.php?r=pagos/create&id='+data.idProfesional);
			
		$('#btnAceptar').show();
});
}
function mostrarItems()
{
	$('#items').html('');
	console.log(items);
	var importe=0;
	for(var i=0;i<items.length;i++){
		var color=items[i].importe<0?'#ff4747':'#000';
		var item=$('#items').html()+'<tr style="color:'+color+'" id="fila_'+items[i].id+'"><td>'+items[i].detalle+'</td><td>'+items[i].tipo+'</td><td>'+precio(items[i].importe)+'</td><td><img style="cursor:pointer" src="images/iconos/famfam/cancel.png" onclick="quitar('+items[i].id+')"</td></tr>';
 		importe+=Number(items[i].importe)+0;
 		$('#items').html(item);
	}
	$('#Pagos_importe').val(importe);
	$('#importeTotal').html('TOTAL '+precio(importe));
}
function quitar(id)
{
      $('#fila_'+id).remove();
      quitar_(id);
       mostrarItems();
}
function quitar_(id)
{
      for (var i = 0; i < items.length; i++)
            if(items[i].id==id)
                  items.splice( i, 1 );
}

</script>


