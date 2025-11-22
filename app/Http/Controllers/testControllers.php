<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\testModel;

class testControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = testModel::all();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'testName' => 'required|string|max:255',
            'testType' => 'required|string|max:255',
        ]);

        // Create record
        $test = testModel::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Record created successfully',
            'data' => $test
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $test = testModel::find($id);

        if (!$test) {
            return response()->json([
                'status' => 'error',
                'message' => 'Record not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $test
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $test = testModel::find($id);

        if (!$test) {
            return response()->json([
                'status' => 'error',
                'message' => 'Record not found'
            ], 404);
        }

        // Validate
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
        ]);

        $test->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Record updated successfully',
            'data' => $test
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $test = testModel::find($id);

        if (!$test) {
            return response()->json([
                'status' => 'error',
                'message' => 'Record not found'
            ], 404);
        }

        $test->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Record deleted successfully'
        ], 200);
    }
}
