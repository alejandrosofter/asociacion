<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idObraSocial')); ?>:</b>
	<?php echo CHtml::encode($data->idObraSocial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idFactura')); ?>:</b>
	<?php echo CHtml::encode($data->idFactura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idCobro')); ?>:</b>
	<?php echo CHtml::encode($data->idCobro); ?>
	<br />


</div>