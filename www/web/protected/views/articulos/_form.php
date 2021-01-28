<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'articulos-form',
	'enableAjaxValidation'=>false,
)); ?>


	<div class="row">
		<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
	"model"=>$model,
    "attribute"=>'contenido',         # Attribute in the Data-Model
    "height"=>'500px',
    "width"=>'100%',
   // "toolbarSet"=>'Full',          # EXISTING(!) Toolbar (see: fckeditor.js)
    "fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",
                                    # Path to fckeditor.php
    "fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",
                                    # Realtive Path to the Editor (from Web-Root)
    
                                    # http://docs.fckeditor.net/FCKeditor_2.x/Developers_Guide/Configuration/Configuration_Options
                                    # Additional Parameter (Can't configure a Toolbar dynamicly)
    ) ); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
