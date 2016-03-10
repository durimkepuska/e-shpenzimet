<!doctype html>
<html lang="en" >
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="{!! URL::asset('web/images/favicon.png') !!}">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="{!! URL::asset('web/js/jquery-2.1.1.js') !!}"></script>
<script src="{!! URL::asset('web/js/bootstrap.min.js') !!}"></script>
<link rel="stylesheet" href="{!! URL::asset('web/css/reset.css') !!}">
<link rel="stylesheet" href="{!! URL::asset('web/css/style-guide.css') !!}">
<script src="{!! URL::asset('web/js/main.js') !!}"></script>
<script src="{!! URL::asset('web/highcharts/highcharts.js') !!}"></script>
<script src="{!! URL::asset('web/highcharts/data.js') !!}"></script>
<script src="{!! URL::asset('web/highcharts/drilldown.js') !!}"></script>
<title>e-Shpenzimet</title>
</head>
<body>
<header>
	<ul>
		<div class="first_div" >
			<div class="container" >
				<p>
					<span style="font-weight: bold;">Qendra Informative:</span>
					0800 60000, 0800 60001 (pa pagesë)  |  gjakova.ic@rks-gov.net
					<span class="first_span" style=" float:right; ">
						<a href="" data-toggle="modal" data-target="#shkrarko">Shkarko të dhënat</a> |
						<a href="" data-toggle="modal"  data-target="#myModal">Kyçu</a>
					</span>
				</p>
			</div>
		</div>
	</ul>
	<div class="container" >
		<ul>
			<div class="second_div" >
				<div class="cd-logo "><a href="#">
					<img src="{!! URL::asset('web/images/logo.png') !!}" alt="Logo"></a>
				</div>
			</div>
		</ul>
	</div>
	<ul class="cd-main-nav third_div">
		<li class="dropdown">
			<a class="dropbtn" href="#">E-SHPENZIMET <span class="glyphicon glyphicon-menu-down"></a>
			<div class="dropdown-content" id="drop">
				<a href="#"> 2013</a>
				<a href="#"> 2014</a>
				<a href="#"> 2015</a>
				<a href="#"> 2016</a>
			</div>
		</li>
		<li><a href="#">E-REKRUTIMI</a></li>
		<li><a href="#">E-PARTICIPIMI</a></li>
		<li><a href="#">GJAKOVA PORTAL</a></li>
	</ul>
	<a href="#0" class="cd-nav-trigger"><span></span></a>
</header>
@include('web.modalForms')
<main>
	<section id="buttons" class="cd-colors">
		<div class="cd-box"></div>
	</section>
	<section id="branding" class="cd-branding">
		<ul>
			<li class="cd-box">
				<div class="panel-heading">E-Shpenzimet gjatë vitit 2016</div>
				<div id="chart_container" style=" min-width:300px; height: 400px; margin: 0 0"></div>
			</li>
			<li>
				<div class="panel panel-default panel_class">
					 <div class="panel-heading">Paneli i informatave</div>
					 <div class="panel-body">
					 	<div id="info_panel" style="text-align:left;  text-justify: inter-word;  line-height: 1.8;"></div>
					 </div>
				</div>
			</li>
		</ul>
		<ul>
		</ul>
	</section>
	<section id="typography" class="cd-typography ">
		<div class="cd-box"><h1></h1>	<p></p></div>
	</section>
</main>
<footer class="footer">
	<div class="container" >
		<div  class="footer_font ">
			<p class="pull-left">
				 © 2016 e-Shpenzimet &nbsp;&nbsp;
				 <a href="" data-toggle="modal" data-target="#shkrarko">Shkarko të dhënat</a> &nbsp;&nbsp;
			   {!! HTML::link('http://gjakovaportal.com/al', 'Gjakova Portal') !!}
			</p>
			<div class="pull-right">
				<img class="img_footer3" src="{!! URL::asset('web/images/krijon.png') !!}" alt="Logo">
				<img class="img_footer1" src="{!! URL::asset('web/images/scok.png') !!}" alt="Logo">
        <img class="img_footer2" src="{!! URL::asset('web/images/undp.png') !!}" alt="Logo">
			</div><br><br>
			<div class="pull-left">
        <a href="https://www.facebook.com/KuvendiKomunalGjakove/">   <img src="{!! URL::asset('web/images/facebook.png') !!}"></a>
			</div>
		</div>
	</div>
</footer>
<script>
$(function () {
Highcharts.setOptions({
lang: {
	thousandsSep: ',',
	numericSymbols: [' mijë', ' milionë']
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
  borderWidth:5,
  dataLabels: {
  enabled: true,
	format: ' {point.y:,.2f} EUR'
}}},
series: [{
  id: '',
  name: '---Shpenzimet 2016--- Kliko mbi shtylla për më shumë informata rreth Buxhetit, Shpenzimet dhe Borxheve të drejtorive në Komunën e Gjakovës',
  data: [
  {name: 'Buxheti fillestar', color: '#8C231F', y: {!! File::get(storage_path('charts/2016/totals/buxheti_total.js')) !!}, drilldown: 'buxheti_fillestare_drejtorite'},
	{name: 'Shpenzimet', color: '#8C231F', y: {!! File::get(storage_path('charts/2016/totals/shpenzimet_total.js')) !!}, drilldown: 'shpenzimet_drejtorite'},
	{name: 'Buxheti aktual',color: '#00ff00', y: {!! File::get(storage_path('charts/2016/totals/buxheti_aktual.js')) !!}, drilldown: 'buxheti_aktual_drejtorite'},
	{name: 'Borxhet',color: '#87CEEB', y: {!! File::get(storage_path('charts/2016/totals/borxhet_total.js')) !!}, drilldown: 'borxhet_drejtorite'}
]}],
drilldown: {
  series: [
	{!! File::get(storage_path('charts/2016/all.js')) !!}
]}})});
</script>
<script src="{!! URL::asset('web/js/other.js') !!}"></script>
</body>
</html>
