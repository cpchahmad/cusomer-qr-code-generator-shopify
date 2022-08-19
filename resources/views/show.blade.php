@extends('master')
@section('content')
    <main class="container-fluid">
        <header class="page-header">
            <div class="page-header__content">
                <h1 class="display-2">{{ $customer->first_name . ' ' . $customer->last_name }}</h1>
            </div>
        </header>
        <div class="d-flex" style="margin-top: 5rem">
            <div class="card col-6" style="">
                <div class="card-body">
                    <ul class="">
                        <li style="list-style-type: none">
                            <div class="row">
                                <div class="col-4">
                                    <h3>Name: </h3>
                                </div>
                                <div class="col-6">
                                    <p>{{ $customer->first_name . ' ' . $customer->last_name }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <h3>Email:</h3>
                                </div>
                                <div class="col-6">
                                    <p>{{ $customer->email }}</p>
                                </div>
                            </div>
                            <div class="row" style="margin-top:2rem">
                                <div class="col-4">
                                    <h3>Status:</h3>
                                </div>
                                <div class="col-6">
                                    {{-- <span class="ml-2">
                                        <label class="switch " for="test_mode">
                                            <input class="status-switch d-none" id="test_mode"
                                                @if (isset($customer->status) && $customer->status == 0) checked @endif value="0"
                                                name="status" customerid={{ $customer->id }} type="checkbox">
                                            <span class="slider round"></span>
                                        </label>
                                    </span> --}}
                                    @if ($customer->status == 0)
                                        <p><span class="badge badge--success">Active</span></p>
                                    @else
                                        <p><span class="badge badge--attention">Inactive</span></p>
                                    @endif
                                </div>
                            </div>
                            <div class="row" style="margin-top:2rem">
                                <div class="col-4">
                                    <h3>Created At:</h3>
                                </div>
                                <div class="col-6">
                                    <p><strong></strong>{{ $customer->created_at->isoFormat('MMM D, YYYY') }}</p>
                                </div>
                            </div>
                            <div class="row" style="margin-top:2rem">
                                <div class="col-4">
                                    <h3>Updated At:</h3>
                                </div>
                                <div class="col-6">
                                    <p><strong></strong>{{ $customer->updated_at->isoFormat('MMM D, YYYY') }}</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="" style="padding-left: 15rem">
                <div class="text-center">


                    {{-- dd() --}}
                    <img src="{{ asset($customer->qr_code_svg) }}" style="width:200px">
                    <div style="margin-top: 3rem">
                        <a class="btn btn-primary" href="{{ route('getfile', $customer->qr_code_svg) }}">Download
                            QR Code</a>
                    </div>
                </div>

                {{-- {!! QrCode::size(250)->generate('Hello!') !!} --}}

                {{-- <div class="mb-3">
                        <img src="data:image/png;base64, {!! base64_encode(
                            QrCode::format('png')->size(300)->generate('Hello..!'),
                        ) !!} ">
                    </div>
                    <a href="data:image/png;base64, {!! base64_encode(
                        QrCode::format('png')->size(300)->generate('Generate any QR Code!'),
                    ) !!} " download>Downloads</a> --}}



            </div>
        </div>
    </main>
@endsection
{{-- @section('scripts')
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
@endsection --}}
