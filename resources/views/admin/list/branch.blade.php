<li @if(Request()->is('*admin/branch*'))  class="active"  @endif>
    <a href="{!! URL::route('admin/branches') !!}">
        <i class="fa fa-tasks"></i><span>@lang('trans.branches')</span>
    </a>
</li>

<?php
$branches=\App\Models\Branch::orderBy('sort','asc')->get();
?>
@foreach($branches as $branch)
<li class="treeview
@if(
Request()->is('*admin/slider/'.($branch->id).'*') ||
Request()->is('*admin/sliders/'.($branch->id).'*') ||
Request()->is('*admin/branches_catalog/'.($branch->id).'*') ||
Request()->is('*admin/branches_category/'.($branch->id).'*')||
Request()->is('*admin/branches_gallery/'.($branch->id).'*') ||
(Request()->is('*admin/brand*') && $branch->type) ||
(Request()->is('*admin/new*') && $branch->type) ||
(Request()->is('*admin/categor*') && $branch->type) ||
(Request()->is('*admin/characteristic*') && $branch->type) ||
(Request()->is('*admin/banner*') && $branch->type) ||
(Request()->is('*admin/cit*') && $branch->type) ||
(Request()->is('*admin/location*') && $branch->type) ||
(Request()->is('*admin/product*') && $branch->type)
)

        active
@endif">
    <a href="#">
        <i class="fa fa-times"></i>
        <span>{{$branch->$title_user}}</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li  @if(Request()->is('*admin/slider/'.($branch->id).'*') || Request()->is('*admin/sliders/'.($branch->id).'*'))  class="active"  @endif><a href="{{URL::route('admin/sliders',$branch->id)}}"><i class="glyphicon glyphicon-blackboard"></i><span>@lang('trans.slider')</span></a></li>
        @if($branch->type==0)
        <li
                @if(Request()->is('*admin/branches_catalog/'.($branch->id).'*') ||
                    Request()->is('*admin/branches_category/'.($branch->id).'*') ||
                    Request()->is('*admin/branches_gallery/'.($branch->id).'*')

                    )  class="active"  @endif><a href="{{URL::route('admin/branches_catalog',$branch->id)}}"><i class="fa fa-sitemap"></i><span>@lang('trans.catalog')</span></a></li>
        @else
            @include('admin.list.brands')
            @include('admin.list.banners')
            @include('admin.list.news')
            @include('admin.list.categories')
            @include('admin.list.characteristics')
            @include('admin.list.products')
            @include('admin.list.cities')
            @include('admin.list.locations')
        @endif
    </ul>
</li>
@endforeach