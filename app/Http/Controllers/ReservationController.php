<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ShopController;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $reservations = Reservation::where('user_id', Auth::id())->get();
        
        return view('reservation.index', compact('reservations'));
    }

    public function create($shop_id)
    {
        $shop = Shop::findOrFail($shop_id);

        if (!Auth::user()->subscription('default')) {
            return redirect()->route('subscription.create')->with('message', '予約機能は有料会員限定です。');
        }

        return view('reservation.create', compact('shop'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reserved_at' => 'required|date|after:now',
            'member' => 'required|integer|min:1',
        ]);

        $reservation = new Reservation();
        $reservation->user_id = Auth::id();
        $reservation->shop_id = $request->shop_id;
        $reservation->reserved_at = $request->reserved_at;
        $reservation->member = $request->member;
        $reservation->save();

        return redirect()->route('reservation.index')->with('success', 'Reservation created successfully.');
    }
}
