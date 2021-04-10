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
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Breadcrumb</a></li>
                            <li class="breadcrumb-item">User</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <form action="{{ route('report.detail', ['id' => $report->id]) }}" method="POST">
        @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail Laporan</h3>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-4 col-sm-12">
                                        <h2 class="card-title"><center>Laporan</center></h2>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <h2 class="card-title"><center>Data Pelapor</center></h2>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <h2 class="card-title"><center>Data Dilaporkan</center></h2>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="kode_lapor">Kode Laporan<span class="text-red">*</span></label>
                                            <input disabled="disabled" type="text" class="form-control @error('kode_lapor') is-invalid @enderror" id="kode_lapor" name="kode_lapor" value="{{ old('kode_lapor')?? ($report->kode_lapor ?? '' )}}" required/>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_kategori_laporan">Kategori Laporan<span class="text-red">*</span></label>
                                            <input disabled="disabled" type="text" class="form-control @error('nama_kategori_laporan') is-invalid @enderror" id="nama_kategori_laporan" name="nama_kategori_laporan" value="{{ old('nama_kategori_laporan')?? ($report->nama_kategori_laporan ?? '' )}}" required/>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status Laporan<span class="text-red">*</span></label>
                                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" @if($report && $report->status) readonly @endif required>
                                                @foreach($reportStatus as $status)
                                                    @if(old('status') == $status)
                                                        <option value="{{ $status }}" selected>{{ ucfirst($status) }}</option>
                                                    @elseif(isset($report) && $report->status == $status)
                                                        <option value="{{ $status }}" selected>{{ ucfirst($status) }}</option>
                                                    @else
                                                        <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_terlapor">Deskripsi Laporan <span class="text-red">*</span></label>
                                            <input disabled="disabled" type="text" class="form-control @error('deskripsi_laporan') is-invalid @enderror" id="deskripsi_laporan" name="deskripsi_laporan" value="{{ old('deskripsi_laporan')?? ($report->deskripsi_laporan ?? '' )}}" required/>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="nama_pelapor">Nama <span class="text-red">*</span></label>
                                            <input disabled="disabled" type="text" class="form-control @error('nama_pelapor') is-invalid @enderror" id="nama_pelapor" name="nama_pelapor" value="{{ old('nama_pelapor')?? ($report->nama_pelapor ?? '' )}}" required/>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="no_hp_pelapor">Nomor HP <span class="text-red">*</span></label>
                                            <input disabled="disabled" type="text" class="form-control @error('no_hp_pelapor') is-invalid @enderror" id="no_hp_pelapor" name="no_hp_pelapor" value="{{ old('no_hp_pelapor')?? ($report->no_hp_pelapor ?? '' )}}" required/>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email_pelapor">Email <span class="text-red">*</span></label>
                                            <input disabled="disabled" type="text" class="form-control @error('email_pelapor') is-invalid @enderror" id="email_pelapor" name="email_pelapor" value="{{ old('email_pelapor')?? ($report->email_pelapor ?? '' )}}" required/>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="nama_terlapor">Terlapor <span class="text-red">*</span></label>
                                            <input disabled="disabled" type="text" class="form-control @error('nama_terlapor') is-invalid @enderror" id="nama_terlapor" name="nama_terlapor" value="{{ old('nama_terlapor')?? ($report->nama_terlapor ?? '' )}}" required/>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="no_hp_terlapor">No HP <span class="text-red">*</span></label>
                                            <input disabled="disabled" type="text" class="form-control @error('no_hp_terlapor') is-invalid @enderror" id="no_hp_terlapor" name="no_hp_terlapor" value="{{ old('no_hp_terlapor')?? ($report->no_hp_terlapor ?? '' )}}"/>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat <span class="text-red">*</span></label>
                                            <textarea disabled="disabled" type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat')?? ($report->alamat ?? '' )}}" required/>{{ old('alamat')?? ($report->alamat ?? '' )}} {{ $report->kecamatan }}, {{ $report->kabupaten }} - {{ $report->provinsi }}</textarea>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="no_hp_terlapor">Link Google Maps <span class="text-red">*</span></label>
                                            <a target="_blank" href="https://maps.google.com/maps/place/{{$report->latitude}},{{$report->longitude}}">Lihat Lokasi Disini</a>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Update Laporan</button>
                                <a class="btn btn-outline-danger" href="{{ route('user') }}">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript">
(function($) {
    'use strict';
    $(document).ready(function() {
    });
})(jQuery);
</script>
@endsection