<?php $this->beginContent('//layouts/main'); ?>
<div class="sixteen columns">
 <br><? $this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>'<a href="index.php?r=site/cuenta">Home </a>'
));
?>
</div>


<div class="pageblog">
    
       
  <!--LEFT CONTENT-->
  <div class="contentright">
      
  
    <div class="bigblognews">
      <?=$content;?>
    </div>
    
  
  </div>
  
  
  <!--RIGHT CONTENT-->
<div class="sideleft">

    <span class="title2">Menú de Acciones</span>
    <div class="catline"></div>
    <div class="sidemenu-wrapper">
      <ul class="sidemenu"> 
         <li class="li13"><a href="index.php?r=usuarios/miInicio">Inicio</a></li>
        <li class="li13"><a href="index.php?r=usuarios/facturacion">Facturación</a></li>
        <li class="li13"><a href="index.php?r=usuarios/retenciones">Retenciones Aplicadas</a></li>
      </ul>
    </div>
    <br><br>
    

    

</div>
  

  

<div class="clearfix"></div>

  




<!-- END OF PAGE Class-->
</div>
<?php $this->endContent(); ?>