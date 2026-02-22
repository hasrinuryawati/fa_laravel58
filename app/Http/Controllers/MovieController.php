<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->filled('s') ? $request->get('s') : 'movie';
        $year = $request->get('y');
        $type = $request->get('type');
        $page = $request->get('page', 1);

        $omdpKey = config('services.omdb.key');
        $url = "http://www.omdbapi.com/?apikey=$omdpKey&s=" . urlencode($title) . "&page=$page";

        if ($year) $url .= "&y=$year";
        if ($type) $url .= "&type=$type";

        $response = file_get_contents($url);
        $movies = json_decode($response, true);

        $error = '';
        if (isset($movies['Response']) && $movies['Response'] == 'False') {
            $error = $movies['Error'];
            $movies = [];
        }

        $favorites = session('favorites', []);
        return view('movie.index', [
            'movies' => $movies['Search'] ?? [],
            'favorites' => $favorites,
            'error' => $error,
        ]);
    }

    public function loadMore(Request $request)
    {
        $title = $request->filled('s') ? $request->get('s') : 'movie';
        $year = $request->get('y');
        $type = $request->get('type');
        $page = $request->get('page', 1);

        $omdpKey = config('services.omdb.key');
        $url = "http://www.omdbapi.com/?apikey=$omdpKey&s=" . urlencode($title) . "&page=$page";

        if ($year) $url .= "&y=$year";
        if ($type) $url .= "&type=$type";

        $response = file_get_contents($url);
        $movies = json_decode($response, true);

        $favorites = session('favorites', []);
        return view('movie._list', [
            'movies' => $movies['Search'] ?? [],
            'favorites' => $favorites,
        ]);
    }

    public function detail($id)
    {
        $omdpKey = config('services.omdb.key');
        $url = "http://www.omdbapi.com/" . '?apikey=' . $omdpKey . '&i=' . $id;
        $response = file_get_contents($url);
        $movie = json_decode($response, true);
        $favorites = session('favorites', []);

        return view('movie.detail', [
            'movie' => $movie,
            'favorites' => $favorites
        ]);
    }

    public function favList()
    {
        $favorites = session('favorites', []);
        if (empty($favorites))
            return view('movie.empty');

        return view('movie.fav_index', compact('favorites'));
    }

    public function favAdd(Request $request)
    {
        $favorites = session('favorites', []);
        $id = $request->movie_id;

        if (isset($favorites[$id])) {
            unset($favorites[$id]);
        } else {
            $favorites[$id] = [
                'imdbID' => $id,
                'Poster' => $request->poster,
                'Title' => $request->title,
            ];
        }

        session(['favorites' => $favorites]);

        return response()->json([
            'status' => 'success',
            'favorited' => isset($favorites[$id])
        ]);
    }

    public function favDelete($id)
    {
        $favorites = session('favorites', []);
        unset($favorites[$id]);
        session(['favorites' => $favorites]);

        return redirect()->back()
    }
}
