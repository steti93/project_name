<li @if(Request()->is('*admin/categor*'))  class="active"  @endif>
    <a href="{!! URL::route('admin/categories') !!}">
        <i class="fa fa-sitemap"></i><span>@lang('trans.catalog')</span>
    </a>
</li>
