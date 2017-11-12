@extends('admin.adminLayout')
@section('title')
    @lang('trans.translation')
@stop
@section('style')
<style>
    #products_filter{
        text-align: right;
    }
</style>
@stop

@section('content')
    {!! Form::open() !!}

    <div class="box-header with-border">
                    <h3 class="box-title">@lang('trans.translation')</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>@lang('trans.search')</label>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <input id="search" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <?php $increment = 0;?>
                                @foreach( $lang_data as $key=>$item )
                                    <li class="@if( $increment == 0 ) active @endif ">
                                        <a href="#tab_{!! $key !!}" data-toggle="tab"
                                           aria-expanded="false">{!! $key !!}</a>
                                    </li>
                                    <?php $increment++;?>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                <?php
                                    $increment = 0;
                                    $resources = resource_path();
                                    $trans='l.php';
                                ?>
                                @foreach( $lang_data as $key=>$item )
                                    <div class="tab-pane @if( $increment == 0 ) active @endif" id="tab_{!! $key !!}">

                                        <?php
                                        $arrays = [];
                                        if (file_exists( $resources . '/lang/' . $key . '/'.$trans)) {
                                            $arrays = include($resources . '/lang/' . $key . '/'.$trans);

                                        }
                                        ?>
                                        @if( $arrays )
                                                <table class="table table-bordered products" id="table_{{$key}}">
                                                <thead>
                                                <tr>
                                                    <th>Key</th>
                                                    <th>Value</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach( $arrays as $key2=>$value)
                                                    <tr>
                                                        <th>
                                                            {!! $key2 !!}
                                                        </th>
                                                        <td width="80%">
                                                            <p style="display: none">{!!nl2br(e($value))!!}</p>
                                                            <input type="text"  name="{!! $key.'_'.$key2 !!}" class="form-control" style="width: 100%"  value="{!!nl2br(e($value))!!}" required>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                                </table>

                                            @endif

                                    </div>
                                    <?php $increment++;?>
                                    @endforeach
                                            <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- nav-tabs-custom -->
                    </div>
                </div>
                <!-- /.box-body -->

                <!-- /.box-footer-->
                <div class="clearfix"></div>
                <button type="submit"  class="btn btn-app" >
                    <i class="fa fa-save"></i> @lang('trans.save')
                </button>
                {!! Form::close() !!}

@stop

@section('script')

    <script>
        $(function(){
            var $rows = $('.table tr');
            $('#search').keyup(function() {
                var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

                $rows.show().filter(function() {
                    var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                    return !~text.indexOf(val);
                }).hide();
            });
        })

    </script>
@stop
