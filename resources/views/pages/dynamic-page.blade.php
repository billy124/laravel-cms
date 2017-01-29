@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1>{{ $page->title }}</h1>
        </div>
        <div>
            {!! $page->body !!}
        </div>
    </div>
</div>
@stop