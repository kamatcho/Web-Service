<?php

namespace App\Http\Controllers;

use App\Image;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Intervention\Image\ImageManagerStatic as ResizeImage ;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'email'=>'required|email',
            'password'=>'required'
        ];

        $val = Validator::make($request->all(),$rules);
        if ($val->fails())
        {
            $data = [
                'status'=>0,
                'msg'=>'U Nedd To Fill All of Fields',
                'errors'=>$val->errors()
            ];
            return response()->json($data,200);
        }

        $userValidate = Auth::validate($request->all());
        if ($userValidate){
            $user = User::where('email',$request->input('email'))->first();
            $data = [
                'status'=>1,
                'msg'=>'U R Logged In',
                'data'=>$user
            ];
            return response()->json($data,200);
        }else{
            $data = [
                'msg'=>"We Haven't This User On Our Database",

            ];
            return response()->json($data,200);
        }
    }

    public function register(Request $request)
    {
        $rules = [
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required'
        ];
        $val = Validator::make($request->all(),$rules);

        if ($val->fails()){
            $data = [
                'status'=>0,
                'msg'=>'U Nedd To Fill All of Fields',
                'errors'=>$val->errors()
            ];
            return response()->json($data,200);
        }else{
            $api_token = str_random(60);
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->api_token = $api_token;
            $user->type = 0;
            if ($user->save()){
                $data =[
                    'status'=>1,
                    'api_token'=>$api_token,
                    'msg'=>'U Registered Successfully'
                ];

            }else{
                $data = [
                    'status'=>0,
                    'msg'=>'Something Wrong Please Try Again',

                ];

            }
            return response()->json($data,200);
        }



    }
    // Show User Tasks
    public function task(){
        $user_id = auth()->guard('api')->user()->id;
        $tasks = Task::where('user_id',$user_id)->paginate(10);

        return $tasks;
    }
    // Add Task For User
    public function addTask(Request $request)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required'
        ];
        $val = Validator::make($request->all(), $rules);
        if ($val->fails()) {
            $data = [
                'status' => 1,
                'msg' => 'U Need To Fil All Of Fields',
                'error' => $val->errors()
            ];
            return response()->json($data, 200);
        } else {
            $user_id = auth()->guard('api')->user()->id;
            $task = new Task();
            $task->task = $request->input('name');
            $task->user_id = $user_id;
            $task->description = $request->input('description');
            $task->save();
            $data = [
                'status' => 1,
                'msg' => 'Task Is Saved'
            ];
            return response()->json($data, 200);

        }
    }

        // Edit Task
        public function editTask(Request $request)
        {
            $rules = [
                'name' => 'required',
                'description' => 'required'
            ];
            $val = Validator::make($request->all(), $rules);
            if ($val->fails()) {
                $data = [
                    'status' => 1,
                    'msg' => 'U Need To Fil All Of Fields',
                    'error' => $val->errors()
                ];
                return response()->json($data, 200);
            } else {
                $user_id = auth()->guard('api')->user()->id;
                $task = Task::find($request->input('id'));
                $task->task = $request->input('name');
                $task->user_id = $user_id;
                $task->description = $request->input('description');
                $task->save();
                $data = [
                    'status' => 1,
                    'msg' => 'Task Is Saved'
                ];
                return response()->json($data, 200);

            }

        }

        public function DeleteTask (Request $request )
        {
            $rules = [
                'id'=> 'required'
            ];
            $val = Validator::make($request->all(),$rules);
            if ($val->fails()){
                $data = [
                    'status'=>0,
                    'msg'=>' SomeThing Wrong Please Try Again Later',
                    'errors'=>$val->errors()
                ];

            }else {
                $task_id = $request->input('id');
                $delete_task = Task::find($task_id);
                $delete_task->delete();
                $data = [
                    'status'=>1,
                    'msg' => ' Task Is Deleted'
                ];

            }

            return response()->json($data,200);
        }

        ///////// Images


    public  function AddImage(Request $request)
    {
        $rules = [
            'image'=> 'required | mimes:jpeg,bmp,png '
        ];

        $val = Validator::make($request->all(),$rules);
        if ($val->fails()){
            $data = [
                'status'=>0,
                'msg'=>'There Is Error Please Check Ur Image Type',
                'error'=>$val->errors()
            ];
        }else {

            if ($request->hasFile('image')) {
                $add_image = new Image();
                $user_id = auth()->guard('api')->user()->id;
                $add_image->user_id = $user_id;
                $realPath = $request->file('image');
                $ext = $request->file('image')->getClientOriginalName();
                $file_name = time() . '.' . $ext;
                $path = public_path('/user/image/'.$file_name);
                $image_resize = ResizeImage::make($realPath->getRealPath())->resize(100,100)->save($path,80);
                if ($image_resize == true) {
                    $add_image->image = $file_name;


                }
                $add_image->save();
                $data = [
                    'status'=>1,
                    'msg'=>'Congratulation Ur Image Uploaded'
                ];
            }else{
                $data = [
                    'status'=>0,
                    'msg'=>'There Is UnKnown Error Please Try Again'

                ];
            }


        }

        return response()->json($data,200);

    }

    public function userImage(){
        $user_id = auth()->guard('api')->user()->id;
        $iamges = Image::where('user_id',$user_id)->paginate(10);
        return $iamges;
    }

}

