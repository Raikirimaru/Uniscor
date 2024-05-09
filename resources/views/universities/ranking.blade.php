@extends('partials.app')

@section('content')
<div class="py-4">
    <div class="container">
        <div class="mb-4">
            <form method="GET" class="d-flex justify-content-center">
                <select id="criteria" name="criteria" onchange="this.form.submit()" class="form-select">
                    <option value="">Select the sorting criterion :</option>
                    @foreach($criteria as $criterion)
                        <option value="{{ $criterion->id }}" {{ $selectedCriterion == $criterion->id ? 'selected' : '' }}>{{ $criterion->name }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="row">
            @foreach($universities as $university)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        @if ($university->image != '')
                        <img src="{{ asset('storage/uploads/universities/thumb/' . $university->image) }}" alt="{{ $university->name }}" class="card-img-top">
                        @else
                        <img src="https://placehold.co/990x1400/000000/FFFFFF/png?text=No Image" alt="" class="card-img-top">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $university->name }}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                @foreach($university->ratings as $rating)
                                    <p><strong>{{ $rating->criteria->name }}:</strong> {{ $rating->score }} / 5</p>
                                    <div class="star-rating d-inline-flex ml-2" title="">
                                        <div class="back-stars ">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            @endfor

                                            <div class="front-stars" style="width: {{ $rating->score * 20 }}%">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $rating->score)
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    @else
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </li>
                        </ul>
                        <div class="card-footer">
                            <a href="{{ route('universities.show', $university->id) }}" class="btn btn-primary">Voir plus</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
