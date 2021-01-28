<h3>Plantilla</h3>

<h3>General</h3>
<div class="row">
<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
	"value"=>Settings::model()->getValorSistema('PLANTILLA_BASE'),
    "name"=>'PLANTILLA_BASE',         # Attribute in the Data-Model
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