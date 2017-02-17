<?php

namespace App\Http\Controllers;

use App\Image;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Validator;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('admin.home',['title'=>trans('admin.home')]);
    }
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.users',['title'=>trans('admin.users'),'users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.add',['title'=>trans('admin.add_user')]);
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
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required',
            'type'=>'required'
        ];
        $val = Validator::make($request->all(),$rules);
        $val->SetAttributeNames([
            'name'=>trans('admin.name'),
            'email'=>trans('admin.email'),
            'password'=>trans('admin.password'),
            'type'=>trans('admin.type')
        ]);
        if ($val->fails())
        {
            return redirect()->back()->withInput()->withErrors($val);
        }else{
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->type = $request->input('type');
            $user->api_token = str_random(60);
            $user->save();
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
        if (isset($id)){
            $user = User::find($id);
            if (isset($user)){
                return view('admin.users.edit',['title'=>trans('admin.edit'),'user'=>$user]);
            }else{
                return redirect('/admin');
            }
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
        if (isset($id))
        {
            $rules = [
                'name'=>'required',
                'email'=>'required|email|unique:users,email,'.$id,
                'type'=>'required'
            ];
            $val = Validator::make($request->all(),$rules);
            $val->SetAttributeNames([
                'name'=>trans('admin.name'),
                'email'=>trans('admin.email'),
                'type'=>trans('admin.type')
            ]);
            if ($val->fails())
            {
                return redirect()->back()->withInput()->withErrors($rules);
            }else{
                $user = User::find($id);
                if ($user != null)
                {
                    $user->name = $request->input('name');
                    $user->email = $request->input('email');
                    if (!empty($request->input('password')) ){
                        $user->password = bcrypt($request->input('password'));
                    }
                    $user->type = $request->input('type');

                    $user->save();
                    session()->flash('success',trans('admin.updated'));
                    return redirect()->back();
                }


            }
        }else{
            return redirect('/admin');
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
        $user = User::find($id);
        if ($user != null){
            // Find And Delete User Tasks
            $tasks = Task::where('user_id',$id)->get();
            if ($tasks != null){
                foreach ($tasks as $task){
                    $task->delete();
                }
            }
            // Find And Delete Image
            $images = Image::where('user_id',$id)->get();
            if ($images != null)
            {
                foreach ($images as $image)
                {
                    // Check If File Exist
                    if (file_exists(base_path().'\public\user\image\\'.$image->image))
                    {
                        unlink(base_path().'\public\user\image\\'.$image->image);
                    }
                    $image->delete();

                }
            }
            $user->delete();

            session()->flash('success',trans('admin.deleted'));
            return redirect()->back();
        }
    }



    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}






