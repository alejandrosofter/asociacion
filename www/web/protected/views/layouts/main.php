<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <link rel="stylesheet" type="text/css" href="css/cssTables/style.css" />
        <link rel="stylesheet" type="text/css" href="css/screen_styles.css" />
        <link rel="stylesheet" type="text/css" media="only screen and (min-width:1441px) and (max-width:2560px)" href="css/screen_layout_xlarge.css" />
        <link rel="stylesheet" type="text/css" media="only screen and (min-width:981px) and (max-width:1440px)" href="css/screen_layout_normal.css" />
        <link rel="stylesheet" type="text/css" media="only screen and (min-width:800px) and (max-width:980px)" href="css/screen_layout_large.css" />
        <link rel="stylesheet" type="text/css" media="only screen and (min-width:480px) and (max-width:799px)" href="css/screen_layout_medium.css" />
        <link rel="stylesheet" type="text/css" media="only screen and (min-width:50px) and (max-width:479px)" href="css/screen_layout_small.css" />
        
        <link href="images/favicon.ico" rel="shortcut icon"/>
        <!--[if lt IE 9]>
         <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <!--[if IE 7]>
         <link rel="stylesheet" type="text/css" href="css/IE7fix.css" />
        <![endif]-->
        <script src="js/respond.src.js"></script> 
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,400,300,300italic' rel='stylesheet' type='text/css'>

        <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>   

        <!-- Tinynav --> 
        <script type="text/javascript" src="js/tinynav.min.js"></script>

        
        <!-- Search autocomplete --> 
        <script type="text/javascript" src="js/jquery.jsonSuggest-2.js"></script>
        <script type="text/javascript" src="js/searchData/testData.js"></script>
        <link rel="stylesheet" href="css/search_styles.css" type="text/css" />
      

<meta name="description" content="Sitio WEB de la ASOCIACION AUSTRAL DE OFTALMOLOGICA, realize el login para ver sus datos!" />
<meta name="google" content="notranslate" />
<meta name="robots" content="asociacion,austral,oftalmologia,patagonia,comodoro,rivadavia,cr,chubut,de,iose,osde,socios,www.australdeoftalmologia.com,australdeoftalmologia.com" />
<meta name="googlebot" content="asociacion,austral,oftalmologia,patagonia,comodoro,rivadavia,cr,chubut,de,iose,osde,socios,www.australdeoftalmologia.com,australdeoftalmologia.com" />
        <!-- Always on Top Script -->
        <script>
            jQuery(document).ready(function(){
              function sticky() {
                var y = jQuery(window).scrollTop();
                if( y > jQuery('div.topwhite').height() ){
                  jQuery('#fixtop').css({
                    'position': 'fixed',
                    'top': '0',
                    'width': jQuery('#fixtop').width(), 'box-shadow': '0px 2px 2px -2px #999'
                  });
                  jQuery('div.box1').css({
                    'padding-top': jQuery('div.topwhite').height()
                   })
                } else {
                  jQuery('#fixtop').removeAttr('style');
                  jQuery('div.box1').removeAttr('style');
                }
              };
              jQuery(window).scroll(sticky);
              jQuery(window).resize(sticky);
            });

        </script>       


        <!-- Validate Newsletter -->                
        <script src="js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
        <script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
        <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
        <style>.form-validation-field-0formError{margin-left:15px !important;}</style>
        <script>
            jQuery(document).ready(function(){
                // binds form submission and fields to the validation engine
                jQuery("#formID").validationEngine({promptPosition : "topLeft", scroll: false});
            });

            function checkHELLO(field, rules, i, options){
                if (field.val() != "HELLO") {
                    // this allows to use i18 for the error msgs
                    return options.allrules.validate2fields.alertText;
                }
            }
        </script>
        
        
        <!-- FancyBox main JS and CSS files -->
       <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/source/jquery.fancybox.pack.js?v=2.1.3', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.5', CClientScript::POS_HEAD); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7', CClientScript::POS_HEAD); ?>
