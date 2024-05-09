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
                    Criterions
                </div>
                <div class="card-body pb-0">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="col-6">
                            <a href="{{ route('criterias.create') }}" class="btn btn-primary me-3">Add Criterion</a>
                        </div>
                        <div class="col-6">

                                <form action="" method="get">
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ Request::get('keyword') }}" name="keyword" placeholder="Search..." aria-label="Search" aria-describedby="button-addon2">
                                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                                        <a href="{{ route('criterias.index') }}" class="btn btn-secondary">Clear</a>
                                    </div>
                                </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th width="60">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($criteria->isNotEmpty())
                                    @foreach ($criteria as $c)
                                    <tr>
                                        <td class="align-middle">{{ $c->name }}</td>
                                        <td class="align-middle">{{ $c->description }}</td>
                                        <td class="align-middle d-flex justify-content-center align-items-center">
                                            <a href="{{ route('criterias.edit', ['criteria' => $c->id]) }}" class="btn btn-primary btn-sm mx-1"><i class="fa-regular fa-pen-to-square"></i></a>
                                            @if (Auth::user()->role == 'admin')
                                            <form action="{{ route('criterias.destroy', ['criteria' => $c->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm mx-1" onclick="return confirm('Are you sure to delete this criterion ?')"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="3" class="text-center">Criteria not found</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @if ($criteria->isNotEmpty())
                        {{ $criteria->links() }}
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection
