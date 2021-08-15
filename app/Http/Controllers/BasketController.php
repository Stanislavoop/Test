<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket(Request $request) {
            // Получаем корзину из куки, если есть
            $basket_id = $request->cookie('basket_id');

            if (!empty($basket_id)) {
                $products = Basket::findOrFail($basket_id)->products;

                $allCat = Category::all();
                // Добавляем категории к товарам
                foreach ($products as $k => $product) {
                    foreach ($allCat as $kCat => $valCat){
                        if($product->category_id == $valCat->id){
                            $product->catCode = $valCat->code;
                        }
                    }
                }

                return view('cart.basket', [
                    'products' => $products
                ]);
            } else {
                return view('cart.none');
            }
    }

    public function order() {
        return view('cart.order');
    }


    //Добавляет товар $id в корзину
    public function add(Request $request) {
        if($request->ajax()) {
            if (Auth::check()) {
                $user = Auth::user()->id;
            }

            $basket_id = $request->cookie('basket_id');
            $quantity = $request->count ?? 1;
            if (empty($basket_id)) {
                // если корзины нет, то создаем объект
                $basket = Basket::create();
                // для записи в cookie
                $basket_id = $basket->id;
            } else {
                // корзина есть, получаем её
                $basket = Basket::findOrFail($basket_id);
                // обновляем поле updated_at
                $basket->touch();
            }
            if ($basket->products->contains($request->id)) {
                // если такой товар есть в корзине — изменяем кол-во
                $pivotRow = $basket->products()->where('product_id', $request->id)->first()->pivot;
                $quantity = $pivotRow->quantity + $quantity;
                $pivotRow->update(['quantity' => $quantity]);
            } else {
                // нет товара, добавляем
                $basket->products()->attach($request->id, ['quantity' => $quantity]);
                if ($user) {
                    $basket->user_id = $user;
                    $basket->save();
                }
            }
            // выполняем редирект обратно
            $cookie = cookie('basket_id', $basket_id, 525600);
            return response('true')->cookie($cookie);
        }
    }
}
