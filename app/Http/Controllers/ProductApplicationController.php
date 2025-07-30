<?php

namespace App\Http\Controllers;

use App\Models\ProductApplication;
use Illuminate\Http\Request;

class ProductApplicationController extends Controller
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
    public function update(Request $request, ProductApplication $productApplication)
    {
        $rules = [
            'product_id' => 'required|exists:products,id',
            'application_id' => 'required|exists:applications,id',
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductApplication $productApplication)
    {
        //
    }
}
