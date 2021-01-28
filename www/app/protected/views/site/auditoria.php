<h1>AUDITORIA <small>GRAL</small> <input type="number" id="ano" onchange="cambiaAno()" class="span1" value="<?=$anio?>"> </h1>
<div id="grafica" class="span10">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <h3>GRAFICA GRAL <small> <b>periodo <?=$anio?></b></small></h3> 
		<canvas id="myChart"  height="100"></canvas>
</div>
<div  class="span9">
   <div  class="span4">
    	 <div  class="span4"> <h3>PENDIENTES  <small> <b>periodo <?=$anio?></b></small></h3>
        <!-- <canvas id="myChart2" height="200" ></canvas> -->
<div id="pendientes"></div>
       </div>  
	</div>
	<div  class="span4"><h3>TOTALES <small>GENERALES <b>periodo <?=$anio?></b></small></h3>  <canvas id="myChart3" height="200" ></canvas></div>  

</div>


<script>

init()
function init()
{
	cambiaAno();
}
var chart=null;
var chart2=null;
var chart3=null;
var randomColorGenerator = function () { 
    return '#' + (Math.random().toString(16) + '0000000').slice(2, 8); 
};
function randomColors(data)
{
    var sal=[];
    for (var i = data.length - 1; i >= 0; i--)sal.push(randomColorGenerator());
        return sal;
}
function getTotal(data)
{
  var sum=0;
  for (var i = data.length - 1; i >= 0; i--)  sum+=data[i]*1;
  return sum;
}
function iniciarGraficaTotales(datos)
{
  var labels=['FACTURACION',"COBROS","PAGOS","GANANCIA","RETENCIONES"];
  var datosRip=[getTotal(datos[0].data),getTotal(datos[1].data),getTotal(datos[4].data),getTotal(datos[2].data),getTotal(datos[3].data)];
  console.log(datosRip)
   var data = {
    datasets: [{
        label:"TOTALES",
        data: datosRip,
        backgroundColor:['#2c906a',"#f0b629","#81b7d3","#d45a97","#ec1c1c"]
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: labels
};

    var canvas=document.getElementById('myChart3');
    var ctx = canvas.getContext('2d');
    if(chart3)chart3.destroy();
   chart3 = new Chart(ctx,{
    type: 'pie',
    data: data,
    options:  {
        tooltips: {
  callbacks: {
    label: function(tooltipItem, data) {
      //get the concerned dataset
      var dataset = data.datasets[tooltipItem.datasetIndex];
      var label = data.labels[tooltipItem.index];
      var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
        return previousValue + currentValue;
      });
      //get the current items value
      var currentValue = dataset.data[tooltipItem.index];
      //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
      var percentage = Math.floor(((currentValue/total) * 100)+0.5);
      var importe=currentValue.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
      return label+": $ "+importe+" ("+percentage + "% )";
    }
  }
} ,
        legend: {
            display: false,
            labels: {
                fontColor: 'rgb(255, 99, 132)'
            }
        }
}
});
}
function iniciarGraficaOs(datos,obrasSociales)
{
   var data = {
    datasets: [{
        label:"ANUAL PENDIENTES POR OS",
        data: datos,
        backgroundColor:randomColors(datos)
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: obrasSociales
};

    var canvas=document.getElementById('myChart2');
    var ctx = canvas.getContext('2d');
    if(chart2)chart2.destroy();
	 chart2 = new Chart(ctx,{
    type: 'pie',
    data: data,
    options:  {
        tooltips: {
  callbacks: {
    label: function(tooltipItem, data) {
      //get the concerned dataset
      var dataset = data.datasets[tooltipItem.datasetIndex];
      var label = data.labels[tooltipItem.index];
      var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
        return previousValue + currentValue;
      });
      //get the current items value
      var currentValue = dataset.data[tooltipItem.index];
      console.log(data);
      console.log(tooltipItem)
      //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
      var percentage = Math.floor(((currentValue/total) * 100)+0.5);
      var importe=currentValue.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
      return label+": $ "+importe+" ("+percentage + "% )";
    }
  }
} ,
        legend: {
            display: false,
            labels: {
                fontColor: 'rgb(255, 99, 132)'
            }
        }
}
});
}
function iniciarGrafica(datos)
{
	var canvas=document.getElementById('myChart');
	var ctx = canvas.getContext('2d');

if(chart)chart.destroy();
chart= new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: 
    {
        labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
        datasets: datos
    }
    ,
options: {
	 scales: {
            yAxes: [{
                ticks: {
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return '$' + (value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') );
                    }
                }
            }]
        },
        tooltips: {
            callbacks: {
                label: function(tooltipItem, data) {
                    var label = data.datasets[tooltipItem.datasetIndex].label || '';

                    if (label) {
                        label += ': ';
                    }
                    label += tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                    return label;
                }
            }
        }
    }
});
}
function setPendientes()
{
	$.get('index.php?r=site/auditoriaPendientes_',{ano:$('#ano').val(),agrupa:true}, function(data) {
	
 	$('#pendientes').html(data);

});
}
function setAnual()
{
	$.getJSON('index.php?r=site/getAnual',{ano:$('#ano').val()}, function(data) {

	iniciarGrafica(data);
  iniciarGraficaTotales(data)

});
}
function setPendientesOs()
{
	$.getJSON('index.php?r=site/consultaPendientesAnual',{ano:$('#ano').val(),agrupa:true,agrupaOs:true}, function(data) {
	iniciarGraficaOs(data.data,data.os);

});
}
function cambiaAno()
{
	setPendientes();
	setPendientesOs();
	setAnual();
}
</script>