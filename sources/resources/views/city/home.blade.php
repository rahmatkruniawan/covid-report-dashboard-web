@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb p-0 mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('master') }}">Master Data</a></li>
                            <li class="breadcrumb-item">City</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <a class="btn btn-primary mb-1" title="City List" href="{{ route('city') }}"><i class="bx bx-table"></i> City List</a>
                <a class="btn btn-outline-secondary mb-1" title="Register City" href="{{ route('city.add') }}"><i class="bx bx-plus"></i> Register City</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">City Data</h3>
                    </div>
                    <div class="card-body">
                        <table id="cityTable" class="table table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th width="10%">Action</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
var cityTable;

(function($) {
    'use strict';
    $(document).ready(function() {
        cityTable = $('#cityTable').DataTable({
            iDisplayLength: 10,
            processing: true,
            serverSide: true,
            stateSave: true,
            scrollX: true,
            ajax: {
                url: "{{ route('city') }}",
                dataType: "json",
                type: "POST",
                data: function(d) {
                    d._token = "{{csrf_token()}}";
                }
            },
            columnDefs: [{
                searchable: false,
                orderable: false,
                targets: 0
            }],
            order:[[1,'desc']],
            columns: [
                {
                    data: 'action',
                    orderable: false,
                },
                { data: 'city_name'},
            ],
        })
        .on('xhr.dt', function (e, settings, json, xhr) {});

    });
})(jQuery);
</script>
@endpush