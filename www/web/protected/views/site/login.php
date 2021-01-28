<div  id='login_usu' class="reveal-modal">
<header id="page-header">
<h1 id="page-title">Login </h1>	
</header>
<?
$model=new LoginForm;
?>
<p>Por favor complete los datos con los campos requeridos:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(

	'htmlOptions'=>array('class'=>'content-form'),
	
	
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son requeridos</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array()); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array()); ?>
		<?php echo $form->error($model,'password'); ?>
		
	</div>
<script>
$('#login_usu').keypress(function(e) {
    if(e.which == 13) {
        acceder();
    }
});
function acceder()
{
	if(valido())logear($('#LoginForm_username').val(),$('#LoginForm_password').val());
}
function logear(usuario_,clave_)
{
	$.post("index.php?r=site/login", { usuario: usuario_, clave: clave_, ajax:'si'},
   function(data) {
   	if(data==1)window.location.href = 'index.php?r=usuarios/miInicio';
   	if(data==0){
   		$('#errores').html('Por favor chequee el usuario y la clave e intente nuevamente');
   		$('#errores').hide('fade');
   		$('#errores').show('fade');
    }
   });
}
function valido()
{
	if($('#LoginForm_username').val()==''){
		alert('El Usuario no puede ser vacio!');
		return false;
	}
	if($('#LoginForm_password').val()==''){
		alert('La Clave no puede ser vacia!');
		return false;
	}
	return true;
}
</script>
	<div class="row buttons">
		<a class="button large" href="#" onclick='acceder()'>Ingresar</a>
	</div>
	<span id='errores' class="required"></span>
<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
