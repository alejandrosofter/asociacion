<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idFacturaObraSocial')); ?>:</b>
	<?php echo CHtml::encode($data->idFacturaObraSocial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idFacturaProfesional')); ?>:</b>
	<?php echo CHtml::encode($data->idFacturaProfesional); ?>
	<br />


</div>