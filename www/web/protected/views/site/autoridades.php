<?php 
$articulo=Articulos::model()->findByPk(4);
echo $articulo->contenido;
?>