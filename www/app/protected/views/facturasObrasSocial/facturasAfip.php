<script>var facturas=[];</script>
<style>
.finalizada{
color:#57a957;
}
.procesando{
	color:#80808057;
}
.errorAfip{
	color:#ff0c0c;
}

</style>
<div style="padding:20px">
	<table class="table table-condensed">
	<?php if(count($data)==0){?>
		<h3 style="color:orange">NO HAY DATOS DE FACTURAS EN ESE PERIODO</h3>
	<?php }else{?>
	<thead> <tr><th style="text-align: left">CUIT</th><th>OBRA SOCIAL</th><th>DETALLE</th><th>VTO PAGO</th><th>FE</th><th style="text-align: right">IMPORTE</th> <th></th></tr></thead>
	<tbody>
	<?php $sum=0; foreach($data as $item) if(!$item->tieneElectronica()){ $sum+=$item->importe;?>
	<tr class="filas" id="<?=$item->id;?>"><td style="text-align: left"><?=$item->getCuitAfip();?></td><td title="<?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$item->fecha);?>"><?=$item->obraSocial->nombreOs;?></td><td id="detalle_<?=$item->id;?>"><?=$item->detalle;?></td><td ><?=$item->formFechaVto()?></td><td id="fe_<?=$item->id;?>"><?=$item->tieneFacturaElectronica();?></td><td style="text-align: right"><?=number_format($item->importe,2);?></td>
		<td><a href="#" id="btnFactura" onclick="facturaIndividual(<?=$item->id?>)"  type="button" class="btn btn-xs btn-success fas fa-check-circle-circle"> <i class="fas fa-check-circle"></i></a>  </td>
	</tr>
	<script>if(<?=$item->tieneElectronica();?>==0)facturas.push(<?=$item->id?>)</script>
		<?php }?>

		</tbody>
		<thead> <tr><th></th><th></th><th></th><th></th><th style="text-align: right">TOTAL</th><th style="text-align: right"><?=number_format($sum,2);?></th></tr></thead>
	</table>
	<!-- <a class="btn btn-primary" role="button" id="btnAceptar"  style="width: 100%" onclick="javascript:facturarAfip()"><b>FACTURAR</b> AFIP</a> -->
<?php }?>
</div>
<script>
	var cantidadProcesados=0;
	function facturaIndividual(id)
	{
		ingresarFacturaAfip(id);
	}
	function facturarAfip(){
		cantidadProcesados=0;
		if(facturas.length>0){
		if($("#btnAceptar").attr("disabled")==undefined){ 
			$(".filas").attr("class","");
			$("#btnAceptar").attr("disabled","disabled");
			for(var i=0;i<facturas.length;i++)
				ingresarFacturaAfip(facturas[i]);
		}
	}else swal("Ops..","Las facturas ya estan facturadas","warning");
		
	}
	function ingresarFacturaAfip(idFactura){
		$("#"+idFactura).addClass("procesando");
		var fechaVto=$("#fechaVto_"+idFactura).val();
		$.getJSON("index.php?r=FacturasObrasSocial/IngresoFacturaAfip",{idFactura:idFactura,fechaVto:fechaVto},function(data){
			cantidadProcesados++;
			if(cantidadProcesados==facturas.length){
				//$("#btnAceptar").removeAttr("disabled");
				swal("Genial","Se han cargado las facturas!","success");
			}
			console.log(data)
			$("#"+idFactura).removeClass("procesando");
			console.log(data);
			if(!data.error){
				 $("#"+idFactura).addClass("finalizada"); 
				  $("#fe_"+idFactura).html("CAE: "+data.datos.CAE+" Vto: "+data.datos.CAEFchVto); 
			}else{
				 $("#"+idFactura).addClass("errorAfip");
				 $("#detalle_"+idFactura).attr("title",data.datos);
				 $("#fe_"+idFactura).html(data.datos); 
			}

		});
	}
</script>

