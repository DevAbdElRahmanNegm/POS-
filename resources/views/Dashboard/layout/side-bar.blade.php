<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>



    <li>
        <a href="{{route('dashboard.index')}}">
            <i class="fa fa-th"></i> <span>@lang('site.dashboard')</span>
            <span class="pull-right-container">
            </span>
        </a>
    </li>

@if(auth()->user()->hasPermission('categories_read'))
    <li>
        <a href="{{route('dashboard.categories.index')}}">
            <i class="fa fa-th"></i> <span>@lang('site.categories')</span>
            <span class="pull-right-container">
            </span>
        </a>
    </li>
@endif

    @if(auth()->user()->hasPermission('products_read'))
        <li>
            <a href="{{route('dashboard.products.index')}}">
                <i class="fa fa-th"></i> <span>@lang('site.products')</span>
                <span class="pull-right-container">
            </span>
            </a>
        </li>
    @endif

    @if(auth()->user()->hasPermission('orders_read'))
        <li>
            <a href="{{route('dashboard.orders.index')}}">
                <i class="fa fa-th"></i> <span>@lang('site.orders')</span>
                <span class="pull-right-container">
            </span>
            </a>
        </li>
    @endif


    @if(auth()->user()->hasPermission('clients_read'))
        <li>
            <a href="{{route('dashboard.clients.index')}}">
                <i class="fa fa-th"></i> <span>@lang('site.clients')</span>
                <span class="pull-right-container">
            </span>
            </a>
        </li>
    @endif



@if(auth()->user()->hasPermission('users_read'))
        <li>
            <a href="{{route('dashboard.users.index')}}">
                <i class="fa fa-th"></i> <span>@lang('site.users')</span>
                <span class="pull-right-container">
            </span>
            </a>
        </li>
@endif