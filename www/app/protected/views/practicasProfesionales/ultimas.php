<table class='table condensed'>
<tr><th>Fecha</th><th>Profesional</th><th>Os</th><th>Practica</th><th>Cantidad</th></tr>
<?php foreach($ultimas as $practica){?>
<tr class="filaPractica" id="filaPractica_<?=$practica->id?>"><td><?=$practica->fechaPractica?></td><td><?=$practica->profesional->nombreProfesionales?></td><td><?=$practica->obraSocial->nombreOs?></td><td><?=$practica->prac->nombrePractica?></td><td><?=$practica->cantidad?></td></tr>
<?php }?>
</table>

<script>

    $(".filaPractica").click(function(){
    var arr=$(this).attr("id").split("_");
     $(this).toggleClass("seleccionado");
    agregarPractica(arr[1],$(this).hasClass("seleccionado"));
  
    
 
});
</script>