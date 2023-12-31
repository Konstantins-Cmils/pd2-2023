<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; 
use App\Models\Author; 

class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //display all books
    public function list() 
    {     
        $items = Book::orderBy('name', 'asc')->get();      
        return view(         
            'book.list',         
            [             
                'title' => 'Grāmatas',             
                'items' => $items         
            ]     
        ); 
    } 

    // display new book form
    public function create() 
    {     
        $authors = Author::orderBy('name', 'asc')->get();      
        return view(         
            'book.form',         
            [             
                'title' => 'Pievienot grāmatu',             
                'book' => new Book(),             
                'authors' => $authors,         
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
            'genre' => 'nullable',        
            'image' => 'nullable|image',         
            'display' => 'nullable'     
        ]);      
        $book = new Book();     
        $book->name = $validatedData['name'];     
        $book->author_id = $validatedData['author_id'];     
        $book->description = $validatedData['description'];     
        $book->price = $validatedData['price'];     
        $book->year = $validatedData['year'];    
        $book->genre = $validatedData['genre'];    
        $book->display = (bool) ($validatedData['display'] ?? false);     

        if ($request ->hasFile('image'))
        {
            $uploadedFile = $request -> file('image');
            $extension = $uploadedFile ->clientExtension();
            $name = uniqid();
            $book->image = $uploadedFile -> storePubliclyAs
            (
                '/',
                $name, ',' , $extension,
                'uploads'
            );
        }

        $book->save();      
        return redirect('/books'); 
    } 

     // display book update form
     public function update(Book $book) 
     {     
        return view
        (         
            'book.form',         
            [             
                'title' => 'Rediģēt grāmātu',             
                'book' => $book,         
                ]     
        ); 
    } 

    // Update existing objects
    public function patch(Book $book, Request $request) 
    {     
        $validatedData = $request->validate([         
            'name' => 'required|min:3|max:256',         
            'author_id' => 'required',         
            'description' => 'nullable',         
            'price' => 'nullable|numeric',         
            'year' => 'numeric',  
            'genre' => 'nullable',      
            'image' => 'nullable|image',         
            'display' => 'nullable'     
        ]);      
         
        $book->name = $validatedData['name'];     
        $book->author_id = $validatedData['author_id'];     
        $book->description = $validatedData['description'];     
        $book->price = $validatedData['price'];     
        $book->year = $validatedData['year'];    
        $book->genre = $validatedData['genre'];    
        $book->display = (bool) ($validatedData['display'] ?? false);     

        if ($request ->hasFile('image'))
        {
            $uploadedFile = $request -> file('image');
            $extension = $uploadedFile ->clientExtension();
            $name = uniqid();
            $book->image = $uploadedFile -> storePubliclyAs
            (
                '/',
                $name, ',' , $extension,
                'uploads'
            );
        }

        $book->save();      
        return redirect('/books'); 
    } 

    public function delete(Book $book) 
    {     
        // dd($book);
        $book->delete();     
        return redirect('/books'); 
    }


}
