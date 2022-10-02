@extends('dashboard.layout.app')
@section('content')


    <section class="content-header">
        <h1>
            @lang('site.categories')
        </h1>
    </section>



    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('site.edit')</h3>
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
            <form action="{{route('dashboard.categories.update' , $category->id)}}" method="post">
                @csrf
                {{method_field('put')}}
                @foreach(config('translatable.locales') as $locale)
                    <div class="form-group">
                        <label>@lang('site.' . $locale . '.name')</label>
                        <input class="form-control" type="text"  name="{{$locale}}[name]" value="{{$category->translate($locale)->name}}" >
                    </div>
                @endforeach
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>@lang('site.edit')</button>
                </div>
            </form>
        </div>

    </div>


@endsection
