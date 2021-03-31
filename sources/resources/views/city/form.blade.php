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
                <a class="btn btn-outline-secondary mb-1" title="City List" href="{{ route('city') }}"><i class="bx bx-table"></i> City List</a>
                <a class="btn btn-primary mb-1" title="Register City" href="{{ route('city.add') }}"><i class="bx bx-plus"></i> Register City</a>
            </div>
        </div>
        <form action="{{ ($city) ? route('city.edit', ['id' => $city->id]) : route('city.add') }}" method="POST">
        @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Create City</h3>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="name">Name <span class="text-red">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name')?? ($city->name ?? '' )}}" required/>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Process</button>
                                <a class="btn btn-outline-danger" href="{{ route('city') }}">Cancel</a>
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