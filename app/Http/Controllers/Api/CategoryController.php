<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Category::latest()->get()
        ]);
    }

    // 🔹 Store category
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
        ]);

        try {
            $category = Category::create([
                'name'       => trim($validated['name']),
                'code'       => $validated['code'] ?? null,
                'created_by' => auth()->id(),
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Category created successfully',
                'data'    => $category
            ], 201);

        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => 'Failed to create category',
            ], 500);
        }
    }


    // 🔹 Show single category
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $category
        ]);
    }

    // 🔹 Update category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'code' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('categories')->ignore($category->id),
            ],
        ]);

        $category->update([
            'name'       => $request->name,
            'code'       => $request->code,
            'updated_by' => auth()->id(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Category updated successfully',
            'data' => $category
        ]);
    }

    // 🔹 Delete category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([
            'status' => true,
            'message' => 'Category deleted successfully'
        ]);
    }
}
