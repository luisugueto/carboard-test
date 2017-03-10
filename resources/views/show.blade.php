@extends('layouts.app')

@section('content')
    @if(isset($videos->likes) && $videos->likes->count() > 0)
        {{ $videos->likes->count() }}
    @endif
    @if(isset($videos->likes) && $videos->unlikes->count() > 0)
        {{ $videos->likes->count() }}
    @endif
@endsection
