<?php 
$articulo=Articulos::model()->findByPk(2);
echo $articulo->contenido;
?>