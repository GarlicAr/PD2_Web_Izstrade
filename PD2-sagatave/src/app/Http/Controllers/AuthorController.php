<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    //display all authors!
    public function list()
    {
        $items = Author::orderBy('name','asc')->get();
        return view('author.list',
        [
            'title'=>'Authors',
            'items'=> $items,
        ]
    );

    }

    // display new authoor form
    public function create(){
        return view(
            'author.form',
            [
                'title' => 'Add Author',
                'author' => new Author(),
            ]
        );
    }


    public function put(Request $request){
        //
        $validatedData = $request->validate([
            'name'=>'required',
        ]);

        $author = new Author();
        $author->name= $validatedData['name'];
        $author->save();

        return redirect('/authors');
    }


    public function update( Author $author){
        return view(
            'author.form',
            [
                'title'=>'Update Author',
                'author' => $author,
            ]
        );
    }

    public function patch(Request $request, Author $author)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
    
        $author->name = $validatedData['name'];
        $author->save();
    
        return redirect('/authors');
    }

    public function delete($author)
{
    $author = Author::findOrFail($author);
    $authorName = $author->name;
    $author->delete();

    return redirect('/authors')->with('success', "{$authorName} deleted successfully");
}
    


}
