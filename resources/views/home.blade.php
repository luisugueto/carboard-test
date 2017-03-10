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
                                    @if($video->type == 'enlace')
                                        <iframe width="400" height="300"
                                            src="https://www.youtube.com/embed/{{ $video->name }}">
                                        </iframe>
                                    @elseif($video->type == 'archivo')
                                        <video id='video-player' preload='metadata' controls width="400" height="300">
                                              <source src="vid/{{ $video->name }}" type="video/mp4">
                        
                                    @endif
                                </a>
                            </div>
                            <div class="col-md-5">
                                <h3>{{ $video->title }}</h3>
                                <h4>{{ $video->category }}</h4>
                                <p>{{ $video->description }}</p>
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
    
    function likee(id){
        var data = {
            id : id
        };
        
        $.get("/like/"+id, function(data, status){
            $("#unLike"+id).html(data.unLikes);
            $("#like"+id).html(data.likes);
        });
    }
    
    function unLikee(id){
        var data = {
            id : id
        };
        
        $.get("/unlike/"+id, function(data, status){
            $("#unLike"+id).html(data.unLikes);
            $("#like"+id).html(data.likes);
        });
    }
    
@endsection

