<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Favorite Movies</title>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/movie_form/styles.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/movie_form/custom_card.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/movie_form/custom_icon.css') }}" rel="stylesheet" />
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fa fa-arrow-left" aria-hidden="true" title="Back"></i> {{ trans('messages.favorite_movies') }}
            </a>
        </div>
    </nav>

    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center movie-grid">
                @foreach($favorites as $movie)
                    <div class="col mb-5">
                        <div class="card h-100 position-relative card-hover" style="cursor: pointer;" onclick="window.location.href='{{ url('/movie/'.$movie['imdbID']) }}'">
                            <img class="card-img-top"
                                 src="{{ $movie['Poster'] !== 'N/A' ? $movie['Poster'] : asset('images/no-image.jpg') }}"
                                 alt="..." />
                            <div class="card-body p-2 pb-0">
                                <div class="text-center">
                                    <h5 class="fw-bolder">{{ $movie['Title'] }}</h5>
                                </div>
                            </div>
                            <form method="POST" action="/favorites/{{ $movie['imdbID'] }}" class="fav-form" style="display:inline;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent d-flex justify-content-center">
                                    <input type="hidden" name="movie_id" value="{{ $movie['imdbID'] }}">
                                    <input type="hidden" name="poster" value="{{ $movie['Poster'] }}">
                                    <input type="hidden" name="title" value="{{ $movie['Title'] }}">

                                    <button class="btn-icon favorited"
                                            title="Click to remove from favorites"
                                            onclick="event.stopPropagation();"
                                            type="submit">
                                        <i class="fa fa-heart"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div id="toast" style="position: fixed; top: 20px; right: 20px; display: none; z-index: 9999;" class="alert alert-success"></div>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Hasri Nuryawati 2025</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/movie_form/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).on('submit', '.fav-form', function(e) {
            e.preventDefault();
            var form = $(this);
            var button = form.find('button');
            var card = form.closest('.col');

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(res) {
                    card.fadeOut(300, function() {
                        $(this).remove();

                        if ($('.movie-grid .col').length === 0) {
                            window.location.href = "{{ url('/favorites') }}";
                        } else {
                            $('#toast').text("Removed from favorites!").fadeIn().delay(1500).fadeOut();
                        }
                    });
                },
                error: function() {
                    alert("Failed to remove favorite.");
                }
            });
        });
    </script>
</body>
</html>
