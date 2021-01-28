<?php
$this->breadcrumbs = array(
    'Configuraciónes' => array(''),
);

?>

<h1>Variables de <span class="bolder colored">Sistema</span></h1>
A traves de esta interfaz ud. podrá modificar valores del sistema que alteran su funcionamiento en distintas áreas:
<br><br>
<div class='form'>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'settings-form',
    'enableAjaxValidation' => false,
        ));
//$this->widget('ext.bootstrap.widgets.BootAlert', array(
//    'id' => 'alert',
//    'keys' => array('success', 'info', 'warning', 'error'),
//));
?>

    <?php
    $this->widget('zii.widgets.jui.CJuiTabs', array(
        'tabs' => array(
            //'Sistema' => $this->renderPartial('_variableGenerales', array(), true),

            'Datos de la Empresa' => $this->renderPartial('_variablesDatosEmpresa', array(), true),
        'Impresiones'=>$this->renderPartial('_plantilla',array(),true)),
        // 'Tareas Programadas(Crons)'=>$this->renderPartial('/crons/index',array('model'=>new Crons),true)),
        // additional javascript options for the accordion plugin
        'htmlOptions' => array(
        // 'style'=>'height:450px;',
        //'height'=>500
        //  'collapsible'=>true,
        ),
    ));
    ?>




    <div class="actions">
<?php echo CHtml::submitButton('Guardar', array('class' => 'button big round blue')); ?>
    </div>

<?php $this->endWidget(); ?>
</div>