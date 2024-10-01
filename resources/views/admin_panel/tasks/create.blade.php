@extends('adminlte::page')

@section('title', 'AdminPanel')

@section('content_header')
<h1 class="m-0 text-dark">New task</h1>
@stop

@section('js')
<script src="/js/admin_panel/tasks/create.js"></script>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_panel/tasks/create.css" />
@stop

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Task</h3>
            </div>
            <form method="POST" action="{{ route('admin_panel::tasks::store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter the name" value="{{ old('title') }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" placeholder="Enter a description" rows="4" no-resize>{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="card-footer">
                    <a class="btn btn-secondary" href="{{ route('admin_panel::tasks::index') }}">Cancel</a>
                    <button type="submit" class="btn btn-primary">Continue</button>
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