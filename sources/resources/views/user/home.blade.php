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
                            <li class="breadcrumb-item">Data Petugas</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <a class="btn btn-primary mb-1" title="Data Petugas" href="{{ route('user') }}"><i class="bx bx-table"></i> Data Petugas</a>
                <a class="btn btn-outline-secondary mb-1" title="Registrasi Petugas" href="{{ route('user.add') }}"><i class="bx bx-plus"></i> Registrasi Petugas</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Petugas</h3>
                    </div>
                    <div class="card-body">
                        <table id="userTable" class="table table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th width="10%">Action</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
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

@section('js')
<script type="text/javascript">
var userTable;

(function($) {
    'use strict';
    $(document).ready(function() {
        userTable = $('#userTable').DataTable({
            iDisplayLength: 10,
            processing: true,
            serverSide: true,
            stateSave: true,
            scrollX: true,
            ajax: {
                url: "{{ route('user') }}",
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
                { data: 'user_name'},
                { data: 'email'},
                { data: 'role'},
            ],
        })
        .on('xhr.dt', function (e, settings, json, xhr) {});

    });
})(jQuery);
</script>
@endsection