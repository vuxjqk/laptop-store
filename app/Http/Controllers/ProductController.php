<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $products = Product::when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('slug', 'like', '%' . $search . '%');
        })->latest()->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        return view('products.create', compact('brands'));
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
        $validated = $request->validate($rules);

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được tạo thành công.');
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
        $brands = Brand::all();
        return view('products.edit', compact('product', 'brands'));
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
        $validated = $request->validate($rules);

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();

            session()->flash('success', 'Sản phẩm đã được xoá thành công.');

            return response()->json([
                'status' => true,
            ], 200);
        } catch (QueryException $e) {
            $msg = $e->getCode() === '23000'
                ? 'Không thể xoá sản phẩm vì đang được liên kết với dữ liệu khác.'
                : 'Đã xảy ra lỗi khi xoá: ' . $e->getMessage();

            session()->flash('error', $msg);

            return response()->json([
                'status' => false,
            ], 500);
        }
    }
}
