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
                        {{ Form::label('tipo', 'Tipo', ['class'=>'control-label col-md-2']) }}
                        <div class="col-md-10">
                            {{ Form::select('type', ['1' => 'Enlace', '2' => 'Archivo'], null, ['placeholder' => 'Seleccione', 'class'=>'form-control select', 'id'=>'type', 'onChange'=>'cambiar()' , 'required'=>'required']) }}
                        </div>
                    </div>
                    
                    <div class="form-group" id="enlace" style="display:none">
                        {{ Form::label('enlace', 'Enlace', ['class'=>'control-label col-md-2']) }}
                        <div class="col-md-10">
                            <input type="url" name="url" id="url" class="form-control" placeholder="Enlace">
                        </div>
                    </div>
                    <div class="form-group" id="file" style="display:none">
                        {{ Form::label('archivo', 'Archivo', ['class'=>'control-label col-md-2']) }}
                        <div class="col-md-10">
                            <input type="file" name="file" id="archivo" class="form-control" placeholder="Archivo">
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

@section('scripts')

    function cambiar(){
        if($("#type").val() == 1)
        {
            $("#enlace").css('display', '');
            $("#file").css('display', 'none');
            $("#url").attr('required', 'required');
            $("#url").attr('disabled', false);
            $("#archivo").attr('disabled', true);
        }
        if($("#type").val() == 2)
        {
            $("#enlace").css('display', 'none');
            $("#file").css('display', '');
            $("#url").attr('disabled', true);
            $("#archivo").attr('required', 'required');
            $("#archivo").attr('disabled', false);
        }
    }
    
@endsection
