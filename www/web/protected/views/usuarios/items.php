<style type="text/css">
<!--
@import url("css/cssTables/style.css");
-->
</style>
</head>
<h1>ITEMS DEL PAGO (retención)</h1>

<table id="hor-minimalist-a" summary="Employee Pay Sheet">
    <thead>
    	<tr>
    		<th scope="col">Fecha</th>
        	<th scope="col">Detalle</th>
            <th scope="col">Importe</th>
        </tr>
    </thead>
    <tbody>
    <?$total=0;?>
    <?foreach($model as $item){
$importe=$item->paraLiquidar->tipo=='credito'?$item->paraLiquidar->importe:-$item->paraLiquidar->importe;
$importe=number_format($importe,2,'.','');
$total+=$importe;
        ?>
    	<tr>
        	<td><?=Yii::app()->dateFormatter->format("dd/MM/yyyy",$item->paraLiquidar->fecha)?></td>
            <td style='text-align: left'> <?=$item->paraLiquidar->detalle?></td>
            <td style='text-align: right'>$ <?=number_format($importe,2)?></td>
        </tr>
       <?}?>
       <tr>
            <td></td>
            <td style='text-align: right'> TOTAL</td>
            <td style='text-align: right'>$ <?=number_format($total,2)?></td>
        </tr>
    </tbody>
</table>