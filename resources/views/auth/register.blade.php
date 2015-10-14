@extends('layout.default')

@section('content')
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Регистрация</h3>
			</div>
			<div class="panel-body">
				<form method="POST" action="{!! action('Auth\AuthController@postRegister') !!}">
					{!! csrf_field() !!}

					<div class="form-group {!! !$errors->has('name') ?: 'has-error' !!}">
						<label for="name">Имя</label>
						<input type="text" class="form-control" name="name" value="{{ old('name') }}">
					</div>

					<div class="form-group {!! !$errors->has('email') ?: 'has-error' !!}">
						<label for="email">Эл.почта</label>
						<input type="email" class="form-control" name="email" value="{{ old('email') }}">
					</div>

					<div class="row">
						<div class="form-group col-md-6 {!! !$errors->has('password') ?: 'has-error' !!}">
							<label for="password">Пароль</label>
							<input type="password" class="form-control" name="password" id="password">
						</div>

						<div class="form-group col-md-6 {!! !$errors->has('password_confirmation') ?: 'has-error' !!}">
							<label for="password_confirmation">Подтверждение пароля</label>
							<input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
						</div>
					</div>

					@if($errors->count())
						<div class="alert alert-danger">
							@foreach($errors->all() as $message)
								<div>{!! $message !!}</div>
							@endforeach
						</div>
					@endif

					<div class="text-right">
						<button class="btn btn-primary" type="submit">Зарегистрироваться</button>
						<a class="btn btn-link" href="{!! action('Auth\AuthController@getLogin') !!}">Авторизация</a>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop