@extends('dashboard.layout.app')
@section('content')


    <section class="content-header">
        <h1>
            @lang('site.clients')
        </h1>
    </section>



    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('site.add')</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->

        <div class="row">


            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">@lang('site.show_orders')</h3>

                    </div>

                    <div class="box-body table-product">

                        <table class="table table-bordered " >


                        </table>
                    </div>
                </div>
            </div>








            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">@lang('site.orders')</h3>
                        <form action="{{route('dashboard.orders.index')}}" method="get">
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" name="search" value="{{request()->search}}" class="form-control" placeholder="@lang('site.search')">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary"><li class="fa fa-search"></li>@lang('site.search')</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="box-body">
                        @if($orders->count() > 0)
                        <table class="table table-bordered">

                            <thead >
                            <tr >
                                <th style="text-align: inherit !important;">#</th>
                                <th style="text-align: inherit !important;">@lang('site.clients')</th>
                                <th style="text-align: inherit !important;">@lang('site.price')</th>
                                <th style="text-align: inherit !important;">@lang('site.created_at')</th>
                                <th style="text-align: inherit !important;">@lang('site.show_order')</th>
                                <th style="text-align: inherit !important;">@lang('site.edit')</th>
                                <th style="text-align: inherit !important;">@lang('site.delete')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $index=>$order)
                                <tr>
                                    <td style="text-align: inherit !important;">{{$index + 1}}</td>
                                    <td style="text-align: inherit !important;">{{$order->client->name}}</td>

                                    <td style="text-align: inherit !important;">{{$order->total_price}}</td>
                                        <td style="text-align: inherit !important;">{{$order->created_at->format('Y-m-d')}}</td>

                                    <td style="text-align: inherit !important;">
                                        <button class="btn btn-primary order-products" data-url="{{route('dashboard.orders.products' , $order->id)}}">
                                            @lang('site.show_order')</button></td>


                                @if(auth()->user()->hasPermission('orders_update'))
                                        <td style="text-align: inherit !important;">
                                            <a href="{{route('dashboard.orders.edit',$order->id)}}"
                                               class="btn btn-info">@lang('site.edit')</a></td>
                                    @else

                                        <td> <button class="btn btn-primary disabled">@lang('site.edit')</button> </td>

                                    @endif

                                    @if(auth()->user()->hasPermission('orders_delete'))
                                        <td style="text-align: inherit !important;"><form action="{{route('dashboard.orders.destroy',$order->id)}}"  method="post">
                                                @csrf
                                                {{method_field('delete')}}

                                                <button type="submit"   class="btn btn-danger">
                                                    <i class="material-icons">@lang('site.delete')</i>
                                                </button>
                                            </form></td>
                                    @else
                                        <td>  <button class="btn btn-danger disabled">@lang('site.delete')</button></td>

                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                            <h2>@lang('site.no-data-found')</h2>
                        @endif
                    </div>
                </div>

            </div>

        </div>


@endsection
