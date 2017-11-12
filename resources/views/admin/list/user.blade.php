@if(Auth::guard('admin')->user()->type)
    <li @if(Request::url()==URL::route('admin/user_admin'))  class="active" @endif>
        <a href="{!! URL::route('admin/user_admin') !!}">
            <i class="fa  fa-terminal on fa-square"></i><span>@lang('trans.admin')</span>
        </a>
    </li>
@endif
