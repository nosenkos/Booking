<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function charge(Request $request){
        $start = Carbon::createFromFormat('Y-m-d', $request->start);
        $end = Carbon::createFromFormat('Y-m-d', $request->end);
        $total_price = $request->price * $start->diffInDays($end);
        dd($total_price);

        $user = auth()->user();
        $user->createAsStripeCustomer();
        $user->updateCard($request->token);
        return $user->charge(1000);
    }
}
