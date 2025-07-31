<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Ram;
use App\Models\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $rams = Ram::all();
        $storages = Storage::all();
        $colors = Color::all();

        return view('product-variants.index', compact('product', 'rams', 'storages', 'colors'));
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
            'ram_id' => ['required_without:new_ram', function ($attribute, $value, $fail) {
                if ($value !== 'new' && !Ram::where('id', $value)->exists()) {
                    $fail('The selected RAM is invalid.');
                }
            }],
            'new_ram' => 'required_if:ram_id,new|nullable|string|max:255|unique:rams,size',
            'storage_id' => ['required_without:new_storage', function ($attribute, $value, $fail) {
                if ($value !== 'new' && !Storage::where('id', $value)->exists()) {
                    $fail('The selected storage is invalid.');
                }
            }],
            'new_storage' => 'required_if:storage_id,new|nullable|string|max:255|unique:storages,capacity',
            'color_id' => ['required_without:new_color_name', function ($attribute, $value, $fail) {
                if ($value !== 'new' && !Color::where('id', $value)->exists()) {
                    $fail('The selected color is invalid.');
                }
            }],
            'new_color_name' => 'required_if:color_id,new|nullable|string|max:255|unique:colors,name',
            'new_color_hex' => 'required_if:color_id,new|nullable|string|regex:/^#[0-9A-Fa-f]{6}$/|unique:colors,hex_code',
            'price' => 'required|numeric|min:0',
            'original_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
        ];

        if ($request->input('ram_id') !== 'new') {
            unset($rules['new_ram']);
        }
        if ($request->input('storage_id') !== 'new') {
            unset($rules['new_storage']);
        }
        if ($request->input('color_id') !== 'new') {
            unset($rules['new_color_name']);
            unset($rules['new_color_hex']);
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

        try {
            // Handle new RAM creation
            if ($validated['ram_id'] === 'new' && isset($validated['new_ram'])) {
                $ram = Ram::create(['size' => $validated['new_ram']]);
                $validated['ram_id'] = $ram->id;
            }

            // Handle new storage creation
            if ($validated['storage_id'] === 'new' && isset($validated['new_storage'])) {
                $storage = Storage::create(['capacity' => $validated['new_storage']]);
                $validated['storage_id'] = $storage->id;
            }

            // Handle new color creation
            if ($validated['color_id'] === 'new' && isset($validated['new_color_name'], $validated['new_color_hex'])) {
                $color = Color::create([
                    'name' => $validated['new_color_name'],
                    'hex_code' => $validated['new_color_hex'],
                ]);
                $validated['color_id'] = $color->id;
            }

            // Create the variant
            ProductVariant::create([
                'product_id' => $validated['product_id'],
                'ram_id' => $validated['ram_id'],
                'storage_id' => $validated['storage_id'],
                'color_id' => $validated['color_id'],
                'price' => $validated['price'],
                'original_price' => $validated['original_price'],
                'stock_quantity' => $validated['stock_quantity'],
            ]);

            session()->flash('success', 'Biến thể đã được thêm thành công.');

            return response()->json([
                'status' => true,
                'message' => 'Biến thể đã được thêm thành công.',
            ], 200);
        } catch (QueryException $e) {
            $msg = $e->getCode() === '23000'
                ? 'Biến thể này đã tồn tại (kết hợp RAM, bộ nhớ, màu sắc trùng lặp).'
                : 'Đã xảy ra lỗi khi thêm biến thể: ' . $e->getMessage();

            return response()->json([
                'status' => false,
                'errors' => ['general' => $msg],
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductVariant $productVariant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductVariant $productVariant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductVariant $productVariant)
    {
        $rules = [
            'price' => 'numeric|min:0',
            'original_price' => 'numeric|min:0',
            'stock_quantity' => 'integer|min:0',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

        try {
            $productVariant->update(array_filter($validated, fn($value) => !is_null($value)));

            session()->flash('success', 'Biến thể đã được cập nhật thành công.');

            return response()->json([
                'status' => true,
                'message' => 'Biến thể đã được cập nhật thành công.',
            ], 200);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'errors' => ['general' => 'Đã xảy ra lỗi khi cập nhật biến thể: ' . $e->getMessage()],
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $rules = [
            'variant_ids' => 'required|array',
            'variant_ids.*' => 'exists:product_variants,id',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            ProductVariant::whereIn('id', $request->variant_ids)->delete();

            session()->flash('success', 'Các biến thể đã được xoá thành công.');

            return response()->json([
                'status' => true,
                'message' => 'Các biến thể đã được xoá thành công.',
            ], 200);
        } catch (QueryException $e) {
            $msg = $e->getCode() === '23000'
                ? 'Không thể xoá biến thể vì đang được liên kết với dữ liệu khác.'
                : 'Đã xảy ra lỗi khi xoá: ' . $e->getMessage();

            session()->flash('error', $msg);

            return response()->json([
                'status' => false,
                'errors' => ['general' => $msg],
            ], 500);
        }
    }
}
