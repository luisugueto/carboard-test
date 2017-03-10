@extends('layouts.app')

@section('content')
    <style type="text/css">
    	.detailBox {
    	    width:600px;
    	    border:1px solid #bbb;
    	    margin:50px;
    	}
    	.titleBox {
    	    background-color:#fdfdfd;
    	    padding:10px;
    	}
    	.titleBox label{
    	  color:#444;
    	  margin:0;
    	  display:inline-block;
    	}
    
    	.commentBox {
    	    padding:10px;
    	    border-top:1px dotted #bbb;
    	}
    	.commentBox .form-group:first-child, .actionBox .form-group:first-child {
    	    width:80%;
    	}
    	.commentBox .form-group:nth-child(2), .actionBox .form-group:nth-child(2) {
    	    width:18%;
    	}
    	.actionBox .form-group * {
    	    width:100%;
    	}
    	.taskDescription {
    	    margin-left: 10px;
    	    margin-top:10px 0;
    	}
    	.likeDescription{
    	    margin-left: 10px;
    	    margin-top: 5px;
    	}
    	.commentList {
    	    padding:0;
    	    list-style:none;
    	    max-height:200px;
    	    overflow:auto;
    	}
    	.commentList li {
    	    margin:0;
    	    margin-top:10px;
    	}
    	.commentList li > div {
    	    display:table-cell;
    	}
    	.commenterImage {
    	    width:30px;
    	    margin-right:5px;
    	    height:100%;
    	    float:left;
    	}
    	.commenterImage img {
    	    width:100%;
    	    border-radius:50%;
    	}
    	.commentText p {
    	    margin:0;
    	}
    	.sub-text {
    	    color:#aaa;
    	    font-family:verdana;
    	    font-size:11px;
    	}
    	.actionBox {
    	    padding:10px;
    	}
    </style>
    
    
    <div class="container">
    <h2 align="center">Video: {{ $videos->title }}</h2>
    <hr>
			<div class="row">
				<div class="detailBox">
				    <div class="titleBox">
				    	<iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $videos->name }}"  allowfullscreen></iframe></label>

				    </div>
					<hr>
					<div class="likeDescription">
					 	<div>
					 		Me Gusta: <label id="like{{ $videos->id }}">{{ $videos->likes()->count() }}</label> <div class="pull-right" style="margin-right: 10px"><button onclick="likee({{ $videos->id }})"><img src="{{ asset('like.png') }}" width="20px"></img></button>
					 	</div>
					    <div style="padding-top: 10px">
					 		No Me Gusta: <label id="unLike{{ $videos->id }}">{{ $videos->unLikes()->count() }}</label><div class="pull-right" style="margin-right: 10px"><button onclick="unLikee({{ $videos->id }})"><img src="{{ asset('unlike.png') }}" width="20px"></button>
					 	</div>
				    </div>
				   	<hr>
				    <div class="taskDescription">
				    	Description: {{ $videos->description }}
				    </div>
				    <hr>
			    	<div class="actionBox">
			    		Comentarios: 
				        <ul class="commentList">
				        	@foreach($videos->comments as $comment)
				            <li>
				                <div class="commentText">
				                    <p class=""><h6>{{ $comment->user->name }} dice:</h6> {{ $comment->comentario }}</p> <span class="date sub-text">on {{ $comment->updated_at }}</span>
				                </div>
				            </li>
				            @endforeach
				        </ul>
				        {{ Form::open(['route' => 'comment.store', 'class'=>'form-inline', 'role'=>'form']) }}
				  			<input type="hidden" value="{{ $videos->id }}" name="id">
				            <div class="form-group col-md-10">
				                <input class="form-control" type="text" placeholder="Tu Comentario" name="comentario" />
				            </div>
				            <div class="form-group">
				                <button class="btn btn-default">Agregar</button>
				            </div>
				        {{ Form::close() }}
				       
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