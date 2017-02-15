@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1>Update page</h1>
        </div>

        <div>
            <form class="ajax-submit" action="{{ route('admin.update.page', $page->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                
                <div class="form-group form-field-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $page->title }}" placeholder="Enter a title">
                    <p class="validation-error"></p>
                </div>
                
                <div class="form-group form-field-group required">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ $page->slug }}" placeholder="Enter a unique page slug">
                    <p class="validation-error"></p>
                </div>

                <div class="form-group form-field-group">
                    <label for="subtitle">Sub title</label>
                    <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ $page->subtitle }}" placeholder="Enter a sub title">
                    <p class="validation-error"></p>
                </div>

                <div class="form-group form-field-group">
                    <label for="excerpt">Excerpt</label>
                    <textarea class="form-control" id="excerpt" name="excerpt" rows="3">{{ $page->excerpt }}</textarea>
                    <p class="validation-error"></p>
                </div>

                <div class="form-group form-field-group">
                    <label for="body">Body</label>
                    <textarea class="form-control" id="body" name="body" rows="3">{!! $page->body !!}</textarea>
                    <p class="validation-error"></p>
                </div>

                <div class="form-check form-field-group">
                    <label class="form-check-label">
                        <input type="checkbox" name="is_active" value="1" {{ $page->is_active ? 'checked' : null }} class="form-check-input">
                        Active
                    </label>
                </div>
                <button type="button" class="btn btn-primary btn-submit submit-form">Submit</button>
            </form>
        </div>
    </div>
</div>
@stop