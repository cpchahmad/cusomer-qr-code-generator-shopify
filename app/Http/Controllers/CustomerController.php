<?php

namespace App\Http\Controllers;

use File;
use Imagick;
use Exception;
use App\Models\Logs;
use App\Models\User;
use SimpleXMLElement;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Image;

class CustomerController extends Controller
{
    public function customer_sync()
    {
        try {
            $shop = Auth::user();
            $response = $shop->api()->rest('GET', '/admin/customers.json');
            if ($response['errors'] == false) {
                $customers = $response['body']['customers'];

                foreach ($customers as $customer_check) {
                    // if ($key == 0) {
                    //     dd($customer_check);
                    // } else {
                    //     dd('ali');
                    // }
                    $this->customerCreateUpdate($customer_check, $shop);
                }
                return Redirect::tokenRedirect('home', ['notice' => 'customer Sync successfully!']);
            }
            return Redirect::tokenRedirect('home', ['error', 'customer sync failed!']);
        } catch (Exception $exception) {
            dd($exception->getMessage());
            return Redirect::tokenRedirect('home', ['error', 'customer sync failed!']);
        }
    }
    public function customerCreateUpdate($customer_check, $shop)
    {
        // try {

        $customer = Customer::where('user_id', $shop->id)->where('shopify_customer_id', $customer_check->id)->first();

        if ($customer === null) {
            $customer = new Customer();
        }


        $time = rand();
        if ($customer->qr_code_svg == null) {
            $img_url = $time . '.svg';
            // $url = 'https://' . \Illuminate\Support\Facades\Auth::user()->name . '/a/customer/status/' . $customer_check->id;
            $url = 'https://cartfr.myshopify.com/a/customer/status/' . $customer_check->id;
            QrCode::size(200)->generate($url, $img_url);
            $customer->qr_code_svg = $img_url;
        }
        $customer->shopify_customer_id = $customer_check->id;
        $customer->user_id = $shop->id;
        $customer->first_name = $customer_check->first_name;
        $customer->last_name = $customer_check->last_name;
        $customer->email = $customer_check->email;
        $customer->created_at = $customer_check->created_at;
        $customer->updated_at = $customer_check->updated_at;
        $customer->status = $customer_check->state;
        $customer->save();
        // } catch (Exception $exception) {
        //     $log = new Logs();
        //     $log->logs = $exception->getMessage();
        //     $log->save();
        // }
    }
    public function show($id)
    {
        $customer = Customer::where('id', $id)->first();
        return view('show', compact('customer'));
    }
    public function status(Request $request)
    {

        // $shop = User::where('name', $request->shop)->first();

        // $customer_data = [
        //     "customer" => [
        //         'state' => $request->status,
        //     ]
        // ];
        // $response = $shop->api()->rest('PUT', '/admin/customers/' . $request->shopify_id . 'json', $customer_data);
        $customer = Customer::find($request->customer_id);
        $customer->status = $request->status;
        $customer->save();
        if ($customer->status == 'enabled') {
            return response()->json('Customer status active succefully!');
        } else {
            return response()->json('Customer status Inactive!');
        }

        // alertify()->success('i am daisychained')->delay(10000)->clickToClose()->position('bottom right');
    }
    public function active()
    {
        $shop = Auth::user();
        $customer_data = Customer::where('user_id', Auth::user()->id);
        $customer_data = $customer_data->orderBy('created_at', 'desc')->paginate(50);
        $customer_Inactive = Customer::where('user_id', Auth::user()->id)->where('status', '=', 'disabled');
        $customer_Inactive = $customer_Inactive->paginate(50);
        $customer_active = Customer::where('user_id', Auth::user()->id)->where('status', '=', 'enabled');
        $search = $request['search'] ?? "";
        if ($search != "") {
            $customer_active = $customer_active->whereRaw("concat(first_name, ' ', last_name) LIKE '%" . $search . "%'")->orwhere('email', 'LIKE', '%' . $search . '%');
        }
        $customer_active = $customer_active->orderBy('created_at', 'desc')->paginate(50);
        return view('active_index', compact('customer_data', 'search', 'customer_active', 'customer_Inactive'));
    }
    public function Inactive()
    {
        $shop = Auth::user();
        $customer_data = Customer::where('user_id', Auth::user()->id);
        $customer_data = $customer_data->orderBy('created_at', 'desc')->paginate(50);
        $customer_active = Customer::where('user_id', Auth::user()->id)->where('status', '=', 'enabled');
        $customer_active = $customer_active->paginate(50);
        $customer_Inactive = Customer::where('user_id', Auth::user()->id)->where('status', '=', 'disabled');
        $search = $request['search'] ?? "";
        if ($search != "") {
            $customer_Inactive = $customer_Inactive->whereRaw("concat(first_name, ' ', last_name) LIKE '%" . $search . "%'")->orwhere('email', 'LIKE', '%' . $search . '%');
        }
        $customer_Inactive = $customer_Inactive->orderBy('created_at', 'desc')->paginate(50);
        return view('inactive_index', compact('customer_data', 'search', 'customer_Inactive', 'customer_active'));
    }
    public function getFile($filename)
    {
        $path = public_path($filename);
        return response()->download($path);
    }

    public function checkStatus($id)
    {
        $data = Customer::where('shopify_customer_id', $id)->first();
        // $html = view('status_view')->with($data)->render();
        $html = view('status_view', compact('data'))->render();
        // return response($html)->withHeaders(['Content-Type' => 'application/liquid']);
        return response($html);
    }
    public function customerDelete($customer, $shop)
    {
        $customer = Customer::where('shopify_customer_id', $customer->id)->delete();
    }


    // public function customerDeletetest()
    // {

    //     $shop = Auth::user();

    //     $query = 'mutation customerDelete($input: CustomerDeleteInput!) {
    //             customerDelete(input: $input) {
    //                 deletedCustomerId
    //                 shop {
    //                 id
    //                 }
    //                 userErrors {
    //                 field
    //                 message
    //                 }
    //             }
    //         }';

    //     $orderBeginVariables = [
    //         'input' => [
    //             'id' => 'gid://shopify/Customer/6064805871798'
    //         ]
    //     ];
    //     $orderEditBegin = $shop->api()->graph($query, $orderBeginVariables);
    //     dd($orderEditBegin);
    // }
}
