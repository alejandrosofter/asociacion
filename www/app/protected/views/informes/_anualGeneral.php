<?php  $dataChart=array();
$categorias=array('ENE','FEB',"MAR",'ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC');

 foreach($anualFacturacion as $item)
 $fact[]=$item+0;
 foreach($anualPagos as $item)
 $pagos[]=$item+0;
 foreach($anualCobros as $item)
 $cobros[]=$item+0;
  $facturacion=array('name'=> 'FACTURACION','data'=>$fact);
  $pagos=array('name'=> 'PAGOS','data'=>$pagos);
  $cobros=array('name'=> 'COBROS','data'=>$cobros);
$this->widget('ext.highcharts.HighchartsWidget',
    array('options'=>array(
        'chart'=>array(
            'type'=> 'column',
        ),
        'title'=>array(
            'text'=> 'HISTORIAL ANUAL '
        ),
         'tooltip'=>array(
                'formatter'=>'js:function() { return "<b>"+ this.series.name +"</b>: "+ precio(this.point.y)  }'
                     ),
        'xAxis'=>array(
            'categories'=> $categorias,
        ),
        'yAxis'=>array(
            'title'=>array('text'=>'$ a escala')
        ),
        'plotOptions'=>array(
            'column'=> array(
                'pointPadding'=>0.2,
                'borderWidth'=>'0',
                
            )
        ),
        'series'=>array($facturacion,$pagos,$cobros)
        )));
?>