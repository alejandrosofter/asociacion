<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idObraSocial')); ?>:</b>
	<?php echo CHtml::encode($data->idObraSocial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaModificacion')); ?>:</b>
	<?php echo CHtml::encode($data->fechaModificacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data')); ?>:</b>
	<?php echo CHtml::encode($data->data); ?>
	<br />


</div>