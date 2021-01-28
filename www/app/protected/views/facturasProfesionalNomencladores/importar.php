<h1>IMPORTAR <small>de excel</small></h1>
Selecciona el archivo en excel e importa todos los nomencladores: <br><br>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.10.8/xlsx.full.min.js">
</script>
<div class="span4" >
  <?php $this->widget('ext.2select.ESelect2',array(
  'htmlOptions'=>array ('style'=>'width:280px'),
  'attribute'=>'idObraSocial',
  "name"=>"idObraSocial",
  'data'=>CHtml::listData(ObrasSociales::model()->findAll(array('order'=>'nombreOs')), 'id', 'nombreOs'))
); ?>
<br>

  <div id="contenedorRango">
    <?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:250px',"id"=>"idRangoNomenclador"),
  'attribute'=>'idRangoNomenclador',
  "name"=>"idRangoNomenclador",

  //'data'=>CHtml::listData(FacturasProfesionalRangoNomencladores::model()->findAll(array('order'=>'fechaHasta')), 'id', 'nombreRango')
)
); ?>
  </div>
  <input type="checkbox" id="tipoCarga">Nuevo Rango? <br>
  <div id="contenedorNuevo" style="display:none">
    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'attribute'=>'fechaDesde', 'name'=>'fechaDesde',
     'options'=>array( 'showAnim'=>'fold', 'dateFormat' => 'yy-mm-dd', 'altFormat' => 'dd-mm-yy'),
     'htmlOptions'=>array(  'style'=>'height:20px;', 'id'=>'fechaDesde', 'placeholder'=>'Fecha Desde')
)); ?>
  <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'attribute'=>'fechaHasta', 'name'=>'fechaHasta',
     'options'=>array( 'showAnim'=>'fold', 'dateFormat' => 'yy-mm-dd', 'altFormat' => 'dd-mm-yy'),
     'htmlOptions'=>array(  'style'=>'height:20px;', 'id'=>'fechaHasta', 'placeholder'=>'Fecha Hasta')
)); ?>
  </div>

<br>
  <b>Nro COL DETALLE</b> <input id="colDetalle" value="2" placeholder="COL DETALLE" style="width: 50px"> <br>
   <b>Nro COL CODIGO INT</b> <input id="colInt" value="1" placeholder="COL COD INT" style="width: 50px"><br>
    <b>Nro COL CODIGO EXT</b> <input id="colExt" value="" placeholder="COL COD EXT" style="width: 50px"><br>
     <b>Nro COL $ IMPORTE</b> <input id="colImporte" value="3" placeholder="COL IMPORTE" style="width: 50px"> <br>

     <input type="file" onchange="cambiaArchivo()" id="file" ng-model="csvFile"  />
     <button class="btn btn-success" onclick="excelExport()"><i class="icon-refresh icon-white"></i> EXTRAER NOMENCLADORES</button>

     <div id="resultadosGral" style="display:none"></div>
</div>
<div class="span7" id="resultados" >
  

</div>

<script>

