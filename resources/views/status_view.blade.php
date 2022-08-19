<main class="container-fluid">
    <header class="page-header">
        <div class="page-header__content">
        </div>
    </header>
    <div class="d-flex" style="margin-top: 5rem">
        <div class="card col-8" style="">
            <div class="card-body">
                <ul class="">
                    <li style="list-style-type: none">
                        <div class="" style="display: flex">
                            <div class="">
                                <h3>Name: </h3>
                            </div>
                            <div class="" style="margin-left:10rem;">
                                <h3>{{ $data->first_name . ' ' . $data->last_name }}</h3>
                            </div>
                        </div>
                        <div style="margin-top:2rem;display:flex">
                            <div>
                                <h3>Status:</h3>
                            </div>
                            <div style="margin-left: 10rem">
                                {{-- <span class="ml-2">
                                        <label class="switch " for="test_mode">
                                            <input class="status-switch d-none" id="test_mode"
                                                @if (isset($customer->status) && $customer->status == 0) checked @endif value="0"
                                                name="status" customerid={{ $customer->id }} type="checkbox">
                                            <span class="slider round"></span>
                                        </label>
                                    </span> --}}
                                @if ($data->status == 0)
                                    <p><span class="badge badge--success">Active</span></p>
                                @else
                                    <p><span class="badge badge--attention" style="">Inactive</span></p>
                                @endif
                            </div>
                        </div>

                    </li>
                </ul>
            </div>
        </div>


    </div>
</main>
