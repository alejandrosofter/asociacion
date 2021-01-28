<header id="page-header">
<h1 id="page-title">Proyectos en Ejecución</h1>
</header>
<div class="one-fourth">
<?=$this->renderPartial('/proyectos/_activos');?>
</div>
<div class="two-thirds column-last">
<?=$this->renderPartial('/proyectos/_viewProyecto',array('model'=>$model));?>
</div>