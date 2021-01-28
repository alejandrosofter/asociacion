<?php
$this->breadcrumbs=array(
	'Modificar en lote',
);
$this->menu=array(
	//array('label'=>'Nueva Practica Profesional', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title"><img src="images/iconos/glyphicons/png/glyphicons-774-auction.png"/> MODIFCAR <small>en lote</small></h1>
</header>
<div class="span4">
  <label class="checkbox"> <input id="soloMias" type="checkbox"> Solo las mias </label>
CARGADAS EN
<select id="desdeMes">
    <option value="1">Enero</option>
    <option value="2">Febrero</option>
    <option value="3">Marzo</option>
    <option value="4">Abril</option>
  <option value="5">Mayo</option>
  <option value="6">Junio</option>
  <option value="7">Julio</option>
  <option value="8">Agosto</option>
  <option value="9">Septiembre</option>
  <option value="10">Octubre</option>
  <option value="1">Noviembre</option>
  <option value="12">Diciembre</option>
  </select>
<input type="text" type="text" value="<?=date('Y')?>" style="width:40px" id="desdeAno">
<br>
<h4><img src="images/iconos/glyphicons/png/glyphicons-235-brush.png"/>MODIFICAR CON LOS VALORES</h4>
<select id="mesModifica">
    <option value="1">Enero</option>
    <option value="2">Febrero</option>
    <option value="3">Marzo</option>
    <option value="4">Abril</option>
  <option value="5">Mayo</option>
  <option value="6">Junio</option>
  <option value="7">Julio</option>
  <option value="8">Agosto</option>
  <option value="9">Septiembre</option>
  <option value="10">Octubre</option>
  <option value="1">Noviembre</option>
  <option value="12">Diciembre</option>
  </select>
  <input type="text" type="text" value="<?=date('Y')?>" style="width:40px" id="anoModifica">
  <a class="btn btn-success" id="btnAceptar" style="width:100%">MODIFICAR</a>
</div>
<div class="span6">
   <a class="btn btn-xs btn-info" style="float:right" id="btnTodos" style=""> Todos/Ninguno</a>
 <h3>RESULTADOS <small id="salidaTexto"><b>(0)</b> elementos seleccionados</small></h3>
  <div id="resultados"></div>
</div>
<script>
  var hoy=new Date();
  $("#desdeMes").val(hoy.getMonth())
  $("#mesModifica").val(hoy.getMonth())
  buscar();
  arrPracticas=[];
  function agregarPractica(id,agrega)
  {
    if(agrega)
    if(arrPracticas.indexOf(id)==-1)arrPracticas.push(id)
    if(!agrega)arrPracticas.splice(arrPracticas.indexOf(id),1);
   $("#salidaTexto").html("<b>("+arrPracticas.length+")</b> elementos seleccionados")
  }
  function buscar(){
      arrPracticas=[];
      $.blockUI({ message: '<h1><img src="images/loader.gif" /> Buscando ...</h1>' });
		 
    $.get("index.php?r=practicasProfesionales/BuscarParaModificar",{desdeMes:$("#desdeMes").val(),hastaAno:$("#desdeAno").val(),soloMias:$("#soloMias:checked").val()},function(data){
      $.unblockUI();
      $("#resultados").html(data);
    });
  }
   $("#btnAceptar").click(function(){
    
   swal({  title: "Estas seguro de cambiar estas practicas?",   text: "Vas a modificar "+arrPracticas.length+" practicas",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Si, modificalos!!"}).then(
		 function(){  
        $.blockUI({ message: '<h1><img src="images/loader.gif" /> Aguarde estoy modificando ...</h1>' });
		 $.getJSON('index.php?r=practicasProfesionales/modificarItemsLote',{items:arrPracticas,mes:$("#mesModifica").val(),ano:$("#anoModifica").val()}, function(data) {
				$.unblockUI();
         buscar();
			 swal("OKK!", "los items fueron modificados", "success");
		});
		 }
		 );
});
 $("#btnTodos").on("click",function(){
  $(".filaPractica").each(function(ind,data){
    var arr=$(this).attr("id").split("_");
  agregarPractica(arr[1],true);
  });
});
   $("#btnTodos").on("click",function(){
  $(".filaPractica").each(function(ind,data){
    var arr=$(this).attr("id").split("_");
    $(this).toggleClass("seleccionado");
  agregarPractica(arr[1],$(this).hasClass("seleccionado"));
    console.log(arrPracticas);
  });
});
     $("#btnNinguno").on("click",function(){
  $(".filaPractica").each(function(ind,data){
    var arr=$(this).attr("id").split("_");
  agregarPractica(arr[1],false);
    $(this).toggleClass("seleccionado");
  });
});
$("#soloMias").on("click",function(){
  buscar();
});


  $("#desdeMes").on("change",function(){
  buscar();
});
   $("#hastaAno").on("change",function(){
  buscar();
});
</script>