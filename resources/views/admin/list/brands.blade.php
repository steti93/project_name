<li @if(Request()->is('*admin/brand*'))  class="active"  @endif>
    <a href="{!! URL::route('admin/brands') !!}">
        <i class="glyphicon glyphicon-bold"></i><span>@lang('trans.brands')</span>
    </a>
</li>
