<?php

namespace App\Http\Controllers;

use App\Model\Order;
use App\Model\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function sales () {
        $orders = Order::all()->sortByDesc('id');
        $users = User::select('id','name','surname') -> get();
        $total_earned = Order::all()->sum('total_cost');
        return view('reports.sales',compact('orders','users','total_earned'));
    }
    public function users () {
        $users = User::select('id','name','surname','email','country','city','address','phone_nr')->get();
        return view('reports.users',compact('users'));
    }
}
