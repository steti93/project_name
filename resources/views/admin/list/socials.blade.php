<li @if(Request()->is('*admin/social*'))   class="active"  @endif>
    <a href="{!! URL::route('admin/socials') !!}">
        <i class="fa fa-facebook"></i><span>@lang('trans.socials')</span>
    </a>
</li>