@extends('master')
@section('style')
    <style>
        .custom-link {
            border-bottom: 2px solid rgb(14, 4, 36) !important;
            border-radius: 0px !important;
        }

        .alertify-notifier {
            color: white
        }

        a:hover {
            border: none
        }
    </style>
@endsection
@section('content')
    <main class="container-fluid">
        <header class="page-header" style="display: flex;padding:1rem">
            <div class="row w-100">
                <div class="page-header__content col-md-6">
                    <h1 class="display-2">Customers</h1>
                </div>
                <div style="" class="col-md-6">
                    <a href="{{ url('syncCustomer') }}" class="btn btn-primary" style="float: right">Customer Sync</a>
                </div>
            </div>
        </header>

        <div class="card">
            <div class="card-header-actions">
                <ul class="card-header-tabs">
                    <li class="card-header-tab">
                        <a class="{{ request()->is('/') ? 'custom-link' : '' }}"
                            href="{{ route('home') }}">All({{ $customer_data->total() }})</a>
                    </li>
                    <li class="card-header-tab">
                        <a href="{{ url('activeStatus') }}"
                            class="{{ request()->is('activeStatus') ? 'custom-link' : '' }}">Active({{ $customer_active->total() }})</a>
                    </li>
                    <li class="card-header-tab">
                        <a href="{{ url('InactiveStatus') }}"
                            class="{{ request()->is('InactiveStatus') ? 'custom-link' : '' }}">Inactive({{ $customer_Inactive->total() }})</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <form action="{{ route('home') }}">
                    <div class="row no-margins card-body-section">
                        <div class="col-10">
                            <label for="select3" class="sr-only">Select 3</label>
                            <input type="search" class="form-control" name="search" placeholder="Search by name or email"
                                value="{{ $search }}">
                        </div>
                        <div class="col-2" style="margin-top: 3px;">
                            <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                            @if (isset($search) && !empty($search))
                                <a href="{{ route('home') }}" class="ml-3 btn btn-sm btn-danger">Reset</a>
                            @endif
                        </div>
                        {{-- @if (isset($search))
                            <a href="{{ route('home') }}" class="ml-3 btn btn-danger">Reset</a>
                        @endif --}}

                    </div>
                </form>

                <div class="card-body-section table-responsive-wrapper">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <label for="checkAll" class="polaris-check">
                                        <input type="checkbox" name="checkAll" id="checkAll">
                                        <rsspan><span class="sr-only"></span></span>
                                    </label>
                                </th>
                                <th scope="col" class="sort">
                                    Name
                                </th>

                                <th scope="col" class="sort">
                                    Email
                                </th>
                                <th scope="col" class="sort">
                                    Status
                                </th>
                                <th scope="col" class="sort">
                                    Created_at
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @if ($customer_active->count())
                                @foreach ($customer_active as $key => $customer)
                                    <tr>
                                        <td>
                                            <label for="check1-{{ $key }}" class="polaris-check">
                                                <input type="checkbox" name="check1" id="check1-{{ $key }}">
                                                <span><span class="sr-only">Select Item</span></span>
                                            </label>
                                        </td>
                                        <td style="text-transform: capitalize"><a
                                                href="{{ url('customer_detail/' . $customer->id) }}">{{ $customer->first_name . ' ' . $customer->last_name }}</a>
                                        </td>

                                        <td>{{ $customer->email }}</td>
                                        <td>
                                            <span class="ml-2">
                                                <label class="switch " for="test_mode-{{ $key }}">
                                                    <input class="status-switch d-none" id="test_mode-{{ $key }}"
                                                        @if (isset($customer->status) && $customer->status == 'enabled') checked value="enabled" @else value="disabled" @endif
                                                        name="status" customerid={{ $customer->id }}
                                                        shopifyid={{ $customer->shopify_customer_id }} type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </span>
                                        </td>
                                        <td>
                                            {{ $customer->created_at->isoFormat('MMM D, YYYY') }}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="td-text-center">
                                    <td colspan="8" class="text-center">
                                        -- No Product Data Found
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div style="padding-left:35rem; margin-top:30px; ">
                    @if ($customer_active->count())
                        <div style="max-width:100%">
                            {!! $customer_active->links() !!}
                        </div>
                        <b>
                            Records {{ $customer_active->firstItem() }} - {{ $customer_active->lastItem() }} of
                            {{ $customer_active->total() }} (for page {{ $customer_active->currentPage() }} )
                        </b>
                        {{-- <p>showing records {{ $customers_data->count() }} from {{ $customers_data->total() }}</p> --}}
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        $(document).on("change", ".status-switch", function() {
            var status = $(this).is(':checked') == true ? 'enabled' : 'disabled';
            var customer_id = $(this).attr('customerid');
            var shopify_id = $(this).attr('shopifyid');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/changeStatus',
                data: {
                    'status': status,
                    'customer_id': customer_id,
                    'shopify_id': shopify_id,
                    'shop': "textglobal-testing-abdullah-store.myshopify.com",
                },
                success: function(response) {
                    alertify.success(response);
                }
            });
        })
    </script>
@endsection
