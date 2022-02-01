<!doctype html>
<html lang="en" >
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="{!! URL::asset('web_style/img/favicon.png') !!}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="{!! URL::asset('web_style/js/jquery-2.1.1.js') !!}"></script>
<script src="{!! URL::asset('web_style/js/bootstrap.min.js') !!}"></script>
<link rel="stylesheet" href="{!! URL::asset('web_style/css/reset.css') !!}">
<link rel="stylesheet" href="{!! URL::asset('web_style/css/style-guide.css') !!}">
<script src="{!! URL::asset('web_style/js/main.js') !!}"></script>
<script src="{!! URL::asset('web_style/js/highcharts.js') !!}"></script>
<script src="{!! URL::asset('web_style/js/data.js') !!}"></script>
<script src="{!! URL::asset('web_style/js/drilldown.js') !!}"></script>
<script>
function setGetParameter(paramName, paramValue)
{
    var url = window.location.href;
    var hash = location.hash;
    url = url.replace(hash, '');
    if (url.indexOf(paramName + "=") >= 0)
    {
        var prefix = url.substring(0, url.indexOf(paramName + "=")); 
        var suffix = url.substring(url.indexOf(paramName + "="));
        suffix = suffix.substring(suffix.indexOf("=") + 1);
        suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
        url = prefix + paramName + "=" + paramValue + suffix;
    }
    else
    {
    if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
    else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
}
</script>
<title>e-Shpenzimet</title>
<!--
	Developed by: Durim Kepuska - durimkepuska@gmail.com
-->
</head>
<?php 
if(isset($_GET['year'])){
	$year = $_GET['year'];
} else {
	$year = date("Y");
}

if(isset($_GET['chart'])){
	$chart = $_GET['chart'];
} else {
	$chart = "column";
}
;
?>
<body>
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand active" href="#">e-Shpenzimet</a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav">
	       
	        <li class="dropdown">
	          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Vitet <span class="caret"></span></a>
	          <ul class="dropdown-menu">
		    <li ><a onclick="setGetParameter('year','2015')" >2015</a></li>
	            <li ><a onclick="setGetParameter('year','2016')" >2016</a></li>
	            <li ><a onclick="setGetParameter('year','2017')" >2017</a></li>
	            <li ><a onclick="setGetParameter('year','2018')" >2018</a></li>
	            <li ><a onclick="setGetParameter('year','2019')" >2019</a></li>
	            <li ><a onclick="setGetParameter('year','2020')" >2020</a></li>
		    <li ><a onclick="setGetParameter('year','2021')" >2021</a></li>
		    <li ><a onclick="setGetParameter('year','2022')" >2022</a></li>
			  </ul>
	        </li>
	        <li class="dropdown">
	          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Forma e grafit<span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li ><a onclick="setGetParameter('chart','column')" >Vertikale</a></li>
	            <li ><a onclick="setGetParameter('chart','bar')" >Horizontale</a></li>
	            <li ><a onclick="setGetParameter('chart','pie')" >Rrethore</a></li>
	            <li ><a onclick="setGetParameter('chart','line')" >Linjore</a></li>
	            <li ><a onclick="setGetParameter('chart','area')" >Sipëfaqësore</a></li>
			  </ul>
	        </li>
				</ul>
	      <ul class="nav navbar-nav navbar-right">
	        <li><a id="shkarko_text" href="" data-toggle="modal" data-target="#shkrarko"><span class="glyphicon glyphicon-download-alt"></span> Shkarko të dhënat </a></li>
					<li><a id="login_text" href="" data-toggle="modal"  data-target="#myModal"><span class="glyphicon glyphicon-log-in"></span> Kyçu në e-Shpenzimi</a></li>
	      </ul>
	    </div>
	  </div>
	</nav>
@include('web.modalForms')

<main>
	<section id="buttons" class="cd-colors">
		<div class="cd-box"></div>
	</section>
	@include('errors.error_handler')
	@include('partials.flash')
	<section id="branding" class="cd-branding">
		<ul>
	
				<div class="panel-heading" style="text-align:center;"><span id="main_text">Komuna e Gjakovës</span>
					<br><br>Vizualizimi i buxhetit, shpenzimeve dhe borxheve për vitin {{$year}}
				</div>
				<div id="chart_container" ></div>
		
		</ul>
		<ul>
		</ul>
	</section>
	<section id="typography" class="cd-typography ">
		<div class="cd-box"><h1></h1>	<p></p></div>
	</section>
</main>

<script>

$(function () {
Highcharts.setOptions({
lang: {
	thousandsSep: ',',
	drillUpText: '< kthehu'
}
});
$('#chart_container').highcharts({
chart: {
	type: "{!!$chart!!}"

},
	legend: {
  align: 'center',
  verticalAlign: 'bottom',
  layout: 'vertical',
  x: 0,
  y: 0,
	itemStyle: {
	fontSize: '0px'
	}
},
title: {
  text: 'Kliko mbi të dhëna për më shumë informata'
},
xAxis: {
  type: 'category'
},
tooltip: {
  headerFormat: '<span style="font-size:11px"> <b>{point.y:,.2f} EUR</b></span><br>',
  pointFormat: '<span >{point.name}</span>'
},

plotOptions: {
  pie: {
	showInLegend: true
  },
  series: {
  borderWidth:1,
  dataLabels: {
  enabled: true,
	format: '<b>{point.name}:</b> {point.y:,.2f} EUR'
}}},
series: [{
  id: '',
  data: [
  {name: 'Buxheti fillestar', color: '#2F4F4F', y: {!! File::get(storage_path('charts/'.$year.'/totals/buxheti_total.js')) !!}, drilldown: 'buxheti_fillestare_drejtorite'},
	{name: 'Shpenzimet', color: '#8C231F', y: {!! File::get(storage_path('charts/'.$year.'/totals/shpenzimet_total.js')) !!}, drilldown: 'shpenzimet_drejtorite'},
	{name: 'Buxheti aktual',color: '#FFCC00', y: {!! File::get(storage_path('charts/'.$year.'/totals/buxheti_aktual.js')) !!}, drilldown: 'buxheti_aktual_drejtorite'},
	{name: 'Borxhet',color: '#696969', y: {!! File::get(storage_path('charts/'.$year.'/totals/borxhet_total.js')) !!}, drilldown: 'borxhet_drejtorite'}
]}],

drilldown: {
	drillUpButton: {
relativeTo: '',
position: {
	y: 15,
  x: -15
},
theme: {
	fill: '#A0522D',
	'stroke-width': 1,
  stroke: '#A0522D',
  r: 15,
  states: {
  hover: {
  fill: '#A0522D'
  },
  select: {
  stroke: '#A0522D',
  fill: '#fff'
}}}},
series: [
{!! File::get(storage_path('charts/'.$year.'/all.js')) !!}
]}})});
</script>
<script src="{!! URL::asset('web_style/js/other.js') !!}"></script>
</body>
</html>
