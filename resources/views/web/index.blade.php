<!doctype html>
<html lang="en" >
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="{!! URL::asset('web_style/img/favicon.png') !!}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<!-- <link rel="stylesheet"  href="{!! URL::asset('web/css/bootstrap.min.css') !!}"> -->
<script src="{!! URL::asset('web_style/js/jquery-2.1.1.js') !!}"></script>
<script src="{!! URL::asset('web_style/js/bootstrap.min.js') !!}"></script>
<link rel="stylesheet" href="{!! URL::asset('web_style/css/reset.css') !!}">
<link rel="stylesheet" href="{!! URL::asset('web_style/css/style-guide.css') !!}">
<script src="{!! URL::asset('web_style/js/main.js') !!}"></script>
<script src="{!! URL::asset('web_style/js/highcharts.js') !!}"></script>
<script src="{!! URL::asset('web_style/js/data.js') !!}"></script>
<script src="{!! URL::asset('web_style/js/drilldown.js') !!}"></script>
<title>e-Shpenzimet</title>
<!--
	Developed by: KRIJON 2018
-->
</head>
<?php 
if(isset($_GET['year'])){
	$year = $_GET['year'];
} else {
	$year = date("Y");
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
	          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Viti <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li ><a href="?year=2016" >2016</a></li>
	            <li ><a href="?year=2017" >2017</a></li>
	            <li ><a href="?year=2018" >2018</a></li>
	            <li ><a href="?year=2019" >2019</a></li>
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
			<!-- <li class="cd-box"> -->
				<div class="panel-heading" style="text-align:center;"><span id="main_text">E-Shpenzimet gjatë vitit {{$year}}</span>
					<br><br>Vizualizimi i buxhetit, shpenzimeve dhe borxheve në Komunën e Gjakovës</div>
				<div id="chart_container" ></div>
			<!-- </li> -->
		<!-- 	<li>
				<div class="panel panel-default panel_class">
					 <div class="panel-heading" style="text-align:center;">Paneli i informatave</div>
					 <div class="panel-body">
					 	<div id="info_panel" style="text-align:left;  text-justify: inter-word;  line-height: 1.6;"></div>
					 </div>
				</div>
			</li> -->
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
	drillUpText: '< prapa'
}
});
$('#chart_container').highcharts({
chart: {
	type: 'column'
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
  text: ''
},
xAxis: {
  type: 'category'
},
tooltip: {
  headerFormat: '<span style="font-size:11px"> <b>{point.y:,.2f} EUR</b></span><br>',
  pointFormat: '<span >{point.name}</span>'
},

plotOptions: {
  series: {

  borderWidth:1,
  dataLabels: {
  enabled: true,
	format: ' {point.y:,.2f} EUR'
}}},
series: [{
  id: '',
  name: '---Shpenzimet 2018--- Kliko mbi shtylla për më shumë informata rreth Buxhetit, Shpenzimet dhe Borxheve të drejtorive në Komunën e Gjakovës',
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
  r: 5,
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
