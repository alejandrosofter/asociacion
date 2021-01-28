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
    "brand"=>"OFTAL V3.0",
    'brandUrl'=>'index.php',

    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'encodeLabel'=>true,
            'items'=>array(
               
                array('label'=>'Datos','icon'  => ' icon-file', 'url'=>'#', 'items'=>array(
                       array('label'=>'Profesionales','url'=>'index.php?r=profesionales',"items"=>array(
	  array('label'=>'Ver Profesionales','url'=>'index.php?r=profesionales'),
  array('label'=>'Agregar Profesional','icon'  => 'icon-plus','url'=>'index.php?r=profesionales/create'),
)),
                    array('label'=>'Obras Sociales', 'url'=>'index.php?r=obrasSociales',"items"=>array(
	array('label'=>'Obras Sociales', 'url'=>'index.php?r=obrasSociales'),
array('label'=>'Agregar','icon'  => 'icon-plus', 'url'=>'index.php?r=obrasSociales/create'),
"--",

)),
                    array('label'=>'Prácticas', 'url'=>'index.php?r=practicas',"items"=>array(
	array('label'=>'Ver Prácticas', 'url'=>'index.php?r=practicas'),
array('label'=>'Agregar','icon'  => 'icon-plus', 'url'=>'index.php?r=practicas/create'),
	array('label'=>'Ver Categorias','icon'  => '', 'url'=>'index.php?r=practicasCategoria'),
)),
                  
                     
                    '---',
                    array('label'=>'Datos Profesionales WEB','icon'=>'icon-globe', 'url'=>'index.php?r=articulos/update&id=2'),
	 								array('label'=>'Datos Obra Social WEB','icon'  => 'icon-globe','url'=>'index.php?r=articulos/update&id=1'),
	 								"--",
	 			array('label'=>'Cta. Cte OBRA SOCIAL','icon'  => 'icon-user', 'url'=>'index.php?r=obrasSociales/ctaCte'),
	 			array('label'=>'Cta. Cte PROFESIONAL','icon'  => 'icon-user', 'url'=>'index.php?r=profesionales/ctaCte'),
	 			"--",
	 			array('label'=>'Archivos Nomencladores PUBLICO','icon'  => '', 'url'=>'index.php?r=archivosNomencladores'),
                )),
                array('label'=>'Facturacion','icon'  => 'icon-arrow-down', 'url'=>'#', 'items'=>array(
		array('label'=>'Obras Sociales', 'url'=>'','items'=>array(

array('label'=>'Ver Facturas', 'url'=>'index.php?r=FacturasObrasSocial'),
	 array('label'=>'Nueva Facturacion','url'=>'index.php?r=FacturasObrasSocial/create'),
	 array('label'=>'Ingreso AFIP','url'=>'index.php?r=FacturasObrasSocial/afip'),
	'--',
	array('label'=>'Exportar', 'url'=>'index.php?r=FacturasObrasSocial/exportar',
	//			'linkOptions'=>array('class'=>'exporta','data-fancybox-type'=>'iframe')
			 ),
'--',
	 array('label'=>'Notas de Debito/Credito', 'url'=>'#', 'items'=>array(
                   
                    array('label'=>'Ver Notas', 'url'=>'index.php?r=notasCredito'),
                    array('label'=>'Agregar', 'url'=>'index.php?r=notasCredito/create'),

                )),
	  "---",
	 array('label'=>'Informe', 'url'=>'index.php?r=FacturasObrasSocial/informe'),
                 
)),
		array('label'=>'Profesionales', 'url'=>'','items'=>array(
array('label'=>'Ver Facturas', 'url'=>'index.php?r=facturasProfesional'),

	 array('label'=>'Nueva Facturacion','url'=>'index.php?r=facturasProfesional/create'),
	 "--",
	 array('label'=>'Informe', 'url'=>'index.php?r=facturasProfesional/informe'),
	 // array('label'=>'Exportar (.txt)', 'url'=>'index.php?r=facturasProfesional/exportar'),
)),
		'==',
		array('label'=>'Liquidaciones WEB','icon'=>'icon-globe', 'url'=>'index.php?r=liquidacionesWeb'),
			'==',
		array('label'=>'Facturacion (liquidaciones Web pend.)', 'url'=>'index.php?r=liquidacionesWeb/facturarPendientes')
						
	
                     
                   
                )),
	  array('label'=>'Cobros','icon'  => 'icon-arrow-down', 'url'=>'#', 'items'=>array(
                 
                    array('label'=>'Ver Cobros', 'url'=>'index.php?r=cobros'),
 array('label'=>'Nuevo Cobros', 'url'=>'index.php?r=cobros/create'),
 "---",
  array('label'=>'Deudas (Obras Sociales)', 'url'=>'index.php?r=obrasSociales/deuda'),


                   
                 

                   
                )),
                array('label'=>'Pagos','icon'  => 'icon-arrow-up', 'url'=>'#', 'items'=>array(
              
	array('label'=>'Ver Pagos', 'url'=>'index.php?r=liquidaciones'),
	 array('label'=>'Nuevo Pago', 'url'=>'index.php?r=pagos/createLote'),
		  '---',
	array('label'=>'Pagos a PROFESIONALES (individual)', 'url'=>'index.php?r=pagos/'),
	array('label'=>'Resumen PROFESIONALES (individual)', 'url'=>'index.php?r=pagos/resumenProfesional'),
	 "---",
  array('label'=>'Deuda (Profesionales)', 'url'=>'index.php?r=profesionales/deuda'),

                   
                 

                   
                )),
	
                
 //                  array('label'=>'Prácticas','icon'  => 'icon-book', 'url'=>'#', 'items'=>array(
                   
 //                    array('label'=>'Prácticas PROFESIONALES', 'url'=>'index.php?r=practicasProfesionales'),
 //                    array('label'=>'Agregar practica a PROFESIONAL', 'url'=>'index.php?r=practicasProfesionales/create'),
	// '--',
	// array('label'=>'Modificar en LOTE', 'url'=>'index.php?r=practicasProfesionales/modificarEnLote'),
	// 	'--',
	// 	array('label'=>'Informe por OBRA SOCIAL', 'url'=>'index.php?r=informes/DetalleObrasSociales'),
	// 		array('label'=>'Informe por PROFESIONAL', 'url'=>'index.php?r=informes/DetalleProfesional'),
 //                )),
                  array('label'=>'Nomencladores','icon'  => 'icon-tags', 'url'=>'#', 'items'=>array(
                   
                    array('label'=>'Ver Nomencladores', 'url'=>'index.php?r=facturasProfesionalNomencladores'),
                    array('label'=>'Agregar', 'url'=>'index.php?r=facturasProfesionalNomencladores/create'),
                    "--",
                    array('label'=>'Rangos', 'url'=>'index.php?r=facturasProfesionalRangoNomencladores'),
                    "--",
                    array('label'=>'Importar Excel', 'url'=>'index.php?r=facturasProfesionalNomencladores/importar'),

                )),
                  array('label'=>'Auditoria','icon'  => 'icon-signal', 'url'=>'index.php?r=site/auditoria'),
                 
                
                 
                 array('label'=>'','encodeLabel'=>true,'icon'  => '', 'url'=>'#','activeCssClass'=>'icon-user', 'items'=>$this->menu),
            ),
        ),

        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                array('label'=>(isset(Yii::app()->user->id))?$usuario->nombreUsuario:'','icon'  => 'user white', 'url'=>'#', 'items'=>array(
            

                    array('label'=>'Datos de Sistema', 'url'=>'index.php?r=settings/variablesSistema'),
                    array('label'=>'Envio de Mails', 'url'=>'index.php?r=mail'),
                     array('label'=>'Usuarios', 'url'=>'index.php?r=usuarios'),
                     '---',
                     array('label'=>'Condiciones IVA', 'url'=>'index.php?r=condicionIva'),
                   '*--',
	  array('label'=>'Tipo de Cobros', 'url'=>'index.php?r=cobrosTipos'),
                    array('label'=>'Agregar', 'icon'  => 'icon-plus','url'=>'index.php?r=cobrosTipos/create'),
		 '---',
                    array('label'=>'Impuestos', 'url'=>'index.php?r=impuestos'),
                    array('label'=>'Tabla Retenciones', 'url'=>'index.php?r=tablaRetenciones'),
             
                )),
            ),
        ),
    ),
)); ?>


		<div class='bread'>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?>
		</div>
		<div class='contenedor'>
			<?=$content?>
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