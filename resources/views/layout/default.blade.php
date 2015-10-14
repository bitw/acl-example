<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ACL</title>
	<link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<nav class="navbar navbar-default" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Home</a>
		</div>

		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav navbar-right">
				@if(\Auth::check())
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{!! Auth::user()->name !!} <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="{!! action('Auth\AuthController@getLogout') !!}">Выход</a></li>
						</ul>
					</li>
				@else
					<li {!! \Route::currentRouteAction() == "App\Http\Controllers\Auth\AuthController@getLogin" ? 'class="active"' : '' !!}><a href="{!! action('Auth\AuthController@getLogin') !!}">Вход</a></li>
					<li {!! \Route::currentRouteAction() == "App\Http\Controllers\Auth\AuthController@getRegister" ? 'class="active"' : '' !!}><a href="{!! action('Auth\AuthController@getRegister') !!}">Регистрация</a></li>
				@endif
			</ul>
		</div>
	</nav>
	@yield('content')
</div>
<script src="{!! asset('/vendor/jquery/dist/jquery.min.js') !!}"></script>
<script src="{!! asset('/vendor/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
@yield('scripts')
</body>
</html>