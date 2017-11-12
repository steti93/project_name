<li @if(Request()->is('*admin/cit*'))  class="active"  @endif>
    <a href="{!! URL::route('admin/cities') !!}">
        <i class="glyphicon glyphicon-globe"></i><span>@lang('trans.city')</span>
    </a>
</li>
