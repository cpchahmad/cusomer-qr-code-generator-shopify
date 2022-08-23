@extends('master')
@section('content')
    <main class="container-fluid">
        <header class="page-header" style="display: flex;padding:1rem">
            <div class="page-header__content">
                <h1 class="display-2">Customers</h1>
            </div>
            <div style="margin-left:75rem">
                <a href="{{ url('syncCustomer') }}" class="btn btn-primary">Customer Sync</a>
            </div>
        </header>

        <div class="card">
            <div class="card-header-actions">
                <ul class="card-header-tabs">
                    <li class="card-header-tab">
                        <a class="" href="{{ route('home') }}">All</a>
                    </li>
                    <li class="card-header-tab">
                        <a href="{{ url('activeStatus') }}" class="">Active</a>
                    </li>
                    <li class="card-header-tab">
                        <a href="{{ url('InactiveStatus') }}" class="">Inactive({{ $customer_data->total() }})</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <form action="{{ route('home') }}">
                    <div class="row no-margins card-body-section">
                        <div class="col-9">
                            <label for="select3" class="sr-only">Select 3</label>
                            <input type="search" class="form-control" name="search" placeholder="Search by name or email"
                                value="{{ $search }}">
                        </div>
                        <div class="col-3">
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
                            @if ($customer_data->count())
                                @foreach ($customer_data as $key => $customer)
                                    <tr>
                                        <td>
                                            <label for="check1-{{ $key }}" class="polaris-check">
                                                <input type="checkbox" name="check1" id="check1-{{ $key }}">
                                                <span><span class="sr-only">Select Item</span></span>
                                            </label>
                                        </td>
                                        <td><a
                                                href="{{ url('customer_detail/' . $customer->id) }}">{{ $customer->first_name . ' ' . $customer->last_name }}</a>
                                        </td>

                                        <td>{{ $customer->email }}</td>
                                        <td>
                                            <span class="ml-2">
                                                <label class="switch " for="test_mode-{{ $key }}">
                                                    <input class="status-switch d-none" id="test_mode-{{ $key }}"
                                                        @if (isset($customer->status) && $customer->status == 0) checked value="0" @else value="1" @endif
                                                        name="status" customerid={{ $customer->id }} type="checkbox">
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
                    @if ($customer_data->count())
                        <div style="max-width:100%">
                            {!! $customer_data->links() !!}
                        </div>
                        <b>
                            Records {{ $customer_data->firstItem() }} - {{ $customer_data->lastItem() }} of
                            {{ $customer_data->total() }} (for page {{ $customer_data->currentPage() }} )
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
            var status = $(this).is(':checked') == true ? 0 : 1;
            var customer_id = $(this).attr('customerid');
            console.log('ali')
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/changeStatus',
                data: {
                    'status': status,
                    'customer_id': customer_id
                },
                success: function(data) {
                    console.log(data.success)
                }
            });
        })
    </script>
@endsection
