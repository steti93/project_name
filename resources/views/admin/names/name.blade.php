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
                <?php
                $name='name';
                $meaning='meaning';
                ?>
                <div class="tab-pane @if(! $inc ) active @endif  tab-children tab_{!! $lang !!}" data-id="tab_{!! $lang !!}" >
                    <!-----------------------NAME------------------->

                    <div class="col-sm-2 text-right">
                        <div class="form-group">

                            <label class="text_right_admin">@lang('trans.name')</label>

                        </div>
                    </div>
                    <?php
                    $data = isset( $item )? $item->getName(): '';
                    $data = old($name,$data);
                    ?>
                    <div class="col-sm-10">
                        <div class="form-group">

                            <input type="text" class="form-control " name="{{$name}}"  value="{{$data}}" @if(isset($max_length)) maxlength="{{$max_length}}" @else maxlength="255" @endif required>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!--==================STATUS============-->
                    <div class="col-sm-2 text-right">
                        <div class="form-group">
                            <label class="text_right_admin">@lang('trans.gender')</label>
                        </div>
                    </div>
                    <?php
                    $data = isset( $item )? $item->genders_id: 1;
                    $data = old('genders_id',$data);
                    ?>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <select name="genders_id" class="form-control select2">
                                @foreach(\App\Models\Gender::orderBy('name')->get() as $g)
                                    <option value="{{$g->id}}" @if($data==$g->id) selected @endif>{{$g->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!--==================STATUS============-->
                    <div class="col-sm-2 text-right">
                        <div class="form-group">
                            <label class="text_right_admin" id="usages">@lang('trans.usages')</label>
                        </div>
                    </div>
                    <?php

                    $array_usages=[];
                    if(isset($item)){
                        foreach(json_decode($item->usages,true) as $temp):
                            $array_usages[]=key($temp);
                        endforeach;
                    }

                    ?>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <select name="usages[]" id="usages" class="form-control select2" required multiple="multiple">
                                @foreach(\App\Models\Usage::where('id_parent','!=',0)->orderBy('name')->get() as $g)
                                    <option value="{{json_encode([$g->slug=>$g->name])}}" @if(in_array($g->slug,$array_usages)) selected @endif>{{$g->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <!-----------------------TEXT------------------->
                    <div class="col-sm-2 text-right">
                        <div class="form-group">
                            <label class="text_right_admin">@lang('trans.meaning')</label>
                        </div>
                    </div>
                    <?php
                    $data = isset( $item )? $item->$meaning: '';
                    $data = old($meaning,$data);
                    ?>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <textarea class="form-control " name="{{$meaning}}" id="meaning"  maxlength="255">{!!$data!!}</textarea>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-sm-2 text-right">
                        <div class="form-group">

                            <label class="text_right_admin">@lang('trans.image') @if(isset($size_img)) {{$size_img}} @endif</label>

                        </div>
                    </div>
                    <?php
                    $image='image';
                    $address='names';
                    $data = isset( $item )? $item->$image: '';
                    $data = old($image,$data);
                    ?>
                    <div class="col-sm-10">
                        <div class="form-group">
                            {!! Form::file($image,['accept'=>'image/*','single']) !!}
                        </div>
                    </div>
                    @if(isset($item))
                        <div class="col-sm-2 text-right">
                        </div>
                        <div class="col-sm-10">
                            <div class="image_admin">
                                @if(file_exists(public_path().'/images/'.$address.'/'.($item->id).'/'.$item->$image) && strlen($item->$image))

                                    <span class="btn btn-danger btn-xs" style="position: absolute;width: 20px" onclick="DeleteImage('{{$item->id}}','names',this)">X</span>
                                    {!! HTML::image('/images/'.$address.'/'.($item->id).'/'.$item->$image)!!}

                                @else
                                    {!! HTML::image('/img/no-image.png') !!}
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="clearfix"></div>

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
        $(function(){
            CKEDITOR.replace('meaning', {height: 200});
            select('.select2');
        })
        function select(th){
            $(th).select2({width:'100%'});
        }

        function DeleteImage(id,type,th){
            var data={
                id :id,
                type:type,
                _token : '{{csrf_token()}}',
            };
            $.ajax({
                url: '{!! URL::route('admin/products_delete_img') !!}',
                type: 'POST',
                data: data ,
                dataType: 'JSON',
                success: function (data) {
                    if(data['rs']=='true'){
                        $(th).parent().remove();
                    }
                }
            });
        }
    </script>
@stop


