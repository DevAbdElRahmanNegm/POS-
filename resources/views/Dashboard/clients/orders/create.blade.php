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


            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">@lang('site.orders')</h3>

                    </div>

                    <div class="box-body">
                        @if($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>

                                @foreach($errors->all() as $error)
                                    {{ $error }}<br/>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{route('dashboard.clients.orders.store' , $client->id)}}" method="post">
                            @csrf
                            {{method_field('post')}}
                        <table class="table table-bordered">

                            <thead >
                            <tr>
                                <th style="text-align: inherit !important;">@lang('site.product')</th>
                                <th style="text-align: inherit !important;">@lang('site.quantity')</th>
                                <th style="text-align: inherit !important;">@lang('site.price')</th>
                                <th style="text-align: inherit !important;">@lang('site.delete')</th>

                            </tr>
                            </thead>
                            <tbody class="order-list">


                            </tbody>
                        </table>
                        <h4>@lang('site.total'):<span class="total-price"> 0</span></h4>
                            <button style="width: -webkit-fill-available;" class="btn btn-primary btn-block disabled" id="add-order-form-btn">@lang('site.add')</button>
                        </form>
                    </div>
            </div>
        </div>








            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">@lang('site.categories')</h3>

                    </div>

                    <div class="box-body">

                        @foreach($categories as $category)
                            <div class="panel-group">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">

                                            <a data-toggle="collapse"
                                               href="#{{str_replace(' ' , '-',$category->name)}}">{{$category->name}}</a>

                                        </h4>
                                    </div>
                                    <div id="{{str_replace(' ' , '-',$category->name)}}" class="panel-collapse collapse">
                                        <div class="panel-body">

                                            @if($category->products->count() > 0)
                                                <table class="table table-hover">
                                                    <tr>
                                                        <th style="text-align: inherit !important;">@lang('site.name')</th>
                                                        <th style="text-align: inherit !important;">@lang('site.stock')</th>
                                                        <th style="text-align: inherit !important;"> @lang('site.price')</th>
                                                        <th style="text-align: inherit !important;">@lang('site.add')</th>

                                                    </tr>
                                                    @foreach($category->products as $product)
                                                        <tr>
                                                            <td style="text-align: inherit !important;">{{$product->name}}</td>
                                                            <td style="text-align: inherit !important;">{{$product->stock}}</td>
                                                            <td style="text-align: inherit !important;">{{$product->sale_price}}</td>
                                                            <td style="text-align: inherit !important;"><a class="btn btn-success btn-sm add-product-btn"
                                                                                                           id="product-{{$product->id}}"
                                                                                                           data-name="{{$product->name}}"
                                                                                                           data-id="{{$product->id}}"
                                                                                                           data-price ={{$product->sale_price}}>

                                                                    <li class="fa fa-plus"></li>
                                                                </a>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </table>

                                            @else
                                                <h5>@lang('site.no-data-found')</h5>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>

                        @endforeach


                    </div>
                </div>

            </div>

    </div>


@endsection
