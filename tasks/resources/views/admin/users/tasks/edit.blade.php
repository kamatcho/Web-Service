
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
                </div>
                <div class="portlet-body form">
                    {!! Form::open() !!}
                    <div class="form-body">

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">{{trans('admin.user')}}</label>
                            <div class="col-md-10">
                                <select name="user" class="form-control">
                                    <option selected value="{!! $task->user_id !!}">{!! \App\User::find($task->user_id)->name !!}</option>
                                    @foreach($users as $user)
                                        <option value="{!! $user->id !!}">{!! $user->name !!}</option>
                                    @endforeach
                                </select>
                                <div class="form-control-focus"> </div>
                                <span class="help-block">{{trans('admin.user')}}</span>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">{{trans('admin.task')}}</label>
                            <div class="col-md-10">
                                <input type="text" name="task" class="form-control" id="form_control_1" placeholder="{{trans('admin.task')}}" value="{!! $task->task !!}" >
                                <div class="form-control-focus"> </div>
                                <span class="help-block">{{trans('admin.task')}}</span>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">{{trans('admin.description')}}</label>
                            <div class="col-md-10">
                                <textarea name="description" class="form-control" >{!! $task->description !!}</textarea>
                                <div class="form-control-focus"> </div>
                                <span class="help-block">{{trans('admin.description')}}</span>
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