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
                            <li class="breadcrumb-item">Daftar Laporan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Laporan</h3>
                    </div>
                    <div class="card-body">
                        <table id="reportTable" class="table table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th>Kode Lapor</th>
                                    <th>Kategori Laporan</th>
                                    <th>Nama Pelapor</th>
                                    <th>No HP Pelapor</th>
                                    <th>Nama Terlapor</th>
                                    <th>No HP Terlapor</th>
                                    <th>Status</th>
                                    <th width="5%">Action</th>
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
var reportTable;

(function($) {
    'use strict';
    $(document).ready(function() {
        reportTable = $('#reportTable').DataTable({
            iDisplayLength: 10,
            processing: true,
            serverSide: true,
            stateSave: true,
            scrollX: true,
            ajax: {
                url: "{{ route('report') }}",
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
                { data: 'kode_lapor'},
                { data: 'nama_kategori_laporan'},
                { data: 'nama_pelapor'},
                { data: 'no_hp_pelapor'},
                { data: 'nama_terlapor'},
                { data: 'no_hp_terlapor'},
                { data: 'status'},
                {
                    data: 'action',
                    orderable: false,
                },
            ],
        })
        .on('xhr.dt', function (e, settings, json, xhr) {});

    });
})(jQuery);
</script>
@endpush