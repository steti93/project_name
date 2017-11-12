<li @if(Request()->is('*admin/new*'))  class="active"  @endif>
    <a href="{!! URL::route('admin/news') !!}">

        <i class="glyphicon glyphicon-th"></i><span>@lang('trans.news')</span>

    </a>
</li>
