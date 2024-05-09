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
                    Edit University
                </div>
                <div class="card-body">
                    <form action="{{ route('universities.update', ['university' => $university->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" value="{{ old('name', $university->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" id="name" />
                            @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" value="{{ old('address', $university->address) }}" class="form-control @error('address') is-invalid @enderror" placeholder="Address" name="address" id="address" />
                            @error('address')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Description" cols="30" rows="5">{{ old('description', $university->description) }}</textarea>
                            @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" value="{{ old('city', $university->city) }}" class="form-control @error('city') is-invalid @enderror" placeholder="City" name="city" id="city" />
                            @error('city')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="website" class="form-label">Website</label>
                            <input type="text" value="{{ old('website', $university->website) }}" class="form-control @error('website') is-invalid @enderror" placeholder="Website" name="website" id="website" />
                            @error('website')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" accept=".png, .jpeg, .jpg, .svg, .gif, .jfif" class="form-control @error('image') is-invalid @enderror" name="image" id="image" />
                            @error('image')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror

                            @if (!empty($university->image))
                                <img src="{{ asset('storage/uploads/universities/thumb/'.$university->image) }}" alt="" class="w-25 mt-3 mx-auto d-block">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="1" {{ ($university->status == 1) ? 'selected' : '' }}>Public</option>
                                <option value="0" {{ ($university->status == 0) ? 'selected' : '' }}>Private</option>
                            </select>
                            @error('status')
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
