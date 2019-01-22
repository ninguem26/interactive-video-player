@extends('layouts.default')

<head>
    <title>Videos</title>
</head>

@section('content')
    <div class="col-8 offset-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @foreach($videos as $v)
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><a href="/videos/{{ $v->id }}">{{ $v->title }}</a></h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $v->durationString }}</h6>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
