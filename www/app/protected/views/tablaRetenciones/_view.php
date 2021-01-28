<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idImpuesto')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idImpuesto), array('view', 'id'=>$data->idImpuesto)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('masDe')); ?>:</b>
	<?php echo CHtml::encode($data->masDe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('a')); ?>:</b>
	<?php echo CHtml::encode($data->a); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agregadoEfectivo')); ?>:</b>
	<?php echo CHtml::encode($data->agregadoEfectivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agregadoPorcentaje')); ?>:</b>
	<?php echo CHtml::encode($data->agregadoPorcentaje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exedenteEfectivo')); ?>:</b>
	<?php echo CHtml::encode($data->exedenteEfectivo); ?>
	<br />


</div>