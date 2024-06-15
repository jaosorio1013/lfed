<?php

namespace App\Http\Controllers;

use App\Models\ProductQuote;
use App\Models\Quote;

class ExportQuoteController extends Controller
{
    public function __invoke(
        Quote $quote,
        $showValues = true,
        $breakOnTables = false,
        $centeredText = false,
        $showSummary = false,
        $inlineValues = false,
    )
    {
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

        view()->share('showValues', $showValues);
        view()->share('breakOnTables', $breakOnTables);
        view()->share('centeredText', $centeredText);
        view()->share('showSummary', $showSummary);
        view()->share('inlineValues', $inlineValues);
        view()->share('total', $quote->subtotal + $quote->aui_value + $quote->iva_value);

        return view('quotes.index', compact('quote', 'quoteItemsByCategory'));
    }
}
