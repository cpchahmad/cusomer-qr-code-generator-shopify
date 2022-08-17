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
                        <a class="" href="#">All</a>
                    </li>
                    <li class="card-header-tab">
                        <a href="{{ url('activeStatus') }}" class="">Active</a>
                    </li>
                    <li class="card-header-tab">
                        <a href="{{ url('InactiveStatus') }}" class="">Inactive</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="row no-margins card-body-section">
                    <div class="col-12">
                        <label for="select3" class="sr-only">Select 3</label>
                        <input type="text" class="form-control">
                    </div>

                </div>

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
                                                        @if (isset($customer->status) && $customer->status == 0) checked @endif value="0"
                                                        name="status" customerid={{ $customer->id }} type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </span>
                                        </td>
                                        <td>
                                            {{ $customer->created_at }}
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

            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        $(document).on("change", ".status-switch", function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var customer_id = $(this).attr('customerid');
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
