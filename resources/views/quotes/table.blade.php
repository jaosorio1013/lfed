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
        @php($categoryIndex = 0)
        {{--@php($categoryItems = $categoryItems->groupBy('sub_category'))--}}

        @php($indexItem = 0)
        @foreach($categoryDetail->products as $product)
            {{--@if($subCategory !== '')
                <tr style="background: #FFF4EA; color: #C4907E;">
                    <td>{{ $index }}.{{ ++$categoryIndex }}</td>
                    <td colspan="4">{{ ucfirst($subCategory) }}</td>
                </tr>
            @endif--}}

            {{--@foreach($product as $item)--}}
            @php($indexItem++)

            <tr>
                <td>{{ $index }}.{{ $indexItem }}</td>
                {{-- <td @if(!$centeredText) style="text-align: left;" @endif>{{ ucfirst($product->product->name) }}</td> --}}
                <td style="text-align: left;">
                    <b>{{ ucfirst($product->product->name) }}: </b>
                    <div>{!! $product->product->description !!}</div>

                    @if($product->has_materiales || $product->has_transporte || $product->has_suministro || $product->has_instalacion)
                        <div style="color: #c44e47; margin-top: 10px;">
                            <b>Se suministra:</b>
                            <ul style="margin: 1px 0">
                                @if($product->has_materiales)
                                    <li>Mano de Obra</li>
                                @endif
                                @if($product->has_transporte)
                                    <li>Materiales</li>
                                @endif
                                @if($product->has_suministro)
                                    <li>Transporte</li>
                                @endif
                                @if($product->has_instalacion)
                                    <li>Instalación</li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </td>
                <td>
                    @if($product->quantity)
                        {{ $product->quantity }}
                    @else
                        <b>N.A</b>
                    @endif
                </td>

                @if($showValues)
                    <td>
                        @if($product->price_per_unit)
                            $ {{ number_format($product->price_per_unit, 0, ',', '.') }}
                        @else
                            <b>N.A</b>
                        @endif
                    </td>
                @endif

                @if($showValues)
                    <td>
                        @if($product->total)
                            $ {{ number_format($product->total, 0, ',', '.') }}
                        @else
                            <b>N.A</b>
                        @endif
                    </td>
                @endif
            </tr>
            {{--@endforeach--}}
        @endforeach

        @if($showValues)
            <tr>
                <td colspan="4" width="500px"><b>Total</b></td>
                <td>
                    @if($categoryDetail->total)
                        <b>$ {{ number_format($categoryDetail->total, 0, ',', '.') }}</b>
                    @else
                        <b>N.A</b>
                    @endif
                </td>
            </tr>
        @endif

        </tbody>
    </table>

    <br/>

    @php($index++)
@endforeach