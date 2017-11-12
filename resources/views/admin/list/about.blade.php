<li @if(Request()->is('*admin/about*'))   class="active"  @endif>
	<a href="{!! URL::route('admin/about_us') !!}">
		<i class="fa fa-star"></i><span>@lang('trans.about')</span>
	</a>
</li>