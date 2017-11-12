<li @if(Request()->is('*admin/filtre*'))  class="active"  @endif>
    <a href="{{URL::route('admin/filtres')}}">
        <i class="glyphicon glyphicon-filter"></i><span>@lang('trans.filtres')</span>
    </a>
</li>