@extends('adminlte::page')

@section('title', 'AdminPanel')

@section('content_header')
<h1 class="m-0 text-dark">Tasks</h1>
@stop

@section('content')
<div class="row">
    <div class="card col-md-9">
        <div class="card-header">
            <h3 class="card-title">List of Tasks</h3>
        </div>

        <div class="card-body">
            <div class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-hover dataTable dtr-inline">
                            <thead>
                                <tr>
                                    <th class="col-1">№</th>
                                    <th class="col-2">Author</th>
                                    <th class="col-2">Title</th>
                                    <th class="col-4">Description</th>
                                    <th class="col-1">Completed</th>
                                    <th class="col-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $taskIndex => $task)
                                <tr class="odd">
                                    <td class="col-1">{{ 1 + $taskIndex }}</td>
                                    <td class="col-2">{{ $task->user->name }}</td>
                                    <td class="col-2">{{ $task->title }}</td>
                                    <td class="col-4">{{ $task->description }}</td>
                                    <td class="col-1">
                                        @if($task->completed == '1')
                                        Yes
                                        @elseif($task->completed == '0')
                                        No
                                        @endif
                                    </td>
                                    <td class="col-2 align-middle py-1 text-center skin_element-actions">
                                        <a class="btn btn-transparent btn-icon" href="{{ route('admin_panel::tasks::edit', $task->id_text) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a class="btn btn-transparent btn-icon" href="{{ route('admin_panel::tasks::confirm_delete', $task->id_text) }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">

                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3 pt-0">
            <div class="col">
                <div class="card-header mb-3">
                    <h3 class="card-title">Tools</h3>
                </div>
                <a class="btn btn-block btn-secondary" href="{{ route('admin_panel::tasks::create') }}">Add new task</a>
            </div>
        </div>
    </div>
</div>
@stop