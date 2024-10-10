<!DOCTYPE html>
<html lang="en">

<head>

	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Monda">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Playball">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Wire One">
	<link rel="stylesheet" type="text/css" href="js/">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<!-- Add fancyBox -->
	<link rel="stylesheet" href="js/fancybox/source/jquery.fancybox.css?v=2.1.3" type="text/css" media="screen" />
	<link rel="stylesheet" href="js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
	<link rel="stylesheet" href="js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />

	<!-- CONTEXT -->
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/contextMenu/src/jquery.ui.position.js', CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/contextMenu/src/jquery.contextMenu.js', CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/contextMenu/prettify/prettify.js', CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/contextMenu/screen.js', CClientScript::POS_HEAD); ?>

	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/webcam/jquery.webcam.js', CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5', CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/source/jquery.fancybox.pack.js?v=2.1.3', CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5', CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.5', CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7', CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/print.js', CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/timeago.js', CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/block.js', CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/sweetAlert/sweetalert2.min.js', CClientScript::POS_HEAD); ?>
	<!-- <link rel="stylesheet" type="text/css" href="js/sweetAlert/sweetalert2.min.css"> -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<title>
		<?php echo CHtml::encode($this->pageTitle); ?>
	</title>
</head>

<body>
	<script>
		function porcentaje(num) {
			num = parseFloat(num);
			var p = num.toFixed(2).split(".");
			return "" + p[0].split("").reverse().reduce(function(acc, num, i, orig) {
				return num + (i && !(i % 3) ? "," : "") + acc;
			}, "") + "." + p[1];
		}

		function precio(num) {
			num = parseFloat(num);
			var p = num.toFixed(2).split(".");
			return "$" + p[0].split("").reverse().reduce(function(acc, num, i, orig) {
				return num + (i && !(i % 3) ? "," : "") + acc;
			}, "") + "." + p[1];
		}
		$(document).ready(function() {
			$(".mostrarItems").fancybox({
				fitToView: false,
				width: '660px',
				height: '100%',
				autoSize: false,
				closeClick: false,
				openEffect: 'none',
				closeEffect: 'none'
			});
			$(".imprime").fancybox({
				fitToView: false,
				width: '920px',
				height: '100%',
				autoSize: false,
				closeClick: false,
				openEffect: 'none',
				closeEffect: 'none'
			});
			$(".exporta").fancybox({
				fitToView: false,
				width: '700px',
				height: '400px',
				autoSize: false,
				closeClick: false,
				openEffect: 'none',
				closeEffect: 'none'
			});
		});
		jQuery(document).ready(function() {
			jQuery.timeago.settings.allowFuture = true;
			// Spanish
			jQuery.timeago.settings.strings = {
				prefixAgo: "hace",
				prefixFromNow: "dentro de",
				suffixAgo: "",
				suffixFromNow: "",
				seconds: "menos de un minuto",
				minute: "un minuto",
				minutes: "unos %d minutos",
				hour: "una hora",
				hours: "%d horas",
				day: "un día",
				days: "%d días",
				month: "un mes",
				months: "%d meses",
				year: "un año",
				years: "%d años"
			};
			jQuery("abbr.timeago").timeago();

		});
	</script>
	<div class="container">
		<?php $this->widget( 'ext.EChosen.EChosen');?>
		<?php if(isset(Yii::app()->user->id)) $usuario=Usuarios::model()->findByPk(Yii::app()->user->id);?>
		<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>'inverse', // null or 'inverse'
    "brand"=>"FACTU WEB",
    'brandUrl'=>'index.php',

    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'encodeLabel'=>true,
            'items'=>array(
               
               
    ),
))

        )); 

?>


		<div class='bread'>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?>
		</div>
		<div class='contenedor'>
			<h1>Bienvenidos a FACTU WEB para profesionales!</h1>
            <p> Para acceder a la plataforma es necesario iniciar sesión. </p>
            <button type="button" class="btn btn-default" onclick="window.location.href='index.php?r=site/login'">Iniciar Sesión</button>
		</div>

	</div>
	<footer class="footer">
		<div class="container">
			<p>Diseño y programación desarrollado por <a href="http://softer.com.ar" target="_blank">SOFTER</a></p>
			<p>Cualquier duda o consulta por favor contactar a <a href="mailto:alejandro@softer.com.ar">info@softer.com.ar</a></p>

		</div>
	</footer>
</body>

</html>