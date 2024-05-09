@extends('partials.app')

@section('content')
<div class="container mt-3 ">
    <div class="row justify-content-center d-flex mt-5">
        <div class="col-md-12">
            <a href="{{  route('universities.list')  }}" class="text-decoration-none text-dark ">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp; <strong>Back to Universities</strong>
            </a>
            <div class="row mt-4">
                <div class="col-md-4">
                    @if ($university->image != '')
                    <img src="{{ asset('storage/uploads/universities/thumb/' . $university->image) }}" alt="{{ $university->name }}" class="card-img-top">
                    @else
                    <img src="https://placehold.co/990x1400/000000/FFFFFF/png?text=No Image" alt="" class="card-img-top">
                    @endif
                </div>
                <div class="col-md-8">
                    <h3 class="h2 mb-3">{{ $university->name  }}</h3>
                    <div class="h4 text-muted">{{ $university->address  }}</div>
                    <div class="h6">
                        <a class="icon-link icon-link-hover" href="{{ $university->website }}">
                            Website link
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.248 19C3.22 15.77 5.275 8.232 12.466 8.232V6.079a1.025 1.025 0 0 1 1.644-.862l5.479 4.307a1.108 1.108 0 0 1 0 1.723l-5.48 4.307a1.026 1.026 0 0 1-1.643-.861v-2.154C5.275 13.616 4.248 19 4.248 19Z"/>
                            </svg>
                        </a>
                    </div>
                    <div class="star-rating d-inline-flex ml-2" title="">
                        <span class="rating-text theme-font theme-yellow">{{ $averageRating }}</span>
                        <div class="star-rating d-inline-flex mx-2" title="">
                            <div class="back-stars ">
                                <i class="fa fa-star " aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>

                                <div class="front-stars" style="width: {{ $averageRating * 20 }}%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <span class="theme-font text-muted">({{ $averageRating }} Review)</span>
                    </div>

                    <div class="content mt-3">
                        <p>{{ $university->description  }}</p>
                    </div>

                    <div class="col-md-12 pt-2">
                        <hr>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h2 class="h3 mb-4">Similar Types</h2>
                        </div>
                        @if ($relatedUniversities->isNotEmpty())
                        @foreach ($relatedUniversities as $relatedUniversity)
                        <div class="col-md-4 col-lg-4 mb-4">
                            <div class="card border-0 shadow-lg">
                                <a href="{{ route('universities.show', $relatedUniversity->id) }}">
                                    @if ($relatedUniversity->image != '')
                                    <img src="{{ asset('storage/uploads/universities/thumb/' . $relatedUniversity->image) }}" alt="{{ $relatedUniversity->name }}" class="card-img-top">
                                    @else
                                    <img src="https://placehold.co/990x1400/000000/FFFFFF/png?text=No Image" alt="" class="card-img-top">
                                    @endif
                                </a>
                                <div class="card-body">
                                    <h3 class="h4 heading"><a href="{{ route('universities.show', $relatedUniversity->id) }}"">{{ $relatedUniversity->name }}</a></h3>
                                    <p>{{ $relatedUniversity->address }}</p>
                                    <div class="star-rating d-inline-flex ml-2" title="">
                                        <span class="rating-text theme-font theme-yellow">{{ $relatedUniversity->averageRating }}</span>
                                        <div class="star-rating d-inline-flex mx-2" title="">
                                            <div class="back-stars ">
                                                <i class="fa fa-star " aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>

                                                <div class="front-stars" style="width: {{ $relatedUniversity->averageRating * 20 }}%">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="theme-font text-muted">({{ $relatedUniversity->averageRating }} Review)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="col-md-12 pt-2">
                        <hr>
                    </div>
                    <div class="row pb-5">
                        <div class="col-md-12  mt-4">
                            <div class="d-flex justify-content-between">
                                <h3>Reviews</h3>
                                <div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropReview">
                                        Add Review
                                    </button>

                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdropRate">
                                        Add Note
                                    </button>
                                </div>
                            </div>

                            @if ($university->comments->isNotEmpty())
                                @foreach ($university->comments as $comment)
                                <div class="card border-0 shadow-lg my-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="mb-3">{{  Auth::user()->name  }}</h4>
                                                <span class="text-muted">{{  Auth::user()->created_at->format('d/m/y')  }}</span>
                                        </div>
                                        <div class="content">
                                            <p>{{ $comment->content }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="text-center text-danger my-5">Comment not found</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade " id="staticBackdropReview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Review for <strong>{{ $university->name  }}</strong></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('partials.msg')
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('comments.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="university_id" value="{{ $university->id }}">
                        <label for="content" class="form-label">Review</label>
                        <textarea name="comment" id="content" class="form-control @error('content') is-invalid @enderror" cols="5" rows="5" placeholder="Enter your comment here...." required>{{ old('comment') }}</textarea>
                        @error('content')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Commit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade " id="staticBackdropRate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Review for <strong>{{ $university->name  }}</strong></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('partials.msg')
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('ratingsCriterias.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        @foreach($criteria as $criterion)
                        <div class="mb-3">
                            <label for="criteria_{{ $criterion->id }}" class="form-label">{{ $criterion->name }}</label>
                            <select id="criteria_{{ $criterion->id }}" name="ratings[{{ $criterion->id }}]" class="form-select @error('ratings[{{ $criterion->id }}]') is-invalid @enderror" required>
                                <option value="">Give a mark</option>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            @error('ratings[{{ $criterion->id }}]')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        @endforeach
                        <input type="hidden" name="university_id" value="{{ $university->id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">commit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
