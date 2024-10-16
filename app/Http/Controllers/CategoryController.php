<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }
    public function create()
    {
        return view('category.create');
    }

    public function store(StoreRequest $request)
    {
        return redirect()->route('category.index')
            ->with('category', Category::query()->create($request->validated()));
    }
    public function edit(string $slug)
    {
        return view('category.edit')
            ->with('category', Category::query()->findOrFail($slug));
    }
    public function update(UpdateRequest $request, string $slug)
    {

        return redirect()->route('category.index')
            ->with('category', Category::query()->findOrFail($slug)
                ->update($request->validated()));
    }
    public function show(string $slug)
    {
        return view('category.show')
            ->with('category', Category::query()->findOrFail($slug));
    }
    public function destroy(string $slug)
    {
        Category::query()->findOrFail($slug)->delete();

        return redirect()->route('category.index');
    }
}
