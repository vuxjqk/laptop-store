<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:products,name',
            'slug' => 'required|string|max:255|unique:products,slug',
            'brand_id' => 'required|exists:brands,id',
            'description' => 'nullable|string',
            'processor' => 'nullable|string|max:255',
            'display' => 'nullable|string|max:255',
            'graphics' => 'nullable|string|max:255',
            'battery' => 'nullable|string|max:255',
            'weight' => 'nullable|string|max:255',
            'ports' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'brand_id' => 'required|exists:brands,id',
            'description' => 'nullable|string',
            'processor' => 'nullable|string|max:255',
            'display' => 'nullable|string|max:255',
            'graphics' => 'nullable|string|max:255',
            'battery' => 'nullable|string|max:255',
            'weight' => 'nullable|string|max:255',
            'ports' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
