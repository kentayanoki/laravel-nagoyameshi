@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-2">
        @component('components.sidebar', ['categories' => $categories, 'major_categories' => $major_categories])
        @endcomponent
    </div>
    <div class="col-9">
        <div class="container">
            @if ($category !== null)
                <a href="{{ route('shops.index') }}">トップ</a> > <a href="#">{{ $major_category->name }}</a> > {{ $category->name }}
                <h1>{{ $category->name }}の店舗一覧 ({{ $total_count }}件)</h1>
            @elseif ($keyword !== null)
                <a href="{{ route('shops.index') }}">トップ</a> > 店舗一覧
                <h1>"{{ $keyword }}"の検索結果 ({{ $total_count }}件)</h1>
            @else
                <a href="{{ route('shops.index') }}">トップ</a> > 店舗一覧
                <h1>店舗一覧 ({{ $total_count }}件)</h1>
            @endif
        </div>
        <div>
            Sort By
            @sortablelink('id', 'ID')
        </div>
        <div class="container mt-4">
            <div class="row w-100">
                @foreach($shops as $shop)
                <div class="col-3">
                    <a href="{{route('shops.show', $shop)}}">
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
            </div>
        </div>
        {{ $shops->links() }}
    </div>
</div>
@endsection
