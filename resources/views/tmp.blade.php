<style>
    @media print {
        div, p, hr {
            display: none !important;
        }
    }

    table {
        page-break-after: always;
    }

    table:last-child {
        page-break-after: unset !important;
    }

    table {
        text-align: center;
        font-family: "Open Sans";
        font-size: 16px;
        color: #666666;
        border-collapse: collapse;
        border-color: #C3907D;
    }

    td, th {
        padding: 8px;
        line-height: 1.1em;
    }
</style>

@php($index = 1)
@foreach($actividades as $category => $categoryItems)
    <table border="1">
        <thead>
        <tr>
            <th
                    colspan="{{ $mostrarValores ? '5' : '3' }}"
                    style="background: #C3907D; color: white; font-weight: bold"
            >
                {{ strtoupper($category) }}
            </th>
        </tr>
        <tr style="background: #FEEDDE; color: #C3907D; font-weight: bold">
            <th width="70px">Item</th>
            <th width="670px">Actividad</th>
            <th width="100px">Cantidad</th>
            @if($mostrarValores)
                <th width="120px">Val. Unidad</th>
            @endif
            @if($mostrarValores)
                <th width="130px">Val. Total</th>
            @endif
        </tr>
        </thead>
        <tbody>


        @php($categoryIndex = 0)
        @php($valorTotal = $categoryItems->sum('valor_total'))
        @php($categoryItems = $categoryItems->groupBy('sub_category'))

        @foreach($categoryItems as $subCategory => $items)
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
                    @if($mostrarValores)
                        <td>$ {{ number_format($item->valor_unidad, 0, ',', '.') }}</td>
                    @endif
                    @if($mostrarValores)
                        <td>$ {{ number_format($item->valor_total, 0, ',', '.') }}</td>
                    @endif
                </tr>
            @endforeach
        @endforeach

        @if($mostrarValores)
            <tr>
                <td colspan="4" width="500px"><b>Total</b></td>
                <td><b>$ {{ number_format($valorTotal, 0, ',', '.') }}</b></td>
            </tr>
        @endif

        </tbody>
    </table>

    <br/>

    @php($index++)
@endforeach

<hr/>

<table border="1">
    <thead>
    <tr>
        <th
                colspan="4"
                style="background: #C3907D; color: white; font-weight: bold"
        >
            ACTIVIDADES A REALIZAR
        </th>
    </tr>
    <tr style="background: #FEEDDE; color: #C3907D; font-weight: bold">
        <th width="170px">Item</th>
        <th width="500px" colspan="2">Actividad</th>
        <th width="150px">Valor</th>
    </tr>
    </thead>
    <tbody>
    @php($index = 1)
    @foreach($actividades as $category => $items)
        <tr>
            <td>{{ $index++ }}</td>
            <td colspan="2">{{ strtoupper($category) }}</td>
            <td>$ {{ number_format($items->sum('valor_total'), 0, ',', '.') }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3">Totales</td>
        <td>$ {{ number_format($subtotal, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td rowspan="4" colspan="2" width="200px"></td>
        <td>Administración e imprevistos <small>({{ $procentajeAdministracion }} %)</small></td>
        <td>$ {{ number_format($administracion, 0, ',', '.') }}</td>
    </tr>

    @if($transporte > 0)
        <tr>
            <td>Transporte Mobiliario</td>
            <td>$ {{ number_format($transporte, 0, ',', '.') }}</td>
        </tr>
    @endif

    @if($descuentoDiseno > 0)
        <tr>
            <td>
                @if($descuentoTotalDiseno)
                    Descuento Valor Total del Diseño
                @else
                    Descuento por Diseño
                @endif
            </td>
            <td>- $ {{ number_format($descuentoDiseno, 0, ',', '.') }}</td>
        </tr>
    @endif

    @if($iva > 0)
        <tr>
            <td>IVA 19%</td>
            <td>$ {{ number_format($iva, 0, ',', '.') }}</td>
        </tr>
    @endif
    <tr>
        <td style="background: #FEEDDE;">Valor Total</td>
        <td><b>$ {{ number_format($total, 0, ',', '.') }}</b></td>
    </tr>
    </tfoot>
</table>

<br/><br/><br/>
