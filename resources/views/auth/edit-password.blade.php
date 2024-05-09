@extends('partials.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-lg">
                <div class="card-header text-white">
                    Welcome, {{ Auth::user()->name }}
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        @if (Auth::user()->image != "")
                        <img src="{{ asset('storage/uploads/profile/thumb/'.Auth::user()->image) }}" class="img-fluid rounded-circle" alt="profile_picture" style="width: 250px; height: 250px;">
                        @else
                        <img src="{{ asset('images/artist.png') }}" class="img-fluid rounded-circle" alt="avatar">
                        @endif
                    </div>
                    <div class="h5 text-center">
                        <strong>{{ Auth::user()->name }}</strong>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-lg mt-3">
                <div class="card-header text-white">
                    Navigation
                </div>
                <div class="card-body sidebar">
                    @include('partials.sidebar')
                </div>
            </div>
        </div>
        <div class="col-md-9">
            @include('partials.msg')
                <div class="col-md-9">
                    <div class="card border-0 shadow">
                        <div class="card-header  text-white">
                            Change Password
                        </div>
                        <div class="card-body">
                            <form action="{{ route('auth.updatePassword') }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="old_password" class="form-label">Old Password</label>
                                    <input type="password" class="form-control @error('old_password') is-invalid @enderror" placeholder="Old Password" name="old_password" id="old_password" />
                                    @error('old_password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" placeholder="New Password"  name="new_password" id="new_password"/>
                                    @error('new_password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Confirm Password"  name="confirm_password" id="confirm_password"/>
                                    @error('confirm_password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
