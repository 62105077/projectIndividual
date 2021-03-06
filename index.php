<!doctype html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Hello, world!</title>

    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
  </head>
  <body>
      <div class="row">
        <div class="col-4"></div>
        <div class="col-4"></div>
        <div class="col-4"></div>
      </div>
    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.0/dist/chart.min.js"></script>
   

  <div class="container">
    <center><h1 style="border: 2px solid Violet;">62105077 Nirawan Ausakan</h1></center>
    <div class="row">
      <div class="col-6">
        <canvas id="myChart"width="400" height="200"></canvas>
      </div>

    </div>
    <div class="row">
      <div class="col-6">
        <canvas id="myChart1"width="400" height="200"></canvas>
      </div>

    </div>
    <div class="row">
      <div class="col-6">
        <canvas id="myChart2"width="400" height="200"></canvas>
      </div>

    </div>
    
      <div class="row">
        <div class="col-3">
          <div class="row">
            <div class="col-4">
              <b>Temperature</b>
            </div>
            <div class="col-8">
              <span id="lastTemperature"></span>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <b>Humidity</b>
            </div>
            <div class="col-8">
              <span id="lastHumidity"></span>
            </div>
          </div>
          <div class="row">
            <div class="col-4">update </div>
            <div class="col-8">
              <span id="lastUpdate"></span>
            </div>

          </div>
          <div class="row">
            <div class="col-4">
              <b>Light</b>
            </div>
            <div class="col-8">
              <span id="lastLight"></span>
            </div>
          </div>
        </div>
         
      </div>
  </div> 
</body>
  <script>

function showChart(data){
        var ctx = document.getElementById("myChart").getContext("2d");
        var myChart = new Chart(ctx,{
            type:'line',
            data:{
                labels:data.xlabel,
                datasets:[{
                    label:data.label,
                    data:data.data,
                   
                }]
            }
        });
    }

    function TempChart(data_2){
        var ctxy = document.getElementById("myChart1").getContext("2d");
        var myChart = new Chart(ctxy,{
            type:'line',
            data:{
                labels:data_2.xlabel,
                datasets:[{
                    label:data_2.label,
                    data:data_2.data,
                    
                }]
            }
        });
    }

    function LightChart(data_3){
        var ctxy = document.getElementById("myChart2").getContext("2d");
        var myChart = new Chart(ctxy,{
            type:'line',
            data:{
                labels:data_3.xlabel,
                datasets:[{
                    label:data_3.label,
                    data:data_3.data,
                    
                }]
            }
        });
    }

    $(()=>{
        let url = "https://api.thingspeak.com/channels/1458420/feeds.json?results=240";
        $.getJSON(url)
            .done(function(data){
                let feed = data.feeds;
                let chan = data.channel;


                const d = new Date(feed[239].created_at);
                    const monthNames = ["January","February","March","April","May","July","August","September","October","November","December"];
                    let dateStr = d.getDate()+" "+monthNames[d.getMonth()]+" "+d.getFullYear();
                    dateStr += " "+d.getHours()+":"+d.getMinutes();

              
              $("#lastTemperature").text(feed[239].field2+ " C");
                $("#lastHumidity").text(feed[239].field1+ " %");
                $("#lastLight").text(feed[239].field3 );
                $("#lastUpdate").text(dateStr);

                var plot = Object();
                var xlabel = [];
                var Tem = [];
                var Hum = [];
                var Light =[];

                $.each(feed,(k,v)=>{
                    xlabel.push(v.created_at);
                    Hum.push(v.field1);
                    Tem.push(v.field2);
                    Light.push(v.field3)
                });
                var data = new Object();
                data.xlabel = xlabel;
                data.data = Tem;
                data.label = chan.field2;
                
                var data_2 = new Object();
                data_2.xlabel = xlabel;
                data_2.data = Hum;
                data_2.label = chan.field1;
               
                var data_3 = new Object();
                data_3.xlabel = xlabel;
                data_3.data = Light;
                data_3.label = chan.field3;
               

                showChart(data);
                TempChart(data_2);
                LightChart(data_3);



            });
    });
     
</script>
  </html>

