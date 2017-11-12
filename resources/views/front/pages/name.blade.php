@extends('front.layouts.layout')
@section('content')
    <title>name</title>
    <meta name="Description" content="description">
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
                           href="{!!URL::to('/')!!}"><span>{!! HTML::image('name/img/logo-name.png','your-name.club') !!}</span></a>
                    </div>
                    <div class="collapse navbar-collapse contact-top" id="bs-example-navbar-collapse-1">
                        {!! Form::open( array ('route' => 'search')) !!}
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
                            @lang('lang.givenName') Ion
                        </h2>
                        <hr>
                        <div>
                            <span class="first-span">@lang('lang.gender')</span>
                            <span><a href="#">@lang('lang.masculine')</a></span>
                        </div>
                        <div>
                            <span class="first-span">@lang('lang.usage')</span>
                            <span><a href="#">@lang('lang.masculine')</a></span>
                        </div>
                        <hr>

                    </div>
                    <div class="col-md-4 col-sm-12 image-single">
                        {!! HTML::image('name/img/image-name.jpg','your-name.club',array('class' => 'img-responsive')) !!}
                    </div>

                    <div class="col-md-12 col-sm-12">
                        <h2>
                            @lang('lang.meaning')
                        </h2>
                        <hr>
                        <p>
                            Means "glory of Hera" from the name of the goddess HERA combined with Greek κλεος (kleos) "glory". This was the name of a hero in Greek and Roman mythology, the son of Zeus and the mortal woman Alcmene. After being driven insane by Hera and killing his own children, Herakles completed twelve labours in order to atone for his crime and become immortal.
                        </p>
                        <hr>
                        <h2>
                            @lang('lang.related')
                        </h2>
                        <hr>
                        <div class="related">
                            <h3>@lang('lang.equivalents')</h3>

                            <div>
                                <span class="first-span">Rusian</span>
                                <span><a href="">Hercule</a></span>
                            </div>

                            <div>
                                <span class="first-span">Rusian</span>
                                <span><a href="">Hercule</a></span>
                            </div>

                            <h3>@lang('lang.diminutives')</h3>

                            <div>
                                <span class="first-span">Rusian</span>
                                <span><a href="">Hercule</a></span>
                            </div>

                            <h3>@lang('lang.otherForms')</h3>

                            <div>
                                <span class="first-span">Rusian</span>
                                <span><a href="">Hercule</a></span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 content-right">
                    {!! HTML::image('name/img/facebook-box.png','your-name.club',array('class' => 'img-responsive')) !!}
                    {!! HTML::image('name/img/300x600-template.jpg','your-name.club',array('class' => 'img-responsive')) !!}
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