@extends('front.layouts.layout')
@section('content')
    <title>{{$item->name}}</title>
    <meta name="Description" content="description">
    <meta property="og:url" content="{!!Request::url()!!}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content=""/>
    <meta property="og:description" content=""/>
    <meta property="og:image" content=""/>
    </head>
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
            <div class="row single-content">
                <div class="col-xs-12 col-sm-12 col-md-9 single-name">
                    <div class="col-md-8 col-sm-12">
                        <h2>
                            @lang('lang.givenName') {{$item->name}}
                        </h2>
                        <hr>
                        <div>
                            <span class="first-span">@lang('lang.gender')</span>
                            @if(array_key_exists($item->genders_id,$genders))
                            <span><a href="{{URL::route('usages').'?gender='.strtolower($genders[$item->genders_id])}}">{{$genders[$item->genders_id]}}</a></span>
                            @endif
                        </div>
                        <div>
                            <span class="first-span">@lang('lang.usage')</span>
                            @if(json_decode($item->usages))
                                @foreach(json_decode($item->usages,true) as $usage)
                                    <span><a href="{{URL::route('usages').'?usage='.key($usage)}}">@if($loop->index),@endif {{$usage[key($usage)]}}</a></span>
                                @endforeach
                            @endif
                        </div>
                        <hr>

                    </div>
                    <div class="col-md-4 col-sm-12 image-single">
                        <img src="{!! \App\Http\Controllers\Admin\NamesController::GetImage($item) !!}" class="img-responsive">

                    </div>

                    <div class="col-md-12 col-sm-12">
                        <h2>
                            @lang('lang.meaning')
                        </h2>
                        <hr>
                        <p>
                            {!! $item->meaning !!}
                       </p>
                        <hr>
                        <h2>
                            @lang('lang.related')
                        </h2>
                        <hr>
                        <div class="related">
                            <?php $related=json_decode($item->related); ?>
                            @if($related)
                                @foreach($related as $cat=>$value)
                                    <h3>{{$cat}}</h3>
                                    @foreach($value as $name=>$array)
                                        <div>
                                            <span class="first-span">{{$name}} :</span>
                                            @foreach($array as $names)
                                                <?php
                                                $key=key($names);
                                                ?>
                                                <span><a href="{{URL::Route('name',$key)}}">{{$names->$key}}@if(!$loop->last) , @endif</a></span>
                                            @endforeach
                                        </div>
                                    @endforeach
                                @endforeach
                            @endif
                        </div>

                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 content-right">
                    {!! HTML::image('front_name/img/facebook-box.png','your-name.club',array('class' => 'img-responsive')) !!}
                    {!! HTML::image('front_name/img/300x600-template.jpg','your-name.club',array('class' => 'img-responsive')) !!}
                </div>
            </div>
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