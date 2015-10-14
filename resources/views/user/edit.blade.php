@extends('layout.default')

@section('content')
	<form action="{!! route('user.update', $user->id) !!}" method="POST" role="form">
		{!! csrf_field() !!}{!! method_field('put') !!}
		<legend>Редактирование профиля</legend>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="name">Имя</label>
					<input type="text" class="form-control" name="name" id="name" value="{!! $user->name !!}">
				</div>

				<div class="form-group">
					<label for="email">Эл.почта</label>
					<input type="text" class="form-control" name="email" id="email" value="{!! $user->email !!}">
				</div>
			</div>

			@can('role.assign')
				<div class="col-md-6">
					<div><label>Роли</label></div>
					@foreach(Bitw\Acl\Models\Role::all() as $role)
						<div class="checkbox">
							<label for="role{!! $role->id !!}"><input type="checkbox" id="role{!! $role->id !!}" name="roles[]" value="{!! $role->id !!}" {!! !$user->hasRole($role) ?: 'checked' !!}>{!! $role->name !!}</label>
						</div>
					@endforeach
				</div>
			@endcan
		</div>

		<div class="row">
			<div class="col-md-6 text-right">
				<button type="submit" class="btn btn-primary">Сохранить</button>
				<a class="btn btn-link" href="{!! route('user.index') !!}">Назад</a>
			</div>
		</div>

	</form>
@stop