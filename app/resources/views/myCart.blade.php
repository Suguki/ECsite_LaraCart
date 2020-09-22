@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="">
       <div class="mx-auto" style="max-width:1200px">
           <h1 style="color:#555555; text-align:center; font-size:1.2em; padding:24px 0px; font-weight:bold;">商品一覧</h1>
           {{ Auth::user()->name }}さんのカートの中身</h1>

           <div class="">
               <p class="text-center">{{ $message ?? '' }}</p><br>

               @if($myCarts->isNotEmpty())
               <div class="d-flex flex-row flex-wrap">

                    @foreach($myCarts as $myCart)
                     <div class="mycart_box" style="display: block;">
                        {{ $myCart->stock->name }}<br>
                        {{ number_format($myCart->stock->fee )}}円 <br>
                        <img src="/image/{{$myCart->stock->imgpath}}" alt="" class="incart" >
                        <br>

                        <form action="/deleteCart" method="post">
                            @csrf
                            <input type="hidden" name="stock_id" value="{{ $myCart->stock_id }}">
                            <input type="submit" value="削除">
                        </form>

                        <p>ユーザーID: {{ $myCart->user_id }}</p><br>
                        <p>ストックID: {{ $myCart->stock_id }}</p><br>
                     </div>
                    @endforeach

                    <div class="text-center p-2">
                       個数：{{$count}}個<br>
                       <p style="font-size:1.2em; font-weight:bold;">合計金額:{{number_format($sum)}}円</p>
                    </div>
                    <form action="/checkout" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-lg text-center buy-btn" >購入する</button>
                    </form>
                @else
                    <p class="text-center">カートは空っぽです </p>
                @endif
               </div>
               <a href="/">商品一覧へ</a>
           </div>
       </div>
   </div>
</div>
@endsection
