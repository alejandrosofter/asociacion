<link rel="stylesheet" type="text/css" href="css/impresion.css"/>
<?php
  if(!isset($pdf))
     $this->widget('ext.mPrint.mPrint', array(
          'title' => 'Imprime',          //the title of the document. Defaults to the HTML title
          'tooltip' => 'Imprime',        //tooltip message of the print icon. Defaults to 'print'
          'text' => 'Imprimir',   //text which will appear beside the print icon. Defaults to NULL
          'element' => '#impresionMes',        //the element to be printed.
         // 'debug' => true,  
          'publishCss' => true,       //publish the CSS for the whole page?
          'visible' => false,  // NO SE POR QUE CHOTA NO ME IMPRIME
                  //  'alt' => 'print',       //text which will appear if image cant be loaded
         // 'debug' => true,            //enable the debugger to see what you will get
          //'id' => 'link'         //id of the print link
      ));
?> 
<div id='impresionMes'>
<h1>Detalle Facturación <?=$mes?>-<?=$ano?></h1>
<table class="tablaDos">
<tr>
	<th style='width:100px'>Fecha</th><th>Obra Social</th><th style='text-align:right'>Importe</th></tr>
	<?php $tot=0;
	 foreach($data as $item){
		$tot+=$item->importe;?> 
	<tr><td class='nombre'><?=Yii::app()->dateFormatter->format("dd-MM-yyyy",$item->fecha)?></td><td class='nombre'><?=$item->obraSocial->nombreOs;?></td><td class='importe' style='text-align:right'>$ <?=number_format($item->importe,2)?></td>

</tr>
<?php }?>
<tr><th></th><th></th> <th style='text-align:right'><big><big> $<?=number_format($tot,2)?></big></big></th></tr>
</table>

<?=count($data)==0?'<i>No hay pagos realizados</i>':'';?>
</div>