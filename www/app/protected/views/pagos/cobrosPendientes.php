<h3><b>COBROS </b> <small>Pendientes</small> <a class="btn btn-success"  onclick="consultarCobrosPendientesPan()"></a></h3>
<table class="table table-condensed">
<tr><th>O.S</td><th style="text-align:right;width:90px">Importe</td></tr>
<tbody id='itemsCobros'></tbody>
</table>
<a class="btn btn-success" style="width:100%" onclick="consultarPagoProfesional()">BUSCAR PAGOS</a>
<script>
//consultarCobrosPendientes();
  itemsSeleccionCobros=[];
	noRetienen=false;
	init();

	function init()
	{
		 consultarCobrosPendientesPan()
	}
	function quitarSel(id)
	{
		itemsSeleccionCobros.splice(posSeleccion(id),1);
	}
	function posSeleccion(id)
	{
		for(var i=0;i<itemsSeleccionCobros.length;i++)
			if(itemsSeleccionCobros[i].id==id)return i;
		return -1;
	}
  function cambiaFila(id,retiene,esUsuario){
    $( "#fila_"+id ).toggleClass( "seleccionado" );
    if(posSeleccion(id)==-1) itemsSeleccionCobros.push({id:id,retiene:retiene});
     else quitarSel(id)
    
checkNoRetienen(esUsuario)
  }
 
function checkRet()
	{
		for(var i=0;i<itemsSeleccionCobros.length;i++)
			if(itemsSeleccionCobros[i].retiene==0)return false;
		if(itemsSeleccionCobros.length==0)return false;
		return true;
	}
	function checkNoRetienen(esUsuario)
	{
		if(esUsuario)
		if(checkRet()){
			swal("AUTOSELECCION RETENCION","Los cobros seleccionados pertenecen a OBRAS SOCIALES que no retienen, por lo tanto se auto tilda la NO RETENCION","warning");
			$("#noRetiene").attr("checked","checked")
		}else $("#noRetiene").removeAttr("checked")
	}
function consultarCobrosPendientesPan()
{
noRetienen=false;
console.log("consltando data")
		$.getJSON('index.php?r=cobros/getCobrosPendientes',{}, function(data) {
			console.log(data)
	$('#itemsCobros').html("No hay Cobros pendientes de liquidar!");
 	for(var i=0;i<data.length;i++){
    var item=$('#itemsCobros').html()+'<tr onclick="cambiaFila('+data[i].id+','+data[i].noRetiene+',true)" style="" id="fila_'+data[i].id+'"><td><small>'+data[i].os+'</small></td><td style="text-align:right">'+precio(data[i].importe)+'</td></tr>';
 		
 		$('#itemsCobros').html(item);
		cambiaFila(data[i].id*1,data[i].noRetiene*1,false);
    
  }
			checkNoRetienen(true)
     consultarPagoProfesional(); 
 	
});
	
	
}
</script>