<?php

namespace App\Http\Controllers;

use App\Filters\ProductsFilter;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductController extends Controller
{
//    public function index()
//    {
//        $products = Product::all();
//        return view('product.index', compact('products'));
//    }
    public function index(FormRequest $request)
    {
        $selectedCategoryId = $request->get('category_id');
        $products = (new ProductsFilter($request))->apply(Product::query())->get();

        return view('product.index', compact('products', 'selectedCategoryId'));
    }
    public function create()
    {
        return view('product.create')->with('categories', Category::all());
    }

    public function store(StoreRequest $request)
    {
        return redirect()->route('product.index')
            ->with('product', Product::query()->create($request->validated()));
    }

    public function edit(string $slug)
    {
        return view('product.edit')
            ->with('product', Product::query()->findOrFail($slug));
    }

    public function update(UpdateRequest $request, string $slug)
    {

        return redirect()->route('product.index')
            ->with('product', Product::query()->findOrFail($slug)
            ->update($request->validated()));
    }

    public function show(string $slug)
    {
        return view('product.show')
            ->with('product', Product::query()->findOrFail($slug));
    }

    public function destroy(string $slug)
    {
        Product::query()->findOrFail($slug)->delete();

        return redirect()->route('product.index');
    }
}
