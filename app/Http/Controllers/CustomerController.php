<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CustomerController extends Controller
{
    public function customer_sync()
    {
        try {
            $shop = Auth::user();
            // dd($shop);
            $response = $shop->api()->rest('GET', '/admin/customers.json');
            if ($response['errors'] == false) {
                $customers = $response['body']['customers'];
                foreach ($customers as $customer_check) {
                    $this->customerCreateUpdate($customer_check, $shop);
                }
                return Redirect::tokenRedirect('home', ['notice' => 'customer Sync successfully!']);
            }
            return Redirect::tokenRedirect('home', ['error', 'customer sync failed!']);
            // return redirect()->back()->with('error', 'Customer sync failed!');
        } catch (Exception $exception) {
            dd($exception->getMessage());
            return Redirect::tokenRedirect('home', ['error', 'customer sync failed!']);
        }
    }
    public function customerCreateUpdate($customer_check, $shop)
    {

        $customer = Customer::where('user_id', $shop->id)->where('shopify_customer_id', $customer_check->id)->first();
        if ($customer === null) {
            $customer = new Customer();
        }
        $qr_code_svg =  QrCode::size(200)->generate('Hello!');
        if (isset($qr_code_svg) && $customer->qr_code_svg == null) {
            $customer->qr_code_svg = $qr_code_svg;
        }
        $customer->shopify_customer_id = $customer_check->id;
        $customer->user_id = $shop->id;
        $customer->first_name = $customer_check->first_name;
        $customer->last_name = $customer_check->last_name;
        $customer->email = $customer_check->email;
        $customer->created_at = $customer_check->created_at;
        $customer->updated_at = $customer_check->updated_at;
        $customer->save();
    }
    public function show($id)
    {
        $customer = Customer::where('id', $id)->first();
        return view('show', compact('customer'));
    }

    public function status(Request $request)
    {
        $customer = Customer::find($request->customer_id);
        $customer->status = $request->status;
        $customer->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
    public function active()
    {
        $shop = Auth::user();
        $customer_data = Customer::where('user_id', Auth::user()->id)->where('status', '=', 0)->get();
        return view('index', compact('customer_data'));
    }
    public function Inactive()
    {
        $shop = Auth::user();
        $customer_data = Customer::where('user_id', Auth::user()->id)->where('status', '=', 1)->get();
        return view('index', compact('customer_data'));
    }
}
