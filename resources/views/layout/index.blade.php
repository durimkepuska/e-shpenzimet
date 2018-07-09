<!doctype html>
<html lang="en" class="no-js">
<head>
	 <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">


		 <link rel="stylesheet" href="{!! URL::asset('admin_style/css/datepicker.css') !!}">
 	 	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
     <link rel="stylesheet" href="{!! URL::asset('admin_style/css/font.css') !!}">
     <link rel="stylesheet" href="{!! URL::asset('admin_style/css/reset.css') !!}">
     <link rel="stylesheet" href="{!! URL::asset('admin_style/css/style.css') !!}">

		 <title>e-Shpenzimet</title>
</head>
<body>
	<header class="cd-main-header">
		<a href="#0" class="cd-logo"><img src="{!! URL::asset('admin_style/img/Gjakova.png') !!}" alt="Logo"></a>
		<div class="cd-search is-hidden">
            @yield('search_box')
		</div>
		<a href="#0" class="cd-nav-trigger"><span></span></a>
		<nav class="cd-nav">
			<ul class="cd-top-nav">
				<li><a > Emri: {!! Auth::user()->name !!}  </a> </li>
				<li class="has-children account">
					<a href="">
						Llogaria
					</a>
					<ul>
						<li><a href="{!! action('Auth\AuthController@getRregister') !!}">Regjistro Shfrytëzues</a></li>
						<li><a href="{!! action('ExpenditureController@help') !!}">Ndihmë</a></li>
						<li><a href="{!! action('Auth\AuthController@getLogoutt') !!}">Mbylle llogarinë</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</header>

	<main class="cd-main-content">
		<nav class="cd-side-nav">
			<ul>


				<li  @if(action('BudgetController@home') == Request::url()) class="active" 	@endif>
				<a href="{!! action('BudgetController@home') !!}">Buxheti</a>
				</li>

				<li @if(action('SubBudgetController@index') == Request::url()) class="active" 	@endif>
				<a href="{!! action('SubBudgetController@index') !!}">Nen Buxheti</a>
				</li>
				<li @if(action('ExpenditureController@index') == Request::url()) class="active" 	@endif>
					<a href="{!! action('ExpenditureController@index') !!}"> Shpenzimet</a>
				</li>
				<li @if(action('SupplierController@index') == Request::url()) class="active" 	@endif>
					<a href="{!! action('SupplierController@index') !!}">Furnitorët</a>
				</li>
				<li @if(action('DepartmentController@index') == Request::url()) class="active" 	@endif>
					<a href="{!! action('DepartmentController@index') !!}">Drejtoritë</a>
				</li>
				<li @if(action('SpendingtypeController@index') == Request::url()) class="active" 	@endif>
					<a href="{!! action('SpendingtypeController@index') !!}">Kategorite e Shpenz...</a>
				</li>
				<li @if(action('SpendingCategoryController@index') == Request::url()) class="active" 	@endif>
					<a href="{!! action('SpendingCategoryController@index') !!}">Nenkategorite e Shpenz...</a>
				</li>
				<li @if(action('PaymentsourceController@index') == Request::url()) class="active" 	@endif>
					<a href="{!! action('PaymentsourceController@index') !!}">Vijat Buxhetore</a>
				</li>
				<li @if(action('RoleController@index') == Request::url()) class="active" 	@endif>
					<a href="{!! action('RoleController@index') !!}">Rolet</a>
				</li>
				<li @if(action('UserController@index') == Request::url()) class="active" 	@endif>
					<a href="{!! action('UserController@index') !!}">Zyrtarët</a>
				</li>
				<li @if(action('ExpenditureController@notifications') == Request::url()) class="active" 	@endif>
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
		@include('errors.error_handler')
	</div>
</main>
<script src="{!! URL::asset('admin_style/js/jquery.min.js') !!}"></script>
<script src="{!! URL::asset('web_style/js/bootstrap.min.js') !!}"></script>
<script src="{!! URL::asset('admin_style/js/modernizr.js') !!}"></script>
<script src="{!! URL::asset('admin_style/js/jquery.menu-aim.js') !!}"></script>
<script src="{!! URL::asset('admin_style/js/main.js') !!}"></script>
<script src="{!! URL::asset('admin_style/js/bootstrap-datepicker.js') !!}"></script>
<script src="{!! URL::asset('admin_style/js/partials.js') !!}"></script>
<script src="{!! URL::asset('admin_style/js/jquery.tablesorter.js') !!}"></script>
</body>
</html>
