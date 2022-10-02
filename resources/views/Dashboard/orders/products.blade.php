


<table class="table table-bordered " >




<thead >
<tr >
    <th style="text-align: inherit !important;">#</th>
    <th style="text-align: inherit !important;">@lang('site.name')</th>
    <th style="text-align: inherit !important;">@lang('site.quantity')</th>
    <th style="text-align: inherit !important;">@lang('site.price')</th>

</tr>
</thead>
<tbody>
@foreach($products as $index=>$product)
<tr>

    <td style="text-align: inherit !important;">{{$index + 1}}</td>
    <td style="text-align: inherit !important;">{{$product->name}}</td>
    <td style="text-align: inherit !important;">{{$product->pivot->quantity}}</td>
    <td style="text-align: inherit !important;">{{$product->pivot->quantity * $product->sale_price }}</td>

</tr>
    @endforeach

</tbody>
</table>
<h4>@lang('site.total'):<span> {{$order->total_price}}</span></h4>