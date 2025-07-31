<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
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
            'name' => 'required|string|max:255|unique:applications,name',
            'description' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        Application::create($validator->validated());

        session()->flash('success', 'Ứng dụng đã được tạo thành công.');

        return response()->json([
            'status' => true,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:applications,name,' . $application->id,
            'description' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $application->update($validator->validated());

        session()->flash('success', 'Ứng dụng đã được cập nhật thành công.');

        return response()->json([
            'status' => true,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        try {
            $application->delete();

            session()->flash('success', 'Ứng dụng đã được xoá thành công.');

            return response()->json([
                'status' => true,
            ], 200);
        } catch (QueryException $e) {
            $msg = $e->getCode() === '23000'
                ? 'Không thể xoá ứng dụng vì đang được liên kết với dữ liệu khác.'
                : 'Đã xảy ra lỗi khi xoá: ' . $e->getMessage();

            session()->flash('error', $msg);

            return response()->json([
                'status' => false,
            ], 500);
        }
    }
}
