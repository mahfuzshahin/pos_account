<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
class ShopController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Shop::latest()->get()
        ]);
    }

    // 🔹 Store category
    public function store(Request $request)
    {

        try {
            $shop = Shop::create([
                'name'       => trim($request->name),
                'address'    => $request->address,
                'user_id'    => $request->user_id,
                'category_id'=> $request->category_id,
                'created_by' => auth()->id(),
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Shop created successfully',
                'data'    => $shop
            ], 201);

        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => 'Failed to create shop',
            ], 500);
        }
    }


    // 🔹 Show single category
    public function show($id)
    {
        $category = Shop::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $category
        ]);
    }

    // 🔹 Update category
    public function update(Request $request, $id)
    {
        $shop = Shop::findOrFail($id);


        $shop->update([
            'name'       => $request->name,
            'address'    => $request->address,
            'user_id'    => $request->user_id,
            'category_id'=> $request->category_id,
            'updated_by' => auth()->id(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Shop updated successfully',
            'data' => $shop
        ]);
    }

    // 🔹 Delete category
    public function destroy($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->delete();

        return response()->json([
            'status' => true,
            'message' => 'Shop deleted successfully'
        ]);
    }
}
