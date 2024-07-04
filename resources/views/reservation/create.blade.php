@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
            @if (session('message'))
                <div class="alert alert-success mt-3">
                    {{ session('message') }}
                </div>
                    @elseif(session('error'))
                    <div class="alert alert-danger mt-3">
                        {{ session('error') }}
                </div>
            @endif
                <div class="card">
                    <div class="card-header">予約</div>
                    <div class="card-body">
                        <!-- 予約フォーム -->
                        form id="reservationForm" action="{{ route('reservation.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <div class="mb-3">
                            <label for="reserved_at" class="form-label">ご予約時間</label>
                            <input type="datetime-local" class="form-control" id="reserved_at" name="reserved_at" required>
                        </div>
                        <div class="mb-3">
                            <label for="member" class="form-label">ご利用人数</label>
                            <input type="number" class="form-control" id="member" name="member" required min="1">
                        </div>
                        <button type="submit" class="btn btn-reserve">予約</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection