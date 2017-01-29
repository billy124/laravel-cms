@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1>Create a new page</h1>
        </div>

        <div>
            <form class="ajax-submit" action="{{ route('store.page') }}" method="post">
                {{ csrf_field() }}
                
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter a unique page slug">
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter a title">
                </div>


                <div class="form-group">
                    <label for="subtitle">Sub title</label>
                    <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Enter a sub title">
                </div>

                <div class="form-group">
                    <label for="excerpt">Excerpt</label>
                    <textarea class="form-control" id="excerpt" name="excerpt" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea class="form-control" id="body" name="body" rows="3"></textarea>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input">
                        Active
                    </label>
                </div>
                <button type="button" class="btn btn-primary btn-submit submit-form">Submit</button>
            </form>
        </div>
    </div>
</div>
@stop