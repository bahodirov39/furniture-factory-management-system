<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == "client") {
            $user = Order::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->limit(1)->first();
            return redirect()->route('order.view', ['id'=>$user]);
        }else{
            return redirect()->route('index');
        }
    }
}
