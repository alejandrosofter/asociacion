<?php
$this->breadcrumbs=array(
	'Cobros'=>array('/cobros'),
	'Items del Cobro',
);
$this->menu=array(
	array('label'=>'Nuevo CobrosItems', 'url'=>array('create')),
);
?>

<header id="page-header">
	<br>
<h1 id="page-title">ITEMS DEL COBRO</h1>
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
<input type="number"  id='importe' class='span1' type="text" placeholder="Importe">
<button class="btn btn-small" onclick='agrega()' type="button">Agregar</button>
</form>
</div>

<br><br>
</header>
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
	ingresa_();
	reset();
}
function ingresa_()
{
	 $.blockUI({ message: '<h1><img src="images/loader.gif" /> Espere un momento por favor...</h1>' }); 
	  $.get('index.php?r=cobrosItems/agregar',getData(), function(data) {
			
			window.location.replace('index.php?r=cobrosItems/index&id=<?=$_GET['id']?>');
			
},"json");
 
	

	
}
function getData()
{
	return {idCobro:<?=$_GET['id']?>,detalle:$('#detalle').val(),idTipoItem:$('#idTipo').val(),idProfesional:$('#idProfesional').val(),importe:$('#importe').val()};
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
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cobros-items-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'profesional.nombreProfesionales',
		'tipo.nombreTipoCobro',
		array(
            'type'=>'html',
            'header'=>'Importe',
            'value'=>'"<strong>$ ".Yii::app()->numberFormatter->formatCurrency($data->importe,"")."</strong>"',
            'htmlOptions'=>array('style'=>'width: 90px;text-align: right'),
            ),
		
		'estado',
		'detalle',
		array(
			'class'=>'CButtonColumn','template'=>'{update} {delete}',
				
		),
	),
)); ?>
<script>
function cargarItems()
{

      $.get('index.php?r=cobros/asignarItems',{idCobro:<?=$idCobro?>}, function(data) {
        console.log(idCobro);
            window.location.replace('index.php?r=cobrosItems/index&id=<?=$idCobro?>');
            
});
 
    

}
</script>