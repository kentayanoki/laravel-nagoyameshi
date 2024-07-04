<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::find(Auth::id());
        return view(
            'subscription.create',[
                'intent' => $user->createSetupIntent()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = User::find(Auth::id());
            $stripeCustomer = $user->createOrGetStripeCustomer();
            $paymentMethod = $request->input('stripePaymentMethod');
            $user->newSubscription('default', $plan)->create($paymentMethod);
            return redirect()->route('mypage')->with('message', '有料会員登録しました。');
        } catch (\Exception $e) {
            // 例外が発生した場合の処理
            return redirect()->back()->with('error', 'サブスクリプションの作成中にエラーが発生しました。');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)//支払い編集
    {
        $user=User::find(Auth::id());
        return view(
            'subscription.edit',[
                'intent' => $user->createSetupIntent()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)//更新
    {
        $user = User::find(Auth::id());
        $paymentMethod = $request->input('stripePaymentMethod');
        $user->updateDefaultPaymentMethod($paymentMethod);
        return redirect()->route('mypage')->with('message', '支払い方法が更新されました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)//解約
    {
        //
    }

    public function cancel(Subscription $subscription)//解約ページ
    {
       return view('subscription.cancel');
    }

}
