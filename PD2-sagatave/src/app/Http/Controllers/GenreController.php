<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create(){

        return view(
            'genre.form',
            [
                'title' => 'Pievienot žanru',
                'genre' => new Genre(),
            ]
        );
    }

    public function list()
    {
        $items = Genre::orderBy('name','asc')->get();
        return view('genre.list',
        [
            'title'=>'Genres',
            'items'=> $items,
        ]
    );
}


    // save new genre
    public function put(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:256',
        ]);

        $genre = new Genre();
        $genre->name = $validatedData['name'];        
        $genre->save();

        return redirect('/genres');
    }

    public function update(Genre $genre)
    {
        $genres = Genre::orderBy('name', 'asc')->get();
    
        return view('genre.form', [
            'title' => 'Update genre',
            'genre' => $genre,
            'genres' => $genres,
        ]);
    }

    public function patch(Request $request, Genre $genre)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
    
        $genre->name = $validatedData['name'];
        $genre->save();
    
        return redirect('/genres');
    }

   


    public function delete($genreId)
{
    $genre = Genre::findOrFail($genreId);
    $genreName = $genre->name;
    $genre->delete();

    return redirect('/genres')->with('success', "{$genreName} deleted successfully");
}




    
}
