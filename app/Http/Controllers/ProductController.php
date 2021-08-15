<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // получаем товар по id из url
    public function show($category, $product_id){
        $item = Product::where('id', $product_id)->first();
        return view('product.show', [
            'item' => $item
        ]);
    }

    // получаем категорию по коду из url
    public function showCategory(Request $request, $cat_comp){
        $cat= Category::where('code', $cat_comp)->first();
        $paginateCount= 3; // колличество элементов в пагинации
        $products = Product::where('category_id', $cat->id)->paginate($paginateCount);
        if(isset($request->order)){ // сортировка товаров
            if($request->order == "price-low"){
                $products = Product::where('category_id', $cat->id)->orderBy('cost')->paginate($paginateCount);
            }
            if($request->order == "price-hight"){
                $products = Product::where('category_id', $cat->id)->orderBy('cost', 'desc')->paginate($paginateCount);
            }
            if($request->order == "nameAZ"){
                $products = Product::where('category_id', $cat->id)->orderBy('title')->paginate($paginateCount);
            }
            if($request->order == "nameZA"){
                $products = Product::where('category_id', $cat->id)->orderBy('title', 'desc')->paginate($paginateCount);
            }
        }
        if($request->ajax()){
            return view('ajax.order', [
               'products' => $products
            ])->render();
        }

        return view('categories.index', [
            'cat' => $cat,
            'products' => $products
        ]);
    }
}
