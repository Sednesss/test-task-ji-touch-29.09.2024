@extends('adminlte::page')

@section('title', 'AdminPanel')

@section('content_header')
<h1 class="m-0 text-dark">Task: <strong>(ID:{{ $task->id_text }})</strong></h1>
@stop

@section('content')
<div class="row">
    <div class="card col-md-6">
        <div class="card-header">
            <h3 class="card-title">Confirmation of deletion</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin_panel::tasks::destroy', $task->id_text) }}">
                @csrf
                @method('DELETE')
                
                <div class="card-footer">
                    <a class="btn btn-secondary" href="{{ route('admin_panel::tasks::index') }}">Cancel</a>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>

        </div>
    </div>
</div>
@stop