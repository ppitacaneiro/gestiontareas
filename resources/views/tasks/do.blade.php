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

<h2>Realizar Tarea</h2>
<hr>
<div class="row"><h5>Título</h5></div>
<div class="row"><p>{{$task->name}}</p></div>
<div class="row"><h5>Descripción</h5></div>
<div class="row"><p>{{$task->description}}</p></div>
<div class="row"><h5>Fecha prevista de realización</h5><br></div>
<div class="row"><p>{{$task->assigned_date}}</p></div>
<form action="{{route('donetask',$task->id)}}" method="POST">
  {{csrf_field()}}
  <div class="form-group">
    <label for="realization_date">Fecha de Realización</label>
    <input type="date" class="form-control" id="realization_date" name="realization_date">
  </div>
  <div class="form-group">
    <label for="realization_time">Tiempo de realización de la tarea</label>
    <input type="number" class="form-control" id="realization_time" name="realization_time" min="0">
    <small id="realization_time_help" class="form-text text-muted">El tiempo de realización de la tarea debe expresarse en horas</small>
  </div>
  <div class="form-group">
    <label for="files_to_upload">Ficheros</label>
    <textarea class="form-control" id="files_to_upload" name="files_to_upload" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="comments">Observaciones</label>
    <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Guardar</button>
</form>

@endsection