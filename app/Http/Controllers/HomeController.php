<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        $shop = Auth::user();
        $customer_data = Customer::where('user_id', Auth::user()->id)->get();
        return view('index', compact('customer_data'));
    }
}
