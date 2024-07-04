@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-2">
        @component('components.sidebar', ['categories' => $categories, 'major_categories' => $major_categories])
        @endcomponent
    </div>
    <div class="col-9">
        <h1>イチオシ店舗</h1>
        <div class="row">
            @foreach ($categories as $category)
                @foreach ($category->shops as $shop) 
                <div class="col-4">
                    <a href="{{ route('shops.show', $shop) }}">
                        @if ($shop->image !== "")
                        <img src="{{ asset($shop->image) }}" class="img-thumbnail">
                        @else
                        <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail">
                        @endif
                    </a>
                    <div class="row">
                        <div class="col-12">
                            <p class="nagoyameshi-shop-label mt-2">
                                {{ $shop->name }}<br>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            @endforeach
        </div>
    </div>
</div>
@endsection
