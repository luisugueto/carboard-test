@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Videos</div>
                    <br>
                    @foreach($videos as $video)
                        <div class="row" style="padding-left: 10px">
                            <div class="col-md-7">
                                <a href="#">
                                    <iframe width="400" height="300"
                                        src="https://www.youtube.com/embed/{{ $video->url }}">
                                    </iframe>
                                </a>
                            </div>
                            <div class="col-md-5">
                                <h3>{{ $video->title }}</h3>
                                <h4>{{ $video->category }}</h4>
                                <p>{{ $video->description }}</p>
                                @if(!Auth::guest())
                                    <div>
                                        <h5>Me Gusta: <button onclick="pruebaa()"><img src="{{ asset('like.png') }}" width="20px"></img></button></h5>
                                        <h5>No Me Gusta: <button><img src="{{ asset('unlike.png') }}" width="20px"></button></img></h5>
                                    </div>
                                @endif
                                <a class="btn btn-primary" href="{{ route('videos.ver', $video->id) }}">Ver Detalles del Video <span class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                           
                        </div>
                        <hr>
                    @endforeach
                    {{ $videos->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    
        function pruebaa(){
            $.post("/like/1/1", function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
    });
        }
    
@endsection

