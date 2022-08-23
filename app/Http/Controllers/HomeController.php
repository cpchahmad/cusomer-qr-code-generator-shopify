<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $shop = Auth::user();
        $customer_data = Customer::where('user_id', Auth::user()->id);
        $search = null;
        $search = $request['search'] ?? "";
        if ($search != "") {
            $customer_data = $customer_data->whereRaw("concat(first_name, ' ', last_name) LIKE '%" . $search . "%'")->orwhere('email', 'LIKE', '%' . $search . '%');
        }
        $customer_data = $customer_data->orderBy('created_at', 'desc')->paginate(50);
        return view('index', compact('customer_data', 'search'));
    }
}
