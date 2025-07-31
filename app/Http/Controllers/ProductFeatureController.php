<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $features = $product->features;
        return view('product-features.index', compact('product', 'features'));
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
            'feature' => 'required|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        ProductFeature::create($validator->validated());

        session()->flash('success', 'Tính năng sản phẩm đã được tạo thành công.');

        return response()->json([
            'status' => true,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductFeature $productFeature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductFeature $productFeature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductFeature $productFeature)
    {
        $rules = [
            'product_id' => 'required|exists:products,id',
            'feature' => 'required|string|max:255',
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'feature_ids' => 'required|array',
            'feature_ids.*' => 'exists:product_features,id',
        ]);

        $features = Productfeature::whereIn('id', $request->feature_ids)->get();

        foreach ($features as $feature) {
            $feature->delete();
        }

        session()->flash('success', 'Tính năng sản phẩm đã được xoá thành công.');

        return response()->json([
            'status' => true,
        ], 200);
    }
}