<link rel="stylesheet" href="js/fancybox/source/jquery.fancybox.css?v=2.1.3" type="text/css" media="screen" />
<link rel="stylesheet" href="js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<link rel="stylesheet" href="js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
          
        <!-- Loading JS -->
        <script type="text/javascript" src="js/menuwhite.js"></script>
        <script type="text/javascript" src="js/tooltip.js"></script>
        <script type="text/javascript" src="js/jquery.tipsy.js"></script>   
        <script src="js/loginwhite.js"></script>
        <script type="text/javascript" src="js/ticker00.js"></script>
        
        
        <!-- Loads transitions and animations --> 
        <script type="text/javascript" src="js/ani/jquery-ui.js" ></script>
        <script type="text/javascript" src="js/ani/modernizr.js" ></script>  
        
        <!-- Initializing & Custom functions -->
        <script type="text/javascript" src="js/functions.js"></script> 
        
        <!-- Tweets Script -->
        <script src="js/jquery.tweet.js" type="text/javascript"></script> 

        
        <!-- CarouFredSell -->
        <script type="text/javascript" src="js/jquery.carouFredSel-6.1.0-packed.js"></script>
        <script type="text/javascript" src="js/helper-plugins/jquery.mousewheel.min.js"></script>
        <script type="text/javascript" src="js/helper-plugins/jquery.touchSwipe.min.js"></script>


        <!-- CSS STYLE -->
        <link rel="stylesheet" type="text/css" href="css/revstyle.css" media="screen" />    
        <!-- REVOLUTION BANNER CSS SETTINGS -->
        <link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" />          
        <!-- jQuery KenBurn Slider  --> 
        <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.plugins.min.js"></script>            
        <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>         
        <script type="text/javascript" src="js/activate-revolution-slider.js"></script> 


    </head>
    <body id="top" class="boxedbg"> 
    <div  class="boxedcontainer"> 

    
        <!-- TOP -->
        <div id="fixtop" class="default whiteunderline">
            <div class="topwhite">
                <div class="topwhite left"></div>
                <div class="topwhite middle">
                     <div class="logowhite left">
                         <div class="slogan">
                             <ul id="slide" class="fade">
                                
                                <li>Todas las Obras Sociales</li>
                                <li>Sistematización de la información</li>
                                <li>Acceso de estado de cuenta WEB</li>
                             </ul>

                         </div>

                         <a class="logodark" href="index.php?r=site"></a>
                    </div>

                    <?php if(!isset(Yii::app()->user->id)){?>
                    <div class='login'><a href='index.php?r=site/login'><img src='images/header_log.png'/> Acceso a Socios</a></div>
                   <?php }else{?>
                     <div class="login"><a href="index.php?r=site/logout" >(salir)</a><img src='images/header_log.png'/><a   href="index.php?r=usuarios/miInicio" ><?=Yii::app()->user->usuario ?></a> </div>
                    <?php }?>
               <div class='login'><img src='images/header_mail.png'/>  <?=Settings::model()->getValorSistema("DATOS_EMPRESA_EMAILADMIN")?></div>
                
                    <!-- MENU -->
                    <nav>
                        <div id="menuWhite">
                            <ul class="menu">
                                <li><a href="index.php"><span>Inicio</span> </a><span class='miniMenu'>home</span></li>
                                <li><a href="index.php?r=site/autoridades"><span>Autoridades</span></a><span class='miniMenu'>ciclo 2016 - 2018</span></li>
                                <li><a href="index.php?r=site/socios"><span style='color:red'>TURNOS</span></a> <span class='miniMenu'>Profesionales</span></li>
                                <li><a href="index.php?r=site/obrasSociales"><span>Obras Sociales</span></a> <span class='miniMenu'>con convenios</span></li>
                                <li><a href="index.php?r=site/dondeEstamos"><span>Ubicación</span></a><span class='miniMenu'>donde estamos?</span></li>
                                <li><a href="index.php?r=site/contacto" class="parent"><span>Contactanos</span></a><span class='miniMenu'>via tel o mail</span></li>
                                 
                            </ul>
                        </div>
                    </nav><!-- END OF MENU -->
                               
                </div>
            </div>
        </div><!-- End of TOP -->

<div class='contenedor'>
<?=$content?>
</div>
        
        <!-- FOOTER -->
        <footer>
            <div class="footerwrapper">
                    
                    <div class="footerbrake2"></div>
                    <div class="fcol2">
                             
                    </div>
                    <div class="footerbrake"></div>
                    <div class="fcol3">
                             <div class="ftitle">Ubicación</div>
                              <img src='images/icon_footer_loc.png'/> <?=Settings::model()->getValorSistema("DATOS_EMPRESA_DIRECCION")?>
                    </div>
                    <div class="footerbrake2"></div>
                    <div class="fcol4">
                             <div class="ftitle">Información Privada</div>
                             El acceso a la información privada de esta WEB se maneja de forma segura mediante protocolos de seguridad.
                    </div>
                    <div class="footerbrake2"></div>
                    <div class="fcol5">
                             <div class="ftitle">Contacto</div>
                             <img src='images/icon_footer_phone.png'/> <?=Settings::model()->getValorSistema("DATOS_EMPRESA_TELEFONO")?><br>
                             <img src='images/icon_footer_mail.png'/> <?=Settings::model()->getValorSistema("DATOS_EMPRESA_EMAILADMIN")?>
                             
                            
                    </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="line6"></div>
            
            <div class="copyright">
                <div class="footerlogowrapper">
                    <div class="footerlogo">
                        <a href="#"><img src="images/footer-logo_titanicthemes.png" alt="TitanicThemes logo"/></a>
                        
                    </div>
                </div>
                <div class="fright">Copyright ©  2013 <a href="http://softer.com.ar" class="flink2">Softer</a>. Todos los Derechos Reservados</div>
               
                <div class="clearfix"></div>
               
            </div>
<p id="back-top"><a href="#top"><span></span>Top</a></p>
        </footer>
        <!-- END OF FOOTER -->

    </div>

    </body>

</html>