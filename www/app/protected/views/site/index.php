<div class='row'>
<h1>AUSTRAL OFTALMOLOGIA <b>V3</b><small> de Facturación, Control WEB, Practicas</small></h1>
<div class='span6'>

<h2><img src="images/iconos/glyphicons/png/glyphicons-332-dashboard.png"/> PENDIENTES <small> Que es lo que hay para ingresar...</small></h2>
<ul id="myTab" class="nav nav-tabs">
  <li><a href="#resFacturas" data-toggle="tab"><img src="images/iconos/glyphicons/png/glyphicons-734-nearby-square.png">FACTURAS Obras Sociales  <span id="cantidadFacturas" class="badge badge-important"></span></a></li>
  <li><a href="#resCobros" data-toggle="tab"> <img src="images/iconos/glyphicons/png/glyphicons-352-book-open.png"> PAGOS a Profesionales <span id="cantidadCobros" class="badge badge-important"></span></a></li>
</ul>
<div style="width:100%" class="tab-content">
<div style="width:100%" class="tab-pane" id="resFacturas">facturas...</div>
  <div style="width:100%" class="tab-pane" id="resCobros">cobros...</div>
</div>
  
   

  
  
</div>
   <div class="span4">
     <h3><img src="images/iconos/glyphicons/png/glyphicons-49-star-empty.png"/> QUE DESEAS HACER? <small>accesos directos</small></h3>
     <a type="button" href="index.php?r=facturasProfesional/create" style="width:100%" class="btn btn-large btn-primary"><b>1.</b> FACTURAR A PROFESIONALES</a>
  <br> <br>
  <a type="button" href="index.php?r=FacturasObrasSocial/create" style="width:100%" class="btn btn-large btn-primary"><b>2.</b> FACTURAR A OBRAS SOCIALES</a>
 <br> <br>
   <a type="button" href="index.php?r=cobros/create" style="width:100%" class="btn btn-large btn-primary"><b>3.</b> COBRO DE OBRA SOCIAL</a>
   <br> <br>
   <a type="button" href="index.php?r=pagos/createLote" style="width:100%" class="btn btn-large btn-primary"><b>4.</b> PAGAR A PROFESIONALES</a>
  </div>

</div>
<script>
   getCobrosPendientes();
  getFacturasPendientes();
   $(function () {
    $('#myTab a:first').tab('show');
  })
function getFacturasPendientes()
  {
    $.getJSON('index.php?r=FacturasObrasSocial/ConsultaPendientes', function(data) {
      if(data.items.length==0)$("#cantidadFacturas").hide();
      $("#cantidadFacturas").html(data.items.length);
      $("#resFacturas").html(data.contenido);
    });
  }
  function getCobrosPendientes()
  {
    $.getJSON('index.php?r=cobros/ConsultaPendientes', function(data) {
      if(data.items.length==0)$("#cantidadCobros").hide();
      $("#cantidadCobros").html(data.items.length);
      $("#resCobros").html(data.contenido);
    });
  }
</script>