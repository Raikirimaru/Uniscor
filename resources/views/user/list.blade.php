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
            <div class="card border-0 shadow">
                <div class="card-header text-white">
                    Users List
                </div>
                <div class="card-body pb-0">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="col-6">
                                <form action="" method="get">
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ Request::get('keyword') }}" name="keyword" placeholder="Search..." aria-label="Search" aria-describedby="button-addon2">
                                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Clear</a>
                                    </div>
                                </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th width="150">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users->isNotEmpty())
                                    @foreach ($users as $user)
                                    <tr>
                                        <td class="align-middle">{{ $user->id }}</td>
                                        <td class="align-middle">
                                            @if ($user->image)
                                            <img src="{{ asset('storage/uploads/profile/thumb/' . $user->image) }}" alt="{{ $user->name }}" class="img-fluid rounded-circle" style="max-width: 50px; max-height: 50px;">
                                            @else
                                            No Image
                                            @endif
                                        </td>
                                        <td class="align-middle">{{ $user->name }}</td>
                                        <td class="align-middle">{{ $user->email }}</td>
                                        <td class="align-middle">
                                            @if ($user->role == 'admin')
                                            <span class="badge rounded-pill text-bg-info d-inline">Admin</span>
                                            @else
                                            <span class="badge rounded-pill text-bg-success d-inline">User</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            @if (Auth::user()->role == 'admin')
                                            <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to remove this user ?')"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="6"  class="text-center">Users not found</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @if ($users->isNotEmpty())
                        {{ $users->links() }}
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection
