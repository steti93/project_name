<li @if(Request()->is('*admin/contact*'))  class="active" @endif>
    <a href="{!! URL::route('admin/contacts') !!}">
        <i class="fa  fa-map-o"></i><span>@lang('trans.contacts')</span>
    </a>
</li>