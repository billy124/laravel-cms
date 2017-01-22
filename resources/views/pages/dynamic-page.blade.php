@extends('layouts.master')

@section('content')
<div class="page-header">
    <h1>{{ $page->title }}</h1>
</div>
<p class="lead">
    {!! $page->body !!}
</p>
@stop