<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Request;

class Cart extends Model
{
    protected $fillable = [
        'stock_id', 'user_id',
    ];


    public function stock()
    {
        return $this->belongsTo('App\Models\Stock');
    }

    public function showCart()
    {
        $user_id = Auth::id();
        $data['myCarts'] = $this->where('user_id', $user_id)->get();
        $data['count']=0;
        $data['sum']=0;

        foreach($data['myCarts'] as $myCart){
            $data['count']++;
            $data['sum'] += $myCart->stock->fee;
        }
        return $data;
    }

    public function post($stock_id)
    {
        $user_id = Auth::id();

        $post_info = Cart::firstOrCreate(['stock_id' => $stock_id, 'user_id' => $user_id]);
        if($post_info->wasRecentlyCreated){
            $message = 'カートに追加しました。';
        }else{
            $message = 'カートに登録済みです。';
        }
        return $message;
    }

    public function deleteCart($stock_id)
    {
        $user_id = Auth::id();
        $deleteCarts = $this->where('user_id', $user_id)->where('stock_id', $stock_id)->delete();

        if($deleteCarts > 0){
            $message = '削除完了';
        }else{
            $message = '削除失敗';
        }
        return $message;
    }

    public function checkoutCart()
    {
        $user_id = Auth::id();
        $checkout_items = $this->where('user_id', $user_id)->get();
        $this->where('user_id', $user_id)->delete();

        return $checkout_items;
    }
}
