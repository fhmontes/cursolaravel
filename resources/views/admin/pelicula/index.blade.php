@extends('layouts.main')

@section('title','LISTA DE PELICULAS')

@section('content')
	@include('flash::message')
	<a href="{{ route('pelicula.create') }}" class="btn btn-primary">Nuevo Genero</a>
	<table class="table">
		<tr>
			<th>ID</th>
			<th>Titulo</th>
			<th>Accion</th>
		</tr>
		@foreach($peliculas as $pelicula)
		<tr>
			<td>{{ $pelicula->id }}</td>
			<td>{{ $pelicula->titulo }}</td>
			<td>
				<a href="{{ route('pelicula.destroy', $pelicula->id) }}" 
				   onclick="eliminarRegistro(event, this.href)" 
				   class="btn btn-danger btn-xs" title="Eliminar">
					<span class="glyphicon glyphicon-trash"></span>
				</a>
				<a href="{{ route('pelicula.edit', $pelicula->id) }}"
				   class="btn btn-success btn-xs" title="Editar">
					<span class="glyphicon glyphicon-pencil"></span>
				</a>
			</td>
		</tr>	
		@endforeach
	</table>
	{{ $peliculas->links() }}
@endsection

@section('javascript')
	<script>
		function eliminarRegistro(event, url){
			event.preventDefault();
			if(confirm("Esta seguro de eliminar el registro?")){
				window.location.href = url;
			}
		}
	</script>
@endsection