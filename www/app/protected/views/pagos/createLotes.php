
<div class="row">
<div class="span3">

	<?=$this->renderPartial('cobrosPendientes',array("pendientes"=>$pendientes));?>

	</div>

<div class="span8"><h3><b>PROFESIONALES </b> <small>para cobrar</small></h3>

	<?=$this->renderPartial('profesionalesCobrar');?>

	<div class= "form-actions">

		<a id='btnAceptar' style="width:100%" class="pull-right btn btn-primary" onclick='ingresar()' >LIQUIDAR</a>
		<br><br>
		<span class='pull-right'>No ingresar Retenciones <input id='noRetiene' type='checkbox'/> </span>
		<span class='pull-right'>Fehca de Liquidacion <input value="<?=Date('d-m-Y')?>" id='fechaLiquidacion' type='input'/> </span>

		
	</div>


</div>
	
</div>



	<script>
	var itemsProfesionales=new Array();
var idProfesionalSeleccionado=0;
//cargarProfesionales();
$('#formAgrega').keypress(function(e) {
    if(e.which==13)agregar();
});
function seleccionar(id,prof)
{
	idProfesionalSeleccionado=id;
	$('#nombreProfesional').html(prof+"<small> Edición de Items</small>");
	cargar();
}

function cargarProfesionales()
{
	 
	itemsProfesionales=new  Array();
	
	if(false)
	$.getJSON('index.php?r=cobrosItems/getPendientes', function(items) {
		$('#btnAceptar').show();
 		$('#cargador').hide();
	for(var i=0;i<items.length;i++){
		itemsProfesionales.push(items[i]);
		var debitos=getDebitos(items[i].idProfesional)+parseFloat(items[i].debitos);
		var creditos=getCreditos(items[i].idProfesional)+parseFloat(items[i].creditos);
		var item=$('#itemsProfesionales').html()+'<tr id="profesional_'+items[i].idProfesional+'"><td><b>'+items[i].profesional+'</b></td><td>'+items[i].condicionIva+'</td><td>'+items[i].regimen+'</td><td style="color:red;text-align: right">'+precio(debitos)+'</td><td style="color:green;text-align: right">'+precio(creditos)+'</td><td><a onclick="seleccionar('+items[i].idProfesional+',\''+items[i].profesional+'\')" class="mostrarItems" href="#itemsCobros"><img title="Editar" src="images/iconos/famfam/pencil.png"/></a> <img style="cursor:pointer" title="Quitar al profesional" onclick="quitarProfesional('+items[i].idProfesional+')"  src="images/iconos/famfam/cancel.png"/> <a class="mostrarItems"  data-fancybox-type="iframe" href="index.php?r=pagos/calculaRetencion&id='+items[i].idProfesional+'"><img  title="Ver Retencion" src="images/iconos/famfam/asterisk_yellow.png"/></a> </td></tr>';
 		
 		$('#itemsProfesionales').html(item);
	}
	if(items.length==0){
		alert('No hay pendientes para facturar!');
		$('#btnAceptar').hide();
	}
});
	
}

function getCreditos(idProfesional)
{
	tot=0;
	for(var i=0;i<itemsAgregado.length;i++)
		if(itemsAgregado[i].idProfesional==idProfesional && parseFloat(itemsAgregado[i].importe)>0)
			tot+=parseFloat(itemsAgregado[i].importe);

	return tot;
}
function quitarProfesional(id)
{
	var r=confirm("Realmente desea quitar al profesional de la lista? (al hacerlo lo puede liquidar en otro momento)")
if (r==true)
  {
  _quitarProfesional(id)
  }
}
function _quitarProfesional(id)
{
	for (var i = 0; i < itemsProfesionales.length; i++)
            if(itemsProfesionales[i].idProfesional==id)
                  itemsProfesionales.splice( i, 1 );
    $('#profesional_'+id).remove();
}
function getDebitos(idProfesional)
{
	tot=0;
	for(var i=0;i<itemsAgregado.length;i++)
		if(itemsAgregado[i].idProfesional==idProfesional && parseFloat(itemsAgregado[i].importe)<0)
			tot+=parseFloat(itemsAgregado[i].importe);

	return tot;
}
		function valido()
		{
			var res=false;
			if(itemsSeleccionCobros.length>0)res= true;
			if(itemsResultados.length>0)res= true;
			return res;
		}
		function ripItemsSeleccion()
		{
			var arr=[];
			for(var i=0;i<itemsSeleccionCobros.length;i++)arr.push(itemsSeleccionCobros[i].id);
			return arr;
		}
function ingresar()
{
	if(valido()){
		$.blockUI({ message: '<h1><img src="images/loader.gif" /> Espere un momento por favor...</h1>' }); 
	var arr=ripItemsSeleccion();
	$.post('index.php?r=pagos/agregarLote',{items:itemsResultados,cobrosSeleccionados:arr,noRetiene:$('#noRetiene').is(':checked')?1:0,fecha:$("#fechaLiquidacion").val()}, function(data) {
		$.unblockUI();
		 itemsSeleccionCobros=[];
consultarCobrosPendientesPan();
		  
 });
	}else swal("Ops...","Hay errores, chequea que hayas seleccionado algun COBRO!!","error");
	
}

</script>