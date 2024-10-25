<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Create Product
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::create($validatedData);
        return response()->json($product, 201);
    }


    // Update Product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json($product, 200);
    }

    // Delete Product
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    // Get all products
    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    // Get all products specific to a specific user (through orders)
    public function getProductsByCustomer($customerId)
    {
        $products = Product::whereHas('orders', function($query) use ($customerId) {
            $query->where('customer_id', $customerId);
        })->get();

        return response()->json($products, 200);
    }
}
