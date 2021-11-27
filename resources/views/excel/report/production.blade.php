<table border="1">
    <thead>
    <tr>
        <th colspan="3" style="font-size:14px;font-weight:bold;">PO Code</th>
        <th colspan="6" style="font-size:14px;font-weight:bold;">{{$purchasing->po_code}}</th>
    </tr>
    <tr>
        <th colspan="3" style="font-size:14px;font-weight:bold;">PO Date</th>
        <th colspan="6" style="font-size:14px;font-weight:bold;">{{$purchasing->order_date}}</th>
    </tr>
    <tr>
        <th colspan="3" style="font-size:14px;font-weight:bold;">Est Date</th>
        <th colspan="6" style="font-size:14px;font-weight:bold;">{{$purchasing->estimation_date}}</th>
    </tr>
    <tr>
        <th colspan="3" style="font-size:14px;font-weight:bold;">Item/Unit</th>
        <th colspan="6" style="font-size:14px;font-weight:bold;">{{$purchasing->item}} {{$purchasing->item}} Unit</th>
    </tr>
    <tr>
        <th colspan="3" style="font-size:14px;font-weight:bold;">Supplier Name</th>
        <th colspan="6" style="font-size:14px;font-weight:bold;">{{$purchasing->supplier_name}}</th>
    </tr>
    <tr>
        <th colspan="3" style="font-size:14px;font-weight:bold;">Total Price</th>
        <th colspan="6" style="font-size:14px;font-weight:bold;">{{$purchasing->total_price}}</th>
    </tr>
    <tr>
        <th></th>
    </tr>
    <tr>
        <th style="font-size:12px;font-weight:bold;">No</th>
        <th style="font-size:12px;font-weight:bold;">Name</th>
        @foreach($size as $valSize)
            <th style="font-size:12px;font-weight:bold;">{{$valSize->size_code}}</th>
        @endforeach
        <th style="font-size:12px;font-weight:bold;">Total Request</th>
        <th style="font-size:12px;font-weight:bold;">Total Actual</th>
    </tr>
    </thead>
    <tbody>
    @php
        $i=0;
    @endphp
    @foreach($request as $keyReq => $valReq)
        @php
            $i++;
        @endphp
        <tr>
            <td>{{$i}}</td>
            <td style="font-weight:bold;">{{$valReq['product']->product_name}}</td>
            @foreach($size as $keySize => $valSize)
                @if(array_key_exists($valSize->id, $valReq))
                    <td>{{ $valReq[$valSize->id]['value'] }}</td>
                @else
                    <td>0</td>
                @endif
            @endforeach
            <td>{{array_sum($requestTotal[$keyReq])}}</td>
            <td>{{array_sum($actualTotal[$keyReq])}}</td>
        </tr>
        
    @endforeach
    </tbody>
</table>
