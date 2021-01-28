<h1>CTA CTE <small>de obra social</small></h1>


		<?php $this->widget('ext.2select.ESelect2',array(
  'name'=>"idObraSocial",

  'htmlOptions'=>array ('style'=>'width:280px','onchange'=>'cambiaObraSocial()','placeholder'=>'seleccione...',"id"=>"idObraSocial"),
  'attribute'=>'idObraSocial',
  'data'=>CHtml::listData(ObrasSociales::model()->findAll(array('order'=>'nombreOs')), 'id', 'nombreOs'))
); ?>
<a onclick="buscarObraSocial()" class="btn btn-success"><i class="icon-search icon-white"></i></a>
		</div>

<div id="contenedor" style="padding: 10px"></div>
</div>
<script>
function buscarObraSocial()
{
	var idObraSocial=$("#idObraSocial").val();
	var fechaDesde=$("#fechaDesde").val();
	var fechaHasta=$("#fechaHasta").val();
	if(idObraSocial!=""){
		//$.blockUI({ message: '<h1><img src="images/loader.gif" /> Espere un momento por favor...</h1>' }); 
		$.get("index.php?r=ObrasSociales/ctaCte_",{idObraSocial:idObraSocial,fechaDesde:fechaDesde,fechaHasta:fechaHasta},function(res){
     
      $.unblockUI();
      $("#contenedor").html(res);

    });
	}
	 else swal("Opss..","No seleccionaste la obra social!, por favor selecciona una y vuelve a intentar.","error")
}
</script>