@extends('admin.adminLayout')
@section('title')
    {{ trans('trans.email') }}
@stop
@section('content')

    <h1 class="page-header">
        {{ trans('trans.email') }}
    </h1>
    <div class="col-xs-12 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">{{ trans('trans.email') }}</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ URL::route('admin/edit_mail') }}">
                    {!! csrf_field() !!}
                    <div id="errors">

                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Driver</label>
                        <?php
                        $data = isset( $mail )? $mail->driver: '';
                        $data = old('driver',$data);
                        ?>
                        <div class="col-md-6">
                            <input type="text" name="driver" minlength="2" maxlength="10" class="form-control" value="{{ $data }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Host</label>
                        <?php
                        $data = isset( $mail )? $mail->host: '';
                        $data = old('host',$data);
                        ?>
                        <div class="col-md-6">
                            <input type="text" name="host" minlength="5" maxlength="30" class="form-control" value="{{ $data }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Port</label>
                        <?php
                        $data = isset( $mail )? $mail->port: '';
                        $data = old('port',$data);
                        ?>
                        <div class="col-md-6">
                            <input type="number" name="port" min="1" max="9999" class="form-control" value="{{ $data }}" required>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-md-4 control-label">From name </label>
                        <?php
                        $data = isset( $mail )? $mail->from_name: '';
                        $data = old('from_name',$data);
                        ?>
                        <div class="col-md-6">
                            <input type="text" name="from_name" minlength="3" maxlength="50" class="form-control" value="{{ $data }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Encryption</label>
                        <?php
                        $data = isset( $mail )? $mail->encryption: '';
                        $data = old('encryption',$data);
                        ?>
                        <div class="col-md-6">
                            <input type="text" name="encryption" minlength="2" maxlength="10" class="form-control" value="{{ $data }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Username</label>
                        <?php
                        $data = isset( $mail )? $mail->username: '';
                        $data = old('username',$data);
                        ?>
                        <div class="col-md-6">
                            <input type="email" name="username"  class="form-control" value="{{ $data }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Password</label>
                        <?php
                        $data = isset( $mail )? $mail->password: '';
                        $data = old('password',$data);
                        ?>
                        <div class="col-md-6">
                            <input type="text" name="password" minlength="5" maxlength="50" class="form-control" value="{{ $data }}" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-3 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">{{ trans('trans.save') }}</button>
                        </div>
                        <div class="col-md-3">
                            <button type="button" onclick="Ajax()" class="btn btn-primary">{{ trans('trans.test') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@stop

@section('script')
    <script>
        function Ajax(){
            var data={
                driver : $('input[name=driver]').val(),
                host   : $('input[name=host]').val(),
                port   : $('input[name=port]').val(),
                from_name : $('input[name=from_name]').val(),
                encryption : $('input[name=encryption]').val(),
                username : $('input[name=username]').val(),
                password : $('input[name=password]').val(),
                _token  :'{{csrf_token()}}',
            };
            $('#loading_img').show();
            $.ajax({
                url: '{!! URL::route('admin/validate_mail') !!}',
                type: 'POST',
                data: data,
                dataType: 'JSON',
                success: function (data) {
                    $('#errors').html(data['message']);
                    $('#loading_img').hide();
                },
                errors:function() {
                    $('#loading_img').hide();

                }

            })
        }
    </script>
@stop