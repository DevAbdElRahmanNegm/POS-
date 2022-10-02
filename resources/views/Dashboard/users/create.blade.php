@extends('dashboard.layout.app')
@section('content')


    <section class="content-header">
        <h1>
            @lang('site.users')
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
            <form action="{{route('dashboard.users.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>@lang('site.first_name')</label>
                    <input class="form-control" type="text" name="first_name" value="{{old('first_name')}}">
                </div>

                <div class="form-group">
                    <label>@lang('site.last_name')</label>
                    <input class="form-control" type="text" name="last_name" value="{{old('last_name')}}">
                </div>


                <div class="form-group">
                    <label>@lang('site.email')</label>
                    <input class="form-control" type="email" name="email" value="{{old('email')}}">
                </div>

                <div class="form-group">
                    <label>@lang('site.image')</label>
                    <input class="form-control imagee" type="file" name="image">
                </div>

                <div class="form-group">
                    <img src="{{asset('images/users/default.png')}}" style="width: 100px" class="img-thumbnail image-preview">
                </div>
                <div class="form-group">
                    <label>@lang('site.password')</label>
                    <input class="form-control" type="password" name="password">
                </div>

                <div class="form-group">
                    <label>@lang('site.password-confirmation')</label>
                    <input class="form-control" type="password" name="password_confirmation">
                </div>

                <div class="form-group">
                    <label>@lang('site.permissions')</label>

                    <div class="nav-tabs-custom">

                        @php

                            $models = ['users' , 'categories' , 'products'];
                            $maps = ['create' , 'read' , 'update' , 'delete'];
                        @endphp
                        <ul class="nav nav-tabs">
                            @foreach($models as $index=>$model)
                                <li class="{{$index == 0 ? 'active' : ''}}"><a href="#{{$model}}"
                                                                               data-toggle="tab">@lang('site.' . $model)</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach($models as $index=>$model)
                                <div class="tab-pane {{$index == 0 ? 'active' : ''}}" id="{{$model}}">
                                    @foreach($maps as $map)

                                        <label><input type="checkbox" name="permissions[]"
                                                      value="{{$model}}_{{$map}}">@lang('site.'.$map)</label>
                                    @endforeach
                                </div>

                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</button>
                </div>
            </form>
        </div>

    </div>


@endsection
