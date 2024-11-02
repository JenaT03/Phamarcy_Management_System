<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Introduce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IntroduceController extends Controller
{
    public function show()
    {

        $introduce = Introduce::first();
        if (Auth::check() && Auth::user()->userable_type === Customer::class) {
            $customer = Customer::find(Auth::user()->userable_id);
            return view('client.home.introduce', compact('introduce', 'customer'));
        }
        return view('client.home.introduce', compact('introduce'));
    }
}
