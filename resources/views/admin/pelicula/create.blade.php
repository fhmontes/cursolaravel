@extends('layouts.main')

@section('title','NUEVA PELICULA')

@section('content')
	@include('layouts.error')
	{!! Form::open(['route'=>'pelicula.store', 'files'=>true]) !!}
		<div class="form-group">
			{!! Form::label('titulo', 'Titulo:') !!}
			{!! Form::text('titulo', null, ['class' => 'form-control',
										  'placeholder' => 'Titulo de la pelicula',
										  'required']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('genero_id', 'Genero:') !!}
			{!! Form::select('genero_id', $generos, null, ['class' => 'form-control',
														  'placeholder' => 'Seleccione una opcion',
														  'required']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('costo', 'Costo:') !!}
			{!! Form::number('costo', null, ['class' => 'form-control',
										  'placeholder' => 'Costo de la pelicula',
										  'required']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('estreno', 'Fecha de estreno:') !!}
			{!! Form::date('estreno', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('resumen', 'Resumen:') !!}
			{!! Form::textarea('resumen', null, ['class' => 'form-control',
										  'placeholder' => 'Resumen de la pelicula',
										  'required']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('directores', 'Directores:') !!}
			{!! Form::select('directores[]', $directores, null, ['class' => 'form-control',
														  		 'required', 'multiple']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('imagen', 'Imagen:') !!}
			{!! Form::file('imagen') !!}
			<img id="img-pelicula" src="#" style="visibility: hidden" 
				 alt="Portada de pelicula" width="70%">
		</div>
		<div class="form-group">
			{!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection

@section('javascript')
	<script>
		function readURL(input) {
		  if (input.files && input.files[0]) {
		  	var img = document.getElementById('img-pelicula');
		  	img.style.visibility = 'visible';
		    var reader = new FileReader();
		    reader.onload = function(e) {
		      $('#img-pelicula').attr('src', e.target.result);
		    }
		    reader.readAsDataURL(input.files[0]); // convert to base64 string
		  }
		}
		$("#imagen").change(function() {
		  readURL(this);
		});
	</script>
@endsection