<h1>Envio de Mails</h1>
A continuación ud. puede enviar los comprobantes de pagos a cada uno de los profesionales de la <b>LIQUIDACION REALIZADA</b>: <br>
 

<img id='loader' style='display:none' src='images/loader.gif'/>
<div id='res'></div>
<br><br>
<button type="button" class="btn btn-primary" id='boton' style="width:100%" onclick='enviar()'><i class="icon-envelope"></i> ENVIAR A TODOS</button>
<script>
  profesionales=[];
  consultar();
 function consultar()
  {
    profesionales=[];
 $.getJSON( "index.php?r=liquidaciones/pagos", {id:<?=$_GET['id']?>}, function( data1 ) {
   profesionales=data1;
    for(var i=0;i<data1.length;i++){
        var aux=$('#res').html();
        if(data1[i].profesional.email=='')aux+='El profesional <strong>'+data1[i].profesional.apellido+'</strong> no tiene email.';
        else{
            aux+='<div id="profesionalMail_'+data1[i].id+'">Enviar a <strong>'+data1[i].profesional.apellido+'</strong> '+data1[i].profesional.nombre+' a <i>'+data1[i].profesional.email+ '</i> '+"<span style='display:none' id='loader_"+data1[i].id+"'> <img src='images/loader.gif'/></span></div>";
            $('#res').html(aux);
        }
    }
 });
  }
function enviar()
{

for(var i=0;i<profesionales.length;i++){
  $('#loader_'+profesionales[i].id).show();
            $.getJSON( "index.php?r=pagos/enviaMail", {idPago:profesionales[i].id}, function( data ) {
                  $('#loader_'+data.idPago).hide();
                if(data.enviado.error)
                $('#profesionalMail_'+data.idPago).addClass("error");
              else $('#profesionalMail_'+data.idPago).addClass("text-success");
            });
}
}
</script>