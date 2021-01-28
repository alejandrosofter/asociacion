<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPago')); ?>:</b>
	<?php echo CHtml::encode($data->idPago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('importeRetencion')); ?>:</b>
	<?php echo CHtml::encode($data->importeRetencion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('importeBase')); ?>:</b>
	<?php echo CHtml::encode($data->importeBase); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTablaRetencion')); ?>:</b>
	<?php echo CHtml::encode($data->idTablaRetencion); ?>
	<br />


</div>