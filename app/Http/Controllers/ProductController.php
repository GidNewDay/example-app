<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Product;
use function Pest\Laravel\put;

class ProductController extends Controller
{
    //Получение всех товаров
    function get_products()
    {
        $products = Product::all();
        return view('shop', ["products"=> $products] );
    }

    //Бестселлеры
    function bestsellers()
    {
        $bestsellers = Product::all()->where('price', '<', 120);
        return view('home', ["bestsellers" => $bestsellers] );
    }

    //Карточка товара
    function product_single($id)
    {
        $product = Product::where('id', $id)->get();
        return view('product-single', ["product" => $product]);
    }

    //Добавление товара (Через Админпанель)
    public function insert(Request $request){
        $product_name = $request->input('product_name');
        $price = $request->input('price');
        $description = $request->input('description');
        $size = $request->input('size');
        $preview = $request->input('preview');
        $category = $request->input('category_id');
        $data=array('product_name'=>$product_name,"price"=>$price,"description"=>$description,"size"=>$size,"preview"=>$preview,"category_id"=>$category);
        DB::table('products')->insert($data);
        echo "Товар добавлен.<br/>";
        echo 'Можете <a href = "/dashboard">перейти в админ панель</a>.';
    }

    //Добавление товара в корзину
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "product_name" => $product->product_name,
                "description"=> $product->description,
                "size"=>$product->size,
                "price" => $product->price,
                "image" => $product->preview,
                "category_id"=>$product->category,
                "quantity" => 1
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Товар успешно добавлен в корзину!');
    }

    //Удаление товара из корзины
    public function remove(Request $request){
        if ($request->id){
            $cart = session()->get('cart');
            if (isset($cart[$request->id])){
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', "Товар удален из корзины!");
        }
    }

    //Редактирование количества товара в корзине
    public function update(Request $request){
        if ($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', "Корзина успешно обновлена");
        }
    }
}
