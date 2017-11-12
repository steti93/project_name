<li @if(Request()->is('*admin/setting*'))  class="active" @endif>
    <a href="{!! URL::route('admin/settings') !!}">
        <i class="fa   fa-gear"></i><span>@lang('trans.settings')</span>
    </a>
</li>