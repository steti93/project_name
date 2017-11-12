<li @if(Request()->is('*admin/page*'))  class="active" @endif>
    <a href="{!! URL::route('admin/pages') !!}">
        <i class="fa   fa-file-powerpoint-o"></i><span>@lang('trans.pages')</span>
    </a>
</li>
