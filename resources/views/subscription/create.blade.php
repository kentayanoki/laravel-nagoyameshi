@extends('layouts.app')

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripeKey = "{{ env('STRIPE_KEY') }}";
    </script>
    <script src="{{ asset('/js/stripe.js') }}"></script>
@endpush

@section('content')
                <nav class="my-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('mypage') }}">ホーム</a></li>
                        <li class="breadcrumb-item active" aria-current="page">有料プラン登録</li>
                    </ol>
                </nav>
                
<div class="container nagoyameshi-container pb-5">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8">

                <h1 class="mb-3 text-center">有料プラン登録</h1>

                @if (session('subscription_message'))
                    <div class="alert alert-info" role="alert">
                        <p class="mb-0">{{ session('subscription_message') }}</p>
                    </div>
                @endif

                <hr class="mb-4">

                <div class="alert alert-danger nagoyameshi-card-error" id="card-error" role="alert">
                    <ul class="mb-0" id="error-list"></ul>
                </div>

                <form id="card-form" action="{{ route('subscription.store') }}" method="post">
                    @csrf
                    <input class="nagoyameshi-card-holder-name mb-3" id="card-holder-name" type="text" placeholder="カード名義人" required>
                    <div class="nagoyameshi-card-element mb-4" id="card-element"></div>
                <div class="d-flex justify-content-center">
                    <button class="btn text-white shadow-sm w-50 nagoyameshi-btn" id="card-button" data-secret="{{ $intent->client_secret }}">登録</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection