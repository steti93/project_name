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
                        {!! Form::open( array ('route' => 'search')) !!}
                        <div id="imaginary_container">
                            <div class="input-group stylish-input-group">

                                <input type="text" name="search" class="form-control" placeholder="Search your name">
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
                <div class="row" style="text-align:center;padding-top:30px;">
                    <a id="slow-down" href="#books" class="down-arrow-btn"><i class="fa fa-chevron-down"></i></a>
                </div>
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
                    <div class="col-xs-12 col-sm-6 col-md-3 category-list">
                        <a href="#" style="color: #000;">
                            <h2 style="margin-top:0;">
                                <span>Denumire </span>
                            </h2>
                        </a>
                        <a href="#" style="color: #000;">
                            <h2 style="margin-top:0;">
                                <span>Denumire </span>
                            </h2>
                        </a>
                        <a href="#" style="color: #000;">
                            <h2 style="margin-top:0;">
                                <span>Denumire </span>
                            </h2>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 category-list">
                        <a href="#" style="color: #000;">
                            <h2 style="margin-top:0;">
                                <span>Denumire </span>
                            </h2>
                        </a>
                        <a href="#" style="color: #000;">
                            <h2 style="margin-top:0;">
                                <span>Denumire </span>
                            </h2>
                        </a>
                        <a href="#" style="color: #000;">
                            <h2 style="margin-top:0;">
                                <span>Denumire </span>
                            </h2>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 category-list">
                        <a href="#" style="color: #000;">
                            <h2 style="margin-top:0;">
                                <span>Denumire </span>
                            </h2>
                        </a>
                        <a href="#" style="color: #000;">
                            <h2 style="margin-top:0;">
                                <span>Denumire </span>
                            </h2>
                        </a>
                        <a href="#" style="color: #000;">
                            <h2 style="margin-top:0;">
                                <span>Denumire </span>
                            </h2>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 category-list">
                        <a href="#" style="color: #000;">
                            <h2 style="margin-top:0;">
                                <span>Denumire </span>
                            </h2>
                        </a>
                        <a href="#" style="color: #000;">
                            <h2 style="margin-top:0;">
                                <span>Denumire </span>
                            </h2>
                        </a>
                        <a href="#" style="color: #000;">
                            <h2 style="margin-top:0;">
                                <span>Denumire </span>
                            </h2>
                        </a>
                    </div>
                </div>

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
                                        <li><a href="#">Trindavel</a></li>
                                        <li class="unisex">@lang('lang.unisex')</li>
                                        <li><a href="#">Moldova</a></li>
                                        <li><a href="#">Romania</a></li>
                                    </ul>
                                    <p>
                                        Means "brown horse" from Gaelic each "horse" and donn "brown". It was sometimes Anglicized as Hector.
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
                                        <li>
                                            <a href="#" >Ion</a>
                                        </li>
                                        <li>
                                            <a href="#" >Marina</a>
                                        </li>
                                    </ol>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <ol>
                                        <li>
                                            <a href="#" >Ion</a>
                                        </li>
                                        <li>
                                            <a href="#" >Marina</a>
                                        </li>
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

