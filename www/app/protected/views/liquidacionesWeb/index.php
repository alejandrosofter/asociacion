<?php
$this->breadcrumbs=array(
	'Liquidaciones Webs',
);
$this->menu=array(

);
?>

<header id="page-header">
<h1 id="page-title"><b>LIQUIDACIONES</b> APP Webs</h1>
</header>

<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get','htmlOptions'=>array('class'=>'form-search')
)); ?>

        <?php echo $form->label($model,'buscar'); ?>
        <?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:280px','placeholder'=>'seleccione...'),
  'attribute'=>'idProfesional',
  
  "options"=>array("allowClear"=>true),
  'data'=>CHtml::listData(Profesionales::model()->findAll(array('order'=>'apellido')), 'id', 'nombreProfesionales'))
); ?>
        <?php echo $form->dropDownList($model,'estado',array(''=>'TODOS','PENDIENTE'=>'PENDIENTE','CANCELADA'=>'CANCELADA'),array("style"=>"width:120px")); ?>


        <?php echo CHtml::submitButton('Buscar',array('class'=>'btn btn-primary')); ?>

<?php $this->endWidget(); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mail-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		array(
            'type'=>'html',
            'header'=>'Profesional',
            'value'=>'$data->profesional->nombreProfesionales',
            ),
		'detalle',
		array(
            'type'=>'html',
            'header'=>'Fecha Comienzo',
            'value'=>'"<small>".Yii::app()->dateFormatter->format("dd-MM-yyyy",$data->fechaComienzo)."</small>"',
            'htmlOptions'=>array('style'=>'width: 90px'),
            ),
		array(
            'type'=>'html',
            'header'=>'Fecha Entrega',
            'value'=>'"<small>".Yii::app()->dateFormatter->format("dd-MM-yyyy",$data->fechaEntrega)."</small>"',
            'htmlOptions'=>array('style'=>'width: 90px'),
            ),
		'nroLiquidacion',
		'estado',
		array(
            'htmlOptions'=>array('style'=>'width: 90px'),
			'class'=>'CButtonColumn','template'=>'{cambiaEstado} {imprimir} {facturas} {delete}','buttons'=>array(
'imprimir' => array(
                
                'label'=>'Facturas/Practicas',
                'imageUrl'=>'images/iconos/famfam/printer.png',
                'url' => '"index.php?r=liquidacionesWeb/imprimir&id=".$data->id',

            ),
'cambiaEstado' => array(
                
                'label'=>'Cambia Estado',
                'imageUrl'=>'images/iconos/famfam/wand.png',
                'url' => '"javascript:cambiarEstadoFactura(\'".$data->id."\')"',

            ),
'facturas' => array(
                
                'label'=>'Facturas/Practicas',
                'imageUrl'=>'images/iconos/famfam/briefcase.png',
                'url' => '"index.php?r=liquidacionesWeb/verFacturas&id=".$data->id',

            ),
)
		),
	),
)); ?>
<script>
function cambiarEstadoFactura(id)
    {
         swal({  title: "Estas seguro  cambiar el estado?",   text: "Se cambiara el estado al opuesto...",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Si, cambialo!!"}).then(
         function(){  
         $.get('index.php?r=liquidacionesWeb/cambiarEstado',{id:id}, function(data) {
                
             swal("Genial!", "se ha cambiado el estado", "success");
             location.reload();
        });
         }
         );
    }
</script>