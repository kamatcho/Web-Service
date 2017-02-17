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

                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <a href="{{url('admin/images/add')}}" class="btn sbold green"> {{trans('admin.add_image')}}
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-comments"></i>{{trans('admin.images')}} </div>

                                </div>

                                <div class="portlet-body">
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center"> {{trans('admin.id')}} </th>
                                                <th class="text-center"> {{trans('admin.user')}}</th>
                                                <th class="text-center"> {{trans('admin.image')}} </th>
                                                <th class="text-center"> {{trans('admin.created_at')}} </th>
                                                <th class="text-center"> {{trans('admin.edit')}} </th>
                                                <th class="text-center"> {{trans('admin.remove')}} </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($images as $image)
                                                <tr>
                                                    <td class="text-center">
                                                        {{$image->id}}
                                                    </td>
                                                    <td class="text-center">

                                                        {{\App\User::find($image->user_id)->name}}
                                                    </td>
                                                    <td class="text-center">
                                                        <img style="height:50px; width: 50px;" src="{{asset('\public\user\image\\'.$image->image )}}">

                                                    </td>


                                                    <td class="text-center">
                                                        {{$image->created_at}}
                                                    </td>

                                                    <td class="text-center">
                                                        <a href="{{url('admin/images/edit/'.$image->id)}}" class="btn btn-circle purple btn-outline">{{trans('admin.edit')}}</a>

                                                    </td>
                                                    <td class="text-center">
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-circle red btn-outline" data-toggle="modal" data-target="#myModal_{{$image->id}}">
                                                            {{trans('admin.remove')}}
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="myModal_{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title" id="myModalLabel">{{trans('admin.remove')}}</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <h3>{{trans('admin.are_u_sure_u_want_to_delete')}}</h3>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        {!! Form::open(['url'=>'admin/images/delete/'.$image->id]) !!}
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('admin.no')}}</button>
                                                                        <input type="submit" class="btn btn-primary" value="{{trans('admin.yes')}}">
                                                                        {!! Form::close() !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach


                                            </tbody>
                                        </table>
                                        {!! $images->links() !!}
                                    </div>
                                </div>
                            </div>
                            <!-- END SAMPLE TABLE PORTLET-->
                        </div>
                    </div>

                    <!-- END SAMPLE FORM PORTLET-->
                </div>
            </div>

        </div>

@stop