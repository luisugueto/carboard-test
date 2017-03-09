@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Videos</div>

        @foreach($videos as $video)
                <div class="row">
            <div class="col-md-7">
                <a href="#">
                    <iframe width="420" height="315"
                        src="https://www.youtube.com/embed/kpFPcUTd3FQ">
                    </iframe>
                </a>
            </div>
            <div class="col-md-5">
                <h3>{{ $video->title }}</h3>
                <h4>{{ $video->category }}</h4>
                <p>{{ $video->description }}</p>
                <a class="btn btn-primary" href="{{ route('videos.ver', $video->id) }}">Ver Detalles del Video <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
            </div>
        @endforeach
            <!-- /.row -->
    
            <hr>
            </div>
        </div>
    </div>
</div>
@endsection
