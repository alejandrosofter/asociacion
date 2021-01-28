<?php if($enviado['enviado']['mensaje']==""){?>
<h3>EL MAIL SE HA ENVIADO CORRECTAMENTE a  <small><?=$pago->profesional->nombreProfesionales?></small> <span style="color:green"> <?=$pago->profesional->email?></span></h3>
<?php }else{?>
<h3>NO SE PUEDE ENVIAR EL MAIL a <small><?=$pago->profesional->nombreProfesionales?></small><span style="color:red"> <?=$pago->profesional->email?>  <?=$enviado['enviado']['mensaje']?></span></h3>

<?php }?>