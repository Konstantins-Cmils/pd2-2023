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

    //display all authors
    public function list()
    {
        $items = Author::orderBy('name', 'asc')->get();
        return view(
            'author.list',
            [
                'title' => 'Autori',
                'items' => $items,
            ]
            );

    } 

    // display new author form
    public function create()
    {
        return view
        (
            'author.form',
            [
                'title' => 'Pievienot jaunu autoru',
                'author' => new Author(),
            ]
        );
    }
    
     // save new author
     public function put(Request $request)
     {
        $validatedDate = $request->validate([
            'name' => 'required',
        ]);

        $author = new Author();
        $author ->name = $validatedDate['name'];
        $author ->save();

        return redirect('/author');
     }

     // display author update form
     public function update(Author $author) 
     {     
        return view
        (         
            'author.form',         
            [             
                'title' => 'Rediģēt autoru',             
                'author' => $author,         
                ]     
        ); 
    } 

    public function patch(Author $author, Request $request) 
    {     
        $validatedData = $request->validate([         
            'name' => 'required',     
        ]);     
        $author->name = $validatedData['name'];     
        $author->save(); 

        return redirect('/authors'); 
    } 

    public function delete(Author $author) 
    {     
        // dd($author);
        $author->delete();     
        return redirect('/authors'); 
    }


}
