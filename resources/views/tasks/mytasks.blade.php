@extends('layouts.main')
@section('content')

    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <h2>Mis Tareas</h2>
    <hr>
    <table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Fecha prevista de Realización</th>
            <th scope="col">Estado</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    @if(count($tasks))
        @foreach($tasks as $task)
            <tr>
                <td>{{$task->id}}</td>
                <td>{{$task->name}}</td>
                <td>{{$task->assigned_date}}</td>
                <td>{{$task->status}}</td>
                <td>
                    @if($task->status == 'pendiente') 
                        <a class="btn btn-primary" href="{{ route('dotask',['id' => $task->id]) }}">Realizar</a>
                    @endif
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
    </table>

@endsection