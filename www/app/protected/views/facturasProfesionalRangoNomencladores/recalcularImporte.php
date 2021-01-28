<h1>RECALCULAR IMPORTE <small> de facturas cargadas</small></h1>
<i>Estas son las facturas pendientes de facturacion que se encuentran en el rago de facturas:</i><br><br>

<script>facturas=[]</script>
<table class="table table-condensed">
<tr><th>PROFESIONAL</th><th>OS</th><th>FECHA CONSULTA</th><th>NOMENCLADOR</th><th>COD.INT</th><th>$ IMPORTE</th><th>$ NUEVO</th></tr>
<?php $totImporte=0;$totNuevo=0; foreach ($model as $key => $value) {
$nuevoImporte=$this->nuevoImporte($value,$idRangoNuevo); 
$totImporte+=$value->importe;
$totNuevo+=$nuevoImporte;
?>
<tr>
	<td><?=isset($value->profesional)?$value->profesional->nombreProfesionales:"s/n"?></td>
	<td><?=isset($value->obraSocial)?$value->obraSocial->nombreOs:"s/n"?></td>
	<td><?=$value->fechaConsulta?></td>
	<td><?=substr(utf8_decode(isset($value->nomenclador)?$value->nomenclador->detalle:"s/n"),0,80)."..."?></td>
	<td><?=$value->nomenclador->codigoInterno;?> </td>
	<td><?=$value->importe?>  <?=($value->esDoble?"(2)":"")?><span class="label label-warning"><?=($value->extras)?></span></td>
	
	<td><?=$nuevoImporte?> </td></tr>
<script>facturas.push({idFactura:<?=$value->id?>,importeNuevo:<?=$nuevoImporte?>})</script>
<?php }?>
<tr><th></th><th></th><th></th><th></th><th></th><th><?=number_format($totImporte,2)?></th><th><?=number_format($totNuevo,2)?></th></tr>
</table>
<button class="btn btn-success" style="width: 100%" onclick="cargarCambios()"><b>ACEPTAR</b> Y CAMBIAR IMPORTES</button>
<script >
Array.prototype.chunk = function(groupsize){
    var sets = [], chunks, i = 0;
    chunks = this.length / groupsize;

    while(i < chunks){
        sets[i] = this.splice(0,groupsize);
	i++;
    }
	
    return sets;
};
function cargarCambios()
{
	var arr=facturas.chunk(30);
	console.log(arr)
	var cantidadHojas=arr.length;
	$.blockUI({ message: '<h1><img src="images/loader.gif" /> Espere un momento por favor, cargando HOJAS...</h1>' }); 
	for (var i=0;i<arr.length;i++) cargar_(arr[i],i,cantidadHojas );
	
}
function cargar_(data,nroHoja,cantidadHojas)
{
	console.log(data)
	$.blockUI({ message: 'CARGANDO HOJA '+nroHoja });
	 $.getJSON("index.php?r=facturasProfesional/modificarFacturas",{facturas:data},function(res){
     if( (nroHoja+1)==cantidadHojas){
     	$.unblockUI();
      	location.reload();
     }
      
    })
}
</script>