$( document ).ready(function() {
escucharObraSocial();
 escucharTipo();
});
function escucharObraSocial()
{
    var $eventSelect = $("#idObraSocial");
$eventSelect.select2();

$eventSelect.on("change", function (e) { 
buscarColumnas($("#idObraSocial").val());
buscarRangos($("#idObraSocial").val());
 });
}
function escucharTipo()
{
    var $eventSelect = $("#tipoCarga");

$eventSelect.on("change", function (e) { 
  if(this.checked){
    $("#contenedorRango").hide("slow");
     $("#contenedorNuevo").show("slow");
  }else {
    $("#contenedorRango").show("slow");
    $("#contenedorNuevo").hide("slow");
  }
 });
}
  var to_json = function to_json(workbook) {
    var result = {};
    workbook.SheetNames.forEach(function(sheetName) {
      var roa = XLSX.utils.sheet_to_json(workbook.Sheets[sheetName], {header:1});
      if(roa.length) result[sheetName] = roa;
    });
    return result;
  };
  function cambiaArchivo()
  {
    $("#resultadosGral").html("");
        $("#resultadosGral").hide();
  }
  function buscarColumnas(idObraSocial)
  {
    console.log(idObraSocial)
    $.getJSON("index.php?r=ObrasSociales/buscarColumnas",{idObraSocial:idObraSocial},function(res){
     
      $("#colInt").val(res.importar_codigoInterno);
      $("#colExt").val(res.importar_codigoExterno);
      $("#colDetalle").val(res.importar_detalle);
      $("#colImporte").val(res.importar_importe);

    })
  }
  function buscarRangos(idObraSocial)
  {
    $.getJSON("index.php?r=FacturasProfesionalRangoNomencladores/getRangos",{idObraSocial:idObraSocial},function(res){
        llenar(res);


    })
  }
  function llenar(data)
{
  var sal=[];
  $('#idRangoNomenclador').empty().trigger('change')
  for(var i=0;i<data.length;i++){
    var lab=data[i].fechaDesde+" ----> "+data[i].fechaHasta;
    var auxOption=new Option(lab, data[i].id, true, true);
    $('#idRangoNomenclador').append(auxOption).trigger('change');
    }
  
    return sal;
}
function guardar()
{
   var idRangoNomenclador=$("#idRangoNomenclador").val();
    var idObraSocial=$("#idObraSocial").val();
    var fechaDesde=$("#fechaDesde").val();
    var fechaHasta=$("#fechaHasta").val();
    var esNuevo=$("#tipoCarga").is(':checked');

  $.blockUI({ message: '<h1><img src="images/loader.gif" /> Espere un momento por favor...</h1>' }); 
    $.post("index.php?r=facturasProfesionalNomencladores/importarNomencladores",{idRangoNomenclador:idRangoNomenclador,nomencladores:datosArchivo,idObraSocial:idObraSocial,fechaHasta:fechaHasta,fechaDesde:fechaDesde,esNuevo:esNuevo},function(res){
     $.unblockUI();
      swal("Genial!","Se han guardado los nomencladores!")

    })
}
function subirArchivo()
{
  const url="index.php?r=facturasProfesionalNomencladores/ingresarArchivoNomenclador";
   const files = document.querySelector('[type=file]').files
  const formData = new FormData()
  var idObraSocial=$("#idObraSocial").val();
  for (let i = 0; i < files.length; i++) {
    let file = files[i]

    formData.append('archivo', file)
  }
  formData.append('idObraSocial', idObraSocial)
$.ajax({
    url: url,
    type: "post",
    dataType: "html",
    data: formData,
    cache: false,
    contentType: false,
    processData: false
})
    .done(function(res){
        console.log(res)
    });
  // fetch(url, {
  //   method: 'POST',
  //   body: formData,
  // }).then(response => {
  //   console.log(response)
  // })
  // $.post("index.php?r=facturasProfesionalNomencladores/ingresarArchivoNomenclador",{idObraSocial:idObraSocial,archivos:formData},function(err,res){
  //     console.log(err,res)
  //    })
}
  function guardarNomencladores()
  {
     var esNuevo=$("#tipoCarga").is(':checked');
     var idRangoNomenclador=$("#idRangoNomenclador").val();
    //if(idRangoNomenclador!='' && !esNuevo)
     guardar();
     
     subirArchivo();
     
    
    
  }
  function ripArchivo(wb,col_codigoInterno,col_codigoExterno,col_detalle,col_importe)
  {
    var res=to_json(wb);
    var auxData=[];
    var salida="";
    datosArchivo=[];
    for(let item in res){
      var aux=res[item];
      
      for(var  i=0;i<aux.length;i++){
        var codigoInt= col_codigoInterno==""?"undefined": aux[i][col_codigoInterno]+"";
        var codigoExt= col_codigoExterno==""?"undefined": aux[i][col_codigoExterno]+"";
        var detalle= col_detalle ==""?"undefined": String(aux[i][col_detalle]);
        var importe= col_importe==""?"undefined": String(aux[i][col_importe]);

        codigoInt=codigoInt.replace("'","");
        codigoExt=codigoExt.replace("'","");
        detalle=detalle.replace("'","").normalize('NFD').replace(/[\u0300-\u036f]/g,"");
        importe=importe.replace("$","").replace(" ","").replace(",","").replace("-","");
        importe=importe;

        if(!(detalle==="undefined") && !(importe==="undefined") && !(codigoInt==="undefined") )  auxData.push({detalle:detalle,importe:importe,codigoInterno:codigoInt,codigoExterno:codigoExt});

      }
    }
    console.log(auxData)
    return auxData;
  }
  function guardarDatosObraSocial(codigoInterno,codigoExterno,detalle,importe)
  {
    var idObraSocial=$("#idObraSocial").val();
    console.log(idObraSocial)
    $.getJSON("index.php?r=ObrasSociales/guardarDatosObraSocial",{idObraSocial:idObraSocial,codigoExterno:codigoExterno,codigoInterno:codigoInterno,detalle:detalle,importe:importe},function(res){
     
    })
  }
  var datosArchivo=[];
  function mostrarDato(dato)
  {
    return dato==="undefined"?"-":dato;
  }
  function mostrarDatos()
  {
    var auxData=datosArchivo;
    var salida="<table class='table table-condensed'>";
    salida+="<thead>";
    salida+="<tr><th style='width:90px'>CODIGO INT.</th><th style='width:90px'>CODIGO EXT.</th><th>DETALLE</th><th style='width:90px'>$ IMPORTE</th></tr>";
    salida+="</thead>";
    salida+="<tbody>";
    for(var i=0;i<auxData.length;i++)salida+="<tr><td>"+mostrarDato(auxData[i].codigoInterno)+"</td><td>"+mostrarDato(auxData[i].codigoExterno)+"</td><td>"+mostrarDato(auxData[i].detalle)+"</td><td>$ "+mostrarDato(auxData[i].importe)+"</td></tr>";
      var dataGral="<b>NOMENCLADORES ENCONTRADOS: </b>"+auxData.length+"<br>";
      dataGral+="<button onclick='guardarNomencladores()' class='btn btn-primary'><i class='icon-refresh icon-white'></i> GUARDAR NOMENCALDORES</button>"
        $("#resultadosGral").html(dataGral);
        $("#resultadosGral").show();
        salida+="</tbody>";
        salida+="</table>";
        $("#resultados").html(salida);
  }

  function excelExport() {


    var input = document.getElementById('file');
    var codigoInt=$("#colInt").val();
        var codigoExt=$("#colExt").val();
        var detalle=$("#colDetalle").val();
        var importe=$("#colImporte").val();
        guardarDatosObraSocial(codigoInt,codigoExt,detalle,importe);
    var reader = new FileReader();
    var data=[];
    
    reader.onload = function(){

        var fileData = reader.result;
        console.log(reader);
        var wb = XLSX.read(fileData, {type : 'binary'});
        var auxData=ripArchivo(wb,codigoInt,codigoExt,detalle,importe);
        datosArchivo=auxData;
        mostrarDatos();
    
        
    };
    reader.readAsBinaryString(input.files[0]);
    };
</script>
