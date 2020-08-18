@extends('layouts.main')

@section('title','NUEVO GENERO')

@section('content')
	@include('layouts.error')
	{!! Form::open(['route'=>'genero.store']) !!}
		<div class="form-group">
			{!! Form::label('genero', 'Nombre:') !!}
			{!! Form::text('genero', null, ['class' => 'form-control',
										  'placeholder' => 'Nombre del genero',
										  'required']) !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endsection