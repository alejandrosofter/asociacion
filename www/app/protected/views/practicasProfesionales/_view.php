<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idProfesional')); ?>:</b>
	<?php echo CHtml::encode($data->idProfesional); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idObraSocial')); ?>:</b>
	<?php echo CHtml::encode($data->idObraSocial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidad')); ?>:</b>
	<?php echo CHtml::encode($data->cantidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPractica')); ?>:</b>
	<?php echo CHtml::encode($data->idPractica); ?>
	<br />


</div>