<style type="text/css">
<!--
@import url("css/cssTables/style.css");
-->
</style>
</head>
<h1>RETENCIONES</h1>
<?php $form=$this->beginWidget('CActiveForm', array('method'=>'get')); ?>
Desde <input size='6' name='fechaDesde' value="<?=$fechaDesde?>"/> Hasta <input size='6' value="<?=$fechaHasta?>" name='fechaHasta'/>
<?php echo CHtml::submitButton('Buscar',array('class'=>'darksmall')); ?>
<?php $this->endWidget(); ?>
<table id="hor-minimalist-a" summary="Employee Pay Sheet">
    <thead>
    	<tr>
    		<th scope="col">Fecha</th>
        	<th scope="col">Importe Sujeto a Retención</th>
            <th scope="col">Importe de Retención</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    <?foreach($model as $item){?>
    	<tr>
        	<td><?=Yii::app()->dateFormatter->format("dd/MM/yyyy",$item->fecha)?></td>
            <td style='text-align: right'>$ <?=number_format($item->aux,2)?></td>
            <td style='text-align: right'>$ <?=number_format($item->valor,2)?></td>
             <td style='text-align: right'><a href='index.php?r=usuarios/itemRetencion&id=<?=$item->idliquidacionRealizada?>'><img src='images/iconos/famfam/basket_put.png'/> </a></td>
           
       <?}?>
    </tbody>
</table>