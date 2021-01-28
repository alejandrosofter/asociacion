<h3>Datos de la Empresa</h3>
<div style="margin:15px">
	<div class="">
		
		<b><?php echo 'Razón Social de la Empresa' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_RAZONSOCIAL',Settings::model()->getValorSistema('DATOS_EMPRESA_RAZONSOCIAL'),array('class'=>'text','size'=>50)); 
		
		?>
		
		<span class='help-block'><b>NOTA: </b>Nombre que se usa para el aspecto financiero e impositivo.</span>
		
	</div>
	<div class="">
		
		<b><?php echo 'CBU CUENTA de la Empresa' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_CBU',Settings::model()->getValorSistema('DATOS_EMPRESA_CBU'),array('class'=>'text','size'=>100)); 
		
		?>
		
		<span class='help-block'><b>NOTA: </b>para factura de credito.</span>
		
	</div>
	<div class="">
		
		<b><?php echo 'IMPORTE MINIMO FACTURA CREDITO MIPYME' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_MINIMO_FC',Settings::model()->getValorSistema('DATOS_EMPRESA_MINIMO_FC'),array('class'=>'text','size'=>100)); 
		
		?>
		
		<span class='help-block'><b>NOTA: </b>para factura de credito.</span>
		
	</div>
<div class="">
		<b><?php echo 'Inicio de Actividad' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_INICIOACTIVIDAD',Settings::model()->getValorSistema('DATOS_EMPRESA_INICIOACTIVIDAD'),array('class'=>'text','maxlength'=>64)); 
		
		?>
		
		
	</div>
 
<div class="">
		<b><?php echo 'Ingresos Brutos' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_INGBRUTOS',Settings::model()->getValorSistema('DATOS_EMPRESA_INGBRUTOS'),array('class'=>'text','maxlength'=>64)); 
		
		?>
		
		
	</div>
	<div class="">
		<b><?php echo 'Nombre de Fantasia de la Empresa ' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_FANTASIA',Settings::model()->getValorSistema('DATOS_EMPRESA_FANTASIA'),array('class'=>'text','size'=>50)); 
		
		?>
		
		<span class='help-block'><b>NOTA: </b>Nombre usado para el informal de las impresiones.</span>
		
	</div>
	<div class="">
		<b><?php echo 'CUIT de la Empresa' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_CUIT',Settings::model()->getValorSistema('DATOS_EMPRESA_CUIT'),array('class'=>'text','maxlength'=>64)); 
		
		?>
		<span class='help-block'><b>NOTA: </b>NO COLOCAR GUIONES ni espacios!.</span>
		
	</div>
<div class="">
		<b><?php echo 'CONDICION IVA' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_CONDICIONIVA',Settings::model()->getValorSistema('DATOS_EMPRESA_CONDICIONIVA'),array('class'=>'text','maxlength'=>64)); 
		
		?>
		
	</div>
	<div class="">
		<b><?php echo 'Dirección' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_DIRECCION',Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECCION'),array('class'=>'text','maxlength'=>64)); 
		
		?>
		
		
	</div>
	<div class="">
		<b><?php echo 'Teléfonos' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_TELEFONO',Settings::model()->getValorSistema('DATOS_EMPRESA_TELEFONO'),array('class'=>'text','maxlength'=>64)); 
		
		?>
	</div>
	<div class="">
		<b><?php echo 'Direción de retiro de Mercaderia/servicios' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_DIRECIONRETIRO',Settings::model()->getValorSistema('DATOS_EMPRESA_DIRECIONRETIRO'),array('class'=>'text','maxlength'=>64)); 
		
		?>
		
	</div>
<div class="">
		<b><?php echo 'Localidad' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_LOCALIDAD',Settings::model()->getValorSistema('DATOS_EMPRESA_LOCALIDAD'),array('class'=>'text','maxlength'=>64)); 	?>
	</div>
	<div class="">
		<b><?php echo 'Domicilio Fiscal' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_DOMFISCAL',Settings::model()->getValorSistema('DATOS_EMPRESA_DOMFISCAL'),array('class'=>'text','maxlength'=>64)); 	?>
	</div>
	<div class="">
		<b><?php echo 'Provincia' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_PCIA',Settings::model()->getValorSistema('DATOS_EMPRESA_PCIA'),array('class'=>'text','maxlength'=>64)); 	?>
	</div>
	<div class="">
		<b><?php echo 'Horarios de Atención' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_HORARIOS',Settings::model()->getValorSistema('DATOS_EMPRESA_HORARIOS'),array('class'=>'text','maxlength'=>64)); 	?>
	</div>
	<div class="">
		<b><?php echo 'Site WEB' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_SITE',Settings::model()->getValorSistema('DATOS_EMPRESA_SITE'),array('class'=>'text','maxlength'=>64)); ?>
	</div>
	<div class="">
		<b><?php echo 'Email Administración' ?></b>
		<?php echo CHtml::textField('DATOS_EMPRESA_EMAILADMIN',Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN'),array('class'=>'text','maxlength'=>64)); ?>
	</div>
<div class="">
		<b><?php echo 'Reseña de la empresa' ?></b>
		<?php echo CHtml::textArea('DATOS_EMPRESA_RESENAEMPRESA',Settings::model()->getValorSistema('DATOS_EMPRESA_RESENAEMPRESA'),array('class'=>'text','rows'=>'4','maxlength'=>64));?>
</div>

   </div>