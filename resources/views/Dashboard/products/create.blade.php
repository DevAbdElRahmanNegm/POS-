@extends('dashboard.layout.app')
@section('content')


    <section class="content-header">
        <h1>
            @lang('site.products')
        </h1>
    </section>



    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('site.add')</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->

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
            <form action="{{route('dashboard.products.store')}}" method="post"  enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label>@lang('site.categories')</label>
                        <select name="category_id" class="form-control">
                            <option>...</option>
                        @foreach($categories as $category)

                            <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                        </select>
                    </div>

            @foreach(config('translatable.locales') as $locale)
                    <div class="form-group">
                        <label>@lang('site.' . $locale . '.name')</label>
                        <input class="form-control" type="text" name="{{$locale}}[name]" value="{{old($locale.'.name')}}" >
                    </div>
                    <div class="form-group">
                        <label>@lang('site.' . $locale . '.description')</label>
                        <input class="form-control" type="text" name="{{$locale}}[description]" value="{{old($locale.'.description')}}" >
                    </div>

                @endforeach
                <div class="form-group">
                    <label>@lang('site.image')</label>
                    <input class="form-control imagee" type="file" name="image">
                </div>
                <div class="form-group">
                    <img src="{{asset('images/products/default.png')}}" style="width: 100px" class="img-thumbnail image-preview">
                </div>


                <div class="form-group">
                    <label>@lang('site.purchase_price')</label>
                    <input class="form-control" type="number" name="purchase_price" value="{{old('purchase_price')}}" >
                </div>

                <div class="form-group">
                    <label>@lang('site.sale_price')</label>
                    <input class="form-control" type="number" name="sale_price" value="{{old('sale_price')}}" >
                </div>
                <div class="form-group">
                    <label>@lang('site.stock')</label>
                    <input class="form-control" type="number" name="stock" value="{{old('stock')}}" >
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</button>
                </div>
            </form>
        </div>

    </div>


@endsection
