@extends('front.layouts.layout')
@section('content')
    <title>Find names</title>
    <meta name="Description" content="">
    <meta property="og:url" content="{!!Request::url()!!}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content=""/>
    <meta property="og:description" content=""/>
    <meta property="og:image" content=""/>
    </head>
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
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="title-single">
                        <h2>@lang('lang.findYourName')</h2>
                    </div>
                    <hr>
                    <h3>@lang('lang.byLetter')</h3>
                    <div class="letters">
                        <ul class="list-inline">
                            @foreach(range('A','Z') as $letter)
                                <li class="alfabet-search"><a
                                            href="{!!URL::to('/letter',$letter)!!}">{!! $letter !!}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <h3>@lang('lang.byGender')</h3>
                    <div class="by-gender">
                        <ul class="list-inline">
                            <li>
                                <a href="{{URL::Route('usages').'?gender=masculine'}}">
                                    {{ HTML::image('front_name/img/masculine.png', 'masculine', array('class' => 'img-responsive gender-image')) }}
                                    <span class="masculine">@lang('lang.masculine')</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{URL::Route('usages').'?gender=femenine'}}">
                                {{ HTML::image('front_name/img/feminine.png', 'feminine', array('class' => 'img-responsive gender-image')) }}
                                    <span class="feminine">@lang('lang.feminine')</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{URL::Route('usages').'?gender=unisex'}}">
                                {{ HTML::image('front_name/img/unisex.png', 'unisex', array('class' => 'img-responsive gender-image')) }}
                                    <span class="unisex">@lang('lang.unisex')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <hr>
                    <h3>@lang('lang.byUsage')</h3>
                    <div class="container">
                        <div class="row-categories">
                            @foreach($usages as $usage)
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="well">
                                    <div class="block-header">
                            <span>
                               {{$usage->name}}
                            </span>
                                    </div>
                                    <div class="categories-content">
                                        @foreach($usage['niv2'] as $niv2)
                                        <h2><a href="{{URL::route('usages').'?usage='.$niv2->slug}}">{{$niv2->name}}</a></h2>
                                            @foreach($niv2['niv3'] as $niv3)
                                                    <h3><a href="{{URL::route('usages').'?usage='.$niv3->slug}}">{{$niv3->name}}</a></h3>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
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
@section("script")
    <script>
        $('.row-categories').masonry({
            itemSelector : '.col-md-4'
        });
    </script>
@stop