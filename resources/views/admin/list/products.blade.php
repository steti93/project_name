<li @if(Request()->is('*admin/product*'))  class="active"  @endif>
    <a href="{!! URL::route('admin/products') !!}">

        <i class="fa fa-database"></i><span>@lang('trans.products')</span>

    </a>
</li>
