
@extends('admin.layout.home')
@section('content')


    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption font-green-haze">
                        <i class="icon-settings font-green-haze"></i>
                        <span class="caption-subject bold uppercase"> @if(!empty($title)){{$title}} @endif</span>

                    </div>
                    &bkarow;
                    <span class="caption-subjec">
                        <img style="height:50px; width: 50px;" src="{{asset('\public\user\image\\'.$image->image )}}">

                    </span>

                </div>
                <div class="portlet-body form">
                    {!! Form::open(['files'=>true]) !!}
                    <div class="form-body">

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">{{trans('admin.user')}}</label>
                            <div class="col-md-10">
                                <select name="user" class="form-control">
                                    <option value="{!! $image->user_id !!}">{!! \App\User::find($image->user_id)->name !!}</option>
                                    @foreach($users as $user)
                                        <option value="{!! $user->id !!}">{!! $user->name !!}</option>
                                    @endforeach
                                </select>
                                <div class="form-control-focus"> </div>
                                <span class="help-block">{{trans('admin.user')}}</span>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">{{trans('admin.image')}}</label>
                            <div class="col-md-10">
                                <input type="file" name="image" class="form-control" id="form_control_1" placeholder="{{trans('admin.image')}}" >
                                <div class="form-control-focus"> </div>
                                <span class="help-block">{{trans('admin.image')}}</span>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-10">
                                    <input type="reset" class="btn default" value="{{trans('admin.cancel')}}">
                                    <input type="submit" class="btn blue" value="{{trans('admin.submit')}}">
                                </div>
                            </div>
                        </div>




                    </div>

                    {!! Form::close() !!}
                </div>

                <!-- END SAMPLE FORM PORTLET-->
            </div>
        </div>

    </div>

@stop