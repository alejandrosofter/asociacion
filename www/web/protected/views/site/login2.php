<div class="page">
<div class="box3">
<div class="themetitle2">
		<div class="themetitlewrapper">	
			<div class="titanictitle">Login Sistema <?=utf8_decode(Settings::model()->getValorSistema("DATOS_EMPRESA_FANTASIA"));?></div>
			<div class="titanicsubtitle"></div>

		</div>
</div>

        <div class="onethird">
					<p>
						 En caso de no tener datos para el ingreso por favor contactese a <?=utf8_decode(Settings::model()->getValorSistema("DATOS_EMPRESA_EMAILADMIN"))?>
					</p>
					<p>
						<strong>Solicite + informacion:</strong>
					</p>
					<p style="margin-bottom:0;">
						 T: <?=Settings::model()->getValorSistema("DATOS_EMPRESA_TELEFONO")?><br><br> E: <a href="mailto:<?=Settings::model()->getValorSistema("DATOS_EMPRESA_EMAILADMIN")?>"><?=Settings::model()->getValorSistema("DATOS_EMPRESA_EMAILADMIN")?></a>
					</p>

					
		</div>
				<div class="twothirdslast">
			
						<p>Este es el acceso al sistema <span class='colored'> <?=utf8_decode(Settings::model()->getValorSistema("DATOS_EMPRESA_FANTASIA"));?> </span>. Por favor, rellene el siguiente formulario con sus datos de acceso:</p>

						<div class="form">
						<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'login-form',
							'enableClientValidation'=>true,
							'clientOptions'=>array(
								'validateOnSubmit'=>true,
							),
						)); ?>
							<div class="row">
								<?php echo $form->labelEx($model,'CUIT'); ?>
								<?php echo $form->textField($model,'username',array('class'=>'validate[required,minSize[3]] text-input cforminput')); ?>
								<i>Con guiones ej. 20-30858573-6</i>
								<?php echo $form->error($model,'username',array('class'=>'fancy-error')); ?>
							</div>

							<div class="row">
								<?php echo $form->labelEx($model,'Clave'); ?>
								<?php echo $form->passwordField($model,'password',array('class'=>'validate[required,minSize[3]] text-input cforminput')); ?>
								<?php echo $form->error($model,'password'); ?>
							</div>
								<p><a href='index.php?r=site/clave'>Recordar clave</a></p>
							 <i>Recordar la próxima vez</i>
								<?php echo $form->checkBox($model,'rememberMe'); ?>


							<div class="row buttons">
								<?php echo CHtml::submitButton('Ingresar',array('class'=>'submit cformbutton')); ?>
							</div>

						<?php $this->endWidget(); ?>
						</div><!-- form -->
						<!--END form ID contact_form-->
				</div>
</div>
</div>
<div class="clearfix"></div>
<br><br>