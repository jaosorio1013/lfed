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
    @foreach($quoteItemsByCategory as $categoryId => $categoryDetail)
        <tr>
            <td>{{ $index++ }}</td>
            <td colspan="2">{{ strtoupper($categoryDetail->category) }}</td>
            <td>$ {{ number_format($categoryDetail->total, 0, ',', '.') }}</td>
        </tr>
    @endforeach
    </tbody>


    <tfoot>
    <tr>
        <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="3">Totales</td>
        <td>$ {{ number_format($quote->subtotal, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td rowspan="4" colspan="2" width="200px"></td>
        <td>Administración e imprevistos <small>({{ $quote->aui_percentage }} %)</small></td>
        <td>$ {{ number_format($quote->aui_value, 0, ',', '.') }}</td>
    </tr>

    <tr>
        <td>IVA 19%</td>
        <td>$ {{ number_format($quote->iva_value, 0, ',', '.') }}</td>
    </tr>

    <tr>
        <td style="background: #FEEDDE;">Valor Total</td>
        <td><b>$ {{ number_format($quote->total, 0, ',', '.') }}</b></td>
    </tr>

    </tfoot>
</table>