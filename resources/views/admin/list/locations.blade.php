<li @if(Request()->is('*admin/location*'))  class="active"  @endif>
    <a href="{!! URL::route('admin/locations') !!}">
        <i class="fa fa-map-signs"></i><span>@lang('trans.locations')</span>
    </a>
</li>
