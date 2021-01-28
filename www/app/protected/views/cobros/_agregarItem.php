<div style="position:absolute;background:white"  id="agregadorItems">
	

<form class="form-search"> 
<?php $this->widget('ext.2select.ESelect2',array(

  'htmlOptions'=>array ('style'=>'width:240px','placeholder'=>'Seleccione el Profesional...','autoClear'=>true,),
  'id'=>'idProfesional',
  'name'=>'idProfesional',
  'options'=>array(
    'allowClear'=>true,
  ),
  'data'=>CHtml::listData(Profesionales::model()->findAll(), 'id', 'nombreProfesionales'))
); ?>

<?php echo CHtml::dropDownList('idTipo','',CHtml::listData(CobrosTipos::model()->buscarTipos(), 'id', 'nombreTipoCobro'),array ('onchange'=>'cambiaTipo()','style'=>'width:110px;',"prompt"=>"Seleccione ...")); ?>
<input id='detalle' class='span3' type="text" placeholder="Detalle">
<input  id='importe' class='span1' type="text" placeholder="Importe">
<button class="btn btn-small" onclick='agrega()' type="button">Agregar</button>
</form>
</div>
<script>
$('#importe').keypress(function(e) {
    if(e.which == 13) {
        agrega();
    }
});
function cambiaTipo()
{
	$('#importe').focus();
}
function validate(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
function agrega()
{
	
	if(($("#idProfesional").val()!='')&&($("#idTipo").val()!='')&&($("#importe").val()!=''))
			ingresa();
	else alert('Hay datos que faltan!.. seleccione y luego vuleva a intentar');
}
function ingresa()
{
	var textoTipo=$("#idTipo option:selected").text();
	var data=new Object();
	data.profesional=$("#idProfesional option:selected").text();
	data.importe=-$('#importe').val();
	data.idTipo=$('#idTipo').val();
	data.detalle=$('#detalle').val();
	data.idProfesional=$("#idProfesional").val();
	data.tipo=$("#idTipo option:selected").text();
	data.estado='PENDIENTE';
	data.esNuevo=true;
	if(textoTipo.search('Credito')!= -1)data.importe=-data.importe;
	if(textoTipo.search('Cobro')!= -1)data.importe=-data.importe;
	data.id=proximo;
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
	$("#agregadorItems").attr("style","position:absolute;top:130px");

}
</script>