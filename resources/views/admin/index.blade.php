@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1>Dashboard</h1>
</div>
<div>
<p >
    <ul>
        <li>
            <a href="" >View all pages</a>
        </li>
        <li>
            <a href="{{ route('create.page') }}" >Create a new Page</a>
        </li>
    </ul>
</p>
</div>
@stop