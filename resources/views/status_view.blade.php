@extends('master')
<section class="">
    <div class="card-body" style="padding-top:10rem;">
        <table class="table w-50 table-bordered table-striped " style="margin-left: 32rem;">
            <thead>
                <tr class="row" style="margin-inline:auto">
                    <th class="col-6">
                        <h3>Name</h3>
                    </th>
                    <th class="col-6" style="text-transform: capitalize">
                        <h3>{{ $data->first_name . ' ' . $data->last_name }}</h3>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="row" style="margin-inline: 0px;
    margin-block: auto;">
                    <td class="col-6" style="padding-block: 20px;">
                        <h3>Status</h3>
                    </td>
                    <td class="col-6" style="padding-block: 20px;">
                        @if ($data->status == 'enabled')
                            <p><span class="badge badge-secondary">Active</span></p>
                        @elseif ($data->status == 'disabled')
                            <p><span class="badge badge-danger" style="">Inactive</span></p>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
