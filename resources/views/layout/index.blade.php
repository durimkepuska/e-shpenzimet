<!doctype html>
<html lang="en" class="no-js">
<head>
	 <meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
			 .hiddenCheck {
			     display: none;
			 }
	</style>
		 <link rel="stylesheet" href="{!! URL::asset('datepicker/css/datepicker.css') !!}">
		 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
     <link rel="stylesheet" href="{!! URL::asset('css/font.css') !!}">
     <link rel="stylesheet" href="{!! URL::asset('css/reset.css') !!}">
     <link rel="stylesheet" href="{!! URL::asset('css/style.css') !!}">

		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <script src="{!! URL::asset('js/modernizr.js') !!}"></script>

		 <title>eSpendings</title>
</head>
<body>
	<header class="cd-main-header">
		<a href="#0" class="cd-logo"><img src="{!! URL::asset('web/images/Gjakova.png') !!}" alt="Logo"></a>

		<div class="cd-search is-hidden">
            @yield('search_box')
		</div>

		<a href="#0" class="cd-nav-trigger"><span></span></a>

		<nav class="cd-nav">
			<ul class="cd-top-nav">
				<li><a >Emri: {!! Auth::user()->name !!} </a> </li>
				<li class="has-children account">
					<a href="">
						Llogaria
					</a>
					<ul>
						<li><a href="{!! action('Auth\AuthController@getRregister') !!}">Regjistro Shfrytezues</a></li>
						<li><a href="{!! action('Auth\AuthController@getLogoutt') !!}">Mbylle llogarine</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</header> <!-- .cd-main-header -->

	<main class="cd-main-content">
		<nav class="cd-side-nav">
			<ul>

				<li class="has-children ">
					<a href="{!! action('BudgetController@home') !!}">Buxheti</a>
				</li>

				<li class="has-children ">
					<a href="{!! action('ExpenditureController@index') !!}"> Shpenzimet</a>
				</li>

				<li class="has-children ">
					<a href="{!! action('SupplierController@index') !!}">Furnitorët</a>
				</li>

				<li class="has-children ">
					<a href="{!! action('DepartmentController@index') !!}">Drejtoritë</a>
				</li>

				<li class="has-children ">
					<a href="{!! action('SpendingtypeController@index') !!}">Llojet e Shpenzimeve</a>
				</li>

				<li class="has-children ">
					<a href="{!! action('SpendingCategoryController@index') !!}">Kategoritë e Shpenzimeve</a>
				</li>


				<li class="has-children ">
					<a href="{!! action('PaymentsourceController@index') !!}">Vijat Buxhetore</a>
				</li>

				<li class="has-children ">
					<a href="{!! action('RoleController@index') !!}">Rolet</a>
				</li>

				<li class="has-children ">
					<a href="{!! action('UserController@index') !!}">Zyrtarët</a>
				</li>

				<li class=" notifications ">
					<a href="{!! action('ExpenditureController@notifications') !!}">Lajmërimet<span class="count">@include('partials.notifications')</span></a>
				</li>
			</ul>
			<ul>
					<li class="action-btn"><a target="_blank" href="{!! action('WebController@index') !!}">Web Faqja</a></li>
			</ul>
			<ul>
				<li class="action-btn"><a href="{!! action('Auth\AuthController@getLogoutt') !!}">Mbylle Llogarinë</a></li>
			</ul>
</nav>
	<div class="content-wrapper">

			 @yield('content')
			 @include('partials.flash')

		</div>
	</main>
	<script>
		$(document).ready(function()
	    {
	        $("#myTable").tablesorter();
	    }
	);

		</script>


<script src="{!! URL::asset('js/jquery-2.1.4.js') !!}"></script>
<script src="{!! URL::asset('js/jquery.menu-aim.js') !!}"></script>
<script src="{!! URL::asset('js/main.js') !!}"></script><!-- Resource jQuery -->
<script src="{!! URL::asset('datepicker/js/bootstrap-datepicker.js') !!}"></script>
<script src="{!! URL::asset('js/partials.js') !!}"></script>
<script src="{!! URL::asset('table_sorter/jquery.tablesorter.js') !!}"></script>

</body>

</html>
