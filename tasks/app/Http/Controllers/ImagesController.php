<?php

namespace App\Http\Controllers;

use App\Image;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Intervention\Image\Facades\Image as ResizeImage ;
class ImagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::paginate(10);

        return view('admin.users.images.images',['title'=>trans('admin.images'),'images'=>$images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('type',0)->get();
        return view('admin.users.images.add',['title'=>trans('admin.add_image'),'users'=>$users]);
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
            'user'=>'required|integer',
            'image'=>'required |mimes:jpg,png,jpeg'
        ];
        $val = Validator::make($request->all(),$rules);
        if ($val->fails())
        {
            return redirect()->back()->withInput()->withErrors($val);
        }else{
            $add_image = new Image();
            $add_image->user_id = $request->input('user');
            if ($request->hasFile('image')) {
                $realPath = $request->file('image');
                $ext = $request->file('image')->getClientOriginalName();
                $file_name = time() . '.' . $ext;
                $path = public_path('/user/image/'.$file_name);
                $image_resize = ResizeImage::make($realPath->getRealPath())->resize(100,100)->save($path,80);

                if ($image_resize) {
                    $add_image->image = $file_name;

                }
                $add_image->save();

            }
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
        $image = Image::find($id);
        $users = User::where('type',0)->get();
        return view('admin.users.images.edit',['title'=>trans('admin.edit_image'),'image'=>$image,'users'=>$users]);
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
            'user'=>'required|integer',
            'image'=>'required |mimes:jpg,png,jpeg'
        ];
        $val = Validator::make($request->all(),$rules);
        if ($val->fails())
        {
            return redirect()->back()->withInput()->withErrors($val);
        }else{
            $edit_image = Image::find($id);
            $edit_image->user_id = $request->input('user');
            if ($request->hasFile('image')) {
                if (file_exists(base_path().'\public\user\image\\'.$edit_image->image))
                {
                    unlink(base_path().'\public\user\image\\'.$edit_image->image);
                }
                $realPath = $request->file('image');
                $ext = $request->file('image')->getClientOriginalName();
                $file_name = time() . '.' . $ext;
                $image_resize = ResizeImage::make($realPath->getRealPath())->resize(100,100)->save(base_path() . '\public\user\image\\'.$file_name);
                if ($image_resize == true) {
                    $edit_image->image = $file_name;


                }
                $edit_image->save();

            }
            session()->flash('success',trans('admin.added'));
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
        $delete_image = Image::find($id);
        if (file_exists(base_path().'\public\user\image\\'.$delete_image->image))
        {
            unlink(base_path().'\public\user\image\\'.$delete_image->image);
        }
        $delete_image->delete();
        session()->flash('success',trans('admin.success'));
        return redirect()->back();

    }
}
