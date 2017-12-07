@extends('front.layouts.layout')
@section('content')
    <title>meta.title</title>

    <meta name="Description"
          content="meta.description">
    <meta property="og:url" content="{!!Request::url()!!}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="meta.title"/>
    <meta property="og:description"
          content="meta.description"/>
    <meta property="og:image" content="#"/>

    </head>
    <body>
    <div class="container book">
        <div class="row header-home">
            <nav class="navbar navbar-default top-menu1">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed  top-list1" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand " href="{!!URL::to('/')!!}"><span class="logo">
{{ HTML::image('front_name/img/logo-name.png', 'no-image-gender', array('class' => 'img-responsive logo-image')) }}
		</span></a>
                    </div>

                    <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" aria-expanded="false">
                        <ul class="nav navbar-nav navbar-right top-list1">
                            <li><a href="#">@lang('lang.topNames')</a></li>
                            <li><a href="{!! URL::to('contact')!!}">@lang('lang.feedback')</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="start-text">
                @lang('lang.startText')
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        {!! Form::open(['id'=>'search_form']) !!}
                        <div id="imaginary_container">
                            <div class="input-group stylish-input-group">
                                <input type="text" name="search" minlength="1" required class="form-control" placeholder="Search your name">
                                <span class="input-group-addon">
                        <button type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>  
                    </span>

                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>
                {{--<div class="row" style="text-align:center;padding-top:30px;">--}}
                    {{--<a id="slow-down" href="#books" class="down-arrow-btn"><i class="fa fa-chevron-down"></i></a>--}}
                {{--</div>--}}
            </div>

        </div>
        <div class="container category-div">
            <div class="row">
                <div class="col-md-12 text-center">
                    <ul class="list-inline">
                        @foreach(range('A','Z') as $letter)
                            <li class="alfabet-search"><a href="{!!URL::to('/letter',$letter)!!}">{!! $letter !!}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-4">
                    <a class="name-gender">
                        {{ HTML::image('front_name/img/masculine.png', 'masculine', array('class' => 'img-responsive gender-image')) }}
                        <p>@lang('lang.masculine')</p>
                    </a>
                </div>
                <div class="col-md-4">
                    <a class="name-gender">
                        {{ HTML::image('front_name/img/feminine.png', 'masculine', array('class' => 'img-responsive gender-image')) }}
                        <p>@lang('lang.feminine')</p>
                    </a>
                </div>
                <div class="col-md-4">
                    <a class="name-gender">
                        {{ HTML::image('front_name/img/unisex.png', 'masculine', array('class' => 'img-responsive gender-image')) }}
                        <p>@lang('lang.unisex')</p>
                    </a>
                </div>
                <div class="row category-home">
                    @foreach($usages->chunk(3) as $chunk)
                    <div class="col-xs-12 col-sm-6 col-md-3 category-list">
                        @foreach($chunk as $item)
                        <a href="{{URL::route('usages').'?usages='.$item->slug}}" style="color: #000;">
                            <h2 style="margin-top:0;">
                                @if($item->id==9)
                                    <span>African</span>
                                @elseif($item->id==151)
                                    <span>Biblical</span>
                                @elseif($item->id==117)
                                    <span>Mythology</span>
                                @else
                                <span>{{$item->name}}</span>
                                @endif
                            </h2>
                        </a>
                         @if($loop->last && $loop->parent->last )
                                    <a href="{{URL::route('categories')}}" style="color: #000;">
                                        <h2 style="margin-top:0;">
                                            <span>All</span>
                                        </h2>
                                    </a>
                         @endif
                        @endforeach
                    </div>
                    @endforeach


            </div>
        </div>
        <div class="row content-book">
            <div class="container">
                <div class="row content">
                    <div class="content-home">
                        <div class="col-md-6 col-sm-12">
                            <div class="block-header">
                        <span>
                            @lang('lang.nameOfTheDay')
                        </span>
                            </div>
                            <div class="block-content">
                                <div class="name">
                                    <ul class="list-inline">
                                        <li><a href="{{URL::route('name',$top_name->slug)}}">{{$top_name->name}}</a></li>
                                        <?php
                                        $class='';
                                        if($top_name->genders_id==1){
                                            $class='masculine';
                                        }else if($top_name->genders_id==2){
                                            $class='femenine';
                                        }else{
                                            $class='unisex';
                                        }
                                        ?>
                                        @if(isset($genders[$top_name->genders_id])) <li class="{{$class}}">{{$genders[$top_name->genders_id]}}</li>@endif
                                        @if(json_decode($top_name->usages))
                                            @foreach(json_decode($top_name->usages,true) as $usage)
                                                <li><a href="{{key($usage)}}">@if($loop->index),@endif {{$usage[key($usage)]}}</a></li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <p>
                                        {!! str_limit(strip_tags($top_name->meaning),100,' ...') !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="block-header">
                        <span>
                            @lang('lang.popularNames')
                        </span>
                            </div>
                            <div class="block-content">
                                <div class="col-md-6 col-sm-12">
                                    <ol>
                                        @foreach($name_masculine as $item)
                                        <li>
                                            <a href="{{URL::Route('name',$item->slug)}}" >{{$item->name}}</a>
                                        </li>
                                        @endforeach

                                    </ol>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <ol>
                                        @foreach($name_femenine as $item)
                                            <li>
                                                <a href="{{URL::Route('name',$item->slug)}}" >{{$item->name}}</a>
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-default navbar-relative-bottom footer">
        <div class="container" style="margin-top: 0px;">
            <a href="#" target="_blank" class="navbar-btn btn pull-left">© {!!date('Y')!!} -
                cartipdf.net
            </a>
        </div>
    </div>
@stop



