@extends('dashboard.layout.app')
@section('content')


    <section class="content-header">
        <h1>
            @lang('site.clients')
        </h1>
    </section>



    <div class="box box-primary">
        <div class="box-header with-border">

            <form action="{{route('dashboard.clients.index')}}" method="get" >
                <div class="row" >
                    <div class="col-md-4" >
                        <input  type="text" name="search" value="{{request()->search}}" class="form-control" placeholder="@lang('site.search')">

                  </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary"><li class="fa fa-search"></li>@lang('site.search')</button>
                        @if(auth()->user()->hasPermission('clients_create'))

                        <a href="{{route('dashboard.clients.create')}}" class="btn btn-primary"><li class="fa fa-plus"></li>@lang('site.add')</a>

                        @else
                            <a href="#" class="btn btn-primary disabled"><li class="fa fa-plus"></li>@lang('site.add')</a>

                        @endif
                    </div>
                </div>
            </form>
            {{--<h3 class="box-title">@lang('site.clients')</h3>--}}
        </div>


        <div class="box-body">
            @if($clients->count() > 0)
            <table class="table table-bordered">

                <thead >
                <tr >
                    <th style="text-align: inherit !important;">#</th>
                    <th style="text-align: inherit !important;">@lang('site.name')</th>
                    <th style="text-align: inherit !important;">@lang('site.phone')</th>
                    <th style="text-align: inherit !important;">@lang('site.address')</th>
                    <th style="text-align: inherit !important;">@lang('site.orders')</th>
                    <th style="text-align: inherit !important;">@lang('site.edit')</th>
                    <th style="text-align: inherit !important;">@lang('site.delete')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($clients as $index => $client)
                    <tr>
                        <td style="text-align: inherit !important;">{{$index + 1}}</td>
                        <td style="text-align: inherit !important;">{{$client->name}}</td>

                        <td style="text-align: inherit !important;">{{implode(' -  ' , $client->phone )}}</td>

                        <td style="text-align: inherit !important;">{{$client->address}}</td>

                            @if(auth()->user()->hasPermission('orders_create'))
                            <td style="text-align: inherit !important;">   <a href="{{route('dashboard.clients.orders.create' , $client->id)}}" class="btn btn-primary" >@lang('site.add')</a>
                        </td>
                        @else
                            <td> <button class="btn btn-primary disabled">@lang('site.add')</button> </td>
                            @endif


                    @if(auth()->user()->hasPermission('clients_update'))
                            <td style="text-align: inherit !important;"><a href="{{route('dashboard.clients.edit',$client->id)}}" class="btn btn-info">@lang('site.edit')</a></td>
                        @else

                            <td> <button class="btn btn-primary disabled">@lang('site.edit')</button> </td>

                        @endif

                            @if(auth()->user()->hasPermission('clients_delete'))
                            <td style="text-align: inherit !important;"><form action="{{route('dashboard.clients.destroy',$client->id)}}"  method="post">
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
                    {{$clients->appends(request()->query())->links()}}
                </div>
                @else
            <h2>@lang('site.no-data-found')</h2>
                @endif
        </div>

        </div>
@endsection

