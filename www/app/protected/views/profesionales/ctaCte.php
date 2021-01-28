<h1>CTA CTE <small>de Profesionales</small></h1>

	<div class="form-inline">
		<input style="width: 80px" placeholder="Ano" value="<?=Date('Y')?>" id="ano" class="form">
		<?php $this->widget('ext.2select.ESelect2',array(
  'name'=>"idObraSocial",

  'htmlOptions'=>array ('style'=>'width:280px','placeholder'=>'seleccione...',"id"=>"idProfesional"),
  'attribute'=>'idProfesional',
  'data'=>CHtml::listData(Profesionales::model()->findAll(array('order'=>'apellido')), 'id', 'nombreProfesionales'))
); ?>
<a onclick="buscarCtaCte()" class="btn btn-success"><i class="icon-search icon-white"></i></a>
		</div>

<div id="contenedor" style="padding: 10px"></div>
</div>
<script>
function buscarCtaCte()
{
	
	var idProfesional=$("#idProfesional").val();
	var ano=$("#ano").val();
	if(idProfesional!=""){
		//$.blockUI({ message: '<h1><img src="images/loader.gif" /> Espere un momento por favor...</h1>' }); 
		$.get("index.php?r=profesionales/ctaCte_",{idProfesional:idProfesional,ano:ano},function(res){
     
      $.unblockUI();
      $("#contenedor").html(res);

    });
	}
	 else swal("Opss..","No seleccionaste profesional!, por favor selecciona una y vuelve a intentar.","error")
}
</script>