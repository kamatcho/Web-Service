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
                                    <a href="{{url('admin/tasks/add')}}" class="btn sbold green"> {{trans('admin.add_task')}}
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
                                        <i class="fa fa-comments"></i>{{trans('admin.tasks')}} </div>

                                </div>

                                <div class="portlet-body">
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center"> {{trans('admin.id')}} </th>
                                                <th class="text-center"> {{trans('admin.user')}}</th>
                                                <th class="text-center"> {{trans('admin.task')}} </th>
                                                <th class="text-center"> {{trans('admin.description')}} </th>
                                                <th class="text-center"> {{trans('admin.created_at')}} </th>
                                                <th class="text-center"> {{trans('admin.edit')}} </th>
                                                <th class="text-center"> {{trans('admin.remove')}} </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($tasks as $task)
                                                <tr>
                                                    <td class="text-center">
                                                        {{$task->id}}
                                                    </td>
                                                    <td class="text-center">

                                                        {{\App\User::find($task->user_id)->name}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$task->task}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$task->description}}
                                                    </td>

                                                    <td class="text-center">
                                                        {{$task->created_at}}
                                                    </td>

                                                    <td class="text-center">
                                                        <a href="{{url('admin/tasks/edit/'.$task->id)}}" class="btn btn-circle purple btn-outline">{{trans('admin.edit')}}</a>

                                                    </td>
                                                    <td class="text-center">
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-circle red btn-outline" data-toggle="modal" data-target="#myModal_{{$task->id}}">
                                                            {{trans('admin.remove')}}
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="myModal_{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title" id="myModalLabel">{{trans('admin.remove')}}</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <h3>{{trans('admin.are_u_sure_u_want_to_delete')." ".$task->task}}</h3>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        {!! Form::open(['url'=>'admin/tasks/delete/'.$task->id]) !!}
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
                                        {!! $tasks->links() !!}
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