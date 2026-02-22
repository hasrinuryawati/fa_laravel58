<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Movies</title>
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/movie_form/styles.css') }}" rel="stylesheet" />
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Custome Card -->
        <link href="{{ asset('css/movie_form/custom_card.css') }}" rel="stylesheet" />
        <!-- Custome Icon -->
        <link href="{{ asset('css/movie_form/custom_icon.css') }}" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5 d-flex justify-content-end align-items-center">
                <!-- My Favorite Button -->
                <form action="/favorites" method="GET" class="me-3">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="fa fa-heart-o me-1"></i>
                        {{ trans('messages.my_favorite') }}
                    </button>
                </form>

                <!-- Logout Button -->
                <form action="{{ url('logout') }}" method="GET" class="me-3">
                    <button class="btn btn-outline-danger" type="submit">
                        <i class="fa fa-sign-out me-1"></i> Logout
                    </button>
                </form>

                <!-- Language Selector -->
                <div class="text-end">
                    <span class="me-2">🌐</span>
                    <a href="/lang/en" class="me-1">🇬🇧 English</a> |
                    <a href="/lang/id" class="ms-1">🇮🇩 Indonesia</a>
                </div>
            </div>
        </nav>

        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">{{ trans('messages.movies') }}</h1>
                </div>
            </div>
        </header>

        <div class="container px-4 px-lg-5 mt-5">
            <form method="GET" action="{{ url('/') }}" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="s" class="form-control" placeholder="{{ trans('messages.search_title') }}..." value="{{ request('s') !== null && request('s') !== '' ? request('s') : 'movie' }}">
                </div>
                <div class="col-md-2">
                    <input type="number" name="y" class="form-control" placeholder="{{ trans('messages.year') }}" value="{{ request('y') }}">
                </div>
                <div class="col-md-2">
                    <select name="type" class="form-select">
                        <option value="">{{ trans('messages.all_types') }}</option>
                        <option value="movie" {{ request('type') == 'movie' ? 'selected' : '' }}>Movie</option>
                        <option value="series" {{ request('type') == 'series' ? 'selected' : '' }}>Series</option>
                        <option value="episode" {{ request('type') == 'episode' ? 'selected' : '' }}>Episode</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary w-100" type="submit">{{ trans('messages.search') }}</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ url('/') }}" class="btn btn-secondary w-100">{{ trans('messages.reset_filter') }}</a>
                </div>
            </form>
        </div>

        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                @if ($error)
                    <div class="row justify-content-center">
                        <div class="text-center">
                            <img class="mb-4 img-error img-fluid w-25" src="{{ asset('img/file-not-found.png') }}" />
                        </div>
                    </div>
                @else
                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center movie-grid">
                        @foreach($movies as $movie)
                            <div class="col mb-5">
                                <div class="card h-100 position-relative card-hover" style="cursor: pointer;" onclick="window.location.href='{{ url('/movie/'.$movie['imdbID']) }}'">
                                    <img class="card-img-top" src="{{ $movie['Poster'] !== 'N/A' ? $movie['Poster'] : asset('images/no-image.jpg') }}" alt="..." />
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
                                            <input type="hidden" name="movie_id" value="{{ $movie->imdbID }}">
                                            <input type="hidden" name="poster" value="{{ $movie->Poster }}">
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
                    </div>
                @endif
            </div>
        </section>

        <div id="toast" style="position: fixed; top: 20px; right: 20px; display: none; z-index: 9999;" class="alert alert-success">
            Added to favorites!
        </div>

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Hasri Nuryawati 2025</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('js/movie_form/scripts.js') }}"></script>

        <!-- LazySizes -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>

        <script>
            let page = 2;
            let isLoading = false;

            const query = new URLSearchParams(window.location.search);
            const search = query.get('s')?.trim() || 'movie';
            const year = query.get('y') || '';
            const type = query.get('type') || '';

            function loadMoreMovies() {
                if (isLoading) return;
                isLoading = true;

                const url = `/load-more?page=${page}&s=${encodeURIComponent(search)}&y=${year}&type=${type}`;

                fetch(url)
                    .then(res => res.text())
                    .then(html => {
                        document.querySelector(".movie-grid").insertAdjacentHTML('beforeend', html);
                        page++;
                        isLoading = false;
                    });
            }

            // Scroll Trigger
            window.addEventListener('scroll', () => {
                const scrollY = window.scrollY;
                const visible = window.innerHeight;
                const totalHeight = document.body.scrollHeight;

                if (scrollY + visible >= totalHeight - 200) {
                    loadMoreMovies();
                }
            });
        </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).on('submit', '.fav-form', function(e) {
                e.preventDefault();
                var form = $(this);
                var button = form.find('button');
                var icon = button.find('i');

                $.post(form.attr('action'), form.serialize(), function(res) {
                    if (res.favorited) {
                        icon.removeClass('fa-heart-o').addClass('fa-heart');
                        button.addClass('favorited').attr('title', 'Favorited - Click to remove');
                        $('#toast').text("Added to favorites!").fadeIn().delay(1500).fadeOut();
                    } else {
                        icon.removeClass('fa-heart').addClass('fa-heart-o');
                        button.removeClass('favorited').attr('title', 'Add to Favorite');
                        $('#toast').text("Removed from favorites!").fadeIn().delay(1500).fadeOut();
                    }
                }).fail(function() {
                    alert("Failed to update favorite.");
                });
            });
        </script>
    </body>
</html>
