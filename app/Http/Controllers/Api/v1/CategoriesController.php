<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    public function products($id, Request $request)
    {

        if ($request->includeChildren == 1) {
            $categories = Category::where('parent_id', $id)->orWhere('id', $id)->get();
            $products_out = collect([]);
            foreach ($categories as $category) {
                $products = $category->products()->get();
                foreach ($products as $product) {
                    $products_out[] = $product;
                }
            }
            $products_out = $products_out->unique('id');
            return ProductResource::collection($products_out)->toJson();
        } else {
            $category = Category::find($id);
            $products =  $category->products()->get();
            return ProductResource::collection($products)->toJson();
        }
    }

    public function index(Request $request)
    {
        if ($request->includeProducts == 1) {
            $categories = Category::all();
            $out = [];
            foreach ($categories as $category) {
                if ($category->products()->count()) {
                    $out[] = $category;
                }
            }
            return CategoryResource::collection($out)->toJson();
        } else {
            $categories = Category::all();
            return CategoryResource::collection($categories)->toJson();
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator->messages();
        } else {
            $category = Category::create([
                'name' => $request->name,
                'parent_id' => $request->parent_id
            ]);

            return [
                'status' => true,
                'category' => $category
            ];
        }
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return ['status' => false, 'message' => 'Категория не найдена'];
        } else {
            return $category;
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->messages();
        } else {
            $category->name =  $request->name;
            $category->parent_id =  $request->parent_id;
            $category->save();

            return [
                'status' => true,
                'category' => $category
            ];
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->products()->detach();
        $category->delete();

        return [
            'status' => true
        ];
    }
}
