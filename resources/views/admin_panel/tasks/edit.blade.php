@extends('adminlte::page')

@section('title', 'AdminPanel')

@section('content_header')
<h1 class="m-0 text-dark">Task: <strong>(ID:{{ $task->id_text }})</strong></h1>
@stop

@section('js')
<script src="/js/admin_panel/tasks/edit.js"></script>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_panel/tasks/edit.css" />
@stop

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editing task</h3>
            </div>
            <form method="POST" action="{{ route('admin_panel::tasks::update', $task->id_text) }}">
                @csrf
                @method('PATCH')

                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter the name" value="{{ $task->title }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" placeholder="Enter a description" rows="4" no-resize>{{ $task->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="hidden" name="completed" value="0">
                            <input type="checkbox" class="custom-control-input" id="completed" name="completed" value="1" @if($task->completed == 1) checked @endif>
                            <label class="custom-control-label" for="completed">Complated</label>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a class="btn btn-secondary" href="{{ route('admin_panel::tasks::index') }}">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="notifications_section" class="toasts-top-right fixed">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="toast bg-danger fade show alert-error">
        <div class="toast-header">
            <strong class="mr-auto">Save error</strong>
            <small class="ml-2">Incorrect input</small>
            <button type="button" class="ml-2 mb-1 close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="toast-body">{{ $error }}</div>
    </div>
    @endforeach
    @endif
</div>
@stop