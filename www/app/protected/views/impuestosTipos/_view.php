<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTipoCobro')); ?>:</b>
	<?php echo CHtml::encode($data->idTipoCobro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idImpuesto')); ?>:</b>
	<?php echo CHtml::encode($data->idImpuesto); ?>
	<br />


</div>