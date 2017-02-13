@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-10">
                <div class="page-header">
                    <h1>Pages</h1>
                </div>
            </div>
            <div class="col-md-2">
                <a class="btn btn-primary" href="{{ route('admin.create.page') }}" >Create a new Page</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pages as $page) 
                <tr>
                    <td>{{ $page->id }}</td>
                    <td>{{ $page->title }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@stop