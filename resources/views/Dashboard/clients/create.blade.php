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
            <form action="{{route('dashboard.clients.store')}}" method="post" >
                @csrf
                    <div class="form-group">
                        <label>@lang('site.name')</label>
                        <input class="form-control" type="text" name="name" value="{{old('name')}}" >
                    </div>
                <div class="form-group">
                    <label>@lang('site.phone')</label>
                    <input class="form-control" type="text" name="phone[]" value="{{old('phone[0]')}}" >
                </div>
                <div class="form-group">
                    <label>@lang('site.phone')</label>
                    <input class="form-control" type="text" name="phone[]" value="{{old('phone[1]')}}" >
                </div>
                <div class="form-group">
                    <label>@lang('site.address')</label>
                    <textarea name="address"  class="form-control">{{old('address')}}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</button>
                </div>
            </form>
        </div>

    </div>


@endsection
