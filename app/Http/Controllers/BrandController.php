<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $brands = Brand::when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('slug', 'like', '%' . $search . '%');
        })->latest()->paginate(10);

        return view('brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:brands,name',
            'slug' => 'required|string|max:255|unique:brands,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
        ];
        $validated = $request->validate($rules);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('logo', 'public');
            $validated['logo'] = $path;
        }

        Brand::create($validated);
        return redirect()->route('brands.index')->with('success', 'Thương hiệu đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return view('brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'slug' => 'required|string|max:255|unique:brands,slug,' . $brand->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'remove_image' => 'nullable|boolean',
            'is_active' => 'boolean',
        ];
        $validated = $request->validate($rules);

        if ($request->hasFile('image')) {
            if ($brand->logo) {
                Storage::disk('public')->delete($brand->logo);
            }
            $path = $request->file('image')->store('logo', 'public');
            $validated['logo'] = $path;
        } else if ($request->boolean('remove_image')) {
            if ($brand->logo) {
                Storage::disk('public')->delete($brand->logo);
            }
            $validated['logo'] = null;
        }

        $brand->update($validated);
        return redirect()->route('brands.index')->with('success', 'Thương hiệu đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        try {
            $brand->delete();
            if ($brand->logo) {
                Storage::disk('public')->delete($brand->logo);
            }

            session()->flash('success', 'Thương hiệu đã được xoá thành công.');

            return response()->json([
                'status' => true,
            ], 200);
        } catch (QueryException $e) {
            $msg = $e->getCode() === '23000'
                ? 'Không thể xoá thương hiệu vì đang được liên kết với dữ liệu khác.'
                : 'Đã xảy ra lỗi khi xoá: ' . $e->getMessage();

            session()->flash('error', $msg);

            return response()->json([
                'status' => false,
            ], 500);
        }
    }
}
