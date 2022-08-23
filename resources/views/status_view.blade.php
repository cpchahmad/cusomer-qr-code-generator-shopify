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
        @if ($data->status == 'disabled')
            <p><span class="badge badge--success">InActive</span></p>
        @else
            <p><span class="badge badge--attention" style="">active</span></p>
        @endif
    </div>
</div>
