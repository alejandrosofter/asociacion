<?php  $dataChart=array();
 foreach($model as $item)
  $dataChart[]=array('name'=> $item->obraSocial->nombreOs,'y'=>$item->importe+0);
$this->widget('ext.highcharts.HighchartsWidget',
    array('options'=>array(
        'chart'=>array(
            'plotBackgroundColor'=> null,
            'plotBorderWidth'=> null,
            'plotShadow'=> true,
        ),
        'title'=>array(
            'text'=> 'Gráfica '
        ),
        'tooltip'=>array(
             'formatter'=> 'js:function(){ return "<b>"+this.point.name+"</b>: "+porcentaje(this.percentage)+"%"}'
        ),
        'plotOptions'=>array(
            'pie'=> array(
                'allowPointSelect'=>true,
                'cursor'=>'pointer',
                
            )
        ),
        'series'=>array(
                array(
                    'type'=> 'pie',
                    'name'=>'Browser share',
                    'data'=>$dataChart
                ),
            )
        )));
?>