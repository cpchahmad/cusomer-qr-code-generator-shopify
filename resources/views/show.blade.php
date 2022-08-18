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
                    <?xml version="1.0" encoding="UTF-8"?>
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="200" height="200"
                        viewBox="0 0 200 200">
                        <rect x="0" y="0" width="200" height="200" fill="#ffffff" />
                        <g transform="scale(4.878)">
                            <g transform="translate(0,0)">
                                <path fill-rule="evenodd"
                                    d="M9 0L9 1L8 1L8 2L11 2L11 3L10 3L10 5L11 5L11 3L12 3L12 5L14 5L14 8L12 8L12 7L13 7L13 6L12 6L12 7L11 7L11 6L10 6L10 7L11 7L11 8L12 8L12 10L11 10L11 9L10 9L10 10L9 10L9 8L6 8L6 9L5 9L5 8L0 8L0 12L1 12L1 14L2 14L2 17L3 17L3 18L2 18L2 19L1 19L1 18L0 18L0 19L1 19L1 20L0 20L0 21L2 21L2 22L3 22L3 25L2 25L2 26L1 26L1 27L2 27L2 28L4 28L4 27L7 27L7 28L5 28L5 29L7 29L7 30L6 30L6 31L7 31L7 32L5 32L5 31L4 31L4 30L3 30L3 29L2 29L2 30L3 30L3 31L4 31L4 33L7 33L7 32L8 32L8 35L9 35L9 36L8 36L8 41L11 41L11 39L10 39L10 38L9 38L9 37L11 37L11 35L9 35L9 32L8 32L8 31L10 31L10 32L11 32L11 34L12 34L12 36L14 36L14 37L15 37L15 39L14 39L14 40L13 40L13 39L12 39L12 40L13 40L13 41L16 41L16 39L19 39L19 37L23 37L23 38L20 38L20 39L21 39L21 40L20 40L20 41L21 41L21 40L22 40L22 41L23 41L23 40L24 40L24 41L28 41L28 40L29 40L29 41L30 41L30 40L31 40L31 41L32 41L32 40L34 40L34 41L36 41L36 39L38 39L38 37L39 37L39 38L41 38L41 35L40 35L40 37L39 37L39 36L38 36L38 37L37 37L37 32L38 32L38 35L39 35L39 33L40 33L40 34L41 34L41 31L40 31L40 32L38 32L38 31L37 31L37 30L38 30L38 29L39 29L39 30L41 30L41 29L40 29L40 28L37 28L37 29L36 29L36 26L37 26L37 27L39 27L39 26L37 26L37 25L36 25L36 24L38 24L38 25L40 25L40 26L41 26L41 24L40 24L40 23L39 23L39 21L40 21L40 22L41 22L41 21L40 21L40 20L41 20L41 19L40 19L40 18L41 18L41 17L39 17L39 16L40 16L40 15L39 15L39 14L37 14L37 13L39 13L39 12L38 12L38 11L37 11L37 10L38 10L38 8L37 8L37 9L36 9L36 8L35 8L35 9L34 9L34 8L33 8L33 2L32 2L32 3L31 3L31 1L32 1L32 0L30 0L30 1L29 1L29 0L28 0L28 1L27 1L27 2L26 2L26 3L25 3L25 4L22 4L22 7L21 7L21 5L20 5L20 7L21 7L21 8L20 8L20 9L18 9L18 8L17 8L17 9L16 9L16 7L17 7L17 5L18 5L18 7L19 7L19 4L17 4L17 3L19 3L19 2L18 2L18 1L22 1L22 2L21 2L21 3L20 3L20 4L21 4L21 3L23 3L23 1L24 1L24 2L25 2L25 1L26 1L26 0L25 0L25 1L24 1L24 0L23 0L23 1L22 1L22 0L16 0L16 1L14 1L14 0L13 0L13 2L12 2L12 0ZM16 1L16 2L17 2L17 1ZM14 2L14 3L13 3L13 4L14 4L14 5L15 5L15 4L14 4L14 3L15 3L15 2ZM28 2L28 3L30 3L30 2ZM8 3L8 4L9 4L9 3ZM26 3L26 4L25 4L25 5L23 5L23 8L24 8L24 10L23 10L23 11L22 11L22 14L20 14L20 13L21 13L21 12L20 12L20 13L18 13L18 12L19 12L19 11L20 11L20 10L19 10L19 11L18 11L18 9L17 9L17 11L16 11L16 13L17 13L17 14L13 14L13 13L15 13L15 12L14 12L14 11L15 11L15 10L16 10L16 9L13 9L13 13L12 13L12 12L11 12L11 14L10 14L10 15L9 15L9 14L8 14L8 15L9 15L9 16L11 16L11 14L13 14L13 15L12 15L12 16L14 16L14 15L15 15L15 17L14 17L14 18L16 18L16 17L17 17L17 16L18 16L18 19L19 19L19 20L17 20L17 21L16 21L16 19L14 19L14 20L11 20L11 19L13 19L13 18L11 18L11 19L10 19L10 18L9 18L9 19L5 19L5 18L8 18L8 16L7 16L7 15L5 15L5 12L3 12L3 11L4 11L4 10L3 10L3 11L2 11L2 14L3 14L3 15L4 15L4 16L3 16L3 17L5 17L5 18L3 18L3 21L4 21L4 20L7 20L7 21L6 21L6 22L7 22L7 23L6 23L6 24L5 24L5 22L4 22L4 24L5 24L5 25L4 25L4 26L5 26L5 25L6 25L6 26L7 26L7 27L8 27L8 30L10 30L10 31L11 31L11 30L13 30L13 29L18 29L18 31L17 31L17 30L15 30L15 33L14 33L14 34L16 34L16 33L17 33L17 32L18 32L18 33L19 33L19 32L18 32L18 31L19 31L19 30L20 30L20 31L22 31L22 32L21 32L21 35L20 35L20 34L18 34L18 35L19 35L19 36L17 36L17 37L16 37L16 35L14 35L14 36L15 36L15 37L16 37L16 38L18 38L18 37L19 37L19 36L23 36L23 37L25 37L25 36L26 36L26 37L27 37L27 38L28 38L28 39L29 39L29 40L30 40L30 39L31 39L31 38L35 38L35 39L34 39L34 40L35 40L35 39L36 39L36 38L37 38L37 37L32 37L32 36L31 36L31 35L30 35L30 34L32 34L32 31L33 31L33 32L34 32L34 31L35 31L35 30L36 30L36 29L35 29L35 26L33 26L33 28L32 28L32 29L33 29L33 30L31 30L31 31L29 31L29 32L28 32L28 33L24 33L24 34L23 34L23 33L22 33L22 32L24 32L24 31L25 31L25 32L27 32L27 31L26 31L26 30L23 30L23 31L22 31L22 29L23 29L23 28L24 28L24 29L25 29L25 28L26 28L26 29L27 29L27 30L28 30L28 27L29 27L29 28L30 28L30 29L29 29L29 30L30 30L30 29L31 29L31 28L30 28L30 27L32 27L32 26L31 26L31 23L32 23L32 22L31 22L31 21L33 21L33 23L34 23L34 24L32 24L32 25L35 25L35 24L36 24L36 23L37 23L37 22L36 22L36 21L37 21L37 20L36 20L36 21L35 21L35 20L34 20L34 19L36 19L36 18L34 18L34 17L37 17L37 19L38 19L38 20L39 20L39 17L38 17L38 16L39 16L39 15L38 15L38 16L35 16L35 15L34 15L34 16L32 16L32 14L31 14L31 13L35 13L35 14L36 14L36 15L37 15L37 14L36 14L36 13L37 13L37 12L34 12L34 9L33 9L33 8L32 8L32 5L29 5L29 4L27 4L27 3ZM16 4L16 5L17 5L17 4ZM26 4L26 5L25 5L25 6L24 6L24 8L25 8L25 9L28 9L28 10L26 10L26 11L27 11L27 12L28 12L28 13L30 13L30 12L29 12L29 11L30 11L30 8L29 8L29 5L27 5L27 4ZM8 5L8 7L9 7L9 5ZM26 5L26 6L25 6L25 8L27 8L27 7L28 7L28 6L27 6L27 5ZM15 6L15 7L16 7L16 6ZM26 6L26 7L27 7L27 6ZM30 6L30 7L31 7L31 6ZM21 8L21 9L22 9L22 8ZM28 8L28 9L29 9L29 8ZM39 8L39 10L41 10L41 9L40 9L40 8ZM1 9L1 10L2 10L2 9ZM6 9L6 10L5 10L5 11L6 11L6 12L8 12L8 13L10 13L10 11L11 11L11 10L10 10L10 11L9 11L9 10L8 10L8 11L6 11L6 10L7 10L7 9ZM31 9L31 10L32 10L32 11L33 11L33 9ZM8 11L8 12L9 12L9 11ZM23 11L23 12L25 12L25 13L23 13L23 14L25 14L25 13L26 13L26 15L28 15L28 16L29 16L29 17L30 17L30 18L27 18L27 16L25 16L25 17L26 17L26 18L25 18L25 19L26 19L26 20L25 20L25 21L24 21L24 20L19 20L19 21L17 21L17 22L16 22L16 21L15 21L15 20L14 20L14 21L12 21L12 22L13 22L13 23L12 23L12 24L13 24L13 25L14 25L14 24L13 24L13 23L15 23L15 25L16 25L16 23L17 23L17 22L18 22L18 23L19 23L19 21L21 21L21 22L20 22L20 23L21 23L21 24L23 24L23 22L24 22L24 25L23 25L23 26L24 26L24 28L25 28L25 27L26 27L26 28L27 28L27 27L28 27L28 26L29 26L29 25L30 25L30 24L29 24L29 25L28 25L28 24L27 24L27 23L29 23L29 22L27 22L27 21L28 21L28 20L29 20L29 21L30 21L30 20L29 20L29 19L31 19L31 20L32 20L32 19L31 19L31 18L33 18L33 19L34 19L34 18L33 18L33 17L32 17L32 16L31 16L31 15L30 15L30 16L29 16L29 14L27 14L27 13L26 13L26 12L25 12L25 11ZM40 12L40 14L41 14L41 12ZM3 13L3 14L4 14L4 13ZM6 13L6 14L7 14L7 13ZM17 14L17 15L16 15L16 16L17 16L17 15L18 15L18 16L19 16L19 18L21 18L21 17L20 17L20 16L22 16L22 17L23 17L23 18L22 18L22 19L23 19L23 18L24 18L24 17L23 17L23 16L22 16L22 15L20 15L20 14L19 14L19 15L18 15L18 14ZM6 16L6 17L7 17L7 16ZM30 16L30 17L31 17L31 16ZM9 19L9 23L7 23L7 24L6 24L6 25L7 25L7 26L8 26L8 27L9 27L9 28L10 28L10 30L11 30L11 26L12 26L12 29L13 29L13 26L12 26L12 25L11 25L11 24L10 24L10 23L11 23L11 22L10 22L10 21L11 21L11 20L10 20L10 19ZM27 19L27 20L26 20L26 21L25 21L25 24L26 24L26 21L27 21L27 20L28 20L28 19ZM14 21L14 22L15 22L15 21ZM22 21L22 22L23 22L23 21ZM34 21L34 22L35 22L35 21ZM0 23L0 24L2 24L2 23ZM38 23L38 24L39 24L39 23ZM7 24L7 25L8 25L8 26L10 26L10 24ZM17 24L17 25L18 25L18 27L19 27L19 28L18 28L18 29L19 29L19 28L20 28L20 27L21 27L21 29L20 29L20 30L21 30L21 29L22 29L22 28L23 28L23 27L22 27L22 25L19 25L19 24ZM25 25L25 26L26 26L26 27L27 27L27 26L28 26L28 25ZM2 26L2 27L3 27L3 26ZM15 26L15 27L14 27L14 28L17 28L17 26ZM19 26L19 27L20 27L20 26ZM0 29L0 33L1 33L1 29ZM34 29L34 30L35 30L35 29ZM12 31L12 34L13 34L13 32L14 32L14 31ZM16 31L16 32L17 32L17 31ZM36 31L36 32L37 32L37 31ZM29 32L29 33L28 33L28 34L27 34L27 36L28 36L28 38L29 38L29 37L30 37L30 36L28 36L28 35L29 35L29 33L30 33L30 32ZM33 33L33 36L36 36L36 33ZM22 34L22 35L23 35L23 34ZM25 34L25 35L24 35L24 36L25 36L25 35L26 35L26 34ZM34 34L34 35L35 35L35 34ZM12 37L12 38L13 38L13 37ZM23 38L23 39L24 39L24 40L27 40L27 39L26 39L26 38ZM9 39L9 40L10 40L10 39ZM39 39L39 40L38 40L38 41L39 41L39 40L40 40L40 39ZM17 40L17 41L18 41L18 40ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM34 0L34 7L41 7L41 0ZM35 1L35 6L40 6L40 1ZM36 2L36 5L39 5L39 2ZM0 34L0 41L7 41L7 34ZM1 35L1 40L6 40L6 35ZM2 36L2 39L5 39L5 36Z"
                                    fill="#000000" />
                            </g>
                        </g>
                    </svg>


                    {{-- <img src="{{ asset($customer->qr_code_svg) }}" style="width:200px"> --}}
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
