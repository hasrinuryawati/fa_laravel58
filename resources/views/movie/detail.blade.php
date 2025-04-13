<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Detail</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/movie_form/styles.css') }}" rel="stylesheet" />
        <!-- Custome Icon -->
        <link href="{{ asset('css/movie_form/custom_icon.css') }}" rel="stylesheet" />
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="{{ url('/') }}"><i class="fa fa-arrow-left" aria-hidden="true" title="Back"></i> {{ trans('messages.detail') }}</a>
                <form action="/favorites" method="GET" class="d-flex">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="fa fa-heart-o me-1"></i>
                        {{ trans('messages.my_favorite') }}
                    </button>
                </form>
            </div>
        </nav>

        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-5"><img class="card-img-top mb-5 mb-md-0" src="{{ $movie['Poster'] !== 'N/A' ? $movie['Poster'] : asset('images/no-image.jpg') }}" alt="..." /></div>
                    <div class="col-md-7">
                        <h1 class="display-5 fw-bolder">{{ $movie['Title'] }}</h1>

                        <div class="row pb-2 col-md-12">
                            <div class="col-md-3">
                                {{ trans('messages.year') }}
                            </div>
                            <div class="col-md-9">
                                {{ $movie['Year'] ?? "N/A" }}
                            </div>
                        </div>

                        <div class="row pb-2 col-md-12">
                            <div class="col-md-3">
                                {{ trans('messages.released') }}
                            </div>
                            <div class="col-md-9">
                                {{ $movie['Released'] ?? "N/A" }}
                            </div>
                        </div>

                        <div class="row pb-2 col-md-12">
                            <div class="col-md-3">
                                {{ trans('messages.runtime') }}
                            </div>
                            <div class="col-md-9">
                                {{ $movie['Runtime'] ?? "N/A" }}
                            </div>
                        </div>

                        <div class="row pb-2 col-md-12">
                            <div class="col-md-3">
                                {{ trans('messages.genre') }}
                            </div>
                            <div class="col-md-9">
                                {{ $movie['Genre'] ?? "N/A" }}
                            </div>
                        </div>

                        <div class="row pb-2 col-md-12">
                            <div class="col-md-3">
                                {{ trans('messages.type') }}
                            </div>
                            <div class="col-md-9">
                                {{ $movie['Type'] ?? "N/A" }}
                            </div>
                        </div>

                        <div class="row pb-2 col-md-12">
                            <div class="col-md-3">
                                {{ trans('messages.director') }}
                            </div>
                            <div class="col-md-9">
                                {{ $movie['Director'] ?? "N/A" }}
                            </div>
                        </div>

                        <div class="row pb-2 col-md-12">
                            <div class="col-md-3">
                                {{ trans('messages.writer') }}
                            </div>
                            <div class="col-md-9">
                                {{ $movie['Writer'] ?? "N/A" }}
                            </div>
                        </div>

                        <div class="row pb-2 col-md-12">
                            <div class="col-md-3">
                                {{ trans('messages.actors') }}
                            </div>
                            <div class="col-md-9">
                                {{ $movie['Actors'] ?? "N/A" }}
                            </div>
                        </div>

                        <div class="row pb-2 col-md-12">
                            <div class="col-md-3">
                                {{ trans('messages.language') }}
                            </div>
                            <div class="col-md-9">
                                {{ $movie['Language'] ?? "N/A" }}
                            </div>
                        </div>

                        <div class="row pb-2 col-md-12">
                            <div class="col-md-3">
                                {{ trans('messages.country') }}
                            </div>
                            <div class="col-md-9">
                                {{ $movie['Country'] ?? "N/A" }}
                            </div>
                        </div>

                        <div class="row pb-2 col-md-12">
                            <div class="col-md-3">
                                {{ trans('message.awards') }}
                            </div>
                            <div class="col-md-9">
                                {{ $movie['Awards'] ?? "N/A" }}
                            </div>
                        </div>

                        <div class="row pb-2 col-md-12">
                            <div class="col-md-3">
                                {{ trans('messages.rating') }}
                            </div>
                            <div class="col-md-9">
                                {{ $movie['imdbRating'] ?? "N/A" }}
                            </div>
                        </div>

                        <div class="row pb-2 col-md-12">
                            <div class="col-md-3">
                                {{ trans('messages.votes') }}
                            </div>
                            <div class="col-md-9">
                                {{ $movie['imdbVotes'] ?? "N/A" }}
                            </div>
                        </div>

                        <div class="row pb-2 col-md-12">
                            <div class="col-md-3">
                                {{ trans('messages.box_office') }}
                            </div>
                            <div class="col-md-9">
                                {{ $movie['BoxOffice'] ?? "N/A" }}
                            </div>
                        </div>

                        <div class="row pb-2 col-md-12">
                            <div class="col-md-3">
                                {{ trans('messages.plot') }}
                            </div>
                            <div class="col-md-9">
                                {{ $movie['Plot'] ?? "N/A" }}
                            </div>
                        </div>

                        @php
                            $isFavorited = isset($favorites[$movie['imdbID']]);
                        @endphp
                        <form method="POST" action="/favorites" class="fav-form" style="display:inline;">
                            {{ csrf_field() }}
                            <input type="hidden" name="movie_id" value="{{ $movie['imdbID'] }}">
                            <input type="hidden" name="poster" value="{{ $movie['Poster'] }}">
                            <input type="hidden" name="title" value="{{ $movie['Title'] }}">

                            <button class="btn-icon {{ $isFavorited ? 'favorited' : '' }}"
                                    title="{{ $isFavorited ? 'Favorited - Click to remove' : 'Add to Favorite' }}"
                                    onclick="event.stopPropagation();"
                                    type="submit">
                                <i class="fa {{ $isFavorited ? 'fa-heart' : 'fa-heart-o' }}"></i>
                            </button>
                        </form>
                    </div>
                </div>
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
