@extends('layouts.main')

@section('title','LISTA DE USUARIOS')

@section('content')
	<a href="{{ route('user.create') }}" class="btn btn-primary">Nuevo Usuario</a>
	<table class="table">
		<tr>
			<th>ID</th>
			<th>Usuario</th>
			<th>Correo</th>
			<th>Tipo</th>
		</tr>
		@foreach($users as $user)
		<tr>
			<td>{{ $user->id }}</td>
			<td>{{ $user->name }}</td>
			<td>{{ $user->email }}</td>
			<td>
				@if($user->type == 'admin')
					<span class="label label-danger">administrador</span> 
				@else
					<span class="label label-warning">miembro</span>
				@endif
			</td>
		</tr>	
		@endforeach
	</table>
	{{ $users->links() }}
@endsection