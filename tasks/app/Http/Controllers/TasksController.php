<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Validator;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::paginate(10);
        return view('admin.users.tasks.tasks',['title'=>trans('admin.tasks'),'tasks'=>$tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('type',0)->get();
        return view('admin.users.tasks.add',['title'=>trans('admin.add_task'),'users'=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'task'=>'required',
            'user'=>'required',
            'description'=>'required',
        ];

        $val = Validator::make($request->all(),$rules);
        $val->SetAttributeNames([
            'task'=>trans('admin.task'),
            'user'=>trans('admin.user'),
            'description'=>trans('admin.description')
        ]);
        if ($val->fails())
        {
            return redirect()->back()->withInput()->withErrors($val);
        }else{
            $task = new Task();
            $task->user_id = $request->input('user');
            $task->task = $request->input('task');
            $task->description = $request->input('description');
            $task->save();
            session()->flash('success',trans('admin.added'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(isset($id)){
            $task = Task::find($id);
            $users = User::where('type',0)->get();
            return view('admin.users.tasks.edit',['title'=>trans('admin.edit_task'),'task'=>$task,'users'=>$users]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'task'=>'required',
            'user'=>'required',
            'description'=>'required',
        ];

        $val = Validator::make($request->all(),$rules);
        $val->SetAttributeNames([
            'task'=>trans('admin.task'),
            'user'=>trans('admin.user'),
            'description'=>trans('admin.description')
        ]);
        if ($val->fails())
        {
            return redirect()->back()->withInput()->withErrors($val);
        }else{
            $task = Task::find($id);
            $task->user_id = $request->input('user');
            $task->task = $request->input('task');
            $task->description = $request->input('description');
            $task->save();
            session()->flash('success',trans('admin.updated'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        session()->flash('success',trans('admin.deleted'));
        return redirect()->back();
    }
}
