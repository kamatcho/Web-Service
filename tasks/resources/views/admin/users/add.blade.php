
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
                            <label class="col-md-2 control-label" for="form_control_1">{{trans('admin.name')}}</label>
                            <div class="col-md-10">
                                <input type="text" name="name" class="form-control" id="form_control_1" placeholder="{{trans('admin.name')}}" >
                                <div class="form-control-focus"> </div>
                                <span class="help-block">{{trans('admin.name')}}</span>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">{{trans('admin.email')}}</label>
                            <div class="col-md-10">
                                <input type="email" name="email" class="form-control" id="form_control_1" placeholder="{{trans('admin.email')}}" >
                                <div class="form-control-focus"> </div>
                                <span class="help-block">{{trans('admin.email')}}</span>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">{{trans('admin.password')}}</label>
                            <div class="col-md-10">
                                <input type="password" name="password" class="form-control" id="form_control_1" placeholder="{{trans('admin.password')}}" >
                                <div class="form-control-focus"> </div>
                                <span class="help-block">{{trans('admin.password')}}</span>
                            </div>
                        </div>


                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">{{trans('admin.type')}}</label>
                            <div class="col-md-10">
                                <select class="form-control" name="type">
                                    <option value="1">{!! trans('admin.admin') !!}</option>
                                    <option value="0">{!! trans('admin.user') !!}</option>
                                </select>
                                <div class="form-control-focus"> </div>
                                <span class="help-block">{{trans('admin.type')}}</span>
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