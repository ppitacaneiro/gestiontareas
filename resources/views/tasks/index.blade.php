@extends('layouts.main')

@section('content')

@if (session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
    <h2>Listado de Tareas</h2>
    <hr>
    <table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Usuario</th>
            <th scope="col">Fecha prevista</th>
            <th scope="col">Estado</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    @if(count($tasks))
        @foreach($tasks as $task)
            <tr>
                <td>
                    @if ($task->status == 'realizada')
                        <input type="checkbox" name="tasks_to_update[]" value="{{$task->id}}">
                    @endif
                </td>
                <td>{{$task->id}}</td>
                <td>{{$task->taskname}}</td>
                <td>{{$task->username}}</td>
                <td>{{$task->assigned_date}}</td>
                <td>{{$task->status}}</td>
                <td>
                    @if ($task->status == 'realizada')
                    <a href="{{route('tasks.show',$task->id)}}" class="btn btn-primary">Info</a>
                    @endif
                </td>
                <td>
                    @if ($task->status == 'pendiente')
                    <a href="{{route('tasks.edit',$task->id)}}" class="btn btn-success">Editar</a>
                    @endif
                </td>
                <td>
                    @if ($task->status == 'pendiente')
                    <form action="{{route('tasks.destroy',$task->id)}}" method="post">
                        {{csrf_field()}}
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </form>
                    @endif
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
    </table>
    <div>

@endsection