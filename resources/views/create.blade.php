@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Ingresar</div>
                <br>
                {{ Form::open(['route' => 'videos.store', 'class'=>'form-horizontal']) }}
                
                     <div class="form-group">
                        {{ Form::label('enlace', 'Enlace', ['class'=>'control-label col-md-2']) }}
                         <div class="col-md-10">
                             <input type="url" name="url" class="form-control" placeholder="Enlace" required>
                         </div>
                     </div>
                     <div class="form-group">
                         {{ Form::label('titulo', 'Título', ['class'=>'control-label col-md-2']) }}
                         <div class="col-md-10">
                             {{ Form::text('title', null,['class'=>'form-control', 'placeholder'=>'Título', 'required']) }}
                         </div>
                     </div>
                     <div class="form-group">
                         {{ Form::label('categoria', 'Categoría', ['class'=>'control-label col-md-2']) }}
                         <div class="col-md-10">
                             {{ Form::text('category', null,['class'=>'form-control', 'placeholder'=>'Categoría', 'required']) }}
                         </div>
                     </div>
                     <div class="form-group">
                         {{ Form::label('descripcion', 'Descripción', ['class'=>'control-label col-md-2']) }}
                         <div class="col-md-10">
                             {{ Form::text('description', null,['class'=>'form-control', 'placeholder'=>'Descripción', 'required']) }}
                         </div>
                     </div>
                     <div class="form-group">
                         <div class="col-md-offset-2 col-md-10">
                             {{ Form::submit('Enviar', ['class'=>'btn btn-primary']) }}
                         </div>
                     </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
