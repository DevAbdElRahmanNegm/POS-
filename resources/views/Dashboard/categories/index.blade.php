@extends('dashboard.layout.app')
@section('content')


    <section class="content-header">
        <h1>
            @lang('site.categories')
        </h1>
    </section>



    <div class="box box-primary">
        <div class="box-header with-border">

            <form action="{{route('dashboard.categories.index')}}" method="get" >
                <div class="row" >
                    <div class="col-md-4" >
                        <input  type="text" name="search" value="{{request()->search}}" class="form-control" placeholder="@lang('site.search')">

                  </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary"><li class="fa fa-search"></li>@lang('site.search')</button>
                        @if(auth()->user()->hasPermission('categories_create'))

                        <a href="{{route('dashboard.categories.create')}}" class="btn btn-primary"><li class="fa fa-plus"></li>@lang('site.add')</a>

                        @else
                            <a href="#" class="btn btn-primary disabled"><li class="fa fa-plus"></li>@lang('site.add')</a>

                        @endif
                    </div>
                </div>
            </form>
            {{--<h3 class="box-title">@lang('site.categories')</h3>--}}
        </div>


        <div class="box-body">
            @if($categories->count() > 0)
            <table class="table table-bordered">

                <thead >
                <tr >
                    <th style="text-align: inherit !important;">#</th>
                    <th style="text-align: inherit !important;">@lang('site.name')</th>
                    <th style="text-align: inherit !important;">@lang('site.products')</th>
                    <th style="text-align: inherit !important;">@lang('site.related')</th>
                    <th style="text-align: inherit !important;">@lang('site.edit')</th>
                    <th style="text-align: inherit !important;">@lang('site.delete')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $index => $category)
                    <tr>
                        <td style="text-align: inherit !important;">{{$index + 1}}</td>
                        <td style="text-align: inherit !important;">{{$category->name}}</td>

                        <td style="text-align: inherit !important;">{{$category->products->count()}}</td>
                        <td style="text-align: inherit !important;"><a href="{{route('dashboard.products.index' , ['category_id' => $category->id])}}" class="btn btn-info">@lang('site.related')</a></td>

                        @if(auth()->user()->hasPermission('categories_update'))
                            <td style="text-align: inherit !important;"><a href="{{route('dashboard.categories.edit',$category->id)}}" class="btn btn-info">@lang('site.edit')</a></td>
                        @else

                            <td> <button class="btn btn-primary disabled">@lang('site.edit')</button> </td>

                        @endif

                            @if(auth()->user()->hasPermission('categories_delete'))
                            <td style="text-align: inherit !important;"><form action="{{route('dashboard.categories.destroy',$category->id)}}"  method="post">
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
                    {{$categories->appends(request()->query())->links()}}
                </div>
                @else
            <h2>@lang('site.no-data-found')</h2>
                @endif
        </div>

        </div>
@endsection

