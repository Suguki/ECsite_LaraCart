<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Cart;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $stocks = Stock::Paginate(6);
        return view('shop', compact('stocks'));
    }

    public function myCart(Cart $cart)
    {
        $data = $cart->showCart();
        return view('myCart', $data);
    }

    public function post(Request $request, Cart $cart)
    {

        $stock_id = $request->stock_id;
        $message = $cart->post($stock_id);

        $data = $cart->showCart();

        return view('myCart', $data)->with('message', $message);

    }

    public function deleteCart(Request $request, Cart $cart)
    {
        $stock_id = $request->stock_id;
        $message = $cart->deleteCart($stock_id);

        $data = $cart->showCart();

        return view('myCart', $data)->with('message', $message);
    }

    public function checkout(Cart $cart){
        $checkout_info = $cart->checkoutCart();

        return view('checkout');
    }
}
