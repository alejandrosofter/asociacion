<?php
$this->breadcrumbs=array(
	'FACTURACION MASIVA',
);
$this->menu=array(

);
?>

<header id="page-header">
<h1 id="page-title"><b>FACTURAR</b> <small>liquidaciones pendientes</small></h1>
</header>
<div class="form-inline">
<b>FECHA PARA SACAR FACTURA </b><input value="<?=Date('d-m-Y')?>" id="fechaFactura" style="width: 90px">
<b>DETALLE </b><input value="En concepto de servicios prestados por el mes de xxxxx del 20xx" id="detalleFactura" style="width: 490px">
</div>

<table class="table table-condensed">
<thead><tr><th>CANT.</th><th>OBRA SOCIAL</th><th>DETALLE</th><th>$IMPORTE</th></tr></thead>
<tbody>
  <?php if(count($items)==0){?>
<tr><th>-</th><th>-</th><th>-</th><th>-</th></tr>
  <?php }?>


<?php foreach ($items as $key => $value) {?>
<tr><td><?=count($value)?></td><td><?=ObrasSociales::model()->findByPk($key)->nombreOs;?></td> <td><small> <?=$this->getDetalle($value);?></small></td><td><?=number_format($this->getImporte($value),2);?> </td><td><button class="btn btn-success btn-xs" onclick="javascript:facturar(<?=$key?>)" style="float:right;"><b>FACTURAR</b></button> <button class="btn btn-danger btn-xs" onclick="javascript:cancelar(<?=$key?>)" style="float:right;"><b>CANCELAR</b></button></td></tr>
<?php }?>
</tbody>
</table>
<?php if(count($items)==0){?>
<i style="float:right;">No hay liquidaciones <b>para facturar</b>!</i>
  <?php }else{?>

<?php }?>
<script>
function facturar(idOs)
{
    
Swal.fire({
  title: 'Estas seguro/a de ingresar esta Factura?',
  text: "Se ingresara solo la factura seleccionada...",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si ingresa!'
}).then((result) => {
  if (result.value) {
    $.blockUI({ message: '<h1><img src="images/loader.gif" /> Espere un momento por favor...</h1>' }); 
    $.get('index.php?r=facturasObrasSocial/ingresarIndividualLote',{idObraSocial:idOs,fechaFactura:$("#fechaFactura").val(),detalleFactura:$("#detalleFactura").val()}, function(res) {
      $.unblockUI();
    window.location.replace('index.php?r=liquidacionesWeb/facturarPendientes');
      
      
    });
  }
})

}
function cancelar(idOs)
{
    
Swal.fire({
  title: 'Estas seguro/a de cancelar esta Factura?',
  text: "Se pasaran los items a cancelado...",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si cancelar!'
}).then((result) => {
  if (result.value) {
    $.blockUI({ message: '<h1><img src="images/loader.gif" /> Espere un momento por favor...</h1>' }); 
    $.get('index.php?r=facturasObrasSocial/cancelarIndividualOs',{idObraSocial:idOs}, function(res) {
      $.unblockUI();
    window.location.replace('index.php?r=liquidacionesWeb/facturarPendientes');
      
      
    });
  }
})

}
</script>