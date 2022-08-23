@extends('master')
@section('content')
    <main class="container-fluid">
        <header class="page-header">
            <div class="page-header__content d-flex">
                <a href="{{ route('home') }}" class="btn btn-primary btn-sm">Back</a>
                <h1 class="display-2" style="margin-left: 2rem">{{ $customer->first_name . ' ' . $customer->last_name }}</h1>
            </div>
        </header>
        <div class="d-flex" style="margin-top: 3rem">
            <div class="card col-6" style="margin-bottom:159px">
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
                                    {{-- @if ($customer->status == 0)
                                        <p><span class="badge badge--success">Active</span></p>
                                    @else
                                        <p><span class="badge badge--attention">Inactive</span></p>
                                    @endif --}}
                                    @if (Session::has('status_change'))
                                        <div class="alert alert-success" role="alert">
                                            {{ Session::get('status_change') }}
                                        </div>
                                    @endif
                                    <span class="ml-2">
                                        <label class="switch " for="test_mode-{{ $customer->id }}">
                                            <input class="status-switch d-none" id="test_mode-{{ $customer->id }}"
                                                @if (isset($customer->status) && $customer->status == 0) checked value="0" @else value="1" @endif
                                                name="status" customerid={{ $customer->id }} type="checkbox">
                                            <span class="slider round"></span>
                                        </label>
                                    </span>
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
                    <img src="{{ asset($customer->qr_code_svg) }}" style="width:270px">
                    <div style="margin-top: 3rem">
                        <a class="btn btn-primary btn-sm" href="{{ route('getfile', $customer->qr_code_svg) }}">Download
                            QR Code</a>
                    </div>

                </div>
                <div style="margin-top: 3rem" class="copy row">
                    <?php
                    $url = 'https://' . \Illuminate\Support\Facades\Auth::user()->name . '/a/customer/status/' . $customer->shopify_customer_id;
                    ?>
                    <div class="col-11"><input id="myInput" class="form-control text" value="{{ $url }}">
                    </div>

                    <div class="col-1">
                        <button onclick="myFunction()" class="btn btn-primary btn-sm" style="margin-top: 2px">Copy</button>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        let copyText = document.querySelector(".copy");
        copyText.querySelector("button").addEventListener("click", function() {
            let input = copyText.querySelector("input.text");
            input.select();
            document.execCommand("copy");
            alertify.success('copied!');
            // copyText.classList.add('active');
            // window.getSelection().removeAllRanges();
            // setTImeout(function() {
            //     copyText.classList.remove('active');
            // }, 2500);
        })
        // function myFunction() {
        //     /* Get the text field */
        //     var copyText = document.getElementById("myInput");
        //     /* Select the text field */
        //     copyText.select();
        //     copyText.setSelectionRange(0, 99999); /* For mobile devices */

        //     /* Copy the text inside the text field */
        //     navigator.clipboard.writeText(copyText.value);
        //     console.log(copyText.value)
        //     /* Alert the copied text */
        //     alert("Copied the text: " + copyText.value);
        // }
    </script>
    <script>
        $(document).on("change", ".status-switch", function() {
            var status = $(this).is(':checked') == true ? 0 : 1;
            var customer_id = $(this).attr('customerid');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/changeStatus',
                data: {
                    'status': status,
                    'customer_id': customer_id
                },
                success: function(response) {
                    alertify.success(response);
                }
            });
        })
    </script>
@endsection
