
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'archivos-nomencladores-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Campos <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
  <div class="form">
<?php echo $form->labelEx($model,'fecha',array('class'=>'')); ?>
<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'attribute'=>'fecha',
    'model'=>$model,
    // additional javascript options for the date picker plugin
     'options'=>array(
        'showAnim'=>'fold',
        'dateFormat' => 'yy-mm-dd', // save to db format
        'altFormat' => 'dd-mm-yy', // show to user format
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;',
        'class'=>'span2'
    ),
)); ?>
</div>
<div class="form">
<?php echo $form->labelEx($model,'idObraSocial',array('class'=>'')); ?>
		<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:280px','onchange'=>'buscar()','placeholder'=>'seleccione...'),
  'attribute'=>'idObraSocial',
  'data'=>CHtml::listData(ObrasSociales::model()->findAll(array('order'=>'nombreOs')), 'id', 'nombreOs'))
); ?>
</div>
<div class="form">
<?php echo $form->labelEx($model,'idTipoComprobanteElectronico',array('class'=>'')); ?>
    <?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:380px','placeholder'=>'seleccione...'),
  'attribute'=>'idTipoComprobanteElectronico',
  'data'=>CHtml::listData(TiposComprobantesElectronicos::model()->findAll(array('order'=>'nombre')), 'id', 'nombre'))
); ?>
</div><div class="form">
    <?php echo $form->labelEx($model,'comprobanteAsociado',array('class'=>'')); ?>
    <?php echo $form->textField($model,'comprobanteAsociado',array('style'=>'width:90px')); ?>
    <?php echo $form->error($model,'comprobanteAsociado'); ?>
  </div>
  <div class="form">
    <?php echo $form->labelEx($model,'detalle',array('class'=>'')); ?>
    <?php echo $form->textArea($model,'detalle',array('rows'=>6, 'cols'=>70)); ?>
    <?php echo $form->error($model,'detalle'); ?>
  </div>
<div class="form">
    <?php echo $form->labelEx($model,'anulacion',array('class'=>'')); ?>
    <?php echo $form->checkbox($model,'anulacion',array('class'=>'')); ?>
    <?php echo $form->error($model,'anulacion'); ?>
  </div>

  <div class="form">
    <?php echo $form->labelEx($model,'importe',array('class'=>'')); ?>
    <?php echo $form->textField($model,'importe',array('class'=>'')); ?>
    <?php echo $form->error($model,'importe'); ?>
  </div>



	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'ACEPTAR' : 'GUARDAR',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
<script type="text/javascript">
  $("#NotasCredito_comprobanteAsociado").change(function(){
  cambiaNroComprobante();
});
  function buscar(){
    var idOs=$("#NotasCredito_idObraSocial").val();
    $.getJSON("index.php?r=obrasSociales/getObraSocial&idObraSocial="+idOs,function(res){
      if(res.realizaFacturaCredito)swal("ATENCIÓN","Esta OBRA SOCIAL esta configurada como GRAN EMPRESA. Tenga la precaución de seleccionar un TIPO DE COMPROBANTE MyPyme","warning")
    })
  }
  function cambiaNroComprobante(){
    
    var nro=$("#NotasCredito_comprobanteAsociado").val();
    var idOs=$("#NotasCredito_idObraSocial").val();
    if(idOs){
      $.getJSON("index.php?r=facturaElectronica/getComprobante&nro="+nro+"&idObraSocial="+idOs,function(res){
        var detalle="EN CORRESPONDENCIA POR COMPROBANTE "+res.CbteDesde+" de la obra social "+res.obraSocial+ " con importe $ "+res.ImpTotal;
        
      $("#NotasCredito_detalle").val(detalle);
      $("#NotasCredito_importe").val(res.ImpTotal);
    }) 
    } else swal("Ops..","Debes seleccionar una obra social!")
  }
</script>