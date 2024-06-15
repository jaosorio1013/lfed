@php($index = 1)
@foreach($quoteItemsByCategory as $categoryId => $categoryDetail)
    <table border="1">


        <thead>
        <tr>
            <th
                    colspan="{{ $showValues ? '5' : '3' }}"
                    style="background: #C3907D; color: white; font-weight: bold"
            >
                {{ strtoupper($categoryDetail->category) }}
            </th>
        </tr>
        <tr style="background: #FEEDDE; color: #C3907D; font-weight: bold">
            <th width="70px">Item</th>
            <th width="670px">Actividad</th>
            <th width="100px">Cantidad</th>

            @if($showValues)
                <th width="120px">Val. Unidad</th>
            @endif

            @if($showValues)
                <th width="130px">Val. Total</th>
            @endif
        </tr>
        </thead>


        <tbody>
        {{--@php($categoryIndex = 0)
        @php($valorTotal = $categoryItems->sum('valor_total'))
        @php($categoryItems = $categoryItems->groupBy('sub_category'))--}}

        {{--@foreach($categoryItems as $subCategory => $items)
            @php($indexItem = 0)
            @if($subCategory !== '')
                <tr style="background: #FFF4EA; color: #C4907E;">
                    <td>{{ $index }}.{{ ++$categoryIndex }}</td>
                    <td colspan="4">{{ ucfirst($subCategory) }}</td>
                </tr>
            @endif

            @foreach($items as $item)
                @php($indexItem++)

                <tr>
                    <td>{{ $index }}{{ $subCategory !== '' ? '.'.$categoryIndex : '' }}.{{ $indexItem }}</td>
                    <td @if(!$texto_centrado) style="text-align: left;" @endif>{{ ucfirst($item->actividad) }}</td>
                    <td>{{ $item->cantidad }}</td>
                    @if($showValues)
                        <td>$ {{ number_format($item->valor_unidad, 0, ',', '.') }}</td>
                    @endif
                    @if($showValues)
                        <td>$ {{ number_format($item->valor_total, 0, ',', '.') }}</td>
                    @endif
                </tr>
            @endforeach
        @endforeach--}}

        @if($showValues)
            <tr>
                <td colspan="4" width="500px"><b>Total</b></td>
                <td><b>$ {{ number_format($categoryDetail->total, 0, ',', '.') }}</b></td>
            </tr>
        @endif

        </tbody>
    </table>

    <br/>

    @php($index++)
@endforeach