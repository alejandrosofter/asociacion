<?php $this->beginContent('//layouts/main'); ?>
<div class="sixteen columns">

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
        <li class="li13"><a href="index.php?r=articulos/update&id=1">Editar Socios</a></li>
        <li class="li13"><a href="index.php?r=articulos/update&id=2">Editar Obras Sociales</a></li>
        <li class="li13"><a href="index.php?r=articulos/update&id=3">Editar Plantilla Email</a></li>
        <li class="li13"><a href="index.php?r=emails">Emails</a></li>
        <li class="li13"><a href="index.php?r=comunicados">Comunicados</a></li>
        <li class="li13"><a href="index.php?r=comunicados/create">Nuevo Comunicado</a></li>
      </ul>
    </div>
    <br><br>
    

    

</div>
  

  

<div class="clearfix"></div>

  




<!-- END OF PAGE Class-->
</div>
<?php $this->endContent(); ?>