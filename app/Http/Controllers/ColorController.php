<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
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
            'name' => 'required|string|max:50|unique:colors,name',
            'hex_code' => ['required', 'string', 'size:7', 'unique:colors,hex_code', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Color $color)
    {
        $rules = [
            'name' => 'required|string|max:50|unique:colors,name,' . $color->id,
            'hex_code' => ['required', 'string', 'size:7', 'unique:colors,hex_code,' . $color->id, 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        //
    }
}
