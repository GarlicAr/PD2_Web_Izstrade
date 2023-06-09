<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;

class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

     //display all books!
     public function list()
     {
         $items = Book::orderBy('name','asc')->get();
         return view('book.list',
         [
             'title'=>'Books',
             'items'=> $items,
         ]
     );

    }


     // display new authoor form
     public function create(){

        $authors= Author::orderBy('name','asc')->get();
        $genres = Genre::orderBy('name', 'asc')->get();

        return view(
            'book.form',
            [
                'title' => 'Pievienot gramatu',
                'book' => new Book(),
                'authors' => $authors,
                'genres' => $genres,
            ]
        );
    }

       // save new book
       public function put(Request $request)
       {
           $validatedData = $request->validate([
               'name' => 'required|min:3|max:256',
               'author_id' => 'required',
               'description' => 'nullable',
               'price' => 'nullable|numeric',
               'year' => 'numeric',
               'genre_id' => 'required',
               'image' => 'nullable|image',
               'display' => 'nullable'
           ]);
   
           $book = new Book();
           $book->name = $validatedData['name'];
           $book->author_id = $validatedData['author_id'];
           $book->description = $validatedData['description'];
           $book->price = $validatedData['price'];
           $book->year = $validatedData['year'];
           $book->genre_id = $validatedData['genre_id'];
           $book->display = (bool) ($validatedData['display'] ?? false);

           if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->clientExtension();
            $name = uniqid();
            $book->image = $uploadedFile->storePubliclyAs(
            '/',
            $name . '.' . $extension,
            'uploads'
            );
           }
           
        
           
           $book->save();
   
           return redirect('/books');
       }
 

       public function update(Book $book)
       {
           $authors = Author::orderBy('name', 'asc')->get();
           $genres = Genre::orderBy('name', 'asc')->get();
       
           return view('book.form', [
               'title' => 'Update book',
               'book' => $book,
               'authors' => $authors,
               'genres' => $genres,
           ]);
       }

    public function patch(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
    
        $book->name = $validatedData['name'];
        $book->save();
    
        return redirect('/books');
    }

public function delete($bookId)
{
    $book = Book::findOrFail($bookId);
    $bookName = $book->name;
    $book->delete();

    return redirect('/books')->with('success', "{$bookName} deleted successfully");
}

}
