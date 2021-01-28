<h1>HOMOLOGACION AFIP <small><i><b>VTO CERTIFICADO AFIP:</b> <?=$vtoCert?> (renueve antes del vto) <br></i></small></h1>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<nav class="navbar navbar-inverse navbar-static-top">
<input id="fechaDesde" style="width: 120px" value="<?=$desde?>" placeholder="Desde">
<input id="fechaHasta" style="width: 120px" placeholder="Hasta">
<a class="btn btn-success" type="submit" name="yt0" onclick="javascript:consultar()">Buscar Facturas</a>
<div id="resultados"></div>
<span style="color:orange">El importe MINIMO para realizar la FACTURA de CREDITO MiPyME es de <b>$ <?=Settings::model()->getValorSistema('DATOS_EMPRESA_MINIMO_FC')?> </b>, y en el perfil de la obra social debe estar tildado <b>REALIZA FACTURA CREDITO</b></span> <br>
<script>
init();
function init()
{
	consultar();
}
function consultar()
{
	var desde=$("#fechaDesde").val();
	var hasta=$("#fechaHasta").val();
	$.blockUI({ message: '<h1><img src="images/loader.gif" /> Buscando facturas...</h1>' }); 
	$.getJSON("index.php?r=FacturasObrasSocial/consultarango&desde="+desde+"&hasta="+hasta,function(data){
		$("#resultados").html(data);
		$.unblockUI();
	});
}
</script>