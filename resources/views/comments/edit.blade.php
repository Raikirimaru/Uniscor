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
                    Edit Comment
                </div>
                <div class="card-body">
                    <form action="{{ route('comments.update', ['comment' => $comment->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" placeholder="Content" cols="30" rows="3">{{ old('content', $comment->content) }}</textarea>
                            @error('content')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button class="btn btn-primary mt-2">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
