@extends('front.layouts.layout')
@section('content')
    <title>Usage</title>
    <meta name="Description" content="">
    <meta property="og:url" content="{!!Request::url()!!}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content=""/>
    <meta property="og:description" content=""/>
    <meta property="og:image" content=""/>
    <body>
    <div class="container contact">
        <div class="row">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header contact-top">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand logo-contact"
                           href="{!!URL::to('/')!!}"><span>{!! HTML::image('front_name/img/logo-name.png','your-name.club') !!}</span></a>
                    </div>
                    <div class="collapse navbar-collapse contact-top" id="bs-example-navbar-collapse-1">
                        {!! Form::open( array ('id' => 'search_form')) !!}
                        <div class="input-group col-xs-3 col-md-5 pull-left search-contact">
                            <input type="text" name="search" class="search-query form-control" placeholder="Search"/>
                            <span class="input-group-btn">
                                    <button class="btn" type="submit">
                                        <span class=" glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                        </div>
                        {!! Form::close() !!}
                        <ul class="nav navbar-nav navbar-right feed-contact">
                            <li><a href="#">@lang('lang.topNames')</a></li>
                            <li><a href="{!! URL::to('contact')!!}">@lang('lang.feedback')</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container no-margin-top">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="filters">
                        <p>@lang('lang.filters')</p>
                            <ul class="list-inline">
                                <li>
                                    <?php
                                    $get_gender=isset($_GET['gender'])? $_GET['gender'] :'';
                                    ?>
                                    <select name="gender" class="filter_names">
                                        <option value="">@lang('lang.anyGender')</option>
                                        @foreach($genders as $temp)
                                            <option value="{{strtolower($temp)}}" @if($get_gender==strtolower($temp)) selected @endif>{{$temp}}</option>
                                        @endforeach
                                    </select>
                                </li>
                                <li>
                                    <?php
                                    $get_usage=isset($_GET['usage'])? $_GET['usage'] :'';
                                    ?>
                                    <select name="usages" class="filter_names">
                                        <option value="">@lang('lang.anyUsage')</option>
                                        @foreach($usages as $temp)
                                            <option value="{{$temp->slug}}" @if($get_usage==$temp->slug) selected @endif>@if(array_key_exists ($temp->id,$usages_all)) {{$usages_all[$temp->id]}} @else {{$temp->name}}@endif</option>
                                        @endforeach
                                    </select>
                                </li>
                            </ul>
                    </div>
                    <hr>
                    <div class="list-names">
                        @foreach($items as $item)
                            <div class="name">
                            <ul class="list-inline">
                                <li><a href="{{URL::route('name',$item->slug)}}">{{$item->name}}</a></li>
                                <?php
                                    $class='';
                                    if($item->genders_id==1){
                                        $class='masculine';
                                    }else if($item->genders_id==2){
                                        $class='femenine';
                                    }else{
                                        $class='unisex';
                                    }
                                ?>
                                @if(isset($genders[$item->genders_id])) <li class="{{$class}}">{{$genders[$item->genders_id]}}</li>@endif
                                @if(json_decode($item->usages))
                                    @foreach(json_decode($item->usages,true) as $usage)

                                    <li><a href="{{key($usage)}}">@if($loop->index),@endif {{$usage[key($usage)]}}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                            <p>
                                {!! str_limit(strip_tags($item->meaning),300,' ...') !!}
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {!! $items->links('../../vendor/pagination/bootstrap-4')  !!}
        </div>

        <div class="row footer">
            <div class="navbar navbar-default navbar-relative-bottom footer">
                <div class="container" style="margin-top: 0px;">
                    <a href="#" target="_blank" class="navbar-btn btn pull-left">© {!!date('Y')!!} -
                        your-name.club
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $(function(){
            $('.filter_names').change(function(){
               var url='{{Request::url()}}';
               var genders=$('select[name=gender] option:selected').val();
               var usages=$('select[name=usages] option:selected').val();
               if(genders.length>0){
                   url+='?gender='+genders;
                   if(usages.length>0){
                       url+='&usage='+usages;
                   }
               }else{
                   if(usages.length>0){
                       url+='?usage='+usages;
                   }
               }
                window.location.href = url;
            });
        });
    </script>
@stop