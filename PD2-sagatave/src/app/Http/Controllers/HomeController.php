<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    //

    public function index(){

        $books = Book::orderBy('name', 'asc')->get();

        return view('home.index',
        [
            'title'=>'Sākumlapa!',
            'books'=> $books,
        ]);
    }


    



}
