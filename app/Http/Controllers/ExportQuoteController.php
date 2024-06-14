<?php

namespace App\Http\Controllers;

use App\Models\ProductQuote;
use App\Models\Quote;

class ExportQuoteController extends Controller
{
    public function __invoke(Quote $quote)
    {
        $quoteItemsByCategory = ProductQuote::with('category:id,name', 'productProjectProvider')
            ->where('quote_id', $quote->id)
            ->get([
                'total',
                'product_id',
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
        // dd($quoteItemsByCategory);
        // // $quote = Quote::with([
        //     'products',
        //     'categories:id,name',
        // ])->find($quoteId);

        return view('quotes.index', compact('quote', 'quoteItemsByCategory'));
    }
}
