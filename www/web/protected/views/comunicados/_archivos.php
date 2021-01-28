<div class='row'>
<h4>Archivos</h4>
Seleccione desde su PC los archivos:
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<? Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/up/jquery.uploadify.min.js', CClientScript::POS_BEGIN); ?>
<link rel="stylesheet" type="text/css" href="js/up/uploadify.css">
<script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
				'buttonText' : 'Seleccionar',
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
				'onUploadSuccess' : function(file, data, response) {
            mostrarArchivo(data);
        },
				'swf'      : 'js/up/uploadify.swf',
				'uploader' : 'index.php?r=comunicados/subirImagenes'
			});
		});			

		function mostrarArchivo(nombre){
			var e=nombre.split('.');
			var tmp=e[0];
			var imagen='<div class="thumCarga" id="com_'+tmp+'"> '+nombre+' <img src="images/iconos/famfam/delete.png" onclick="quitar(\''+tmp+'\')"/><input TYPE="hidden" value='+nombre+' id="imagenes[]" name="imagenes[]" /></div>';
			$('#imagenes').html($('#imagenes').html()+imagen);
		}
		function quitar(nombre)
		{
			$('#com_'+nombre).remove();
		}
		function defecto(nombre)
		{
			$('#imagenes > div').attr('class','thumCarga');
			$('#com_'+nombre).attr('class','thumCargaDefecto');
			$('#imagenDefecto').val(nombre);

		}
	</script>
	<div class="contenedorImagenes" id='imagenes'>
	<input id='imagenDefecto' name='imagenDefecto' TYPE='hidden' value='<?=isset($_POST["imagenDefecto"])?$_POST["imagenDefecto"]:"";?>'/>
	</div>
	<? if(isset($_POST['imagenes']))
		foreach($_POST['imagenes'] as $imagen){ ?>
		<script>mostrarArchivo("<?=$imagen?>")</script>
		<?}?>
		<script>defecto("<?=isset($_POST['imagenDefecto'])?$_POST['imagenDefecto']:null?>")</script>
		<br><br><br><br>
		
</div>
<div style='float:right'><input id="file_upload" name="file_upload" type="file" multiple="true"/></div>
<br><br><br>