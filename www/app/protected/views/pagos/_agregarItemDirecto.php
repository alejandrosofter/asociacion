<form id='formAgrega' class="form-search"> 

<?php echo CHtml::dropDownList('idTipo','',CHtml::listData(CobrosTipos::model()->findAll(), 'id', 'nombreTipoCobro'),array ('class'=>'span3','onchange'=>'cambiaTipo()','style'=>'width:160px;',"prompt"=>"Seleccione ...")); ?>
<input id='importe' class='span2' type="text" placeholder="Importe">
<span id='etiquetaDetalle' style='cursor:pointer' onclick='mostrarDetalle()'>Detalle</span>
<input id='detalle' style="display:none" class='span3' type="text" placeholder="Detalle">
<button class="btn btn-small" onclick='agregar()' type="button">Agregar</button>
</form>
<script>
var proximo=0;
function mostrarDetalle()
{
	$('#detalle').show();
	$('#etiquetaDetalle').hide();
}
function cambiaTipo()
{
	$('#importe').focus();
}
function agregar()
{
	var data=new Object();
	data.detalle=$("#detalle").val();
	data.importe=-$('#importe').val();
	data.idTipo=$('#idTipo').val();
	var textoTipo=$("#idTipo option:selected").text();
	if(textoTipo.search('Credito')!= -1)data.importe=-data.importe;
	if(textoTipo.search('Cobro')!= -1)data.importe=-data.importe;
	data.idProfesional=idProfesionalSeleccionado;
	data.tipo=$('#idTipo option:selected').text();
	if(data.detalle=='')data.detalle=$('#idTipo option:selected').text();
	data.id=proximo;
	data.idItem=0;
 	proximo--;
	itemsAgregado.push(data);
	mostrarItems();
	cargarProfesionales();
	$('#detalle').hide();
	$('#etiquetaDetalle').show();
	console.log(itemsProfesionales);
	reset();
}

function reset()
{
	$('#detalle').val('');
	$('#idTipo').val('');
	$('#importe').val('');
	$('#idTipo').focus();
}
</script>