<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		header("Location: index.php");
		exit;
	}
	// select loggedin users detail
	$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow=mysql_fetch_array($res);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Monse | Bienvenido <?php echo $userRow['userName']; ?></title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />


    <!-- 1. Add these JavaScript inclusions in the head of your page -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.js"></script>
    <script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>
    
    
    <!-- 2. Add the JavaScript to initialize the chart on document ready -->
    <script>
    var chart1; // global
    
    /**
     * Request data from the server, add it to the graph and set a timeout to request again
     */
    function requestData1() {
      $.ajax({
        url: 'data/data_temp.php', 
        success: function(point) {
          var series = chart1.series[0],
            shift = series.data.length > 50; // shift if the series is longer than 50
    
          // add the point
          chart1.series[0].addPoint(eval(point), true, shift);
          
          // call it again after one second
          setTimeout(requestData1, 1000);  
        },
        cache: false
      });
    }
      
    $(document).ready(function() {
      chart1 = new Highcharts.Chart({
        chart: {
          renderTo: 'container1',
          defaultSeriesType: 'spline',
          events: {
            load: requestData1
          }
        },
        title: {
          text: 'Medición Tiempo Real Sensor Temperatura'
        },
        xAxis: {
          type: 'datetime',
          tickPixelInterval: 50,
          maxZoom: 1
        },
        yAxis: {
          minPadding: 0.2,
          maxPadding: 0.2,
          title: {
            text: 'Temperatura (ºCelcius)',
            margin: 80
          }
        },
        series: [{
          name: 'Sensor de Temperatura (Thermistor)',
          data: []
        }]
      });   
    });
    </script>
    
    <script>
    var chart2; // global
    
    /**
     * Request data from the server, add it to the graph and set a timeout to request again
     */
    function requestData2() {
      $.ajax({
        url: 'data/data_hum.php', 
        success: function(point) {
          var series = chart2.series[0],
            shift = series.data.length > 50; // shift if the series is longer than 50
    
          // add the point
          chart2.series[0].addPoint(eval(point), true, shift);
          
          // call it again after one second
          setTimeout(requestData2, 1000);  
        },
        cache: false
      });
    }
      
    $(document).ready(function() {
      chart2 = new Highcharts.Chart({
        chart: {
          renderTo: 'container2',
          defaultSeriesType: 'spline',
          events: {
            load: requestData2
          }
        },
        title: {
          text: 'Medición Tiempo Real Sensor Humedad'
        },
        xAxis: {
          type: 'datetime',
          tickPixelInterval: 50,
          maxZoom: 1
        },
        yAxis: {
          minPadding: 0.2,
          maxPadding: 0.2,
          title: {
            text: 'Humedad (%)',
            margin: 80
          }
        },
        series: [{
          name: 'Sensor de Humedad (DHT11)',
          data: []
        }]
      });   
    });
    </script>

    <script>
    var chart3; // global
    
    /**
     * Request data from the server, add it to the graph and set a timeout to request again
     */
    function requestData3() {
      $.ajax({
        url: 'data/data_gas.php', 
        success: function(point) {
          var series = chart3.series[0],
            shift = series.data.length > 50; // shift if the series is longer than 50
    
          // add the point
          chart3.series[0].addPoint(eval(point), true, shift);
          
          // call it again after one second
          setTimeout(requestData3, 1000);  
        },
        cache: false
      });
    }
      
    $(document).ready(function() {
      chart3 = new Highcharts.Chart({
        chart: {
          renderTo: 'container3',
          defaultSeriesType: 'spline',
          events: {
            load: requestData3
          }
        },
        title: {
          text: 'Medición Tiempo Real Sensor Gas'
        },
        xAxis: {
          type: 'datetime',
          tickPixelInterval: 50,
          maxZoom: 1
        },
        yAxis: {
          minPadding: 0.2,
          maxPadding: 0.2,
          title: {
            text: 'Concentración Gas',
            margin: 80
          }
        },
        series: [{
          name: 'Sensor de Gas (MQ2)',
          data: []
        }]
      });   
    });
    </script>




</head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a class="navbar-brand" href="http://monse.sytes.net/data/tmp.html">Temperatura</a></li>
            <li><a class="navbar-brand" href="http://monse.sytes.net/data/hum.html">Humedad</a></li>
            <li><a class="navbar-brand" href="http://monse.sytes.net/data/gas.html">Gas</a></li>
            <li><a class="navbar-brand" href="http://monse.sytes.net/home.php">Agregar Arduino</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Bienvenido! <?php echo $userRow['userName']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Salir</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 

	<div id="wrapper">

	<div class="container">
    
    	<div class="page-header">
    	<h3>Arduinos Monse - Sensores para su hogar</h3>
    	</div>
         
    </div>
    
    </div>
    
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <div id="container1" style="width: 1000px; height: 300px; margin: 0 auto"></div>
    <div id="container2" style="width: 1000px; height: 300px; margin: 0 auto"></div>
    <div id="container3" style="width: 1000px; height: 300px; margin: 0 auto"></div>
    
</body>
</html>
<?php ob_end_flush(); ?>