@extends('layouts.main')

@section('content')

<h2>Información de Tarea</h2>
<hr>
<div class="row"><h5>Título</h5></div>
<div class="row"><p>{{$task->name}}</p></div>
<div class="row"><h5>Descripción</h5></div>
<div class="row"><p>{{$task->description}}</p></div>
<div class="row"><h5>Fecha prevista de realización</h5><br></div>
<div class="row"><p>{{$task->assigned_date}}</p></div>
<div class="row"><h5>Fecha de realización</h5><br></div>
<div class="row"><p>{{$task->realization_date}}</p></div>
<div class="row"><h5>Tiempo de realización</h5><br></div>
<div class="row"><p>{{$task->realization_time}}</p></div>
<div class="row"><h5>Ficheros</h5><br></div>
<div class="row"><p>{{$task->files_to_upload}}</p></div>
<div class="row"><h5>Comentarios</h5><br></div>
<div class="row"><p>{{$task->comments}}</p></div>

@endsection