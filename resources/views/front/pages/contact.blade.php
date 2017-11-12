@extends('front.layouts.layout')
@section('content')
        <title>title</title>
    <meta name="Description" content="Description">
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
                        <a class="navbar-brand logo-contact" href="{!! URL::to('/')!!}"><span>{!! HTML::image('front_name/img/name-logo.png','your-name.club',['style' => 'width:50px;height:50px']) !!}
	  </span></a>
                    </div>
                    <div class="collapse navbar-collapse contact-top" id="bs-example-navbar-collapse-1">
                        {!! Form::open( array ('route' => 'search')) !!}
                        <div class="input-group col-xs-5 col-md-8 pull-left search-contact">
                            <input type="text" name="search" class="search-query form-control" placeholder="Search"/>
                            <span class="input-group-btn">
                                    <button class="btn" type="submit">
                                        <span class=" glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </nav>
        </div>
        <div class="container category-div contact-mob" style="min-height: 321px;">
            <h1 class="contact-title">De ce cărți aveți nevoie?</h1>
            <div class="row">
                @if($errors->has())
                    @foreach ($errors->all() as $error)
                        <div>{!! $error !!}</div>
                    @endforeach
                @endif
                {!! Form::open(['url' => URL::to('contact'),'method' => 'POST'])!!}
                <div class="col-xs-6 col-md-6 responsive-contact">

                    <label class="name-feed">Nume: </label><input class="input-contact" type="text" name="nume"
                                                                  value="{!! Input::old('nume')!!}" placeholder="nume">
                    <hr>
                    <label class="name-feed">Prenume: </label><input class="input-contact" type="text" name="prenume"
                                                                     value="{!! Input::old('prenume')!!}"
                                                                     placeholder="prenume">
                    <hr>
                    <label class="name-feed">Email: </label><input class="input-contact" type="email" name="email"
                                                                   value="{!! Input::old('email')!!}"
                                                                   placeholder="1001freebook@gmail.com">
                    <hr>
                </div>
                <div class="col-xs-6 col-md-6 category-list responsive-contact">
                    <label>Comentariu:</label>
                    <textarea rows="6" cols="50" class="contact-comentariu" placeholder="De ce carti aveti nevoie?"
                              name="text">{!! Input::old('text')!!}</textarea>
                    <hr>
                </div>
                <center><input id="submit" name="submit" type="submit" value="Trimite" class="btn btn-danger send-feed">
                </center>
                {!! Form::close()!!}
            </div>
        </div>
        <div class="row footer">
            <div class="navbar navbar-default navbar-relative-bottom footer">
                <div class="container" style="margin-top: 0px; ">
                    <a href="#" target="_blank" class="navbar-btn btn pull-left">©{!!date('Y')!!} - your-name.club</a>
                </div>
            </div>
        </div>
    </div>
@stop