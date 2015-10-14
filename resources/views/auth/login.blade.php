@extends('layout.default')

@section('content')
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Авторизация</h3>
			</div>
			<div class="panel-body">
				<form action="{!! action('Auth\AuthController@postLogin') !!}" method="POST" role="form">
					{!! csrf_field() !!}

					<div class="form-group">
						<label for="email">Эл.почта</label>
						<input type="email" class="form-control" name="email" value="{{ old('email') }}">
					</div>

					<div class="form-group">
						<label for="password">Пароль</label>
						<input type="password" class="form-control" name="password" id="password">
					</div>

					<div class="checkbox">
						<label for="remember"><input type="checkbox" id="remember" name="remember"> Запомнить меня</label>
					</div>

					@if($errors->count())
						<div class="alert alert-danger">
							@foreach($errors->all() as $message)
							<div>{!! $message !!}</div>
							@endforeach
						</div>
					@endif

					<div class="text-right">
						<button type="submit" class="btn btn-primary">Вход</button>
						<a class="btn btn-link" href="{!! action('Auth\AuthController@getRegister') !!}">Регистрация</a>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop