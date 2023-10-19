<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Http\Requests\GenreRequest;

class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function saveGenreData(Genre $genre, GenreRequest $request)
    {
        $validatedData = $request->validated();
        $genre->fill($validatedData);

        $genre->save();
    }

    // display all genres
    public function list()
    {
        $items = Genre::orderBy('name', 'asc')->get();

        return view(
            'genre.list',
            [
                'title' => 'Žanri',
                'items' => $items,
            ]
        );
    }

    // display new genre form
    public function create()
    {
        return view(
            'genre.form',
            [
                'title' => 'Pievienot jaunu žanru',
                'genre' => new Genre(),
            ]
        );
    }

    // save new genre
    public function put(GenreRequest $request)
    {
        $genre = new Genre();

        $this->saveGenreData($genre, $request);

        return redirect('/genres');
    }

    // display genre update form
    public function update(Genre $genre)
    {
        return view(
            'genre.form',
            [
                'title' => 'Rediģēt žanru',
                'genre' => $genre,
            ]
        );
    }

    // update existing genres
    public function patch(Genre $genre, GenreRequest $request)
    {
        $this->saveGenreData($genre, $request);

        return redirect('/genres');
    }

    // delete genres
    public function delete(Genre $genre)
    {
        $genre->delete();
        return redirect('/genres');
    }
}