<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::select(
            'tasks.id',
            'tasks.name as taskname',
            'tasks.assigned_date',
            'users.name as username',
            'tasks.status'
        )->join('users','users.id','=','tasks.user_id')
        ->get()
        ->sortByDesc('id');

        return view("tasks.index",compact("tasks"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();

        return view("tasks.create",compact("users"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'assigned_date' => 'date_format:Y-m-d'
        ]);
        $task = Task::create($validatedData);

        return redirect("/tasks")->with('success','Datos de tarea guardados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);

        return view("tasks.show",compact("task"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $users = User::all();
        
        return view("tasks.edit",compact("task","users"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'assigned_date' => 'date_format:Y-m-d'
        ]);
        Task::whereId($id)->update($validatedData);

        return redirect("/tasks")->with('success','Datos de tarea con actualizados correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect("/tasks")->with('success','Registro eliminado correctamente.');
    }

    /**
     * Show Tasks of the authenticated user
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function listByUserLogged()
    {
       $idUserAuth = Auth::id();

       $where = [
        'user_id' => $idUserAuth,
        'status' => 'pendiente'

       ];

       $tasks = Task::where($where)->orderBy('assigned_date','ASC')->get();

       return view("tasks.mytasks",compact("tasks"));
    }

    /**
     * Do task of the authenticated user
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function do($id)
    {
        $task = Task::findOrFail($id);

        return view("tasks.do",compact("task"));
    }

    public function done(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'realization_date' => 'date_format:Y-m-d',
            'realization_time' => 'numeric',
            'files_to_upload' => 'required'
        ]);

        if ($validator->fails()) 
        {
            return redirect('dotask/' . $id)
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
            $task = Task::findOrFail($id);

            $task->status = 'realizada';
            $task->files_to_upload = $request->files_to_upload;
            $task->comments = $request->comments;
            $task->realization_date = $request->realization_date;
            $task->realization_time = $request->realization_time;

            $task->save();

            return redirect("mytasks")->with('success','Datos de realización de tarea guardados correctamente.');
        }
    }
}
