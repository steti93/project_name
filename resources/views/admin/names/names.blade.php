@extends('admin.adminLayout')

@section('title')
    @lang('trans.names')
@stop
<?php
$temp=['name'];

foreach($temp as $i){
    if(isset($_GET[$i]) && !empty($_GET[$i])){
        $filter[$i]=$_GET[$i];
    }else{
        $filter[$i]='';
    }
}

?>
@section('content')
    <h1>@lang('trans.names')</h1>
    <a href="{{URL::route('admin/name')}}"> <button type="button" class="btn btn-primary top_button_admin" data-toggle="modal" data-target="#addSlider">
            <span class="glyphicon glyphicon-plus"></span> {{ trans('trans.add') }}
        </button></a>
    <div class="well">
        <div class="row"> {!! Form::open(['method'=>'GET']) !!}
            <div class="col-sm-12">
                <div class="form-group"><label for="filter_name">@lang('trans.name')</label> <input
                            type="text" value="{{$filter['name']}}" name="name" autocomplete="off" class="form-control"
                            placeholder="@lang('trans.name')"></div>
            </div>
            <div class="col-sm-12">
                <button type="submit"
                        class="btn btn-primary pull-right"><i
                            class="fa fa-search"></i> @lang('trans.filtre')</button>
            </div> {!! Form::close() !!} </div>
    </div>


    <table class="table table-bordered">
        <thead>
        <tr>
            <td>@lang('trans.name')</td>
            <td>@lang('trans.action')</td>
        </tr>
        </thead>

        <tbody>


        @foreach($items as $item)
            <tr>
                <td>
                    {{$item->getName()}}
                </td>

                <td >
                    <a href="{{URL::route('admin/name',$item->id)}}"><div data-toggle="modal" data-target="#edit_{{$item->id}}" class="edit-pencil btn btn-xs btn-primary">
                            <span  class="glyphicon glyphicon-pencil"></span>
                        </div></a>
                    <!--END EDIT MODAL -->
                    <div data-toggle="modal" data-target="#delete_{{$item->id}}" class="delete-trash btn btn-xs btn-danger">
                        <span  class="glyphicon glyphicon-trash"></span>
                    </div>
                    <!--DELETE SLIDER-->
                    <div class="modal fade" tabindex="-1" role="dialog" id="delete_{{ $item->id }}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">&nbsp;</h4>
                                </div>
                                <div class="modal-body">
                                    {{ trans('trans.sure-delete') }}?
                                </div>
                                <div class="modal-footer">
                                    <div class="clearfix"></div>
                                    {!! Form::open(['method' => 'DELETE']) !!}
                                    {!! Form::hidden('id', $item->id) !!}
                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('trans.cancel') }}</button>
                                    <button type="submit" class="btn btn-warning">{{ trans('trans.delete') }}</button>
                                    {!! Form::close() !!}
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <!--END DELETE SLIDER-->
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $items->links('../../vendor/pagination/bootstrap-4')  !!}
@stop
@section('style')
    <style>
        .table tr td{
            width: 150px;
        }
        .table tr td:nth-child(1){
            width: auto;
        }
    </style>
@stop