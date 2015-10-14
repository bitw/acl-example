@extends('layout.default')

@section('content')
	<ul class="list-group">
		@foreach($users as $user)
			<li class="list-group-item">
				<h4><a href="{!! route('user.show', $user->id) !!}">{!! $user->name !!}</a> ({!! $user->email !!})</h4>
				@can('user.edit', $user)<small><a href="{!! route('user.edit', $user->id) !!}">Редактировать</a></small>@endcan
			</li>
		@endforeach
	</ul>
@stop