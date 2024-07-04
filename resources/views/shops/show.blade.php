@extends('layouts.app')
 
@section('content')

<div class="d-flex justify-content-center">
    <div class="row w-75">
        <div class="col-5 offset-1">
            @if ($shop->image !== "")
                <img src="{{ asset($shop->image) }}" class="img-thumbnail">
                @else
                <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail">
            @endif
        </div>
        <div class="col">
            <div class="d-flex flex-column">
                <h1 class="">
                    {{$shop->name}}
                </h1>
                <p class="">
                    {{$shop->description}}
                </p>
            </div>
            @auth

            <div class="form-group text-center">       
                <a href="{{ route('reservation.create', ['store_id' => $shop->id]) }}" class="mt-3 btn nagoyameshi-submit-button">
                    予約する
                </a>
            </div><hr>

            <form method="POST" class="m-3 align-items-end">
                @csrf
                <input type="hidden" name="id" value="{{$shop->id}}">
                <input type="hidden" name="name" value="{{$shop->name}}">
                <input type="hidden" name="image" value="{{$shop->image}}">
                <input type="hidden" name="weight" value="0">
                <div class="row">
                    </div>
                        @if(Auth::user()->favorite_shops()->where('shop_id', $shop->id)->exists())
                            <a href="{{ route('favorites.destroy', $shop->id) }}" class="btn nagoyameshi-favorite-button text-favorite w-100" onclick="event.preventDefault(); document.getElementById('favorites-destroy-form').submit();">
                                <i class="fa fa-heart"></i>
                                お気に入り解除
                            </a>
                            @else
                            <a href="{{ route('favorites.store', $shop->id) }}" class="btn nagoyameshi-favorite-button text-favorite w-100" onclick="event.preventDefault(); document.getElementById('favorites-store-form').submit();">
                                <i class="fa fa-heart"></i>
                                お気に入り
                            </a>
                        @endif
                    </div>
                </div>
            </form>
            <form id="favorites-destroy-form" action="{{ route('favorites.destroy', $shop->id) }}" method="POST" class="d-none">
                @csrf
                @method('DELETE')
            </form>
            <form id="favorites-store-form" action="{{ route('favorites.store', $shop->id) }}" method="POST" class="d-none">
                @csrf
            </form>
            @endauth
        </div>
 
        <div class="offset-1 col-11">
            <hr class="w-100">
            <h3 class="float-left">カスタマーレビュー</h3>
        </div>

        <div class="offset-1 col-10">
            <div class="row">
                @foreach($reviews as $review)
                <div class="offset-md-5 col-md-5">
                    <h3 class="review-score-color">{{ str_repeat('★', $review->score) }}</h3>
                    <p class="h3">{{$review->title}}</p>
                    <p class="h3">{{$review->content}}</p>
                    <label>{{$review->created_at}} {{$review->user->name}}</label>
                </div>
                @endforeach
            </div><br />

            @auth
            <div class="row">
                <div class="offset-md-5 col-md-5">
                    <form method="POST" action="{{ route('reviews.store') }}">
                        @csrf
                        <h4>評価</h4>
                            <select name="score" class="form-control m-2 review-score-color">
                                <option value="5" class="review-score-color">★★★★★</option>
                                <option value="4" class="review-score-color">★★★★</option>
                                <option value="3" class="review-score-color">★★★</option>
                                <option value="2" class="review-score-color">★★</option>
                                <option value="1" class="review-score-color">★</option>
                            </select>
                        <h4>タイトル</h4>
                        @error('title')
                            <strong>タイトルを入力してください</strong>
                        @enderror
                        <input type="text" name="title" class="form-control m-2">
                        <h4>レビュー内容</h4>
                        @error('content')
                            <strong>レビュー内容を入力してください</strong>
                        @enderror
                        <textarea name="content" class="form-control m-2"></textarea>
                        <input type="hidden" name="shop_id" value="{{$shop->id}}">
                        <button type="submit" class="btn nagoyameshi-submit-button ml-2">レビューを追加</button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </div>
</div>
@endsection
