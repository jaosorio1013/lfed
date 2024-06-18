<iframe
        {{-- src="{{ URL::signedRoute('quotes.pdf', [$record->id, 'preview' => true]) }}" --}}
        src="{{ URL::signedRoute('export-quote', ['quote_id' => $record->id]) }}"
        style="min-height: 100svh;"
        class="w-full"
>
</iframe>
