<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombreImpuesto')); ?>:</b>
	<?php echo CHtml::encode($data->nombreImpuesto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('porcentaje')); ?>:</b>
	<?php echo CHtml::encode($data->porcentaje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />


</div>