<!-----------------------TEXT------------------->
<div class="col-sm-2 text-right">
    <div class="form-group">
        <label class="text_right_admin">@lang('trans.'.$name)</label>
    </div>
</div>
<?php
$data = isset( $item )? $item->$value: '';
$data = old($value,$data);
?>
<div class="col-sm-10">
    <div class="form-group">
        <input type="text" class="form-control " name="{{$value}}"  value="{{$data}}" @if(isset($max_length)) maxlength="{{$max_length}}" @else maxlength="255" @endif @if(isset($required)) required @endif>
    </div>
</div>
<div class="clearfix"></div>