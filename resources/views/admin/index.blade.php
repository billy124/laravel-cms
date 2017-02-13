@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1>Dashboard</h1>
</div>
<div>
    <ul>
        <li>
            <a href="{{ route('admin.list.pages') }}">Manage Pages</a>
        </li>
    </ul>
</div>
@stop