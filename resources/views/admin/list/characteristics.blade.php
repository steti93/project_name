<li @if(Request()->is('*admin/characteristic*'))  class="active"  @endif>
    <a href="{!! URL::route('admin/characteristics') !!}">
        <i class="glyphicon glyphicon-cog"></i><span>@lang('trans.characteristics')</span>
    </a>
</li>
