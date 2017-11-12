@extends('admin.adminLayout')
<?php
$name_user='name';
$data = isset( $item )? $item->$name_user: trans('trans.add');
$data = old($name_user,$data);
?>
@section('title')
    {{$data}}
@stop
@section('style')
    <style>
        .text_right_admin{
            padding-top: 5px;
        }
    </style>
@stop
@section('content')

    <h1>{{$data}}</h1>
    {!! Form::open(['files'=>'true']) !!}
    @if(isset($item))
        {!! Form::hidden('id',$item->id) !!}
    @endif
    <div class="nav-tabs-custom" >
        <ul class="nav nav-tabs">
            <?php $inc = 0;  ?>
            @foreach ($lang_data as $lang => $value)
                <li class="@if(! $inc ) active @endif">
                    <a href=".tab_{!! $lang !!}" data-toggle="tab">
                        {!! HTML::image("img/".$lang.".png") !!}
                    </a>
                    <?php $inc++;?>
                </li>
            @endforeach
        </ul>

        <div class="tab-content">
            <?php
            $inc = 0;
            ?>
            @foreach ($lang_data as $lang => $value)
                <div class="tab-pane @if(! $inc ) active @endif  tab-children tab_{!! $lang !!}" data-id="tab_{!! $lang !!}" >
                    <!--==================STATUS============-->
                    <div class="col-sm-2 text-right">
                        <div class="form-group">
                            <label class="text_right_admin">@lang('trans.gender')</label>
                        </div>
                    </div>
                    <?php
                    $data = isset( $item )? $item->genders_id: 0;
                    $data = old('genders_id',$data);
                    ?>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <select name="genders_id" class="form-control select2">
                                @foreach(\App\Models\Gender::orderBy('name')->get() as $g)
                                    <option value="{{$g->id}}" @if($g->id==$data) selected @endif>{{$g->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    @include('admin.forms.image',['address'=>'images','image'=>'image'])

                </div>
                <?php $inc++;?>
            @endforeach


        </div>
        <div class="clearfix"></div>
        <button type="submit" onclick="Save()"  class="btn btn-app" >
            <i class="fa fa-save"></i> @lang('trans.save')
        </button>
    </div>
@stop


@section('script')
    {!! HTML::script('js/select2.min.js') !!}
    <script>

        function select(th){
            $(th).select2({width:'100%'});
        }


    </script>
@stop

