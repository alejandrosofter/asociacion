<div class="row">
<script>
	var itemsModifica=[];
	function addItemModifica(id)
	{
		itemsModifica.push(id);
	}
</script>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cobros-form',
	'enableAjaxValidation'=>false,
	'focus'=>array($model,'detalle')
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
<div class='span3'>
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
	<div class="">
		<?php $this->widget('ext.2select.ESelect2',array(
  'name'=>"idObraSocial",
  "value"=>$idObraSocial,
  'htmlOptions'=>array ('style'=>'width:100%','onchange'=>'cambiaObraSocial()'),
  'attribute'=>'idObraSocial',
  'options'=>array(
  	'placeholder'=>'Seleccione O.S...',
  	'allowClear'=>true
  	),
  'data'=>CHtml::listData(ObrasSociales::model()->findAll(array('order'=>'nombreOs')), 'id', 'nombreOs'))
); ?>
	
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'bancoEmisor',array('class'=>'')); ?>
		<?php echo $form->textField($model,'bancoEmisor',array('class'=>'span3')); ?>
		<?php echo $form->error($model,'bancoEmisor'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'formaPago',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'formaPago',Cobros::model()->getFormaPagos(),array ('style'=>'width:300px;',"prompt"=>"Seleccione ...")); ?>
		<?php echo $form->error($model,'formaPago'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'nroOperacion',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nroOperacion',array('class'=>'span2')); ?>
		<?php echo $form->error($model,'nroOperacion'); ?>
	</div>
<div class="">
		<?php echo $form->labelEx($model,'importeDebitos',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importeDebitos',array('class'=>'span1')); ?>
		<?php echo $form->error($model,'importeDebitos'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'importe',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importe',array('class'=>'span2')); ?>
		<?php echo $form->error($model,'importe'); ?>
	</div>
	<div id="itemsSeleccion">
		<?php for ($i=0; $i < count($items) ; $i++) { ?>
			<script>addItemModifica(<?=$items[$i]['id']?>);</script>
			<input type="HIDDEN" name="items[<?=$i;?>]" type="" value="<?=$items[$i]['id']?>"/>
		<?php }?>
	</div>
	
<div class="">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-success','style'=>'width:100%')); ?>
	</div>
</div>
<div class='span8'>
<h3>FACTURAS <small>A LIQUIDAR</small></h3>
<table class="table table-condensed">
<thead><tr><th>FECHA</th><th>NRO FACTURA</th><th>DETALLE</th><th style="text-align:left">Importe</th></tr></thead>
<tbody id='items'></tbody>
</table>
	<h2 class='pull-right' id='importeTotal'></h2>

	
	</div>

</div>
		
</div><!-- form -->



<?php $this->endWidget(); ?>
<script>
	itemsFacturaSeleccion=[];
	var items=[];
	
	$( document ).ready(function() {
    buscarFacturas();
	});
	function valido()
	{
		if(itemsFacturaSeleccion.length==0)return false;
		return true;
	}
	function muestraData(data)
	{
		var salida="";
	  for(var i=0;i<data.length;i++){
	    var detalle=data[i].detalle==''?'Factura sin detalle '+data[i].fecha:data[i].detalle;
	    var item='<tr  class="itemsCobro" id="itemCobro_'+data[i].id+'">';
	    var nroFactura=data[i].facturaElectronica?data[i].facturaElectronica.nroFactura:"-";
	    item+="<td>"+data[i].fecha+"</td>";
	    item+="<td>"+nroFactura+"</td>";
	    item+='<td  style="cursor:pointer;color:blue" onclick="clickFactura('+data[i].id+')">'+data[i].detalle+"</td>";
	    item+="<td>"+data[i].importe+"</td>";
	    item+="</tr>";
	    salida+=item;
			
	  }
		return salida;
	}
	function seleccionaModifica()
	{
		for(var i=0;i<itemsModifica.length;i++)
			agregarItemSeleccion(itemsModifica[i]);
		mostrarSelecciones();

	}
	function estaFacturaSeleccionada(id)
	{
		for(var i=0;i<itemsFacturaSeleccion.length;i++)
			if(itemsFacturaSeleccion[i].id==id)return true;
		return false;
	}
	function getIndex(arr,id)
	{
		for(var i=0;i<arr.length;i++)
			if(arr[i].id==id)return i;
		return null;
	}
	function contarTotales()
	{
		var sum=0;
		for(var i=0;i<itemsFacturaSeleccion.length;i++)
			sum+=itemsFacturaSeleccion[i].importe*1;
		$("#Cobros_importe").val(sum);
	}	
	function quitarItemSeleccion(id)
	{
		var i=getIndex(itemsFacturaSeleccion,id);
		itemsFacturaSeleccion.splice(i,1);
		console.log(itemsFacturaSeleccion)
	}
	function agregarItemSeleccion(id)
	{
		var i=getIndex(items,id);
		itemsFacturaSeleccion.push(items[i]);
		console.log(itemsFacturaSeleccion)
	}
	function agregarParaPost()
	{
		$("#itemsSeleccion").html("");
		var sal="";
		for(var i=0;i<itemsFacturaSeleccion.length;i++)
			sal+="<input type='HIDDEN' name='items["+i+"][id]' value='"+itemsFacturaSeleccion[i].id+"'>";
		$("#itemsSeleccion").html(sal);
	}
	function mostrarSelecciones()
	{
		$(".itemsCobro").removeClass("seleccionado");
		for(var i=0;i<itemsFacturaSeleccion.length;i++)
			$("#itemCobro_"+itemsFacturaSeleccion[i].id).addClass("seleccionado");
	}
	function clickFactura(id)
	{
		if(!estaFacturaSeleccionada(id))
			agregarItemSeleccion(id);else quitarItemSeleccion(id);
		
		contarTotales();
		agregarParaPost();
		mostrarSelecciones();
	}
	function buscarFacturas()
	{
		itemsFacturaSeleccion=[];
		//$.blockUI({ message: '<h1><img src="images/loader.gif" /> Buscando ...</h1>' }); 
		
	  $.getJSON('index.php?r=facturasObrasSocial/getPendientes',{id:$('#idObraSocial').val()}, function(data) {
	    $('#facturas').html('');
	    	items=data;
			if(data){
				//var salida=muestraData(data);
			// 		if(data.length==0)salida+='<tr ><td><i><small>No hay facturas pendientes de cobro!</small></i></td></tr>';
			 
			// salida+="</table>'";
			$('#items').html(muestraData(items));
			seleccionaModifica()
				//resetItems();
			}
			
			$.unblockUI();
	});
	}
	function cambiaObraSocial()
	{
		buscarFacturas();
	}
	function resetItems()
	{
		$('#items').html('');
		$("#Cobros_importe").val(0);
		$("#Cobros_importeDebitos").val(0);
	}
function ingresar()
{
	 $.blockUI({ message: '<h1><img src="images/loader.gif" /> Espere un momento por favor...</h1>' }); 

	  $.post('index.php?r=facturasObrasSocial/agregar',{cargarOtro:true,items:items,importe:$('#Cobros_importe').val(),fecha:$('#Cobros_fecha').val(),idFactura:$('#CobrosObrasSociales_idFactura').val(),idObraSocial:$('#CobrosObrasSociales_idObraSocial').val()}, function(data) {
		console.log(data);
			if(data.valido)
			window.location.replace('index.php?r=cobros/create');
			else {
				$.unblockUI();
				alert(data.error);
				
			}
},"json");
 
	

	
}

</script>
