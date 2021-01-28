<form class="form-search"> 
<?php echo CHtml::dropDownList('idTipo','',CHtml::listData(CobrosTipos::model()->findAll(), 'id', 'nombreTipoCobro'),array ('onchange'=>'cambiaTipo()','class'=>'span3','onchange'=>'cambiaTipo()','style'=>'width:160px;',"prompt"=>"Seleccione ...")); ?>
<input id='importe' class='span2' type="text" placeholder="Importe">

<input id='detalle'  class='span3' type="text" placeholder="Detalle">
<button class="btn btn-small" onclick='agregar()' type="button">Agregar</button>
</form>
<script>
$('#importe').keypress(function(e) {
    if(e.which==13)agregar();
});
$('#detalle').keypress(function(e) {
    if(e.which==13)agregar();
});
function cambiaTipo()
{
	$('#importe').focus();
}
function mostrarDetalle()
{
	$('#detalle').show();
	$('#etiquetaDetalle').hide();
}
function agregar()
{
	var data=new Object();
	data.importe=-$('#importe').val();
	var textoTipo=$("#idTipo option:selected").text();
	if(textoTipo.search('Credito')!= -1)data.importe=-data.importe;
	if(textoTipo.search('Cobro')!= -1)data.importe=-data.importe;
	data.detalle=$("#detalle").val();
	
	data.idTipo=$('#idTipo').val();
	data.tipo=$('#idTipo option:selected').text();
	data.id=proximo;
	data.idItem=0;
 	proximo++;
	items.push(data);
	mostrarItems();
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