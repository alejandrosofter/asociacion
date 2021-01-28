<div class="">
		<?php echo $form->labelEx($model,'idObraSocial',array('class'=>'')); ?>
		<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:200px','onchange'=>'cambiaObraSocial()'),
  'attribute'=>'idObraSocial',
  'options'=>array(
  	'placeholder'=>'Seleccione...',
  	'allowClear'=>true
  	),
  'data'=>CHtml::listData(ObrasSociales::model()->findAll(array('order'=>'nombreOs')), 'id', 'nombreOs'))
); ?>
		<?php echo $form->error($model,'idObraSocial'); ?>
	</div>

		<?php echo $form->textField($model,'idFactura',array('TYPE'=>'hidden')); ?>
<script>
function cambiaObraSocial()
{
	buscarFacturas();
}
function buscarFacturas()
{
	itemsFacturaSeleccion=[];
	$.blockUI({ message: '<h1><img src="images/loader.gif" /> Buscando ...</h1>' }); 
	
  $.getJSON('index.php?r=facturasObrasSocial/getPendientes',{id:$('#CobrosObrasSociales_idObraSocial').val()}, function(data) {
    $('#facturas').html('');
		if(data){
			var salida="<table class='table table-condensed'><tr><th>FACTURAS PENDIENTES ("+(data.length)+")</th></tr>";
  for(var i=0;i<data.length;i++){
    var detalle=data[i].detalle==''?'Factura sin detalle '+data[i].fecha:data[i].detalle;
    var item='<tr class="itemsCobro" id="itemCobro_'+data[i].id+'"><td><a style="cursor:pointer" onclick="clickFactura('+data[i].id+')">'+detalle+'</a></td></tr>';
    salida+=item;
		
  }
		if(data.length==0)salida+='<tr ><td><i><small>No hay facturas pendientes de cobro!</small></i></td></tr>';
		 
		salida+="</table>'";
		$('#facturas').html(salida);
			resetItems();
		}
		
		$.unblockUI();
});
}
var items=new Array();
var proximo=0;
	function resetItems()
	{
		$('#items').html('');
		$("#Cobros_importe").val(0);
	}
	
function clickFactura(id)
{
	$('.itemsCobro').removeClass("seleccionado");
	$("#itemCobro_"+id).addClass("seleccionado");
	buscarItems(id);
}
function buscarItems(id)
{
	itemsFacturaSeleccion=[];
  items=new Array();
  $('#CobrosObrasSociales_idFactura').val(id);
		$.blockUI({ message: '<h1><img src="images/loader.gif" /> Buscando  ...</h1>' });
  $.getJSON('index.php?r=facturasObrasSocialItems/getPendientes',{idFactura:id}, function(data) {
		itemsFacturaSeleccion=data;
    $('#items').html('');
    var importe=0;
  for(var i=0;i<data.length;i++){
    data[i].id=proximo;
    proximo++;
    items.push(data[i]);
  }
    
  mostrarItems();
  $.unblockUI();
  
});
}
Array.prototype.sortBy = function() {
    function _sortByAttr(attr) {
        var sortOrder = 1;
        if (attr[0] == "-") {
            sortOrder = -1;
            attr = attr.substr(1);
        }
        return function(a, b) {
            var result = (a[attr] < b[attr]) ? -1 : (a[attr] > b[attr]) ? 1 : 0;
            return result * sortOrder;
        }
    }
    function _getSortFunc() {
        if (arguments.length == 0) {
            throw "Zero length arguments not allowed for Array.sortBy()";
        }
        var args = arguments;
        return function(a, b) {
            for (var result = 0, i = 0; result == 0 && i < args.length; i++) {
                result = _sortByAttr(args[i])(a, b);
            }
            return result;
        }
    }
    return this.sort(_getSortFunc.apply(null, arguments));
}

function mostrarItems()
{
	$('#items').html('');
	items=items.sortBy('profesional');
	var importe=0;
	for(var i=0;i<items.length;i++){
		var color=items[i].importe<0?'#ff4747':'#000';
    var esNuevo=items[i].esNuevo?"<img style='cursor:pointer' src='images/iconos/famfam/0.png' onclick='quitar("+items[i].id+")'></img>":"";   
		var item=$('#items').html()+'<tr style="color:'+color+'" id="fila_'+items[i].id+'"><td  class="filaProfesionalLiquidar" idProf='+items[i].id+' style="cursor:pointer" onclick="seleccionarProfesional('+items[i].idProfesional+')">'+items[i].profesional+'</td><td>'+items[i].tipo+' '+(items[i].detalle!=null?items[i].detalle:"")+'</td><td style="cursor:pointer" onclick="editarItem('+items[i].id+')" style="text-align:right"> '+precio(items[i].importe)+'</td><td>'+esNuevo+'</td></tr>';
 		importe+=parseFloat(items[i].importe)+0;
 		$('#items').html(item);
	}
	$(".filaProfesionalLiquidar").click(function(e){
    var x = e.pageX;
    var y = e.pageY;
		console.log("y: "+y);
	console.log("x: "+x);
		$("#agregadorItems").css("top", y);
    $("#agregadorItems").css("left", x);
});
	$('#Cobros_importe').val(importe);
	$('#importeTotal').html('TOTAL '+precio(importe));
}
function getDebitos(idProfesional)
{
	return 0;
}
	
function seleccionarProfesional(idProfesional)
{
   $("#idProfesional").select2("val", idProfesional);
	// $("#agregadorItems").attribute("style","position:absolute");
	
   openSelect('#idTipo'); 
}
var openSelect = function(selector){
     var element = $(selector)[0], worked = false;
    if (document.createEvent) { // all browsers
        var e = document.createEvent("MouseEvents");
        e.initMouseEvent("mousedown", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
        worked = element.dispatchEvent(e);
    } else if (element.fireEvent) { // ie
        worked = element.fireEvent("onmousedown");
    }
    if (!worked) { // unknown browser / error
        alert("It didn't worked in your browser.");
    }   
}
function editarItem(id)
{
    var importe=prompt("Por favor ingrese el nuevo Importe",getImporte(id));
    if(importe!=null)
      editarItem_(id,importe);
       mostrarItems();
}
function getImporte(id)
{
  for (var i = 0; i < items.length; i++)
            if(items[i].id==id)return items[i].importe;
  return 0;
}
function editarItem_(id,importe)
{
   for (var i = 0; i < items.length; i++)
            if(items[i].id==id)items[i].importe=importe;
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

<div id='facturas'>
<i>No hay facturas</i>
</div>