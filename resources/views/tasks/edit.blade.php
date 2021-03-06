@extends('layouts.main')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" action="{{route('tasks.update',$task->id)}}">
    {{csrf_field()}}
    @method('PUT')
    <h2>Editar Tarea</h2>
    <hr>
    <div class="form-group">
        <label for="user_id">Asignada a: </label>
        <select class="form-control" id="user_id" name="user_id">
            @foreach ($users as $user)
                @if ($task->user_id == $user->id)
                    <option value="{{$user->id}}" selected>{{$user->name}}</option>
                @else
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="name">Título : </label>
        <input type="text" class="form-control" id="name" name="name" value="{{$task->name}}">
    </div>
    <div class="form-group">
        <label for="description">Descripción</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{$task->description}}</textarea>
    </div>
    <div class="form-group">
        <!-- Date input -->
        <label class="control-label" for="assigned_date">Fecha prevista de realización</label>
        <input class="form-control" id="assigned_date" name="assigned_date" type="date" value="{{$task->assigned_date}}"/>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

@endsection