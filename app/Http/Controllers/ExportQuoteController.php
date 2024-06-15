<?php

namespace App\Http\Controllers;

use App\Models\ProductQuote;
use App\Models\Quote;
use Illuminate\Http\Request;

class ExportQuoteController extends Controller
{
    public function __invoke(Request $request)
    {
        $quote = Quote::findOrFail($request->quote_id);
        $quoteItemsByCategory = ProductQuote::with('category:id,name', 'productProjectProvider')
            ->where('quote_id', $quote->id)
            ->get([
                'total',
                'product_category_id',
                'product_project_provider_id',
            ])
            ->groupBy('product_category_id')
            ->map(function ($category) {
                return (object)[
                    'total' => $category->sum('total'),
                    'category' => $category->first()->category->name,
                    'products' => $category->pluck('productProjectProvider'),
                ];
            });

        view()->share('showValues', (bool)$request->show_values);
        view()->share('breakOnTables', (bool)$request->break_on_tables);
        view()->share('centeredText', (bool)$request->center_text);
        view()->share('showSummary', (bool)$request->show_summary);
        view()->share('inlineValues', (bool)$request->inline_values);
        view()->share('total', $quote->subtotal + $quote->aui_value + $quote->iva_value);

        return view('quotes.index', compact('quote', 'quoteItemsByCategory'));
    }
}
