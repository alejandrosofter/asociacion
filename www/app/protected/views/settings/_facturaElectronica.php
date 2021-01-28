<h3>FACTUAR ELECTRONICA</h3>
<div style="margin:15px">

<table>
<tr><td>CERTIFICADO</td><td>PK</td><td>PEDIDO</td></tr>
<tr>
	<td><?php echo CHtml::textArea('FE_CERTIFICADO',Settings::model()->getValorSistema('FE_CERTIFICADO'),array('class'=>'text',"rows"=>"23","width"=>"40px")); ?></td>
	<td><?php echo CHtml::textArea('FE_PK',Settings::model()->getValorSistema('FE_PK'),array('class'=>'text',"width"=>"140px","rows"=>"23")); ?></td>
	<td><?php echo CHtml::textArea('FE_PEDIDO',Settings::model()->getValorSistema('FE_PEDIDO'),array('id'=>'pedidio','class'=>'text',"rows"=>"23","width"=>"140px")); 
		
		?></td>
</tr>
</table>

	<div class="">
	<b><?php echo 'VTO' ?></b>
		<?php echo CHtml::textField('FE_VTO',Settings::model()->getValorSistema('FE_VTO'),array('class'=>'text',"width"=>"240px")); 
		
		?>
	</div>
	<a class="btn btn" onclick="javascript:escribirDatos()">ESCRIBIR CERITIFICADOS</a>
	<a class="btn btn" onclick="javascript:createPk()">CREAR PK</a>
	<a class="btn btn" onclick="javascript:createPedido()">PEDIDIO AFIP</a>
	<a class="btn btn-success" onclick="javascript:testCertificado()">TEST CERITIFICADOS</a>
	<a class="btn btn-error" onclick="javascript:vaciarTA()">VACIAR TICKETS ACCESO</a>
<script>
function createPedido()
{
$.blockUI({ message: '<h1>Espere...</h1>' });
	$.getJSON("index.php?r=facturaElectronica/GenerarPedido",function(res){
		$.unblockUI();
		swal("Pedido para AFIP!","Datos del pedido: "+res.archivo,"success");
		$("#pedido").val(res.archivo);
	})
}
function vaciarTA()
{
$.blockUI({ message: '<h1>Espere...</h1>' });
	$.getJSON("index.php?r=facturaElectronica/vaciarTA",function(res){
		$.unblockUI();
		swal("Resultado de la eliminacion: "+res,"success");
	})
}
function createPk()
{
$.blockUI({ message: '<h1>Espere...</h1>' });
	$.getJSON("index.php?r=facturaElectronica/generarPk",function(res){
		$.unblockUI();
		if(res.resultado!=false) swal("ok!","Se genero una nueva clave ","success");
		else swal("Clave existente!","Ya existe una clave privada: "+res.archivo,"success");
	})
}
function escribirDatos()
{
	$.blockUI({ message: '<h1>Espere...</h1>' });
	$.getJSON("index.php?r=facturaElectronica/escribirCertificadosAfip",function(res){
		$.unblockUI();
		swal("ok!","Se escribieron los certificados y clave! ","success");
	})
}
function testCertificado()
{
	$.blockUI({ message: '<h1>Espere...</h1>' });
	$.getJSON("index.php?r=facturaElectronica/testCertificados",function(data){
		console.log(data)
		$.unblockUI();
		if(data.error!=""){
			swal("opss!","hay un problemita con el certificado: "+data.error+" ! ","error");
			
		}else  swal("ok!","El certificado esta ok!! "+JSON.stringify(data.datos),"success");
	})
}
</script>
</div>

