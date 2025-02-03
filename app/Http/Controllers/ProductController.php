<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all()->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image ? url('storage/' . $product->image) : null,
                'price' => $product->price,
                'description' => $product->description,
                'category' => $product->category
            ];
        });

        return response()->json($products);
    }
}