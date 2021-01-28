<?php 
$articulo=Articulos::model()->findByPk(1);
echo $articulo->contenido;
?>