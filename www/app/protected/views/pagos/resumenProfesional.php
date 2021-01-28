<h1>RESUMEN DE PAGOS <small>por profesional</small></h1>
<div class="form-inline" style="">

	<?php $this->widget('ext.2select.ESelect2',array(
  'name'=>"idObraSocial",

  'htmlOptions'=>array ('style'=>'width:280px','placeholder'=>'seleccione...',"id"=>"idProfesional"),
  'attribute'=>'idProfesional',
  'data'=>CHtml::listData(Profesionales::model()->findAll(array('order'=>'apellido')), 'id', 'nombreProfesionales'))
); ?> 
<input id="desde" value="01<?=Date('-d-Y')?>" style="width: 120px">
<input id="hasta" value="31<?=Date('-d-Y')?>" style="width: 120px">
<?php $this->widget('ext.2select.ESelect2',array(
  'name'=>"idOsExcluye",
   'id'=>"idOsExcluye",

  'htmlOptions'=>array ('style'=>'width:220px','placeholder'=>'excluir...',"id"=>"idOsExcluye"),
  'attribute'=>'idOsExcluye',
  'data'=>CHtml::listData(ObrasSociales::model()->findAll(array('order'=>'nombreOs')), 'id', 'nombreOs'))
); ?> 
<?php $this->widget('ext.2select.ESelect2',array(
  'name'=>"idOsExcluye2",
 'id'=>"idOsExcluye2",
  'htmlOptions'=>array ('style'=>'width:220px','placeholder'=>'excluir otra...',"id"=>"idOsExcluye2"),
  'attribute'=>'idOsExcluye2',
  'data'=>CHtml::listData(ObrasSociales::model()->findAll(array('order'=>'nombreOs')), 'id', 'nombreOs'))
); ?> 
<button onclick="buscar()" class="btn btn-success">Buscar</button>
</div>
<div id="contenedor"></div>
<script>
function buscar(){
	$.blockUI({ message: '<h1><img src="images/loader.gif" /> Espere un momento por favor...</h1>' }); 
	var arrDesde=$("#desde").val().split("-");
				var fechaDesde=arrDesde[2]+"-"+arrDesde[1]+"-"+arrDesde[0];
				var arrHasta=$("#hasta").val().split("-");
				var fechaHasta=arrHasta[2]+"-"+arrHasta[1]+"-"+arrHasta[0];
	$("#btnImprime").attr("href","index.php?r=pagos/imprimeResumenDeuda&idProfesional="+$("#idProfesional").val()+"&fechaDesde="+$("#desde").val()+"&fechaHasta="+$("#hasta").val() );
	$.get("index.php?r=pagos/_resumenProfesional",{"idProfesional":$("#idProfesional").val(),idOsExcluye2:$("#idOsExcluye2").val(),idOsExcluye:$("#idOsExcluye").val(),fechaDesde:$("#desde").val(),fechaHasta:$("#hasta").val()},function(res){
		$.unblockUI();
		$("#contenedor").html(res)
	})
}

			function enviarMail(){
				$.blockUI({ message: '<h1><img src="images/loader.gif" /> Espere un momento por favor...</h1>' }); 
				var arrDesde=$("#desde").val().split("-");
				var fechaDesde=arrDesde[2]+"-"+arrDesde[1]+"-"+arrDesde[0];
				var arrHasta=$("#hasta").val().split("-");
				var fechaHasta=arrHasta[2]+"-"+arrHasta[1]+"-"+arrHasta[0];

	$.getJSON("index.php?r=pagos/enviarResumenProfesional",{"idProfesional":$("#idProfesional").val(),idOsExcluye2:$("#idOsExcluye2").val(),idOsExcluye:$("#idOsExcluye").val(),fechaDesde:$("#desde").val(),fechaHasta:$("#hasta").val()},function(res){
		$.unblockUI();
		if(!res.enviado.error)swal("Ops",res.enviado.mensaje,"error");
		else swal("Genial!","Se envio correctamente el mensaje","success")
	})
			}
			
</script>
<button onclick="enviarMail()" style="float: right;" class="btn btn-info">ENVIAR MAIL <b></b></button>
		<a id="btnImprime" target="_blank" style="float: left;" class="btn btn-success">IMPRIMIR </a>
	