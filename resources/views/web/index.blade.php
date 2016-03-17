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
						<a id="shkarko_text" href="" data-toggle="modal" data-target="#shkrarko">Shkarko të dhënat </a> |
						<a id="login_text" href="" data-toggle="modal"  data-target="#myModal">Kyçu</a>
					</span>
				</p>
			</div>
		</div>
	</ul>
	<div class="container" >
		<ul>
			<div class="second_div" >
				<div class="cd-logo pull-left">
					<a href="#"><img src="{!! URL::asset('web/images/gjakovaweb.png') !!}" ></a>
				</div>
				<div class="cd-logo1 pull-right">
					<a href="#"><img src="{!! URL::asset('web/images/kosova.png') !!}" ></a>
				</div>

			</div>
		</ul>
	</div>
	<ul class="cd-main-nav third_div">
		<li class="dropdown">
			<a class="dropbtn" href="#">e-Shpenzimet <span class="glyphicon glyphicon-menu-down"></a>
			<div class="dropdown-content" id="drop">
				<a href="">Viti 2016</a>
			</div>
		</li>
		<li><a href="#">e-Rekrutimi</a></li>
		<li><a href="#">e-Participimi</a></li>
		<li><a href="http://gjakovaportal.com">Gjakova Portal</a></li>
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
				<div class="panel-heading" style="text-align:center;"><span id="main_text">E-Shpenzimet gjatë vitit 2016</span><br><br>Kliko mbi shtylla për më shumë informata rreth buxhetit, shpenzimeve dhe borxheve në Komunën e Gjakovës</div>
				<div id="chart_container" style="min-width:300px; height:370px; margin: 5px 0"></div>
			</li>
			<li>
				<div class="panel panel-default panel_class">
					 <div class="panel-heading" style="text-align:center;">Paneli i informatave</div>
					 <div class="panel-body">
					 	<div id="info_panel" style="text-align:left;  text-justify: inter-word;  line-height: 1.6;"></div>
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
				<a href="http://www.krijonxxl.com"><img class="img_footer3" src="{!! URL::asset('web/images/krijon.png') !!}" alt="Logo"></a>
				<a href="http://www.ks.undp.org/"><img class="img_footer1" src="{!! URL::asset('web/images/scok.png') !!}" alt="Logo"></a>
        <a href="https://www.eda.admin.ch/countries/kosovo/en/home.html"><img class="img_footer2" src="{!! URL::asset('web/images/undp.png') !!}" alt="Logo"></a>
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
