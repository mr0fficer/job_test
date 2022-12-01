<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return ProductResource::collection($products)->toJson();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $validator->messages();
        } else {
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price
            ]);

            if ($request->categories) {
                $categories = Category::find($request->categories);
                $product->categories()->attach($categories);
            }

            return [
                'status' => true,
                'product' => $product
            ];
        }
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return ['status' => false, 'message' => 'Товар не найден'];
        } else {
            return $product;
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $validator->messages();
        } else {
            $product->name =  $request->name;
            $product->price =  $request->price;
            $product->save();

            if ($request->categories) {
                $product->categories()->sync($request->categories);
            }

            return [
                'status' => true,
                'product' => $product
            ];
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->categories()->detach();
        $product->delete();

        return [
            'status' => true
        ];
    }
}
