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
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="title-single">
                        <h2>@lang('lang.namesTitle')</h2>
                    </div>
                    <hr>
                    <div class="letters">
                        <ul class="list-inline">
                            @foreach(range('A','Z') as $letter)
                                <li class="alfabet-search"><a href="{!!URL::to('/letter',$letter)!!}">{!! $letter !!}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="filters">
                        <p>@lang('lang.filters')</p>
                        <ul class="list-inline">
                            <li>
                                <select>
                                    <option>@lang('lang.anyGender')</option>
                                </select>
                            </li>
                            <li>
                                <select>
                                    <option>@lang('lang.anyUsage')</option>
                                </select>
                            </li>
                        </ul>
                    </div>
                    <hr>
                    <div class="list-names">
                        <div class="name">
                            <ul class="list-inline">
                                <li><a href="#">Ion</a></li>
                                <li class="masculine">@lang('lang.masculine')</li>
                                <li><a href="#">Moldova</a></li>
                            </ul>
                            <p>
                                Meaning unknown, perhaps from Sumerian meaning "house of water". This was the Akkadian and Babylonian name of the Sumerian water god Enki.
                            </p>
                        </div>
                        <div class="name">
                            <ul class="list-inline">
                                <li><a href="#">Madalena</a></li>
                                <li class="feminine">@lang('lang.feminine')</li>
                                <li><a href="#">Moldova</a></li>
                                <li><a href="#">Romania</a></li>
                            </ul>
                            <p>
                                Means "brown horse" from Gaelic each "horse" and donn "brown". It was sometimes Anglicized as Hector.
                            </p>
                        </div>

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
                        </div>                        <div class="name">
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