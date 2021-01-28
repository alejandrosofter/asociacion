<div class="comunicado">

<small><?=Yii::app()->dateFormatter->format("dd/MM/yyyy",$data->fecha)?></small> <?=$data->mensaje?>
<? foreach($data->archivos as $archivo){?>
<a href='archivos/comunicados/<?=$archivo->nombreArchivo;?>'><img src='images/iconos/famfam/attach.png'></img></a>
<?}?>
</div>