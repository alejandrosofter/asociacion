<div id='formAgregaModifica' style="display:none;padding:10px" > 
<h3>MODIFICAR ITEM</h3>
	<div class="form-search">
		<?php echo CHtml::dropDownList('idTipo','',CHtml::listData(CobrosTipos::model()->findAll(), 'id', 'nombreTipoCobro'),array ('class'=>'span3','onchange'=>'cambiaTipo()','style'=>'width:160px;',"prompt"=>"Seleccione ...")); ?>
<input id='detalle'  class='span4' type="text" placeholder="Detalle">
	$ <input id='importe' class='span1' type="text" placeholder="Importe">

	<input id='idItem'  class='span3' type="HIDDEN">
	</div>

	<div class= "form-actions">
		<button style="float:left" class="btn btn-danger btn-small" id="btnCancela" type="button">Cancelar</button>
<button style="float:right" class="btn btn-success btn-small" id="btnAceptar" type="button">MODIFICA</button>
		
	</div>
	
</div>
<div id='formAgrega' style="display:none;padding:10px" > 
<h3>AGREGAR ITEM</h3>
	<div class="form-search">
		<?php echo CHtml::dropDownList('idTipoAgrega','',CHtml::listData(CobrosTipos::model()->findAll(), 'id', 'nombreTipoCobro'),array ('class'=>'span3','onchange'=>'cambiaTipo()','style'=>'width:160px;',"prompt"=>"Seleccione ...")); ?>
<input id='detalleAgrega'  class='span4' type="text" placeholder="Detalle">
	$ <input id='importeAgrega' class='span1' type="text" placeholder="Importe">

	<input id='idProfesional'  class='span3' type="HIDDEN">
	</div>

	<div class= "form-actions">
		<button style="float:left" class="btn btn-danger btn-small" id="btnCancelaAgrega" type="button">Cancelar</button>
<button style="float:right" class="btn btn-success btn-small" id="btnAceptarAgregar" type="button">AGREGAR</button>
		
	</div>
	
</div>

  <div class="accordion" id="acordeonProf" >
 
  </div>
<div style="float:right"> <h1 id="labTotal"></h2></div><br><br>
<script>
itemsResultados=[];

  function getImporteTotalLiquidacion(items){
    var total=0;
    $(items).each(function(id,item){
      total+=(item.importe*1);
    });
    return total;
  }
	function ripItemsSeleccion()
		{
			var arr=[];
			for(var i=0;i<itemsSeleccionCobros.length;i++)arr.push(itemsSeleccionCobros[i].id);
			return arr;
		}
function consultarPagoProfesional(idProfesionalAbierto)
{
$.blockUI({ message: '<h1><img src="images/loader.gif" /> Buscando pagos ...</h1>' });
		$.post('index.php?r=cobros/getProfesionalesCobros',{idCobros:ripItemsSeleccion(),idProfesional:idProfesionalAbierto}, function(data) {
		console.log(data)
			var data = JSON.parse(data);
 itemsResultados=data.res;
 		$('#acordeonProf').html(data.datos);
			
   var tot=getImporteTotalLiquidacion(data.resultados);
      $("#labTotal").html("<small>TOTAL LIQUIDACION</small> $ "+tot.toFixed(2));
  if(data.res.length==0){
    $("#btnAceptar").addClass("disabled");
  }else{
    $("#btnAceptar").removeClass("disabled");
  }
 	$.unblockUI();
});
	
	
}
	function agregarItem(idProf)
	{
		$.blockUI({ message: $('#formAgrega'), css: { width: '775px' } }); 
	}
	function quitarItemProfesional(id,idProfesional)
	{
// 		swal({   title: "Estas seguro de eliminar este item?",   text: "Se quitara del cobro efectuado...",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Se, borralo!",   closeOnConfirm: false }, function(){ 
// 		$.getJSON('index.php?r=cobrosItems/quitar',{idItem:id}, function(data) {
// 			 swal("Quitado!", "el item fue eliminado", "success");
// 		});
// 	}});				
		 swal({  title: "Estas seguro de eliminar este item?",   text: "Se quitara del cobro efectuado...",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Si, Borralo!!"}).then(
		 function(){  
		 $.getJSON('index.php?r=cobrosItems/quitar',{id:id}, function(data) {
				consultarPagoProfesional(idProfesional);
			 swal("Quitado!", "el item fue eliminado", "success");
		});
		 }
		 );
}
	idProfesionalSeleccion=null;
	function editarItemProfesional(id,idProfesional)
	{
		idProfesionalSeleccion=idProfesional;
		 $.blockUI({ message: $('#formAgregaModifica'), css: { width: '775px' } }); 
		 $.getJSON('index.php?r=cobrosItems/getUnico',{id:id}, function(data) {
			 
			 console.log(data);
				$("#idTipo").val(data.idTipoItem);
			 $("#importe").val(data.importe);
			 $("#detalle").val(data.detalle);
			 $("#idItem").val(data.id);
			
			 
		});
	}
	function agregarItemProfesional(idProfesional)
	{
		idProfesionalSeleccion=idProfesional;
		$("#idTipoAgrega").val(null);
			 $("#importeAgrega").val(0);
			 $("#detalleAgrega").val("");
			 $("#idProfesionalAgrega").val(idProfesional);
		 $.blockUI({ message: $('#formAgrega'), css: { width: '775px' } }); 

				
			
			 
	}
	 $('#btnCancela').click(function() {
		 $.unblockUI();
	 });
	$('#btnCancelaAgrega').click(function() {
		 $.unblockUI();
	 });
	 $('#btnAceptar').click(function() {
		  $.getJSON('index.php?r=cobrosItems/modificar',{id:$("#idItem").val(),importe:$("#importe").val(),detalle:$("#detalle").val(),idTipo:$("#idTipo").val()}, function(data) {
				consultarPagoProfesional(idProfesionalSeleccion);
				$.unblockUI();
				if(!data)swal("Ops..","No se ha podido guardar","error");
			});
		 
	 });
	 $('#btnAceptarAgregar').click(function() {
		  $.getJSON('index.php?r=cobrosItems/agregarItem',{importe:$("#importeAgrega").val(),detalle:$("#detalleAgrega").val(),idTipo:$("#idTipoAgrega").val(),idProfesional:idProfesionalSeleccion}, function(data) {
				consultarPagoProfesional(idProfesionalSeleccion);
				$.unblockUI();
				if(!data)swal("Ops..","No se ha podido guardar","error");
			});
		 
	 });
</script>
<!-- 	<tr><th>Profesional</th><th>Cond.Iva</th><th>Regimen Retención</th><th style='color:red;text-align: right'>Débitos</th><th style='color:green;text-align: right'>Créditos</th></tr>
	<tbody id='itemsProfesionales'></tbody> -->
<!-- </table> -->