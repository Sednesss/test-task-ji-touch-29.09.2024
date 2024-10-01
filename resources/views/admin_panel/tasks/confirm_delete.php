@extends('adminlte::page')

@section('title', 'AdminPanel')

@section('content_header')
<h1 class="m-0 text-dark">Confirm delete</h1>
@stop

@section('content')
<div class="row">
    <div class="card col-md-9">
        <div class="card-header">
            <h3 class="card-title">Confirmation of deletion of task [ID: ${task->id_text}]</h3>
        </div>

        <div class="card-body">
        <a class="btn btn-secondary" href="{{ route('admin_panel::tasks::index') }}">Cancel</a>
        <button type="submit" class="btn btn-primary">Confirm</button>
        </div>
    </div>
</div>
@stop