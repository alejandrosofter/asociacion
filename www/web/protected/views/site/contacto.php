<div class="page">
<div class="themetitle2">
		<div class="themetitlewrapper">	
			<div class="titanictitle">Contacto</div>
			<div class="titanicsubtitle">Ingrese los datos del formulario para cualquier duda o consulta</div>

		</div>
</div>
	
<div class="box3">
			<div class="onethird">		
				<span class="title2">Contactanos!</span>
				<div class='light fontsize13'>
				<p>
						<strong>Nuestras Oficinas</strong> 
						 <?=Settings::model()->getValorSistema("DATOS_EMPRESA_DIRECCION")?>
					</p>
					
					<p>
						<strong>Información de contacto</strong>
					</p>
					<p style="margin-bottom:0;">
						 F: <?=Settings::model()->getValorSistema("DATOS_EMPRESA_TELEFONO")?><br/> E: <a href="mailto:<?=Settings::model()->getValorSistema('DATOS_EMPRESA_EMAILADMIN')?>"><?=Settings::model()->getValorSistema("DATOS_EMPRESA_EMAILADMIN")?></a>
					</p>
					<br>
					
				</div>
			</div>	
			<div class="twothirdslast">		
				<span class="title2">Formulario de Contacto</span>
				<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contacto-form',
	'method'=>'post'

)); ?>

				<?php $this->widget('ext.EUserFlash',array('cssClassError'=>'errorSummaryChico','cssClassSuccess' => 'successFlash' )  );?>
							<fieldset>
								<label><strong>Nombre</strong> <span class="required">*</span></label>
								<input data-validation-placeholder="Nombre" type="text" size='100' name="name" id="Myname" value="<?=isset($_POST['name'])?$_POST['name']:''?>" class="validate[required,minSize[3]] text-input cforminput">
							</fieldset>
							
							<fieldset>
								<label><strong>Email</strong> <span class="required">*</span></label>
								<input type="text" name="email" id="myemail" value="<?=isset($_POST['email'])?$_POST['email']:''?>" class="validate[required,minSize[3]] text-input cforminput">
							</fieldset>
							
							<fieldset>
								<label><strong>Asunto</strong> <span class="required">*</span></label>
								<input type="text" name="subject" id="mySubject" value="<?=isset($_POST['subject'])?$_POST['subject']:''?>" class="validate[required,minSize[3]] text-input cforminput">
							</fieldset>
							
							<fieldset>
								<label><strong>Mensaje</strong> <span class="required">*</span></label>
								<textarea name="message" id="Mymessage" rows="8" cols="40" class="validate[required,minSize[3]] text-input cformtextarea"><?=isset($_POST['message'])?$_POST['message']:''?></textarea>
							</fieldset>
							<fieldset>
								<input class="submit cformbutton" name="Mysubmitted" id="Mysubmitted" value="Enviar Mensaje" type="submit">
							</fieldset>
							
						<?php $this->endWidget(); ?>
			</div>	
			<div class="clearfix"></div>
</div>
</div>

