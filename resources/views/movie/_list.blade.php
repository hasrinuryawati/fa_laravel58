@foreach($movies as $movie)
    <div class="col mb-5">
        <div class="card h-100 position-relative card-hover" style="cursor: pointer;" onclick="window.location.href='{{ url('/movie/'.$movie['imdbID']) }}'">
            <img
                class="card-img-top lazyload"
                data-src="{{ $movie['Poster'] !== 'N/A' ? $movie['Poster'] : asset('images/no-image.jpg') }}"
                alt="..."
                width="100%" height="auto"
            />
            <div class="card-body p-2 pb-0">
                <div class="text-center">
                    <h5 class="fw-bolder">{{ $movie['Title'] }}</h5>
                </div>
            </div>

            @php
                $isFavorited = isset($favorites[$movie['imdbID']]);
            @endphp
            <form method="POST" action="/favorites" class="fav-form" style="display:inline;">
                {{ csrf_field() }}
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent d-flex justify-content-center">
                    <input type="hidden" name="movie_id" value="{{ $movie['imdbID'] }}">
                    <input type="hidden" name="poster" value="{{ $movie['Poster'] }}">
                    <input type="hidden" name="title" value="{{ $movie['Title'] }}">

                    <button class="btn-icon {{ $isFavorited ? 'favorited' : '' }}"
                            title="{{ $isFavorited ? 'Favorited - Click to remove' : 'Add to Favorite' }}"
                            onclick="event.stopPropagation();"
                            type="submit">
                        <i class="fa {{ $isFavorited ? 'fa-heart' : 'fa-heart-o' }}"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endforeach
