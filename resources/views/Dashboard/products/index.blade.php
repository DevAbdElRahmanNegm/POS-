@extends('dashboard.layout.app')
@section('content')


    <section class="content-header">
        <h1>
            @lang('site.products')
        </h1>
    </section>



    <div class="box box-primary">
        <div class="box-header with-border">

            <form action="{{route('dashboard.products.index')}}" method="get" >
                <div class="row" >
                    <div class="col-md-4" >
                        <input  type="text" name="search" value="{{request()->search}}" class="form-control" placeholder="@lang('site.search')">

                    </div>
                    <div class="col-md-4" >
                        <select name="category_id"  class="form-control">
                            <option value="">...</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{request()->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary"><li class="fa fa-search"></li>@lang('site.search')</button>
                        @if(auth()->user()->hasPermission('products_create'))

                        <a href="{{route('dashboard.products.create')}}" class="btn btn-primary"><li class="fa fa-plus"></li>@lang('site.add')</a>

                        @else
                            <a href="#" class="btn btn-primary disabled"><li class="fa fa-plus"></li>@lang('site.add')</a>

                        @endif
                    </div>
                </div>
            </form>
            {{--<h3 class="box-title">@lang('site.products')</h3>--}}
        </div>


        <div class="box-body">
            @if($products->count() > 0)
            <table class="table table-bordered">

                <thead >
                <tr >
                    <th style="text-align: inherit !important;">#</th>
                    <th style="text-align: inherit !important;">@lang('site.name')</th>
                    <th style="text-align: inherit !important;">@lang('site.description')</th>
                    <th style="text-align: inherit !important;">@lang('site.category')</th>
                    <th style="text-align: inherit !important;">@lang('site.image')</th>
                    <th style="text-align: inherit !important;">@lang('site.purchase_price')</th>
                    <th style="text-align: inherit !important;">@lang('site.sale_price')</th>
                    <th style="text-align: inherit !important;">@lang('site.profit')</th>
                    <th style="text-align: inherit !important;">@lang('site.stock')</th>
                    <th style="text-align: inherit !important;">@lang('site.edit')</th>
                    <th style="text-align: inherit !important;">@lang('site.delete')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $index => $product)
                    <tr>
                        <td style="text-align: inherit !important;">{{$index + 1}}</td>
                        <td style="text-align: inherit !important;">{{$product->name}}</td>
                        <td style="text-align: inherit !important;">{{$product->description}}</td>
                        <td style="text-align: inherit !important;">{{$product->category->name}}</td>
                        <td style="text-align: inherit !important;"><img src="{{$product->image_path}}" style="width: 100px" class="img-thumbnail "></td>
                        <td style="text-align: inherit !important;">{{$product->purchase_price}}@lang('site.L.E')</td>
                        <td style="text-align: inherit !important;">{{$product->sale_price}}@lang('site.L.E')</td>
                        <td style="text-align: inherit !important;">{{$product->profit}}@lang('site.L.E')</td>
                        <td style="text-align: inherit !important;">{{$product->stock}}</td>

                        @if(auth()->user()->hasPermission('products_update'))
                            <td style="text-align: inherit !important;"><a href="{{route('dashboard.products.edit',$product->id)}}" class="btn btn-info">@lang('site.edit')</a></td>
                        @else

                            <td> <button class="btn btn-primary disabled">@lang('site.edit')</button> </td>

                        @endif

                            @if(auth()->user()->hasPermission('products_delete'))
                            <td style="text-align: inherit !important;"><form action="{{route('dashboard.products.destroy',$product->id)}}"  method="post">
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

                <div class="center-block">
                    {{$products->appends(request()->query())->links()}}
                </div>
                @else
            <h2>@lang('site.no-data-found')</h2>
                @endif
        </div>

        </div>
@endsection

