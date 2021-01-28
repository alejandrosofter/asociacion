<style type="text/css">
<!--
@import url("css/cssTables/style.css");
-->
</style>
</head>
<h1>FACTURACIÓN</h1>
<?php $form=$this->beginWidget('CActiveForm', array('method'=>'get')); ?>
Desde <input size='6' name='fechaDesde' value="<?=$fechaDesde?>"/> Hasta <input size='6' value="<?=$fechaHasta?>" name='fechaHasta'/>
<?php echo CHtml::submitButton('Buscar',array('class'=>'darksmall')); ?>
<?php $this->endWidget(); ?>

<table id="hor-minimalist-a" summary="Employee Pay Sheet">
    <thead>
    	<tr>
    		<th scope="col">Fecha</th>
        	<th scope="col">Obra Social</th>
            <th scope="col">Importe</th>
        </tr>
    </thead>
    <tbody>
    <?$total=0;foreach($model as $item){
        $total+=$item->precio;
        ?>
    	<tr>
        	<td><?=Yii::app()->dateFormatter->format("dd/MM/yyyy",$item->fechaIngreso)?></td>
        	<td><?=substr(isset($item->obraSocial->nick)?$item->obraSocial->nick:'-',0,60)?></td>
        	
            <td style='text-align: right'>$ <?=number_format($item->precio,2)?></td>
        </tr>
       <?}?>
       <tr>
            <td></td>
            <td style='text-align: right'>TOTAL</td>
            
            <td style='text-align: right'>$ <?=number_format($total,2)?></td>
        </tr>
    </tbody>
</table>