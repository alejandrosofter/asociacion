<h1 id='nombreProfesional'></h1>
<?=$this->renderPartial('_agregarItemDirecto');?>
<!-- <table class="table table-condensed">
<tr><th>Detalle</th><th>Tipo</td><th style="text-align:right">Importe</td></tr>
<tbody id='items'></tbody>
</table> -->

<script>
var items=new Array();
var itemsAgregado=new Array();

function cargar()
{
	if(idProfesionalSeleccionado!=0){
		$.getJSON('index.php?r=pagos/getPendientes',{id:idProfesionalSeleccionado}, function(data) {
	items=new Array();
 	for(var i=0;i<data.length;i++)items.push(data[i]);
 	mostrarItems();
});
	}
	
}
function modificarDetalle(id,detalle)
{
	var item=prompt("Modificar el Detalle",detalle);
	if (item!=null && item!="")_modificaTipo(id,item,'detalle');
}
function _modificaTipo(id,valor,campo)
{
	$.getJSON('index.php?r=cobrosItems/modificarItem',{id:id,campo:campo,value:valor}, function(data) {
 	cargar();
});
}
function modificarImporte(id,importe)
{
	var item=prompt("Modificar el $ Importe (al modificar el importe, se modificara el importe del cobro asociado)",importe);
	if (item!=null && item!="")_modificaTipo(id,item,'importe');
}
function mostrarItems()
{
	$('#items').html('');
	var importe=0;
	for(var i=0;i<items.length;i++){
		var color=items[i].importe<0?'#ff4747':'#000';
		var item=$('#items').html()+'<tr style="color:'+color+'" id="fila_'+items[i].id+'"><td style="cursor:pointer" onclick="modificarDetalle('+items[i].id+',\''+items[i].detalle+'\')">'+items[i].detalle+'</td><td>'+items[i].tipo+'</td><td onclick="modificarImporte('+items[i].id+',\''+items[i].importe+'\')" style="cursor:pointer;text-align:right">'+precio(items[i].importe)+'</td><td><img style="cursor:pointer" src="images/iconos/famfam/cancel.png" onclick="quitar('+items[i].id+')"</td></tr>';
 		importe+=Number(items[i].importe)+0;
 		$('#items').html(item);
	}
	mostrarAgregado();
}
function mostrarAgregado()
{
	for(var i=0;i<itemsAgregado.length;i++)
	if(idProfesionalSeleccionado==itemsAgregado[i].idProfesional){
		var color=itemsAgregado[i].importe<0?'#ff4747':'#000';
		var item=$('#items').html()+'<tr style="color:'+color+'" id="fila_'+itemsAgregado[i].id+'"><td>'+itemsAgregado[i].detalle+'</td><td>'+itemsAgregado[i].tipo+'</td><td style="text-align:right">'+precio(itemsAgregado[i].importe)+'</td><td><img style="cursor:pointer" src="images/iconos/famfam/cancel.png" onclick="quitar('+itemsAgregado[i].id+')"</td></tr>';
 		
 		$('#items').html(item);
	}
}
function quitar(id)
{
      if(id<=0){
      	quitarItemAgregado(id);
      	}else{
      		var r=confirm("Realmente desea quitar este item? Al hacerlo quitara el item realizado en el cobro");
			if (r==true)quitarPermanente(id);
      	}

      cargarProfesionales();
}
function quitarPermanente(id)
{
	$.getJSON('index.php?r=cobrosItems/quitar',{id:id}, function(data) {
	  		$('#fila_'+id).remove();
			});
}
function quitarItemAgregado(id)
{
	for (var i = 0; i < itemsAgregado.length; i++)
            if(itemsAgregado[i].id==id)
                  itemsAgregado.splice( i, 1 );
    $('#fila_'+id).remove();
}
</script>
