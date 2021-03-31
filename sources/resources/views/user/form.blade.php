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
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-secondary mb-1" title="User List" href="{{ route('user') }}"><i class="bx bx-table"></i> User List</a>
                <a class="btn btn-primary mb-1" title="Register User" href="{{ route('user.add') }}"><i class="bx bx-plus"></i> Register User</a>
            </div>
        </div>
        <form action="{{ ($user) ? route('user.edit', ['id' => $user->id]) : route('user.add') }}" method="POST">
        @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Create User</h3>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="name">Name <span class="text-red">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name')?? ($user->name ?? '' )}}" required/>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email <span class="text-red">*</span></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email')?? ($user->email ?? '' )}}" required/>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        @if(!$user)
                                        <div class="form-group">
                                            <label for="password">Password <span class="text-red">*</span></label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password')}}" required/>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="role">Role <span class="text-red">*</span></label>
                                            <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" @if($user && $user->customer_id) readonly @endif required>
                                                @foreach($roles as $role)
                                                @if(old('role') == $role)
                                                <option value="{{$role}}" selected>{{$role}}</option>
                                                @elseif(isset($user) && $user->role == $role)
                                                <option value="{{$role}}" selected>{{$role}}</option>
                                                @else
                                                <option value="{{$role}}">{{$role}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Process</button>
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