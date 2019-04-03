<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function index() {
    return response()->json(Product::all());
  }

  public function create(Request $request) {
    $product = new Product;

    $product->name = $request->name;
    $product->price = $request->price;
    $product->description = $request->description;

    $product->save();

    return response()->json($product);
  }

  public function show($id) {
    $product = Product::find($id);

    return response()->json($product);
  }

  public function update($id) {
    $product = Product::find($id);

    $product->name = $request->input('name');
    $product->price = $request->input('price');
    $product->description = $request->input('description');

    $product->save();

    return response()->json($product);
  }

  public function destroy($id) {
    $product = Product::find($id);

    $product->destroy();

    return response()->json('Product deleted sucessfully');
  }
}
