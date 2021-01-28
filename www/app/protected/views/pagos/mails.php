<h1>Envio de Mails</h1>
A continuación ud. puede enviar los comprobantes de pagos a cada uno de los profesionales: <br>

<strong>Desde </strong><?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
'id'=>'fechaDesde',
    'name'=>'fechaDesde',
    'value'=>$fechaDesde,
    // additional javascript options for the date picker plugin
     'options'=>array(
        'showAnim'=>'fold',
        'dateFormat' => 'yy-mm-dd', // save to db format
        'altFormat' => 'dd-mm-yy', // show to user format
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;width:80px',
    ),
)); ?>

<strong>Hasta </strong><?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'id'=>'fechaHasta',
    'name'=>'fechaHasta',
    'value'=>$fechaHasta,
    // additional javascript options for the date picker plugin
     'options'=>array(
        'showAnim'=>'fold',
        'dateFormat' => 'yy-mm-dd', // save to db format
        'altFormat' => 'dd-mm-yy', // show to user format
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;width:80px',
    ),
)); ?>
  
<button type="button" class="btn btn-primary" id='boton' onclick='enviar()'>Enviar</button>
<img id='loader' style='display:none' src='images/loader.gif'/>
<div id='res'></div>
<script>
function enviar()
{
    $('#loader').show();
 $('#boton').hide();
 $.getJSON( "index.php?r=pagos/getPagos", {fechaDesde:$('#fechaDesde').val(), fechaHasta:$('#fechaHasta').val()}, function( data1 ) {
    for(var i=0;i<data1.length;i++){
        var aux=$('#res').html();
        if(data1[i].email=='')aux+='El profesional <strong>'+data1[i].profesional+'</strong> no tiene email.';
        else{
            aux+='Enviando a <strong>'+data1[i].profesional+'</strong> a <i>'+data1[i].email+ '</i> '+"<span id='loader_"+data1[i].id+"'> <img src='images/loader.gif'/></span><br>";
            $('#res').html(aux);
            $.getJSON( "index.php?r=pagos/enviaMail", {idPago:data1[i].id}, function( data ) {
                
                if(data.enviado.error)
                     aux=' <b><span style="color:green">ENVIADO!</span></b>';
                  else aux=' <b><span style="color:red">FALLA!</span></b>';

                
                $('#loader_'+data.idPago).html(aux);
            });
        
        }
    }
   

 });
$('#boton').show();
   $('#loader').hide();
}
</script>