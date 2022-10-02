@extends('dashboard.layout.app')
@section('content')


    <section class="content-header">
        <h1>
            @lang('site.users')
        </h1>
    </section>



    <div class="box box-primary">
        <div class="box-header with-border">

            <form action="{{route('dashboard.users.index')}}" method="get" >
                <div class="row" >
                    <div class="col-md-4" >
                        <input  type="text" name="search" value="{{request()->search}}" class="form-control" placeholder="@lang('site.search')">

                    </div>

                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary"><li class="fa fa-search"></li>@lang('site.search')</button>
                        @if(auth()->user()->hasPermission('users_create'))

                        <a href="{{route('dashboard.users.create')}}" class="btn btn-primary"><li class="fa fa-plus"></li>@lang('site.add')</a>

                        @else
                            <a href="#" class="btn btn-primary disabled"><li class="fa fa-plus"></li>@lang('site.add')</a>

                        @endif
                    </div>
                </div>
            </form>
            {{--<h3 class="box-title">@lang('site.users')</h3>--}}
        </div>


        <div class="box-body">
            @if($users->count() > 0)
            <table class="table table-bordered">

                <thead >
                <tr >
                    <th style="text-align: inherit !important;">#</th>
                    <th style="text-align: inherit !important;">@lang('site.first_name')</th>
                    <th style="text-align: inherit !important;">@lang('site.last_name')</th>
                    <th style="text-align: inherit !important;">@lang('site.email')</th>
                    <th style="text-align: inherit !important;">@lang('site.image')</th>
                    <th style="text-align: inherit !important;">@lang('site.edit')</th>
                    <th style="text-align: inherit !important;">@lang('site.delete')</th>

                </tr>
                </thead>
                <tbody>
                @foreach($users as $index=>$user)

                        <td style="text-align: inherit !important;">{{$index + 1}}</td>
                        <td style="text-align: inherit !important;">{{$user->first_name}}</td>
                        <td style="text-align: inherit !important;">{{$user->last_name}}</td>
                        <td style="text-align: inherit !important;">{{$user->email}}</td>
                        <td style="text-align: inherit !important;"><img src="{{$user->image_path}}" style="width: 100px" class="img-thumbnail "></td>
                        @if(auth()->user()->hasPermission('users_update'))
                            <td style="text-align: inherit !important;"><a href="{{route('dashboard.users.edit',$user->id)}}" class="btn btn-info">@lang('site.edit')</a></td>
                        @else

                            <td> <button class="btn btn-primary disabled">@lang('site.edit')</button> </td>

                        @endif

                            @if(auth()->user()->hasPermission('users_delete'))
                            <td style="text-align: inherit !important;"><form action="{{route('dashboard.users.destroy',$user->id)}}"  method="post">
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
                    {{$users->appends(request()->query())->links()}}
                </div>
                @else
            <h2>@lang('site.no-data-found')</h2>
                @endif
        </div>

        </div>
@endsection

