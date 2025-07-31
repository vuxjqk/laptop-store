<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Product;
use App\Models\ProductApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $applications = Application::all();
        return view('product-applications.index', compact('product', 'applications'));
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
            'product_id' => 'required|exists:products,id',
            'application_id' => 'required|exists:applications,id',
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductApplication $productApplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductApplication $productApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $rules = [
            'product_id' => 'required|exists:products,id',
            'application_ids' => 'nullable|array',
            'application_ids.*' => 'exists:applications,id',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

        $product = Product::find($validated['product_id']);

        $product->applications()->sync($validated['application_ids'] ?? []);

        session()->flash('success', 'Danh sách ứng dụng sản phẩm đã được cập nhật thành công.');

        return response()->json([
            'status' => true,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductApplication $productApplication)
    {
        //
    }
}
