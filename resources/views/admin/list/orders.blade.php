<li @if(Request()->is('*admin/order*'))  class="active"  @endif>
    <?php
    $or_nr=\App\Models\BuyCart::where('status',0)->count();
    ?>
    <a href="{!! URL::route('admin/orders') !!}">
        <i class="glyphicon glyphicon-shopping-cart"></i><span>@lang('trans.orders')</span>@if($or_nr)<small class="label pull-right bg-green"> {{$or_nr}} </small>@endif
    </a>
</li>