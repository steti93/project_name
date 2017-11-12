<li @if(Request()->is('*admin/banner*'))  class="active"  @endif>
    <a href="{!! URL::route('admin/banners') !!}">
        <i class="fa fa-picture-o"></i><span>@lang('trans.banners')</span>
    </a>
</li>
